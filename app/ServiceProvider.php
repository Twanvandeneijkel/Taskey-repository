<?php

namespace App;

use App\Repositories\TaskRepositoryInterface;
use Exception;
use App\Controllers\HomeController;
use App\Controllers\TaskController;
use App\Repositories\TaskRepository;
use Framework\Database;
use Framework\ResponseFactory;
use Framework\ServiceContainer;
use Framework\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @throws Exception
     */
    public function register(ServiceContainer $serviceContainer): void
    {
        $responseFactory = $serviceContainer->get(ResponseFactory::class);
        $database = $serviceContainer->get(Database::class);

        $taskRepository = new TaskRepository($database);
        $serviceContainer->set(TaskRepositoryInterface::class, $taskRepository);

        $homeController = new HomeController($responseFactory);
        $serviceContainer->set(HomeController::class, $homeController);

        $taskController = new TaskController($responseFactory, $taskRepository);
        $serviceContainer->set(TaskController::class, $taskController);
    }
}
