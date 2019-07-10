<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model {
    private $table = 'categories';
    public function __construct() {
        parent::__construct();

    }

    public function get_categories(){
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_category($id){
        $condition['id'] = $id;
        $query = $this->db->get_where($this->table,$condition);
        $result = $query->row();
        if ($result){
            return $result;
        }
        return false;
    }
	
	public function get_category_names()
    {   
        
        $this->db->select('*');
        $this->db->from('categories');
        //$this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result();
    }

   
    public function add_category($params){
        $params = array_filter($params,'strlen');
        $this->db->insert($this->table,$params);
    }


    public function update_category($id,$params){
        $params = array_filter($params,'strlen');
        $params['modified'] = date('Y-m-d H:i:s');
        $this->db->where('id',$id);
        return $this->db->update($this->table,$params);
    }

    
    public function delete_category($id){
        return $this->db->delete($this->table,array('id'=>$id));
    }

    public function toggle_status($id){
        $this->db->set('status', '1-status', FALSE);
        $this->db->where('id',$id);
        return $this->db->update($this->table);
    }


    
    public function verify_validation(){
        $this->load->library('form_validation');
        $action =  $this->router->method;
        if ($action == 'add'){
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');

        }
        if ($action == 'edit'){
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            
        }
        if ($this->form_validation->run() == FALSE) {
            return FALSE ;
        } else {
            return TRUE;
        }
    }


}