<?php

declare(strict_types=1);

namespace Dedalus\Services;

use Dedalus\Client;
use Dedalus\Core\Contracts\BaseResponse;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\Core\Util;
use Dedalus\RequestOptions;
use Dedalus\ServiceContracts\UsageRawContract;
use Dedalus\Usage\MachineComputeUsage;
use Dedalus\Usage\MachineStorageUsage;
use Dedalus\Usage\OrgUsage;
use Dedalus\Usage\UsageMachineComputeParams;
use Dedalus\Usage\UsageMachineStorageParams;
use Dedalus\Usage\UsageRetrieveParams;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
final class UsageRawService implements UsageRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get usage summary
     *
     * @param array{periodStart?: string}|UsageRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<OrgUsage>
     *
     * @throws APIException
     */
    public function retrieve(
        array|UsageRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = UsageRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/usage',
            query: Util::array_transform_keys(
                $parsed,
                ['periodStart' => 'period_start']
            ),
            options: $options,
            convert: OrgUsage::class,
        );
    }

    /**
     * @api
     *
     * List machine compute usage breakdown
     *
     * @param array{
     *   granularity?: string,
     *   machineID?: string,
     *   periodEnd?: string,
     *   periodStart?: string,
     * }|UsageMachineComputeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MachineComputeUsage>
     *
     * @throws APIException
     */
    public function machineCompute(
        array|UsageMachineComputeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = UsageMachineComputeParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/usage/machines/compute',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'machineID' => 'machine_id',
                    'periodEnd' => 'period_end',
                    'periodStart' => 'period_start',
                ],
            ),
            options: $options,
            convert: MachineComputeUsage::class,
        );
    }

    /**
     * @api
     *
     * List machine storage usage breakdown
     *
     * @param array{
     *   machineID?: string, periodEnd?: string, periodStart?: string
     * }|UsageMachineStorageParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MachineStorageUsage>
     *
     * @throws APIException
     */
    public function machineStorage(
        array|UsageMachineStorageParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = UsageMachineStorageParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/usage/machines/storage',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'machineID' => 'machine_id',
                    'periodEnd' => 'period_end',
                    'periodStart' => 'period_start',
                ],
            ),
            options: $options,
            convert: MachineStorageUsage::class,
        );
    }
}
