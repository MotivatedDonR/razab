<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	private $db_config = NULL;

	function __construct(){
		parent::__construct();
         $this->load->model('categories/category');
		$query = $this->db->get('site_config')->result();
		$this->db_config = new stdClass();
		foreach ($query as $conf) {
			$key = $conf->config_name;
			$this->db_config->$key = $conf->value;
		}

	}



	public function index()
	{
		$query = $this->db->get_where('countings');
		$result=$query->row();
		$non_login_visite=$result->non_login_visite;
		$login_visite=$result->login_visite;	
		
		if ($this->session->userdata('logged_in')){
			
            $login_visite++;
			
        }else{
			
			$non_login_visite++;
		}
				
		$params = array(
                'non_login_visite' => $non_login_visite, 
				'login_visite' => $login_visite
            );
		$params['modified'] = date('Y-m-d H:i:s');
        $this->db->update('countings',$params);
		
		
		$this->output->set_template('default');
		$this->output->set_title($this->db_config->site_title);
		
		
		$query = $this->db->get_where('pages',array('status' => 1));
		$data['pages'] = $query->result();
		if($this->db_config->display_site_logo){
			$data['title'] = '<img src="'.base_url('uploads/images/').$this->db_config->site_logo.'" class="img-responsive" height="60px" width="80px"/>';
		}else{
			$data['title'] = $this->db_config->site_title;
		}
		
		$data['category_names'] = $this->category->get_category_names();
		$data['balloon']=$this->db_config->show_balloon;
		$data['seller_requestor_all']=$this->db_config->seller_requestor_all;
		$data['hide_ad_price']=$this->db_config->hide_ad_price;
		$data['weblink_1_text']=$this->db_config->weblink_1_text;
		$data['weblink_2_text']=$this->db_config->weblink_2_text;
		$data['weblink_3_text']=$this->db_config->weblink_3_text;
		$data['advertiser_name_label']=$this->db_config->advertiser_name_label;
		$data['advertiser_description_label']=$this->db_config->advertiser_description_label;
		$data['site_description']=$this->db_config->site_description;
		$data['site_description_color']=$this->db_config->site_description_color;

		$data['site_filter_option1_label']=$this->db_config->site_filter_option1_label;
		$data['site_filter_option2_label']=$this->db_config->site_filter_option2_label;
		$data['site_filter_option_no_filter_label']=$this->db_config->site_filter_option_no_filter_label;
		
		$this->load->view('welcome/home',$data);
	}
	// function get_autocomplete(){
 //        if (isset($_GET['term'])) {
 //            $result = $this->blog_model->search_blog($_GET['term']);
 //            if (count($result) > 0) {
 //            foreach ($result as $row)
 //                $arr_result[] = $row->printable_name;
 //                echo json_encode($arr_result);
 //            }
 //        }
 //    }
	function get_birds(){
   // $this->load->model('birds_model');
    if (isset($_GET['term'])){
      $q = strtolower($_GET['term']);
      $this->db->select('tags');
    $this->db->like('tags', $q);
    $query = $this->db->get('ads');
    if($query->num_rows() > 0){
      foreach ($query->result_array() as $row){
        $row_set[] = htmlentities(stripslashes($row['tags'])); //build an array
      }
      echo json_encode($row_set); //format the array into json data
    }
     // $this->birds_model->get_bird($q);
    }
  }
 public function lookup() {
 	//$this->load->library('products');
    $kode = $this->input->get('term'); 

    $this->db->like('name', $kode); 
    $query = $this->db->get("products");
    $kota       =  array();

    foreach ($query->result() as $d) {
        $kota[]     = array(
            'label' => $d->name,
        );
    }
    echo json_encode($kota);   
}

	public function getJsonData(){

		$category = $this->input->get("category");
		$this->db->select('users.id as id,users.certificate_expiry as certificate_expiry,users.first_name,users.last_name,users.email,users.phone,users.address,users.lat,users.lng,docs.verified as verified');
		$this->db->where('users.user_role',2);
		$this->db->where('users.status',1);
		$this->db->where('users.lat != ""');
		$this->db->where('users.lng != ""');
		if($category){
			$this->db->where('users.category_id',$category);
		}
		$this->db->from('users');
		$this->db->join('(SELECT user_id,count(*) as verified FROM documents GROUP BY user_id) docs', 'users.id=docs.user_id','left');
		$query = $this->db->get();
		$result = $query->result();

		$final_array_toshow = array();
		foreach ($result as $row) {
			$row->show_on_map = true;

			$this->db->reset_query();
			$this->db->where('user_id',$row->id);
			$doc_query = $this->db->get('documents');
			$row->docs = $doc_query->result();

			if($row->certificate_expiry < date('Y-m-d')){
				$row->docs = array();
				$row->verified = 0;
			}

			if(!$this->db_config->show_expired_entries && !$row->verified){
				$row->show_on_map = false;
			}


			if($row->show_on_map){
				$final_array_toshow[] = $row;
			}
			
			
		}
		echo json_encode($final_array_toshow);
	}



	public function getFlyersByUserId(){
		$user_id = $this->input->get('user_id');

		$query = $this->db->get_where('flyers',array('user_id' => $user_id));

		foreach ($query->result() as $row) {
			echo '<div class="media">
				  <div class="media-left media-middle">
				    <a href="javascript:getFlyerGallery('.$row->id.');">
				      <img class="media-object" height="100" width="100" src="'.base_url("uploads/flyers/").$row->image.'" alt="">
				    </a>
				  </div>
				  <div class="media-body" style="margin-left: 20px;">
				    <h4 class="media-heading">Expiry Date</h4>
				    '.date("Y-m-d",strtotime($row->expiry)).'
				  </div>
				</div><br/>';
		}
		
	}


	public function getStoresJson(){
		$category = $this->input->get("category");
		$selected = $this->input->get("selected");
		$search_product = $this->input->get("search_product");		
		/*
		echo $category;
		echo"<br>";
		echo $selected;
		die;
		*/
		$this->db->select('ads.*,ad_gallery.*,users.first_name,users.last_name,users.certificate_expiry,users.phone,users.image');
		$this->db->from('ads');
		$this->db->join('ad_gallery','ad_gallery.ad_id=ads.id');
		$this->db->join('users','ads.user_id=users.id');
		$this->db->where('ads.status',1);
		
		/*$this->db->select('s.*,u.first_name as first_name,u.last_name as last_name,u.phone as phone,u.image as user_logo,u.certificate_expiry as certificate_expiry,u.email as email,docs.verified as verified');
		$this->db->from('stores as s');
		$this->db->join('users as u','u.id=s.user_id');
		//$this->db->join('ads','ads.user_id=u.id');
		//$this->db->join('(SELECT user_id,count(*) as verified FROM documents GROUP BY user_id) docs', 'u.id=docs.user_id','left');
		$this->db->where('s.status',1);
		$this->db->where('u.status',1);
		$this->db->where('u.user_role != 1');*/
		if($category){
			$this->db->where('ads.category_id',$category);
		}
		if($selected){
			$this->db->where('ads.choose',$selected);
		}
		if($search_product){
			 $this->db->where('ads.adtitle LIKE', "%".$search_product."%");
		}

		$query = $this->db->get();
		$result = $query->result();
		// echo"<br>";
		// print_r($result);
		// die;
		
		/*print_r($this->db_config->show_balloon);
		die;*/

		$final_array_toshow = array();
		foreach ($result as $row) {
			$row->show_on_map = true;
			$row->hide_ad_price=$this->db_config->hide_ad_price;
			$row->weblink_1_text=$this->db_config->weblink_1_text;
			$row->weblink_2_text=$this->db_config->weblink_2_text;
			$row->weblink_3_text=$this->db_config->weblink_3_text;

			$row->show_hide_weblink_1=$this->db_config->show_hide_weblink_1;
			$row->show_hide_weblink_2=$this->db_config->show_hide_weblink_2;
			$row->show_hide_weblink_3=$this->db_config->show_hide_weblink_3;

			$this->db->reset_query();
			$this->db->where('user_id',$row->user_id);
			$doc_query = $this->db->get('documents');
			$row->docs = $doc_query->result();

			// echo"<br>";
			// print_r($row->show_hide_weblink_1);
			// die;
			$row->verified = count($row->docs);

			if($row->certificate_expiry < date('Y-m-d')){
				$row->docs = array();
				$row->verified = 0;
			}

			

			// if(!$this->db_config->show_expired_entries && !$row->verified){
			// 	$row->show_on_map = false;
			// }


			//Flyers
			$this->db->reset_query();
			$this->db->select('MAX(expiry) as flyer_expiry');
			$this->db->where('user_id',$row->user_id);
			$this->db->where("DATE(expiry) >= '".date('Y-m-d')."'");
			$flyer_query = $this->db->get('flyers');
			$row->flyer_expiry = $flyer_query->row()->flyer_expiry;


			if($row->show_on_map){
				$final_array_toshow[] = $row;
			}
			
			
		}

		// echo'<pre>';
		// print_r($final_array_toshow);
		// die;
		echo json_encode($final_array_toshow);
	}




	function getFlyerGallery($flyer_id){
		$this->db->where('id',$flyer_id);
		$query = $this->db->get('flyers');	
		$gallery = $query->row();
		$data['gallery'] = explode("#",$gallery->image);
		$this->load->view('welcome/flyers-gallery',$data);
	}

	public function page($slug){
		$this->output->unset_template();
		$this->output->set_template('pages');
		

		$query = $this->db->get_where('pages',array('status' => 1));
		$data['pages'] = $query->result();
		
		$query2 = $this->db->get_where('pages',array('status' => 1, 'permalink' => $slug));
		if($query2->row()){
			$data['page'] = $query2->row();
			$this->output->set_title($data['page']->title.' - '.$this->db_config->site_title);

			$this->output->section('header','pages/header',$data);
			$this->output->section('footer','pages/footer',$data);
			$this->load->view('pages/page_view',$data);
		}else{
			show_404();
		}
		
		
	}


	public function sendmail(){
		$this->load->model('messages/message');
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$message = $this->input->post('message');
		$user_id = $this->input->post('user_id');
		$store_id = $this->input->post('store_id');

		// $query = $this->db->get_where('users',array('id' => $user_id));
		// $to_email = $query->row()->email;

		// $this->load->library('email');

		// $this->email->from($email, $name);
		// $this->email->to($to_email);

		// $this->email->subject('Message From '.$name);
		// $this->email->message($message);

		$data = array(
			'to_id'=>$user_id,
			'form_email' => $email,
			'message' => $message,
			'from_name' => $name,
			'store_id' => $store_id,
			'from_id'=>0,
			'timestamp' => date('Y-m-d H:i:s')
		);
		
		

		$query = $this->db->insert('messages',$data);
		$this->message->sendMail($user_id,$message,$name,$email);


		if($query){
			echo '1';
		}else{
			echo "0";
		}

	}


    public function reportsAd(){

        $message = $this->input->post('message');
        $ads_id = $this->input->post('ads_id');

        $data = array(
            'ad_message' => $message,
            'ads_id' => $ads_id
        );

        $query = $this->db->insert('report_ads',$data);


        if($query){
            echo '1';
        }else{
            echo "0";
        }

    }




}
