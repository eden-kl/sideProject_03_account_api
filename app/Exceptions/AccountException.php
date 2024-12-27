<?php

namespace App\Exceptions;

use App\Enums\StatusCode;
use Exception;

class AccountException extends Exception
{

    /**
     * @param string $message
     * @param string|null $errorCode
     * @param bool $isPrefix
     */
    public function __construct(string $message, string $errorCode = null, bool $isPrefix = true)
    {
        $errorCode = $errorCode ? StatusCode::from($errorCode)->transformStatusCode() : StatusCode::error->transformStatusCode();
        $message = $isPrefix ? '[System|User]' . $message : $message;
        parent::__construct($message, $errorCode);
    }

    /**
     * @param string $message
     * @return AccountException
     */
    public static function requestFailed(string $message): AccountException
    {
        return new self($message, StatusCode::accountDuplicated->value);
    }

    /**
     * @param string $message
     * @return AccountException
     */
    public static function notFound(string $message): AccountException
    {
        return new self($message, StatusCode::accountNotFound->value);
    }
}
