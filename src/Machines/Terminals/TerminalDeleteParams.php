<?php

declare(strict_types=1);

namespace Dedalus\Machines\Terminals;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Delete terminal.
 *
 * @see Dedalus\Services\Machines\TerminalsService::delete()
 *
 * @phpstan-type TerminalDeleteParamsShape = array{
 *   machineID: string, terminalID: string
 * }
 */
final class TerminalDeleteParams implements BaseModel
{
    /** @use SdkModel<TerminalDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    #[Required]
    public string $terminalID;

    /**
     * `new TerminalDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TerminalDeleteParams::with(machineID: ..., terminalID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TerminalDeleteParams)->withMachineID(...)->withTerminalID(...)
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
