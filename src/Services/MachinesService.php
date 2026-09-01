<?php

declare(strict_types=1);

namespace Dedalus\Services;

use Dedalus\Client;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\Core\Util;
use Dedalus\CursorPage;
use Dedalus\Machines\Machine;
use Dedalus\Machines\MachineGetResponse;
use Dedalus\Machines\MachineListItem;
use Dedalus\RequestOptions;
use Dedalus\ServiceContracts\MachinesContract;
use Dedalus\Services\Machines\ExecutionsService;
use Dedalus\Services\Machines\SSHService;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
final class MachinesService implements MachinesContract
{
    /**
     * @api
     */
    public MachinesRawService $raw;

    /**
     * @api
     */
    public SSHService $ssh;

    /**
     * @api
     */
    public ExecutionsService $executions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MachinesRawService($client);
        $this->ssh = new SSHService($client);
        $this->executions = new ExecutionsService($client);
    }

    /**
     * @api
     *
     * Create machine
     *
     * @param string $autosleep Idle window before autosleep. Accepts fixed duration units like 30s, 30m, 2h, 7d3h4s, or 1w3d, raw seconds ("1800"), or never to disable.
     * @param int $memoryMiB memory in MiB
     * @param int $storageGiB storage in GiB
     * @param float $vcpu CPU in vCPUs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $autosleep = '300s',
        int $memoryMiB = 4096,
        int $storageGiB = 10,
        float $vcpu = 1,
        RequestOptions|array|null $requestOptions = null,
    ): Machine {
        $params = Util::removeNulls(
            [
                'autosleep' => $autosleep,
                'memoryMiB' => $memoryMiB,
                'storageGiB' => $storageGiB,
                'vcpu' => $vcpu,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get machine
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $machineID,
        RequestOptions|array|null $requestOptions = null
    ): MachineGetResponse {
        $params = Util::removeNulls(['machineID' => $machineID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update machine
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
    ): Machine {
        $params = Util::removeNulls(
            [
                'machineID' => $machineID,
                'autosleep' => $autosleep,
                'memoryMiB' => $memoryMiB,
                'storageGiB' => $storageGiB,
                'vcpu' => $vcpu,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List machines
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
    ): CursorPage {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Destroy machine
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $machineID,
        RequestOptions|array|null $requestOptions = null
    ): Machine {
        $params = Util::removeNulls(['machineID' => $machineID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Sleep a running machine
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function sleep(
        string $machineID,
        RequestOptions|array|null $requestOptions = null
    ): Machine {
        $params = Util::removeNulls(['machineID' => $machineID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->sleep(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Wake a sleeping machine
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function wake(
        string $machineID,
        RequestOptions|array|null $requestOptions = null
    ): Machine {
        $params = Util::removeNulls(['machineID' => $machineID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->wake(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
