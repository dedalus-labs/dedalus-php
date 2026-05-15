<?php

declare(strict_types=1);

namespace Dedalus\Usage;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-type MachineStorageUsageRowShape = array{
 *   bucketEnd: \DateTimeInterface,
 *   bucketStart: \DateTimeInterface,
 *   logicalStorageBytes: int,
 *   machineID: string,
 *   orgMeteringBucketID: string,
 *   storageMiBSeconds: int,
 *   stripeStorageIdentifier: string,
 *   latestStripeEmittedAt?: \DateTimeInterface|null,
 * }
 */
final class MachineStorageUsageRow implements BaseModel
{
    /** @use SdkModel<MachineStorageUsageRowShape> */
    use SdkModel;

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
     * Machine logical bytes observed for storage allocation.
     */
    #[Required('logical_storage_bytes')]
    public int $logicalStorageBytes;

    /**
     * Machine identifier.
     */
    #[Required('machine_id')]
    public string $machineID;

    /**
     * Org storage bucket ID this row contributes to.
     */
    #[Required('org_metering_bucket_id')]
    public string $orgMeteringBucketID;

    /**
     * Allocated logical MiB-seconds for this machine.
     */
    #[Required('storage_mib_seconds')]
    public int $storageMiBSeconds;

    /**
     * Stripe storage meter event identifier linked to that org bucket.
     */
    #[Required('stripe_storage_identifier')]
    public string $stripeStorageIdentifier;

    /**
     * Latest Stripe emission timestamp for the linked org bucket, when emitted.
     */
    #[Optional('latest_stripe_emitted_at')]
    public ?\DateTimeInterface $latestStripeEmittedAt;

    /**
     * `new MachineStorageUsageRow()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MachineStorageUsageRow::with(
     *   bucketEnd: ...,
     *   bucketStart: ...,
     *   logicalStorageBytes: ...,
     *   machineID: ...,
     *   orgMeteringBucketID: ...,
     *   storageMiBSeconds: ...,
     *   stripeStorageIdentifier: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MachineStorageUsageRow)
     *   ->withBucketEnd(...)
     *   ->withBucketStart(...)
     *   ->withLogicalStorageBytes(...)
     *   ->withMachineID(...)
     *   ->withOrgMeteringBucketID(...)
     *   ->withStorageMiBSeconds(...)
     *   ->withStripeStorageIdentifier(...)
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
        \DateTimeInterface $bucketEnd,
        \DateTimeInterface $bucketStart,
        int $logicalStorageBytes,
        string $machineID,
        string $orgMeteringBucketID,
        int $storageMiBSeconds,
        string $stripeStorageIdentifier,
        ?\DateTimeInterface $latestStripeEmittedAt = null,
    ): self {
        $self = new self;

        $self['bucketEnd'] = $bucketEnd;
        $self['bucketStart'] = $bucketStart;
        $self['logicalStorageBytes'] = $logicalStorageBytes;
        $self['machineID'] = $machineID;
        $self['orgMeteringBucketID'] = $orgMeteringBucketID;
        $self['storageMiBSeconds'] = $storageMiBSeconds;
        $self['stripeStorageIdentifier'] = $stripeStorageIdentifier;

        null !== $latestStripeEmittedAt && $self['latestStripeEmittedAt'] = $latestStripeEmittedAt;

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
     * Machine logical bytes observed for storage allocation.
     */
    public function withLogicalStorageBytes(int $logicalStorageBytes): self
    {
        $self = clone $this;
        $self['logicalStorageBytes'] = $logicalStorageBytes;

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
     * Org storage bucket ID this row contributes to.
     */
    public function withOrgMeteringBucketID(string $orgMeteringBucketID): self
    {
        $self = clone $this;
        $self['orgMeteringBucketID'] = $orgMeteringBucketID;

        return $self;
    }

    /**
     * Allocated logical MiB-seconds for this machine.
     */
    public function withStorageMiBSeconds(int $storageMiBSeconds): self
    {
        $self = clone $this;
        $self['storageMiBSeconds'] = $storageMiBSeconds;

        return $self;
    }

    /**
     * Stripe storage meter event identifier linked to that org bucket.
     */
    public function withStripeStorageIdentifier(
        string $stripeStorageIdentifier
    ): self {
        $self = clone $this;
        $self['stripeStorageIdentifier'] = $stripeStorageIdentifier;

        return $self;
    }

    /**
     * Latest Stripe emission timestamp for the linked org bucket, when emitted.
     */
    public function withLatestStripeEmittedAt(
        \DateTimeInterface $latestStripeEmittedAt
    ): self {
        $self = clone $this;
        $self['latestStripeEmittedAt'] = $latestStripeEmittedAt;

        return $self;
    }
}
