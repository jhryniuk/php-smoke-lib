# PHP Smoke Lib

### Description
This library allows to run simple smoke tests in php

### Usage

```php
<?php
use Smoke\Smoke\Smoke;
use GuzzleHttp\Client;

$addresses = [
    [
        'method' => 'GET',
        'uti' => 'http://www.google.com',
        'statusCode' => 200,
        'options' => [],
        'inBody' => 'Google'
    ],
];

$result = [];
$check = new Smoke(new Client());
foreach ($addresses as $address) {
    $result[] = $check->checkAddress(
        $address['method'],
        $address['uri'],
        $address['statusCode'],
        $address['options'],
        $address['inBody']
    );
}
```