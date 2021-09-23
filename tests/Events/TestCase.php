<?php

namespace PillarScience\LaravelPivotSoftdeletesEvents\Tests\Events;

use PillarScience\LaravelPivotSoftdeletesEvents\Tests\Events\Models\Post;
use PillarScience\LaravelPivotSoftdeletesEvents\Tests\Events\Models\Role;
use PillarScience\LaravelPivotSoftdeletesEvents\Tests\Events\Models\Seller;
use PillarScience\LaravelPivotSoftdeletesEvents\Tests\Events\Models\Tag;
use PillarScience\LaravelPivotSoftdeletesEvents\Tests\Events\Models\User;
use PillarScience\LaravelPivotSoftdeletesEvents\Tests\Events\Models\Video;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    public static $events = [];

    public function setUp(): void
    {
        parent::setUp();

        User::create(['name' => 'example@example.com']);
        User::create(['name' => 'example2@example.com']);

        Seller::create(['name' => 'seller 1']);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'customer']);
        Role::create(['name' => 'driver']);

        Post::create(['name' => 'Learn Laravel in 30 days']);
        Post::create(['name' => 'Vue.js for Dummies']);

        Video::create(['name' => 'Laravel from Scratch']);
        Video::create(['name' => 'ES2015 Fundamentals']);

        Tag::create(['name' => 'technology']);
        Tag::create(['name' => 'laravel']);
        Tag::create(['name' => 'java-script']);

        $this->assertEquals(0, \DB::table('role_user')->count());
        $this->assertEquals(0, \DB::table('seller_user')->count());
        $this->assertEquals(0, \DB::table('taggables')->count());

        \Event::listen('eloquent.*', function ($eventName, array $data) {
            if (0 !== strpos($eventName, 'eloquent.retrieved') && 0 !== strpos($eventName, 'eloquent.booting') && 0 !== strpos($eventName, 'eloquent.booted')) {
                self::$events[] = array_merge([$eventName], $data);
            }
        });
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
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
            'prefix' => 'events_',
            'strict' => true,
            'engine' => null,
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }
}
