<?php


namespace LittleChou\LineLogin\Facades;


use Illuminate\Support\Facades\Facade;

class LineProfile extends Facade{

    protected static function getFacadeAccessor(){
        return "LineProfile";
    }
}