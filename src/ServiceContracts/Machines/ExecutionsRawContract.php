<?php

declare(strict_types=1);

namespace Dedalus\ServiceContracts\Machines;

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

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
interface ExecutionsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ExecutionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Execution>
     *
     * @throws APIException
     */
    public function create(
        array|ExecutionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ExecutionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Execution>
     *
     * @throws APIException
     */
    public function retrieve(
        array|ExecutionRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ExecutionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorPage<Execution>>
     *
     * @throws APIException
     */
    public function list(
        array|ExecutionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ExecutionDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Execution>
     *
     * @throws APIException
     */
    public function delete(
        array|ExecutionDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ExecutionEventsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorPage<ExecutionEvent>>
     *
     * @throws APIException
     */
    public function events(
        array|ExecutionEventsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ExecutionOutputParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ExecutionOutput>
     *
     * @throws APIException
     */
    public function output(
        array|ExecutionOutputParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
