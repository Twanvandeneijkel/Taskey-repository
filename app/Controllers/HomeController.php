<?php

namespace App\Controllers;

use Framework\Response;

class HomeController
{
    public function index(): Response {
        $response = new Response();
        $response->body = "Home Page";
        return $response;
    }

    public function about(): Response {
        $response = new Response();
        $response->body = "About Page";
        return $response;
    }
}