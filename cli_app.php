<?php

// Include the Composer autoload file to autoload dependencies
require __DIR__.'/vendor/autoload.php';

// Import necessary classes
use Symfony\Component\Console\Application;
use App\Command\QueryServiceCommand;
use App\Service\ServiceCatalogue;

// Instantiate ServiceCatalogue and load services from CSV
$serviceCatalogue = new ServiceCatalogue();
$serviceCatalogue->loadServicesFromCsv(__DIR__.'/services.csv');

// Create a new instance of the Symfony Console Application
$application = new Application();

// Add the QueryServiceCommand to the application
$application->add(new QueryServiceCommand($serviceCatalogue));

// Run the application
$application->run();
