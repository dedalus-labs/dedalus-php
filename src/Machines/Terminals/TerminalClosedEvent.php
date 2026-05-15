<?php

declare(strict_types=1);

namespace Dedalus\Machines\Terminals;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\Terminals\TerminalClosedEvent\Type;

/**
 * @phpstan-type TerminalClosedEventShape = array{type: Type|value-of<Type>}
 */
final class TerminalClosedEvent implements BaseModel
{
    /** @use SdkModel<TerminalClosedEventShape> */
    use SdkModel;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new TerminalClosedEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TerminalClosedEvent::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TerminalClosedEvent)->withType(...)
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
    public static function with(Type|string $type): self
    {
        $self = new self;

        $self['type'] = $type;

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
}
