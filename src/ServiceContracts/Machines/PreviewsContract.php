<?php

declare(strict_types=1);

namespace Dedalus\ServiceContracts\Machines;

use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\Previews\Preview;
use Dedalus\Machines\Previews\PreviewCreateParams1\Protocol;
use Dedalus\Machines\Previews\PreviewCreateParams1\Visibility;
use Dedalus\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
interface PreviewsContract
{
    /**
     * @api
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
    ): Preview;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $machineID,
        string $previewID,
        RequestOptions|array|null $requestOptions = null,
    ): Preview;

    /**
     * @api
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
        string $previewID,
        RequestOptions|array|null $requestOptions = null,
    ): Preview;
}
