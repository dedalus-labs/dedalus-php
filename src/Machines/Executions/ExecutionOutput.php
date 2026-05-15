<?php

declare(strict_types=1);

namespace Dedalus\Machines\Executions;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-type ExecutionOutputShape = array{
 *   executionID: string,
 *   stderr?: string|null,
 *   stderrBytes?: int|null,
 *   stderrTruncated?: bool|null,
 *   stdout?: string|null,
 *   stdoutBytes?: int|null,
 *   stdoutTruncated?: bool|null,
 * }
 */
final class ExecutionOutput implements BaseModel
{
    /** @use SdkModel<ExecutionOutputShape> */
    use SdkModel;

    #[Required('execution_id')]
    public string $executionID;

    #[Optional]
    public ?string $stderr;

    #[Optional('stderr_bytes')]
    public ?int $stderrBytes;

    #[Optional('stderr_truncated')]
    public ?bool $stderrTruncated;

    #[Optional]
    public ?string $stdout;

    #[Optional('stdout_bytes')]
    public ?int $stdoutBytes;

    #[Optional('stdout_truncated')]
    public ?bool $stdoutTruncated;

    /**
     * `new ExecutionOutput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExecutionOutput::with(executionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExecutionOutput)->withExecutionID(...)
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
     */
    public static function with(
        string $executionID,
        ?string $stderr = null,
        ?int $stderrBytes = null,
        ?bool $stderrTruncated = null,
        ?string $stdout = null,
        ?int $stdoutBytes = null,
        ?bool $stdoutTruncated = null,
    ): self {
        $self = new self;

        $self['executionID'] = $executionID;

        null !== $stderr && $self['stderr'] = $stderr;
        null !== $stderrBytes && $self['stderrBytes'] = $stderrBytes;
        null !== $stderrTruncated && $self['stderrTruncated'] = $stderrTruncated;
        null !== $stdout && $self['stdout'] = $stdout;
        null !== $stdoutBytes && $self['stdoutBytes'] = $stdoutBytes;
        null !== $stdoutTruncated && $self['stdoutTruncated'] = $stdoutTruncated;

        return $self;
    }

    public function withExecutionID(string $executionID): self
    {
        $self = clone $this;
        $self['executionID'] = $executionID;

        return $self;
    }

    public function withStderr(string $stderr): self
    {
        $self = clone $this;
        $self['stderr'] = $stderr;

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

    public function withStdout(string $stdout): self
    {
        $self = clone $this;
        $self['stdout'] = $stdout;

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
