<?php

declare(strict_types=1);

namespace Dedalus\Usage;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type MachineComputeUsageRowShape from \Dedalus\Usage\MachineComputeUsageRow
 *
 * @phpstan-type MachineComputeUsageShape = array{
 *   granularity: string,
 *   periodEnd: \DateTimeInterface,
 *   periodStart: \DateTimeInterface,
 *   rows: list<MachineComputeUsageRow|MachineComputeUsageRowShape>|null,
 * }
 */
final class MachineComputeUsage implements BaseModel
{
    /** @use SdkModel<MachineComputeUsageShape> */
    use SdkModel;

    /**
     * Usage breakdown granularity used for rows: hour or day.
     */
    #[Required]
    public string $granularity;

    /**
     * Exclusive usage period end.
     */
    #[Required('period_end')]
    public \DateTimeInterface $periodEnd;

    /**
     * Inclusive usage period start.
     */
    #[Required('period_start')]
    public \DateTimeInterface $periodStart;

    /**
     * Machine-level compute usage breakdown rows.
     *
     * @var list<MachineComputeUsageRow>|null $rows
     */
    #[Required(list: MachineComputeUsageRow::class)]
    public ?array $rows;

    /**
     * `new MachineComputeUsage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MachineComputeUsage::with(
     *   granularity: ..., periodEnd: ..., periodStart: ..., rows: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MachineComputeUsage)
     *   ->withGranularity(...)
     *   ->withPeriodEnd(...)
     *   ->withPeriodStart(...)
     *   ->withRows(...)
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
     * @param list<MachineComputeUsageRow|MachineComputeUsageRowShape>|null $rows
     */
    public static function with(
        string $granularity,
        \DateTimeInterface $periodEnd,
        \DateTimeInterface $periodStart,
        ?array $rows,
    ): self {
        $self = new self;

        $self['granularity'] = $granularity;
        $self['periodEnd'] = $periodEnd;
        $self['periodStart'] = $periodStart;
        $self['rows'] = $rows;

        return $self;
    }

    /**
     * Usage breakdown granularity used for rows: hour or day.
     */
    public function withGranularity(string $granularity): self
    {
        $self = clone $this;
        $self['granularity'] = $granularity;

        return $self;
    }

    /**
     * Exclusive usage period end.
     */
    public function withPeriodEnd(\DateTimeInterface $periodEnd): self
    {
        $self = clone $this;
        $self['periodEnd'] = $periodEnd;

        return $self;
    }

    /**
     * Inclusive usage period start.
     */
    public function withPeriodStart(\DateTimeInterface $periodStart): self
    {
        $self = clone $this;
        $self['periodStart'] = $periodStart;

        return $self;
    }

    /**
     * Machine-level compute usage breakdown rows.
     *
     * @param list<MachineComputeUsageRow|MachineComputeUsageRowShape>|null $rows
     */
    public function withRows(?array $rows): self
    {
        $self = clone $this;
        $self['rows'] = $rows;

        return $self;
    }
}
