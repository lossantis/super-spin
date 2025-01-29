<?php

namespace App\Exceptions;

class InvalidSortByException extends ExceptionRender
{
    public function __construct($sortBy)
    {
        parent::__construct("Invalid sortBy: $sortBy. Allowed: name, hourly_rate.");
    }
}
