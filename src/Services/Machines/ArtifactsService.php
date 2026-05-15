<?php

declare(strict_types=1);

namespace Dedalus\Services\Machines;

use Dedalus\Client;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\Core\Util;
use Dedalus\CursorPage;
use Dedalus\Machines\Artifacts\Artifact;
use Dedalus\RequestOptions;
use Dedalus\ServiceContracts\Machines\ArtifactsContract;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
final class ArtifactsService implements ArtifactsContract
{
    /**
     * @api
     */
    public ArtifactsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ArtifactsRawService($client);
    }

    /**
     * @api
     *
     * Get artifact
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $machineID,
        string $artifactID,
        RequestOptions|array|null $requestOptions = null,
    ): Artifact {
        $params = Util::removeNulls(
            ['machineID' => $machineID, 'artifactID' => $artifactID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List artifacts
     *
     * @param string $machineID Path param
     * @param string $cursor Query param
     * @param int $limit Query param
     * @param RequestOpts|null $requestOptions
     *
     * @return CursorPage<Artifact>
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
     * Delete artifact
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $machineID,
        string $artifactID,
        RequestOptions|array|null $requestOptions = null,
    ): Artifact {
        $params = Util::removeNulls(
            ['machineID' => $machineID, 'artifactID' => $artifactID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
