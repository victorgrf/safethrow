<?php

namespace SafeThrow\Exceptions;

use SafeThrow\Exceptions\Defaults\HttpException;
use Symfony\Component\HttpFoundation\Response;

class ConflictException extends HttpException {
    private string $resource;
    private string $state;

    public static function fromArray(array $data): self {
        return new ConflictException(resource: array_keys($data['errors'])[0], state: array_values($data['errors'])[0]);
    }

    public static function getDefaultMessage(): string {
        return 'Incapaz de completar a requisição devido a um conflito.';
    }

    public function __construct(
        string $resource,
        string $state
    ) {
        // Dados Padrões
        $status_code = Response::HTTP_CONFLICT;
        $message = $this->getDefaultMessage();
        
        // Mensagem específica
        $this->resource = $resource;
        $this->state = $state;

        // Aplicando a mensagem específica em $errors
        $errors = [
            $this->resource => $this->state
        ];

        // Enviando para a clase pai
        parent::__construct($status_code, $message, $errors, type: class_basename(self::class));
    }

    public function getResource(): string {
        return $this->resource;
    }

    public function getState(): string {
        return $this->state;
    }
}
