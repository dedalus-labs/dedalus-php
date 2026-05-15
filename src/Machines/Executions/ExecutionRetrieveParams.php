<?php

declare(strict_types=1);

namespace Dedalus\Machines\Executions;

use Dedalus\Core\Attributes\Required;
use Dedalus\Core\Concerns\SdkModel;
use Dedalus\Core\Concerns\SdkParams;
use Dedalus\Core\Contracts\BaseModel;

/**
 * Get execution.
 *
 * @see Dedalus\Services\Machines\ExecutionsService::retrieve()
 *
 * @phpstan-type ExecutionRetrieveParamsShape = array{
 *   machineID: string, executionID: string
 * }
 */
final class ExecutionRetrieveParams implements BaseModel
{
    /** @use SdkModel<ExecutionRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $machineID;

    #[Required]
    public string $executionID;

    /**
     * `new ExecutionRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExecutionRetrieveParams::with(machineID: ..., executionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExecutionRetrieveParams)->withMachineID(...)->withExecutionID(...)
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
    public static function with(string $machineID, string $executionID): self
    {
        $self = new self;

        $self['machineID'] = $machineID;
        $self['executionID'] = $executionID;

        return $self;
    }

    public function withMachineID(string $machineID): self
    {
        $self = clone $this;
        $self['machineID'] = $machineID;

        return $self;
    }

    public function withExecutionID(string $executionID): self
    {
        $self = clone $this;
        $self['executionID'] = $executionID;

        return $self;
    }
}
