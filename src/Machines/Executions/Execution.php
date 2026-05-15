<?php

declare(strict_types=1);

namespace Dedalus\Machines\Executions;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\Executions\Execution\Status;

/**
 * @phpstan-import-type ArtifactRefShape from \Dedalus\Machines\Executions\ArtifactRef
 *
 * @phpstan-type ExecutionShape = array{
 *   command: list<string>|null,
 *   createdAt: \DateTimeInterface,
 *   executionID: string,
 *   machineID: string,
 *   status: Status|value-of<Status>,
 *   artifacts?: list<ArtifactRef|ArtifactRefShape>|null,
 *   completedAt?: \DateTimeInterface|null,
 *   cwd?: string|null,
 *   envKeys?: list<string>|null,
 *   errorCode?: string|null,
 *   errorMessage?: string|null,
 *   exitCode?: int|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   retryAfterMs?: int|null,
 *   signal?: int|null,
 *   startedAt?: \DateTimeInterface|null,
 *   stderrBytes?: int|null,
 *   stderrTruncated?: bool|null,
 *   stdoutBytes?: int|null,
 *   stdoutTruncated?: bool|null,
 * }
 */
final class Execution implements BaseModel
{
    /** @use SdkModel<ExecutionShape> */
    use SdkModel;

    /** @var list<string>|null $command */
    #[Required(list: 'string')]
    public ?array $command;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('execution_id')]
    public string $executionID;

    #[Required('machine_id')]
    public string $machineID;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    /** @var list<ArtifactRef>|null $artifacts */
    #[Optional(list: ArtifactRef::class, nullable: true)]
    public ?array $artifacts;

    #[Optional('completed_at')]
    public ?\DateTimeInterface $completedAt;

    #[Optional]
    public ?string $cwd;

    /** @var list<string>|null $envKeys */
    #[Optional('env_keys', list: 'string', nullable: true)]
    public ?array $envKeys;

    #[Optional('error_code')]
    public ?string $errorCode;

    #[Optional('error_message')]
    public ?string $errorMessage;

    #[Optional('exit_code')]
    public ?int $exitCode;

    #[Optional('expires_at')]
    public ?\DateTimeInterface $expiresAt;

    #[Optional('retry_after_ms')]
    public ?int $retryAfterMs;

    #[Optional]
    public ?int $signal;

    #[Optional('started_at')]
    public ?\DateTimeInterface $startedAt;

    #[Optional('stderr_bytes')]
    public ?int $stderrBytes;

    #[Optional('stderr_truncated')]
    public ?bool $stderrTruncated;

    #[Optional('stdout_bytes')]
    public ?int $stdoutBytes;

    #[Optional('stdout_truncated')]
    public ?bool $stdoutTruncated;

    /**
     * `new Execution()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Execution::with(
     *   command: ..., createdAt: ..., executionID: ..., machineID: ..., status: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Execution)
     *   ->withCommand(...)
     *   ->withCreatedAt(...)
     *   ->withExecutionID(...)
     *   ->withMachineID(...)
     *   ->withStatus(...)
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
     * @param list<string>|null $command
     * @param Status|value-of<Status> $status
     * @param list<ArtifactRef|ArtifactRefShape>|null $artifacts
     * @param list<string>|null $envKeys
     */
    public static function with(
        ?array $command,
        \DateTimeInterface $createdAt,
        string $executionID,
        string $machineID,
        Status|string $status,
        ?array $artifacts = null,
        ?\DateTimeInterface $completedAt = null,
        ?string $cwd = null,
        ?array $envKeys = null,
        ?string $errorCode = null,
        ?string $errorMessage = null,
        ?int $exitCode = null,
        ?\DateTimeInterface $expiresAt = null,
        ?int $retryAfterMs = null,
        ?int $signal = null,
        ?\DateTimeInterface $startedAt = null,
        ?int $stderrBytes = null,
        ?bool $stderrTruncated = null,
        ?int $stdoutBytes = null,
        ?bool $stdoutTruncated = null,
    ): self {
        $self = new self;

        $self['command'] = $command;
        $self['createdAt'] = $createdAt;
        $self['executionID'] = $executionID;
        $self['machineID'] = $machineID;
        $self['status'] = $status;

        null !== $artifacts && $self['artifacts'] = $artifacts;
        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $cwd && $self['cwd'] = $cwd;
        null !== $envKeys && $self['envKeys'] = $envKeys;
        null !== $errorCode && $self['errorCode'] = $errorCode;
        null !== $errorMessage && $self['errorMessage'] = $errorMessage;
        null !== $exitCode && $self['exitCode'] = $exitCode;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $retryAfterMs && $self['retryAfterMs'] = $retryAfterMs;
        null !== $signal && $self['signal'] = $signal;
        null !== $startedAt && $self['startedAt'] = $startedAt;
        null !== $stderrBytes && $self['stderrBytes'] = $stderrBytes;
        null !== $stderrTruncated && $self['stderrTruncated'] = $stderrTruncated;
        null !== $stdoutBytes && $self['stdoutBytes'] = $stdoutBytes;
        null !== $stdoutTruncated && $self['stdoutTruncated'] = $stdoutTruncated;

        return $self;
    }

    /**
     * @param list<string>|null $command
     */
    public function withCommand(?array $command): self
    {
        $self = clone $this;
        $self['command'] = $command;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withExecutionID(string $executionID): self
    {
        $self = clone $this;
        $self['executionID'] = $executionID;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

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

    /**
     * @param list<ArtifactRef|ArtifactRefShape>|null $artifacts
     */
    public function withArtifacts(?array $artifacts): self
    {
        $self = clone $this;
        $self['artifacts'] = $artifacts;

        return $self;
    }

    public function withCompletedAt(\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

        return $self;
    }

    public function withCwd(string $cwd): self
    {
        $self = clone $this;
        $self['cwd'] = $cwd;

        return $self;
    }

    /**
     * @param list<string>|null $envKeys
     */
    public function withEnvKeys(?array $envKeys): self
    {
        $self = clone $this;
        $self['envKeys'] = $envKeys;

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

    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    public function withRetryAfterMs(int $retryAfterMs): self
    {
        $self = clone $this;
        $self['retryAfterMs'] = $retryAfterMs;

        return $self;
    }

    public function withSignal(int $signal): self
    {
        $self = clone $this;
        $self['signal'] = $signal;

        return $self;
    }

    public function withStartedAt(\DateTimeInterface $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }

    public function withStderrBytes(int $stderrBytes): self
    {
        $self = clone $this;
        $self['stderrBytes'] = $stderrBytes;

        return $self;
    }

    public function withStderrTruncated(bool $stderrTruncated): self
    {
        $self = clone $this;
        $self['stderrTruncated'] = $stderrTruncated;

        return $self;
    }

    public function withStdoutBytes(int $stdoutBytes): self
    {
        $self = clone $this;
        $self['stdoutBytes'] = $stdoutBytes;

        return $self;
    }

    public function withStdoutTruncated(bool $stdoutTruncated): self
    {
        $self = clone $this;
        $self['stdoutTruncated'] = $stdoutTruncated;

        return $self;
    }
}
