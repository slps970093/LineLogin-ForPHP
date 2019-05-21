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

        $newUrl = $host;
        $count = 0;
        foreach ($parameter as $key => $value){
            if ($count == 0){
                $newUrl .= "?" . $key . "=" . $value;
            }else{
                $newUrl .= "&" . $key . "=" . $value;
            }
            $count++;
        }


        $afterCreateUrl = $host . "?response_type=". urlencode('code') .
            "&client_id=". $config->client_id .
            "&scope=". urlencode($config->client_scope) .
            "&state=". urlencode('helloworld') .
            "&redirect_uri=". $host ."/callback";
        $this->assertEquals($newUrl,$afterCreateUrl);
    }


}
