<?php

declare(strict_types=1);

namespace Dedalus\Machines\Previews;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\Previews\PreviewCreateParams1\Protocol;
use Dedalus\Machines\Previews\PreviewCreateParams1\Visibility;

/**
 * Create preview.
 *
 * @see Dedalus\Services\Machines\PreviewsService::create()
 *
 * @phpstan-type PreviewCreateParams1Shape = array{
 *   machineID: string,
 *   port: int,
 *   protocol?: null|Protocol|value-of<Protocol>,
 *   visibility?: null|Visibility|value-of<Visibility>,
 * }
 */
final class PreviewCreateParams1 implements BaseModel
{
    /** @use SdkModel<PreviewCreateParams1Shape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    #[Required]
    public int $port;

    /** @var value-of<Protocol>|null $protocol */
    #[Optional(enum: Protocol::class)]
    public ?string $protocol;

    /** @var value-of<Visibility>|null $visibility */
    #[Optional(enum: Visibility::class)]
    public ?string $visibility;

    /**
     * `new PreviewCreateParams1()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreviewCreateParams1::with(machineID: ..., port: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreviewCreateParams1)->withMachineID(...)->withPort(...)
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
     * @param Protocol|value-of<Protocol>|null $protocol
     * @param Visibility|value-of<Visibility>|null $visibility
     */
    public static function with(
        string $machineID,
        int $port,
        Protocol|string|null $protocol = null,
        Visibility|string|null $visibility = null,
    ): self {
        $self = new self;

        $self['machineID'] = $machineID;
        $self['port'] = $port;

        null !== $protocol && $self['protocol'] = $protocol;
        null !== $visibility && $self['visibility'] = $visibility;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }

    public function withPort(int $port): self
    {
        $self = clone $this;
        $self['port'] = $port;

        return $self;
    }

    /**
     * @param Protocol|value-of<Protocol> $protocol
     */
    public function withProtocol(Protocol|string $protocol): self
    {
        $self = clone $this;
        $self['protocol'] = $protocol;

        return $self;
    }

    /**
     * @param Visibility|value-of<Visibility> $visibility
     */
    public function withVisibility(Visibility|string $visibility): self
    {
        $self = clone $this;
        $self['visibility'] = $visibility;

        return $self;
    }
}
