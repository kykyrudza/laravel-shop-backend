<?php

namespace App\Exceptions\User\Auth;

use Exception;
use Throwable;

class UserForgotPasswordEmailFormException extends Exception
{
    protected $message = 'Something went wrong :(';

    protected $code = 422;

    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(
            $message ?: $this->message,
            $code ?: $this->code,
            $previous
        );
    }
}
