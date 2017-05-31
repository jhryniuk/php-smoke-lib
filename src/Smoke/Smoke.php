<?php

namespace Smoke\Smoke;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class Smoke
{
    private $client;

    /**
     * Smoke constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function checkAddress($method, $uri, $statusCode, $options = [], $inBody = '')
    {
        $check = $this->client->request($method, $uri, $options);

        switch ($inBody) {
            case '':
                $result = [
                    'uri' => $uri,
                    'status' => $this->checkOnlyStatusCode($check, $statusCode),
                ];
                break;
            default:
                $result = [
                    'uri' => $uri,
                    'status' => $this->checkStatusAndBodyContent($check, $statusCode, $inBody)
                ];
                break;
        }

        return $result;
    }

    private function checkOnlyStatusCode(Response $check, $statusCode)
    {
        if ($check->getStatusCode() === $statusCode) {
            return 'OK!';
        }

        return 'FAIL!';
    }

    private function checkStatusAndBodyContent(Response $check, $statusCode, $inBody)
    {
        if ($check->getStatusCode() === $statusCode && preg_match('/'.$inBody.'/', $check->getBody())) {
            return 'OK!';
        }

        return 'FAIL!';
    }
}
