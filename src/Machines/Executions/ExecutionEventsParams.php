<?php

declare(strict_types=1);

namespace Dedalus\Machines\Executions;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * List execution events.
 *
 * @see Dedalus\Services\Machines\ExecutionsService::events()
 *
 * @phpstan-type ExecutionEventsParamsShape = array{
 *   machineID: string, executionID: string, cursor?: string|null, limit?: int|null
 * }
 */
final class ExecutionEventsParams implements BaseModel
{
    /** @use SdkModel<ExecutionEventsParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    #[Required]
    public string $executionID;

    #[Optional]
    public ?string $cursor;

    #[Optional]
    public ?int $limit;

    /**
     * `new ExecutionEventsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExecutionEventsParams::with(machineID: ..., executionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExecutionEventsParams)->withMachineID(...)->withExecutionID(...)
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
     */
    public static function with(
        string $machineID,
        string $executionID,
        ?string $cursor = null,
        ?int $limit = null,
    ): self {
        $self = new self;

        $self['machineID'] = $machineID;
        $self['executionID'] = $executionID;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }

    public function withExecutionID(string $executionID): self
    {
        $self = clone $this;
        $self['executionID'] = $executionID;

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
