<?php

namespace SafeThrow\Exceptions\Defaults;

use Exception;

abstract class HttpException extends Exception {
    private null|array $errors;

    public function __construct(
        private int $status_code,
        string $message,
        null|array $errors = null
    ) {
        $this->errors = $errors;
        parent::__construct($message);
    }

    public function getStatusCode(): int {
        return $this->status_code;
    }

    public function getErrors(): null|array {
        return $this->errors;
    }
}
