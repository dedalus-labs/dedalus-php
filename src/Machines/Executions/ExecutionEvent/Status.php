<?php

declare(strict_types=1);

namespace Dedalus\Machines\Executions\ExecutionEvent;

enum Status: string
{
    case WAKE_IN_PROGRESS = 'wake_in_progress';

    case QUEUED = 'queued';

    case RUNNING = 'running';

    case SUCCEEDED = 'succeeded';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';

    case EXPIRED = 'expired';
}
