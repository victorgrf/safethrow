<?php

namespace SafeThrow\Tests;

use SafeThrow\Exceptions\BadRequestException;
use SafeThrow\Exceptions\ConflictException;
use SafeThrow\Exceptions\Defaults\HttpException;
use SafeThrow\Exceptions\ForbiddenException;
use SafeThrow\Exceptions\InternalServerErrorException;
use SafeThrow\Exceptions\NotFoundException;
use SafeThrow\Exceptions\UnauthorizedException;
use SafeThrow\Exceptions\UnprocessableEntityException;
use SafeThrow\Facades\Exceptions;
use SafeThrow\Facades\Handler;

/**
 * composer test:filter FromResponseTest
 */
class FromResponseTest extends TestCase {
    private Exceptions $exceptions;

    protected function setUp(): void {
        $this->exceptions = new Exceptions();
    }

    private function fakeGenerateException(HttpException $exception) {
        $error_response = ['message' => $exception->getMessage()];

        if ($exception->getErrors()) {
            $error_response['errors'] = $exception->getErrors();
        }
        $error_response['safethrow-type'] = $exception->getType();

        return $error_response;
    }

    /**
     * composer test:filter FromResponseTest::test_from_response_bad_request_exception
     */
    public function test_from_response_bad_request_exception() {
        $indexes = ['index1', 'index2'];

        $fakeException = new BadRequestException($indexes);
        $fakeResponse = $this->fakeGenerateException($fakeException, false);

        $this->expectException(BadRequestException::class);
        $this->exceptions->throwFromResponse($fakeResponse);
    }

    /**
     * composer test:filter FromResponseTest::test_from_response_conflict_exception
     */
    public function test_from_response_conflict_exception() {
        $resource = 'example';
        $state = 'deleted';

        $fakeException = new ConflictException($resource, $state);
        $fakeResponse = $this->fakeGenerateException($fakeException, false);

        $this->expectException(ConflictException::class);
        $this->exceptions->throwFromResponse($fakeResponse);
    }

    /**
     * composer test:filter FromResponseTest::test_from_response_forbidden_exception
     */
    public function test_from_response_forbidden_exception() {
        $actions = ['ACTION_1', 'ACTION_2'];

        $fakeException = new ForbiddenException($actions);
        $fakeResponse = $this->fakeGenerateException($fakeException, false);

        $this->expectException(ForbiddenException::class);
        $this->exceptions->throwFromResponse($fakeResponse);
    }

    /**
     * composer test:filter FromResponseTest::test_from_response_internal_server_error_exception
     */
    public function test_from_response_internal_server_error_exception() {
        $errors = ['erro1' => 'contexto', 'erro2' => 'contexto'];

        $fakeException = new InternalServerErrorException($errors);
        $fakeResponse = $this->fakeGenerateException($fakeException, false);

        $this->expectException(InternalServerErrorException::class);
        $this->exceptions->throwFromResponse($fakeResponse);
    }

    /**
     * composer test:filter FromResponseTest::test_from_response_not_found_exception
     */
    public function test_from_response_not_found_exception() {
        $index = 'index';
        $where = 'where';

        $fakeException = new NotFoundException($index, $where);
        $fakeResponse = $this->fakeGenerateException($fakeException, false);

        $this->expectException(NotFoundException::class);
        $this->exceptions->throwFromResponse($fakeResponse);
    }

    /**
     * composer test:filter FromResponseTest::test_from_response_unauthorized_exception
     */
    public function test_from_response_unauthorized_exception() {
        $reason = 'example';

        $fakeException = new UnauthorizedException($reason);
        $fakeResponse = $this->fakeGenerateException($fakeException, false);

        $this->expectException(UnauthorizedException::class);
        $this->exceptions->throwFromResponse($fakeResponse);
    }

    /**
     * composer test:filter FromResponseTest::test_from_response_unprocessable_entity_exception
     */
    public function test_from_response_unprocessable_entity_exception() {
        $entity = 'it';
        $reason = 'example';

        $fakeException = new UnprocessableEntityException($entity, $reason);
        $fakeResponse = $this->fakeGenerateException($fakeException, false);

        $this->expectException(UnprocessableEntityException::class);
        $this->exceptions->throwFromResponse($fakeResponse);
    }
}