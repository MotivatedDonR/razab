  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Site Configuration
        <small>Update website configurations</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Configurations</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Change Settings Carefully</h3>
            </div>
            <?php echo form_open_multipart(current_url()); ?>
            <div class="box-body">
                <div class="row clearfix">

                    <?php 
                        foreach ($configurations as $configuration) {

                        if($configuration->input_type == 'text'){
                    ?>
                    <div class="col-md-6">
                        <label for="<?php echo $configuration->config_name;?>" class="control-label"><span class="text-danger">*</span><?php echo $configuration->display_name;?></label>
                        <div class="form-group">
                            <input type="text" name="<?php echo $configuration->config_name;?>" value="<?php echo $configuration->value;?>" class="form-control" id="<?php echo $configuration->config_name;?>" required />
                        </div>
                    </div>
                    <?php 
                		}
                        else if($configuration->input_type == 'color'){
                    ?>
                    <div class="col-md-6">
                        <label for="<?php echo $configuration->config_name;?>" class="control-label"><span class="text-danger">*</span><?php echo $configuration->display_name;?></label>
                        <div class="form-group">
                            <input type="color" name="<?php echo $configuration->config_name;?>" value="<?php echo $configuration->value;?>" class="form-control" id="<?php echo $configuration->config_name;?>" required />
                        </div>
                    </div>
                    <?php 
                        }
                		else if($configuration->input_type == 'radio'){
                	?>
                	<div class="col-md-3">
                        <label for="<?php echo $configuration->config_name;?>" class="control-label"><span class="text-danger">*</span><?php echo $configuration->display_name;?></label>
                        <div class="form-group">
                        <input type="radio" name="<?php echo $configuration->config_name;?>" class="minimal" value="1" id="<?php echo $configuration->config_name;?>" <?php if($configuration->value=='1')echo "checked";?>>Yes
                        <input type="radio" name="<?php echo $configuration->config_name;?>" class="minimal" value="0" id="<?php echo $configuration->config_name;?>"<?php if($configuration->value=='0')echo "checked";?>>No
                            
                            <span class="text-danger"><?php echo form_error('status');?></span>
                        </div>
                    </div>



                	<?php 
                		}
                		else if($configuration->input_type == 'image'){

                	?>
                		<div class="col-md-3">
	                        <label for="<?php echo $configuration->config_name;?>" class="control-label"><span class="text-danger">*</span><?php echo $configuration->display_name;?></label>
	                        <div class="form-group">
	                            <input type="file" name="<?php echo $configuration->config_name;?>" class="form-control" id="<?php echo $configuration->config_name;?>" />
	                        </div>
	                    </div>
	                    <div class="col-md-3">
	                    	<img class="img-responsive" style="max-width: 100%; max-height: 60px; padding-top: 28px;" src="<?php echo base_url('uploads/images/').$configuration->value;?>">
	                    </div>
                	<?php
                		}
                      }
                    ?>

                    
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Update Configuration
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
