<?php

declare(strict_types=1);

namespace Dedalus\Services;

use Dedalus\Client;
use Dedalus\Core\Contracts\BaseResponse;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\Machine;
use Dedalus\Machines\MachineCreateParams;
use Dedalus\Machines\MachineDeleteParams;
use Dedalus\Machines\MachineGetResponse;
use Dedalus\Machines\MachineListItem;
use Dedalus\Machines\MachineListParams;
use Dedalus\Machines\MachineRetrieveParams;
use Dedalus\Machines\MachineSleepParams;
use Dedalus\Machines\MachineUpdateParams;
use Dedalus\Machines\MachineWakeParams;
use Dedalus\RequestOptions;
use Dedalus\ServiceContracts\MachinesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
final class MachinesRawService implements MachinesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create machine
     *
     * @param array{
     *   autosleep?: string, memoryMiB?: int, storageGiB?: int, vcpu?: float
     * }|MachineCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Machine>
     *
     * @throws APIException
     */
    public function create(
        array|MachineCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MachineCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/machines',
            body: (object) $parsed,
            options: $options,
            convert: Machine::class,
        );
    }

    /**
     * @api
     *
     * Get machine
     *
     * @param array{machineID: string}|MachineRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MachineGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        array|MachineRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MachineRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/machines/%1$s', $machineID],
            options: $options,
            convert: MachineGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Update machine
     *
     * @param array{
     *   machineID: string,
     *   autosleep?: string,
     *   memoryMiB?: int,
     *   storageGiB?: int,
     *   vcpu?: float,
     * }|MachineUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Machine>
     *
     * @throws APIException
     */
    public function update(
        array|MachineUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MachineUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['v1/machines/%1$s', $machineID],
            body: (object) array_diff_key($parsed, array_flip(['machineID'])),
            options: $options,
            convert: Machine::class,
        );
    }

    /**
     * @api
     *
     * List machines
     *
     * @param array{cursor?: string, limit?: int}|MachineListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorPage<MachineListItem>>
     *
     * @throws APIException
     */
    public function list(
        array|MachineListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MachineListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/machines',
            query: $parsed,
            options: $options,
            convert: MachineListItem::class,
            page: CursorPage::class,
        );
    }

    /**
     * @api
     *
     * Destroy machine
     *
     * @param array{machineID: string}|MachineDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Machine>
     *
     * @throws APIException
     */
    public function delete(
        array|MachineDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MachineDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['v1/machines/%1$s', $machineID],
            options: $options,
            convert: Machine::class,
        );
    }

    /**
     * @api
     *
     * Sleep a running machine
     *
     * @param array{machineID: string}|MachineSleepParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Machine>
     *
     * @throws APIException
     */
    public function sleep(
        array|MachineSleepParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MachineSleepParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/machines/%1$s/sleep', $machineID],
            options: $options,
            convert: Machine::class,
        );
    }

    /**
     * @api
     *
     * Wake a sleeping machine
     *
     * @param array{machineID: string}|MachineWakeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Machine>
     *
     * @throws APIException
     */
    public function wake(
        array|MachineWakeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MachineWakeParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/machines/%1$s/wake', $machineID],
            options: $options,
            convert: Machine::class,
        );
    }
}
