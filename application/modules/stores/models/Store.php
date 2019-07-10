<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Model {
    private $table = 'stores';
    public function __construct() {
        parent::__construct();

    }

    public function get_stores(){
        $query = $this->db->get($this->table);
		$condition['user_id'] = $this->session->userdata('logged_in')->id;
		$query = $this->db->get_where($this->table,$condition);
        return $query->result();
    }

    public function get_store($id){
        $condition['id'] = $id;
        $query = $this->db->get_where($this->table,$condition);
        $result = $query->row();
        if ($result){
            return $result;
        }
        return false;
    }
	
	public function get_store_names()
    {   
        
        $this->db->select('*');
        $this->db->from('stores');
        //$this->db->where('id', 25);
        $query = $this->db->get();
        return $query->result();
    }

   
    public function add_store($params){
        $params = array_filter($params,'strlen');
		
        $this->db->insert($this->table,$params);
    }


    public function update_store($id,$params){
        $params = array_filter($params,'strlen');
        $params['modified'] = date('Y-m-d H:i:s');
        $this->db->where('id',$id);
        return $this->db->update($this->table,$params);
    }

    
    public function delete_store($id){
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
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('region', 'Region', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'State', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			$this->form_validation->set_rules('postal_code', 'Postal Code', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
			$this->form_validation->set_rules('fax', 'Fax', 'trim|required');

        }
        if ($action == 'edit'){
           $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('region', 'Region', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'State', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			$this->form_validation->set_rules('postal_code', 'Postal Code', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
			$this->form_validation->set_rules('fax', 'Fax', 'trim|required');
            
        }
        if ($this->form_validation->run() == FALSE) {
            return FALSE ;
        } else {
            return TRUE;
        }
    }


}