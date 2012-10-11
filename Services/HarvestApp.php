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
    public function __construct(HarvestAPI $harvest, $user, $password, $account, $ssl, $mode, $headers)
    {
        $this->harvest = $harvest;

        // Set parameters
        $this->harvest->setUser($user);
        $this->harvest->setPassword($password);
        $this->harvest->setAccount($account);
        $this->harvest->setSsl($ssl);
        $this->harvest->setMode($mode);
        $this->harvest->setHeaders($headers);
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