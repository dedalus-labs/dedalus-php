<?php

declare(strict_types=1);

namespace Dedalus\Machines\Previews;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Get preview.
 *
 * @see Dedalus\Services\Machines\PreviewsService::retrieve()
 *
 * @phpstan-type PreviewRetrieveParamsShape = array{
 *   machineID: string, previewID: string
 * }
 */
final class PreviewRetrieveParams implements BaseModel
{
    /** @use SdkModel<PreviewRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    #[Required]
    public string $previewID;

    /**
     * `new PreviewRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreviewRetrieveParams::with(machineID: ..., previewID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreviewRetrieveParams)->withMachineID(...)->withPreviewID(...)
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
    public static function with(string $machineID, string $previewID): self
    {
        $self = new self;

        $self['machineID'] = $machineID;
        $self['previewID'] = $previewID;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }

    public function withPreviewID(string $previewID): self
    {
        $self = clone $this;
        $self['previewID'] = $previewID;

        return $self;
    }
}
