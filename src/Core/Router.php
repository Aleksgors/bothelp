<?php

namespace App\Core;

/**
 * Class Router
 * @package App\Core
 */
class Router
{
    /**
     * @var array
     */
    protected $routes = [];

    /**
     * @var array
     */
    protected $params = [];


    /**
     * Router constructor
     */
    public function __construct()
    {
        $config = require __DIR__ . './../../config/routes.config.php';
        foreach ($config as $key => $value) {
            $this->add($key, $value);
        }
    }

    /**
     * @return void
     */
    public function run(): void
    {
        if ($this->match()) {
            $controllerClass = $this->params['controller'];
            if (class_exists($controllerClass)) {
                $action = $this->params['action'] . 'Action';
                if (method_exists($controllerClass, $action)) {
                    $controller = new $controllerClass();
                    $controller->$action();
                } else {
                    echo sprintf("Action %s not found in controller %s" . PHP_EOL, $action, $controllerClass);
                }
            } else {
                echo sprintf("Controller class %s not found" . PHP_EOL, $controllerClass);
            }
        } else {
            echo "Request route is not configured" . PHP_EOL;
        }
    }

    /**
     * @param string $route
     * @param array $params
     * @return void
     */
    protected function add(string $route, array $params): void
    {
        $this->routes[$route] = $params;
    }

    /**
     * @return bool
     */
    protected function match(): bool
    {
        $requestRoute = $_SERVER["argv"][1];

        foreach ($this->routes as $route => $params) {
            if ($requestRoute === $route) {
                $this->params = $params;
                return true;
            }
        }

        return false;
    }
}
