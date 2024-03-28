<?php

namespace App\Tests\Service;

use App\Service\ServiceCatalogue;
use PHPUnit\Framework\TestCase;

/**
 * Class ServiceCatalogueTest
 *
 * This class contains unit tests for the ServiceCatalogue class.
 */
class ServiceCatalogueTest extends TestCase
{
    /**
     * @var ServiceCatalogue
     */
    private $serviceCatalogue;

    /**
     * Setup method to initialize the ServiceCatalogue and load services from CSV.
     */
    protected function setUp(): void
    {
        // Initialize ServiceCatalogue
        $this->serviceCatalogue = new ServiceCatalogue();
        
        // Load services from the provided CSV file
        $this->serviceCatalogue->loadServicesFromCsv(__DIR__ . '/../../services.csv');
    }

    /**
     * Test the filterByCountry method of the ServiceCatalogue class.
     */
    public function testFilterByCountry()
    {
        // Filter services by country 'FR'
        $filteredServices = $this->serviceCatalogue->filterByCountry('FR');
        
        // Assert that the number of filtered services is as expected
        $this->assertCount(2, $filteredServices);  
        
        // Assert that each service in the filtered list has a country code of 'fr' or 'FR'
        foreach ($filteredServices as $service) {
            $this->assertContains($service->getCountry(), ['fr', 'FR']);  
        }
    }

    /**
     * Test the countByCountry method of the ServiceCatalogue class.
     */
    public function testCountByCountry()
    {
        // Get the counts of services by country
        $counts = $this->serviceCatalogue->countByCountry();
        
        // Assert that the counts for specific countries are as expected
        $this->assertEquals(2, $counts['FR']);
        $this->assertEquals(2, $counts['DE']);
        $this->assertEquals(2, $counts['GB']);
        $this->assertEquals(1, $counts['CZ']);
        $this->assertEquals(1, $counts['IT']);
        $this->assertEquals(1, $counts['PT']);
    }
}
