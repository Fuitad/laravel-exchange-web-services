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

    /*
    |--------------------------------------------------------------------------
    | Default Account
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
     */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Exchange Accounts
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
     */

    'connections' => [
        'main' => [
            'username' => env('EWS_USERNAME'),
            'password' => env('EWS_PASSWORD'),
            'delegate' => env('EWS_DELEGATE', null),
            'url' => env('EWS_URL'),
        ],
    ],

];
