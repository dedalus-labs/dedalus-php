<?php

namespace Dedalus\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dedalus Unprocessable Entity Exception';
}
