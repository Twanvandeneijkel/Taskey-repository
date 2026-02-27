<?php

namespace Framework;

class Request
{
    public string $method;
    public string $path;
    /* @var string[] */
    public array $queryParameters;
    /* @var string[] */
    public array $postParameters;

    /* @var string[] */
    public array $routeParameters;

    public function __construct(string $method, string $path, array $queryParameters, array $postParameters)
    {
        $this->method = $method;
        $this->path = $path;
        $this->queryParameters = $queryParameters;
        $this->postParameters = $postParameters;
    }

    public function get(string $key): string | null
    {
        if ($this->routeParameters != null) {
            return $this->routeParameters[$key];
        } else {
            return null;
        }
    }
}
