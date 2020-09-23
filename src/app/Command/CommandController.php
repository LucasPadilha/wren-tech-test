<?php

namespace App\Command;

use App\App;

abstract class CommandController 
{
    protected $app;

    abstract public function run($argv);

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    protected function getConnection()
    {
        return $this->app->getConnection();
    }

    protected function getCommand()
    {
        return $this->app->getCommand();
    }

    protected function getConfig($key)
    {
        return $this->app->getConfig($key);
    }
}