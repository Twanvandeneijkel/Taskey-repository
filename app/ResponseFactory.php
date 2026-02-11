<?php

namespace App;

use Framework\Response;

class ResponseFactory
{
  public function __construct() {

  }

  public function body(string $body): Response {
    $response = new Response();
    $response->body = $body;
    return $response;
  }

  public function notFound(): Response {
    $response = New Response();
    $response->body = "404: Page not found";
    $response->responseCode = 404;
    return $response;
  }
}