<?php

namespace App\Exceptions\Products;

use Exception;
use Throwable;

class ProductNotFound extends Exception
{
    protected $message = 'Product not found';

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
