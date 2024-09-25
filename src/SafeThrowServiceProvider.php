<?php

namespace SafeThrow;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

class SafeThrowServiceProvider extends ServiceProvider {
    public function register() {
        $this->registerRepositories();
        $this->registerServices();
    }

    public function boot() {
        $this->registerExceptionRenderer();
    }

    public function registerRepositories() {
        // $this->app->bind();
    }

    public function registerServices() {
        // $this->app->bind();
    }

    public function registerExceptionRenderer() {
        $this->app->resolving(ExceptionHandler::class, function (\Illuminate\Foundation\Exceptions\Handler $handler) {
            $handler->renderable([\SafeThrow\Facades\Handler::class, 'whenSafeThrowException']);
        });
    }
}
