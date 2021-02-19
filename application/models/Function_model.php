<?php

class Function_model extends CI_Model {

    public $id = 0;
	
    function __construct() {
		
        parent::__construct();
		
    }
	
	function get_db_category() {
		
		$query = $this->db->get('categories');
		return $query->result();
		
	}

	function get_db_products($id) {

        $this->db->where('category_id', $id);
        $query = $this->db->get('products');
        return $query->result();

    }

    function get_db_products_admin() {

        $query = $this->db->query("SELECT a.*, c.name AS name_category FROM products a LEFT JOIN categories c ON c.id=a.category_id");
        return $query->result();

    }

    function get_db_products_admin_check($id) {

        $query = $this->db->query("SELECT * FROM products WHERE id='{$id}'");
        return $query->row();

    }

    function view_edit_db_products($id) {

        $query = $this->db->query("SELECT * FROM products WHERE id='{$id}'");
        return $query->row();

    }

    function check_db_login($login, $password) {

        $password = md5($password);
        $query = $this->db->query("SELECT * FROM admin WHERE login='{$login}' AND PASSWORD='{$password}'");
        return $query->row();

    }

    function view_edit_db_category($id) {

        $query = $this->db->query("SELECT * FROM categories WHERE id='{$id}'");
        return $query->row();

    }

    function view_edit_db_category_check($name) {

        $query = $this->db->query("SELECT * FROM categories WHERE name='{$name}'");
        return $query->row();

    }

    function update_edit_db_category($id,$name) {

        $data = array(
            'name' => $name
        );

        $this->db->where('id', $id);
        return $this->db->update('categories', $data);

    }

}