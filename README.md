# cauri

Cauri

## Documentation

https://docs.pa.cauri.com/api/

## Install

```bash
1. composer config repositories.vepay/commongateway vcs https://git.vepay.cf/backend/commongateway.git
2. composer config repositories.vepay/cauri vcs http://git.vepay.cf/backend/cauri.git
3. composer require vepay/cauri:dev-develop
```

## Integration

#### Example - User
```php

Config::getInstance()->logger = Logger::class;
Config::getInstance()->logLevel = LoggerInterface::TRACE_LOG_LEVEL;

$response = (new User())->resolve(
    [
        'identifier' => 1,
        'display_name' => 'Example User',
        'email' => 'user@example.com',
        'phone' => '123456789',
        'locale' => 'en',
        'ip' => '127.0.0.1',
    ],
    [
        'public_key' => 'you_public_key',
        'private_key' => 'you_private_key',
    ]
);
```

## Packages
The are Packages and versions in file - composer.json

## Vendors
execute: composer install

## PHPUnits
execute: vendor/bin/phpunit

## Data and keys
tests/InitializationTrait.php