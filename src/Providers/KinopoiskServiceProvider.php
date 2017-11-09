<?php

namespace Wielski\Kinopoisk\Providers;

use Illuminate\Support\ServiceProvider;
use Wielski\Kinopoisk\Client;

/**
 * Class KinopoiskServiceProvider
 * @package Wielski\Kinopoisk\Providers
 */
class KinopoiskServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function boot()
    {
        $this->publishes([
            $this->defaultConfig() => config_path('kinopoisk.php'),
        ]);
    }

    /**
     * Register service provider
     */
    public function register()
    {
        $this->setupConfiguration();

        $this->app->singleton(Client::class, function () {
            return new Client(config('kinopoisk.secret'), config('kinopoisk.client'));
        });

        $this->app->alias(Client::class, 'kinopoisk');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['kinopoisk'];
    }

    /**
     * Setup configuration
     *
     * @return  void
     */
    private function setupConfiguration()
    {
        $config = $this->defaultConfig();
        $this->mergeConfigFrom($config, 'kinopoisk');
    }

    /**
     * Returns the default configuration path
     *
     * @return string
     */
    private function defaultConfig()
    {
        return dirname(__DIR__) . '/config/kinopoisk.php';
    }
}
