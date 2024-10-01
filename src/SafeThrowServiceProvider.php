<?php

namespace SafeThrow;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

class SafeThrowServiceProvider extends ServiceProvider {
    public function register() {
        //
    }

    public function boot() {
        $this->registerExceptionRenderer();
    }

    public function registerExceptionRenderer() {
        $this->app->resolving(ExceptionHandler::class, function (\Illuminate\Foundation\Exceptions\Handler $handler) {
            $handler->renderable([\SafeThrow\Facades\Handler::class, 'whenSafeThrowException']);
        });
    }
}
