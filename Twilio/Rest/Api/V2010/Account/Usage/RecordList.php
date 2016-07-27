<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Usage;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Rest\Api\V2010\Account\Usage\Record\AllTimeList;
use Twilio\Rest\Api\V2010\Account\Usage\Record\DailyList;
use Twilio\Rest\Api\V2010\Account\Usage\Record\LastMonthList;
use Twilio\Rest\Api\V2010\Account\Usage\Record\MonthlyList;
use Twilio\Rest\Api\V2010\Account\Usage\Record\ThisMonthList;
use Twilio\Rest\Api\V2010\Account\Usage\Record\TodayList;
use Twilio\Rest\Api\V2010\Account\Usage\Record\YearlyList;
use Twilio\Rest\Api\V2010\Account\Usage\Record\YesterdayList;
use Twilio\Values;
use Twilio\Version;

/**
 * @property \Twilio\Rest\Api\V2010\Account\Usage\Record\AllTimeList allTime
 * @property \Twilio\Rest\Api\V2010\Account\Usage\Record\DailyList daily
 * @property \Twilio\Rest\Api\V2010\Account\Usage\Record\LastMonthList lastMonth
 * @property \Twilio\Rest\Api\V2010\Account\Usage\Record\MonthlyList monthly
 * @property \Twilio\Rest\Api\V2010\Account\Usage\Record\ThisMonthList thisMonth
 * @property \Twilio\Rest\Api\V2010\Account\Usage\Record\TodayList today
 * @property \Twilio\Rest\Api\V2010\Account\Usage\Record\YearlyList yearly
 * @property \Twilio\Rest\Api\V2010\Account\Usage\Record\YesterdayList yesterday
 */
class RecordList extends ListResource {
    protected $_allTime = null;
    protected $_daily = null;
    protected $_lastMonth = null;
    protected $_monthly = null;
    protected $_thisMonth = null;
    protected $_today = null;
    protected $_yearly = null;
    protected $_yesterday = null;

    /**
     * Construct the RecordList
     * 
     * @param Version $version Version that contains the resource
     * @param string $accountSid A 34 character string that uniquely identifies
     *                           this resource.
     * @return \Twilio\Rest\Api\V2010\Account\Usage\RecordList 
     */
    public function __construct(Version $version, $accountSid) {
        parent::__construct($version);
        
        // Path Solution
        $this->solution = array(
            'accountSid' => $accountSid,
        );
        
        $this->uri = '/Accounts/' . $accountSid . '/Usage/Records.json';
    }

    /**
     * Streams RecordInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     * 
     * @param array $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. stream()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use
     *                        the default value of 50 records.  If no page_size is
     *                        defined
     *                        but a limit is defined, stream() will attempt to read
     *                        the limit
     *                        with the most efficient page size, i.e. min(limit,
     *                        1000)
     * @return \Twilio\Stream stream of results
     */
    public function stream(array $options = array(), $limit = null, $pageSize = null) {
        $limits = $this->version->readLimits($limit, $pageSize);
        
        $page = $this->page(
            $options, 
        $limits['pageSize']);
        
        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Reads RecordInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     * 
     * @param array $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use
     *                        the default value of 50 records.  If no page_size is
     *                        defined
     *                        but a limit is defined, read() will attempt to read
     *                        the
     *                        limit with the most efficient page size, i.e.
     *                        min(limit, 1000)
     * @return RecordInstance[] Array of results
     */
    public function read(array $options = array(), $limit = null, $pageSize = Values::NONE) {
        return iterator_to_array($this->stream(
            $options, 
        $limit, $pageSize), false);
    }

    /**
     * Retrieve a single page of RecordInstance records from the API.
     * Request is executed immediately
     * 
     * @param array $options Optional Arguments
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return \Twilio\Page Page of RecordInstance
     */
    public function page(array $options = array(), $pageSize = Values::NONE, $pageToken = Values::NONE, $pageNumber = Values::NONE) {
        $options = new Values($options);
        $params = Values::of(array(
            'Category' => $options['category'],
            'StartDate<' => $options['startdateBefore'],
            'StartDate' => $options['startDate'],
            'StartDate>' => $options['startdateAfter'],
            'EndDate<' => $options['enddateBefore'],
            'EndDate' => $options['endDate'],
            'EndDate>' => $options['enddateAfter'],
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ));
        
        $response = $this->version->page(
            'GET',
            $this->uri,
            $params
        );
        
        return new RecordPage($this->version, $response, $this->solution);
    }

    /**
     * Access the allTime
     */
    protected function getAllTime() {
        if (!$this->_allTime) {
            $this->_allTime = new AllTimeList(
                $this->version,
                $this->solution['accountSid']
            );
        }
        
        return $this->_allTime;
    }

    /**
     * Access the daily
     */
    protected function getDaily() {
        if (!$this->_daily) {
            $this->_daily = new DailyList(
                $this->version,
                $this->solution['accountSid']
            );
        }
        
        return $this->_daily;
    }

    /**
     * Access the lastMonth
     */
    protected function getLastMonth() {
        if (!$this->_lastMonth) {
            $this->_lastMonth = new LastMonthList(
                $this->version,
                $this->solution['accountSid']
            );
        }
        
        return $this->_lastMonth;
    }

    /**
     * Access the monthly
     */
    protected function getMonthly() {
        if (!$this->_monthly) {
            $this->_monthly = new MonthlyList(
                $this->version,
                $this->solution['accountSid']
            );
        }
        
        return $this->_monthly;
    }

    /**
     * Access the thisMonth
     */
    protected function getThisMonth() {
        if (!$this->_thisMonth) {
            $this->_thisMonth = new ThisMonthList(
                $this->version,
                $this->solution['accountSid']
            );
        }
        
        return $this->_thisMonth;
    }

    /**
     * Access the today
     */
    protected function getToday() {
        if (!$this->_today) {
            $this->_today = new TodayList(
                $this->version,
                $this->solution['accountSid']
            );
        }
        
        return $this->_today;
    }

    /**
     * Access the yearly
     */
    protected function getYearly() {
        if (!$this->_yearly) {
            $this->_yearly = new YearlyList(
                $this->version,
                $this->solution['accountSid']
            );
        }
        
        return $this->_yearly;
    }

    /**
     * Access the yesterday
     */
    protected function getYesterday() {
        if (!$this->_yesterday) {
            $this->_yesterday = new YesterdayList(
                $this->version,
                $this->solution['accountSid']
            );
        }
        
        return $this->_yesterday;
    }

    /**
     * Magic getter to lazy load subresources
     * 
     * @param string $name Subresource to return
     * @return \Twilio\ListResource The requested subresource
     * @throws \Twilio\Exceptions\TwilioException For unknown subresources
     */
    public function __get($name) {
        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }
        
        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     * 
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return \Twilio\InstanceContext The requested resource context
     * @throws \Twilio\Exceptions\TwilioException For unknown resource
     */
    public function __call($name, $arguments) {
        $property = $this->$name;
        if (method_exists($property, 'getContext')) {
            return call_user_func_array(array($property, 'getContext'), $arguments);
        }
        
        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Api.V2010.RecordList]';
    }
}