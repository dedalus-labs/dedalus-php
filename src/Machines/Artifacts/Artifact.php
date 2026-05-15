<?php

declare(strict_types=1);

namespace Dedalus\Machines\Artifacts;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;

/**
 * @phpstan-type ArtifactShape = array{
 *   artifactID: string,
 *   createdAt: \DateTimeInterface,
 *   machineID: string,
 *   name: string,
 *   sizeBytes: int,
 *   downloadURL?: string|null,
 *   executionID?: string|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   mimeType?: string|null,
 *   sha256?: string|null,
 * }
 */
final class Artifact implements BaseModel
{
    /** @use SdkModel<ArtifactShape> */
    use SdkModel;

    #[Required('artifact_id')]
    public string $artifactID;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('machine_id')]
    public string $machineID;

    #[Required]
    public string $name;

    #[Required('size_bytes')]
    public int $sizeBytes;

    #[Optional('download_url')]
    public ?string $downloadURL;

    #[Optional('execution_id')]
    public ?string $executionID;

    #[Optional('expires_at')]
    public ?\DateTimeInterface $expiresAt;

    #[Optional('mime_type')]
    public ?string $mimeType;

    #[Optional]
    public ?string $sha256;

    /**
     * `new Artifact()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Artifact::with(
     *   artifactID: ..., createdAt: ..., machineID: ..., name: ..., sizeBytes: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Artifact)
     *   ->withArtifactID(...)
     *   ->withCreatedAt(...)
     *   ->withMachineID(...)
     *   ->withName(...)
     *   ->withSizeBytes(...)
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
        string $artifactID,
        \DateTimeInterface $createdAt,
        string $machineID,
        string $name,
        int $sizeBytes,
        ?string $downloadURL = null,
        ?string $executionID = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $mimeType = null,
        ?string $sha256 = null,
    ): self {
        $self = new self;

        $self['artifactID'] = $artifactID;
        $self['createdAt'] = $createdAt;
        $self['machineID'] = $machineID;
        $self['name'] = $name;
        $self['sizeBytes'] = $sizeBytes;

        null !== $downloadURL && $self['downloadURL'] = $downloadURL;
        null !== $executionID && $self['executionID'] = $executionID;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $mimeType && $self['mimeType'] = $mimeType;
        null !== $sha256 && $self['sha256'] = $sha256;

        return $self;
    }

    public function withArtifactID(string $artifactID): self
    {
        $self = clone $this;
        $self['artifactID'] = $artifactID;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withSizeBytes(int $sizeBytes): self
    {
        $self = clone $this;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }

    public function withDownloadURL(string $downloadURL): self
    {
        $self = clone $this;
        $self['downloadURL'] = $downloadURL;

        return $self;
    }

    public function withExecutionID(string $executionID): self
    {
        $self = clone $this;
        $self['executionID'] = $executionID;

        return $self;
    }

    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    public function withMimeType(string $mimeType): self
    {
        $self = clone $this;
        $self['mimeType'] = $mimeType;

        return $self;
    }

    public function withSha256(string $sha256): self
    {
        $self = clone $this;
        $self['sha256'] = $sha256;

        return $self;
    }
}
