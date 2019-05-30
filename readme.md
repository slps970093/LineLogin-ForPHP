# Line Login For PHP (dev) unofficial 

[![Build Status](https://travis-ci.org/slps970093/LineLogin-ForPHP.svg?branch=master)](https://travis-ci.org/slps970093/LineLogin-ForPHP)


<h3>Laravel 安裝教學</h3>

1. Composer 安裝

2. 在 .env 新增以下參數

<code>
LINE_CLIENT_ID = <br />
LINE_REDIRECT_URI = <br />
LINE_REDIRECT_SECRET = <br />
LINE_SCOPE = <br /> 
</code><br />
3. 調整 app\config\app.php 找到 providers 並新增

<code>
        LittleChou\LineLogin\ServiceProvider\LineLoginServiceProvider::class,
</code>

4. 調整 app\config\app.php 找到 aliases 並新增

<code>
'LineProfile' => LittleChou\LineLogin\Facades\LineProfile::class,
</code>