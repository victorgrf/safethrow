<?php

namespace SafeThrow\Services;

use SafeThrow\Exceptions\Defaults\HttpException;
use SafeThrow\Exceptions\BadRequestException;
use SafeThrow\Exceptions\ConflictException;
use SafeThrow\Exceptions\ForbiddenException;
use SafeThrow\Exceptions\InternalServerErrorException;
use SafeThrow\Exceptions\NotFoundException;
use SafeThrow\Exceptions\UnauthorizedException;
use SafeThrow\Exceptions\UnprocessableEntityException;

class Suppress {
    public function __construct(
        private array $exceptionsNames = []
    ) {}

    private function addException($exceptionClassName): void {
        $this->exceptionsNames[] = $exceptionClassName;
    }

    /**
     * Tenta chamar uma função, caso uma exceção seja lançada e ela esteja na lista a ser ignorada nessa corrente, a exceção será suprimida e simplesmente retornará null
     */
    public function try(callable $function, ...$parameters): mixed {
        // try-catch cala boca
        try {
            return $function($parameters);
        } catch (HttpException $e) {
            if (!in_array(get_class($e), $this->exceptionsNames)) {
                throw $e;
            }

            return null;
        }
    }

    /**
     * Adiciona todas as exceções do SafeThrow na lista das que devem ser ignoradas nessa corrente
     */
    public function all(): self {
        $this->badRequest();
        $this->unauthorized();
        $this->forbidden();
        $this->notFound();
        $this->conflict();
        $this->unprocessableEntity();
        $this->internalServerError();
        return $this;
    }

    /**
     * Adiciona a exceção SafeThrow\Exceptions\BadRequestException na lista das que devem ser ignoradas nessa corrente
     */
    public function badRequest(): self {
        $this->addException(BadRequestException::class);
        return $this;
    }

    /**
     * Adiciona a exceção SafeThrow\Exceptions\UnauthorizedException na lista das que devem ser ignoradas nessa corrente
     */
    public function unauthorized(): self {
        $this->addException(UnauthorizedException::class);
        return $this;
    }

    /**
     * Adiciona a exceção SafeThrow\Exceptions\ForbiddenException na lista das que devem ser ignoradas nessa corrente
     */
    public function forbidden(): self {
        $this->addException(ForbiddenException::class);
        return $this;
    }

    /**
     * Adiciona a exceção SafeThrow\Exceptions\NotFoundException na lista das que devem ser ignoradas nessa corrente
     */
    public function notFound(): self {
        $this->addException(NotFoundException::class);
        return $this;
    }

    /**
     * Adiciona a exceção SafeThrow\Exceptions\ConflictException na lista das que devem ser ignoradas nessa corrente
     */
    public function conflict(): self {
        $this->addException(ConflictException::class);
        return $this;
    }

    /**
     * Adiciona a exceção SafeThrow\Exceptions\UnprocessableEntityException na lista das que devem ser ignoradas nessa corrente
     */
    public function unprocessableEntity(): self {
        $this->addException(UnprocessableEntityException::class);
        return $this;
    }

    /**
     * Adiciona a exceção SafeThrow\Exceptions\InternalServerErrorException na lista das que devem ser ignoradas nessa corrente
     */
    public function internalServerError(): self {
        $this->addException(InternalServerErrorException::class);
        return $this;
    }
}