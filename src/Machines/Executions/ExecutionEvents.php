<?php

declare(strict_types=1);

namespace Dedalus\Machines\Executions;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ExecutionEventShape from \Dedalus\Machines\Executions\ExecutionEvent
 *
 * @phpstan-type ExecutionEventsShape = array{
 *   items: list<ExecutionEvent|ExecutionEventShape>|null, nextCursor?: string|null
 * }
 */
final class ExecutionEvents implements BaseModel
{
    /** @use SdkModel<ExecutionEventsShape> */
    use SdkModel;

    /** @var list<ExecutionEvent>|null $items */
    #[Required(list: ExecutionEvent::class)]
    public ?array $items;

    #[Optional('next_cursor')]
    public ?string $nextCursor;

    /**
     * `new ExecutionEvents()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExecutionEvents::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExecutionEvents)->withItems(...)
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
     * @param list<ExecutionEvent|ExecutionEventShape>|null $items
     */
    public static function with(?array $items, ?string $nextCursor = null): self
    {
        $self = new self;

        $self['items'] = $items;

        null !== $nextCursor && $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<ExecutionEvent|ExecutionEventShape>|null $items
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
