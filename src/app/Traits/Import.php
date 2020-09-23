<?php

namespace App\Traits;

use App\Reader\Csv;

trait Import
{
    protected function readCsv($argv)
    {
        $file_name = null;
        if (!isset($argv[2])) {
            $this->getCommand()->getPrinter()->print("\e[31mERROR: \e[39mplease specify a file name.");

            return false;
        }

        $file_name = $this->getConfig('resource_path') . $argv[2];
        if (!file_exists($file_name)) {
            $this->getCommand()->getPrinter()->print("\e[31mERROR: \e[39mthe specified file doesn't exists.");

            return false;
        }

        $csv = new Csv($file_name);
        
        return $csv;
    }

    protected function insertData($data)
    {
        $insertSql = 'INSERT INTO tblProductData (strProductName, strProductDesc, strProductCode, dtmAdded, dtmDiscontinued, intStock, dcmPrice) VALUES (:strProductName, :strProductDesc, :strProductCode, :dtmAdded, :dtmDiscontinued, :intStock, :dcmPrice) ';

        $current_timestamp = new \DateTime('now', new \DateTimeZone('UTC'));

        $stmt = $this->getConnection()->prepare($insertSql);
        $rst = $stmt->execute([
            ':strProductName' => $data['Product Name'],
            ':strProductDesc' => $data['Product Description'],
            ':strProductCode' => $data['Product Code'],
            ':dtmAdded' => $current_timestamp->format('Y-m-d H:i:s'),
            ':dtmDiscontinued' => ($data['Discontinued'] == 'yes' ? $current_timestamp->format('Y-m-d H:i:s') : null),
            ':intStock' => $data['Stock'],
            ':dcmPrice' => $data['Cost in GBP']
        ]);

        return $rst;
    }

    protected function validateData($data)
    {
        if (!is_numeric($data['Stock']) || !is_numeric($data['Cost in GBP'])) {
            return false;
        }

        if ($data['Cost in GBP'] < 5 && $data['Stock'] < 10) {
            return false;
        }

        if ($data['Cost in GBP'] > 1000) {
            return false;
        }

        return true;
    }
}
