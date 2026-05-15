<?php

declare(strict_types=1);

namespace Dedalus\Machines\Terminals;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\Terminals\Terminal\Protocol;
use Dedalus\Machines\Terminals\Terminal\Status;

/**
 * @phpstan-type TerminalShape = array{
 *   createdAt: \DateTimeInterface,
 *   height: int,
 *   machineID: string,
 *   status: Status|value-of<Status>,
 *   terminalID: string,
 *   width: int,
 *   errorCode?: string|null,
 *   errorMessage?: string|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   protocol?: null|Protocol|value-of<Protocol>,
 *   readyAt?: \DateTimeInterface|null,
 *   retryAfterMs?: int|null,
 *   streamURL?: string|null,
 * }
 */
final class Terminal implements BaseModel
{
    /** @use SdkModel<TerminalShape> */
    use SdkModel;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required]
    public int $height;

    #[Required('machine_id')]
    public string $machineID;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    #[Required('terminal_id')]
    public string $terminalID;

    #[Required]
    public int $width;

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

    #[Optional('stream_url')]
    public ?string $streamURL;

    /**
     * `new Terminal()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Terminal::with(
     *   createdAt: ...,
     *   height: ...,
     *   machineID: ...,
     *   status: ...,
     *   terminalID: ...,
     *   width: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Terminal)
     *   ->withCreatedAt(...)
     *   ->withHeight(...)
     *   ->withMachineID(...)
     *   ->withStatus(...)
     *   ->withTerminalID(...)
     *   ->withWidth(...)
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
     * @param Protocol|value-of<Protocol>|null $protocol
     */
    public static function with(
        \DateTimeInterface $createdAt,
        int $height,
        string $machineID,
        Status|string $status,
        string $terminalID,
        int $width,
        ?string $errorCode = null,
        ?string $errorMessage = null,
        ?\DateTimeInterface $expiresAt = null,
        Protocol|string|null $protocol = null,
        ?\DateTimeInterface $readyAt = null,
        ?int $retryAfterMs = null,
        ?string $streamURL = null,
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['height'] = $height;
        $self['machineID'] = $machineID;
        $self['status'] = $status;
        $self['terminalID'] = $terminalID;
        $self['width'] = $width;

        null !== $errorCode && $self['errorCode'] = $errorCode;
        null !== $errorMessage && $self['errorMessage'] = $errorMessage;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $protocol && $self['protocol'] = $protocol;
        null !== $readyAt && $self['readyAt'] = $readyAt;
        null !== $retryAfterMs && $self['retryAfterMs'] = $retryAfterMs;
        null !== $streamURL && $self['streamURL'] = $streamURL;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

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

    public function withTerminalID(string $terminalID): self
    {
        $self = clone $this;
        $self['terminalID'] = $terminalID;

        return $self;
    }

    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

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

    public function withStreamURL(string $streamURL): self
    {
        $self = clone $this;
        $self['streamURL'] = $streamURL;

        return $self;
    }
}
