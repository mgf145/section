<?php

namespace Sedehi\Section;

use Faker\Generator as FakerGenerator;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Foundation\Providers\ArtisanServiceProvider as LaravelArtisanServiceProvider;
use Sedehi\Section\Console\SectionAdd;
use Sedehi\Section\Console\SectionController;
use Sedehi\Section\Console\SectionEvent;
use Sedehi\Section\Console\SectionFactory;
use Sedehi\Section\Console\InstallCommand;
use Sedehi\Section\Console\SectionJob;
use Sedehi\Section\Console\SectionMail;
use Sedehi\Section\Console\SectionMigration;
use Sedehi\Section\Console\SectionModel;
use Sedehi\Section\Console\SectionNotification;
use Sedehi\Section\Console\SectionPolicy;
use Sedehi\Section\Console\SectionRequest;
use Sedehi\Section\Console\SectionResource;
use Sedehi\Section\Console\SectionRule;
use Sedehi\Section\Console\SectionSeed;
use Sedehi\Section\Console\SectionTest;
use Sedehi\Section\Console\SectionView;

class ArtisanServiceProvider extends LaravelArtisanServiceProvider
{

    /**
     * Perform post-registration booting of services.
     * @return void
     */
    public function boot(){

        $this->commands([
                            SectionAdd::class,
                            SectionView::class,
                            InstallCommand::class
                        ]);
    }

    protected function registerResourceMakeCommand(){

        $this->app->singleton('command.resource.make', function($app){

            return new SectionResource($app['files']);
        });
    }

    protected function registerMailMakeCommand(){

        $this->app->singleton('command.mail.make', function($app){

            return new SectionMail($app['files']);
        });
    }

    protected function registerNotificationMakeCommand(){

        $this->app->singleton('command.notification.make', function($app){

            return new SectionNotification($app['files']);
        });
    }

    protected function registerRequestMakeCommand(){

        $this->app->singleton('command.request.make', function($app){

            return new SectionRequest($app['files']);
        });
    }

    protected function registerJobMakeCommand(){

        $this->app->singleton('command.job.make', function($app){

            return new SectionJob($app['files']);
        });
    }

    protected function registerPolicyMakeCommand(){

        $this->app->singleton('command.policy.make', function($app){

            return new SectionPolicy($app['files']);
        });
    }

    protected function registerFactoryMakeCommand(){

        $this->app->singleton('command.factory.make', function($app){

            return new SectionFactory($app['files']);
        });
    }

    protected function registerEventMakeCommand(){

        $this->app->singleton('command.event.make', function($app){

            return new SectionEvent($app['files']);
        });
    }

    protected function registerSeederMakeCommand(){

        $this->app->singleton('command.seeder.make', function($app){

            return new SectionSeed($app['files'], $app['composer']);
        });
    }

    protected function registerMigrateMakeCommand(){

        $this->app->singleton('command.migrate.make', function($app){

            $creator  = $app['migration.creator'];
            $composer = $app['composer'];

            return new SectionMigration($creator, $composer);
        });
    }

    protected function registerModelMakeCommand(){

        $this->app->singleton('command.model.make', function($app){

            return new SectionModel($app['files']);
        });
    }

    protected function registerTestMakeCommand(){

        $this->app->singleton('command.test.make', function($app){

            return new SectionTest($app['files']);
        });
    }

    protected function registerRuleMakeCommand(){

        $this->app->singleton('command.rule.make', function($app){

            return new SectionRule($app['files']);
        });
    }

    protected function registerControllerMakeCommand(){

        $this->app->singleton('command.controller.make', function($app){

            return new SectionController($app['files']);
        });
    }
}