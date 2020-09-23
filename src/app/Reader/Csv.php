<?php 

namespace App\Reader;

class Csv
{
    protected $data = [];

    protected $errors = [];

    public function __construct($file_name)
    {
        $header = null;

        if (($handler = fopen($file_name, "r")) !== false) {
            while (($row = fgetcsv($handler, 1000, ",")) !== false) {
                if (is_null($header)) {
                    $header = $row;
                } else {
                    if (count($header) === count($row)) {
                        $array = array_combine($header, $row);

                        $this->data[] = $array;
                    } else {
                        $this->errors[] = $row;
                    }
                }
            }

            fclose($handler);
        }
    }

    public function getData()
    {
        return $this->data;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}