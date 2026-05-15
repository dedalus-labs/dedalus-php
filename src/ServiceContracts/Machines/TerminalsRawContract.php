<?php

declare(strict_types=1);

namespace Dedalus\ServiceContracts\Machines;

use Dedalus\Core\Contracts\BaseResponse;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\Terminals\Terminal;
use Dedalus\Machines\Terminals\TerminalCreateParams1 as TerminalCreateParams;
use Dedalus\Machines\Terminals\TerminalDeleteParams;
use Dedalus\Machines\Terminals\TerminalListParams;
use Dedalus\Machines\Terminals\TerminalRetrieveParams;
use Dedalus\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
interface TerminalsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|TerminalCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Terminal>
     *
     * @throws APIException
     */
    public function create(
        array|TerminalCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TerminalRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Terminal>
     *
     * @throws APIException
     */
    public function retrieve(
        array|TerminalRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TerminalListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorPage<Terminal>>
     *
     * @throws APIException
     */
    public function list(
        array|TerminalListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TerminalDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Terminal>
     *
     * @throws APIException
     */
    public function delete(
        array|TerminalDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
