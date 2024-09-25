<?php

namespace SafeThrow\Exceptions;

use SafeThrow\Exceptions\Defaults\HttpException;
use Symfony\Component\HttpFoundation\Response;

class ForbiddenException extends HttpException {
    private array $actions;

    public function __construct(
        array $actions
    ) {
        // Dados Padrões
        $status_code = Response::HTTP_FORBIDDEN;
        $message = 'Permissão negada.';

        // Mensagem específica
        $this->actions = $actions;
        
        // Aplicando a mensagem específica em $errors
        $errors = [];
        foreach ($this->actions as $action) {
            $errors[$action] = "O usuário logado não tem permissão para usar o action: $action.";
        }

        // Enviando para a clase pai
        parent::__construct($status_code, $message, $errors);
    }

    public function getActions(): array {
        return $this->actions;
    }
}
