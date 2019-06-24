<?php


use PHPUnit\Framework\TestCase;
use LittleChou\LineLogin\ConfigManager;

class ConfigManagerTest extends TestCase {

    /**
     * @var ConfigManager
     */
    private $config;

    /**
     * @before
     */
    public function beforeTest() {
        $this->config = new ConfigManager();
        $this->config->setClientId("YYY")
            ->setClientSecret("YYY")
            ->setScope("YYY")
            ->setRedirectUri("YYY");
    }

    /**
     * @test
     */
    public function configTest() {
        $createData = $this->config->getConfigs();

        $afterData = [
            'client_id' => 'YYY',
            'client_secret' => 'YYY',
            'client_scope' => 'YYY',
            'redirect_uri' => 'YYY'
        ];

        $this->assertEquals($afterData,$createData);
    }
}
