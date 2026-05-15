<?php

declare(strict_types=1);

namespace Dedalus\Machines\Executions;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\Executions\ExecutionEvent\Status;
use Dedalus\Machines\Executions\ExecutionEvent\Type;

/**
 * @phpstan-type ExecutionEventShape = array{
 *   at: \DateTimeInterface,
 *   sequence: int,
 *   type: Type|value-of<Type>,
 *   chunk?: string|null,
 *   errorCode?: string|null,
 *   errorMessage?: string|null,
 *   exitCode?: int|null,
 *   signal?: int|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class ExecutionEvent implements BaseModel
{
    /** @use SdkModel<ExecutionEventShape> */
    use SdkModel;

    #[Required]
    public \DateTimeInterface $at;

    #[Required]
    public int $sequence;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional]
    public ?string $chunk;

    #[Optional('error_code')]
    public ?string $errorCode;

    #[Optional('error_message')]
    public ?string $errorMessage;

    #[Optional('exit_code')]
    public ?int $exitCode;

    #[Optional]
    public ?int $signal;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * `new ExecutionEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExecutionEvent::with(at: ..., sequence: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExecutionEvent)->withAt(...)->withSequence(...)->withType(...)
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
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        \DateTimeInterface $at,
        int $sequence,
        Type|string $type,
        ?string $chunk = null,
        ?string $errorCode = null,
        ?string $errorMessage = null,
        ?int $exitCode = null,
        ?int $signal = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        $self['at'] = $at;
        $self['sequence'] = $sequence;
        $self['type'] = $type;

        null !== $chunk && $self['chunk'] = $chunk;
        null !== $errorCode && $self['errorCode'] = $errorCode;
        null !== $errorMessage && $self['errorMessage'] = $errorMessage;
        null !== $exitCode && $self['exitCode'] = $exitCode;
        null !== $signal && $self['signal'] = $signal;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withAt(\DateTimeInterface $at): self
    {
        $self = clone $this;
        $self['at'] = $at;

        return $self;
    }

    public function withSequence(int $sequence): self
    {
        $self = clone $this;
        $self['sequence'] = $sequence;

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

    public function withChunk(string $chunk): self
    {
        $self = clone $this;
        $self['chunk'] = $chunk;

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

    public function withExitCode(int $exitCode): self
    {
        $self = clone $this;
        $self['exitCode'] = $exitCode;

        return $self;
    }

    public function withSignal(int $signal): self
    {
        $self = clone $this;
        $self['signal'] = $signal;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
