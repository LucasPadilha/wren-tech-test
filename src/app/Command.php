<?php 

namespace App;

class Command 
{
    protected $printer;

    protected $registry;

    public function __construct()
    {
        $this->printer = new Printer();

        $this->registry = new CommandRegistry();
    }

    public function getPrinter()
    {
        return $this->printer;
    }

    public function register($name, $callable)
    {
        $this->registry->register($name, $callable);
    }

    public function run(array $argv)
    {
        $command_name = 'import';

        if (isset($argv[1])) {
            $command_name = $argv[1];
        }

        $command = $this->registry->get($command_name);
        if (is_null($command)) {
            return $this->printer->print("ERROR: Command \"$command_name\" not found.");
        }

        call_user_func($command, $argv);
    }
}
