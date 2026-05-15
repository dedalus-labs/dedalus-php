<?php

declare(strict_types=1);

namespace Dedalus\Machines\Terminals;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\Terminals\TerminalResizeEvent\Type;

/**
 * @phpstan-type TerminalResizeEventShape = array{
 *   height: int, type: Type|value-of<Type>, width: int
 * }
 */
final class TerminalResizeEvent implements BaseModel
{
    /** @use SdkModel<TerminalResizeEventShape> */
    use SdkModel;

    #[Required]
    public int $height;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Required]
    public int $width;

    /**
     * `new TerminalResizeEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TerminalResizeEvent::with(height: ..., type: ..., width: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TerminalResizeEvent)->withHeight(...)->withType(...)->withWidth(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        int $height,
        Type|string $type,
        int $width
    ): self {
        $self = new self;

        $self['height'] = $height;
        $self['type'] = $type;
        $self['width'] = $width;

        return $self;
    }

    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
