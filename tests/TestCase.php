<?php

namespace SafeThrow\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use SafeThrow\SafeThrowServiceProvider;

class TestCase extends BaseTestCase {
    protected function setUp(): void {
        parent::setUp();
    }

    public static function setUpBeforeClass(): void {
        parent::setUpBeforeClass();
    }

    protected function getPackageProviders($app): array {
        return [
            SafeThrowServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app) {
        // $app['config']->set('key', 'value');
    }
}