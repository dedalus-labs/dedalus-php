<?php

declare(strict_types=1);

namespace Dedalus\Services\Machines;

use Dedalus\Client;
use Dedalus\Core\Contracts\BaseResponse;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\SSH\SSHCreateParams;
use Dedalus\Machines\SSH\SSHDeleteParams;
use Dedalus\Machines\SSH\SSHListParams;
use Dedalus\Machines\SSH\SSHRetrieveParams;
use Dedalus\Machines\SSH\SSHSession;
use Dedalus\RequestOptions;
use Dedalus\ServiceContracts\Machines\SSHRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
final class SSHRawService implements SSHRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create SSH session
     *
     * @param array{machineID: string, publicKey: string}|SSHCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SSHSession>
     *
     * @throws APIException
     */
    public function create(
        array|SSHCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SSHCreateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/machines/%1$s/ssh', $machineID],
            body: (object) array_diff_key($parsed, array_flip(['machineID'])),
            options: $options,
            convert: SSHSession::class,
        );
    }

    /**
     * @api
     *
     * Get SSH session
     *
     * @param array{machineID: string, sessionID: string}|SSHRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SSHSession>
     *
     * @throws APIException
     */
    public function retrieve(
        array|SSHRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SSHRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);
        $sessionID = $parsed['sessionID'];
        unset($parsed['sessionID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/machines/%1$s/ssh/%2$s', $machineID, $sessionID],
            options: $options,
            convert: SSHSession::class,
        );
    }

    /**
     * @api
     *
     * List SSH sessions
     *
     * @param array{
     *   machineID: string, cursor?: string, limit?: int
     * }|SSHListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorPage<SSHSession>>
     *
     * @throws APIException
     */
    public function list(
        array|SSHListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SSHListParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/machines/%1$s/ssh', $machineID],
            query: $parsed,
            options: $options,
            convert: SSHSession::class,
            page: CursorPage::class,
        );
    }

    /**
     * @api
     *
     * Delete SSH session
     *
     * @param array{machineID: string, sessionID: string}|SSHDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SSHSession>
     *
     * @throws APIException
     */
    public function delete(
        array|SSHDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SSHDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $machineID = $parsed['machineID'];
        unset($parsed['machineID']);
        $sessionID = $parsed['sessionID'];
        unset($parsed['sessionID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['v1/machines/%1$s/ssh/%2$s', $machineID, $sessionID],
            options: $options,
            convert: SSHSession::class,
        );
    }
}
