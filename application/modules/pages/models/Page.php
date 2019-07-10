<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Model {
    private $table = 'pages';
    public function __construct() {
        parent::__construct();

    }

    public function get_pages(){
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_page($id){
        $condition['id'] = $id;
        $query = $this->db->get_where($this->table,$condition);
        $result = $query->row();
        if ($result){
            return $result;
        }
        return false;
    }

    /**
     * @param $params
     * Add page
     */
    public function add_page($params){
        $params = array_filter($params,'strlen');
        $this->db->insert($this->table,$params);
    }

    /**
     * @param $id
     * @param $params
     * @return mixed
     * Update page
     */

    public function update_page($id,$params){
        $params = array_filter($params,'strlen');
        $params['modified'] = date('Y-m-d H:i:s');
        $this->db->where('id',$id);
        return $this->db->update($this->table,$params);
    }

    /**
     * @param $id
     * @return mixed
     * Delete page
     */
    public function delete_page($id){
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
            $this->form_validation->set_rules('permalink', 'Permalink', 'trim|required|is_unique[pages.permalink]');

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