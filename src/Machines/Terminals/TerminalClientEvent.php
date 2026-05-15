<?php

declare(strict_types=1);

namespace Dedalus\Machines\Terminals;

use Dedalus\Core\Concerns\SdkUnion;
use Dedalus\Core\Conversion\Contracts\Converter;
use Dedalus\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type TerminalInputEventShape from \Dedalus\Machines\Terminals\TerminalInputEvent
 * @phpstan-import-type TerminalResizeEventShape from \Dedalus\Machines\Terminals\TerminalResizeEvent
 *
 * @phpstan-type TerminalClientEventVariants = TerminalInputEvent|TerminalResizeEvent
 * @phpstan-type TerminalClientEventShape = TerminalClientEventVariants|TerminalInputEventShape|TerminalResizeEventShape
 */
final class TerminalClientEvent implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'type';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'input' => TerminalInputEvent::class,
            'resize' => TerminalResizeEvent::class,
        ];
    }
}
