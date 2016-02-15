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
use ExchangeClient\ExchangeClient;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Mockery;

class EwsManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('exchange-web-services.default')->andReturn('exchange-web-services');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(ExchangeClient::class, $return);

        $this->assertArrayHasKey('exchange-web-services', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repository = Mockery::mock(Repository::class);
        $factory = Mockery::mock(EwsFactory::class);

        $manager = new EwsManager($repository, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('exchange-web-services.connections')->andReturn(['exchange-web-services' => $config]);

        $config['name'] = 'exchange-web-services';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(ExchangeClient::class));

        return $manager;
    }
}
