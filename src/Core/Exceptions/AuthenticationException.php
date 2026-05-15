<?php

namespace Dedalus\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dedalus Authentication Exception';
}
