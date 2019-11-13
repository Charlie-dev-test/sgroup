<?php

/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 13.11.2019
 * Time: 22:51
 */
class Link_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function check_url($url) {
        if (!preg_match("/^(https?:\/\/)?([\da-zа-я\.-]+)\.([a-zа-я\.]{2,6})([\/\w \.-]*)*\/?$/u", $url)) {
            return false;
        } else {
            return true;
        }
    }

    public function reduce_url($url){
//        echo $url;
        
    }

}