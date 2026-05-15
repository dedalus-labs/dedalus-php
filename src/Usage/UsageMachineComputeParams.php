<?php

declare(strict_types=1);

namespace Dedalus\Usage;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * List machine compute usage breakdown.
 *
 * @see Dedalus\Services\UsageService::machineCompute()
 *
 * @phpstan-type UsageMachineComputeParamsShape = array{
 *   granularity?: string|null,
 *   machineID?: string|null,
 *   periodEnd?: string|null,
 *   periodStart?: string|null,
 * }
 */
final class UsageMachineComputeParams implements BaseModel
{
    /** @use SdkModel<UsageMachineComputeParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Usage breakdown granularity: hour or day. Defaults to hour.
     */
    #[Optional]
    public ?string $granularity;

    /**
     * Optional machine ID filter.
     */
    #[Optional]
    public ?string $machineID;

    /**
     * Last UTC usage date to include (YYYY-MM-DD). Defaults to current time.
     */
    #[Optional]
    public ?string $periodEnd;

    /**
     * Usage period start (YYYY-MM-DD). Defaults to first of current month.
     */
    #[Optional]
    public ?string $periodStart;

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
        ?string $granularity = null,
        ?string $machineID = null,
        ?string $periodEnd = null,
        ?string $periodStart = null,
    ): self {
        $self = new self;

        null !== $granularity && $self['granularity'] = $granularity;
        null !== $machineID && $self['machineID'] = $machineID;
        null !== $periodEnd && $self['periodEnd'] = $periodEnd;
        null !== $periodStart && $self['periodStart'] = $periodStart;

        return $self;
    }

    /**
     * Usage breakdown granularity: hour or day. Defaults to hour.
     */
    public function withGranularity(string $granularity): self
    {
        $self = clone $this;
        $self['granularity'] = $granularity;

        return $self;
    }

    /**
     * Optional machine ID filter.
     */
    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }

    /**
     * Last UTC usage date to include (YYYY-MM-DD). Defaults to current time.
     */
    public function withPeriodEnd(string $periodEnd): self
    {
        $self = clone $this;
        $self['periodEnd'] = $periodEnd;

        return $self;
    }

    /**
     * Usage period start (YYYY-MM-DD). Defaults to first of current month.
     */
    public function withPeriodStart(string $periodStart): self
    {
        $self = clone $this;
        $self['periodStart'] = $periodStart;

        return $self;
    }
}
