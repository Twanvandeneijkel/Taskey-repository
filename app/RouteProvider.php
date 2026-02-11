<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\TaskController;
use Exception;
use Framework\RouteProviderInterface;
use Framework\Router;
use Framework\ServiceContainer;

class RouteProvider implements RouteProviderInterface
{
    /**
     * @param Router $router
     * @param ServiceContainer $serviceContainer
     * @return void
     * @throws Exception
     */
    public function register(Router $router, ServiceContainer $serviceContainer): void
    {

        $homeController = $serviceContainer->get(HomeController::class);
        $router->addRoute('GET', '/', [$homeController, "index"]);
        $router->addRoute('GET', '/about', [$homeController, "about"]);

        $taskController = $serviceContainer->get(TaskController::class);
        $router->addRoute('GET', '/task', [$taskController, "index"]);
        $router->addRoute('GET', '/task/create', [$taskController, "create"]);
    }
}
