<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('Function_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		
	}
	
	public function index() {

	    if(isset($this->session->login)) { redirect(base_url() . 'admin/'); }

        $login = (string)$this->input->post('login');
        $password = (string)$this->input->post('password');

        $config = array(
            array(
                'field' => 'login',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'password',
                'rules' => 'trim|required'
            )
        );

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE) {
            $this->load->view('admin/login',
                array(
                    'title' => "Авторизация",
                    'error' => ""
                )
            );
        } else {


            $auth = $this->Function_model->check_db_login($login, $password);

            if(isset($auth)) {
                $this->session->set_userdata('login', $login);
                redirect(base_url() . 'admin/');
            } else {
                $this->load->view('admin/login',
                    array(
                        'title' => "Авторизация",
                        'error' => "Sorry! The credentials you have provided are not correct"
                    )
                );
            }

        }

	}

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url().'login');
    }

}