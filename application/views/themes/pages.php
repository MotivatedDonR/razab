<?php 
	$query = $this->db->get('site_config')->result();
	$db_config = new stdClass();
	foreach ($query as $conf) {
		$key = $conf->config_name;
		$db_config->$key = $conf->value;
	}

  if($db_config->display_site_logo){
    $data['title'] = '<img src="'.base_url('uploads/images/').$db_config->site_logo.'" class="img-responsive" height="40px" width="160px"/>';
  }else{
    $data['title'] = $db_config->site_title;
  }
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title;?></title>
	
	  <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url();?>assets/themes/pages/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/pages/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/themes/pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?php echo base_url();?>assets/themes/pages/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/themes/pages/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/themes/pages/css/landing-page.min.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-light bg-light static-top">
      <div class="container">
        <a class="navbar-brand" href="<?php echo base_url();?>"><?php echo $data['title'];?></a>
        <a class="btn btn-primary" href="<?php echo base_url('users/auth');?>">Sign In</a>
      </div>
    </nav>

    <!-- Masthead -->
    <?php echo $this->output->get_section('header');?>
    

    <section class="testimonials bg-light">
      <div class="container">
        <div class="row">
          	<?php echo $output;?>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 h-100 text-center my-auto">
            <?php echo $this->output->get_section('footer');?>
            <p class="text-muted small mb-4 mb-lg-0">&copy; <?php echo $db_config->site_title;?>. All Rights Reserved.</p>
          </div>
        </div>
      </div>
    </footer>

   
    

  

  </body>

</html>
