<?php 

namespace App\Command;

class HelpController extends CommandController
{
    public function run($argv)
    {
        $command = null;
        if (isset($argv[2])) {
            $command = $argv[2];
        }

        switch ($command) {
            case 'import':
                $this->getCommand()->getPrinter()->print("\e[33mUsage:");
                $this->getCommand()->getPrinter()->print("  \e[39mimport [file_name]");
                $this->getCommand()->getPrinter()->newLine();
                $this->getCommand()->getPrinter()->print("\e[33mHelp:");
                $this->getCommand()->getPrinter()->print("  \e[39mThe \e[92mimport \e[39mcommand imports a given CSV file to the database.");
                $this->getCommand()->getPrinter()->newLine();
                $this->getCommand()->getPrinter()->print("\e[33mNotes:");
                $this->getCommand()->getPrinter()->print("  \e[39mThe CSV file must be in the \e[92mresources \e[39mfolder.");

                break;
            case 'test':
                $this->getCommand()->getPrinter()->print("\e[33mUsage:");
                $this->getCommand()->getPrinter()->print("  \e[39mtest [file_name]");
                $this->getCommand()->getPrinter()->newLine();
                $this->getCommand()->getPrinter()->print("\e[33mHelp:");
                $this->getCommand()->getPrinter()->print("  \e[39mThe \e[92mtest \e[39mcommand simulates a import of a given CSV file to the database.");
                $this->getCommand()->getPrinter()->newLine();
                $this->getCommand()->getPrinter()->print("\e[33mNotes:");
                $this->getCommand()->getPrinter()->print("  \e[39mThe CSV file must be in the \e[92mresources \e[39mfolder.");

                break;
            default:
                $this->getCommand()->getPrinter()->print("\e[33mUsage:");
                $this->getCommand()->getPrinter()->print("  \e[39mhelp [<command_name>]");
                $this->getCommand()->getPrinter()->newLine();
                $this->getCommand()->getPrinter()->print("\e[33mHelp:");
                $this->getCommand()->getPrinter()->print("  \e[39mThe \e[92mhelp \e[39mcommand displays help for a given command.");
                $this->getCommand()->getPrinter()->newLine();
                $this->getCommand()->getPrinter()->print("\e[33mAvailable commands:");
                $this->getCommand()->getPrinter()->print("  \e[92mtest");
                $this->getCommand()->getPrinter()->print("  \e[92mimport");

                break;
        }
    }
}
