<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class UserNotFoundException extends Exception
{
    protected $message = 'User not found';
    protected $code = 404;

    public function __construct($message = null, $code = null)
    {
        parent::__construct($message ?? $this->message, $code ?? $this->code);
    }
}
