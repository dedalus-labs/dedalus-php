<?php

declare(strict_types=1);

namespace Dedalus\Machines\Artifacts;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Get artifact.
 *
 * @see Dedalus\Services\Machines\ArtifactsService::retrieve()
 *
 * @phpstan-type ArtifactRetrieveParamsShape = array{
 *   machineID: string, artifactID: string
 * }
 */
final class ArtifactRetrieveParams implements BaseModel
{
    /** @use SdkModel<ArtifactRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    #[Required]
    public string $artifactID;

    /**
     * `new ArtifactRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ArtifactRetrieveParams::with(machineID: ..., artifactID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ArtifactRetrieveParams)->withMachineID(...)->withArtifactID(...)
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
    public static function with(string $machineID, string $artifactID): self
    {
        $self = new self;

        $self['machineID'] = $machineID;
        $self['artifactID'] = $artifactID;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }

    public function withArtifactID(string $artifactID): self
    {
        $self = clone $this;
        $self['artifactID'] = $artifactID;

        return $self;
    }
}
