<?php

declare(strict_types=1);

namespace Dedalus\Machines;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Update machine.
 *
 * @see Dedalus\Services\MachinesService::update()
 *
 * @phpstan-type MachineUpdateParamsShape = array{
 *   machineID: string,
 *   autosleep?: string|null,
 *   memoryMiB?: int|null,
 *   storageGiB?: int|null,
 *   vcpu?: float|null,
 * }
 */
final class MachineUpdateParams implements BaseModel
{
    /** @use SdkModel<MachineUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    /**
     * Idle window before autosleep. Accepts fixed duration units like 30s, 30m, 2h, 7d3h4s, or 1w3d, raw seconds ("1800"), or never to disable.
     */
    #[Optional]
    public ?string $autosleep;

    /**
     * Memory in MiB.
     */
    #[Optional('memory_mib')]
    public ?int $memoryMiB;

    /**
     * Storage in GiB.
     */
    #[Optional('storage_gib')]
    public ?int $storageGiB;

    /**
     * CPU in vCPUs.
     */
    #[Optional]
    public ?float $vcpu;

    /**
     * `new MachineUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MachineUpdateParams::with(machineID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MachineUpdateParams)->withMachineID(...)
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
        ?string $autosleep = null,
        ?int $memoryMiB = null,
        ?int $storageGiB = null,
        ?float $vcpu = null,
    ): self {
        $self = new self;

        $self['machineID'] = $machineID;

        null !== $autosleep && $self['autosleep'] = $autosleep;
        null !== $memoryMiB && $self['memoryMiB'] = $memoryMiB;
        null !== $storageGiB && $self['storageGiB'] = $storageGiB;
        null !== $vcpu && $self['vcpu'] = $vcpu;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }

    /**
     * Idle window before autosleep. Accepts fixed duration units like 30s, 30m, 2h, 7d3h4s, or 1w3d, raw seconds ("1800"), or never to disable.
     */
    public function withAutosleep(string $autosleep): self
    {
        $self = clone $this;
        $self['autosleep'] = $autosleep;

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
     * Storage in GiB.
     */
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
