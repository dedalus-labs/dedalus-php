<?php

declare(strict_types=1);

namespace Dedalus\Services\Machines;

use Dedalus\Client;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\Core\Util;
use Dedalus\CursorPage;
use Dedalus\Machines\Terminals\Terminal;
use Dedalus\RequestOptions;
use Dedalus\ServiceContracts\Machines\TerminalsContract;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
final class TerminalsService implements TerminalsContract
{
    /**
     * @api
     */
    public TerminalsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TerminalsRawService($client);
    }

    /**
     * @api
     *
     * Create terminal
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
    ): Terminal {
        $params = Util::removeNulls(
            [
                'machineID' => $machineID,
                'height' => $height,
                'width' => $width,
                'cwd' => $cwd,
                'env' => $env,
                'shell' => $shell,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get terminal
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $machineID,
        string $terminalID,
        RequestOptions|array|null $requestOptions = null,
    ): Terminal {
        $params = Util::removeNulls(
            ['machineID' => $machineID, 'terminalID' => $terminalID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List terminals
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
     * Delete terminal
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $machineID,
        string $terminalID,
        RequestOptions|array|null $requestOptions = null,
    ): Terminal {
        $params = Util::removeNulls(
            ['machineID' => $machineID, 'terminalID' => $terminalID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
