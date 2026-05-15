<?php

declare(strict_types=1);

namespace Dedalus\Machines;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\LifecycleStatus\Phase;

/**
 * @phpstan-type LifecycleStatusShape = array{
 *   lastProgressAt: \DateTimeInterface,
 *   lastTransitionAt: \DateTimeInterface,
 *   phase: Phase|value-of<Phase>,
 *   reason: string,
 *   retryable: bool,
 *   revision: string,
 *   lastError?: string|null,
 * }
 */
final class LifecycleStatus implements BaseModel
{
    /** @use SdkModel<LifecycleStatusShape> */
    use SdkModel;

    #[Required('last_progress_at')]
    public \DateTimeInterface $lastProgressAt;

    #[Required('last_transition_at')]
    public \DateTimeInterface $lastTransitionAt;

    /** @var value-of<Phase> $phase */
    #[Required(enum: Phase::class)]
    public string $phase;

    #[Required]
    public string $reason;

    #[Required]
    public bool $retryable;

    #[Required]
    public string $revision;

    #[Optional('last_error')]
    public ?string $lastError;

    /**
     * `new LifecycleStatus()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LifecycleStatus::with(
     *   lastProgressAt: ...,
     *   lastTransitionAt: ...,
     *   phase: ...,
     *   reason: ...,
     *   retryable: ...,
     *   revision: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LifecycleStatus)
     *   ->withLastProgressAt(...)
     *   ->withLastTransitionAt(...)
     *   ->withPhase(...)
     *   ->withReason(...)
     *   ->withRetryable(...)
     *   ->withRevision(...)
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
     * @param Phase|value-of<Phase> $phase
     */
    public static function with(
        \DateTimeInterface $lastProgressAt,
        \DateTimeInterface $lastTransitionAt,
        Phase|string $phase,
        string $reason,
        bool $retryable,
        string $revision,
        ?string $lastError = null,
    ): self {
        $self = new self;

        $self['lastProgressAt'] = $lastProgressAt;
        $self['lastTransitionAt'] = $lastTransitionAt;
        $self['phase'] = $phase;
        $self['reason'] = $reason;
        $self['retryable'] = $retryable;
        $self['revision'] = $revision;

        null !== $lastError && $self['lastError'] = $lastError;

        return $self;
    }

    public function withLastProgressAt(\DateTimeInterface $lastProgressAt): self
    {
        $self = clone $this;
        $self['lastProgressAt'] = $lastProgressAt;

        return $self;
    }

    public function withLastTransitionAt(
        \DateTimeInterface $lastTransitionAt
    ): self {
        $self = clone $this;
        $self['lastTransitionAt'] = $lastTransitionAt;

        return $self;
    }

    /**
     * @param Phase|value-of<Phase> $phase
     */
    public function withPhase(Phase|string $phase): self
    {
        $self = clone $this;
        $self['phase'] = $phase;

        return $self;
    }

    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    public function withRetryable(bool $retryable): self
    {
        $self = clone $this;
        $self['retryable'] = $retryable;

        return $self;
    }

    public function withRevision(string $revision): self
    {
        $self = clone $this;
        $self['revision'] = $revision;

        return $self;
    }

    public function withLastError(string $lastError): self
    {
        $self = clone $this;
        $self['lastError'] = $lastError;

        return $self;
    }
}
