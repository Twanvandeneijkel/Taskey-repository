<?php

namespace App\Controllers;

use Framework\Response;

class TaskController
{
    public function index(): Response {
        $response = new Response();
        $response->body = "Task Page";
        return $response;
    }

    public function create(): Response {
        $response = new Response();
        $response->body = "Task create Page";
        return $response;
    }
}