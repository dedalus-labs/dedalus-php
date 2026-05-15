<?php

namespace Dedalus\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Dedalus Not Found Exception';
}
