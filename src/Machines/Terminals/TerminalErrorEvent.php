<?php

declare(strict_types=1);

namespace Dedalus\Machines\Terminals;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\Terminals\TerminalErrorEvent\Type;

/**
 * @phpstan-type TerminalErrorEventShape = array{
 *   type: Type|value-of<Type>, errorCode?: string|null, errorMessage?: string|null
 * }
 */
final class TerminalErrorEvent implements BaseModel
{
    /** @use SdkModel<TerminalErrorEventShape> */
    use SdkModel;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional('error_code')]
    public ?string $errorCode;

    #[Optional('error_message')]
    public ?string $errorMessage;

    /**
     * `new TerminalErrorEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TerminalErrorEvent::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TerminalErrorEvent)->withType(...)
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
        Type|string $type,
        ?string $errorCode = null,
        ?string $errorMessage = null
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $errorCode && $self['errorCode'] = $errorCode;
        null !== $errorMessage && $self['errorMessage'] = $errorMessage;

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

    public function withErrorCode(string $errorCode): self
    {
        $self = clone $this;
        $self['errorCode'] = $errorCode;

        return $self;
    }

    public function withErrorMessage(string $errorMessage): self
    {
        $self = clone $this;
        $self['errorMessage'] = $errorMessage;

        return $self;
    }
}
