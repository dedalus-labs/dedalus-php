<?php

declare(strict_types=1);

namespace Dedalus\Machines\Previews\Preview;

enum Status: string
{
    case WAKE_IN_PROGRESS = 'wake_in_progress';

    case READY = 'ready';

    case CLOSED = 'closed';

    case EXPIRED = 'expired';

    case FAILED = 'failed';
}
