<?php

declare(strict_types=1);

namespace Dedalus\Machines\Previews;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\Previews\PreviewCreateParams\Protocol;
use Dedalus\Machines\Previews\PreviewCreateParams\Visibility;

/**
 * @phpstan-type PreviewCreateParamsShape = array{
 *   port: int,
 *   protocol?: null|Protocol|value-of<Protocol>,
 *   visibility?: null|Visibility|value-of<Visibility>,
 * }
 */
final class PreviewCreateParams implements BaseModel
{
    /** @use SdkModel<PreviewCreateParamsShape> */
    use SdkModel;

    #[Required]
    public int $port;

    /** @var value-of<Protocol>|null $protocol */
    #[Optional(enum: Protocol::class)]
    public ?string $protocol;

    /** @var value-of<Visibility>|null $visibility */
    #[Optional(enum: Visibility::class)]
    public ?string $visibility;

    /**
     * `new PreviewCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreviewCreateParams::with(port: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreviewCreateParams)->withPort(...)
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
        int $port,
        Protocol|string|null $protocol = null,
        Visibility|string|null $visibility = null,
    ): self {
        $self = new self;

        $self['port'] = $port;

        null !== $protocol && $self['protocol'] = $protocol;
        null !== $visibility && $self['visibility'] = $visibility;

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
