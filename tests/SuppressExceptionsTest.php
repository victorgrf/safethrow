<?php

namespace SafeThrow\Tests;

use SafeThrow\Facades\Exceptions;

/**
 * composer test:filter SuppressExceptionsTest
 */
class SuppressExceptionsTest extends TestCase {
    private Exceptions $exceptions;

    protected function setUp(): void {
        $this->exceptions = new Exceptions();
    }

    /**
     * composer test:filter SuppressExceptionsTest::test_suppress_bad_request_exception
     */
    public function test_suppress_bad_request_exception() {
        $indexes = ['index1', 'index2'];

        $res = $this->exceptions->suppress()->badRequest()->try(function () use ($indexes) {
            $this->exceptions->force()->badRequest(...$indexes);
        });

        $this->assertNull($res);
    }

    /**
     * composer test:filter SuppressExceptionsTest::test_suppress_conflict_exception
     */
    public function test_suppress_conflict_exception() {
        $resource = 'example';
        $state = 'deleted';

        $res = $this->exceptions->suppress()->conflict()->try(function () use ($resource, $state) {
            $this->exceptions->force()->conflict($resource, $state);
        });

        $this->assertNull($res);
    }

    /**
     * composer test:filter SuppressExceptionsTest::test_suppress_forbidden_exception
     */
    public function test_suppress_forbidden_exception() {
        $actions = ['ACTION_1', 'ACTION_2'];

        $res = $this->exceptions->suppress()->forbidden()->try(function () use ($actions) {
            $this->exceptions->force()->forbidden(...$actions);
        });

        $this->assertNull($res);
    }

    /**
     * composer test:filter SuppressExceptionsTest::test_suppress_internal_server_error_exception
     */
    public function test_suppress_internal_server_error_exception() {
        $errors = ['erro1' => 'contexto', 'erro2' => 'contexto'];

        $res = $this->exceptions->suppress()->internalServerError()->try(function () use ($errors) {
            $this->exceptions->force()->internalServerError($errors);
        });

        $this->assertNull($res);
    }

    /**
     * composer test:filter SuppressExceptionsTest::test_suppress_not_found_exception
     */
    public function test_suppress_not_found_exception() {
        $index = 'index';
        $where = 'where';

        $res = $this->exceptions->suppress()->notFound()->try(function () use ($index, $where) {
            $this->exceptions->force()->notFound($index, $where);
        });

        $this->assertNull($res);
    }

    /**
     * composer test:filter SuppressExceptionsTest::test_suppress_unauthorized_exception
     */
    public function test_suppress_unauthorized_exception() {
        $reason = 'example';

        $res = $this->exceptions->suppress()->unauthorized()->try(function () use ($reason) {
            $this->exceptions->force()->unauthorized($reason);
        });

        $this->assertNull($res);
    }

    /**
     * composer test:filter SuppressExceptionsTest::test_suppress_unprocessable_entity_exception
     */
    public function test_suppress_unprocessable_entity_exception() {
        $entity = 'it';
        $reason = 'example';

        $res = $this->exceptions->suppress()->unprocessableEntity()->try(function () use ($entity, $reason) {
            $this->exceptions->force()->unprocessableEntity($entity, $reason);
        });

        $this->assertNull($res);
    }
}