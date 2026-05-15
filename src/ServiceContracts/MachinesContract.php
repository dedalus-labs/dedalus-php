<?php

declare(strict_types=1);

namespace Dedalus\ServiceContracts;

use Dedalus\Core\Contracts\BaseStream;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\Machine;
use Dedalus\Machines\MachineListItem;
use Dedalus\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
interface MachinesContract
{
    /**
     * @api
     *
     * @param int $memoryMiB memory in MiB
     * @param int $storageGiB storage in GiB
     * @param float $vcpu CPU in vCPUs
     * @param string $autosleep Idle window before autosleep. Accepts fixed duration units like 30s, 30m, 2h, 7d3h4s, or 1w3d, raw seconds ("1800"), or never to disable.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        int $memoryMiB,
        int $storageGiB,
        float $vcpu,
        ?string $autosleep = null,
        RequestOptions|array|null $requestOptions = null,
    ): Machine;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $machineID,
        RequestOptions|array|null $requestOptions = null
    ): Machine;

    /**
     * @api
     *
     * @param string $machineID Path param
     * @param string $autosleep Body param: Idle window before autosleep. Accepts fixed duration units like 30s, 30m, 2h, 7d3h4s, or 1w3d, raw seconds ("1800"), or never to disable.
     * @param int $memoryMiB body param: Memory in MiB
     * @param int $storageGiB body param: Storage in GiB
     * @param float $vcpu body param: CPU in vCPUs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $machineID,
        ?string $autosleep = null,
        ?int $memoryMiB = null,
        ?int $storageGiB = null,
        ?float $vcpu = null,
        RequestOptions|array|null $requestOptions = null,
    ): Machine;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return CursorPage<MachineListItem>
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): CursorPage;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $machineID,
        RequestOptions|array|null $requestOptions = null
    ): Machine;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function sleep(
        string $machineID,
        RequestOptions|array|null $requestOptions = null
    ): Machine;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function wake(
        string $machineID,
        RequestOptions|array|null $requestOptions = null
    ): Machine;

    /**
     * @api
     *
     * @param string $machineID path param: Machine identifier
     * @param string $lastEventID header param: Optional resourceVersion bookmark used to resume a previous stream
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseStream<Machine>
     *
     * @throws APIException
     */
    public function watchStream(
        string $machineID,
        ?string $lastEventID = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream;
}
