<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url().'uploads/profile_pictures/'.$this->session->userdata('logged_in')->image;?>"
          class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>
          <?php echo $this->session->userdata('logged_in')->first_name.' '.$this->session->userdata('logged_in')->last_name;?>
        </p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="bg-green"><a style="background-color: rgb(0, 166, 90);" href="<?php echo base_url();?>" target="_blank"><i
            class="fa fa-external-link"></i> <span style="color: rgb(255, 255, 255);">Visit Site</span></a></li>
    </ul>
    <?php 
        $user_details=$this->session->userdata('logged_in');
        $user_role=$user_details->user_role;

        $controller = $this->uri->segment(1);
        $action = $this->uri->segment(2);

        
      ?>
    <?php 
          if($user_role == 1){
        ?>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="treeview <?php if($controller=='dashboards') echo 'active';?>">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url('dashboards/index')?>"><i class="fa fa-list-ul"></i>Dashboard</a></li>
        </ul>
      </li>

      <li class="treeview <?php if($controller=='users' && $action =='administrator_listing') echo 'active';?>">
        <a href="#">
          <i class="fa fa-users"></i> <span>Administrators </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url('users/administrator_listing')?>"><i class="fa fa-list-ul"></i> All
              Administrators</a></li>
          <li><a href="<?php echo base_url('users/add')?>"><i class="fa fa-plus"></i> Add New</a></li>
           
        </ul>
      </li>
      <li class="treeview <?php if($controller=='users' && $action =='index') echo 'active';?>">
        <a href="#">
          <i class="fa fa-users"></i> <span>Clients & Ads </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url('users/index')?>"><i class="fa fa-list-ul"></i> All Clients</a></li>
          <li><a href="<?php echo base_url('users/add')?>"><i class="fa fa-plus"></i> Add New</a></li>
        </ul>
      </li>

      <li class="treeview <?php if($controller=='messages') echo 'active';?>">
        <a href="#">
          <i class="fa fa-envelope-o"></i> <span>Messages </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url('messages')?>"><i class="fa fa-list-ul"></i> All Messages</a></li>

        </ul>
      </li>

      <li class="treeview <?php if($controller=='ads' ) echo 'active';?>">
        <a href="#">
          <i class="fa fa-database"></i> <span> My Ads </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url('ads/index')?>"><i class="fa fa-list-ul"></i> All Ads</a></li>
          <li><a href="<?php echo base_url('ads/add')?>"><i class="fa fa-plus"></i> Add New</a></li>
        </ul>
      </li>


      <li class="treeview <?php if($controller=='categories' ) echo 'active';?>">
        <a href="#">
          <i class="fa fa-database"></i> <span>Categories </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url('categories/index')?>"><i class="fa fa-list-ul"></i> All Categories</a></li>
          <li><a href="<?php echo base_url('categories/add')?>"><i class="fa fa-plus"></i> Add New</a></li>
        </ul>
      </li>


    </ul>


    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">SITE CONFIGURATIONS</li>

      <li class="treeview <?php if($controller=='pages') echo 'active';?>">
        <a href="#">
          <i class="fa fa-file"></i> <span>CMS PAGES </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url('pages/index')?>"><i class="fa fa-list-ul"></i> All Pages</a></li>
          <li><a href="<?php echo base_url('pages/add')?>"><i class="fa fa-plus"></i> Add New</a></li>
        </ul>
      </li>
      <li class="<?php if($controller=='configurations') echo 'active';?>"><a href="<?php echo base_url('configurations/index')?>"><i
            class="fa fa-gear"></i> <span>Configurations</span></a></li>

    </ul>

    <?php 
        }else{
          ?>

    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li> -->

      <li class="treeview <?php if($controller=='ads') echo 'active';?>">
        <a href="#">
          <i class="fa fa-database"></i> <span>Ads </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url('ads/index')?>"><i class="fa fa-list-ul"></i> All Ads</a></li>
          <li><a href="<?php echo base_url('ads/add')?>"><i class="fa fa-plus"></i> Add New</a></li>
        </ul>
      </li>
      <li class="treeview <?php if($controller=='messages') echo 'active';?>">
        <a href="#">
          <i class="fa fa-envelope-o"></i> <span>Messages </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url('messages')?>"><i class="fa fa-list-ul"></i> All Messages</a></li>

        </ul>
      </li>
      <li class="<?php if($controller=='users' && $action=='profile') echo 'active';?>"><a href="<?php echo base_url('users/profile');?>"><i
            class="fa fa-user"></i> <span>Profile</span></a></li>
    </ul>

    <?php
        }
        ?>
  </section>
  <!-- /.sidebar -->
</aside>