# Line Login For PHP  unofficial 

[![Build Status](https://travis-ci.org/slps970093/LineLogin-ForPHP.svg?branch=master)](https://travis-ci.org/slps970093/LineLogin-ForPHP)


> <h3>環境要求</h3>
- PHP 5.4 以上
- PHP-CURL
- Laravel 5.2 以上 （非必要）
> <h3>Laravel 安裝教學</h3>

- Composer 安裝
```
composer require littlechou/line-login
```
- 在 .env 新增以下參數 並填寫相關 LINE API 所需資訊

```
LINE_CLIENT_ID = 
LINE_REDIRECT_URI = 
LINE_CLIENT_SECRET = 
LINE_SCOPE = 
```

- 調整 app\config\app.php 找到 providers 並新增

```
LittleChou\LineLogin\ServiceProvider\LineLoginServiceProvider::class,
```

</code>

- 調整 app\config\app.php 找到 aliases 並新增

```
'LineProfile' => LittleChou\LineLogin\Facades\LineProfile::class,
```

> <h3>使用說明</h3>

- 在你的 Blade 裡面 填寫以下程式碼，會產生認證網址

```
<a href="@lineloginlink()">Line Login</a>
```

- 接著 在你 CallBack 的 Controller 裡面的 function 中 填寫以下程式碼 即可取得 Line 使用者資訊，並使用命名空間

```PHP
use LineProfile; 

public function lineCallBackProfile(Request $request){

    $code = $request->get('code');
    
    $profile = LineProfile::get($code);
    
}
```

> <h3>非 Laravel 環境下使用方法</h3>

<b>以下為 CodeIgniter 3 做為範本</b>

```PHP
use LittleChou\LineLogin\ConfigManager;
use LittleChou\LineLogin\LineProfiles;
use LittleChou\LineLogin\LineAuthorization;

class LineController extends CI_Controller {

    private $lineConfig;

    public function __construct() {
        $config = new ConfigManager();
        $config->setRedirectUri("YOUR-REDIRECT-URI")
            ->setScope("YOUR-SCOPE")
            ->setClientSecret("YOUR-CLINET-SECRET")
            ->setClientId("YOUR-CLIENT-ID");
        $this->lineConfig = $config;
    }

    /**
     * 產生連結
     *
     */
    public function lineLogin() {
        $auth = new LineAuthorization($this->lineConfig);
        echo $auth->createAuthUrl();
    }

    /**
     * 取得使用者資訊
     *
     */
    public function getLineProfile() {
        $code = $this->input->get('code');

        $lineProfile = new LineProfiles($this->lineConfig);

        $profile = $lineProfile->get($code);
    }
}
```