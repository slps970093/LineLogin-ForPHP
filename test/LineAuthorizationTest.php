<?php


use PHPUnit\Framework\TestCase;

class LineAuthorizationTest extends TestCase{

    /**
     * @var array
     */
    private $config;

    /**
     * @before
     */
    public function beforeTest(){
        $this->config = [
            'client_id' => 'helloworld',
            'client_scope' => urlencode('HelloASSS')
        ];
    }

    /**
     * @test
     */
    public function createAuthUrl(){
        $config = $this->config;

        $host = 'https://access.line.me/oauth2/v2.1/authorize';

        $parameter = [
            'response_type' => urlencode('code'),
            'client_id' => urlencode($config['client_id']),
            'scope' => urlencode($config['client_scope']),
            'state' => urlencode('helloworld'),
            'redirect_uri' => $host.'/callback'
        ];

        $newUrl = $host . "?" . http_build_query($parameter);

        $afterCreateUrl = $host . "?response_type=". urlencode('code') .
            "&client_id=". $config['client_id'] .
            "&scope=". urlencode($config['client_scope']) .
            "&state=". urlencode('helloworld') .
            "&redirect_uri=". urlencode($host ."/callback");

        $this->assertEquals($afterCreateUrl,$newUrl);
    }



}
