<?php
/**
 * This file is part of the Laravel-EWS package.
 *
 * @copyright Pierre-Luc Brunet <fuitad@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EwsBridge;

use ExchangeClient\ExchangeClient;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class EwsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Load the configuration files and allow them to be published.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/../config/exchange-web-services.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('exchange-web-services.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('exchange-web-services');
        }

        $this->mergeConfigFrom($source, 'exchange-web-services');
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('exchange-web-services.factory', function ($app) {
            return new EwsFactory($app);
        });

        $this->app->alias('exchange-web-services.factory', EwsFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('exchange-web-services', function (Container $app) {
            $config = $app['config'];
            $factory = $app['exchange-web-services.factory'];

            return new EwsManager($config, $factory);
        });

        $this->app->alias('exchange-web-services', EwsManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('exchange-web-services.connection', function (Container $app) {
            $manager = $app['exchange-web-services'];
            return $manager->connection();
        });

        $this->app->alias('exchange-web-services.connection', ExchangeClient::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'exchange-web-services',
            'exchange-web-services.factory',
            'exchange-web-services.connection',
        ];
    }

}
