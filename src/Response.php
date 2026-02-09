<?php

namespace Framework;

//use http\Header;

class Response
{
    public int $responseCode = 200;
    public string $body = '';
    public string|null $headers = null;

    public function __construct(string $body = '', int $responseCode = 200, string|null $headers = null)
    {
        $this->body = $body;
        $this->responseCode = $responseCode;
        $this->headers = $headers;
    }

    public function echo(): void
    {
        http_response_code($this->responseCode);
        header($this->headers);
        echo $this->body;
    }
}
