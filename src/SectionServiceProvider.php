<?php

namespace Sedehi\Section;

use Faker\Generator as FakerGenerator;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;

class SectionServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                                 __DIR__.'/../resources/views' => resource_path('views/admin'),
                             ], 'section-assets');
        }
        $this->factories();
    }

    public function register()
    {
        $this->app->register(ArtisanServiceProvider::class);
    }

    protected function factories()
    {
        if (in_array($this->app->environment(), ['local', 'testing'])) {
            $this->app->singleton(EloquentFactory::class, function ($app) {
                return EloquentFactory::construct($app->make(FakerGenerator::class), __DIR__.'/database/factories');
            });
        }
    }
}
