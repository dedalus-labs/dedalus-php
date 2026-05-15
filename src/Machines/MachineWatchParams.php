<?php

declare(strict_types=1);

namespace Dedalus\Machines;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Streams machine lifecycle updates over Server-Sent Events. Each `status` event contains a full `LifecycleResponse` payload. The stream closes after the machine reaches its current desired state.
 *
 * @see Dedalus\Services\MachinesService::watchStream()
 *
 * @phpstan-type MachineWatchParamsShape = array{
 *   machineID: string, lastEventID?: string|null
 * }
 */
final class MachineWatchParams implements BaseModel
{
    /** @use SdkModel<MachineWatchParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    #[Optional]
    public ?string $lastEventID;

    /**
     * `new MachineWatchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MachineWatchParams::with(machineID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MachineWatchParams)->withMachineID(...)
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
    public static function with(
        string $machineID,
        ?string $lastEventID = null
    ): self {
        $self = new self;

        $self['machineID'] = $machineID;

        null !== $lastEventID && $self['lastEventID'] = $lastEventID;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }

    public function withLastEventID(string $lastEventID): self
    {
        $self = clone $this;
        $self['lastEventID'] = $lastEventID;

        return $self;
    }
}
