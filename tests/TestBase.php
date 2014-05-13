<?php

namespace SandboxTest;

use GuzzleHttp\Client;
use SwaggerAssert\SwaggerAssert;

class TestBase extends \PHPUnit_Framework_TestCase
{
    /** @var client */
    protected $client;

    /**
     * @return Client
     */
    protected function client()
    {
        if ($this->client) {
            return $this->client;
        }
        $this->client = new Client(['base_url' => 'http://localhost:8080']);

        return $this->client;
    }

    /**
     * @param \GuzzleHttp\Message\Response $response
     * @param string $httpMethod
     * @param string $url
     * @param bool $onlyRequired
     */
    protected function responseHasSwaggerKeys($response, $httpMethod, $url, $onlyRequired = true)
    {
        $response = json_decode($response->getBody()->__toString(), true);
        $result = SwaggerAssert::responseHasSwaggerKeys($response, $httpMethod, $url, $onlyRequired);

        $this->assertTrue($result);
    }
}