<?php

namespace App\Exceptions\User\Profile;

use Exception;

class UserProfileUpdateException extends Exception
{
    public function __construct(string $message = 'Failed to update user profile', int $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
