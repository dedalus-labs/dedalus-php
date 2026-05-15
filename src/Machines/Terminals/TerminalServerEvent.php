<?php

declare(strict_types=1);

namespace Dedalus\Machines\Terminals;

use Dedalus\Core\Concerns\SdkUnion;
use Dedalus\Core\Conversion\Contracts\Converter;
use Dedalus\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type TerminalOutputEventShape from \Dedalus\Machines\Terminals\TerminalOutputEvent
 * @phpstan-import-type TerminalErrorEventShape from \Dedalus\Machines\Terminals\TerminalErrorEvent
 * @phpstan-import-type TerminalClosedEventShape from \Dedalus\Machines\Terminals\TerminalClosedEvent
 *
 * @phpstan-type TerminalServerEventVariants = TerminalOutputEvent|TerminalErrorEvent|TerminalClosedEvent
 * @phpstan-type TerminalServerEventShape = TerminalServerEventVariants|TerminalOutputEventShape|TerminalErrorEventShape|TerminalClosedEventShape
 */
final class TerminalServerEvent implements ConverterSource
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
            'output' => TerminalOutputEvent::class,
            'error' => TerminalErrorEvent::class,
            'closed' => TerminalClosedEvent::class,
        ];
    }
}
