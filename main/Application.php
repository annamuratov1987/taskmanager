<?php


namespace main;


class Application
{
    public function run():void{

        $router = new Router();

        $router->route();
    }
}