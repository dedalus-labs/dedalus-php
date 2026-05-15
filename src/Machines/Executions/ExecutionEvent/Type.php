<?php

declare(strict_types=1);

namespace Dedalus\Machines\Executions\ExecutionEvent;

enum Type: string
{
    case LIFECYCLE = 'lifecycle';

    case STDOUT = 'stdout';

    case STDERR = 'stderr';
}
