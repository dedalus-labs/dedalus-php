<?php

declare(strict_types=1);

namespace Dedalus\Machines\SSH;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type SSHSessionShape from \Dedalus\Machines\SSH\SSHSession
 *
 * @phpstan-type SSHSessionListShape = array{
 *   items: list<SSHSession|SSHSessionShape>|null, nextCursor?: string|null
 * }
 */
final class SSHSessionList implements BaseModel
{
    /** @use SdkModel<SSHSessionListShape> */
    use SdkModel;

    /** @var list<SSHSession>|null $items */
    #[Required(list: SSHSession::class)]
    public ?array $items;

    #[Optional('next_cursor')]
    public ?string $nextCursor;

    /**
     * `new SSHSessionList()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SSHSessionList::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SSHSessionList)->withItems(...)
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
     * @param list<SSHSession|SSHSessionShape>|null $items
     */
    public static function with(?array $items, ?string $nextCursor = null): self
    {
        $self = new self;

        $self['items'] = $items;

        null !== $nextCursor && $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<SSHSession|SSHSessionShape>|null $items
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
