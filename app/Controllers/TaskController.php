<?php

namespace App\Controllers;

use App\ResponseFactory;
use Framework\Response;

class TaskController
{
  private ResponseFactory $responseFactory;

  public function __construct($responseFactory)
  {
    $this->responseFactory = $responseFactory;
  }

  public function index(): Response
  {
    return $this->responseFactory->body("Task Page");
  }

  public function create(): Response
  {
    return $this->responseFactory->body("Task Create Page");
  }
}
