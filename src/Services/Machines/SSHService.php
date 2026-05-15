<?php

declare(strict_types=1);

namespace Dedalus\Services\Machines;

use Dedalus\Client;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\Core\Util;
use Dedalus\CursorPage;
use Dedalus\Machines\SSH\SSHSession;
use Dedalus\RequestOptions;
use Dedalus\ServiceContracts\Machines\SSHContract;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
final class SSHService implements SSHContract
{
    /**
     * @api
     */
    public SSHRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SSHRawService($client);
    }

    /**
     * @api
     *
     * Create SSH session
     *
     * @param string $machineID Path param
     * @param string $publicKey Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $machineID,
        string $publicKey,
        RequestOptions|array|null $requestOptions = null,
    ): SSHSession {
        $params = Util::removeNulls(
            ['machineID' => $machineID, 'publicKey' => $publicKey]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get SSH session
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $machineID,
        string $sessionID,
        RequestOptions|array|null $requestOptions = null,
    ): SSHSession {
        $params = Util::removeNulls(
            ['machineID' => $machineID, 'sessionID' => $sessionID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List SSH sessions
     *
     * @param string $machineID Path param
     * @param string $cursor Query param
     * @param int $limit Query param
     * @param RequestOpts|null $requestOptions
     *
     * @return CursorPage<SSHSession>
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
     * Delete SSH session
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $machineID,
        string $sessionID,
        RequestOptions|array|null $requestOptions = null,
    ): SSHSession {
        $params = Util::removeNulls(
            ['machineID' => $machineID, 'sessionID' => $sessionID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
