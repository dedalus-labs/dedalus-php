<?php

declare(strict_types=1);

namespace Dedalus\Machines\Previews;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\Previews\Preview\Protocol;
use Dedalus\Machines\Previews\Preview\Status;
use Dedalus\Machines\Previews\Preview\Visibility;

/**
 * @phpstan-type PreviewShape = array{
 *   createdAt: \DateTimeInterface,
 *   machineID: string,
 *   port: int,
 *   previewID: string,
 *   status: Status|value-of<Status>,
 *   visibility: Visibility|value-of<Visibility>,
 *   errorCode?: string|null,
 *   errorMessage?: string|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   protocol?: null|Protocol|value-of<Protocol>,
 *   readyAt?: \DateTimeInterface|null,
 *   retryAfterMs?: int|null,
 *   url?: string|null,
 * }
 */
final class Preview implements BaseModel
{
    /** @use SdkModel<PreviewShape> */
    use SdkModel;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('machine_id')]
    public string $machineID;

    #[Required]
    public int $port;

    #[Required('preview_id')]
    public string $previewID;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    /** @var value-of<Visibility> $visibility */
    #[Required(enum: Visibility::class)]
    public string $visibility;

    #[Optional('error_code')]
    public ?string $errorCode;

    #[Optional('error_message')]
    public ?string $errorMessage;

    #[Optional('expires_at')]
    public ?\DateTimeInterface $expiresAt;

    /** @var value-of<Protocol>|null $protocol */
    #[Optional(enum: Protocol::class)]
    public ?string $protocol;

    #[Optional('ready_at')]
    public ?\DateTimeInterface $readyAt;

    #[Optional('retry_after_ms')]
    public ?int $retryAfterMs;

    #[Optional]
    public ?string $url;

    /**
     * `new Preview()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Preview::with(
     *   createdAt: ...,
     *   machineID: ...,
     *   port: ...,
     *   previewID: ...,
     *   status: ...,
     *   visibility: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Preview)
     *   ->withCreatedAt(...)
     *   ->withMachineID(...)
     *   ->withPort(...)
     *   ->withPreviewID(...)
     *   ->withStatus(...)
     *   ->withVisibility(...)
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
     * @param Status|value-of<Status> $status
     * @param Visibility|value-of<Visibility> $visibility
     * @param Protocol|value-of<Protocol>|null $protocol
     */
    public static function with(
        \DateTimeInterface $createdAt,
        string $machineID,
        int $port,
        string $previewID,
        Status|string $status,
        Visibility|string $visibility,
        ?string $errorCode = null,
        ?string $errorMessage = null,
        ?\DateTimeInterface $expiresAt = null,
        Protocol|string|null $protocol = null,
        ?\DateTimeInterface $readyAt = null,
        ?int $retryAfterMs = null,
        ?string $url = null,
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['machineID'] = $machineID;
        $self['port'] = $port;
        $self['previewID'] = $previewID;
        $self['status'] = $status;
        $self['visibility'] = $visibility;

        null !== $errorCode && $self['errorCode'] = $errorCode;
        null !== $errorMessage && $self['errorMessage'] = $errorMessage;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $protocol && $self['protocol'] = $protocol;
        null !== $readyAt && $self['readyAt'] = $readyAt;
        null !== $retryAfterMs && $self['retryAfterMs'] = $retryAfterMs;
        null !== $url && $self['url'] = $url;

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

    public function withPort(int $port): self
    {
        $self = clone $this;
        $self['port'] = $port;

        return $self;
    }

    public function withPreviewID(string $previewID): self
    {
        $self = clone $this;
        $self['previewID'] = $previewID;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * @param Visibility|value-of<Visibility> $visibility
     */
    public function withVisibility(Visibility|string $visibility): self
    {
        $self = clone $this;
        $self['visibility'] = $visibility;

        return $self;
    }

    public function withErrorCode(string $errorCode): self
    {
        $self = clone $this;
        $self['errorCode'] = $errorCode;

        return $self;
    }

    public function withErrorMessage(string $errorMessage): self
    {
        $self = clone $this;
        $self['errorMessage'] = $errorMessage;

        return $self;
    }

    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * @param Protocol|value-of<Protocol> $protocol
     */
    public function withProtocol(Protocol|string $protocol): self
    {
        $self = clone $this;
        $self['protocol'] = $protocol;

        return $self;
    }

    public function withReadyAt(\DateTimeInterface $readyAt): self
    {
        $self = clone $this;
        $self['readyAt'] = $readyAt;

        return $self;
    }

    public function withRetryAfterMs(int $retryAfterMs): self
    {
        $self = clone $this;
        $self['retryAfterMs'] = $retryAfterMs;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
