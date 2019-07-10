<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
 #new {
  width: 100px;
  height: 100px;
  overflow: hidden;
  border: 1px solid black;
  margin-left: 20px;
}

#img {
    display: none;
}
img {
    height:100%;
    width: 100%;
}

/* Important part */
.modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    height: 250px;
    overflow-y: auto;
}
#textarea{
  border:2px solid #eee;
  
}

#textarea input{
  border:none;
  background:none;
  font-size:1.2em;
  padding:6px;
}

#textarea input:focus{
   outline:none;

}

#textarea button{
   border:1px solid #eee;
   background:#f5f5f5;
  margin:4px;
  font-size:1.2em;
  cursor:pointer;
}

#textarea button:after{
   content:"\d7";
   color:red;
   margin-left:2px;
}
#mrleft{
    margin-left: 20px;
}

.rotate90 {
    transform: rotate(90deg) translateY(-100%);
    -webkit-transform: rotate(90deg) translateY(-100%);
    -ms-transform: rotate(90deg) translateY(-100%);
}
.rotate180 {
    transform: rotate(180deg) translate(-100%,-100%);
    -webkit-transform: rotate(180deg) translate(-100%,-100%);
    -ms-transform: rotate(180deg) translateX(-100%,-100%);
}
.rotate270 {
    transform: rotate(270deg) translateX(-100%);
    -webkit-transform: rotate(270deg) translateX(-100%);
    -ms-transform: rotate(270deg) translateX(-100%);
}
i.material-icons {
        font-size: 1.5rem;
        color: white;
        position: relative;
        border-radius: 50%;
        padding: 5px;
        margin: 3px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        transition: color 0.2s ease, background-color 0.2s ease, transform 0.3s ease;
}
.mrginclass{
    margin-left: 38px;
}
</style>
<script type="text/javascript" src="http://beneposto.pl/jqueryrotate/js/jQueryRotateCompressed.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            Post New Ad

            <small>Fill up the form bellow</small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="#">Post</a></li>

            <li class="active">Add</li>

        </ol>

    </section>



    <!-- Main content -->

    <section class="content">



        <!-- Default box -->

        <div class="box box-info">

            <div class="box-header with-border">

                <h3 class="box-title">Ad Add</h3>

            </div>

            <?php echo form_open_multipart(current_url(), 'id="my_id"'); ?>



            <div class="box-body">

                <div class="row clearfix">



                    <div class="col-md-3">

                        <label for="choose" class="control-label">Choose</label>

                        <div class="form-group">

                            <input type="radio" name="choose" class="minimal seller" value="seller" id="seller">

                            <?php echo $site_filter_option1_label;?>

                            <input type="radio" name="choose" class="minimal seller" value="reqeustor" id="reqeustor"

                                checked>

                            <?php echo $site_filter_option2_label;?>



                            <span class="text-danger">

                                <?php echo form_error('choose');?></span>

                        </div>

                    </div>



                    <div class="col-md-3">

                        <label for="name" class="control-label"><span class="text-danger">*</span>Name</label>

                        <div class="form-group">

                            <input type="text" name="advertiser_name" class="form-control" value="<?php echo $this->session->userdata('logged_in')->first_name.' '.$this->session->userdata('logged_in')->last_name; ?>"

                                id="name" required>





                            <span class="text-danger">

                                <?php echo form_error('advertiser_name');?></span>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <label for="advertiser_phone" class="control-label"><span class="text-danger">*</span>Phone#</label>

                        <div class="form-group">

                            <input type="tel" name="advertiser_phone" class="form-control" value="<?php echo $this->session->userdata('logged_in')->phone; ?>"

                                id="phone" required>





                            <span class="text-danger">

                                <?php echo form_error('advertiser_phone');?></span>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <label for="fax" class="control-label">Fax Number</label>

                        <div class="form-group">

                            <input type="tel" name="fax" value="<?php echo $this->input->post('fax'); ?>" class="form-control"

                                id="fax" />

                            <span class="text-danger">

                                <?php echo form_error('fax');?></span>

                        </div>

                    </div>


                    <div class="row clearfix">
                        <div class="col-md-4">
                            <span id="mrleft">please add Tags with "," Separate</span>
                        </div>
                        <label for="fax" class="control-label">Tags</label>

                        <div class="form-group">
                        <div id="textarea" class="col-md-6">

                       <input  type="text" id="tags">
                         <input type="hidden" id="tag" name="tags">
                        </div>
                            </div>


                    <div class="col-md-12">

                        <label for="adtitle" class="control-label"><span class="text-danger">*</span> Title</label>

                        <div class="form-group">

                            <input type="text"  name="adtitle" value="<?php echo $this->input->post('adtitle'); ?>"

                                class="form-control" id="adtitle" />

                            <span class="text-danger">

                                <?php echo form_error('adtitle');?></span>

                        </div>

                    </div>



                    <div class="col-md-12">

                        <label for="price" class="control-label"><span class="text-danger">*</span>Description</label>

                        <div class="form-group">

                            <textarea rows="5" name="description" class="form-control" id="description" /><?php echo $this->input->post('description'); ?></textarea>

                            <span class="text-danger">

                                <?php echo form_error('description');?></span>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <label for="category_id" class="control-label">Choose Product Category</label>

                        <div class="form-group">

                            <select class="form-control" id="category_id" name="category_id">

                                <?php

                                foreach ($category_names as $category_name) { ?>

                                <option value=" <?php echo $category_name->id; ?>">

                                    <?php echo $category_name->name; ?>

                                </option>;

                                <?php }

                                ?>

                            </select>

                            <span class="text-danger">

                                <?php echo form_error('category_id');?></span>

                        </div>

                    </div>
                    
        <div class="col-md-12">
            <h1>Choose Icon </h1>
        </div>
        <div class="col-md-12">
            <!-- Trigger modal using -->
            <select class="form-control" id="myselect">
              <option>select</option>
              <option value="secondoption">Second Option</option>
            </select>
        </div>
        <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Select Image</h4>
      </div>
      <div class="modal-body">
        <?php
        $this->load->helper('directory'); //load directory helper
        $dir = "uploads/icon/"; // Your Path to folder
        $map = directory_map($dir); /* This function reads the directory path specified in the first parameter and builds an array representation of it and all its contained files. */

        foreach ($map as $k)
        {?>
           Select <input type="radio" name="icon" value="<?php echo base_url($dir)."/".$k;?>">
     <img src="<?php echo base_url($dir)."/".$k;?>"  style="height: 100px; width: 100px;" alt="">
     <br>
            
    <?php }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
              </div>
             </div>
        </div>
    </div>


                    <div class="col-md-6">

                        <label for="userfile" class="control-label"> Upload Images</label>

                        <div class="form-group">

                            <input type="file" name="userfile[]" 

                                class="form-control" id="userfile" multiple="multiple" />
                                 
                                 <div class="row" id="img">
                                   <!--  <div class='row'><input type='button' class='btnRotate' style='margin-left:30px;' value='90' onClick='rotateImage(this.value);' /><input type='button' class='btnRotate' value='-90' onClick='rotateImage(this.value);' /><input type='button'class='btnRotate' value='180' onClick='rotateImage(this.value);' /><input type='button' class='btnRotate' value='360' onClick='rotateImage(this.value);' /><div class='row' id='new' style='margin-left:30px;width: 100px;height: 100px;overflow: hidden;border: 1px solid black;margin-left: 20px;id=;'  ><input type='hidden'  name='degree' value='' id='degree'><img src='#' id='blah'alt='img'></div></div>   -->

                             </div>
                            <span class="text-danger">

                                <?php if(isset($error)) echo $error;?></span>

                        </div>

                    </div>



                    <div class="col-md-6">

                        <label for="video" class="control-label"> Upload Video(Max..

                            <?php echo $video_size; ?>MB)</label>

                        <div class="form-group">

                            <input type="file" name="video" value="<?php echo $this->input->post('video'); ?>" class="form-control"

                                id="video" />

                            <span class="text-danger">

                                <?php if(isset($video_error)) echo $video_error;?>

                                <?php  //echo $this->session->flashdata('message_name');?>

                            </span>

                        </div>

                    </div>







                    <div class="col-md-6">

                        <label for="lng" class="control-label"><span class="text-danger">*</span>Longitude</label>

                        <div class="form-group">

                            <input type="text" name="lng" value="<?php echo $this->session->userdata('logged_in')->lng; ?>"

                                class="form-control" id="lng" />

                            <span class="text-danger">

                                <?php echo form_error('lng');?></span>

                        </div>

                    </div>



                    <div class="col-md-6">

                        <label for="lat" class="control-label"><span class="text-danger">*</span>Latitude</label>

                        <div class="form-group">

                            <input type="text" name="lat" value="<?php echo $this->session->userdata('logged_in')->lat; ?>"

                                class="form-control" id="lat" />

                            <span class="text-danger">

                                <?php echo form_error('lat');?></span>

                        </div>

                    </div>





                    <div class="col-md-6 price_show_hide">



                        <label for="price" class="control-label">Price</label>

                        <div class="form-group">

                            <input type="text" name="price" value="<?php echo $this->input->post('price'); ?>" class="form-control"

                                id="price" />

                            <span class="text-danger">

                                <?php echo form_error('price');?></span>

                        </div>



                    </div>





                    <div class="col-md-6">

                        <label for="my_address" class="control-label"><span class="text-danger"></span>My address</label>

                        <div class="form-group">

                            <input type="text" name="my_address" value="<?php echo $this->input->post('my_address'); ?>"

                                class="form-control" id="my_address" />

                            <span class="text-danger">

                                <?php echo form_error('my_address');?></span>

                        </div>

                    </div>

                    <div class="col-md-12">
                            <div class="col-md-6">
                        <label for="web_link" class="control-label">Show Web Link</label>

                        <div class="form-group" id="weblink">

                            <input type="radio" name="web_link" class="minimal web_link" value="1" id="web_link">Show

                            <input type="radio" name="web_link" class="minimal web_link" value="0" id="web_link"

                                checked>Hide

                            <span class="text-danger">

                                <?php echo form_error('web_link');?></span>

                        </div>
                    </div>
                    <div class="col-md-6">
                         <label for="web_link" class="control-label">Choose Default</label>
                        <div class="form-group" id="default">

                            <input type="radio" name="default_rd" class="minimal web_link" value="Requester" >Requester

                            <input type="radio" name="default_rd" class="minimal web_link" value="Donor" 

                                checked>Donor

                            <span class="text-danger">

                                <?php echo form_error('web_link');?></span>

                        </div>



                    </div>
                    </div>

                    <div id="weblink_show_hide">

                        <?php if($weblink_1==1){?>
                        <?php if($this->session->userdata('logged_in')->user_role ==1){ ?>
                        <div class="col-md-6">

                            <label for="Weblink_show_1" class="control-label">Show Web Link 1</label>

                            <div class="form-group" id="Weblink_show_1">

                                <input type="radio" name="Weblink_show_1" class="minimal Weblink_show_1" value="1" id="Weblink_show_1">Show

                                <input type="radio" name="Weblink_show_1" class="minimal Weblink_show_1" value="0" id="Weblink_show_1"

                                    >Hide

                                <span class="text-danger">

                                    <?php echo form_error('Weblink_show_1');?></span>

                            </div>

                        </div>
                        <?php } ?>
                        <div class="col-md-6 web_link_1">

                            <label for="web_link_1" class="control-label"><span class="text-danger"></span>

                                <?php echo $weblink_1_text; ?></label>

                            <div class="form-group">

                                <input type="text" name="web_link_1" value="<?php echo $this->input->post('web_link_1'); ?>"

                                    class="form-control" id="web_link_1" />

                                <span class="text-danger">

                                    <?php echo form_error('web_link_1');?></span>

                            </div>

                        </div>

                        <?php }?>



                        <?php if($weblink_2==1){?>
                            <?php if($this->session->userdata('logged_in')->user_role ==1){ ?>
                            <div class="col-md-6">

                                <label for="Weblink_show_2" class="control-label">Show Web Link 2</label>

                                <div class="form-group" id="Weblink_show_2">

                                    <input type="radio" name="Weblink_show_2" class="minimal Weblink_show_2" value="1" id="Weblink_show_2">Show

                                    <input type="radio" name="Weblink_show_2" class="minimal Weblink_show_2" value="0" id="Weblink_show_2"

                                    >Hide

                                    <span class="text-danger">

                                    <?php echo form_error('Weblink_show_2');?></span>

                                </div>

                            </div>
                            <?php } ?>

                        <div class="col-md-6 web_link_2">

                            <label for="web_link_2" class="control-label"><span class="text-danger"></span>

                                <?php echo $weblink_2_text; ?></label>

                            <div class="form-group">

                                <input type="text" name="web_link_2" value="<?php echo $this->input->post('web_link_2'); ?>"

                                    class="form-control" id="web_link_2" />

                                <span class="text-danger">

                                    <?php echo form_error('web_link_2');?></span>

                            </div>

                        </div>

                        <?php }?>



                        <?php if($weblink_3==1){?>
                        <?php if($this->session->userdata('logged_in')->user_role ==1){ ?>
                            <div class="col-md-6">

                                <label for="Weblink_show_3" class="control-label">Show Web Link 3</label>

                                <div class="form-group" id="Weblink_show_3">

                                    <input type="radio" name="Weblink_show_3" class="minimal Weblink_show_3" value="1" id="Weblink_show_3">Show

                                    <input type="radio" name="Weblink_show_3" class="minimal Weblink_show_3" value="0" id="Weblink_show_3"

                                        >Hide

                                    <span class="text-danger">

                                        <?php echo form_error('Weblink_show_3');?></span>

                                </div>

                            </div>
                        <?php } ?>

                        <div class="col-md-6 web_link_3">

                            <label for="web_link_3" class="control-label"><span class="text-danger"></span>

                                <?php echo $weblink_3_text; ?></label>

                            <div class="form-group">

                                <input type="text" name="web_link_3" value="<?php echo $this->input->post('web_link_3'); ?>"

                                    class="form-control" id="web_link_3" />

                                <span class="text-danger">

                                    <?php echo form_error('web_link_3');?></span>

                            </div>

                        </div>

                        <?php }?>

                    </div>



                    <div id="div_hide">

                        <div class="col-md-12">

                            <div class="nav-tabs-custom">

                                <ul class="nav nav-tabs">

                                    <li class=""><a href="#tab_1" data-toggle="tab" aria-expanded="false"><b>Online</b></a></li>

                                    <li class="active"><a href="#tab_2" data-toggle="tab" aria-expanded="true"><b>Offline</b></a></li>

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane" id="tab_1">


                                        <div class="col-md-6">

                                            <label for="merchant_name" class="control-label"><span class="text-danger"></span>Merchant

                                                Name</label>

                                            <div class="form-group">

                                                <input type="text" name="merchant_name" value="<?php echo $this->input->post('merchant_name'); ?>"

                                                    class="form-control" id="merchant_name" />

                                                <span class="text-danger">

                                                    <?php echo form_error('merchant_name');?></span>

                                            </div>

                                        </div>



                                        <div class="col-md-6">

                                            <label for="merchant_phone" class="control-label"><span class="text-danger"></span>Merchant

                                                Phone</label>

                                            <div class="form-group">

                                                <input type="tel" name="merchant_phone" value="<?php echo $this->input->post('merchant_phone'); ?>"

                                                    class="form-control" id="merchant_phone" />

                                                <span class="text-danger">

                                                    <?php echo form_error('merchant_phone');?></span>

                                            </div>

                                        </div>













                                    </div>

                                    <!-- /.tab-pane -->

                                    <div class="tab-pane active" id="tab_2">





                                        <div class="col-md-6">

                                            <label for="merchant_name" class="control-label"><span class="text-danger"></span>Merchant

                                                Name</label>

                                            <div class="form-group">

                                                <input type="text" name="merchant_name" value="<?php echo $this->input->post('merchant_name'); ?>"

                                                    class="form-control" id="merchant_name" />

                                                <span class="text-danger">

                                                    <?php echo form_error('merchant_name');?></span>

                                            </div>

                                        </div>



                                        <div class="col-md-6">

                                            <label for="merchant_phone" class="control-label"><span class="text-danger"></span>Merchant

                                                Phone</label>

                                            <div class="form-group">

                                                <input type="tel" name="merchant_phone" value="<?php echo $this->input->post('merchant_phone'); ?>"

                                                    class="form-control" id="merchant_phone" />

                                                <span class="text-danger">

                                                    <?php echo form_error('merchant_phone');?></span>

                                            </div>

                                        </div>



                                        <div class="col-md-6">

                                            <label for="merchant_phone" class="control-label"><span class="text-danger"></span>Merchant

                                                Address</label>

                                            <div class="form-group">

                                                <input type="tel" name="merchant_address" value="<?php echo $this->input->post('merchant_address'); ?>"

                                                    class="form-control" id="merchant_address" />

                                                <span class="text-danger">

                                                    <?php echo form_error('merchant_address');?></span>

                                            </div>

                                        </div>









                                    </div>



                                    <!-- /.tab-pane -->

                                </div>

                                <!-- /.tab-content -->

                            </div>

                        </div>

                    </div>





                    <!--<div id="div_hide">

                     <div class="col-md-6">

                        <label for="web_link_1" class="control-label"><span class="text-danger">*</span>Web Link</label>

                        <div class="form-group">

                            <input type="text" name="web_link_1" value="<?php// echo $this->input->post('web_link_1'); ?>" class="form-control" id="web_link_1" />

                            <span class="text-danger"><?php //echo form_error('web_link_1');?></span>

                        </div>

                    </div>

                    

                    <div class="col-md-6">

                        <label for="merchant_name" class="control-label"><span class="text-danger"></span>Merchant Name</label>

                        <div class="form-group">

                            <input type="text" name="merchant_name" value="<?php //echo $this->input->post('merchant_name'); ?>" class="form-control" id="merchant_name" />

                            <span class="text-danger"><?php //echo form_error('merchant_name');?></span>

                        </div>

                    </div>



                    <div class="col-md-6">

                        <label for="merchant_phone" class="control-label"><span class="text-danger"></span>Merchant Phone</label>

                        <div class="form-group">

                            <input type="tel" name="merchant_phone" value="<?php //echo $this->input->post('merchant_phone'); ?>" class="form-control" id="merchant_phone" />

                            <span class="text-danger"><?php //echo form_error('merchant_phone');?></span>

                        </div>

                    </div>



                    <div class="col-md-6">

                        <label for="merchant_id" class="control-label"><span class="text-danger"></span>Merchant Id</label>

                        <div class="form-group">

                            <input type="text" name="merchant_id" value="<?php //echo $this->input->post('merchant_id'); ?>" class="form-control" id="merchant_id" />

                            <span class="text-danger"><?php //echo form_error('merchant_id');?></span>

                        </div>

                    </div>



                    <div class="col-md-6">

                        <label for="merchant_address" class="control-label"><span class="text-danger"></span>Merchant address</label>

                        <div class="form-group">

                            <input type="text" name="merchant_address" value="<?php //echo $this->input->post('merchant_address'); ?>" class="form-control" id="merchant_address" />

                            <span class="text-danger"><?php// echo form_error('merchant_address');?></span>

                        </div>

                    </div>

                    </div>

                    

                    -->



                    <div class="col-md-3">

                        <label for="status" class="control-label">Status</label>

                        <div class="form-group">

                            <input type="radio" name="status" class="minimal" value="1" id="status">Active

                            <input type="radio" name="status" class="minimal" value="0" id="status" checked>Inactive

                               on specific time 
                            <div class='input-group date' >

                                     <input type='date' class="form-control"   name="active_date"/>

                                     <span class="input-group-addon">

                                    <span class="glyphicon glyphicon-calendar"></span>

                                     </span>

                                 </div>
                            <span class="text-danger">

                                <?php echo form_error('status');?></span>

                        </div>

                    </div>

                    <div class="col-md-12">



                        <h5 class="title">Add Your Video Link </h5>



                        <div class="row1">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <div class="input-group1 cd-filter-block" id="link_input">

                                        <input type="text" id="link" name="link" placeholder="Web Link" value="<?php echo $this->input->post('link'); ?>"

                                            class="form-control" id="link" autofocus />

                                        <div class="input-group-append">

                                            <button class="btn btn-warning" style="margin-top:10px" type="button" id="preview_btn">Preview</button><button

                                                class="btn btn-info" style="margin-top:10px; margin-left:9px" type="button"

                                                id="clear_btn">Clear</button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12" id="link_preview" name="link_preview"></div>

                        </div>



                    </div>

                    <div class='col-md-6'>

                        <label for="status" class="control-label">Appointment Date</label>

                        <div class="form-group">

                            <div class='input-group date' id='datetimepicker1'>

                                <input type='text' class="form-control" name="appointment_date[]"/>

                                <span class="input-group-addon">

                                    <span class="glyphicon glyphicon-calendar"></span>

                                </span>

                            </div>

                            <div id="show_date"></div>

                            <button class="btn btn-info add_more" type="button" style="margin-top:10px" id="add_more">Add

                                More</button>

                        </div>



                    </div>

                </div>

            </div>

            <div class="box-footer">

                <button type="submit" class="btn btn-success" name="submit">

                    <i class="fa fa-check"></i> Save

                </button>

            </div>

            <input type="hidden" name="client_id" value="<?php echo $client_id;?>">

            <?php echo form_close(); ?>

        </div>

        <!-- /.box -->



    </section>

    <!-- /.content -->

