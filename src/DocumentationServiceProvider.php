<?php

namespace g4t\Documentation;

use Illuminate\Support\ServiceProvider;

class DocumentationServiceProvider extends ServiceProvider
{

        /**
         * Perform post-registration booting of services.
         *
         * @return void
         */
        public function boot()
        {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
            $this->loadViewsFrom(__DIR__.'/resources/views', 'documentation');
            $this->app['router']->namespace('g4t\\Documentation\\Controllers')
                ->middleware(['web'])
                ->group(function () {
                    $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
                });

            $this->app['router']->namespace('g4t\\Documentation\\Controllers')
                ->middleware(['api'])
                ->group(function () {
                    $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
                });

            if ($this->app->runningInConsole()) {
                $this->bootForConsole();
            }
        }

        /**
         * Register any package services.
         *
         * @return void
         */
        public function register()
        {
            $this->mergeConfigFrom(__DIR__.'/../config/documentation.php', 'documentation');
        }

        /**
         * Get the services provided by the provider.
         *
         * @return array
         */
        public function provides()
        {
            return ['documentation'];
        }

        /**
         * Console-specific booting.
         *
         * @return void
         */
        protected function bootForConsole()
        {
            $this->publishes([
                __DIR__.'/../config/documentation.php' => config_path('documentation.php'),
            ], 'documentation.config');

            $this->publishes([
                __DIR__ . '/public' => public_path('g4t'),
            ], 'public');


        }


}
