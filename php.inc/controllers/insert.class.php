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
 * @category Resume
 * @author Mikhail (Mik™) <miksoft.tm@gmail.com>
 * @version 1.0.1 (29.08.2016)
 */
class Insert {

    /**
     * Link to the parent object (global object 'this')
     * @var object 
     */
    private $parent;
    
    /**
     * Loaded config for arduino
     * @var array
     */
    private $arduino;

    /**
     * Get the income weather params;
     * @var array
     */
    private $params;


    /**
     * CLASS CONSTRUCTOR
     */
    function __construct($parent) {    
        $this->parent = $parent;
    } // function __construct($parent)


    /**
     * @return void
     */
    function write() {
        $this->load_arduino_config();

        $this->check_secret();
        $this->get_weather_params();
        $this->save_to_database();

        $this->parent->view->json(array('code' => 'success'));
    } // function write()


    /**
     * Loaded the aruino config file
     * 
     * @access protected
     * @see /php.inc/config/arduino.php
     * @return void
     */
    protected function load_arduino_config() {
        require_once COREPATH . 'config/arduino.php';

        $this->arduino = $config;
    } // protected function load_arduino_config()


    /**
     * It compares the secret key from the address bar with a secret key in 
     * the configuration file
     * 
     * @access protected
     * @see /php.inc/config/arduino.php
     * @return void
     */
    protected function check_secret() {
        if ( ! isset($_POST['ID']) || $_POST['ID'] != $this->arduino['secret'])
            \Core\Router::redirect('/');
    } // protected function check_secret()


    /**
     * Get the necessary parameters from the address bar
     * 
     * @access protected
     * @return void
     */
    protected function get_weather_params() {
        $this->params = array(
            'temp1' => $_POST['temp1'] ? (float) $_POST['temp1'] : 0.0,
            'temp2' => $_POST['temp2'] ? (float) $_POST['temp2'] : 0.0,
            'humd'  => $_POST['humd'] ? (float) $_POST['humd'] : 0.0,
            'press' => $_POST['press'] ? (float) $_POST['press'] : 0.0,
            'light' => $_POST['light'] ? (int) $_POST['light'] : 0,
            'wind'  => $_POST['wind'] ? (float) $_POST['wind'] : 0.0,
            'battery' => $_POST['battery'] ? (float) $_POST['battery'] : 0.0
        );
    } // protected function get_weather_params()


    /**
     * Storing data in a database
     * 
     * @access protected
     * @return void
     */
    protected function save_to_database() {
        if (empty($this->params) || ! is_array($this->params))
            \Core\Router::redirect('/');

        $this->parent->mysql->save(
                'data', 
                array('data' => $this->params)
            );
    } // protected function save_to_database()
}

/* Location: /php.inc/controllers/insert.class.php */