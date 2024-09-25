<?php

namespace SafeThrow\Tests;

use Exception;
use SafeThrow\Exceptions\BadRequestException;
use SafeThrow\Exceptions\ConflictException;
use SafeThrow\Exceptions\Defaults\HttpException;
use SafeThrow\Facades\Exceptions;
use Symfony\Component\HttpFoundation\Response;

/**
 * composer test:filter ExceptionsTest
 */
class ExceptionsTest extends TestCase {
    private Exceptions $exceptions;

    protected function setUp(): void {
        $this->exceptions = new Exceptions();
    }

    /**
     * composer test:filter ExceptionsTest::test_bad_request_exception
     */
    public function test_bad_request_exception() {
        $indexes = ['index1', 'index2'];

        $res = $this->exceptions->suppress()->badRequest()->try(function () use ($indexes) {
            $this->exceptions->force()->badRequest(...$indexes);
        });

        $this->assertNull($res);

        try {
            $this->exceptions->force()->badRequest(...$indexes);
        } catch (Exception $e) {
            $this->assertInstanceOf(BadRequestException::class, $e);
            $this->assertInstanceOf(HttpException::class, $e);
            $this->assertNotEmpty($e->getIndexes());
            $this->assertEquals($e->getIndexes(), $indexes);
            $this->assertNotEmpty($e->getMessage());
            $this->assertNotEmpty($e->getStatusCode());
            $this->assertEquals($e->getStatusCode(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * composer test:filter ExceptionsTest::test_bad_request_exception
     */
    public function test_conflict_exception() {
        $resource = 'example';
        $state = 'deleted';

        $res = $this->exceptions->suppress()->conflict()->try(function () use ($resource, $state) {
            $this->exceptions->force()->conflict($resource, $state);
        });

        $this->assertNull($res);

        try {
            $this->exceptions->force()->conflict($resource, $state);
        } catch (Exception $e) {
            $this->assertInstanceOf(ConflictException::class, $e);
            $this->assertInstanceOf(HttpException::class, $e);
            $this->assertNotEmpty($e->getResource());
            $this->assertEquals($e->getResource(), $resource);
            $this->assertEquals($e->getState(), $state);
            $this->assertNotEmpty($e->getMessage());
            $this->assertNotEmpty($e->getStatusCode());
            $this->assertEquals($e->getStatusCode(), Response::HTTP_CONFLICT);
        }
    }
}