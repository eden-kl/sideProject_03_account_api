<?php

namespace App\Exceptions;

use App\Enums\StatusCode;
use Exception;

class AccountException extends Exception
{

    public function __construct(string $message, string $errorCode = null, bool $prefix = true)
    {
        $errorCode = $errorCode ? StatusCode::from($errorCode)->transformStatusCode() : StatusCode::error->transformStatusCode();
        $message = $prefix ? '[System|User]' . $message : $message;
        parent::__construct($message, $errorCode);
    }

    public static function requestFailed(string $message): AccountException
    {
        return new self($message, StatusCode::accountDuplicated->value);
    }
}
