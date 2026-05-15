<?php

declare(strict_types=1);

namespace Dedalus;

use Dedalus\Core\BaseClient;
use Dedalus\Core\Implementation\StreamingHttpClient;
use Dedalus\Core\Util;
use Dedalus\Services\MachinesService;
use Dedalus\Services\UsageService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

/**
 * @phpstan-import-type NormalizedRequest from \Dedalus\Core\BaseClient
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
class Client extends BaseClient
{
    public string $apiKey;

    public string $xAPIKey;

    public string $dedalusOrgID;

    /**
     * @api
     */
    public UsageService $usage;

    /**
     * @api
     */
    public MachinesService $machines;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $apiKey = null,
        ?string $xAPIKey = null,
        ?string $dedalusOrgID = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->apiKey = (string) ($apiKey ?? Util::getenv('DEDALUS_API_KEY'));
        $this->xAPIKey = (string) ($xAPIKey ?? Util::getenv('DEDALUS_X_API_KEY'));
        $this->dedalusOrgID = (string) ($dedalusOrgID ?? Util::getenv(
            'DEDALUS_ORG_ID'
        ));

        $baseUrl ??= Util::getenv(
            'DEDALUS_BASE_URL'
        ) ?: 'https://dcs.dedaluslabs.ai';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        if (is_null($options->streamingTransporter)) {
            assert(!is_null($options->transporter));
            $options->streamingTransporter = new StreamingHttpClient($options->transporter);
        }

        /** @var array<string, string|null> $headers */
        $headers = [
            'X-Dedalus-Org-Id' => $this->dedalusOrgID,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => sprintf('Dedalus/PHP %s', VERSION),
            'X-Stainless-Lang' => 'php',
            'X-Stainless-Package-Version' => '0.0.1',
            'X-Stainless-Arch' => Util::machtype(),
            'X-Stainless-OS' => Util::ostype(),
            'X-Stainless-Runtime' => php_sapi_name(),
            'X-Stainless-Runtime-Version' => phpversion(),
        ];

        $customHeadersEnv = Util::getenv('DEDALUS_CUSTOM_HEADERS');
        if (null !== $customHeadersEnv) {
            foreach (explode("\n", $customHeadersEnv) as $line) {
                $colon = strpos($line, ':');
                if (false !== $colon) {
                    $headers[trim(substr($line, 0, $colon))] = trim(substr($line, $colon + 1));
                }
            }
        }

        parent::__construct(
            headers: $headers,
            baseUrl: $baseUrl,
            options: $options,
            idempotencyHeader: 'Idempotency-Key'
        );

        $this->usage = new UsageService($this);
        $this->machines = new MachinesService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return [...$this->apiKeyAuth(), ...$this->bearerAuth()];
    }

    /** @return array<string,string> */
    protected function apiKeyAuth(): array
    {
        return $this->xAPIKey ? ['x-api-key' => $this->xAPIKey] : [];
    }

    /** @return array<string,string> */
    protected function bearerAuth(): array
    {
        return $this->apiKey ? ['Authorization' => "Bearer {$this->apiKey}"] : [];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [...$this->authHeaders(), ...$headers],
            body: $body,
            opts: $opts,
        );
    }
}
