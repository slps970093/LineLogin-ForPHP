<?php


use PHPUnit\Framework\TestCase;

class LineAuthorizationTest extends TestCase{
    /**
     * @var ArrayObject
     */
    private $config;

    /**
     * @before
     */
    public function beforeTest(){
        $this->config =  new ArrayObject();
        $this->config->client_id = 'helloworld';
        $this->config->client_scope = urlencode('HelloASSS');
    }

    /**
     * @test
     */
    public function createUrl(){
        $config = $this->config;

        $host = 'http://miles.com';

        $parameter = [
            'response_type' => urlencode('code'),
            'client_id' => urlencode($config->client_id),
            'scope' => urlencode($config->client_scope),
            'state' => urlencode('helloworld'),
            'redirect_uri' => $host.'/callback'
        ];

        $newUrl = $host . "?" . http_build_query($parameter);

        $afterCreateUrl = $host . "?response_type=". urlencode('code') .
            "&client_id=". $config->client_id .
            "&scope=". urlencode($config->client_scope) .
            "&state=". urlencode('helloworld') .
            "&redirect_uri=". urlencode($host ."/callback");

        $this->assertEquals($afterCreateUrl,$newUrl);
    }

    /**
     * @test
     */
    public function createUrlAppend(){
        $config = $this->config;

        $host = 'http://miles.com';

        $parameter = [
            'response_type' => urlencode('code'),
            'client_id' => urlencode($config->client_id),
            'scope' => urlencode($config->client_scope),
            'state' => urlencode('helloworld'),
            'redirect_uri' => $host.'/callback'
        ];

        $parameter = array_merge($parameter,['hello' => urlencode('world')]);
        $newUrl = $host . "?" . http_build_query($parameter);

        $afterCreateUrl = $host . "?response_type=". urlencode('code') .
            "&client_id=". $config->client_id .
            "&scope=". urlencode($config->client_scope) .
            "&state=". urlencode('helloworld') .
            "&redirect_uri=". urlencode($host ."/callback") .
            "&hello=".urlencode('world');

        $this->assertEquals($newUrl,$afterCreateUrl);
    }

}
