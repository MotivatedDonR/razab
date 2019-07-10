<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url().'uploads/users_pictures/'.$this->session->userdata('logged_in')->image;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('logged_in')->full_name;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->

      <?php 
        $user_details=$this->session->userdata('logged_in');
        $user_role=$user_details->user_role;

        $controller = $this->uri->segment(1);
        $action = $this->uri->segment(2);
        
      ?>
      <ul class="sidebar-menu" data-widget="tree">        
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <?php if($user_role==1) {?>
        <li class="treeview <?php if($controller == 'users') echo 'active'; ?>">
          <a href="#">
              <i class="fa fa-gears"></i> <span>Users </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo base_url('users/index')?>"><i class="fa fa-list-ul"></i> All Users</a></li>
              <li><a href="<?php echo base_url('users/add')?>"><i class="fa fa-plus"></i> Add New</a></li>
          </ul>
        </li>
        <?php  } ?>
        <?php if($user_role==1) {?>
        <li class="treeview <?php if($controller == 'usertypes') echo 'active'; ?>">
          <a href="#">
              <i class="fa fa-gears"></i> <span>Department</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo base_url('usertypes/index')?>"><i class="fa fa-list-ul"></i> All Departments</a></li>
              <li><a href="<?php echo base_url('usertypes/add')?>"><i class="fa fa-plus"></i> Add New</a></li>
          </ul>
        </li>      
        <?php  } ?>
        <?php if($user_role==1) {?>
        <li class="treeview <?php if($controller == 'packages') echo 'active'; ?>">
          <a href="#">
              <i class="fa fa-gears"></i> <span>Packages</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo base_url('packages/index')?>"><i class="fa fa-list-ul"></i> All Packages</a></li>
              <li><a href="<?php echo base_url('packages/add')?>"><i class="fa fa-plus"></i> Add New</a></li>
          </ul>
        </li>      
        <?php  } ?>
        <li class="treeview">
          <a href="#">
              <i class="fa fa-gears"></i> <span>Sales Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo base_url('visitors/index')?>"><i class="fa fa-list-ul"></i> All Customers</a></li>
              <li><a href="<?php echo base_url('customers/add')?>"><i class="fa fa-plus"></i> Add Contact Person </a></li>
          </ul>
        </li>      
        <li class="treeview">
          <a href="#">
              <i class="fa fa-gears"></i> <span>Visa Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo base_url('visas/index')?>"><i class="fa fa-list-ul"></i> All customer</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
              <i class="fa fa-gears"></i> <span>Flight Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo base_url('flights/index')?>"><i class="fa fa-list-ul"></i> All customer</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
              <i class="fa fa-gears"></i> <span>Hotel Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo base_url('rooms/index')?>"><i class="fa fa-list-ul"></i> All customer</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
              <i class="fa fa-gears"></i> <span>Account Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo base_url('accounts/index')?>"><i class="fa fa-list-ul"></i> All customer</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>