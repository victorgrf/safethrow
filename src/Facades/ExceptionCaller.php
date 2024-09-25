<?php

namespace SafeThrow\Facades;

use SafeThrow\Exceptions\BadRequestException;
use SafeThrow\Exceptions\ConflictException;
use SafeThrow\Exceptions\ForbiddenException;
use SafeThrow\Exceptions\InternalServerErrorException;
use SafeThrow\Exceptions\NotFoundException;
use SafeThrow\Exceptions\UnauthorizedException;
use SafeThrow\Exceptions\UnprocessableEntityException;

class ExceptionCaller {
    public function __construct(
        private bool $should_throw
    ) {}

    /**
     * Interrompe o request com uma exceção do tipo SafeThrow\Exceptions\BadRequestException.
     * 
     * O response do request será um JsonResponse com status code 400.
     */
    public function badRequest(...$indexes): void {
        if ($this->should_throw) {
            throw new BadRequestException($indexes);
        }
    }

    /**
     * Interrompe o request com uma exceção do tipo SafeThrow\Exceptions\UnauthorizedException.
     * 
     * O response do request será um JsonResponse com status code 401.
     */
    public function unauthorized(string $reason): void {
        if ($this->should_throw) {
            throw new UnauthorizedException($reason);
        }
    }

    /**
     * Interrompe o request com uma exceção do tipo SafeThrow\Exceptions\ForbiddenException.
     * 
     * O response do request será um JsonResponse com status code 403.
     */
    public function forbidden(...$actions): void {
        if ($this->should_throw) {
            throw new ForbiddenException($actions);
        }
    }

    /**
     * Interrompe o request com uma exceção do tipo SafeThrow\Exceptions\NotFoundException.
     * 
     * O response do request será um JsonResponse com status code 404.
     */
    public function notFound(string $index, string $where): void {
        if ($this->should_throw) {
            throw new NotFoundException($index, $where);
        }
    }

    /**
     * Interrompe o request com uma exceção do tipo SafeThrow\Exceptions\ConflictException.
     * 
     * O response do request será um JsonResponse com status code 409.
     */
    public function conflict(string $resource, string $state): void {
        if ($this->should_throw) {
            throw new ConflictException($resource, $state);
        }
    }

    /**
     * Interrompe o request com uma exceção do tipo SafeThrow\Exceptions\UnprocessableEntityException.
     * 
     * O response do request será um JsonResponse com status code 422.
     */
    public function unprocessableContent(string $entity, string $reason): void {
        if ($this->should_throw) {
            throw new UnprocessableEntityException($entity, $reason);
        }
    }

    /**
     * Interrompe o request com uma exceção do tipo SafeThrow\Exceptions\NotFoundException.
     * 
     * O response do request será um JsonResponse com status code 500.
     */
    public function internalServerError(...$errors): void {
        if ($this->should_throw) {
            throw new InternalServerErrorException($errors);
        }
    }
}