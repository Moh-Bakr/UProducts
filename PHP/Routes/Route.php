<?php

class Route
{

    public static $routes = [];

    public static function resource($uri, $action)
    {
        self::$routes[] = $uri;
        if ($_SERVER['REQUEST_URI'] == $uri) {
            $action->__invoke();
        }
    }
//    public static function load($file)
//    {
//        $router = new self;
//        require $file;
//        return $router;
//    }
//
//    public function define($routes)
//    {
//        $this->routes = $routes;
//    }
//
//    public function direct($uri)
//    {
//        if (array_key_exists($uri, $this->routes)) {
//            return $this->routes[$uri];
//        }
//        throw new Exception("no route");
//    }
}