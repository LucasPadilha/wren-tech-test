<?php

namespace App;

use PDO;

class Connection
{
    protected $connection = null;

    public function __construct($host, $name, $user, $pass, $port = 3306)
    {
        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_PERSISTENT         => true,
        ];

        $this->connection = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass, $options);
    }

    public function get()
    {
        if (!is_null($this->connection)) {
            return $this->connection;
        }

        return null;
    }
}