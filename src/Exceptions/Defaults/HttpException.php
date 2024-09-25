<?php

namespace SafeThrow\Exceptions\Defaults;

use Exception;

abstract class HttpException extends Exception {
    private array $errors;

    public function __construct(
        private int $status_code,
        string $message,
        ?array $errors = null
    ) {
        $this->errors = $errors ?? ['default' => $message];
        parent::__construct($message);
    }

    public function getStatusCode(): int {
        return $this->status_code;
    }

    public function getErrors(): array {
        return $this->errors;
    }
}
