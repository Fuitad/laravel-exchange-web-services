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

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->loadConfiguration();
    }

    /**
     * Check if we are running Lumen or not.
     *
     * @return bool
     */
    protected function isLumen()
    {
        return strpos($this->app->version(), 'Lumen') !== false;
    }

    /**
     * Load the configuration files and allow them to be published.
     *
     * @return void
     */
    protected function loadConfiguration()
    {
        $configPath = __DIR__ . '/../config/exchange-web-services.php';

        if (!$this->isLumen()) {
            $this->publishes([$configPath => config_path('exchange-web-services.php')], 'config');
        }

        $this->mergeConfigFrom($configPath, 'exchange-web-services');
    }

}
