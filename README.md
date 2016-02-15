Exchange Web Services bridge for Laravel 5
==============

# Installation

Require this package with Composer

```bash
composer require fuitad/laravel-exchange-web-services
```

# Quick Start

Once Composer has installed or updated your packages you need to register EwsBridge with Laravel itself. Open up config/app.php and find the providers key, towards the end of the file, and add 'EwsBridge\EwsServiceProvider::class', to the end:

```php
'providers' => [
     ...
                EwsBridge\EwsServiceProvider::class
],
```

Now find the alliases key, again towards the end of the file, and add 'ExchangeWebServices' => 'EwsBridge\Facade\ExchangeWebServices::class', to have easier access to the EwsBridge:

```php
'aliases' => [
    ... 
                'ExchangeWebServices' => EwsBridge\Facade\ExchangeWebServices::class
],
```

Now that you have the both of these added to config/app.php we will use Artisan to add the new ews config file:

```php
php artisan vendor:publish --provider="EwsBridge\EwsServiceProvider"
```

Most of the config values are fetch from your .env file so you'll want to add the following variables in your ENV file:

```
EWS_USERNAME=email@account.com OR domain\username
EWS_PASSWORD=password123
EWS_URL=https://mail.myserver.com/EWS/
```

If you need to log into a delegate account, you'll also need to add the following variable:

```
EWS_DELEGATE=delegatemailbox@account.com
```
