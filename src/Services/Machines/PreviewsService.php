<?php

declare(strict_types=1);

namespace Dedalus\Services\Machines;

use Dedalus\Client;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\Core\Util;
use Dedalus\CursorPage;
use Dedalus\Machines\Previews\Preview;
use Dedalus\Machines\Previews\PreviewCreateParams1\Protocol;
use Dedalus\Machines\Previews\PreviewCreateParams1\Visibility;
use Dedalus\RequestOptions;
use Dedalus\ServiceContracts\Machines\PreviewsContract;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
final class PreviewsService implements PreviewsContract
{
    /**
     * @api
     */
    public PreviewsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PreviewsRawService($client);
    }

    /**
     * @api
     *
     * Create preview
     *
     * @param string $machineID Path param
     * @param int $port Body param
     * @param Protocol|value-of<Protocol> $protocol Body param
     * @param Visibility|value-of<Visibility> $visibility Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $machineID,
        int $port,
        Protocol|string|null $protocol = null,
        Visibility|string|null $visibility = null,
        RequestOptions|array|null $requestOptions = null,
    ): Preview {
        $params = Util::removeNulls(
            [
                'machineID' => $machineID,
                'port' => $port,
                'protocol' => $protocol,
                'visibility' => $visibility,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get preview
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $machineID,
        string $previewID,
        RequestOptions|array|null $requestOptions = null,
    ): Preview {
        $params = Util::removeNulls(
            ['machineID' => $machineID, 'previewID' => $previewID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List previews
     *
     * @param string $machineID Path param
     * @param string $cursor Query param
     * @param int $limit Query param
     * @param RequestOpts|null $requestOptions
     *
     * @return CursorPage<Preview>
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
     * Delete preview
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $machineID,
        string $previewID,
        RequestOptions|array|null $requestOptions = null,
    ): Preview {
        $params = Util::removeNulls(
            ['machineID' => $machineID, 'previewID' => $previewID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
