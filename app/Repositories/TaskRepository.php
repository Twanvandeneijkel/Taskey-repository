<?php

namespace App\Repositories;

use App\Models\Task;
use Framework\Database;

class TaskRepository implements TaskRepositoryInterface
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $statement = $this->database->run('SELECT * FROM tasks ORDER BY title')->fetchAll();
        $tasks = [];
        foreach ($statement as $row)
        {
            $task = $this->fromDBRow($row);
            $tasks[] = $task;
        }
        return $tasks;
    }

    public function find(int $id): ?Task
    {
        $result = $this->database->run('SELECT * FROM tasks WHERE id = :id', ['id' => $id])->fetch();
        if (!$result)
        {
            return null;
        }

        return $this->fromDBRow($result);
    }

    private function fromDBRow(mixed $row): Task
    {
        $task = new Task();
        $task->id = $row->id;
        $task->title = $row->title;
        $task->description = $row->description;
        $task->priority = $row->priority;
        $task->status = $row->status;
        $task->created_at = $row->created_at;
        $task->completed_at = $row->completed_at;
        return $task;
    }
}