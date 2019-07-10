<div class="login-box-body">
    
<?php 
$attr = array('id' => 'register_form' );
echo form_open_multipart(current_url()); ?>
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
                            <input type="text" name="phone" value="<?php echo $this->input->post('phone'); ?>" class="form-control" id="phone" />
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
                    <div class="col-md-6">
                        <div class="g-recaptcha" data-sitekey="6Lf11ZAUAAAAAJ1-lplNNSVmkyRlMwKaNp2A1jnZ"></div>
                        <span class="text-danger"><?php echo form_error('g-recaptcha-response');?></span>
                    </div>
                    
                    
                    
                    
                </div>
                
                
                
                    
                    
                <!-- <div class="row clearfix">
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
                </div> -->
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success">
                     Register
                </button>
                <a href="<?php echo base_url();?>users/auth" class="btn btn-warning pull-right" >Login</a>
            </div>
            <?php echo form_close(); ?>
             


</div>
 <style>
.login-box{width: 600px}
</style>

<script type="text/javascript">
$(document).ready(function() {
    $("#phone").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});

</script>


<style type="text/css">
    .g-recaptcha {
    transform: scale(0.7);
    -moz-transform: scale(0.7);
    -webkit-transform: scale(0.7);
}
</style>