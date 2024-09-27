<?php

namespace SafeThrow\Facades;

use Exception;
use SafeThrow\Services\ExceptionCaller;
use SafeThrow\Services\Suppress;

class Exceptions {
    /**
     * Caso o array informado possa ser convertido para uma exceção do SafeThrow, ele será convertido e a exceção será lançado.
     * 
     * Use para converter respostas de APIs que também utlizem o SafeThrow, por exemplo.
     */
    public function throwFromResponse(array $responseContent): void {
        $exception = null;

        // Qualquer erro que ocorrer aqui podemos assumir que a exceção não é do safeThrow
        try {
            $safethrow_type = $responseContent['safethrow-type'];
            $class_name = "SafeThrow\\Exceptions\\$safethrow_type"; 
            $exception = $class_name::fromArray($responseContent);
        } catch (Exception $e) {
            return;
        }

        throw $exception;
    }

    /**
     * Cria uma instância de SafeThrow\Facades\Suppress.
     * 
     * Use uma corrente de funções como notFoud() e forbidden() e por último um try() para suprimir as exceções específicadas caso sejam lançadas.
     */
    public function suppress(): Suppress {
        return new Suppress();
    }

    /**
     * Força a chamada de uma exceção sem nenhuma condição
     */
    public function force(): ExceptionCaller {
        return new ExceptionCaller(should_throw: true);
    }

    /**
     * Caso receba true, a exceção na corrente será lançada
     */
    public function if(bool $condition): ExceptionCaller {
        return new ExceptionCaller(should_throw: $condition);
    }


    /**
     * Caso receba false, a exceção na corrente será lançada
     */
    public function ifNot(bool $condition): ExceptionCaller {
        return new ExceptionCaller(should_throw: !$condition);
    }
}