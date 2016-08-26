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
 * @category Summary
 * @author Mikhail (Mik™) <miksoft.tm@gmail.com>
 * @version 1.0.0 (25.08.2016)
 */
class Summary extends \Core\BaseModel {

    /**
     * The loaded mysql data
     */
    private $data = array();

    /**
     * CLASS CONSTRUCTOR
     */
    function __construct($data) {
        $this->delegate(JSON::get_section('summary'));

        $this->data = $data;

        $this->now_temp = isset($data['temp1']) ? $data['temp1'] : NULL;
        $this->max_temp = isset($data['max_temp1']) ? $data['max_temp1'] : NULL;
        $this->min_temp = isset($data['min_temp1']) ? $data['min_temp1'] : NULL;
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
     * Returns the icon font class for the current phase of the moon
     * 
     * @return string
     * @see \Libraries\MoonPhase\phase_name_class()
     */
    function get_moon_phase_name() {
        $moon  = new \Libraries\MoonPhase();

        return $moon->phase_name_class();
    } // function get_moon_phase_name()
    
    
    /**
     * Returns the file name for the background image, given the current time of year and time of day
     * 
     * @return string
     */
    function get_background_img() {
        $name  = get_season() . '-';
        $name .= get_times_of_day();
        
        return $name . '.jpg';
    } // function get_background_img()
}

/* Location: /php.inc/models/summary.class.php */