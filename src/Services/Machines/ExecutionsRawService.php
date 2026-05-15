<?php

declare(strict_types=1);

namespace Dedalus\Services\Machines;

use Dedalus\Client;
use Dedalus\Core\Contracts\BaseResponse;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\Executions\Execution;
use Dedalus\Machines\Executions\ExecutionCreateParams1 as ExecutionCreateParams;
use Dedalus\Machines\Executions\ExecutionDeleteParams;
use Dedalus\Machines\Executions\ExecutionEvent;
use Dedalus\Machines\Executions\ExecutionEventsParams;
use Dedalus\Machines\Executions\ExecutionListParams;
use Dedalus\Machines\Executions\ExecutionOutput;
use Dedalus\Machines\Executions\ExecutionOutputParams;
use Dedalus\Machines\Executions\ExecutionRetrieveParams;
use Dedalus\RequestOptions;
use Dedalus\ServiceContracts\Machines\ExecutionsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
final class ExecutionsRawService implements ExecutionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create execution
     *
     * @param array{
     *   machineID: string,
     *   command: list<string>|null,
     *   cwd?: string,
     *   env?: array<string,string>,
     *   stdin?: string,
     *   timeoutMs?: int,
     * }|ExecutionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Execution>
     *
     * @throws APIException
     */
    public function create(
        array|ExecutionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ExecutionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/machines/%1$s/executions', $machineID],
            body: (object) array_diff_key($parsed, array_flip(['machineID'])),
            options: $options,
            convert: Execution::class,
        );
    }

    /**
     * @api
     *
     * Get execution
     *
     * @param array{
     *   machineID: string, executionID: string
     * }|ExecutionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Execution>
     *
     * @throws APIException
     */
    public function retrieve(
        array|ExecutionRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ExecutionRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);
        $executionID = $parsed['executionID'];
        unset($parsed['executionID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/machines/%1$s/executions/%2$s', $machineID, $executionID],
            options: $options,
            convert: Execution::class,
        );
    }

    /**
     * @api
     *
     * List executions
     *
     * @param array{
     *   machineID: string, cursor?: string, limit?: int
     * }|ExecutionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorPage<Execution>>
     *
     * @throws APIException
     */
    public function list(
        array|ExecutionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ExecutionListParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/machines/%1$s/executions', $machineID],
            query: $parsed,
            options: $options,
            convert: Execution::class,
            page: CursorPage::class,
        );
    }

    /**
     * @api
     *
     * Delete execution
     *
     * @param array{
     *   machineID: string, executionID: string
     * }|ExecutionDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Execution>
     *
     * @throws APIException
     */
    public function delete(
        array|ExecutionDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ExecutionDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);
        $executionID = $parsed['executionID'];
        unset($parsed['executionID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['v1/machines/%1$s/executions/%2$s', $machineID, $executionID],
            options: $options,
            convert: Execution::class,
        );
    }

    /**
     * @api
     *
     * List execution events
     *
     * @param array{
     *   machineID: string, executionID: string, cursor?: string, limit?: int
     * }|ExecutionEventsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorPage<ExecutionEvent>>
     *
     * @throws APIException
     */
    public function events(
        array|ExecutionEventsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ExecutionEventsParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);
        $executionID = $parsed['executionID'];
        unset($parsed['executionID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'v1/machines/%1$s/executions/%2$s/events', $machineID, $executionID,
            ],
            query: $parsed,
            options: $options,
            convert: ExecutionEvent::class,
            page: CursorPage::class,
        );
    }

    /**
     * @api
     *
     * Get execution output
     *
     * @param array{
     *   machineID: string, executionID: string
     * }|ExecutionOutputParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ExecutionOutput>
     *
     * @throws APIException
     */
    public function output(
        array|ExecutionOutputParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ExecutionOutputParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);
        $executionID = $parsed['executionID'];
        unset($parsed['executionID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'v1/machines/%1$s/executions/%2$s/output', $machineID, $executionID,
            ],
            options: $options,
            convert: ExecutionOutput::class,
        );
    }
}
