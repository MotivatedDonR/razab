<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New User
        <small>Fill up the form bellow</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">User Add</h3>
            </div>
            <?php echo form_open_multipart(current_url()); ?>
            <div class="box-body">
                <div class="row clearfix">

                    <div class="col-md-6">
                        <label for="first_name" class="control-label"><span class="text-danger">*</span>First Name</label>
                        <div class="form-group">
                            <input type="text" name="first_name" value="<?php echo $this->input->post('first_name'); ?>" class="form-control" id="first_name" />
                            <span class="text-danger"><?php echo form_error('first_name');?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="last_name" class="control-label"><span class="text-danger">*</span>Last Name</label>
                        <div class="form-group">
                            <input type="text" name="last_name" value="<?php echo $this->input->post('last_name'); ?>" class="form-control" id="last_name" />
                            <span class="text-danger"><?php echo form_error('last_name');?></span>
                        </div>
                    </div> 

                    
                </div>
                <div class="row clearfix">     

                    <div class="col-md-6">
                        <label for="email" class="control-label"><span class="text-danger">*</span>Email</label>
                        <div class="form-group">
                            <input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" class="form-control" id="email" />
                            <span class="text-danger"><?php echo form_error('email');?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="control-label"><span class="text-danger">*</span>Phone</label>
                        <div class="form-group">
                            <input type="number" name="phone" value="<?php echo $this->input->post('phone'); ?>" class="form-control" id="phone" />
                            <span class="text-danger"><?php echo form_error('phone');?></span>
                        </div>
                    </div>
                    
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="password" class="control-label"><span class="text-danger">*</span>Password</label>
                        <div class="form-group">
                            <input type="password" name="password" value="<?php echo $this->input->post('password'); ?>" class="form-control" id="password" />
                            <span class="text-danger"><?php echo form_error('password');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="cpassword" class="control-label"><span class="text-danger">*</span> Confirm Password</label>
                        <div class="form-group">
                            <input type="password" name="cpassword" value="<?php echo $this->input->post('cpassword'); ?>" class="form-control" id="cpassword" />
                            <span class="text-danger"><?php echo form_error('cpassword');?></span>
                        </div>
                    </div>
                    
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="user_role" class="control-label">User Role</label>
                        <div class="form-group">
                            <select class="form-control" id="user_role" name="user_role" >
                                <?php
                                foreach ($user_roles as $user_role) { ?>
                                    <option value=" <?php echo $user_role->id; ?>"> <?php echo $user_role->role_name; ?></option>;
                                <?php }
                                ?>
                            </select>
                                <span class="text-danger"><?php echo form_error('user_role');?></span>                        
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="category_id" class="control-label"><span class="text-danger">*</span>Choose Category</label>
                        <div class="form-group">
                          <select class="form-control" id="category_id" name="category_id" >
                           <?php
                                foreach ($category_names as $category_name) { ?>
                                    <option value=" <?php echo $category_name->id; ?>"> <?php echo $category_name->name; ?></option>;
                                <?php }
                                ?>
							</select>
                                <span class="text-danger"><?php echo form_error('category_id');?></span>                        
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Save
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>


<script>
  //iCheck for checkbox and radio inputs
   $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({ checkboxClass: 'icheckbox_minimal-blue', radioClass : 'iradio_minimal-blue' })
  </script>