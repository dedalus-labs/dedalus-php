<?php

declare(strict_types=1);

namespace Dedalus\Machines\Previews\PreviewCreateParams1;

enum Protocol: string
{
    case HTTP = 'http';

    case HTTPS = 'https';
}
