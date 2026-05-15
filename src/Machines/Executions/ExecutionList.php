<?php

declare(strict_types=1);

namespace Dedalus\Machines\Executions;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ExecutionShape from \Dedalus\Machines\Executions\Execution
 *
 * @phpstan-type ExecutionListShape = array{
 *   items: list<Execution|ExecutionShape>|null, nextCursor?: string|null
 * }
 */
final class ExecutionList implements BaseModel
{
    /** @use SdkModel<ExecutionListShape> */
    use SdkModel;

    /** @var list<Execution>|null $items */
    #[Required(list: Execution::class)]
    public ?array $items;

    #[Optional('next_cursor')]
    public ?string $nextCursor;

    /**
     * `new ExecutionList()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExecutionList::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExecutionList)->withItems(...)
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
     * @param list<Execution|ExecutionShape>|null $items
     */
    public static function with(?array $items, ?string $nextCursor = null): self
    {
        $self = new self;

        $self['items'] = $items;

        null !== $nextCursor && $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<Execution|ExecutionShape>|null $items
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
