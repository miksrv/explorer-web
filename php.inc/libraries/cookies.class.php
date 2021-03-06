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
class Cookies  {

    /**
     * Method sets cookies
     * 
     * @static
     * @param string $name cookies name
     * @param string $value cookies value
     * @param integer $expire cookie cookies during installation
     */
    static function set_cookie($name = '', $value = '', $expire = '') {
        if ( ! $expire || ! is_numeric($expire)) {
            $expire = time() + 86400;
        } else {
            $expire = time() + $expire;
        }

        $domain = '';
        $path   = '/';
        $prefix = '';
        $secure = FALSE;

        setcookie($prefix . $name, $value, $expire, $path, $domain, $secure);
    } // static function set_cookie($name = '', $value = '', $expire = 86400)

    
    /**
     * The method returns the contents of cookies
     * 
     * @static
     * @param string $name cookies name
     * @return mixed
     */
    static function get_cookie($name) {
        if ( ! isset($_COOKIE[$name]) || empty($_COOKIE[$name]))
            return FALSE;
        
        return $_COOKIE[$name];
    } // static function get_cookie($name)


    /**
     * The method removes the cookies set
     * 
     * @static
     * @param string $name
     * @return void
     */
    static function delete_cookie($name) {
        self::set_cookie($name, '', 0);
    } // static function delete_cookie($name)
}

/* Location: /php.inc/libraries/cookies.class.php */