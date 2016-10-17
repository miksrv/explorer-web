<?php
/**
 * A U T O M A T E D    W E A T H E R    S T A T I O N
 * 
 * @author     Mikhail (Mik™) <miksoft.tm@gmail.com>
 * @copyright  Copyright (c) 2016, Mikhail
 * @link       http://miksrv.ru
 */

    namespace Models;

        use \Libraries\JSON as JSON;

/**
 * Basic information output section
 * 
 * @package Automated weather station
 * @subpackage Models
 * @category Statistics
 * @author Mikhail (Mik™) <miksoft.tm@gmail.com>
 * @version 1.1.0 (17.10.2016)
 */
class Statistics extends \Core\BaseModel {

    /**
     * CLASS CONSTRUCTOR
     */
    function __construct() {
        $this->delegate(JSON::get_section('dashboard'));
    } // function __construct()


    /**
     * Get all the properties of the object JSON-section 'profile'
     * 
     * @return \Models\Profile
     */
    function get() {
        return $this;
    } // function get()

    
    /**
     * Create a json array of data to plot
     * 
     * @param string $set array key name $this->data_sets
     * @param array $data mysql-data
     * @return array
     */
    function make_data_graphs($data) {
        $result = array();

        foreach ($data as $array) {
            $date = new \DateTime($array['datestamp']);
            $date = $date->getTimestamp() * 1000; // $date->format('m/d/Y H:i');

            $result['datetime'][] = $date;
            $result['temp1'][] = array($date, (float) $array['temp1']);
            $result['temp2'][] = array($date, (float) $array['temp2']);
            $result['humd'][]  = array($date, (float) $array['humd']);
            
            $result['light'][] = array($date, (float) $array['light']);
            
            if ($array['wind'] < 30) {
                $result['wind'][]  = array($date, (float) $array['wind']);
            }

            if ($array['press'] > 700 && $array['press'] < 800) {
                $result['press'][] = array($date, (float) $array['press']);
            }
        }

        return $result;
    } // function make_data_graphs($set, $data)

}

/* Location: /php.inc/models/statistics.class.php */