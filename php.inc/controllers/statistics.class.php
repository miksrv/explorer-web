<?php
/**
 * A U T O M A T E D    W E A T H E R    S T A T I O N
 * 
 * @author     Mikhail (Mik™) <miksoft.tm@gmail.com>
 * @copyright  Copyright (c) 2016, Mikhail
 * @link       http://miksrv.ru
 */

    namespace Controllers;

/**
 * Custom controller class
 * 
 * @package Automated weather station
 * @subpackage Controllers
 * @category Statistics
 * @author Mikhail (Mik™) <miksoft.tm@gmail.com>
 * @version 1.0.0 (07.09.2016)
 */
class Statistics {

    /**
     * Link to the parent object (global object 'this')
     * @var object 
     */
    private $parent;

    /**
     * Link to the langugae section (global object 'this')
     * @var object 
     */
    private $langugae;

    /**
     * The loaded values in the database
     * @var array
     */
    private $data = array();


    /**
     * Set the parameters for plotting
     * @var array
     */
    protected $data_sets = array(
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
    function __construct($parent) {    
        $this->parent = $parent;
    } // function __construct($parent)


    /**
     * @return void
     */
    function make() {
        $this->create_lang_menu();

        $this->load_language();
        $this->load_param_set();
        
        if (isset($_GET['data'])) {

            $this->parent->view->json($this->load_database());

        }
    } // function write()


    protected function load_param_set() {
        $var = filter_input(INPUT_GET, 'set', FILTER_SANITIZE_ENCODED);
        
        if ( ! empty($var)) {
            
            $this->parent->view->assign('set', $var);
            
        }
    } // protected function load_param_set()

    protected function create_lang_menu() {
        $this->parent->view->assign('lang_menu', $this->parent->create_lang_menu());
    } // protected function create_lang_menu()


    protected function load_language() {        
        $this->langugae = new \Models\Language();

        $this->parent->view->assign('language', $this->langugae->get());
    } // protected function load_language()


    protected function load_database() {
        $set = filter_input(INPUT_GET, 'set', FILTER_SANITIZE_ENCODED);

        if ( ! key_exists($set, $this->data_sets)) {
            
            $set = key($this->data_sets);
            
        }

        $param['sql'] = "SELECT datestamp, {$set} "
                      . "FROM data WHERE `datestamp` >= DATE_SUB(NOW(), INTERVAL 1 WEEK) "
                      . "ORDER BY `datestamp` DESC";

        $data  = $this->parent->mysql->get_data('data', $param);

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
    } // protected function load_database()
}

/* Location: /php.inc/controllers/statistics.class.php */