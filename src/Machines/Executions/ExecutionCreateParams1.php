<?php

declare(strict_types=1);

namespace Dedalus\Machines\Executions;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Create execution.
 *
 * @see Dedalus\Services\Machines\ExecutionsService::create()
 *
 * @phpstan-type ExecutionCreateParams1Shape = array{
 *   machineID: string,
 *   command: list<string>|null,
 *   cwd?: string|null,
 *   env?: array<string,string>|null,
 *   stdin?: string|null,
 *   timeoutMs?: int|null,
 * }
 */
final class ExecutionCreateParams1 implements BaseModel
{
    /** @use SdkModel<ExecutionCreateParams1Shape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

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
     * `new ExecutionCreateParams1()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExecutionCreateParams1::with(machineID: ..., command: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExecutionCreateParams1)->withMachineID(...)->withCommand(...)
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
        string $machineID,
        ?array $command,
        ?string $cwd = null,
        ?array $env = null,
        ?string $stdin = null,
        ?int $timeoutMs = null,
    ): self {
        $self = new self;

        $self['machineID'] = $machineID;
        $self['command'] = $command;

        null !== $cwd && $self['cwd'] = $cwd;
        null !== $env && $self['env'] = $env;
        null !== $stdin && $self['stdin'] = $stdin;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

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
