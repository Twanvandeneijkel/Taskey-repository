<?php

namespace App\Controllers;

use App\ResponseFactory;
use Framework\Response;

class HomeController
{
  private ResponseFactory $responseFactory;

  public function __construct($responseFactory) {
    $this->responseFactory = $responseFactory;
  }
  public function index(): Response
  {
    return $this->responseFactory->body("Home Page");
  }

  public function about(): Response
  {
    return $this->responseFactory->body("About Page");
  }
}
