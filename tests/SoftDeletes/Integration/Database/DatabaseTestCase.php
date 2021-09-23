<?php

namespace PillarScience\LaravelPivotSoftdeletesEvents\Tests\SoftDeletes\Integration\Database;

use Orchestra\Testbench\TestCase;
use PillarScience\LaravelPivotSoftdeletesEvents\Tests\SoftDeletes\ServiceProvider;

class DatabaseTestCase extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.debug', 'true');

        $app['config']->set('database.default', 'testbench');

        $app['config']->set('database.connections.testbench', [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', ''),
            'username' => env('DB_USERNAME', ''),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => 'softdeletes_',
            'strict' => true,
            'engine' => null,
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }
}
