<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 13.11.2019
 * Time: 16:00
 */
class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('link_model');
    }


    public function index() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');


        $this->form_validation->set_rules('link', 'Url', 'required');


        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
            if(isset($_POST['link'])){

                if ($this->form_validation->run() == FALSE) {
                    echo 'Enter valid';
                } else {
                    $url = htmlspecialchars($_POST['link']);
                    $checked = $this->link_model->check_url($url);
                    if($checked) {

                        $this->link_model->reduce_url($url);

                    } else {
                        echo 'Enter valid';
                    }


                }

            }else{
                echo 'Nope!';
            }
        }else{
            $data['title'] = "Главная страница";
            $this->load->helper('url');

            $this->load->view('templates/header', $data);
            $this->load->view('main', $data);
            $this->load->view('templates/footer');
        }


    }



}