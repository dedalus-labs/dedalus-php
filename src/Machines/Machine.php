<?php

declare(strict_types=1);

namespace Dedalus\Machines;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\Machine\DesiredState;
use Dedalus\Machines\Machine\Phase;

/**
 * @phpstan-type MachineShape = array{
 *   autosleepSeconds: int,
 *   desiredState: DesiredState|value-of<DesiredState>,
 *   machineID: string,
 *   memoryMiB: int,
 *   phase: Phase|value-of<Phase>,
 *   storageGiB: int,
 *   vcpu: float,
 * }
 */
final class Machine implements BaseModel
{
    /** @use SdkModel<MachineShape> */
    use SdkModel;

    /**
     * Seconds of inactivity before autosleep. 0 disables autosleep.
     */
    #[Required('autosleep_seconds')]
    public int $autosleepSeconds;

    /** @var value-of<DesiredState> $desiredState */
    #[Required('desired_state', enum: DesiredState::class)]
    public string $desiredState;

    #[Required('machine_id')]
    public string $machineID;

    /**
     * Memory in MiB.
     */
    #[Required('memory_mib')]
    public int $memoryMiB;

    /** @var value-of<Phase> $phase */
    #[Required(enum: Phase::class)]
    public string $phase;

    #[Required('storage_gib')]
    public int $storageGiB;

    /**
     * CPU in vCPUs.
     */
    #[Required]
    public float $vcpu;

    /**
     * `new Machine()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Machine::with(
     *   autosleepSeconds: ...,
     *   desiredState: ...,
     *   machineID: ...,
     *   memoryMiB: ...,
     *   phase: ...,
     *   storageGiB: ...,
     *   vcpu: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Machine)
     *   ->withAutosleepSeconds(...)
     *   ->withDesiredState(...)
     *   ->withMachineID(...)
     *   ->withMemoryMiB(...)
     *   ->withPhase(...)
     *   ->withStorageGiB(...)
     *   ->withVCPU(...)
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
     * @param DesiredState|value-of<DesiredState> $desiredState
     * @param Phase|value-of<Phase> $phase
     */
    public static function with(
        int $autosleepSeconds,
        DesiredState|string $desiredState,
        string $machineID,
        int $memoryMiB,
        Phase|string $phase,
        int $storageGiB,
        float $vcpu,
    ): self {
        $self = new self;

        $self['autosleepSeconds'] = $autosleepSeconds;
        $self['desiredState'] = $desiredState;
        $self['machineID'] = $machineID;
        $self['memoryMiB'] = $memoryMiB;
        $self['phase'] = $phase;
        $self['storageGiB'] = $storageGiB;
        $self['vcpu'] = $vcpu;

        return $self;
    }

    /**
     * Seconds of inactivity before autosleep. 0 disables autosleep.
     */
    public function withAutosleepSeconds(int $autosleepSeconds): self
    {
        $self = clone $this;
        $self['autosleepSeconds'] = $autosleepSeconds;

        return $self;
    }

    /**
     * @param DesiredState|value-of<DesiredState> $desiredState
     */
    public function withDesiredState(DesiredState|string $desiredState): self
    {
        $self = clone $this;
        $self['desiredState'] = $desiredState;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }

    /**
     * Memory in MiB.
     */
    public function withMemoryMiB(int $memoryMiB): self
    {
        $self = clone $this;
        $self['memoryMiB'] = $memoryMiB;

        return $self;
    }

    /**
     * @param Phase|value-of<Phase> $phase
     */
    public function withPhase(Phase|string $phase): self
    {
        $self = clone $this;
        $self['phase'] = $phase;

        return $self;
    }

    public function withStorageGiB(int $storageGiB): self
    {
        $self = clone $this;
        $self['storageGiB'] = $storageGiB;

        return $self;
    }

    /**
     * CPU in vCPUs.
     */
    public function withVCPU(float $vcpu): self
    {
        $self = clone $this;
        $self['vcpu'] = $vcpu;

        return $self;
    }
}
