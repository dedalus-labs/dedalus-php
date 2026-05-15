<?php

declare(strict_types=1);

namespace Dedalus\Machines\Previews\Preview;

enum Visibility: string
{
    case PUBLIC = 'public';

    case PRIVATE = 'private';

    case ORG = 'org';
}
