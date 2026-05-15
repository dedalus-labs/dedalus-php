<?php

declare(strict_types=1);

namespace Dedalus\Machines\SSH;

use Dedalus\Core\Attributes\Optional;
use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Contracts\BaseModel;
use Dedalus\Machines\SSH\SSHSession\Status;

/**
 * @phpstan-import-type SSHConnectionShape from \Dedalus\Machines\SSH\SSHConnection
 *
 * @phpstan-type SSHSessionShape = array{
 *   createdAt: \DateTimeInterface,
 *   machineID: string,
 *   sessionID: string,
 *   status: Status|value-of<Status>,
 *   connection?: null|SSHConnection|SSHConnectionShape,
 *   errorCode?: string|null,
 *   errorMessage?: string|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   readyAt?: \DateTimeInterface|null,
 *   retryAfterMs?: int|null,
 * }
 */
final class SSHSession implements BaseModel
{
    /** @use SdkModel<SSHSessionShape> */
    use SdkModel;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('machine_id')]
    public string $machineID;

    #[Required('session_id')]
    public string $sessionID;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    #[Optional]
    public ?SSHConnection $connection;

    #[Optional('error_code')]
    public ?string $errorCode;

    #[Optional('error_message')]
    public ?string $errorMessage;

    #[Optional('expires_at')]
    public ?\DateTimeInterface $expiresAt;

    #[Optional('ready_at')]
    public ?\DateTimeInterface $readyAt;

    #[Optional('retry_after_ms')]
    public ?int $retryAfterMs;

    /**
     * `new SSHSession()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SSHSession::with(createdAt: ..., machineID: ..., sessionID: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SSHSession)
     *   ->withCreatedAt(...)
     *   ->withMachineID(...)
     *   ->withSessionID(...)
     *   ->withStatus(...)
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
     * @param SSHConnection|SSHConnectionShape|null $connection
     */
    public static function with(
        \DateTimeInterface $createdAt,
        string $machineID,
        string $sessionID,
        Status|string $status,
        SSHConnection|array|null $connection = null,
        ?string $errorCode = null,
        ?string $errorMessage = null,
        ?\DateTimeInterface $expiresAt = null,
        ?\DateTimeInterface $readyAt = null,
        ?int $retryAfterMs = null,
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['machineID'] = $machineID;
        $self['sessionID'] = $sessionID;
        $self['status'] = $status;

        null !== $connection && $self['connection'] = $connection;
        null !== $errorCode && $self['errorCode'] = $errorCode;
        null !== $errorMessage && $self['errorMessage'] = $errorMessage;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $readyAt && $self['readyAt'] = $readyAt;
        null !== $retryAfterMs && $self['retryAfterMs'] = $retryAfterMs;

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

    public function withSessionID(string $sessionID): self
    {
        $self = clone $this;
        $self['sessionID'] = $sessionID;

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
     * @param SSHConnection|SSHConnectionShape $connection
     */
    public function withConnection(SSHConnection|array $connection): self
    {
        $self = clone $this;
        $self['connection'] = $connection;

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
}
