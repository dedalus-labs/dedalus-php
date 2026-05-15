<?php

declare(strict_types=1);

namespace Dedalus\Usage;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Get usage summary.
 *
 * @see Dedalus\Services\UsageService::retrieve()
 *
 * @phpstan-type UsageRetrieveParamsShape = array{periodStart?: string|null}
 */
final class UsageRetrieveParams implements BaseModel
{
    /** @use SdkModel<UsageRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Billing period start (YYYY-MM-DD). Defaults to first of current month.
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
    public static function with(?string $periodStart = null): self
    {
        $self = new self;

        null !== $periodStart && $self['periodStart'] = $periodStart;

        return $self;
    }

    /**
     * Billing period start (YYYY-MM-DD). Defaults to first of current month.
     */
    public function withPeriodStart(string $periodStart): self
    {
        $self = clone $this;
        $self['periodStart'] = $periodStart;

        return $self;
    }
}
