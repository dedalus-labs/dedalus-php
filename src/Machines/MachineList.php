<?php

declare(strict_types=1);

namespace Dedalus\Machines;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type MachineListItemShape from \Dedalus\Machines\MachineListItem
 *
 * @phpstan-type MachineListShape = array{
 *   items: list<MachineListItem|MachineListItemShape>|null,
 *   nextCursor?: string|null,
 * }
 */
final class MachineList implements BaseModel
{
    /** @use SdkModel<MachineListShape> */
    use SdkModel;

    /** @var list<MachineListItem>|null $items */
    #[Required(list: MachineListItem::class)]
    public ?array $items;

    #[Optional('next_cursor')]
    public ?string $nextCursor;

    /**
     * `new MachineList()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MachineList::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MachineList)->withItems(...)
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
     * @param list<MachineListItem|MachineListItemShape>|null $items
     */
    public static function with(?array $items, ?string $nextCursor = null): self
    {
        $self = new self;

        $self['items'] = $items;

        null !== $nextCursor && $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<MachineListItem|MachineListItemShape>|null $items
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
