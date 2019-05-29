<?php


namespace LittleChou\LineLogin;


use LittleChou\LineLogin\Exceptions\LineAccessTokenNotFoundException;

class LineProfiles{

    /**
     * @var ConfigManager
     */
    private $configManager;

    public function __construct(ConfigManager $configManager){
        $this->config = $configManager;
    }

    /**
     * 取得用戶端 Profile
     * @param $code
     * @return bool|mixed|string
     * @throws LineAccessTokenNotFoundException
     */
    public function getProfile($code){
        $accessToken = self::getAccessToken($code);
        $headerData = array(
            "content-type: application/x-www-form-urlencoded",
            "charset=UTF-8",
            'Authorization: Bearer '.$accessToken,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headerData);
        curl_setopt($ch , CURLOPT_URL , "https://api.line.me/v2/profile");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);

        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result);
        return $result;
    }

    /**
     * 取得用戶端 Access Token
     * @param $code
     * @return string
     * @throws LineAccessTokenNotFoundException
     */
    private function getAccessToken($code){
        $config = $this->configManager->getConfigs();
        $post = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $config->{ $this->configManager::CLIENT_REDIRECT_URI },
            'client_id' => $config->{ $this->configManager::CLIENT_ID },
            'client_secret' => $config->{ $this->configManager::CLIENT_SECRET },
        ];
        $ch = curl_init();
        curl_setopt($ch , CURLOPT_URL , "https://api.line.me/oauth2/v2.1/token");
        curl_setopt($ch, CURLOPT_HTTPheader, array('Content-type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $post ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);

        $info = curl_exec($ch);
        curl_close($ch);
        $info = json_decode($info);

        if(empty($info->access_token)){
            throw new LineAccessTokenNotFoundException('Can Not Find User Access Token');
        }
        return $info->access_token;
    }
}