<?php

namespace App\Tests\Command;

use App\Command\QueryServiceCommand;
use App\Service\ServiceCatalogue;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class QueryServiceCommandTest
 *
 * This class contains unit tests for the QueryServiceCommand class.
 */
class QueryServiceCommandTest extends TestCase
{
    /**
     * @var ServiceCatalogue|\PHPUnit\Framework\MockObject\MockObject
     */
    private $serviceCatalogue;

    /**
     * @var QueryServiceCommand
     */
    private $command;

    /**
     * @var CommandTester
     */
    private $commandTester;

    /**
     * Setup method to initialize the mock ServiceCatalogue, QueryServiceCommand, and CommandTester.
     */
    protected function setUp(): void
    {
        // Create a mock of the ServiceCatalogue class
        $this->serviceCatalogue = $this->createMock(ServiceCatalogue::class);
        
        // Initialize the QueryServiceCommand with the mock ServiceCatalogue
        $this->command = new QueryServiceCommand($this->serviceCatalogue);

        // Create a new Application instance and add the command to it
        $application = new Application();
        $application->add($this->command);

        // Initialize the CommandTester with the command
        $this->commandTester = new CommandTester($this->command);
    }

    /**
     * Test the execute method of the QueryServiceCommand class with a country argument.
     */
    public function testExecuteWithCountry()
    {
        // Set up the mock expectation for the filterByCountry method
        $this->serviceCatalogue->expects($this->once())
                            ->method('filterByCountry')
                            ->with('FR')  
                            ->willReturn([
                                new \App\Model\Service('APPLAB1', 'Aperture Science', 'Portal Technology', 'fr')
                            ]);

        // Execute the command with a country argument
        $this->commandTester->execute([
            'country' => 'FR',  
        ]);

        // Get the command output and assert its content
        $output = $this->commandTester->getDisplay();
        $this->assertStringContainsString('APPLAB1, Aperture Science, Portal Technology, fr', $output);  
    }

    /**
     * Test the execute method of the QueryServiceCommand class with the summary option.
     */
    public function testExecuteWithSummary()
    {
        // Set up the mock expectation for the countByCountry method
        $this->serviceCatalogue->expects($this->once())
                               ->method('countByCountry')
                               ->willReturn([
                                   'FR' => 2,
                                   'DE' => 2,
                                   'GB' => 2,
                                   'CZ' => 1,
                                   'IT' => 1,
                                   'PT' => 1,
                               ]);

        // Execute the command with the summary option
        $this->commandTester->execute([
            '--summary' => true,
        ]);

        // Get the command output and assert its content
        $output = $this->commandTester->getDisplay();
        $this->assertStringContainsString('Total services in FR: 2', $output);
        $this->assertStringContainsString('Total services in DE: 2', $output);
        $this->assertStringContainsString('Total services in GB: 2', $output);
        $this->assertStringContainsString('Total services in CZ: 1', $output);
        $this->assertStringContainsString('Total services in IT: 1', $output);
        $this->assertStringContainsString('Total services in PT: 1', $output);
    }
}
