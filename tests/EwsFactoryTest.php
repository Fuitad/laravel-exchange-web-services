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
use ExchangeClient\ExchangeClient;

class EwsFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getEwsFactory();

        $return = $factory->make([
            'username' => 'email@account.com',
            'password' => 'password123',
            'delegate' => null,
            'url' => 'https://mail.myserver.com/EWS/Services.wsdl',
        ]);

        $this->assertInstanceOf(ExchangeClient::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutUsername()
    {
        $factory = $this->getEwsFactory();

        $factory->make([
            'password' => 'password123',
            'delegate' => null,
            'url' => 'https://mail.myserver.com/EWS/Services.wsdl',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutPassword()
    {
        $factory = $this->getEwsFactory();

        $factory->make([
            'username' => 'email@account.com',
            'delegate' => null,
            'url' => 'https://mail.myserver.com/EWS/Services.wsdl',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutUrl()
    {
        $factory = $this->getEwsFactory();

        $factory->make([
            'username' => 'email@account.com',
            'password' => 'password123',
            'delegate' => null,
        ]);
    }

    protected function getEwsFactory()
    {
        return new EwsFactory();
    }
}
