<?php

declare(strict_types=1);

namespace Dedalus\Machines;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Sleep a running machine.
 *
 * @see Dedalus\Services\MachinesService::sleep()
 *
 * @phpstan-type MachineSleepParamsShape = array{machineID: string}
 */
final class MachineSleepParams implements BaseModel
{
    /** @use SdkModel<MachineSleepParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    /**
     * `new MachineSleepParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MachineSleepParams::with(machineID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MachineSleepParams)->withMachineID(...)
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
