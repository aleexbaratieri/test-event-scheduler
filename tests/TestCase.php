<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function initDatabase()
    {
        Artisan::call('migrate');
        Artisan::call('module:migrate EventScheduler');
    }

    protected function resetDatabase()
    {
        Artisan::call('migrate:reset');
    }
}