</div>





<script type="text/javascript">
    var angle = 0, img = document.getElementById('blah');
document.getElementById('button').onclick = function() {
    angle = (angle+90)%360;
    img.className = "rotate"+angle;
}
</script>

<script type="text/javascript">

    //jQuery.datetimepicker.setLocale('en');

    $(function () {

        // $.datetimepicker.ui;

        $('#datetimepicker1').datetimepicker({
             minDate:new Date()
        });

    });
       $(function () {

        // $.datetimepicker.ui;

        $('#datetimepicker33').datetimepicker({
             minDate:new Date()
        });

    });

</script>


<script type="text/javascript">
    $('#myselect').change(function() {
    var opval = $(this).val();
    if(opval=="secondoption"){
        $('#myModal').modal("show");
    }
});
</script>




<script type="text/javascript">

    var placeSearch, autocomplete;





    // Bias the autocomplete object to the user's geographical location,

    // as supplied by the browser's 'navigator.geolocation' object.

    function geolocate() {

        if (navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(function (position) {

                console.log(position);

                var geolocation = {

                    lat: position.coords.latitude,

                    lng: position.coords.longitude

                };

                $('#lat').val(geolocation.lat);

                $('#lng').val(geolocation.lng);

                var circle = new google.maps.Circle({

                    center: geolocation,

                    radius: position.coords.accuracy

                });



            });

        }

    }

