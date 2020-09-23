<?php 

namespace App;

use App\Command\CommandController;

class CommandRegistry
{
    protected $registry = [];

    public function register($name, CommandController $controller)
    {
        $this->registry[$name] = $controller;
    }

    public function get($command)
    {
        $controller = isset($this->registry[$command]) ? $this->registry[$command] : null;
        if ($controller instanceof CommandController) {
            return [ $controller, 'run' ];
        }

        return null;
    }
}