<?php

declare(strict_types=1);

namespace Dedalus\Machines;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\MachineGetResponse\DesiredState;

/**
 * @phpstan-import-type LifecycleStatusShape from \Dedalus\Machines\LifecycleStatus
 *
 * @phpstan-type MachineGetResponseShape = array{
 *   autosleepSeconds: int,
 *   desiredState: DesiredState|value-of<DesiredState>,
 *   machineID: string,
 *   memoryMiB: int,
 *   status: LifecycleStatus|LifecycleStatusShape,
 *   storageGiB: int,
 *   vcpu: float,
 * }
 */
final class MachineGetResponse implements BaseModel
{
    /** @use SdkModel<MachineGetResponseShape> */
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

    #[Required]
    public LifecycleStatus $status;

    #[Required('storage_gib')]
    public int $storageGiB;

    /**
     * CPU in vCPUs.
     */
    #[Required]
    public float $vcpu;

    /**
     * `new MachineGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MachineGetResponse::with(
     *   autosleepSeconds: ...,
     *   desiredState: ...,
     *   machineID: ...,
     *   memoryMiB: ...,
     *   status: ...,
     *   storageGiB: ...,
     *   vcpu: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MachineGetResponse)
     *   ->withAutosleepSeconds(...)
     *   ->withDesiredState(...)
     *   ->withMachineID(...)
     *   ->withMemoryMiB(...)
     *   ->withStatus(...)
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
     * @param LifecycleStatus|LifecycleStatusShape $status
     */
    public static function with(
        int $autosleepSeconds,
        DesiredState|string $desiredState,
        string $machineID,
        int $memoryMiB,
        LifecycleStatus|array $status,
        int $storageGiB,
        float $vcpu,
    ): self {
        $self = new self;

        $self['autosleepSeconds'] = $autosleepSeconds;
        $self['desiredState'] = $desiredState;
        $self['machineID'] = $machineID;
        $self['memoryMiB'] = $memoryMiB;
        $self['status'] = $status;
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
     * @param LifecycleStatus|LifecycleStatusShape $status
     */
    public function withStatus(LifecycleStatus|array $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

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
