<?php

declare(strict_types=1);

namespace Dedalus\Machines\SSH;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Create SSH session.
 *
 * @see Dedalus\Services\Machines\SSHService::create()
 *
 * @phpstan-type SSHCreateParamsShape = array{machineID: string, publicKey: string}
 */
final class SSHCreateParams implements BaseModel
{
    /** @use SdkModel<SSHCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    #[Required('public_key')]
    public string $publicKey;

    /**
     * `new SSHCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SSHCreateParams::with(machineID: ..., publicKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SSHCreateParams)->withMachineID(...)->withPublicKey(...)
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
    public static function with(string $machineID, string $publicKey): self
    {
        $self = new self;

        $self['machineID'] = $machineID;
        $self['publicKey'] = $publicKey;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }

    public function withPublicKey(string $publicKey): self
    {
        $self = clone $this;
        $self['publicKey'] = $publicKey;

        return $self;
    }
}
