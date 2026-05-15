<?php

declare(strict_types=1);

namespace Dedalus\Machines;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Wake a sleeping machine.
 *
 * @see Dedalus\Services\MachinesService::wake()
 *
 * @phpstan-type MachineWakeParamsShape = array{machineID: string}
 */
final class MachineWakeParams implements BaseModel
{
    /** @use SdkModel<MachineWakeParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    /**
     * `new MachineWakeParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MachineWakeParams::with(machineID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MachineWakeParams)->withMachineID(...)
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
    public static function with(string $machineID): self
    {
        $self = new self;

        $self['machineID'] = $machineID;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }
}
