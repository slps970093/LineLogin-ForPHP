<?php


namespace LittleChou\LineLogin\ServiceProvider;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use LittleChou\LineLogin\ConfigManager;
use LittleChou\LineLogin\LineAuthorization;
use LittleChou\LineLogin\LineProfiles;

class LineLoginServiceProvider extends ServiceProvider{

    public function register(){
        $this->app->bind(ConfigManager::class,function (){
            $obj = new ConfigManager();
            $obj->setClientId(env('LINE_CLIENT_ID'))
                ->setRedirectUri(env('LINE_REDIRECT_URI'))
                ->setClientSecret(env('LINE_CLIENT_SECRET'))
                ->setScope(env('LINE_SCOPE'));
            return $obj;
        });



    }

    public function boot(){

        Blade::directive('lineloginlink',function ($uri) {
            $auth = $this->app->make(LineAuthorization::class);
            return  $auth->createAuthUrl($uri);
        });
        $this->app->bind('LineProfile', function (){
            $profile = $this->app->make(LineProfiles::class);
            return $profile;
        });


    }
}