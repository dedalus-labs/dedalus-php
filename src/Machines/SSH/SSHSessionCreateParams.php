<?php

declare(strict_types=1);

namespace Dedalus\Machines\SSH;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-type SSHSessionCreateParamsShape = array{publicKey: string}
 */
final class SSHSessionCreateParams implements BaseModel
{
    /** @use SdkModel<SSHSessionCreateParamsShape> */
    use SdkModel;

    #[Required('public_key')]
    public string $publicKey;

    /**
     * `new SSHSessionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SSHSessionCreateParams::with(publicKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SSHSessionCreateParams)->withPublicKey(...)
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
     */
    public static function with(string $publicKey): self
    {
        $self = new self;

        $self['publicKey'] = $publicKey;

        return $self;
    }

    public function withPublicKey(string $publicKey): self
    {
        $self = clone $this;
        $self['publicKey'] = $publicKey;

        return $self;
    }
}
