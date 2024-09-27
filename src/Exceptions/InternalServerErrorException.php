<?php

namespace SafeThrow\Exceptions;

use SafeThrow\Exceptions\Defaults\HttpException;
use Symfony\Component\HttpFoundation\Response;

class InternalServerErrorException extends HttpException {
    public static function fromArray(array $data): self {
        return new InternalServerErrorException(errors: $data['errors'] ?? null);
    }

    public static function getDefaultMessage(): string {
        return 'Erro interno no servidor.';
    }

    public function __construct(
        ?array $errors = null,
    ) {
        // Dados Padrões
        $status_code = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = $this->getDefaultMessage();

        // Enviando para a clase pai
        parent::__construct($status_code, $message, $errors, type: class_basename(self::class));
    }
}
