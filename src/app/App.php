<?php 

namespace App;

use App\Command\HelpController;
use App\Command\ImportController;
use App\Command\TestController;

class App
{
    protected $config = [];
    
    protected $command;

    protected $connection;

    public function __construct($config)
    {
        $this->config = $config;

        $this->command = new Command();
    }

    public function getConfig($key = null)
    {
        if (!is_null($key) && isset($this->config[$key])) {
            return $this->config[$key];
        }

        return $this->config;
    }

    public function getCommand()
    {
        return $this->command;
    }

    public function getConnection()
    {
        return $this->connection->get();
    }

    public function bootstrap()
    {
        $this->connect();

        $this->command->register('import', new ImportController($this));

        $this->command->register('test', new TestController($this));

        $this->command->register('help', new HelpController($this));
    }

    public function run($argv)
    {
        return $this->command->run($argv);
    }

    protected function connect()
    {
        $this->connection = new Connection(
            $this->getConfig('db_host'), 
            $this->getConfig('db_name'), 
            $this->getConfig('db_user'), 
            $this->getConfig('db_pass'), 
            $this->getConfig('db_port'),
        );
    }
}