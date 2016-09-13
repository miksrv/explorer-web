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
 * @version 1.0.1 (13.09.2016)
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
        $section = new \Models\Statistics();

        $set = filter_input(INPUT_GET, 'set', FILTER_SANITIZE_ENCODED);

        if ( ! key_exists($set, $section->data_sets)) {

            $set = key($section->data_sets);

        }

        $param['sql'] = "SELECT datestamp, {$set} "
                      . "FROM data WHERE `datestamp` >= DATE_SUB(NOW(), INTERVAL 1 WEEK) "
                      . "ORDER BY `datestamp` DESC";

        $data = $this->parent->mysql->get_data('data', $param);

        return $section->make_data_graphs($set, $data);
    } // protected function load_database()
}

/* Location: /php.inc/controllers/statistics.class.php */