<?php

namespace Framework;

use Exception;

class ConfigManager
{
  /* @var array<string> */
  private array $defaults = [
    'APP_ENV' => 'production'
  ];

  /** @var array<string> */
  private array $config;

  public function __construct(array $config = [])
  {
    $this->config = array_merge($this->defaults, $config);
  }

    /**
     * @throws Exception
     */
    public function get(string $key): string
  {
    if (!isset($this->config[$key])) {
      throw new Exception("Config key[$key] is not set");
    }
    return $this->config[$key];
  }

  /**
   * @throws Exception
   */
  public function isProduction(): bool
  {
    return $this->get('APP_ENV') === 'production';
  }
}