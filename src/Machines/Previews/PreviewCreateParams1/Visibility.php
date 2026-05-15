<?php

declare(strict_types=1);

namespace Dedalus\Machines\Previews\PreviewCreateParams1;

enum Visibility: string
{
    case PUBLIC = 'public';

    case PRIVATE = 'private';

    case ORG = 'org';
}
