<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
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
                    echo 'Введите не пустую ссылку';
                } else {
                    $url = htmlspecialchars($_POST['link']);
                    $checked = $this->link_model->check_url($url);
                    if($checked) {
                        $set_url = $this->link_model->reduce_url($url);
                        if($set_url) {
                            echo base_url() . '?=' . $set_url;
                        }

                    } else {
                        echo 'Введите валидный Url';
                    }
                }

            }else{
                echo 'Произошла ошибка';
            }
        }else{

            $request_uri = ltrim($_SERVER["REQUEST_URI"], '/?=');
            if($request_uri == ''){
                $data['title'] = "Главная страница";
                $this->load->helper('url');

                $this->load->view('templates/header', $data);
                $this->load->view('main', $data);
                $this->load->view('templates/footer');
            } else {
                $find = $this->link_model->find_url($request_uri);
                if($find){
                    header('Location:' .$find);
                } else {
                    echo '<h4>Такой ссылки не существует!</h4><br>';
                    $data['title'] = "Главная страница";
                    $this->load->helper('url');

                    $this->load->view('templates/header', $data);
                    $this->load->view('main', $data);
                    $this->load->view('templates/footer');
                }

            }

        }

    }

}