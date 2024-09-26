<?php

namespace SafeThrow\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use SafeThrow\Exceptions\Defaults\HttpException;

class NotFoundException extends HttpException {
    private string $index;
    private string $where;
    
    public static function getDefaultMessage(): string {
        return 'Conteúdo não encontrado.';
    }

    public function __construct(
        string $index,
        string $where
    ) {
        // Dados Padrões
        $status_code = Response::HTTP_NOT_FOUND;
        $message = $this->getDefaultMessage();

        // Mensagem específica
        $this->index = $index;
        $this->where = $where;

        // Aplicando a mensagem específica em $errors
        $errors = [
            $this->index => "Índice ($index) não encontrado em: $where."
        ];

        // Enviando para a clase pai
        parent::__construct($status_code, $message, $errors);
    }

    public function getIndex(): string {
        return $this->index;
    }

    public function getWhere(): string {
        return $this->where;
    }
}
