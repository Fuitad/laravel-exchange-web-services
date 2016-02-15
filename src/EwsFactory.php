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
use InvalidArgumentException;

class EwsFactory
{
    /**
     * Make a new ExchangeClient client.
     *
     * @param array $config
     *
     * @return \ExchangeClient\ExchangeClient
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);
        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config)
    {
        $keys = [
            'username',
            'password',
            'delegate',
            'url',
        ];
        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }
        return array_only($config, $keys);
    }

    /**
     * Get the ExchangeClient client.
     *
     * @param string[] $config
     *
     * @return ExchangeClient\ExchangeClient
     */
    protected function getClient(array $config)
    {
        return new ExchangeClient(
            $config['username'],
            $config['password'],
            $config['delegate'],
            $config['url']
        );
    }
}
