<?php

declare(strict_types=1);

namespace Dedalus\Machines\Machine;

enum DesiredState: string
{
    case RUNNING = 'running';

    case SLEEPING = 'sleeping';

    case DESTROYED = 'destroyed';
}
