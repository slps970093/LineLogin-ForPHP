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

        $newUrl = self::getUrl($host,$parameter);

        $afterCreateUrl = $host . "?response_type=". urlencode('code') .
            "&client_id=". $config->client_id .
            "&scope=". urlencode($config->client_scope) .
            "&state=". urlencode('helloworld') .
            "&redirect_uri=". $host ."/callback";

        $this->assertEquals($newUrl,$afterCreateUrl);
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
        $newUrl = self::getUrl($host,$parameter);

        $afterCreateUrl = $host . "?response_type=". urlencode('code') .
            "&client_id=". $config->client_id .
            "&scope=". urlencode($config->client_scope) .
            "&state=". urlencode('helloworld') .
            "&redirect_uri=". $host ."/callback" .
            "&hello=".urlencode('world');

        $this->assertEquals($newUrl,$afterCreateUrl);
    }

    private function getUrl($host,$parameter){
        $url = $host;
        $count = 0;
        foreach ($parameter as $key => $value){
            if ($count == 0){
                $url .= "?" . $key . "=" . $value;
            }else{
                $url .= "&" . $key . "=" . $value;
            }
            $count++;
        }
        return $url;
    }


}
