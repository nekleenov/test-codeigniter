<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('Function_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->library('form_validation');
		
	}
	
	public function index() {

        if(empty($this->session->login)) { redirect(base_url() . 'login'); }

        $delete = (string)$this->input->get('delete');
        if(!empty($delete)) {
            $prod_ch = $this->Function_model->get_db_products_admin_check($delete);
            unlink('.'.$prod_ch->photo);
            $this->db->where('id', $delete);
            $this->db->delete('products');

            redirect(base_url() . 'admin/');
        }

        $this->load->view('admin/header',
            array(
                'title' => "Админ тест",
                'login' => $this->session->login
            )
        );

        $this->load->view('admin/index',
            array(
                'get_products' => $this->Function_model->get_db_products_admin(),
                'date_format' => '%d.%m.%Y - %h:%i %a'
            )
        );

        $this->load->view('admin/footer');

	}

	public function edit() {

        $id = (int)$this->uri->segment(3, 0);
        if(empty($this->session->login)) { redirect(base_url() . 'login'); }

        $db_check = $this->Function_model->view_edit_db_products($id);
        if(!isset($db_check)) { show_404(); exit(); }

        $this->load->view('admin/header',
            array(
                'title' => $db_check->name." - Edit - Админ тест",
                'login' => $this->session->login
            )
        );

        $config = array(
            array(
                'field' => 'name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'description',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'category',
                'rules' => 'trim|required'
            )
        );

        $this->form_validation->set_rules($config);
        if($this->form_validation->run() == FALSE) {

            $this->load->view('admin/edit',
                array(
                    'error' => '',

                    'get_category' => $this->Function_model->get_db_category(),
                    'id_num' => $db_check->category_id,
                    'get_products' => $this->Function_model->view_edit_db_products($id),
                )
            );

        } else {

            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 0;
            $config['encrypt_name']         = true;

            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('photo')) {

                $data = array(
                    'category_id' => (int)$this->input->post('category'),
                    'name' => (string)$this->input->post('name'),
                    'description' => (string)$this->input->post('description')
                );

                $this->db->where('id', $id);
                $this->db->update('products', $data);

            } else {

                unlink('.'.$db_check->photo);
                $data = array(
                    'category_id' => (int)$this->input->post('category'),
                    'name' => (string)$this->input->post('name'),
                    'description' => (string)$this->input->post('description'),
                    'photo' => '/uploads/'.$this->upload->data('file_name')
                );

                $this->db->where('id', $id);
                $this->db->update('products', $data);

            }

            redirect(base_url() . 'admin/');

        }





        $this->load->view('admin/footer');

    }

	public function category() {

        if(empty($this->session->login)) { redirect(base_url() . 'login'); }

        $delete = (string)$this->input->get('delete');
        if(!empty($delete)) {
            $this->db->where('id', $delete);
            $this->db->delete('categories');
            redirect(base_url() . 'admin/category/');
        }

        $this->load->view('admin/header',
            array(
                'title' => "Категории - Админ тест",
                'login' => $this->session->login
            )
        );

        $this->load->view('admin/category',
            array(
                'get_category' => $this->Function_model->get_db_category(),
            )
        );

        $this->load->view('admin/footer');

    }


    public function editcat() {

        $id = (int)$this->uri->segment(4, 0);
        if(empty($this->session->login)) { redirect(base_url() . 'login'); }
        $db_check = $this->Function_model->view_edit_db_category($id);
        if(!isset($db_check)) { show_404(); exit(); }

        $this->load->view('admin/header',
            array(
                'title' => $db_check->name." - Edit - Админ тест",
                'login' => $this->session->login
            )
        );

        $config = array(
            array(
                'field' => 'edit_name',
                'rules' => 'trim|required'
            )
        );

        $edit_name = (string)$this->input->post('edit_name');

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE) {

            $this->load->view('admin/editcat',
                array(
                    'get_category' => $this->Function_model->view_edit_db_category($id),
                    'error' => ''
                )
            );

        } else {
            $check_update = $this->Function_model->view_edit_db_category_check($edit_name);
            if(isset($check_update)) {
                $this->load->view('admin/editcat',
                    array(
                        'get_category' => $this->Function_model->view_edit_db_category($id),
                        'error' => '<div class="alert alert-danger">В базе уже имеется аналогичное имя категории.</div>'
                    )
                );
            } else {
                $this->Function_model->update_edit_db_category($id, $edit_name);
                redirect(base_url() . 'admin/category/');
            }
        }

        $this->load->view('admin/footer');

    }

    public function addcat() {

        if(empty($this->session->login)) { redirect(base_url() . 'login'); }

        $edit_name = (string)$this->input->post('edit_name');
        $db_check = $this->Function_model->view_edit_db_category_check($edit_name);

        $this->load->view('admin/header',
            array(
                'title' => "Новая категория - Админ тест",
                'login' => $this->session->login
            )
        );

        $config = array(
            array(
                'field' => 'edit_name',
                'rules' => 'trim|required'
            )
        );

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE) {

            $this->load->view('admin/addcat',
                array(
                    'error' => ''
                )
            );

        } else {

            if(isset($db_check)) {
                $this->load->view('admin/addcat',
                    array(
                        'error' => '<div class="alert alert-danger">В базе уже имеется аналогичное имя категории.</div>'
                    )
                );
            } else {
                $data = array(
                    'name' => $edit_name,
                );

                $this->db->insert('categories', $data);
                redirect(base_url() . 'admin/category/');
            }

        }

        $this->load->view('admin/footer');

    }

    public function add() {

        if(empty($this->session->login)) { redirect(base_url() . 'login'); }

        $this->load->view('admin/header',
            array(
                'title' => "Новая товар - Админ тест",
                'login' => $this->session->login
            )
        );

        $config = array(
            array(
                'field' => 'name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'description',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'category',
                'rules' => 'trim|required'
            )
        );

        $this->form_validation->set_rules($config);
        if($this->form_validation->run() == FALSE) {

            $this->load->view('admin/add',
                array(
                    'error' => '',
                    'get_category' => $this->Function_model->get_db_category()
                )
            );

        } else {

            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;
            $config['encrypt_name']         = true;

            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('photo')) {
                $this->load->view('admin/add',
                    array(
                        'error' => '<div class="alert alert-danger">Возможно фото имеет не стандартный формат (gif,png,jpg) или размер превышает 2мб.</div>'
                    )
                );
            } else {

                $data = array(
                    'category_id' => (int)$this->input->post('category'),
                    'name' => (string)$this->input->post('name'),
                    'description' => (string)$this->input->post('description'),
                    'photo' => '/uploads/'.$this->upload->data('file_name'),
                    'create' => time()
                );

                $this->db->insert('products', $data);
                redirect(base_url() . 'admin/');

            }

        }

        $this->load->view('admin/footer');

    }

}