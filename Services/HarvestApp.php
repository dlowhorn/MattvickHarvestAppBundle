<?php

namespace Mattvick\HarvestAppBundle\Services;

use \HarvestAPI;

/**
 * Very simple proxy class to HarvestAPI functionality
 */
class HarvestApp {

    private $harvest;

    /**
     * @param \HarvestAPI $harvest HarvestAPI API client instance
     */
    public function __construct(HarvestAPI $harvest)
    {
        $this->harvest = $harvest;
    }

    /**
     * Get oAuth client
     *
     * @return \HarvestAPI
     */
    public function getApi()
    {
        return $this->harvest;
    }
}