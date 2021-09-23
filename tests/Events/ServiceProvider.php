<?php

namespace PillarScience\LaravelPivotSoftdeletesEvents\Tests\Events;

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
        \Artisan::call('migrate', ['--database' => 'testbench']);
        $migrator = $this->app->make('migrator');
        $migrator->run($path);
    }
}
