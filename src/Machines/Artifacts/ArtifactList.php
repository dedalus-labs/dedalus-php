<?php

declare(strict_types=1);

namespace Dedalus\Machines\Artifacts;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ArtifactShape from \Dedalus\Machines\Artifacts\Artifact
 *
 * @phpstan-type ArtifactListShape = array{
 *   items: list<Artifact|ArtifactShape>|null, nextCursor?: string|null
 * }
 */
final class ArtifactList implements BaseModel
{
    /** @use SdkModel<ArtifactListShape> */
    use SdkModel;

    /** @var list<Artifact>|null $items */
    #[Required(list: Artifact::class)]
    public ?array $items;

    #[Optional('next_cursor')]
    public ?string $nextCursor;

    /**
     * `new ArtifactList()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ArtifactList::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ArtifactList)->withItems(...)
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
     * @param list<Artifact|ArtifactShape>|null $items
     */
    public static function with(?array $items, ?string $nextCursor = null): self
    {
        $self = new self;

        $self['items'] = $items;

        null !== $nextCursor && $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<Artifact|ArtifactShape>|null $items
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
