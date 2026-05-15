<?php

declare(strict_types=1);

namespace Dedalus\Machines\Executions;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-type ArtifactRefShape = array{artifactID: string, name: string}
 */
final class ArtifactRef implements BaseModel
{
    /** @use SdkModel<ArtifactRefShape> */
    use SdkModel;

    #[Required('artifact_id')]
    public string $artifactID;

    #[Required]
    public string $name;

    /**
     * `new ArtifactRef()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ArtifactRef::with(artifactID: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ArtifactRef)->withArtifactID(...)->withName(...)
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
    public static function with(string $artifactID, string $name): self
    {
        $self = new self;

        $self['artifactID'] = $artifactID;
        $self['name'] = $name;

        return $self;
    }

    public function withArtifactID(string $artifactID): self
    {
        $self = clone $this;
        $self['artifactID'] = $artifactID;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
