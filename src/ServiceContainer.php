<?php

namespace Framework;

use Exception;

class ServiceContainer
{
    /** @var array<string, object> */
    private array $instances = [];

  /**
   * @param string $id
   * @param object $object
   * @return void
   * @throws Exception
   */
    public function set(string $id, object $object): void
    {
        if (isset($this->intstances[$id])) {
          throw new Exception("The given [$id] already exists!");
        }
        $this->instances[$id] = $object;
    }

    /**
     * @param string $id
     * @return object
     * @throws Exception
     */
    public function get(string $id): object
    {
        if (!isset($this->instances[$id])) {
            throw new Exception("The given [$id] hasn't been found!");
        }
        return $this->instances[$id];
    }
}
