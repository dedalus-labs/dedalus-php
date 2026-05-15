<?php

declare(strict_types=1);

namespace Dedalus\ServiceContracts;

use Dedalus\Core\Contracts\BaseResponse;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\RequestOptions;
use Dedalus\Usage\MachineComputeUsage;
use Dedalus\Usage\MachineStorageUsage;
use Dedalus\Usage\OrgUsage;
use Dedalus\Usage\UsageMachineComputeParams;
use Dedalus\Usage\UsageMachineStorageParams;
use Dedalus\Usage\UsageRetrieveParams;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
interface UsageRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|UsageRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<OrgUsage>
     *
     * @throws APIException
     */
    public function retrieve(
        array|UsageRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|UsageMachineComputeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MachineComputeUsage>
     *
     * @throws APIException
     */
    public function machineCompute(
        array|UsageMachineComputeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|UsageMachineStorageParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MachineStorageUsage>
     *
     * @throws APIException
     */
    public function machineStorage(
        array|UsageMachineStorageParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
