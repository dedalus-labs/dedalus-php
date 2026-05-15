<?php

declare(strict_types=1);

namespace Dedalus\Machines\MachineListItem;

enum DesiredState: string
{
    case RUNNING = 'running';

    case SLEEPING = 'sleeping';

    case DESTROYED = 'destroyed';
}
