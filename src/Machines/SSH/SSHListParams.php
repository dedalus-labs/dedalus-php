<?php

declare(strict_types=1);

namespace Dedalus\Machines\SSH;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * List SSH sessions.
 *
 * @see Dedalus\Services\Machines\SSHService::list()
 *
 * @phpstan-type SSHListParamsShape = array{
 *   machineID: string, cursor?: string|null, limit?: int|null
 * }
 */
final class SSHListParams implements BaseModel
{
    /** @use SdkModel<SSHListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    #[Optional]
    public ?string $cursor;

    #[Optional]
    public ?int $limit;

    /**
     * `new SSHListParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SSHListParams::with(machineID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SSHListParams)->withMachineID(...)
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
        ?string $cursor = null,
        ?int $limit = null
    ): self {
        $self = new self;

        $self['machineID'] = $machineID;

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
