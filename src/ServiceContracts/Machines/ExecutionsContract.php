<?php

declare(strict_types=1);

namespace Dedalus\ServiceContracts\Machines;

use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\Executions\Execution;
use Dedalus\Machines\Executions\ExecutionEvent;
use Dedalus\Machines\Executions\ExecutionOutput;
use Dedalus\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
interface ExecutionsContract
{
    /**
     * @api
     *
     * @param string $machineID Path param
     * @param list<string>|null $command Body param
     * @param string $cwd Body param
     * @param array<string,string> $env Body param
     * @param string $stdin Body param
     * @param int $timeoutMs Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $machineID,
        ?array $command,
        ?string $cwd = null,
        ?array $env = null,
        ?string $stdin = null,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): Execution;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $machineID,
        string $executionID,
        RequestOptions|array|null $requestOptions = null,
    ): Execution;

    /**
     * @api
     *
     * @param string $machineID Path param
     * @param string $cursor Query param
     * @param int $limit Query param
     * @param RequestOpts|null $requestOptions
     *
     * @return CursorPage<Execution>
     *
     * @throws APIException
     */
    public function list(
        string $machineID,
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
        string $executionID,
        RequestOptions|array|null $requestOptions = null,
    ): Execution;

    /**
     * @api
     *
     * @param string $machineID Path param
     * @param string $executionID Path param
     * @param string $cursor Query param
     * @param int $limit Query param
     * @param RequestOpts|null $requestOptions
     *
     * @return CursorPage<ExecutionEvent>
     *
     * @throws APIException
     */
    public function events(
        string $machineID,
        string $executionID,
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
    public function output(
        string $machineID,
        string $executionID,
        RequestOptions|array|null $requestOptions = null,
    ): ExecutionOutput;
}
