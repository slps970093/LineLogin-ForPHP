<?php


use PHPUnit\Framework\TestCase;

class LineProfileTest extends TestCase{

    /**
     * @var array
     */
    private $configs;

    /**
     * @before
     */
    public function testBefore(){
        $this->configs = [
            'client_id' => 'hello',
            'client_secret' => 'world',
            'client_scope' => 'aaaa',
            'redirect_uri' => 'http://miles.com'
        ];
    }

    /**
     * @test
     */
    public function callApiGetAccessTokens(){
        $code = "123456798";

        $postData = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->configs['redirect_uri'],
            'client_id' => $this->configs['client_id'],
            'client_secret' => $this->configs['client_secret']
        ];

        $res = $this->fakeApiGetAccessToken($postData);

        $this->assertEquals("tokenDemo",$res['access_token']);
    }

    /**
     * Fake Api 用於模擬 Line Server 回傳資訊 (Access Token)
     * @param $postData
     * @return array|null
     */
    private function fakeApiGetAccessToken($postData){
        $afterRes = [
            'grant_type' => 'authorization_code',
            'code' => "123456798",
            'redirect_uri' => 'http://miles.com',
            'client_id' => 'hello',
            'client_secret' => 'world'
        ];

        if (count(array_diff($postData,$afterRes)) == 0){
            return [
                'access_token' => "tokenDemo",
                'token_type' => 'Bearer',
                'refresh_token' => uniqid(20),
                'expires_in' => 26400,
                'scope' => 'profile openid',
                'id_token' => md5(uniqid())
            ];
        }

        return null;
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

        $res = $this->fakeApiGetUserProfile($header);

        $after = [
            'userId' => "6666",
            'displayName' => 'LineUserFake',
            'pictureUrl' => 'https://profile.line-scdn.net/666666',
            'statusMessage' => '777'
        ];

        $this->assertEquals($after,$res);
    }

    /**
     * Fake Api 用於模擬 Line Server 回傳資訊 (Profile)
     * @param $header
     * @return array|null
     */
    public function fakeApiGetUserProfile($header){
        $afterHeader = [
            "content-type: application/x-www-form-urlencoded",
            "charset=UTF-8",
            'Authorization: Bearer hello_World',
        ];

        if (count(array_diff($afterHeader,$header)) == 0){
            return [
                'userId' => "6666",
                'displayName' => 'LineUserFake',
                'pictureUrl' => 'https://profile.line-scdn.net/666666',
                'statusMessage' => '777'
            ];
        }

        return null;
    }
}