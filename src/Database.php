<?php

namespace Framework;


use PDO;
use PDOStatement;

class Database
{
    private PDO $connection;
//    private string $name;

    public function __construct(string $name)
    {
        $this->connection = new PDO("sqlite:". $name);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $this->connection->exec("PRAGMA foreign_keys = ON");
    }

    public function query(string $sql): PDOStatement | false
    {
        return $this->connection->query($sql);
    }

    public function run(string $sql, array | null $params = null): PDOStatement
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute($params);
        return $statement;
    }

    public function prepare($sql): PDOStatement
    {
        return $this->connection->prepare($sql);
    }

    public function exec(string $sql): false | int
    {
        return $this->connection->exec($sql);
    }

    public function migrate(string $directory): void
    {
        $files = scandir($directory);
        if ($files === false)
        {
            die("Could not read migration directory: ". $directory);
        }
        foreach ($files as $file)
        {
            if ($file === '.' || $file === '..')
            {
                continue;
            }
            echo "Migration" . $file . "\n";
            if ($contents = file_get_contents($directory . '/' . $file)) {
                $this->connection->exec($contents);
            }
        }
    }
}