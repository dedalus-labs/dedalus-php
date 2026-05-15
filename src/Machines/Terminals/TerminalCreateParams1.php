<?php

declare(strict_types=1);

namespace Dedalus\Machines\Terminals;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Create terminal.
 *
 * @see Dedalus\Services\Machines\TerminalsService::create()
 *
 * @phpstan-type TerminalCreateParams1Shape = array{
 *   machineID: string,
 *   height: int,
 *   width: int,
 *   cwd?: string|null,
 *   env?: array<string,string>|null,
 *   shell?: string|null,
 * }
 */
final class TerminalCreateParams1 implements BaseModel
{
    /** @use SdkModel<TerminalCreateParams1Shape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    #[Required]
    public int $height;

    #[Required]
    public int $width;

    #[Optional]
    public ?string $cwd;

    /** @var array<string,string>|null $env */
    #[Optional(map: 'string')]
    public ?array $env;

    #[Optional]
    public ?string $shell;

    /**
     * `new TerminalCreateParams1()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TerminalCreateParams1::with(machineID: ..., height: ..., width: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TerminalCreateParams1)->withMachineID(...)->withHeight(...)->withWidth(...)
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
     * @param array<string,string>|null $env
     */
    public static function with(
        string $machineID,
        int $height,
        int $width,
        ?string $cwd = null,
        ?array $env = null,
        ?string $shell = null,
    ): self {
        $self = new self;

        $self['machineID'] = $machineID;
        $self['height'] = $height;
        $self['width'] = $width;

        null !== $cwd && $self['cwd'] = $cwd;
        null !== $env && $self['env'] = $env;
        null !== $shell && $self['shell'] = $shell;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }

    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

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

    public function withShell(string $shell): self
    {
        $self = clone $this;
        $self['shell'] = $shell;

        return $self;
    }
}
