# Line Login For PHP (dev) unofficial 

[![Build Status](https://travis-ci.org/slps970093/LineLogin-ForPHP.svg?branch=master)](https://travis-ci.org/slps970093/LineLogin-ForPHP)


> <h3>Laravel 安裝教學</h3>

- Composer 安裝
- 在 .env 新增以下參數 並填寫相關 LINE API 所需資訊

```
LINE_CLIENT_ID = 
LINE_REDIRECT_URI = 
LINE_REDIRECT_SECRET = 
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

- 接著 在你 CallBack 的 Controller 裡面的 function 中 填寫以下程式碼 即可取得 Line 使用者資訊

```PHP
public function lineCallBackProfile(Request $request){

    $code = $request->get('code');
    
    $profile = LineProfile::get($code);
    
}
```