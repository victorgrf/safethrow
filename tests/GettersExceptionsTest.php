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
use Symfony\Component\HttpFoundation\Response;

/**
 * composer test:filter GettersExceptionsTest
 */
class GettersExceptionsTest extends TestCase {
    private Exceptions $exceptions;

    protected function setUp(): void {
        $this->exceptions = new Exceptions();
    }

    /**
     * composer test:filter GettersExceptionsTest::test_getters_bad_request_exception
     */
    public function test_getters_bad_request_exception() {
        $indexes = ['index1', 'index2'];

        try {
            $this->exceptions->force()->badRequest(...$indexes);
        } catch (BadRequestException $e) {
            $this->assertEquals($indexes, $e->getIndexes());
            $this->assertEquals(Response::HTTP_BAD_REQUEST, $e->getStatusCode());
        }
    }

    /**
     * composer test:filter GettersExceptionsTest::test_getters_conflict_exception
     */
    public function test_getters_conflict_exception() {
        $resource = 'example';
        $state = 'deleted';

        try {
            $this->exceptions->force()->conflict($resource, $state);
        } catch (ConflictException $e) {
            $this->assertEquals($resource, $e->getResource());
            $this->assertEquals($state, $e->getState());
            $this->assertEquals(Response::HTTP_CONFLICT, $e->getStatusCode());
        }
    }

    /**
     * composer test:filter GettersExceptionsTest::test_getters_forbidden_exception
     */
    public function test_getters_forbidden_exception() {
        $actions = ['ACTION_1', 'ACTION_2'];

        try {
            $this->exceptions->force()->forbidden(...$actions);
        } catch (ForbiddenException $e) {
            $this->assertEquals($actions, $e->getActions());
            $this->assertEquals(Response::HTTP_FORBIDDEN, $e->getStatusCode());
        }
    }

    /**
     * composer test:filter GettersExceptionsTest::test_getters_internal_server_error_exception
     */
    public function test_getters_internal_server_error_exception() {
        $errors = ['erro1' => 'contexto', 'erro2' => 'contexto'];

        try {
            $this->exceptions->force()->internalServerError($errors);
        } catch (InternalServerErrorException $e) {
            $this->assertEquals($errors, $e->getErrors());
            $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getStatusCode());
        }
    }

    /**
     * composer test:filter GettersExceptionsTest::test_getters_not_found_exception
     */
    public function test_getters_not_found_exception() {
        $index = 'index';
        $where = 'where';

        try {
            $this->exceptions->force()->notFound($index, $where);
        } catch (NotFoundException $e) {
            $this->assertEquals($index, $e->getIndex());
            $this->assertEquals($where, $e->getWhere());
            $this->assertEquals(Response::HTTP_NOT_FOUND, $e->getStatusCode());
        }
    }

    /**
     * composer test:filter GettersExceptionsTest::test_getters_unauthorized_exception
     */
    public function test_getters_unauthorized_exception() {
        $reason = 'example';

        try {
            $this->exceptions->force()->unauthorized($reason);
        } catch (UnauthorizedException $e) {
            $this->assertEquals($reason, $e->getReason());
            $this->assertEquals(Response::HTTP_UNAUTHORIZED, $e->getStatusCode());
        }
    }

    /**
     * composer test:filter GettersExceptionsTest::test_getters_unprocessable_entity_exception
     */
    public function test_getters_unprocessable_entity_exception() {
        $entity = 'it';
        $reason = 'example';

        try {
            $this->exceptions->force()->unprocessableEntity($entity, $reason);
        } catch (UnprocessableEntityException $e) {
            $this->assertEquals($entity, $e->getEntity());
            $this->assertEquals($reason, $e->getReason());
            $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $e->getStatusCode());
        }
    }
}