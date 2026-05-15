<?php

declare(strict_types=1);

namespace Dedalus\Machines\Previews;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type PreviewShape from \Dedalus\Machines\Previews\Preview
 *
 * @phpstan-type PreviewListShape = array{
 *   items: list<Preview|PreviewShape>|null, nextCursor?: string|null
 * }
 */
final class PreviewList implements BaseModel
{
    /** @use SdkModel<PreviewListShape> */
    use SdkModel;

    /** @var list<Preview>|null $items */
    #[Required(list: Preview::class)]
    public ?array $items;

    #[Optional('next_cursor')]
    public ?string $nextCursor;

    /**
     * `new PreviewList()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreviewList::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreviewList)->withItems(...)
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
     * @param list<Preview|PreviewShape>|null $items
     */
    public static function with(?array $items, ?string $nextCursor = null): self
    {
        $self = new self;

        $self['items'] = $items;

        null !== $nextCursor && $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<Preview|PreviewShape>|null $items
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
