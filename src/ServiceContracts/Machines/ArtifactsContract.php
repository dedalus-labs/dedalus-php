<?php

declare(strict_types=1);

namespace Dedalus\ServiceContracts\Machines;

use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\Artifacts\Artifact;
use Dedalus\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
interface ArtifactsContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $machineID,
        string $artifactID,
        RequestOptions|array|null $requestOptions = null,
    ): Artifact;

    /**
     * @api
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
    ): CursorPage;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $machineID,
        string $artifactID,
        RequestOptions|array|null $requestOptions = null,
    ): Artifact;
}
