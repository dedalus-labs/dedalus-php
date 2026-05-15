<?php

namespace Dedalus\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dedalus Conflict Exception';
}
