<?php 

namespace App;

class Printer
{
    public function out($message)
    {
        echo $message;
    }

    public function newLine()
    {
        $this->out("\n");
    }

    public function print($message)
    {
        $this->out($message);
        $this->newLine();
    }
}