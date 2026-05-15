<?php

declare(strict_types=1);

namespace Dedalus\Machines;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Destroy machine.
 *
 * @see Dedalus\Services\MachinesService::delete()
 *
 * @phpstan-type MachineDeleteParamsShape = array{machineID: string}
 */
final class MachineDeleteParams implements BaseModel
{
    /** @use SdkModel<MachineDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    /**
     * `new MachineDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MachineDeleteParams::with(machineID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MachineDeleteParams)->withMachineID(...)
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
