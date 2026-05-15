<?php

declare(strict_types=1);

namespace Dedalus\Services\Machines;

use Dedalus\Client;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\Core\Util;
use Dedalus\CursorPage;
use Dedalus\Machines\Executions\Execution;
use Dedalus\Machines\Executions\ExecutionEvent;
use Dedalus\Machines\Executions\ExecutionOutput;
use Dedalus\RequestOptions;
use Dedalus\ServiceContracts\Machines\ExecutionsContract;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
final class ExecutionsService implements ExecutionsContract
{
    /**
     * @api
     */
    public ExecutionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ExecutionsRawService($client);
    }

    /**
     * @api
     *
     * Create execution
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
    ): Execution {
        $params = Util::removeNulls(
            [
                'machineID' => $machineID,
                'command' => $command,
                'cwd' => $cwd,
                'env' => $env,
                'stdin' => $stdin,
                'timeoutMs' => $timeoutMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get execution
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $machineID,
        string $executionID,
        RequestOptions|array|null $requestOptions = null,
    ): Execution {
        $params = Util::removeNulls(
            ['machineID' => $machineID, 'executionID' => $executionID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List executions
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
    ): CursorPage {
        $params = Util::removeNulls(
            ['machineID' => $machineID, 'cursor' => $cursor, 'limit' => $limit]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete execution
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $machineID,
        string $executionID,
        RequestOptions|array|null $requestOptions = null,
    ): Execution {
        $params = Util::removeNulls(
            ['machineID' => $machineID, 'executionID' => $executionID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List execution events
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
    ): CursorPage {
        $params = Util::removeNulls(
            [
                'machineID' => $machineID,
                'executionID' => $executionID,
                'cursor' => $cursor,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->events(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get execution output
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function output(
        string $machineID,
        string $executionID,
        RequestOptions|array|null $requestOptions = null,
    ): ExecutionOutput {
        $params = Util::removeNulls(
            ['machineID' => $machineID, 'executionID' => $executionID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->output(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
