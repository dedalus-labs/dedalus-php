<?php

namespace Dedalus\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dedalus Bad Request Exception';
}
