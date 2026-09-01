<?php

declare(strict_types=1);

namespace Dedalus\Machines\Machine;

enum Phase: string
{
    case ACCEPTED = 'accepted';

    case PLACEMENT_PENDING = 'placement_pending';

    case STARTING = 'starting';

    case RUNNING = 'running';

    case STOPPING = 'stopping';

    case SLEEPING = 'sleeping';

    case DESTROYING = 'destroying';

    case DESTROYED = 'destroyed';

    case FAILED = 'failed';
}
