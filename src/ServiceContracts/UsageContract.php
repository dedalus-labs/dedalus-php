<?php

declare(strict_types=1);

namespace Dedalus\ServiceContracts;

use Dedalus\Core\Exceptions\APIException;
use Dedalus\RequestOptions;
use Dedalus\Usage\MachineComputeUsage;
use Dedalus\Usage\MachineStorageUsage;
use Dedalus\Usage\OrgUsage;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
interface UsageContract
{
    /**
     * @api
     *
     * @param string $periodStart Billing period start (YYYY-MM-DD). Defaults to first of current month.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        ?string $periodStart = null,
        RequestOptions|array|null $requestOptions = null,
    ): OrgUsage;

    /**
     * @api
     *
     * @param string $granularity Usage breakdown granularity: hour or day. Defaults to hour.
     * @param string $machineID optional machine ID filter
     * @param string $periodEnd Last UTC usage date to include (YYYY-MM-DD). Defaults to current time.
     * @param string $periodStart Usage period start (YYYY-MM-DD). Defaults to first of current month.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function machineCompute(
        ?string $granularity = null,
        ?string $machineID = null,
        ?string $periodEnd = null,
        ?string $periodStart = null,
        RequestOptions|array|null $requestOptions = null,
    ): MachineComputeUsage;

    /**
     * @api
     *
     * @param string $machineID optional machine ID filter
     * @param string $periodEnd Last UTC usage date to include (YYYY-MM-DD). Defaults to current time.
     * @param string $periodStart Usage period start (YYYY-MM-DD). Defaults to first of current month.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function machineStorage(
        ?string $machineID = null,
        ?string $periodEnd = null,
        ?string $periodStart = null,
        RequestOptions|array|null $requestOptions = null,
    ): MachineStorageUsage;
}
