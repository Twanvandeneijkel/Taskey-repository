<?php

namespace Framework;

class Router
{
    /* @var Route[] */
    private array $routes = [];

    public function __construct()
    {
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
        return new Response("404: Page not found", 404);
    }

    public function addRoute(string $method, string $path, callable $callback): void
    {
        $route = new Route($method, $path, $callback);
        // Adding something to array.
        $this->routes[] = $route;
    }
}
