<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

//birds_model.php (Array of Strings)
class Birds_model extends CI_Model{
  function get_bird($q){
    $this->db->select('name');
    $this->db->like('name', $q);
    $query = $this->db->get('products');
    if($query->num_rows() > 0){
      foreach ($query->result_array() as $row){
        $row_set[] = htmlentities(stripslashes($row['name'])); //build an array
      }
      echo json_encode($row_set); //format the array into json data
    }
  }
}
?>