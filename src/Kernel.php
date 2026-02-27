<?php

namespace Framework;

use App\ServiceProvider;
use Exception;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Kernel
{
  private Router $router;

  private ServiceContainer $serviceContainer;

  private ConfigManager $configManager;

  private Database $database;

  /**
   * @throws Exception
   */
  public function __construct(array $config)
  {
    $this->serviceContainer = new ServiceContainer();
    $this->configManager = new ConfigManager($config);

    $debugMode = $this->configManager->get('APP_ENV') != 'production';

    $responseFactory = new ResponseFactory($debugMode, $this->configManager->get('VIEWS_PATH'));
    $this->serviceContainer->set(ResponseFactory::class, $responseFactory);

    $this->router = new Router($responseFactory);

    $this->database = new Database(__DIR__ . '/../' . $this->configManager->get('APP_DB'));
    $this->serviceContainer->set(Database::class, $this->database);
  }

  public function getRouter(): Router
  {
    return $this->router;
  }

  public function getDatabase(): Database
  {
      return $this->database;
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

  /**
   * @throws RuntimeError
   * @throws SyntaxError
   * @throws LoaderError
   */
  public function handle(Request $request): Response
  {
    return $this->router->dispatch($request);
  }
}
