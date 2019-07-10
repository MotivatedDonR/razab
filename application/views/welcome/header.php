<?php 

    $query = $this->db->get('site_config')->result();
    $db_config = new stdClass();
    foreach ($query as $conf) {
      $key = $conf->config_name;
      $db_config->$key = $conf->value;
    }
?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>dashboards" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>T</b>C</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo $db_config->site_title;?></b></span>
    </a>
    
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"  >
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown messages-menu open">
            <a href="<?php echo base_url('messages');?>" aria-expanded="true">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success" id="total_message_count"></span>
            </a>
            
          </li>
          
          <!-- Notifications: style can be found in dropdown.less -->
          <?php if($this->session->userdata('logged_in')->user_role == 1){?>
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning notification_count">0</span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="notifications">
                  
                </ul>
              </li>
              <li class="footer"><a href="javascript:mark_read();">Mark all as read</a></li>
            </ul>
          </li>
          <?php } ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url().'uploads/profile_pictures/'.$this->session->userdata('logged_in')->image;?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('logged_in')->first_name;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url().'uploads/profile_pictures/'.$this->session->userdata('logged_in')->image;?>" class="img-circle" alt="User Image">

                <p>
                    <?php echo $this->session->userdata('logged_in')->first_name.$this->session->userdata('logged_in')->last_name;?> - <?php echo $this->session->userdata('logged_in')->type;?>
                    <h5><span class="label label-danger"><i class="fa fa-calendar"></i>  Last Login : <?php echo date('d M Y  h:i A',strtotime($this->session->userdata('logged_in')->last_login_time));?></span></h5>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url('users/profile');?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url();?>users/auth/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>


<?php if($this->session->userdata('logged_in')->user_role == 1){?>
<script>
  var masterNotifications = null;


  function mark_read(){
      var notificationArr = [];
      masterNotifications.forEach(function(elem){
        notificationArr.push(elem.id);
      });

      $.post('<?php echo base_url(); ?>users/mark_read_notifications',{ids: notificationArr})
      .done(function(data){
        get_notifications();
      })
  }

  function get_notifications(){
    $.ajax({ 
        url:"<?php echo base_url(); ?>users/get_admin_notifications",
        type:"GET",
        success:function(data){
         //do action
          var response = JSON.parse(data);
          masterNotifications = response;
          var count = response.length;
          var notifications = '';
          response.forEach(function(elem){
            notifications += '<li><a href="<?php echo base_url();?>users/uploads/'+elem.uploader_id+'" title="'+elem.first_name+' '+elem.title+'"><i class="fa fa-file-photo-o text-yellow"></i>'+elem.first_name+' '+elem.title+'</a></li>';
          });

          $('#notifications').html(notifications);
          $('.notification_count').html(count);
        }
      });
  }

$(document).ready(function(){
    get_notifications();
   
    setInterval(function() {
      get_notifications();

        
    }, 10000);

  });

//   function myFunction() {
//     myVar = setInterval(alertFunc, 3000);
// }

  </script>
<?php }?>

<script type="text/javascript">
  function get_total_message_count(){
    $.get('<?php echo base_url('messages/get_messages_count');?>')
    .done(function(data){
        $('#total_message_count').html(data);
    });
  }




  $(document).ready(function(){
    get_total_message_count();
   
    setInterval(function() {
      get_total_message_count();

        
    }, 10000);

  });
</script>

  <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<style>

.tooltip-inner {
   
    /* If max-width does not work, try using width instead */
    min-width: 200px; 
}

</style>