<?php

namespace Framework;

use App\ResponseFactory;

class Router
{
  /* @var Route[] */
  private array $routes = [];

  private ResponseFactory $responseFactory;

  public function __construct($responseFactory) {
    $this->responseFactory = $responseFactory;
  }

  public function dispatch(Request $request): Response
  {
    // Checks if Request matches with existing route.
    // If does it sets $matchedRoute.
    foreach ($this->routes as $route) {
      if ($route->matches($request->method, $request->path)) {
        $callback = $route->callable;
        return $callback();
      }
    }
    return $this->responseFactory->notFound();
  }

  public function addRoute(string $method, string $path, callable $callback): void
  {
    $route = new Route($method, $path, $callback);
    // Adding something to array.
    $this->routes[] = $route;
  }
}
