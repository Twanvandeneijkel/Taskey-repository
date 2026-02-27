<?php

namespace App\Controllers;

use App\Repositories\TaskRepositoryInterface;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class TaskController
{
    private ResponseFactory $responseFactory;

    private TaskRepositoryInterface $taskRepository;

    public function __construct(ResponseFactory $responseFactory, TaskRepositoryInterface $taskRepository)
    {
        $this->responseFactory = $responseFactory;
        $this->taskRepository = $taskRepository;
    }

    public function index(): Response
    {
        $tasks = $this->taskRepository->all();
        return $this->responseFactory->view("task/index.html.twig", ['tasks' => $tasks]);
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function show(Request $request): Response
    {
        $taskId = (int)$request->get('id');
        $task = $this->taskRepository->find($taskId);

        if ($task === null)
        {
            return $this->responseFactory->notFound();
        }
        return $this->responseFactory->view('task/show.html.twig', ['task' => $task]);
    }

    public function create(): Response
    {
        return $this->responseFactory->view("task/create.html.twig");
    }
}
