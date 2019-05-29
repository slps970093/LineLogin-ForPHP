<?php


use PHPUnit\Framework\TestCase;

class LineProfileTest extends TestCase{

    /**
     * @var ArrayObject
     */
    private $configs;

    /**
     * @before
     */
    public function testBefore(){
        $this->configs = new ArrayObject();
        $this->configs->client_id = 'hello';
        $this->configs->client_secret = 'world';
        $this->configs->client_scope = 'aaaa';
        $this->configs->redirect_uri = 'http://miles.com';
    }

    /**
     * @test
     */
    public function createAccessTokenPostField(){
        $code = "123456798";

        $postData = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->configs->redirect_uri,
            'client_id' => $this->configs->client_id,
            'client_secret' => $this->configs->client_secret
        ];

        $afterRes = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => 'http://miles.com',
            'client_id' => 'hello',
            'client_secret' => 'world'
        ];

        $this->assertEquals($afterRes,$postData);
    }

    /**
     * @test
     */
    public function createProfileHeader(){
        $token = "hello_World";
        $header = [
            "content-type: application/x-www-form-urlencoded",
            "charset=UTF-8",
            'Authorization: Bearer '.$token,
        ];

        $afterHeader = [
            "content-type: application/x-www-form-urlencoded",
            "charset=UTF-8",
            'Authorization: Bearer hello_World',
        ];

        $this->assertEquals($afterHeader,$header);
    }

}