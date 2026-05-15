<?php

namespace Dedalus\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dedalus Permission Denied Exception';
}
