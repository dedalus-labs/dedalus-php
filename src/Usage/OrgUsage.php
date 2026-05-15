<?php

declare(strict_types=1);

namespace Dedalus\Usage;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-type OrgUsageShape = array{
 *   billedAwakeSeconds: int,
 *   billedCPUMillicoreSeconds: int,
 *   billedLogicalStorageMiBSeconds: int,
 *   billedMemoryMiBSeconds: int,
 *   includedStorageGiB: int,
 *   planSlug: string,
 *   provisionedStorageGiB: int,
 * }
 */
final class OrgUsage implements BaseModel
{
    /** @use SdkModel<OrgUsageShape> */
    use SdkModel;

    /**
     * Closed awake seconds in billed org buckets for the period.
     */
    #[Required('billed_awake_seconds')]
    public int $billedAwakeSeconds;

    /**
     * Closed requested vCPU millicores multiplied by guest-owned active CPU seconds for the period.
     */
    #[Required('billed_cpu_millicore_seconds')]
    public int $billedCPUMillicoreSeconds;

    /**
     * Closed billable logical MiB-seconds for the period, matching the Stripe storage meter.
     */
    #[Required('billed_logical_storage_mib_seconds')]
    public int $billedLogicalStorageMiBSeconds;

    /**
     * Closed requested memory MiB multiplied by running allocation seconds for the period.
     */
    #[Required('billed_memory_mib_seconds')]
    public int $billedMemoryMiBSeconds;

    /**
     * Plan-included storage in GiB, used as a local guardrail only.
     */
    #[Required('included_storage_gib')]
    public int $includedStorageGiB;

    /**
     * Billing plan in effect for the organization.
     */
    #[Required('plan_slug')]
    public string $planSlug;

    /**
     * Current provisioned storage summed across machines in GiB.
     */
    #[Required('provisioned_storage_gib')]
    public int $provisionedStorageGiB;

    /**
     * `new OrgUsage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OrgUsage::with(
     *   billedAwakeSeconds: ...,
     *   billedCPUMillicoreSeconds: ...,
     *   billedLogicalStorageMiBSeconds: ...,
     *   billedMemoryMiBSeconds: ...,
     *   includedStorageGiB: ...,
     *   planSlug: ...,
     *   provisionedStorageGiB: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OrgUsage)
     *   ->withBilledAwakeSeconds(...)
     *   ->withBilledCPUMillicoreSeconds(...)
     *   ->withBilledLogicalStorageMiBSeconds(...)
     *   ->withBilledMemoryMiBSeconds(...)
     *   ->withIncludedStorageGiB(...)
     *   ->withPlanSlug(...)
     *   ->withProvisionedStorageGiB(...)
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
        int $billedAwakeSeconds,
        int $billedCPUMillicoreSeconds,
        int $billedLogicalStorageMiBSeconds,
        int $billedMemoryMiBSeconds,
        int $includedStorageGiB,
        string $planSlug,
        int $provisionedStorageGiB,
    ): self {
        $self = new self;

        $self['billedAwakeSeconds'] = $billedAwakeSeconds;
        $self['billedCPUMillicoreSeconds'] = $billedCPUMillicoreSeconds;
        $self['billedLogicalStorageMiBSeconds'] = $billedLogicalStorageMiBSeconds;
        $self['billedMemoryMiBSeconds'] = $billedMemoryMiBSeconds;
        $self['includedStorageGiB'] = $includedStorageGiB;
        $self['planSlug'] = $planSlug;
        $self['provisionedStorageGiB'] = $provisionedStorageGiB;

        return $self;
    }

    /**
     * Closed awake seconds in billed org buckets for the period.
     */
    public function withBilledAwakeSeconds(int $billedAwakeSeconds): self
    {
        $self = clone $this;
        $self['billedAwakeSeconds'] = $billedAwakeSeconds;

        return $self;
    }

    /**
     * Closed requested vCPU millicores multiplied by guest-owned active CPU seconds for the period.
     */
    public function withBilledCPUMillicoreSeconds(
        int $billedCPUMillicoreSeconds
    ): self {
        $self = clone $this;
        $self['billedCPUMillicoreSeconds'] = $billedCPUMillicoreSeconds;

        return $self;
    }

    /**
     * Closed billable logical MiB-seconds for the period, matching the Stripe storage meter.
     */
    public function withBilledLogicalStorageMiBSeconds(
        int $billedLogicalStorageMiBSeconds
    ): self {
        $self = clone $this;
        $self['billedLogicalStorageMiBSeconds'] = $billedLogicalStorageMiBSeconds;

        return $self;
    }

    /**
     * Closed requested memory MiB multiplied by running allocation seconds for the period.
     */
    public function withBilledMemoryMiBSeconds(
        int $billedMemoryMiBSeconds
    ): self {
        $self = clone $this;
        $self['billedMemoryMiBSeconds'] = $billedMemoryMiBSeconds;

        return $self;
    }

    /**
     * Plan-included storage in GiB, used as a local guardrail only.
     */
    public function withIncludedStorageGiB(int $includedStorageGiB): self
    {
        $self = clone $this;
        $self['includedStorageGiB'] = $includedStorageGiB;

        return $self;
    }

    /**
     * Billing plan in effect for the organization.
     */
    public function withPlanSlug(string $planSlug): self
    {
        $self = clone $this;
        $self['planSlug'] = $planSlug;

        return $self;
    }

    /**
     * Current provisioned storage summed across machines in GiB.
     */
    public function withProvisionedStorageGiB(int $provisionedStorageGiB): self
    {
        $self = clone $this;
        $self['provisionedStorageGiB'] = $provisionedStorageGiB;

        return $self;
    }
}
