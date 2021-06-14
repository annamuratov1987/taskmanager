<?php
namespace main;

class Router
{
    private $routes;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->routes = Config::get("routes");
    }

    public function route():void
    {
        $route = explode("?", $_SERVER["REQUEST_URI"])[0];

        if (key_exists($route, $this->routes)){
            $controllerClass = $this->routes[$route][0];
            $actionName = $this->routes[$route][1];
            $controller = new $controllerClass();
            $controller->$actionName();
        }else{
            $controller = new Controller();
            $controller->pageNotFound();
        }
    }

}