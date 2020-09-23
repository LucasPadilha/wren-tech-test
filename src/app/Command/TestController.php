<?php

namespace App\Command;

class TestController extends CommandController
{
    use \App\Traits\Import;

    public function run($argv)
    {
        $this->getCommand()->getPrinter()->print("\e[33mIMPORTANT: \e[39mIMPORT PROCESS RUNNING IN TEST MODE.");
        $this->getCommand()->getPrinter()->newLine();

        $csv = $this->readCsv($argv);
        
        if (!$csv) {
            return false;
        }

        $skipped = [];

        $inserted = [];

        try {
            $this->getConnection()->beginTransaction();

            foreach ($csv->getData() as $data) {
                if (!$this->validateData($data)) {
                    $skipped[] = $data;
    
                    continue;
                }
            
                if ($this->insertData($data)) {
                    $inserted[] = $data;
                }
            }

            $this->getConnection()->rollback();
        } catch (\Exception $e) {
            $this->getConnection()->rollback();

            $this->getCommand()->getPrinter()->print("\e[31mERROR: \e[39m" . $e->getMessage());
            $this->getCommand()->getPrinter()->newLine();
        }

        $itemsProcessed = count($csv->getData());
        $itemsWithError = count($csv->getErrors());
        $itemsInserted = count($inserted);
        $itemsSkipped = count($skipped);

        $this->getCommand()->getPrinter()->print("IMPORT PROCESS FINISHED");
        $this->getCommand()->getPrinter()->print("ITEMS PROCESSED: {$itemsProcessed}.");
        $this->getCommand()->getPrinter()->print("ITEMS INSERTED: {$itemsInserted}.");
        $this->getCommand()->getPrinter()->print("ITEMS SKIPPED: {$itemsSkipped}.");
        $this->getCommand()->getPrinter()->print("ITEMS WITH ERROR: {$itemsWithError}.");
    }
}