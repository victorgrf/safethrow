<?php

namespace SafeThrow\Exceptions;

use SafeThrow\Exceptions\Defaults\HttpException;
use Symfony\Component\HttpFoundation\Response;

class ForbiddenException extends HttpException {
    private array $actions;

    public static function fromArray(array $data): self {
        return new ForbiddenException(actions: array_keys($data['errors']));
    }

    public static function getDefaultMessage(): string {
        return 'Permissão negada.';
    }

    public function __construct(
        array $actions
    ) {
        // Dados Padrões
        $status_code = Response::HTTP_FORBIDDEN;
        $message = $this->getDefaultMessage();

        // Mensagem específica
        $this->actions = $actions;
        
        // Aplicando a mensagem específica em $errors
        $errors = [];
        foreach ($this->actions as $action) {
            $errors[$action] = "O usuário logado não tem permissão para usar o action: $action.";
        }

        // Enviando para a clase pai
        parent::__construct($status_code, $message, $errors, type: class_basename(self::class));
    }

    public function getActions(): array {
        return $this->actions;
    }
}
