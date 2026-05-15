<?php

declare(strict_types=1);

namespace Dedalus\Services\Machines;

use Dedalus\Client;
use Dedalus\Core\Contracts\BaseResponse;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\Terminals\Terminal;
use Dedalus\Machines\Terminals\TerminalCreateParams1 as TerminalCreateParams;
use Dedalus\Machines\Terminals\TerminalDeleteParams;
use Dedalus\Machines\Terminals\TerminalListParams;
use Dedalus\Machines\Terminals\TerminalRetrieveParams;
use Dedalus\RequestOptions;
use Dedalus\ServiceContracts\Machines\TerminalsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
final class TerminalsRawService implements TerminalsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create terminal
     *
     * @param array{
     *   machineID: string,
     *   height: int,
     *   width: int,
     *   cwd?: string,
     *   env?: array<string,string>,
     *   shell?: string,
     * }|TerminalCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Terminal>
     *
     * @throws APIException
     */
    public function create(
        array|TerminalCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TerminalCreateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/machines/%1$s/terminals', $machineID],
            body: (object) array_diff_key($parsed, array_flip(['machineID'])),
            options: $options,
            convert: Terminal::class,
        );
    }

    /**
     * @api
     *
     * Get terminal
     *
     * @param array{
     *   machineID: string, terminalID: string
     * }|TerminalRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Terminal>
     *
     * @throws APIException
     */
    public function retrieve(
        array|TerminalRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TerminalRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);
        $terminalID = $parsed['terminalID'];
        unset($parsed['terminalID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/machines/%1$s/terminals/%2$s', $machineID, $terminalID],
            options: $options,
            convert: Terminal::class,
        );
    }

    /**
     * @api
     *
     * List terminals
     *
     * @param array{
     *   machineID: string, cursor?: string, limit?: int
     * }|TerminalListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorPage<Terminal>>
     *
     * @throws APIException
     */
    public function list(
        array|TerminalListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TerminalListParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/machines/%1$s/terminals', $machineID],
            query: $parsed,
            options: $options,
            convert: Terminal::class,
            page: CursorPage::class,
        );
    }

    /**
     * @api
     *
     * Delete terminal
     *
     * @param array{machineID: string, terminalID: string}|TerminalDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Terminal>
     *
     * @throws APIException
     */
    public function delete(
        array|TerminalDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TerminalDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);
        $terminalID = $parsed['terminalID'];
        unset($parsed['terminalID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['v1/machines/%1$s/terminals/%2$s', $machineID, $terminalID],
            options: $options,
            convert: Terminal::class,
        );
    }
}
