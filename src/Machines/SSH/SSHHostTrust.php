<?php

declare(strict_types=1);

namespace Dedalus\Machines\SSH;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\SSH\SSHHostTrust\Kind;

/**
 * @phpstan-type SSHHostTrustShape = array{
 *   hostPattern: string, kind: Kind|value-of<Kind>, publicKey: string
 * }
 */
final class SSHHostTrust implements BaseModel
{
    /** @use SdkModel<SSHHostTrustShape> */
    use SdkModel;

    #[Required('host_pattern')]
    public string $hostPattern;

    /** @var value-of<Kind> $kind */
    #[Required(enum: Kind::class)]
    public string $kind;

    #[Required('public_key')]
    public string $publicKey;

    /**
     * `new SSHHostTrust()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SSHHostTrust::with(hostPattern: ..., kind: ..., publicKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SSHHostTrust)->withHostPattern(...)->withKind(...)->withPublicKey(...)
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
     * @param Kind|value-of<Kind> $kind
     */
    public static function with(
        string $hostPattern,
        Kind|string $kind,
        string $publicKey
    ): self {
        $self = new self;

        $self['hostPattern'] = $hostPattern;
        $self['kind'] = $kind;
        $self['publicKey'] = $publicKey;

        return $self;
    }

    public function withHostPattern(string $hostPattern): self
    {
        $self = clone $this;
        $self['hostPattern'] = $hostPattern;

        return $self;
    }

    /**
     * @param Kind|value-of<Kind> $kind
     */
    public function withKind(Kind|string $kind): self
    {
        $self = clone $this;
        $self['kind'] = $kind;

        return $self;
    }

    public function withPublicKey(string $publicKey): self
    {
        $self = clone $this;
        $self['publicKey'] = $publicKey;

        return $self;
    }
}
