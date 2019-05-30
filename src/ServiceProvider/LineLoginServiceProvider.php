<?php


namespace LittleChou\LineLogin\ServiceProvider;


;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use LittleChou\LineLogin\ConfigManager;
use LittleChou\LineLogin\LineAuthorization;
use LittleChou\LineLogin\LineProfiles;

class LineLoginServiceProvider extends ServiceProvider{

    public function register(){
        $owner = $this;

        $this->app->bind(ConfigManager::class,function (){
            $obj = new ConfigManager();
            $obj->setClientId(env('LINE_CLIENT_ID'))
                ->setRedirectUri(env('LINE_REDIRECT_URI'))
                ->setClientSecret(env('LINE_REDIRECT_SECRET'))
                ->setScope(env('LINE_SCOPE'));
            return $obj;
        });

        $this->app->bind('LineProfile', function () use ($owner){
            $profile = $owner->app->make(LineProfiles::class);
            return $profile;
        });
    }

    public function boot(){
        $owner = $this;

        Blade::directive('lineloginlink',function ($uri) use ($owner) {
            $auth = $owner->app->make(LineAuthorization::class);
            echo $auth->createAuthUrl($uri);
        });

    }
}