<?php

namespace App\Service;

use App\Model\Service as ServiceModel;

/**
 * Class ServiceCatalogue
 *
 * This class manages a collection of Service objects and provides operations
 * like loading services from a CSV file, filtering services by country, and
 * counting services by country.
 */
class ServiceCatalogue
{
    /** @var array $services An array to store Service objects. */
    private $services = [];

    /**
     * Load services from a CSV file and populate the $services array.
     *
     * @param string $filePath The path to the CSV file containing service data.
     */
    public function loadServicesFromCsv($filePath)
    {
        // Read CSV file into an array of rows
        $rows = array_map('str_getcsv', file($filePath));
        
        // Remove header row
        array_shift($rows); 

        // Iterate over each row to create Service objects and add them to the $services array
        foreach ($rows as $row) {
            list($ref, $centre, $service, $country) = $row;
            $this->services[] = new ServiceModel($ref, $centre, $service, $country);
        }
    }

    /**
     * Filter services by country.
     *
     * @param string $country The country code to filter services by.
     *
     * @return array An array of Service objects filtered by the given country.
     */
    public function filterByCountry($country)
    {
        return array_filter($this->services, function ($service) use ($country) {
            return strtoupper($service->getCountry()) === strtoupper($country);
        });
    }

    /**
     * Count the number of services available in each country.
     *
     * @return array An associative array where keys are country codes and values are service counts.
     */
    public function countByCountry()
    {
        $counts = [];

        // Iterate over each service to count services by country
        foreach ($this->services as $service) {
            $country = strtoupper($service->getCountry());
            if (!isset($counts[$country])) {
                $counts[$country] = 0;
            }
            $counts[$country]++;
        }

        return $counts;
    }
}
