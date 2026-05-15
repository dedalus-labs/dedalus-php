<?php

declare(strict_types=1);

namespace Dedalus\Machines\Terminals;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type TerminalShape from \Dedalus\Machines\Terminals\Terminal
 *
 * @phpstan-type TerminalListShape = array{
 *   items: list<Terminal|TerminalShape>|null, nextCursor?: string|null
 * }
 */
final class TerminalList implements BaseModel
{
    /** @use SdkModel<TerminalListShape> */
    use SdkModel;

    /** @var list<Terminal>|null $items */
    #[Required(list: Terminal::class)]
    public ?array $items;

    #[Optional('next_cursor')]
    public ?string $nextCursor;

    /**
     * `new TerminalList()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TerminalList::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TerminalList)->withItems(...)
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
     * @param list<Terminal|TerminalShape>|null $items
     */
    public static function with(?array $items, ?string $nextCursor = null): self
    {
        $self = new self;

        $self['items'] = $items;

        null !== $nextCursor && $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<Terminal|TerminalShape>|null $items
     */
    public function withItems(?array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    public function withNextCursor(string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }
}
