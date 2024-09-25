<?php

namespace SafeThrow\Facades;

class Exceptions {
    public function suppress() {
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