<?php

declare(strict_types=1);

namespace Dedalus\Usage;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-type MachineComputeUsageRowShape = array{
 *   awakeSeconds: int,
 *   bucketEnd: \DateTimeInterface,
 *   bucketStart: \DateTimeInterface,
 *   cpuMillicoreSeconds: int,
 *   lastWindowEnd: \DateTimeInterface,
 *   machineID: string,
 *   memoryMiBSeconds: int,
 *   orgMeteringBucketIDs: list<string>|null,
 *   requestedMemoryMiB: int,
 *   requestedStorageGiB: int,
 *   requestedVCPU: float,
 *   specFingerprint: string,
 *   stripeCPUIdentifiers: list<string>|null,
 *   stripeMemoryIdentifiers: list<string>|null,
 *   windowCount: int,
 *   latestStripeEmittedAt?: \DateTimeInterface|null,
 * }
 */
final class MachineComputeUsageRow implements BaseModel
{
    /** @use SdkModel<MachineComputeUsageRowShape> */
    use SdkModel;

    /**
     * Machine-awake seconds in this bucket.
     */
    #[Required('awake_seconds')]
    public int $awakeSeconds;

    /**
     * Exclusive usage bucket end.
     */
    #[Required('bucket_end')]
    public \DateTimeInterface $bucketEnd;

    /**
     * Inclusive usage bucket start.
     */
    #[Required('bucket_start')]
    public \DateTimeInterface $bucketStart;

    /**
     * Requested vCPU millicores multiplied by guest-owned active CPU seconds.
     */
    #[Required('cpu_millicore_seconds')]
    public int $cpuMillicoreSeconds;

    /**
     * Latest raw window_end represented by this row.
     */
    #[Required('last_window_end')]
    public \DateTimeInterface $lastWindowEnd;

    /**
     * Machine identifier.
     */
    #[Required('machine_id')]
    public string $machineID;

    /**
     * Requested memory MiB multiplied by running allocation seconds.
     */
    #[Required('memory_mib_seconds')]
    public int $memoryMiBSeconds;

    /**
     * Org compute bucket IDs this row contributes to.
     *
     * @var list<string>|null $orgMeteringBucketIDs
     */
    #[Required('org_metering_bucket_ids', list: 'string')]
    public ?array $orgMeteringBucketIDs;

    /**
     * Requested memory for this shape, in MiB.
     */
    #[Required('requested_memory_mib')]
    public int $requestedMemoryMiB;

    /**
     * Requested storage for this shape, in GiB.
     */
    #[Required('requested_storage_gib')]
    public int $requestedStorageGiB;

    /**
     * Requested vCPU for this shape.
     */
    #[Required('requested_vcpu')]
    public float $requestedVCPU;

    /**
     * Stable fingerprint for the requested machine shape.
     */
    #[Required('spec_fingerprint')]
    public string $specFingerprint;

    /**
     * Stripe CPU meter event identifiers linked to those org buckets.
     *
     * @var list<string>|null $stripeCPUIdentifiers
     */
    #[Required('stripe_cpu_identifiers', list: 'string')]
    public ?array $stripeCPUIdentifiers;

    /**
     * Stripe memory meter event identifiers linked to those org buckets.
     *
     * @var list<string>|null $stripeMemoryIdentifiers
     */
    #[Required('stripe_memory_identifiers', list: 'string')]
    public ?array $stripeMemoryIdentifiers;

    /**
     * Raw usage windows compacted into this row.
     */
    #[Required('window_count')]
    public int $windowCount;

    /**
     * Latest Stripe emission timestamp for linked org buckets, when emitted.
     */
    #[Optional('latest_stripe_emitted_at')]
    public ?\DateTimeInterface $latestStripeEmittedAt;

    /**
     * `new MachineComputeUsageRow()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MachineComputeUsageRow::with(
     *   awakeSeconds: ...,
     *   bucketEnd: ...,
     *   bucketStart: ...,
     *   cpuMillicoreSeconds: ...,
     *   lastWindowEnd: ...,
     *   machineID: ...,
     *   memoryMiBSeconds: ...,
     *   orgMeteringBucketIDs: ...,
     *   requestedMemoryMiB: ...,
     *   requestedStorageGiB: ...,
     *   requestedVCPU: ...,
     *   specFingerprint: ...,
     *   stripeCPUIdentifiers: ...,
     *   stripeMemoryIdentifiers: ...,
     *   windowCount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MachineComputeUsageRow)
     *   ->withAwakeSeconds(...)
     *   ->withBucketEnd(...)
     *   ->withBucketStart(...)
     *   ->withCPUMillicoreSeconds(...)
     *   ->withLastWindowEnd(...)
     *   ->withMachineID(...)
     *   ->withMemoryMiBSeconds(...)
     *   ->withOrgMeteringBucketIDs(...)
     *   ->withRequestedMemoryMiB(...)
     *   ->withRequestedStorageGiB(...)
     *   ->withRequestedVCPU(...)
     *   ->withSpecFingerprint(...)
     *   ->withStripeCPUIdentifiers(...)
     *   ->withStripeMemoryIdentifiers(...)
     *   ->withWindowCount(...)
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
     * @param list<string>|null $orgMeteringBucketIDs
     * @param list<string>|null $stripeCPUIdentifiers
     * @param list<string>|null $stripeMemoryIdentifiers
     */
    public static function with(
        int $awakeSeconds,
        \DateTimeInterface $bucketEnd,
        \DateTimeInterface $bucketStart,
        int $cpuMillicoreSeconds,
        \DateTimeInterface $lastWindowEnd,
        string $machineID,
        int $memoryMiBSeconds,
        ?array $orgMeteringBucketIDs,
        int $requestedMemoryMiB,
        int $requestedStorageGiB,
        float $requestedVCPU,
        string $specFingerprint,
        ?array $stripeCPUIdentifiers,
        ?array $stripeMemoryIdentifiers,
        int $windowCount,
        ?\DateTimeInterface $latestStripeEmittedAt = null,
    ): self {
        $self = new self;

        $self['awakeSeconds'] = $awakeSeconds;
        $self['bucketEnd'] = $bucketEnd;
        $self['bucketStart'] = $bucketStart;
        $self['cpuMillicoreSeconds'] = $cpuMillicoreSeconds;
        $self['lastWindowEnd'] = $lastWindowEnd;
        $self['machineID'] = $machineID;
        $self['memoryMiBSeconds'] = $memoryMiBSeconds;
        $self['orgMeteringBucketIDs'] = $orgMeteringBucketIDs;
        $self['requestedMemoryMiB'] = $requestedMemoryMiB;
        $self['requestedStorageGiB'] = $requestedStorageGiB;
        $self['requestedVCPU'] = $requestedVCPU;
        $self['specFingerprint'] = $specFingerprint;
        $self['stripeCPUIdentifiers'] = $stripeCPUIdentifiers;
        $self['stripeMemoryIdentifiers'] = $stripeMemoryIdentifiers;
        $self['windowCount'] = $windowCount;

        null !== $latestStripeEmittedAt && $self['latestStripeEmittedAt'] = $latestStripeEmittedAt;

        return $self;
    }

