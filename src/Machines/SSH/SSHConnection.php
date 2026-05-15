<?php

declare(strict_types=1);

namespace Dedalus\Machines\SSH;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type SSHHostTrustShape from \Dedalus\Machines\SSH\SSHHostTrust
 *
 * @phpstan-type SSHConnectionShape = array{
 *   endpoint: string,
 *   port: int,
 *   sshUsername: string,
 *   hostTrust?: null|SSHHostTrust|SSHHostTrustShape,
 *   userCertificate?: string|null,
 * }
 */
final class SSHConnection implements BaseModel
{
    /** @use SdkModel<SSHConnectionShape> */
    use SdkModel;

    #[Required]
    public string $endpoint;

    #[Required]
    public int $port;

    #[Required('ssh_username')]
    public string $sshUsername;

    #[Optional('host_trust')]
    public ?SSHHostTrust $hostTrust;

    #[Optional('user_certificate')]
    public ?string $userCertificate;

    /**
     * `new SSHConnection()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SSHConnection::with(endpoint: ..., port: ..., sshUsername: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SSHConnection)->withEndpoint(...)->withPort(...)->withSSHUsername(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param SSHHostTrust|SSHHostTrustShape|null $hostTrust
     */
    public static function with(
        string $endpoint,
        int $port,
        string $sshUsername,
        SSHHostTrust|array|null $hostTrust = null,
        ?string $userCertificate = null,
    ): self {
        $self = new self;

        $self['endpoint'] = $endpoint;
        $self['port'] = $port;
        $self['sshUsername'] = $sshUsername;

        null !== $hostTrust && $self['hostTrust'] = $hostTrust;
        null !== $userCertificate && $self['userCertificate'] = $userCertificate;

        return $self;
    }

    public function withEndpoint(string $endpoint): self
    {
        $self = clone $this;
        $self['endpoint'] = $endpoint;

        return $self;
    }

    public function withPort(int $port): self
    {
        $self = clone $this;
        $self['port'] = $port;

        return $self;
    }

    public function withSSHUsername(string $sshUsername): self
    {
        $self = clone $this;
        $self['sshUsername'] = $sshUsername;

        return $self;
    }

    /**
     * @param SSHHostTrust|SSHHostTrustShape $hostTrust
     */
    public function withHostTrust(SSHHostTrust|array $hostTrust): self
    {
        $self = clone $this;
        $self['hostTrust'] = $hostTrust;

        return $self;
    }

    public function withUserCertificate(string $userCertificate): self
    {
        $self = clone $this;
        $self['userCertificate'] = $userCertificate;

        return $self;
    }
}
