<?php

declare(strict_types=1);

namespace Dedalus\Machines\Terminals\Terminal;

enum Protocol: string
{
    case WEBSOCKET = 'websocket';
}
