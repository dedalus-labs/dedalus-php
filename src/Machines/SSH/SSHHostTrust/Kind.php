<?php

declare(strict_types=1);

namespace Dedalus\Machines\SSH\SSHHostTrust;

enum Kind: string
{
    case CERT_AUTHORITY = 'cert_authority';
}
