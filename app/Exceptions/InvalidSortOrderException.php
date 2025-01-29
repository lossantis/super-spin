<?php

namespace App\Exceptions;

class InvalidSortOrderException extends ExceptionRender
{
    public function __construct($order)
    {
        parent::__construct("Invalid sortOrder: $order. Use 'asc' or 'desc'.");
    }
}
