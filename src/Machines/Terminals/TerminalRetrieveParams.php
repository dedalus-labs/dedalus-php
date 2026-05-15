<?php

declare(strict_types=1);

namespace Dedalus\Machines\Terminals;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Get terminal.
 *
 * @see Dedalus\Services\Machines\TerminalsService::retrieve()
 *
 * @phpstan-type TerminalRetrieveParamsShape = array{
 *   machineID: string, terminalID: string
 * }
 */
final class TerminalRetrieveParams implements BaseModel
{
    /** @use SdkModel<TerminalRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    #[Required]
    public string $terminalID;

    /**
     * `new TerminalRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TerminalRetrieveParams::with(machineID: ..., terminalID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TerminalRetrieveParams)->withMachineID(...)->withTerminalID(...)
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
    public static function with(string $machineID, string $terminalID): self
    {
        $self = new self;

        $self['machineID'] = $machineID;
        $self['terminalID'] = $terminalID;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }

    public function withTerminalID(string $terminalID): self
    {
        $self = clone $this;
        $self['terminalID'] = $terminalID;

        return $self;
    }
}
