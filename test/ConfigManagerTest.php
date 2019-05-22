<?php


use PHPUnit\Framework\TestCase;

class ConfigManagerTest extends TestCase
{
    /**
     * @var ArrayObject
     */
    private $config;

    const CLIENT_ID  = 'client_id';

    const CLIENT_SECRET = 'client_secret';

    const CLIENT_SCOPE = 'client_scope';

    public function __construct(){
        $this->config = new ArrayObject();
        parent::__construct();
    }

    /**
     * @test
     */
    public function setClientId(){
        $this->config->{ self::CLIENT_ID } = 'helloworld';

        $this->assertEquals($this->config->{ self::CLIENT_ID },'helloworld');
    }

    /**
     * @test
     */
    public function setClientSecret(){
        $this->config->{ self::CLIENT_SECRET } = 'HelloPHP';

        $this->assertEquals($this->config->{ self::CLIENT_SECRET }, 'HelloPHP');
    }

    /**
     * @test
     */
    public function setScope(){
        $this->config->{ self::CLIENT_SCOPE } = urlencode("HelloASSS");

        $this->assertEquals($this->config->{ self::CLIENT_SCOPE } ,urlencode('HelloASSS'));
    }


    /**
     * @test
     */
    public function getConfigs(){
        self::setClientId();
        self::setClientSecret();
        self::setScope();
        $fakeData = new ArrayObject();
        $fakeData->{ self::CLIENT_ID } = 'helloworld';
        $fakeData->{ self::CLIENT_SECRET } = 'HelloPHP';
        $fakeData->{ self::CLIENT_SCOPE } = urlencode('HelloASSS');

        $this->assertTrue($this->config->getArrayCopy() === $fakeData->getArrayCopy());
        return $this->config;
    }
}
