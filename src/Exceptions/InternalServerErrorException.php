<?php

namespace SafeThrow\Exceptions;

use SafeThrow\Exceptions\Defaults\HttpException;
use Symfony\Component\HttpFoundation\Response;

class InternalServerErrorException extends HttpException {
    public function __construct(
        ?array $errors = null,
    ) {
        // Dados Padrões
        $status_code = Response::HTTP_BAD_REQUEST;
        $message = 'Erro interno no servidor.';

        // Enviando para a clase paid
        parent::__construct($status_code, $message, $errors);
    }
}