</script>



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6D1K61C-VBTXW_g8NxRdq7twVzdvxclk&libraries=places&callback=geolocate"

    async defer></script>
     
<script type="text/javascript">

    $('.add_more').click(function () {

        // $('#show_date').append(

        //     '<div style="margin-top: 15px; margin-bottom: 15px;" class="input-group date" id="datetimepicker1"><input type="text" class="form-control" /><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span><span class="remove_date" title="close" onclick="abc(this);">x</span></div>'

        // );

        add_date();

        

    });

    function add_date(){
        var new_datepicker = $('<div style="margin-top: 15px; margin-bottom: 15px;" class="input-group date clone_date" id="datetimepicker1"><input type="text" class="form-control dt_tm" name="appointment_date[]"/><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span><span class="remove_date" title="close" onclick="abc(this);">x</span><span style=" background: #00a65a; float: left; padding: 7px; color: white; cursor:pointer;" class="get_clone" onclick="clone(this);">Clone</span></div>').datetimepicker({
             minDate:new Date()
        });

        $('#show_date').append(new_datepicker);
    }


    function clone(e){  

        var curr_date_time=$(e).parent().find('input').val();       
        var fields = curr_date_time.split(' ');
        var date = fields[0];
        var time = fields[1];
        var am_pm = fields[2];
        console.log(date);

        var new_date=moment(date).add( 7, "days" ).format("MM/DD/YYYY");
        console.log(new_date);

        var new_datepicker = $('<div style="margin-top: 15px; margin-bottom: 15px;" class="input-group date clone_date" id="datetimepicker1"><input type="text" class="form-control dt_tm" name="appointment_date[]" value="'+new_date+time+am_pm+'"/><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span><span class="remove_date" title="close" onclick="abc(this);">x</span><span style=" background: #00a65a; float: left; padding: 7px; color: white; cursor:pointer;" class="get_clone" onclick="clone(this);">Clone</span></div>').datetimepicker();

        $('#show_date').append(new_datepicker);

    }





