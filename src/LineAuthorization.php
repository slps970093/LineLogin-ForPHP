<?php


namespace LittleChou\LineLogin;


class LineAuthorization{

    private $configManager;

    public function __construct(ConfigManager $configManager){
        $this->configManager = $configManager;
    }

    public function createAuthUrl($uri,$appendParameter = []){
        $config = $this->configManager->getConfigs();

        $parameter = [
            'response_type' => 'code',
            'client_id' => $config->client_id,
            'scope' => $config->client_scope,
            'state' => uniqid(15),
            'redirect_uri' => $config->redirect_uri
        ];

        if(count($appendParameter) != 0){
            $parameter = array_merge($parameter,$appendParameter);
        }

        $host = "http://" . $_SERVER['SERVER_NAME'] . $uri ;

        $url = $host . "?" . http_build_query($parameter);

        return $url;
    }


}