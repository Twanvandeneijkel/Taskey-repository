<?php

namespace App\Views;

use App\Controllers\HomeController;
use App\Controllers\TaskController;
use Framework\RouteProviderInterface;
use Framework\Router;

class RouteProvider implements RouteProviderInterface
{

    public function register(Router $router): void
    {
        $homeController = new HomeController();
        $router->addRoute('GET', '/', [$homeController, "index"]);
        $router->addRoute('GET', '/about', [$homeController, "about"]);

        $taskController = new TaskController();
        $router->addRoute('GET', '/task', [$taskController, "index"]);
        $router->addRoute('GET', '/task/create', [$taskController, "create"]);

    }
}