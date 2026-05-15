<?php

declare(strict_types=1);

namespace Dedalus\Machines;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * List machines.
 *
 * @see Dedalus\Services\MachinesService::list()
 *
 * @phpstan-type MachineListParamsShape = array{
 *   cursor?: string|null, limit?: int|null
 * }
 */
final class MachineListParams implements BaseModel
{
    /** @use SdkModel<MachineListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $cursor;

    #[Optional]
    public ?int $limit;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $cursor = null, ?int $limit = null): self
    {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
