<?php

namespace SafeThrow\Exceptions\Defaults;

use Exception;

abstract class HttpException extends Exception {
    protected null|array $errors;
    protected string $type;

    public function __construct(
        private int $status_code,
        string $message,
        null|array $errors = null,
        string $type
    ) {
        $this->type = $type;
        $this->errors = $errors;
        parent::__construct($message);
    }

    public function getStatusCode(): int {
        return $this->status_code;
    }

    public function getErrors(): null|array {
        return $this->errors;
    }

    public function getType(): string {
        return $this->type;
    }

    abstract public static function getDefaultMessage(): string;
    // abstract public static function fromArray(array $data): self;
}
