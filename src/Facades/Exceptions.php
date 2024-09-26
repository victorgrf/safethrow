<?php

namespace SafeThrow\Facades;

use SafeThrow\Services\ExceptionCaller;
use SafeThrow\Services\Suppress;

class Exceptions {
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