<?php

declare(strict_types=1);

namespace Dedalus\ServiceContracts\Machines;

use Dedalus\Core\Contracts\BaseResponse;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\SSH\SSHCreateParams;
use Dedalus\Machines\SSH\SSHDeleteParams;
use Dedalus\Machines\SSH\SSHListParams;
use Dedalus\Machines\SSH\SSHRetrieveParams;
use Dedalus\Machines\SSH\SSHSession;
use Dedalus\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
interface SSHRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SSHCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SSHSession>
     *
     * @throws APIException
     */
    public function create(
        array|SSHCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SSHRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SSHSession>
     *
     * @throws APIException
     */
    public function retrieve(
        array|SSHRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SSHListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorPage<SSHSession>>
     *
     * @throws APIException
     */
    public function list(
        array|SSHListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SSHDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SSHSession>
     *
     * @throws APIException
     */
    public function delete(
        array|SSHDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
