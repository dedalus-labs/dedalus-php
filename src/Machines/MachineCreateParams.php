<?php

declare(strict_types=1);

namespace Dedalus\Machines;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Create machine.
 *
 * @see Dedalus\Services\MachinesService::create()
 *
 * @phpstan-type MachineCreateParamsShape = array{
 *   autosleep?: string|null,
 *   memoryMiB?: int|null,
 *   storageGiB?: int|null,
 *   vcpu?: float|null,
 * }
 */
final class MachineCreateParams implements BaseModel
{
    /** @use SdkModel<MachineCreateParamsShape> */
    use SdkModel;
    use SdkParams;

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
        ?string $autosleep = null,
        ?int $memoryMiB = null,
        ?int $storageGiB = null,
        ?float $vcpu = null,
    ): self {
        $self = new self;

        null !== $autosleep && $self['autosleep'] = $autosleep;
        null !== $memoryMiB && $self['memoryMiB'] = $memoryMiB;
        null !== $storageGiB && $self['storageGiB'] = $storageGiB;
        null !== $vcpu && $self['vcpu'] = $vcpu;

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
