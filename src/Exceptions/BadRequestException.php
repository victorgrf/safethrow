<?php

namespace SafeThrow\Exceptions;

use SafeThrow\Exceptions\Defaults\HttpException;
use Symfony\Component\HttpFoundation\Response;

class BadRequestException extends HttpException {
    private array $indexes;

    public static function getDefaultMessage(): string {
        return 'Os dados fornecidos são inválidos.';
    }

    public function __construct(
        array $indexes,
    ) {
        // Dados Padrões
        $status_code = Response::HTTP_BAD_REQUEST;
        $message = $this->getDefaultMessage();
        
        // Mensagem específica
        $this->indexes = $indexes;

        // Aplicando a mensagem específica em $errors
        if (!empty($indexes)) {
            $errors = [];
            foreach ($this->indexes as $index) {
                $errors[$index] = "O conteúdo forncecido para ($index) é inválido.";
            }
        }

        // Enviando para a clase pai
        parent::__construct($status_code, $message, $errors ?? null);
    }

    public function getIndexes(): array {
        return $this->indexes;
    }
}
