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

        $url = $this->getUrl($host,$parameter);

        return $url;
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