    /**
     * Machine-awake seconds in this bucket.
     */
    public function withAwakeSeconds(int $awakeSeconds): self
    {
        $self = clone $this;
        $self['awakeSeconds'] = $awakeSeconds;

        return $self;
    }

    /**
     * Exclusive usage bucket end.
     */
    public function withBucketEnd(\DateTimeInterface $bucketEnd): self
    {
        $self = clone $this;
        $self['bucketEnd'] = $bucketEnd;

        return $self;
    }

    /**
     * Inclusive usage bucket start.
     */
    public function withBucketStart(\DateTimeInterface $bucketStart): self
    {
        $self = clone $this;
        $self['bucketStart'] = $bucketStart;

        return $self;
    }

    /**
     * Requested vCPU millicores multiplied by guest-owned active CPU seconds.
     */
    public function withCPUMillicoreSeconds(int $cpuMillicoreSeconds): self
    {
        $self = clone $this;
        $self['cpuMillicoreSeconds'] = $cpuMillicoreSeconds;

        return $self;
    }

    /**
     * Latest raw window_end represented by this row.
     */
    public function withLastWindowEnd(\DateTimeInterface $lastWindowEnd): self
    {
        $self = clone $this;
        $self['lastWindowEnd'] = $lastWindowEnd;

        return $self;
    }

    /**
     * Machine identifier.
     */
    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }

    /**
     * Requested memory MiB multiplied by running allocation seconds.
     */
    public function withMemoryMiBSeconds(int $memoryMiBSeconds): self
    {
        $self = clone $this;
        $self['memoryMiBSeconds'] = $memoryMiBSeconds;

        return $self;
    }

    /**
     * Org compute bucket IDs this row contributes to.
     *
     * @param list<string>|null $orgMeteringBucketIDs
     */
    public function withOrgMeteringBucketIDs(?array $orgMeteringBucketIDs): self
    {
        $self = clone $this;
        $self['orgMeteringBucketIDs'] = $orgMeteringBucketIDs;

        return $self;
    }

    /**
     * Requested memory for this shape, in MiB.
     */
    public function withRequestedMemoryMiB(int $requestedMemoryMiB): self
    {
        $self = clone $this;
        $self['requestedMemoryMiB'] = $requestedMemoryMiB;

        return $self;
    }

    /**
     * Requested storage for this shape, in GiB.
     */
    public function withRequestedStorageGiB(int $requestedStorageGiB): self
    {
        $self = clone $this;
        $self['requestedStorageGiB'] = $requestedStorageGiB;

        return $self;
    }

    /**
     * Requested vCPU for this shape.
     */
    public function withRequestedVCPU(float $requestedVCPU): self
    {
        $self = clone $this;
        $self['requestedVCPU'] = $requestedVCPU;

        return $self;
    }

    /**
     * Stable fingerprint for the requested machine shape.
     */
    public function withSpecFingerprint(string $specFingerprint): self
    {
        $self = clone $this;
        $self['specFingerprint'] = $specFingerprint;

        return $self;
    }

    /**
     * Stripe CPU meter event identifiers linked to those org buckets.
     *
     * @param list<string>|null $stripeCPUIdentifiers
     */
    public function withStripeCPUIdentifiers(?array $stripeCPUIdentifiers): self
    {
        $self = clone $this;
        $self['stripeCPUIdentifiers'] = $stripeCPUIdentifiers;

        return $self;
    }

    /**
     * Stripe memory meter event identifiers linked to those org buckets.
     *
     * @param list<string>|null $stripeMemoryIdentifiers
     */
    public function withStripeMemoryIdentifiers(
        ?array $stripeMemoryIdentifiers
    ): self {
        $self = clone $this;
        $self['stripeMemoryIdentifiers'] = $stripeMemoryIdentifiers;

        return $self;
    }

    /**
     * Raw usage windows compacted into this row.
     */
    public function withWindowCount(int $windowCount): self
    {
        $self = clone $this;
        $self['windowCount'] = $windowCount;

        return $self;
    }

    /**
     * Latest Stripe emission timestamp for linked org buckets, when emitted.
     */
    public function withLatestStripeEmittedAt(
        \DateTimeInterface $latestStripeEmittedAt
    ): self {
        $self = clone $this;
        $self['latestStripeEmittedAt'] = $latestStripeEmittedAt;

        return $self;
    }
}
