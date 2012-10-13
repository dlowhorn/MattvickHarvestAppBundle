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
    public function __construct(HarvestAPI $harvest, $user, $password, $account, $ssl, $mode)
    {
        $this->harvest = $harvest;

        // Set parameters
        $this->harvest->setUser($user);
        $this->harvest->setPassword($password);
        $this->harvest->setAccount($account);
        $this->harvest->setSSL($ssl);
        $this->harvest->setRetryMode($mode);
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

    /**
     * get all project entries for given time range for a particular user if specified
     *
     * <code>
     * $range = new Harvest_Range( "20090712", "20090719" );
     * $project_id = 12345;
     * $user_id = 11111;
     * $filters = array (
     *      'billable' => Acceptable values for the billable parameter are "yes" and "no".
     *      'only_billed' => Acceptable value for the only_billed parameter is "yes". Anything else will be ignored.
     *      'only_unbilled' => Acceptable value for the only_unbilled parameter is "yes". Anything else will be ignored.
     *      'is_closed' => Acceptable values for the is_closed parameter are "yes" and "no".
     *      'updated_since' => Acceptable value for the updated_since parameter is a UTC date time value, URL encoded.
     * )
     *
     * $api = new HarvestAPI();
     *
     * $result = $api->getProjectEntries( $project_id, $range, $user_id );
     * if( $result->isSuccess() ) {
     *     $dayEntries = $result->data;
     * }
     * </code>
     * 
     * @param int $project_id Project Identifier
     * @param Harvest_Range $range Time Range
     * @param int $user_id User identifier optional
     * @return Harvest_Result
     */
    public function getProjectEntries($project_id, \Harvest_Range $range, $user_id = null, $filters = null) 
    {
        $url = "projects/" . $project_id . "/entries?from=" . $range->from() . '&to=' . $range->to();
        if (!is_null($user_id)) {
            $url .= "&user_id=" . $user_id;
        }
        if (!is_null($filters) && is_array($filters)) {
            foreach ($filters as $key => $filter) {
                $url .= "&".$key."=" . $filter;
            }
        }
        return $this->harvest->performGET($url, true);
    }
}
