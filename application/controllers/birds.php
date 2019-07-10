<?Php
//birds.php
class Birds extends CI_Controller{
  function index(){
   // $this->load->view('birds_view');
  }
 
  function get_birds(){
    $this->load->model('birds_model');
    if (isset($_GET['term'])){
      $q = strtolower($_GET['term']);
      $this->birds_model->get_bird($q);
    }
  }
}
?>