function abc(e){

    //console.log(e);

    $(e).parent().remove();



 }



    CKEDITOR.replace('description');


function readURL(input) {
     var filesAmount = input.files.length;
     //input.files[0];
  if (input.files && filesAmount==1 ) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $("#img").append("<div class='row'  id='new1'><button type='button' id='"+ x +"' value='rotate' class='fa fa-refresh mrginclass' onClick='rotateImages(this.value,this.id);'></button><input type='hidden' name='rotate["+x+"]'id='db"+x+"' ><div class='row' id='new' style='margin-left:30px;width: 100px;height: 100px;overflow: hidden;border: 1px solid black;id=;'  ><img src='#' id='blah' alt='img'></div>");
            $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
      }else if (filesAmount>1) {
        var reader = new FileReader();
        $("#new1").remove();
        $("#row1").remove();
        var x = 0 ;
         for (i = 0; i < filesAmount; i++) {

                var reader = new FileReader();
                
                reader.onload = function(event) {
                     x++;
                    $("#img").append("<button type='button' id='"+ x +"' value='rotate' class='fa fa-refresh mrginclass' onClick='rotateImage(this.value,this.id);'></button><input type='hidden' name='rotate["+x+"]'id='db"+x+"' value='0' ><div class='row' id='new' style='margin-left:30px;width: 100px;height: 100px;overflow: hidden;border: 1px solid black;margin-left: 20px;id=;'  ><img src='#' name='image[]' id='my"+ x +"' alt='img'></div></div>");

                        //var path = event.target.result;
                        //alert(path);
                        var a = 'my'+x;
                        //alert(a);

                        
                        $("[id='"+a+"']").attr('src',event.target.result);
                        // $('.row').children('img').attr('src', e.target.result);
                        //$('#blah').attr('src', e.target.result);
                      
                    


                       
                }
                    
                    
                
                reader.readAsDataURL(input.files[i]);
            }
   
}
}

    
                        
                       

               
$("#userfile").change(function() {
  readURL(this);
});
$("#userfile").on('click', function(event){
   $("#img").show();
});
$(".btnRotate").on('click', function(event){
   
     var x = $(this).val();
     $("#degree").val(x);
});


