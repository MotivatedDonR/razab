<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New message
        <small>Fill up the form bellow</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">messages</a></li>
        <li class="active">Add</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">message Add</h3>
            </div>
            <?php echo form_open(current_url()); ?>
            <div class="box-body">
                <div class="row clearfix">

                    <div class="col-md-6">
                        <label for="form_id" class="control-label"><span class="text-danger">*</span>From</label>
                        <div class="form-group">
                            <input type="text" name="form_id" value="<?php echo $this->input->post('form_id'); ?>" class="form-control" id="form_id" />
                            <span class="text-danger"><?php echo form_error('form_id');?></span>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <label for="to_id" class="control-label"><span class="text-danger">*</span>To</label>
                        <div class="form-group">
                            <input type="text" name="to_id" value="<?php echo $this->input->post('to_id'); ?>" class="form-control"   id="to_id" />
                            <span class="text-danger"><?php echo form_error('to_id');?></span>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="message" class="control-label"><span class="text-danger">*</span>Message</label>
                        <div class="form-group">
                            <textarea rows="5" name="message"  class="form-control" id="message" /></textarea>
                            <span class="text-danger"><?php echo form_error('message');?></span>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="form_email" class="control-label"><span class="text-danger">*</span>Email</label>
                        <div class="form-group">
                            <input type="email" name="form_email" value="<?php echo $this->input->post('form_email'); ?>" class="form-control" id="form_email" />
                            <span class="text-danger"><?php echo form_error('form_email');?></span>
                        </div>
                    </div>
                   
                    
                               
                   
                  
                     <div class="col-md-3">
                        <label for="status" class="control-label">Status</label>
                        <div class="form-group">
                        <input type="radio" name="status" class="minimal" value="1" id="status">Active
                        <input type="radio" name="status" class="minimal" value="0" id="status" checked>Inactive
                            
                            <span class="text-danger"><?php echo form_error('status');?></span>
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
  
 
  
 

