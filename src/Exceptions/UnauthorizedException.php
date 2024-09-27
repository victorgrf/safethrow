<?php

namespace SafeThrow\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use SafeThrow\Exceptions\Defaults\HttpException;

class UnauthorizedException extends HttpException {
    private string $reason;

    public static function fromArray(array $data): self {
        return new UnauthorizedException(reason: array_values($data['errors'])[0]);
    }
    
    public static function getDefaultMessage(): string {
        return 'Não autorizado.';
    }

    public function __construct(
        string $reason = 'Não específicado.',
    ) {
        // Dados Padrões
        $status_code = Response::HTTP_UNAUTHORIZED;
        $message = $this->getDefaultMessage();

        // Mensagem específica
        $this->reason = $reason;

        // Aplicando a mensagem específica em $errors
        $errors = [
            "motivo" => $reason
        ];
            
        // Enviando para a clase pai
        parent::__construct($status_code, $message, $errors, type: class_basename(self::class));
    }

    public function getReason(): string {
        return $this->reason;
    }
}
