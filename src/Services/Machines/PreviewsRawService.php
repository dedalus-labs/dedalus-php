<?php

declare(strict_types=1);

namespace Dedalus\Services\Machines;

use Dedalus\Client;
use Dedalus\Core\Contracts\BaseResponse;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\Previews\Preview;
use Dedalus\Machines\Previews\PreviewCreateParams1 as PreviewCreateParams;
use Dedalus\Machines\Previews\PreviewCreateParams1\Protocol;
use Dedalus\Machines\Previews\PreviewCreateParams1\Visibility;
use Dedalus\Machines\Previews\PreviewDeleteParams;
use Dedalus\Machines\Previews\PreviewListParams;
use Dedalus\Machines\Previews\PreviewRetrieveParams;
use Dedalus\RequestOptions;
use Dedalus\ServiceContracts\Machines\PreviewsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
final class PreviewsRawService implements PreviewsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create preview
     *
     * @param array{
     *   machineID: string,
     *   port: int,
     *   protocol?: Protocol|value-of<Protocol>,
     *   visibility?: Visibility|value-of<Visibility>,
     * }|PreviewCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Preview>
     *
     * @throws APIException
     */
    public function create(
        array|PreviewCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PreviewCreateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/machines/%1$s/previews', $machineID],
            body: (object) array_diff_key($parsed, array_flip(['machineID'])),
            options: $options,
            convert: Preview::class,
        );
    }

    /**
     * @api
     *
     * Get preview
     *
     * @param array{machineID: string, previewID: string}|PreviewRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Preview>
     *
     * @throws APIException
     */
    public function retrieve(
        array|PreviewRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PreviewRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);
        $previewID = $parsed['previewID'];
        unset($parsed['previewID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/machines/%1$s/previews/%2$s', $machineID, $previewID],
            options: $options,
            convert: Preview::class,
        );
    }

    /**
     * @api
     *
     * List previews
     *
     * @param array{
     *   machineID: string, cursor?: string, limit?: int
     * }|PreviewListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorPage<Preview>>
     *
     * @throws APIException
     */
    public function list(
        array|PreviewListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PreviewListParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/machines/%1$s/previews', $machineID],
            query: $parsed,
            options: $options,
            convert: Preview::class,
            page: CursorPage::class,
        );
    }

    /**
     * @api
     *
     * Delete preview
     *
     * @param array{machineID: string, previewID: string}|PreviewDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Preview>
     *
     * @throws APIException
     */
    public function delete(
        array|PreviewDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PreviewDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);
        $previewID = $parsed['previewID'];
        unset($parsed['previewID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['v1/machines/%1$s/previews/%2$s', $machineID, $previewID],
            options: $options,
            convert: Preview::class,
        );
    }
}
