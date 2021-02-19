<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	
	function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('Function_model');
		
	}
	
	public function index() {

        $this->load->view('site/header',
            array(
                'title' => "Тестовая страница"
            )
        );

		$this->load->view('site/index',
            array(
                'get_category' => $this->Function_model->get_db_category()
            )
        );

        $this->load->view('site/footer');

	}

}