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

use EwsBridge\EwsManager;
use EwsBridge\Facade\ExchangeWebServices;
use EwsBridge\Tests\AbstractTestCase;
use GrahamCampbell\TestBenchCore\FacadeTrait;

class ExchangeWebServicesTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'exchange-web-services';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return ExchangeWebServices::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return EwsManager::class;
    }
}
