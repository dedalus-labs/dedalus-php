<?php

declare(strict_types=1);

namespace Dedalus\Machines\Terminals;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\Terminals\TerminalInputEvent\Type;

/**
 * @phpstan-type TerminalInputEventShape = array{
 *   data: string, type: Type|value-of<Type>
 * }
 */
final class TerminalInputEvent implements BaseModel
{
    /** @use SdkModel<TerminalInputEventShape> */
    use SdkModel;

    /**
     * Base64-encoded terminal input.
     */
    #[Required]
    public string $data;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new TerminalInputEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TerminalInputEvent::with(data: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TerminalInputEvent)->withData(...)->withType(...)
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
     * Base64-encoded terminal input.
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
