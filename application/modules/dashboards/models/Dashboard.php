<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Model {
    private $table = 'dashboards';
    public function __construct() {
        parent::__construct();

    }

    public function get_dashboards(){
        $query = $this->db->get('countings');
        return $query->row();
    }
	
	
	public function get_ads(){
        $query = $this->db->get('ads');
        return $query->num_rows();
    }
	
	
    public function get_clients(){
        $condition['user_role'] = '2';
        $query = $this->db->get_where('users',$condition);
        $result = $query->num_rows();
        if ($result){
            return $result;
        }
        return false;
    }

    /**
     * @param $params
     * Add dashboard
     */
    public function add_dashboard($params){
        $params = array_filter($params,'strlen');
        $this->db->insert($this->table,$params);
    }

    /**
     * @param $id
     * @param $params
     * @return mixed
     * Update dashboard
     */

    public function update_dashboard($id,$params){
        $params = array_filter($params,'strlen');
        $params['modified'] = date('Y-m-d H:i:s');
        $this->db->where('id',$id);
        return $this->db->update($this->table,$params);
    }

    /**
     * @param $id
     * @return mixed
     * Delete dashboard
     */
    public function delete_dashboard($id){
        return $this->db->delete($this->table,array('id'=>$id));
    }

    public function toggle_status($id){
        $this->db->set('status', '1-status', FALSE);
        $this->db->where('id',$id);
        return $this->db->update($this->table);
    }


    /**
     * @return bool
     * Validation function
     */
    public function verify_validation(){
        $this->load->library('form_validation');
        $action =  $this->router->method;
        if ($action == 'add'){
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('content', 'Content', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            $this->form_validation->set_rules('permalink', 'Permalink', 'trim|required|is_unique[dashboards.permalink]');

        }
        if ($action == 'edit'){
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('content', 'Content', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            
        }
        if ($this->form_validation->run() == FALSE) {
            return FALSE ;
        } else {
            return TRUE;
        }
    }


}