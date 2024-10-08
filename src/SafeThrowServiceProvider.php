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
        $this->app->extend(ExceptionHandler::class, function ($handler, $app) {
            $handler->renderable([\SafeThrow\Facades\Handler::class, 'whenSafeThrowException']);
            return $handler;
        });
    }
}
