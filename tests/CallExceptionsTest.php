<?php

namespace SafeThrow\Tests;

use SafeThrow\Exceptions\BadRequestException;
use SafeThrow\Exceptions\ConflictException;
use SafeThrow\Exceptions\ForbiddenException;
use SafeThrow\Exceptions\InternalServerErrorException;
use SafeThrow\Exceptions\NotFoundException;
use SafeThrow\Exceptions\UnauthorizedException;
use SafeThrow\Exceptions\UnprocessableEntityException;
use SafeThrow\Facades\Exceptions;

/**
 * composer test:filter CallExceptionsTest
 */
class CallExceptionsTest extends TestCase {
    private Exceptions $exceptions;

    protected function setUp(): void {
        $this->exceptions = new Exceptions();
    }

    /**
     * composer test:filter CallExceptionsTest::test_bad_request_exception
     */
    public function test_bad_request_exception() {
        $indexes = ['index1', 'index2'];

        $fakeException = new BadRequestException($indexes);

        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage(BadRequestException::getDefaultMessage());
        $this->expectExceptionObject($fakeException);

        $this->exceptions->force()->badRequest(...$indexes);
    }

    /**
     * composer test:filter CallExceptionsTest::test_conflict_exception
     */
    public function test_conflict_exception() {
        $resource = 'example';
        $state = 'deleted';

        $fakeException = new ConflictException($resource, $state);

        $this->expectException(ConflictException::class);
        $this->expectExceptionMessage(ConflictException::getDefaultMessage());
        $this->expectExceptionObject($fakeException);

        $this->exceptions->force()->conflict($resource, $state);
    }

    /**
     * composer test:filter CallExceptionsTest::test_forbidden_exception
     */
    public function test_forbidden_exception() {
        $actions = ['ACTION_1', 'ACTION_2'];

        $fakeException = new ForbiddenException($actions);

        $this->expectException(ForbiddenException::class);
        $this->expectExceptionMessage(ForbiddenException::getDefaultMessage());
        $this->expectExceptionObject($fakeException);

        $this->exceptions->force()->forbidden(...$actions);
    }

    /**
     * composer test:filter CallExceptionsTest::test_internal_server_error_exception
     */
    public function test_internal_server_error_exception() {
        $errors = ['erro1' => 'contexto', 'erro2' => 'contexto'];

        $fakeException = new InternalServerErrorException($errors);

        $this->expectException(InternalServerErrorException::class);
        $this->expectExceptionMessage(InternalServerErrorException::getDefaultMessage());
        $this->expectExceptionObject($fakeException);

        $this->exceptions->force()->internalServerError($errors);
    }

    /**
     * composer test:filter CallExceptionsTest::test_not_found_exception
     */
    public function test_not_found_exception() {
        $index = 'index';
        $where = 'where';

        $fakeException = new NotFoundException($index, $where);

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage(NotFoundException::getDefaultMessage());
        $this->expectExceptionObject($fakeException);

        $this->exceptions->force()->notFound($index, $where);
    }

    /**
     * composer test:filter CallExceptionsTest::test_unauthorized_exception
     */
    public function test_unauthorized_exception() {
        $reason = 'example';

        $fakeException = new UnauthorizedException($reason);

        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage(UnauthorizedException::getDefaultMessage());
        $this->expectExceptionObject($fakeException);

        $this->exceptions->force()->unauthorized($reason);
    }

    /**
     * composer test:filter CallExceptionsTest::test_unprocessable_entity_exception
     */
    public function test_unprocessable_entity_exception() {
        $entity = 'it';
        $reason = 'example';

        $fakeException = new UnprocessableEntityException($entity, $reason);

        $this->expectException(UnprocessableEntityException::class);
        $this->expectExceptionMessage(UnprocessableEntityException::getDefaultMessage());
        $this->expectExceptionObject($fakeException);

        $this->exceptions->force()->unprocessableEntity($entity, $reason);
    }
}