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

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

class EwsManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \EwsBridge\EwsFactory
     */
    private $factory;

    /**
     * Create a new EwsManager manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \EwsBridge\EwsFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, EwsFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return mixed
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'exchange-web-services';
    }

    /**
     * Get the factory instance.
     *
     * @return \EwsBridge\EwsFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
