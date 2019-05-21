<?php
/**
 *  Line 設定檔 管理器
 */

namespace LittleChou\LineLogin;


class ConfigManager{

    /**
     * @var \ArrayObject
     */
    private $config;

    const CLIENT_ID = 'client_id';

    const CLIENT_SECRET = 'client_secret';
    
    const CLIENT_SCOPE = 'client_scope';

    public function __construct(){
        $this->config = new \ArrayObject();
    }

    public function setClientId($id){
        $this->config->{ self::CLIENT_ID } = $id;
    }

    public function setClientSecret($secret){
        $this->config->{ self::CLIENT_SCOPE } = $secret;
    }

    public function setScope($scope){
        $this->config->{ self::CLIENT_SCOPE } = urlencode($scope);
    }

    /**
     * @return \ArrayObject
     */
    public function getConfigs(){
        return $this->config;
    }

}