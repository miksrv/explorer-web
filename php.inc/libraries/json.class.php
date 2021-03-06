<?php
/**
 * A U T O M A T E D    W E A T H E R    S T A T I O N
 * 
 * @author     Mikhail (Mik™) <miksoft.tm@gmail.com>
 * @copyright  Copyright (c) 2016, Mikhail
 * @link       http://miksrv.ru
 */
    
    namespace Libraries;
	
/**
 * JSON CLASS
 * 
 * @package Automated weather station
 * @subpackage Libraries
 * @category JSON
 * @author Mikhail (Mik™) <miksoft.tm@gmail.com>
 * @version 1.0.0 (25.08.2016)
 */
class JSON  {

    /**
     * JSON-object data
     * @var object 
     */
    private static $data = NULL;
    
    
    /**
     * This method loads the data in JSON format
     * 
     * @static
     * @param string $content 
     * @throws \Exception
     */
    static function set_data($content) {
        $json = json_decode($content);

        if ( ! is_object($json) || is_null($json))
            throw new \Exception('Not valid JSON-format data!');

        self::$data = $json;
    } // static function set_data($content)
    

    /**
     * Returns a JSON object desired section
     * 
     * @static
     * @param string JSON object section name
     * @return object
     */
    static function get_section($name) {
        return self::_get_json_object($name);
    } // static function get_section($name)


    /**
     * Returns a JSON object desired section
     * 
     * @static
     * @access private
     * @param string JSON object section name
     * @return object
     */
    private static function _get_json_object($name) {
        if ( is_null(self::$data) || ! isset(self::$data->$name))
            return NULL;

        return self::$data->$name;
    } // private static function _get_json_object($name)
}

/* Location: /php.inc/libraries/json.class.php */