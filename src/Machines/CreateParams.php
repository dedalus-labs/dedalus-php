<?php

declare(strict_types=1);

namespace Dedalus\Machines;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-type CreateParamsShape = array{
 *   memoryMiB: int, storageGiB: int, vcpu: float, autosleep?: string|null
 * }
 */
final class CreateParams implements BaseModel
{
    /** @use SdkModel<CreateParamsShape> */
    use SdkModel;

    /**
     * Memory in MiB.
     */
    #[Required('memory_mib')]
    public int $memoryMiB;

    /**
     * Storage in GiB.
     */
    #[Required('storage_gib')]
    public int $storageGiB;

    /**
     * CPU in vCPUs.
     */
    #[Required]
    public float $vcpu;

    /**
     * Idle window before autosleep. Accepts fixed duration units like 30s, 30m, 2h, 7d3h4s, or 1w3d, raw seconds ("1800"), or never to disable.
     */
    #[Optional]
    public ?string $autosleep;

    /**
     * `new CreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreateParams::with(memoryMiB: ..., storageGiB: ..., vcpu: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreateParams)->withMemoryMiB(...)->withStorageGiB(...)->withVCPU(...)
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
        int $memoryMiB,
        int $storageGiB,
        float $vcpu,
        ?string $autosleep = null
    ): self {
        $self = new self;

        $self['memoryMiB'] = $memoryMiB;
        $self['storageGiB'] = $storageGiB;
        $self['vcpu'] = $vcpu;

        null !== $autosleep && $self['autosleep'] = $autosleep;

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

    /**
     * Idle window before autosleep. Accepts fixed duration units like 30s, 30m, 2h, 7d3h4s, or 1w3d, raw seconds ("1800"), or never to disable.
     */
    public function withAutosleep(string $autosleep): self
    {
        $self = clone $this;
        $self['autosleep'] = $autosleep;

        return $self;
    }
}
