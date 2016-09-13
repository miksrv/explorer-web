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
 * @version 1.0.0 (13.09.2016)
 */
class Statistics extends \Core\BaseModel {

    /**
     * Set the parameters for plotting
     * @var array
     */
    var $data_sets = array(
        'temp1' => array(
            "name" => "On the street",
            "data" => array(),
            "unit" => "C",
            "type" => "line",
            "valueDecimals" => 1
        ),
        'temp2' => array(
            "name" => "In room",
            "data" => array(),
            "unit" => "C",
            "type" => "line",
            "valueDecimals" => 1
        ),
        'humd' => array(
            "name" => "Air humidity",
            "data" => array(),
            "unit" => "%",
            "type" => "area",
            "min" => 0,
            "max" => 100,
            "valueDecimals" => 1
        ),
        'press' => array(
            "name" => "Pressure (mm)",
            "data" => array(),
            "unit" => "мм.рт.ст.",
            "type" => "area",
            "min" => 700,
            "max" => 800,
            "valueDecimals" => 0
        ),
        'light' => array(
            "name" => "Illuminance (lx)",
            "data" => array(),
            "unit" => "lux",
            "type" => "area",
            "valueDecimals" => 0
        ),
        'wind' => array(
            "name" => "Wind (m\s)",
            "data" => array(),
            "unit" => "м/с",
            "type" => "column",
            "valueDecimals" => 1
        ),
        'battery' => array(
            "name" => "Voltage (battery)",
            "data" => array(),
            "unit" => "В",
            "type" => "area",
            "valueDecimals" => 1
        ),
    );


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
    function make_data_graphs($set, $data) {
        $json  = array(
            'xData' => array(),
            'datasets' => array(
                $set => $this->data_sets[$set],
            ),
        );

        foreach ($data as $array) {
            foreach ($array as $key => $val) {

                switch ($key) {
                    case 'datestamp' :
                        $date = new \DateTime($val);

                        $json['xData'][] = $date->format('m/d/Y H:i') . ' GMT';
                        break;

                    case 'temp1' :
                    case 'temp2' :
                    case 'humd'  :
                    case 'light' :
                    case 'wind'  :
                    case 'battery' :

                        if (isset($json['datasets'][$key])) {
                            $json['datasets'][$key]['data'][] = (float) $val;
                        }
                        break;

                    case 'press' :
                        if ($val >= 700 && $val <= 800) {
                            $json['datasets'][$key]['data'][] = (float) $val;
                        }
                        break;
                }
               
            }
        }

        return $json;
    } // function make_data_graphs($set, $data)

}

/* Location: /php.inc/models/statistics.class.php */