function rotateImages(degree,id) {
	 img = document.getElementById('my'+id);
    var ok = id ;
    var angle =  $("#db"+ok).val();

       
      
    
document.getElementById(ok).onclick = function() {
   if(angle<=360){
  
  angle = (angle + 90) % 450;
	$("#db"+ok).val(angle);  
   }
  $("#blah").animate({  transform: angle }, {

    step: function(now,fx) {
        $(this).css({
            '-webkit-transform':'rotate('+now+'deg)', 
            '-moz-transform':'rotate('+now+'deg)',
            'transform':'rotate('+now+'deg)'
        });
    }
    });
    

}
}

function rotateImage(degree,id) {
    // var angle = 0,

    img = document.getElementById('my'+id);
    var ok = id 
    var angle =  $("#db"+ok).val();
document.getElementById(ok).onclick = function() {
   if(angle<=360){
  
  angle = (angle + 90) % 450;
	$("#db"+ok).val(angle);
  }
   var a = 'my'+id;
  $("[id='"+a+"']").animate({  transform: angle }, {

    step: function(now,fx) {
        $(this).css({
            '-webkit-transform':'rotate('+now+'deg)', 
            '-moz-transform':'rotate('+now+'deg)',
            'transform':'rotate('+now+'deg)'
        });
    }
    });
}
}
     // var a = 'my'+id;
    // $("[id='"+a+"']").animate({  transform: degree }, {

    // step: function(now,fx) {
    //     $(this).css({
    //         '-webkit-transform':'rotate('+now+'angle)', 
    //         '-moz-transform':'rotate('+now+'angle)',
    //         'transform':'rotate('+now+'angle)'
    //     });
    // }
    // });

