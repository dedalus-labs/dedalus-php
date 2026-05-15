<?php

declare(strict_types=1);

namespace Dedalus\Usage;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type MachineStorageUsageRowShape from \Dedalus\Usage\MachineStorageUsageRow
 *
 * @phpstan-type MachineStorageUsageShape = array{
 *   periodEnd: \DateTimeInterface,
 *   periodStart: \DateTimeInterface,
 *   rows: list<MachineStorageUsageRow|MachineStorageUsageRowShape>|null,
 * }
 */
final class MachineStorageUsage implements BaseModel
{
    /** @use SdkModel<MachineStorageUsageShape> */
    use SdkModel;

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
     * Machine-level storage usage breakdown rows.
     *
     * @var list<MachineStorageUsageRow>|null $rows
     */
    #[Required(list: MachineStorageUsageRow::class)]
    public ?array $rows;

    /**
     * `new MachineStorageUsage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MachineStorageUsage::with(periodEnd: ..., periodStart: ..., rows: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MachineStorageUsage)
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
     * @param list<MachineStorageUsageRow|MachineStorageUsageRowShape>|null $rows
     */
    public static function with(
        \DateTimeInterface $periodEnd,
        \DateTimeInterface $periodStart,
        ?array $rows
    ): self {
        $self = new self;

        $self['periodEnd'] = $periodEnd;
        $self['periodStart'] = $periodStart;
        $self['rows'] = $rows;

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
     * Machine-level storage usage breakdown rows.
     *
     * @param list<MachineStorageUsageRow|MachineStorageUsageRowShape>|null $rows
     */
    public function withRows(?array $rows): self
    {
        $self = clone $this;
        $self['rows'] = $rows;

        return $self;
    }
}
