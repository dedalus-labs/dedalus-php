<?php

declare(strict_types=1);

namespace Dedalus\Services;

use Dedalus\Client;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\Core\Util;
use Dedalus\RequestOptions;
use Dedalus\ServiceContracts\UsageContract;
use Dedalus\Usage\MachineComputeUsage;
use Dedalus\Usage\MachineStorageUsage;
use Dedalus\Usage\OrgUsage;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
final class UsageService implements UsageContract
{
    /**
     * @api
     */
    public UsageRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new UsageRawService($client);
    }

    /**
     * @api
     *
     * Get usage summary
     *
     * @param string $periodStart Billing period start (YYYY-MM-DD). Defaults to first of current month.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        ?string $periodStart = null,
        RequestOptions|array|null $requestOptions = null
    ): OrgUsage {
        $params = Util::removeNulls(['periodStart' => $periodStart]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List machine compute usage breakdown
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
    ): MachineComputeUsage {
        $params = Util::removeNulls(
            [
                'granularity' => $granularity,
                'machineID' => $machineID,
                'periodEnd' => $periodEnd,
                'periodStart' => $periodStart,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->machineCompute(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List machine storage usage breakdown
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
    ): MachineStorageUsage {
        $params = Util::removeNulls(
            [
                'machineID' => $machineID,
                'periodEnd' => $periodEnd,
                'periodStart' => $periodStart,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->machineStorage(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
