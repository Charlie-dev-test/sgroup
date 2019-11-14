<?php

/**
 *
 *
 */
class Link_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function check_url($url) {
        if(!preg_match("/^(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4})(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))$/u", $url)){
            return false;
        } else {
            return true;
        }
    }

    public function reduce_url($url){
        $old_url = $this->db->get_where('urls', array('url' => $url));
        $old_url->row_array();
        if($old_url->result_array == true){
            return $old_url->result_array[0]['short_url'];
        } else {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';

            for ($i = 0; $i < 6; $i++)
            {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $data = array(
                'url' => $url,
                'short_url' => $randomString
            );
            $query = $this->db->insert('urls', $data);
            if($query == true){
                return $randomString;
            } else {
                return 'Произошла ошибка!';
            }
        }
    }

    public function find_url($url){
        $old = $this->db->get_where('urls', array('short_url' => $url));
        $old->row_array();
        if($old->result_array == true){
            return $old->result_array[0]['url'];
        } else {
            return FALSE;
        }
    }

}