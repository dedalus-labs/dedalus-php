<?php

namespace Dedalus\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dedalus Internal Server Exception';
}
