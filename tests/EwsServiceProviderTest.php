<?php
/**
 * This file is part of the Laravel-EWS package.
 *
 * @copyright Pierre-Luc Brunet <fuitad@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EwsBridge\Tests;

use EwsBridge\EwsFactory;
use EwsBridge\EwsManager;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

class EwsServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testEwsFactoryIsInjectable()
    {
        $this->assertIsInjectable(EwsFactory::class);
    }

    public function testEwsManagerIsInjectable()
    {
        $this->assertIsInjectable(EwsManager::class);
    }

    public function testBindings()
    {
        //$this->assertIsInjectable(ExchangeClient::class);
        $original = $this->app['exchange-web-services.connection'];
        $this->app['exchange-web-services']->reconnect();
        $new = $this->app['exchange-web-services.connection'];
        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
