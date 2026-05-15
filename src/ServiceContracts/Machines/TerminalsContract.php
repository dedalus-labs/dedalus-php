<?php

declare(strict_types=1);

namespace Dedalus\ServiceContracts\Machines;

use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\Terminals\Terminal;
use Dedalus\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
interface TerminalsContract
{
    /**
     * @api
     *
     * @param string $machineID Path param
     * @param int $height Body param
     * @param int $width Body param
     * @param string $cwd Body param
     * @param array<string,string> $env Body param
     * @param string $shell Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $machineID,
        int $height,
        int $width,
        ?string $cwd = null,
        ?array $env = null,
        ?string $shell = null,
        RequestOptions|array|null $requestOptions = null,
    ): Terminal;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $machineID,
        string $terminalID,
        RequestOptions|array|null $requestOptions = null,
    ): Terminal;

    /**
     * @api
     *
     * @param string $machineID Path param
     * @param string $cursor Query param
     * @param int $limit Query param
     * @param RequestOpts|null $requestOptions
     *
     * @return CursorPage<Terminal>
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
        string $terminalID,
        RequestOptions|array|null $requestOptions = null,
    ): Terminal;
}
