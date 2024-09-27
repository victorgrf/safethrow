<?php

namespace SafeThrow\Exceptions;

use SafeThrow\Exceptions\Defaults\HttpException;
use Symfony\Component\HttpFoundation\Response;

class UnprocessableEntityException extends HttpException {
    private string $entity;
    private string $reason;

    public static function fromArray(array $data): self {
        return new UnprocessableEntityException(entity: array_keys($data['errors'])[0], reason: array_values($data['errors'])[0]);
    }
    
    public static function getDefaultMessage(): string {
        return 'Incapaz de processar o conteúdo da requisição.';
    }

    public function __construct(
        string $entity,
        string $reason
    ) {
        // Dados Padrões
        $status_code = Response::HTTP_UNPROCESSABLE_ENTITY;
        $message = $this->getDefaultMessage();

        // Mensagem específica
        $this->entity = $entity;
        $this->reason = $reason;

        // Aplicando a mensagem específica em $errors
        $errors = [
            $this->entity => $this->reason
        ];

        // Enviando para a clase pai
        parent::__construct($status_code, $message, $errors, type: class_basename(self::class));
    }

    public function getEntity(): string {
        return $this->entity;
    }

    public function getReason(): string {
        return $this->reason;
    }
}