<?php

namespace App\Tests\Model;

use App\Model\Service;
use PHPUnit\Framework\TestCase;

/**
 * Class ServiceTest
 *
 * This class contains unit tests for the Service model class.
 */
class ServiceTest extends TestCase
{
    /**
     * Test the __toString method of the Service class.
     */
    public function testToString()
    {
        // Create a Service instance
        $service = new Service('APPLAB1', 'Aperture Science', 'Portal Technology', 'fr');
        
        // Define the expected string representation
        $expectedString = 'APPLAB1, Aperture Science, Portal Technology, fr';
        
        // Assert that the __toString method returns the expected string
        $this->assertEquals($expectedString, (string) $service);
    }

    /**
     * Test the getCountry method of the Service class.
     */
    public function testGetCountry()
    {
        // Create a Service instance
        $service = new Service('APPLAB1', 'Aperture Science', 'Portal Technology', 'fr');
        
        // Assert that the getCountry method returns the correct country code
        $this->assertEquals('fr', $service->getCountry());
    }
}