//}

 
$('#textarea input').on('keyup', function(e){
   var key = e.which;
   if(key == 188){
      $('<button/>').text($(this).val().slice(0, -1)).insertBefore($(this));
      $(this).val('').focus();
   var array = [];
    $('#textarea button').each(function () {
    array.push(this.innerHTML);
});
    $("#tag").val(array);   
   };
});

$("#adtitle").focusout(function(){
    var title = $("#adtitle").val();
    var tags = $("#tag").val();
    var aptag = tags+','+title;
    var tags = $("#tag").val(aptag);
});
$('#textarea').on('click', 'button', function(e){
   e.preventDefault();
  $(this).remove();
   return false;
})


    $(function () {

        $('.seller').on('ifClicked', function (event) {

            var selected = $(this).val();

            if (selected == 'seller') {

                hideExtraFields();

            } else {

                showExtraFields();

            }

        });

    });



    showExtraFields();



    function showExtraFields() {

        $('.price_show_hide').show();

        $('#div_hide').slideDown();

    }
        $("#my_id").submit(function(e){
          $(document).on('keypress', function(e) {
            e.preventDefault(); 
        alert("validation failed false");
    returnToPreviousPage();
    return false;
   });
    });



    function hideExtraFields() {

        <?php if($hide_price){?>

        $('.price_show_hide').hide();

        <?php }?>





        $('#div_hide').slideUp();

    }



    $("#web_link_1").change(function () {

        add_protocol_1();

    });



    function add_protocol_1() {



        var field = $('#web_link_1').val();

        if (field) {

            var result = field.search(new RegExp(/^https?:\/\//i));

            if (!result) {

                // its present

            } else {

                field = 'http://' + field;

            }

            $('#web_link_1').val(field);

        }



    }



    $("#web_link_2").change(function () {

        add_protocol_2();

    });



    function add_protocol_2() {



        var field = $('#web_link_2').val();

        if (field) {

            var result = field.search(new RegExp(/^https?:\/\//i));

            if (!result) {

                // its present

            } else {

                field = 'http://' + field;

            }

            $('#web_link_2').val(field);

        }



    }


    $("#web_link_3").change(function () {

        add_protocol_3();

    });



    function add_protocol_3() {



        var field = $('#web_link_3').val();

        if (field) {

            var result = field.search(new RegExp(/^https?:\/\//i));

            if (!result) {

                // its present

            } else {

                field = 'http://' + field;

            }

            $('#web_link_3').val(field);

        }



    }







    $('#weblink input').on('ifChecked', function (event) {

        //alert("dfdfd");

        var show_val = $(this).val(); // alert value

        show_hide_weblink(show_val);

    });


     function show_hide_weblink(show_val) {

        if (show_val == 0) {

            $("#weblink_show_hide").hide();

        } else {

            $("#weblink_show_hide").show();

        }

    }



    $('#Weblink_show_1 input').on('ifChecked', function (event) {

         var show_val = $(this).val(); // alert value

         show_hide_weblink_1(show_val);

    });

    function show_hide_weblink_1(show_val) {

        if (show_val == 0) {

            $(".web_link_1").hide();

        } else {

            $(".web_link_1").show();

        }

    }



    $('#Weblink_show_2 input').on('ifChecked', function (event) {

        var show_val = $(this).val(); // alert value

        show_hide_weblink_2(show_val);

    });

    function show_hide_weblink_2(show_val) {

        if (show_val == 0) {

            $(".web_link_2").hide();

        } else {

            $(".web_link_2").show();

        }

    }

    $('#Weblink_show_3 input').on('ifChecked', function (event) {

         var show_val = $(this).val(); // alert value

         show_hide_weblink_3(show_val);

    });

    function show_hide_weblink_3(show_val) {

        if (show_val == 0) {

            $(".web_link_3").hide();

        } else {

            $(".web_link_3").show();

        }

    }



   



    $(document).ready(function () {

        var show_val = 0;

        show_hide_weblink(show_val);

    });



    $('#clear_btn').click(function () {

        $('#link').val('');

        //jQuery('#preview_btn').click();

        load_div();

    });



    //var final_link = {};





    $('#preview_btn').click(function () {

        load_div();

    });





    var final_link = {};



    function load_div() {

        final_link = {};

        $('#link_preview').html('');

        var link = $('#link').val();

        console.log(link);

        if (ValidURL(link)) {

            //console.log('Valid');

            $('#addbtn').attr('disabled', true);

            $.ajax({

                url: "https://api.linkpreview.net/",

                dataType: 'jsonp',

                data: {

                    q: link,

                    key: '5b63e209be32fddf20ca99b0ddd9a0e505ed7830ea299'

                },

                success: function (response) {

                    console.log(response);



                    if (response.error === 424) {

                        $('#link_preview').html(

                            '<div class="alert alert-danger">Preview Not Available for the link specified.</div>'

                        );

                    } else {

                        if (response.image == "") {

                            response.image = "<?php echo base_url();?>assets/noimage.png";

                        }



                        final_link.title = response.title;

                        final_link.description = response.description;

                        final_link.image = response.image;

                        final_link.link = response.url;



                        var preview =

                            '<input type="hidden" name="video_link_title" value="' + response.title +

                            '"><input type="hidden" name="video_link_description" value="' + response.description +

                            '"> <input type="hidden" name="video_link_image" value="' + response.image +

                            '"><div class="partbylist"><div class="row"><div class="col-md-4"><div class="postimgage"><a href="#"><img src="' +

                            response.image +

                            '" alt="image" class="img-responsive"/></a></div></div><div class="col-md-8"><div class="postallcontss"><h4><a href="#">' +

                            response.title + '</a></h4><p>' + response.description +

                            '</p></div></div></div></div>';

                        $('#link_preview').html(preview);

                        $('#addbtn').attr('disabled', false);

                    }



                }

            });



        } else {

            //$('#link_preview').html('<div class="alert alert-danger">Invalid Url</div>');

            $('#link_preview').html('');

        }

    }



    function ValidURL(str) {

        regexp =

            /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;

        if (regexp.test(str)) {

            return true;

        } else {

            return false;

        }

    }



    $('#addbtn').click(function () {

        var country = $('select#link_country option:selected').val();

        var category = $('select#link_category option:selected').val();

        alert(country);

        return alert(category);

        // if(country===''){

        //  alert("Please Select Country");

        //  return false;

        // }

        // if(category===''){

        //  alert("Please Select Category");

        //  return false;

        // }



        final_link.country = country;

        final_link.category = category;

        $.post("<?php echo base_url('welcome/guest_post_link');?>", final_link)

            .done(function (data) {

                if (data === "1") {

                    $('#link').val('');

                    $('#addbtn').attr('disabled', true);

                    $('#link_preview').html(

                        '<div class="alert alert-success">Your Link has been posted! Waiting for admin approval</div>'

                    );

                } else {

                    alert("Some Error");

                }

            });



    })

</script>



<style>



.remove_date{

    position: absolute;

    right: -27px;

    top: 7px;

    background-color: red;

    color: #fff;

    padding: 0px 5px 2px;

    border-radius: 100%;

    line-height: 18px;

    width: 20px;

    height: 20px;

    text-align: center;

    font-weight: bold;

    cursor: pointer;

}

</style>
<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script>CKEDITOR.replace('description');</script>
