<?php

declare(strict_types=1);

namespace Dedalus\Machines\Executions;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-type ExecutionCreateParamsShape = array{
 *   command: list<string>|null,
 *   cwd?: string|null,
 *   env?: array<string,string>|null,
 *   stdin?: string|null,
 *   timeoutMs?: int|null,
 * }
 */
final class ExecutionCreateParams implements BaseModel
{
    /** @use SdkModel<ExecutionCreateParamsShape> */
    use SdkModel;

    /** @var list<string>|null $command */
    #[Required(list: 'string')]
    public ?array $command;

    #[Optional]
    public ?string $cwd;

    /** @var array<string,string>|null $env */
    #[Optional(map: 'string')]
    public ?array $env;

    #[Optional]
    public ?string $stdin;

    #[Optional('timeout_ms')]
    public ?int $timeoutMs;

    /**
     * `new ExecutionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExecutionCreateParams::with(command: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExecutionCreateParams)->withCommand(...)
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
     * @param array<string,string>|null $env
     */
    public static function with(
        ?array $command,
        ?string $cwd = null,
        ?array $env = null,
        ?string $stdin = null,
        ?int $timeoutMs = null,
    ): self {
        $self = new self;

        $self['command'] = $command;

        null !== $cwd && $self['cwd'] = $cwd;
        null !== $env && $self['env'] = $env;
        null !== $stdin && $self['stdin'] = $stdin;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;

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

    public function withCwd(string $cwd): self
    {
        $self = clone $this;
        $self['cwd'] = $cwd;

        return $self;
    }

    /**
     * @param array<string,string> $env
     */
    public function withEnv(array $env): self
    {
        $self = clone $this;
        $self['env'] = $env;

        return $self;
    }

    public function withStdin(string $stdin): self
    {
        $self = clone $this;
        $self['stdin'] = $stdin;

        return $self;
    }

    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

        return $self;
    }
}
