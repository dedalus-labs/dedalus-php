<?php

declare(strict_types=1);

namespace Dedalus\ServiceContracts\Machines;

use Dedalus\Core\Contracts\BaseResponse;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\Artifacts\Artifact;
use Dedalus\Machines\Artifacts\ArtifactDeleteParams;
use Dedalus\Machines\Artifacts\ArtifactListParams;
use Dedalus\Machines\Artifacts\ArtifactRetrieveParams;
use Dedalus\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
interface ArtifactsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ArtifactRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Artifact>
     *
     * @throws APIException
     */
    public function retrieve(
        array|ArtifactRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ArtifactListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorPage<Artifact>>
     *
     * @throws APIException
     */
    public function list(
        array|ArtifactListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ArtifactDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Artifact>
     *
     * @throws APIException
     */
    public function delete(
        array|ArtifactDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
