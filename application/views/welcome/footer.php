<?php 

    $query = $this->db->get('site_config')->result();
    $db_config = new stdClass();
    foreach ($query as $conf) {
      $key = $conf->config_name;
      $db_config->$key = $conf->value;
    }
?>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong><?php echo $db_config->footer_credit;?></strong> All rights
    reserved.
  </footer>

  <style type="text/css">
  	#search{
  		min-width: 200px;
  	}
  </style>