<?php

declare(strict_types=1);

namespace Dedalus\ServiceContracts\Machines;

use Dedalus\Core\Contracts\BaseResponse;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\Previews\Preview;
use Dedalus\Machines\Previews\PreviewCreateParams1 as PreviewCreateParams;
use Dedalus\Machines\Previews\PreviewDeleteParams;
use Dedalus\Machines\Previews\PreviewListParams;
use Dedalus\Machines\Previews\PreviewRetrieveParams;
use Dedalus\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
interface PreviewsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|PreviewCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Preview>
     *
     * @throws APIException
     */
    public function create(
        array|PreviewCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|PreviewRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Preview>
     *
     * @throws APIException
     */
    public function retrieve(
        array|PreviewRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|PreviewListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorPage<Preview>>
     *
     * @throws APIException
     */
    public function list(
        array|PreviewListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|PreviewDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Preview>
     *
     * @throws APIException
     */
    public function delete(
        array|PreviewDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
