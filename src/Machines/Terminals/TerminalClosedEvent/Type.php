<?php

declare(strict_types=1);

namespace Dedalus\Machines\Terminals\TerminalClosedEvent;

enum Type: string
{
    case CLOSED = 'closed';
}
