<?php

namespace App\Command;

use App\Service\CustomerImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCustomerCommand extends Command
{
    protected static $defaultName = 'app:import-customers';

    private $customerImporter;

    public function __construct(CustomerImporter $customerImporter)
    {
        $this->customerImporter = $customerImporter;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Imports customers from the third-party API.')
            ->setHelp('This command allows you to import customers from a third-party API into the database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting import process...');
        
        try {
            $this->customerImporter->importCustomers();
            $output->writeln('Import completed successfully.');
        } catch (\Exception $e) {
            $output->writeln('Error: ' . $e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}