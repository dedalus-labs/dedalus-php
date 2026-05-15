<?php

namespace Dedalus\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dedalus Rate Limit Exception';
}
