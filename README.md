# PHP Smoke Lib

[![Build Status](https://travis-ci.org/jhryniuk/php-smoke-lib.svg?branch=master)](https://travis-ci.org/jhryniuk/php-smoke-lib)

### Description
This library allows to run simple smoke tests in php

### Usage

```php
<?php
use Smoke\Smoke\Smoke;
use GuzzleHttp\Client;

$addresses = [
    [
        'request' => [
            'method' => 'GET',
            'uti' => 'http://www.google.com',
            'options' => [],
        ],
        'expectedResponse' => [
            'statusCode' => 200,
            'inBody' => 'Google'
        ]
    ],
];

$result = [];
$check = new Smoke(new Client());
foreach ($addresses as $address) {
    $result[] = $check->checkAddress(
        $address['request']['method'],
        $address['request']['uri'],
        $address['expectedResponse']['statusCode'],
        $address['request']['options'],
        $address['expectedResponse']['inBody']
    );
}
```
