<?php

declare(strict_types=1);

namespace Dedalus\Machines\SSH;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Get SSH session.
 *
 * @see Dedalus\Services\Machines\SSHService::retrieve()
 *
 * @phpstan-type SSHRetrieveParamsShape = array{
 *   machineID: string, sessionID: string
 * }
 */
final class SSHRetrieveParams implements BaseModel
{
    /** @use SdkModel<SSHRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    #[Required]
    public string $sessionID;

    /**
     * `new SSHRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SSHRetrieveParams::with(machineID: ..., sessionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SSHRetrieveParams)->withMachineID(...)->withSessionID(...)
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
    public static function with(string $machineID, string $sessionID): self
    {
        $self = new self;

        $self['machineID'] = $machineID;
        $self['sessionID'] = $sessionID;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }

    public function withSessionID(string $sessionID): self
    {
        $self = clone $this;
        $self['sessionID'] = $sessionID;

        return $self;
    }
}
