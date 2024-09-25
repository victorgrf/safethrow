<?php

namespace SafeThrow\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use SafeThrow\Exceptions\Defaults\HttpException;

class UnauthorizedException extends HttpException {
    private string $reason;

    public function __construct(
        string $reason = 'Não específicado.',
    ) {
        // Dados Padrões
        $status_code = Response::HTTP_UNAUTHORIZED;
        $message = 'Não autorizado.';

        // Aplicando a mensagem específica em $errors
        $errors = [
            "motivo" => $reason
        ];
            
        // Enviando para a clase pai
        parent::__construct($status_code, $message, $errors);
    }

    public function getReason(): string {
        return $this->reason;
    }
}
