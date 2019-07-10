<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>T</b>C</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>UNTITLED</b></span>
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
          
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu open">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning notification_count">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <span class="notification_count">0</span> notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="notifications">
                  
                </ul>
              </li>
              
            </ul>
          </li>
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url().'uploads/users_pictures/'.$this->session->userdata('logged_in')->image;?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('logged_in')->first_name;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url().'uploads/users_pictures/'.$this->session->userdata('logged_in')->image;?>" class="img-circle" alt="User Image">

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


<script>

$(document).ready(function(){
  
  $.ajax({ 
    url:"<?php echo base_url(); ?>users/get_admin_notifications",
    type:"GET",
    success:function(data){
     //do action
      var response = JSON.parse(data);
      var count = response.length;
      var notifications = '';
      response.forEach(function(elem){
        notifications += '<li><a href="#"><i class="fa fa-warning text-yellow"></i>'+elem.title+'</a></li>';
      });

      $('#notifications').html(notifications);
      $('.notification_count').html(count);
    }
  });

  });

//   function myFunction() {
//     myVar = setInterval(alertFunc, 3000);
// }

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