<?php
/**
 * Created by PhpStorm.
 * User: sunil
 * Date: 02-02-2018
 * Time: 05:55 PM
 */
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Profile
        </h1>
        
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <div class="img_container">
                            <img id="pro_image" class="profile-user-img img-responsive img-circle" src="<?php echo base_url().'uploads/users_pictures/'.$user->image;?>" alt="User profile picture">
                            <div id="" class="middle">
                                    <?php echo form_open_multipart('users/image_upload',array('id'=>'up_form'));?>
                                    <input type="file" id="inp_image" name="image" style="display: none;">
                                    <?php echo form_close();?>
                                    <!-- <button type="button" id="img_btn" class="btn btn-xs btn-default">Change</button> -->
                            </div>
                        </div>
                        <h3 class="profile-username text-center"><?php echo $user->first_name.' '.$user->last_name;?></h3>

                        <p class="text-muted text-center"><strong><?php echo $user->type;?></strong></p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Last Login</b> <a class="pull-right"><?php echo date('d M Y  h:i A',strtotime($user->last_login_time));?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Last IP: </b> <a class="pull-right"><?php echo $user->last_login_ip;?></strong></a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="pull-right">13,287</a>
                            </li>
                        </ul>

                        <a href="<?php echo base_url().'users/profile_edit';?>" class="btn btn-primary btn-block"><b>Edit</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
         

                        <div class="box-body" id="settings">
                            <?php $attributes = array('class' => 'form-horizontal'); echo form_open_multipart(current_url(),$attributes); ?>
                                <div class="form-group">
                                    <label for="first_name" class="col-sm-2 control-label">First Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="first_name" class="form-control" value="<?php echo$user->first_name; ?>" id="inputName" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="last_name" class="col-sm-2 control-label">last Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="last_name" class="form-control" value="<?php echo$user->last_name; ?>" id="inputName" placeholder="last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" value="<?php echo$user->email; ?>" id="inputEmail" placeholder="Email">
                                        <input type="hidden" name="old_email" value="<?php echo$user->email; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="col-sm-2 control-label">Phone</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="phone" class="form-control" value="<?php echo$user->phone; ?>" id="inputName" placeholder="last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_role" class="control-label col-sm-2">User Role</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" style="width: 100%;" name="user_role">
                                            <?php 
                                                $userrole=$user->user_role;
                                                foreach ($user_roles as  $role) {
                                                    if($userrole==$role->id){
                                                        echo '<option value="'.$role->id.'" selected>'.$role->role_name.'</option>';  
                                                    }else{
                                                        echo '<option value="'.$role->id.'">'.$role->role_name.'</option>';
                                                    }
                                                } 
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('user_role');?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-sm-2 control-label">Address</label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" id="inputExperience" ><?php echo$user->address; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-danger" >
                                    </div>
                                </div>
                            <?php echo form_close(); ?>
                            
                        </div>
                        <!-- /.tab-pane -->
                    
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>




<script type="text/javascript">
    $(document).ready(function () {
        $('#pro_image').click(function () {
            return false;
        });


        $('#img_btn').click(function () {
            $('#inp_image').click();
        });

        $('#inp_image').change(function() {
            // select the form and submit
            $('#up_form').submit();
        });
    });
</script>


<style type="text/css">


    .profile-user-img {
        opacity: 1;
        display: block;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
    }

    .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 22%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }

    .img_container:hover .profile-user-img {
        opacity: 0.3;
    }

    .img_container:hover .middle {
        opacity: 1;
    }
</style>