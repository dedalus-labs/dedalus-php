<?php

declare(strict_types=1);

namespace Dedalus\Core\Conversion;

use Dedalus\Core\Conversion\Concerns\ArrayOf;
use Dedalus\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
