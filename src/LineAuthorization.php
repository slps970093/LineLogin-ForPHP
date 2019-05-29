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
            'response_type' => urlencode('code'),
            'client_id' => urlencode($config->client_id),
            'scope' => urlencode($config->client_scope),
            'state' => urlencode('helloworld'),
            'redirect_uri' => $host.'/callback'
        ];

        if(count($appendParameter) != 0){
            $parameter = array_merge($parameter,$appendParameter);
        }

        $host = "http://" . $_SERVER['SERVER_NAME'] . $uri ;

        $url = $host . "?" . http_build_query($parameter);

        return $url;
    }


}