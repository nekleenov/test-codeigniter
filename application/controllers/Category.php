<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	
	function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('Function_model');
		
	}
	
	public function index() {

        $cId = (int)$this->input->get('cId');
        
        $this->load->view('site/header',
            array(
                'title' => "Тестовая страница"
            )
        );

        $this->load->view('site/category',
            array(
                'get_category' => $this->Function_model->get_db_category(),
                'cId' => (int)$this->input->get('cId'),
                'products' => $this->Function_model->get_db_products($cId)
            )
        );

        $this->load->view('site/footer');

	}

}