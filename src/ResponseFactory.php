<?php

namespace Framework;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class ResponseFactory
{
  private Environment $twig;

  public function __construct(bool $debugMode, string $viewsPath) {
    $loader = new FilesystemLoader($viewsPath);
    $this->twig = new Environment($loader, [
      'debug' => $debugMode,
    ]);
  }


  public function view(string $template, array $parameters = []): Response
  {
    $response = new Response();

    try {
      $response->body = $this->twig->render($template, $parameters);
      $response->responseCode = 200;
      return $response;
    } catch (\Exception $e) {
      $response->body = $e->getMessage();
      $response->responseCode = 500;
      return $response;
    }
  }


  /**
   * @throws SyntaxError
   * @throws RuntimeError
   * @throws LoaderError
   */
  public function notFound(): Response
  {
    $response = new Response();
    $response->body = $this->twig->render("404.html.twig");
    $response->responseCode = 404;
    return $response;
  }
}