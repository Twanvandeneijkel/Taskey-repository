<?php

namespace Framework;

class Route
{
    public string $method;
    public string $path;

    /* @var callable */
    public $callable;

    /* @var string[] */
    public array $routeParameters;

    public function __construct(string $method, string $path, callable $callback)
    {
        // GET, POST Request.
        $this->method = $method;
        // Where you can find it.
        $this->path = $path;
        // What the route has to give back.
        // Gives a certain piece of text back.
        $this->callable = $callback;
    }

    public function matches(string $method, string $path): bool
    {
        if (preg_match(';^' . $this->path . '/?$;', $path, $matches))
        {
            $this->routeParameters = $matches;
            return true;
        }

        return ($method === $this->method and $path === $this->path);
    }
}
