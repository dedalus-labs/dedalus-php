<?php

declare(strict_types=1);

namespace Dedalus\Services\Machines;

use Dedalus\Client;
use Dedalus\Core\Contracts\BaseResponse;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\Artifacts\Artifact;
use Dedalus\Machines\Artifacts\ArtifactDeleteParams;
use Dedalus\Machines\Artifacts\ArtifactListParams;
use Dedalus\Machines\Artifacts\ArtifactRetrieveParams;
use Dedalus\RequestOptions;
use Dedalus\ServiceContracts\Machines\ArtifactsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
final class ArtifactsRawService implements ArtifactsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get artifact
     *
     * @param array{
     *   machineID: string, artifactID: string
     * }|ArtifactRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Artifact>
     *
     * @throws APIException
     */
    public function retrieve(
        array|ArtifactRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ArtifactRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);
        $artifactID = $parsed['artifactID'];
        unset($parsed['artifactID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/machines/%1$s/artifacts/%2$s', $machineID, $artifactID],
            options: $options,
            convert: Artifact::class,
        );
    }

    /**
     * @api
     *
     * List artifacts
     *
     * @param array{
     *   machineID: string, cursor?: string, limit?: int
     * }|ArtifactListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorPage<Artifact>>
     *
     * @throws APIException
     */
    public function list(
        array|ArtifactListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ArtifactListParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/machines/%1$s/artifacts', $machineID],
            query: $parsed,
            options: $options,
            convert: Artifact::class,
            page: CursorPage::class,
        );
    }

    /**
     * @api
     *
     * Delete artifact
     *
     * @param array{machineID: string, artifactID: string}|ArtifactDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Artifact>
     *
     * @throws APIException
     */
    public function delete(
        array|ArtifactDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ArtifactDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);
        $artifactID = $parsed['artifactID'];
        unset($parsed['artifactID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['v1/machines/%1$s/artifacts/%2$s', $machineID, $artifactID],
            options: $options,
            convert: Artifact::class,
        );
    }
}
