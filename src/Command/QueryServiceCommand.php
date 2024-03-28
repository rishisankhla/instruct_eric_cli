<?php

namespace App\Command;

use App\Service\ServiceCatalogue;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class QueryServiceCommand
 *
 * This command allows querying services either by country code or displaying
 * a summary of total services available in each country.
 */
class QueryServiceCommand extends Command
{
    protected static $defaultName = 'service:query';

    /** @var ServiceCatalogue $serviceCatalogue A service catalogue instance to fetch and manage services. */
    private $serviceCatalogue;

    /**
     * QueryServiceCommand constructor.
     *
     * @param ServiceCatalogue $serviceCatalogue The service catalogue instance injected.
     */
    public function __construct(ServiceCatalogue $serviceCatalogue)
    {
        $this->serviceCatalogue = $serviceCatalogue;
        parent::__construct();
    }

    /**
     * Configures the command by setting its description, arguments, and options.
     */
    protected function configure()
    {
        $this->setDescription('Query services by country code')
             ->addArgument('country', InputArgument::OPTIONAL, 'Country code')
             ->addOption('summary', 's', InputOption::VALUE_NONE, 'Display summary of total services in each country');
    }

    /**
     * Executes the command based on the input and output provided.
     *
     * @param InputInterface  $input  The input object containing the command arguments and options.
     * @param OutputInterface $output The output object used to display messages.
     *
     * @return int The exit code of the command.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Get the country argument from input
        $country = $input->getArgument('country');
        
        // Convert the country code to uppercase or default to empty string
        $country = strtoupper($country ?? '');

        // If a country code is provided, filter and display services for that country
        if ($country) {
            $services = $this->serviceCatalogue->filterByCountry($country);
            if (empty($services)) {
                $output->writeln("No services found for country {$country}.");
                return Command::FAILURE;
            } else {
                foreach ($services as $service) {
                    $output->writeln((string) $service);
                }
                $totalServices = count($services);
                $output->writeln("Total services in {$country}: {$totalServices}");
            }
            return Command::SUCCESS;
        }

        // If the --summary option is provided, display a summary of total services by country
        if ($input->getOption('summary')) {
            $counts = $this->serviceCatalogue->countByCountry();
            foreach ($counts as $country => $count) {
                $output->writeln("Total services in {$country}: {$count}");
            }
            return Command::SUCCESS;
        }

        // If no country code or --summary option is provided, display a message to the user
        $output->writeln('Please provide a country code or use --summary option to display summary.');
        return Command::FAILURE;
    }
}
