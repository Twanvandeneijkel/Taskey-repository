<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\TaskController;
use Exception;
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
        $homeController = new HomeController($responseFactory);
        $serviceContainer->set(HomeController::class, $homeController);

        $taskController = new TaskController($responseFactory);
        $serviceContainer->set(TaskController::class, $taskController);
    }
}
