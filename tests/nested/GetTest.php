<?php

namespace SandboxTest\Nested;

use SandboxTest\TestBase;

class GetTest extends TestBase
{
    /**
     * @test
     * @return \GuzzleHttp\Message\Response
     */
    public function responseOk()
    {
        $response = $this->client()->get('/nested');
        $this->assertEquals(200, $response->getStatusCode());

        return $response;
    }

    /**
     * @test
     * @depends responseOk
     * @param \GuzzleHttp\Message\Response $response
     */
    public function hasDocumentedKeys($response)
    {
        $this->responseHasSwaggerKeys($response, 'get', '/nested');
    }
}