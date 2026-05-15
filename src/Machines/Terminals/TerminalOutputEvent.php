<?php

declare(strict_types=1);

namespace Dedalus\Machines\Terminals;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\Terminals\TerminalOutputEvent\Type;

/**
 * @phpstan-type TerminalOutputEventShape = array{
 *   data: string, type: Type|value-of<Type>
 * }
 */
final class TerminalOutputEvent implements BaseModel
{
    /** @use SdkModel<TerminalOutputEventShape> */
    use SdkModel;

    /**
     * Base64-encoded terminal output.
     */
    #[Required]
    public string $data;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new TerminalOutputEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TerminalOutputEvent::with(data: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TerminalOutputEvent)->withData(...)->withType(...)
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
    public static function with(string $data, Type|string $type): self
    {
        $self = new self;

        $self['data'] = $data;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Base64-encoded terminal output.
     */
    public function withData(string $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

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
