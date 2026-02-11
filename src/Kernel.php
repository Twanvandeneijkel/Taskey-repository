<?php

namespace Framework;

use App\ResponseFactory;
use App\ServiceProvider;
use Exception;

class Kernel
{
  private Router $router;

  private ServiceContainer $serviceContainer;

  /**
   * @throws Exception
   */
  public function __construct()
  {
    $this->serviceContainer = new ServiceContainer();

    $responseFactory = new ResponseFactory();
    $this->serviceContainer->set(ResponseFactory::class, $responseFactory);

    $this->router = new Router($responseFactory);
  }

  public function getRouter(): Router
  {
    return $this->router;
  }

  /**
   * @param ServiceProvider $serviceProvider
   * @return void
   * @throws Exception
   */
  public function registerServices(ServiceProvider $serviceProvider): void
  {
    $serviceProvider->register($this->serviceContainer);
  }

  public function registerRoutes(RouteProviderInterface $routeProvider): void
  {
    $routeProvider->register($this->router, $this->serviceContainer);
  }

  public function handle(Request $request): Response
  {
    return $this->router->dispatch($request);
  }
}
