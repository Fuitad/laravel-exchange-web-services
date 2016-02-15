<?php
/**
 * This file is part of the Laravel-EWS package.
 *
 * @copyright Pierre-Luc Brunet <fuitad@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Configuration options for your Exchange Web Services account.
 */
return [
    'exchange-web-services' => [

        'username' => env('EWS_USERNAME'),
        'password' => env('EWS_PASSWORD'),
        'delegate' => env('EWS_DELEGATE', null),
        'url' => env('EWS_URL'),
    ],
];
