<?php

namespace PillarScience\LaravelPivotSoftdeletesEvents\Tests\SoftDeletes;

/**
 * Class ServiceProvider
 *
 * @package SoftDeletes
 *
 * @author Mathieu Tanguay <mathieu@pillar.science>
 * @copyright Pillar Science
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        //register
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations/');
    }

    protected function loadMigrationsFrom($path)
    {
        \Artisan::call('migrate:fresh', ['--database' => 'testbench']);
    }
}
