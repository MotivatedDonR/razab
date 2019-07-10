<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Singup extends CI_Model {
	 

	 public function foo(){

	 	echo "haha";
      // private $table = 'singup';
         //$query = $this->db->get('singup');
           //  return $query;  
         //return $query->result();
    }
     public function updatebtn(){  
			
       // $query = $this->db
        //->select('value')
        //->from('singup')->get();
        //  $query = "SELECT * FROM `singup`";
          $data = $this->db->query($query);
         $x  =  $data->result_array();
            // print_r($x);
             $y =  $x[0]['value'];
           //echo $y ;
        if($y==0){
            $this->db->set('value','1',false);
            $this->db->where('id','1');
            $this->db->update('singup');

        }else{
             $this->db->set('value','0',false);
            $this->db->where('id','1');
            $this->db->update('singup');
        }


    //       $data['value']=$this->select->select();
    // $this->db->like('name', $kode); 
    // $query = $this->db->get("products");
    //     $this->load->model('Page');
    //     $this->Page->update_btn();


    }
   
}