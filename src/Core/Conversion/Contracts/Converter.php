<?php

declare(strict_types=1);

namespace Dedalus\Core\Conversion\Contracts;

use Dedalus\Core\Conversion\CoerceState;
use Dedalus\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
