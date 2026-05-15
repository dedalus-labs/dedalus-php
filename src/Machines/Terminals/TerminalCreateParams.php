<?php

declare(strict_types=1);

namespace Dedalus\Machines\Terminals;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-type TerminalCreateParamsShape = array{
 *   height: int,
 *   width: int,
 *   cwd?: string|null,
 *   env?: array<string,string>|null,
 *   shell?: string|null,
 * }
 */
final class TerminalCreateParams implements BaseModel
{
    /** @use SdkModel<TerminalCreateParamsShape> */
    use SdkModel;

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
     * `new TerminalCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TerminalCreateParams::with(height: ..., width: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TerminalCreateParams)->withHeight(...)->withWidth(...)
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
        int $height,
        int $width,
        ?string $cwd = null,
        ?array $env = null,
        ?string $shell = null,
    ): self {
        $self = new self;

        $self['height'] = $height;
        $self['width'] = $width;

        null !== $cwd && $self['cwd'] = $cwd;
        null !== $env && $self['env'] = $env;
        null !== $shell && $self['shell'] = $shell;

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
