<?php

namespace App\Model;

/**
 * Class Service
 *
 * This class represents a Service entity with its details.
 */
class Service
{
    /** @var string $ref The reference of the service. */
    private $ref;

    /** @var string $centre The centre providing the service. */
    private $centre;

    /** @var string $service The type or name of the service. */
    private $service;

    /** @var string $country The country code where the service is available. */
    private $country;

    /**
     * Service constructor.
     *
     * @param string $ref     The reference of the service.
     * @param string $centre  The centre providing the service.
     * @param string $service The type or name of the service.
     * @param string $country The country code where the service is available.
     */
    public function __construct($ref, $centre, $service, $country)
    {
        $this->ref = $ref;
        $this->centre = $centre;
        $this->service = $service;
        $this->country = $country;
    }

    /**
     * Retrieve the country code where the service is available.
     *
     * @return string The country code.
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Convert the Service object to a string representation.
     *
     * @return string A string representation of the Service object.
     */
    public function __toString()
    {
        return "{$this->ref}, {$this->centre}, {$this->service}, {$this->country}";
    }
}
