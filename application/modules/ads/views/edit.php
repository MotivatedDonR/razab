<div class="content-wrapper">

<!-- Content Header (Page header) -->
<style type="text/css">
img {
height:100%;
width: 100%;
}
.imgstyle{
height: 100px;
width: 100px;
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

</style>
<section class="content-header">

<h1>
<?php 
//print_r($ad);
?>
Edit Ad

<small>Fill up the form bellow</small>

</h1>

<!--<ol class="breadcrumb">

<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

<li><a href="#">Ads</a></li>

<li class="active">Edit</li>

</ol>-->

</section>



<!-- Main content -->

<section class="content">



<!-- Default box -->

<div class="box box-info">

<div class="box-header with-border">

<h3 class="box-title">Ad Edit</h3>

</div>



<?php echo form_open_multipart(current_url()); ?>

<div class="box-body">

<div class="row clearfix">

<?php //print_r($ad); ?>

<div class="col-md-3">

    <label for="choose" class="control-label">Choose</label>

    <div class="form-group">

        <input type="radio" name="choose" class="minimal seller" value="seller" id="seller" <?php if($ad->choose=='seller')echo "checked";?>><?php echo $site_filter_option1_label;?>

        <input type="radio" name="choose" class="minimal seller" value="reqeustor" id="reqeustor" <?php if($ad->choose=='reqeustor')echo "checked";?>><?php echo $site_filter_option2_label;?>



        <span class="text-danger"><?php echo form_error('choose');?></span>

    </div>

</div>

<input type="hidden" name="client_id" value="<?php echo $ad->user_id; ?>">

<div class="col-md-3">

    <label for="name" class="control-label" ><span class="text-danger">*</span>Name</label>

    <div class="form-group">

        <input type="text" name="advertiser_name"  class="form-control"  value="<?php echo $ad->advertiser_name; ?>"  id="name" required>


        <span class="text-danger"><?php echo form_error('advertiser_name');?></span>

    </div>

</div>

<div class="col-md-3">

    <label for="phone" class="control-label" ><span class="text-danger">*</span>Phone#</label>

    <div class="form-group">

        <input type="tel" name="advertiser_phone"  class="form-control"  value="<?php echo $ad->advertiser_phone; ?>"  id="phone" required>

       



        <span class="text-danger"><?php echo form_error('advertiser_phone');?></span>

    </div>

</div>

<div class="col-md-3">

    <label for="fax" class="control-label">Fax Number</label>

    <div class="form-group">

        <input type="tel" name="fax" value="<?php echo $ad->fax; ?>" class="form-control" id="fax" />

        <span class="text-danger"><?php echo form_error('fax');?></span>

        

    </div>

</div>
 <div class="row clearfix">
    <div class="col-md-4">
        <span id="mrleft">please add Tags with "," Separate</span>
    </div>
     <label for="fax" class="control-label">Tags</label>

    <div class="form-group">
    <div id="textarea" class="col-md-6">
 <input  type="text" id="tags" value="<?php echo $ad->tags; ?>">
     <input type="hidden" id="tag" name="tags">
    </div>
        </div>
      </div>
<?php
$email = "moez.mir@gmail.com";
$default = "https://localhost/easyhealth/uploads/chatsharing/Capture1.PNG";
$size = 40;
$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

?>



<div class="col-md-12">
<img src="<?php echo $grav_url; ?>" alt="" />

    <label for="adtitle" class="control-label"><span class="text-danger">*</span> Title</label>

    <div class="form-group">

        <input type="text" name="adtitle" value="<?php echo $ad->adtitle; ?>" class="form-control"  id="adtitle" />

        <span class="text-danger"><?php echo form_error('adtitle');?></span>

    </div>

</div>



<div class="col-md-12">

    <label for="price" class="control-label"><span class="text-danger">*</span>Description</label>

    <div class="form-group">

        <textarea rows="5" name="description"  class="form-control" id="description" /><?php echo $ad->description; ?></textarea>

        <span class="text-danger"><?php echo form_error('description');?></span>

    </div>

</div>



<div class="col-md-6">

    <label for="image" class="control-label"> Upload Video(Max..<?php echo $video_size; ?>MB)</label>

    <div class="form-group">

        <?php if($ad->video){ ?>

<video width="320" height="240" controls src="<?php echo base_url().'uploads/videos/'.$ad->video; ?>"  />

<?php } ?>

</video>

        <?php  if($ad->video){?>

        <input type="hidden" name="old_video" id="old_video" value="<?php echo $ad->video; ?>">

        <?php }?> 

        <input type="file" name="video" id="video" value="<?php echo $this->input->post('video'); ?>" class="form-control"   id="video"/>

        <span class="text-danger">

            <?php //if(isset($error)) echo $error;?>

            <?php  echo $this->session->flashdata('message_name');?>

        </span>

    </div>

</div>

<div class="col-md-6">

    <label for="image" class="control-label"> Upload Images</label>

   
<?php

   // print_r($adimages);

    //if($adimages){

  //  if($adimages[0]->ad_image){

$admgs=($adimages[0]->ad_image);
    //echo $admgs;
  //  adimages=explode("#",$ad->image)
    if(preg_match('/#/', $ad->image)){
        $x = 0 ;
        $image = explode("#",$ad->image);
        foreach ($image as $images) {                         # code...
    $x++ ;
   $ex =  json_decode($ad->degree);
   // print_r($ex->$x);
    //$ex[$x] ;
   // $adimage=$ad->image; 
       // foreach( $adimages as $adimage){
     
            ?>
       <style>
       #myimg<?php echo $x ; ?> {

-ms-transform: rotate(<?php  echo $ex->$x ; ?>deg); /* IE 9 */
-webkit-transform: rotate(<?php  echo $ex->$x ; ?>deg); /* Safari 3-8 */
transform: rotate(<?php  echo $ex->$x; ?>deg);
width: 100px;
height: 100px;
overflow: hidden;
border: 1px solid black;
margin-left: 20px;
}

</style>

       <?php
    
    $adimage=$ad->image; 
       // foreach( $adimages as $adimage){

            ?>
             
             <div class="form-group">
                <?php //echo $ex ; ?>
                <div class="row checkimg" >
                <button type='button' id="<?php echo $x ; ?>" value='rotate' class='fa fa-refresh mrginclass' onClick='rotateImages(this.value,this.id);'></button><input type='hidden' name="rotate['<?php echo $x  ;?>']"id="db<?php echo $x ;  ?>"
                value="<?php echo $ex->$x; ?>" >

                 <div id="myimg<?php echo $x ; ?>" style="float:left; position:relative;" class="del_img"><img height="100" width="100" id="my<?php echo $x ;  ?>" src="<?php echo base_url().'uploads/documents/'.$images; ?>">

            </div>
        </div> 
    </div>
            <?php //} 
                   } }else if(!empty($ad->image)){
    
                    $rotate = json_decode($ad->degree);
    ?>
     <style>
       #myimgg {

-ms-transform: rotate(<?php  echo $rotate->undefined ; ?>deg); /* IE 9 */
-webkit-transform: rotate(<?php  echo $rotate->undefined ; ?>deg); /* Safari 3-8 */
transform: rotate(<?php  echo $rotate->undefined ?>deg);
width: 100px;
height: 100px;
overflow: hidden;


}

</style>                   
<div class="form-group">
                <?php //echo $ex ; ?>
                <div class="row checkimg" >
               

                 <div id="myimgg" style="float:left; position:relative;" class="del_img"><img height="100" width="100" id="my0" src="<?php echo base_url().'uploads/documents/'.$ad->image; ?>">

            </div>
        </div> 
         <?php } ?>
          <input type="hidden" name="image_values" id="image_values" value="<?php echo $admgs; ?>">

        <?php  //}?>

    <input type="hidden" name="cid" id="cid" value="<?php echo $cid; ?>">   
        <div class="row" id="img">
             </div>
<input type="file" name="userfile[]" id="userfile"  value="<?php echo $this->input->post('userfile'); ?>" class="form-control" id="userfile" multiple="multiple" />

    </div>

</div>







<div class="col-md-12">

    <label for="category_id" class="control-label"><span class="text-danger">*</span>Choose Product Category</label>

    <div class="form-group">

        <select class="form-control select2" style="width: 100%;" name="category_id">

            <?php

            $category=$ad->category_id;



            foreach ($category_names as  $category_name) {

                if($category==$category_name->id){

                    echo '<option value="'.$category_name->id.'" selected>'.$category_name->name.'</option>';

                }else{

                    echo '<option value="'.$category_name->id.'">'.$category_name->name.'</option>';

                }

            }

            ?>

        </select>

        <span class="text-danger"><?php echo form_error('category_id');?></span>

    </div>

</div>              





<div class="col-md-6">

    <label for="lat" class="control-label"><span class="text-danger"></span>Latitude</label>

    <div class="form-group">

        <input type="text" name="lat" value="<?php echo  $ad->lat; ?>" class="form-control"  id="lat" <?php if(($this->session->userdata('logged_in')->user_role)!=1){ echo"readonly";} ?>/>

        <span class="text-danger"><?php echo form_error('lat');?></span>

    </div>

</div>



<div class="col-md-6">

    <label for="lng" class="control-label"><span class="text-danger"></span>Longitude</label>

    <div class="form-group">

        <input type="text" name="lng" value="<?php echo  $ad->lng; ?>" class="form-control"  id="lng" <?php if(($this->session->userdata('logged_in')->user_role)!=1){ echo"readonly";} ?> />

        <span class="text-danger"><?php echo form_error('lng');?></span>

    </div>

</div>

<?php

if(!$hide_price){

?>

   

<div class="col-md-6">

    <label for="price" class="control-label"><span class="text-danger">*</span>Price</label>

    <div class="form-group">

        <input type="text" name="price" value="<?php echo  $ad->price; ?>" class="form-control" id="price" />

        <span class="text-danger"><?php echo form_error('price');?></span>

    </div>

</div>



<?php 

}

?>

<div class="col-md-6">

    <label for="my_address" class="control-label"><span class="text-danger"></span>My Address</label>

    <div class="form-group">

        <input type="text" name="my_address" value="<?php echo  $ad->my_address; ?>" class="form-control" id="my_address" />

        <span class="text-danger"><?php echo form_error('my_address');?></span>

    </div>

</div>  



<!-- <div class="col-md-6">

    <label for="web_link" class="control-label"><span class="text-danger"></span>Web Link</label>

    <div class="form-group">

        <input type="text" name="web_link" value="<?php echo $ad->web_link;  ?>" class="form-control" id="web_link" />

        <span class="text-danger"><?php echo form_error('web_link');?></span>

    </div>

</div>  -->

<div class="col-md-12">
    <div class="col-md-6">
    <label for="web_link" class="control-label">Show Web Link</label>

    <div class="form-group" id="weblink">

        <input type="radio" name="web_link" class="minimal web_link" value="1" id="web_link" <?php if($ad->show_hide_web_link=='1')echo "checked";?> >Show

        <input type="radio" name="web_link" class="minimal web_link" value="0" id="web_link" <?php if($ad->show_hide_web_link=='0')echo "checked";?>>Hide

        <span class="text-danger">

            <?php echo form_error('web_link');?></span>

    </div>
</div>
<div class="col-md-6">
  <div class="col-md-6">
     <label for="web_link" class="control-label">Choose Default</label>
    <div class="form-group" id="default">
        <?php if($ad->default_rd=="Requester"){  ?>
        <input type="radio" name="default_rd" class="minimal web_link" value="Requester" checked >Requester
         <input type="radio" name="default_rd" class="minimal web_link" value="Donor" 

            >Donor
    <?php }else{ ?>
        <input type="radio" name="default_rd" class="minimal web_link" value="Requester"  >Requester
        <input type="radio" name="default_rd" class="minimal web_link" value="Donor" 

            checked>Donor
        <?php } ?>
        <span class="text-danger">

            <?php echo form_error('web_link');?></span>

    </div>



</div>



</div>
</div>

<div id="weblink_show_hide">

<?php if($weblink_1==1){?>
    <?php if($this->session->userdata('logged_in')->user_role ==1){ ?>
        <div class="col-md-6">

            <label for="Weblink_show_1" class="control-label">Show Web Link 1</label>

            <div class="form-group" id="Weblink_show_1">

                <input type="radio" name="Weblink_show_1" class="minimal Weblink_show_1" value="1" id="Weblink_show_1" <?php if($ad->web_link_1_show_hide=='1')echo "checked";?> >Show

                <input type="radio" name="Weblink_show_1" class="minimal Weblink_show_1" value="0" id="Weblink_show_1" <?php if($ad->web_link_1_show_hide=='0')echo "checked";?>

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

        <input type="text" name="web_link_1" value="<?php echo $ad->web_link_1; ?>"

            class="form-control" id="web_link_1" <?php if($this->session->userdata('logged_in')->user_role!=1){echo"readonly";} ?>/>

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

                <input type="radio" name="Weblink_show_2" class="minimal Weblink_show_2" value="1" id="Weblink_show_2" <?php if($ad->web_link_2_show_hide=='1')echo "checked";?>>Show

                <input type="radio" name="Weblink_show_2" class="minimal Weblink_show_2" value="0" id="Weblink_show_2" <?php if($ad->web_link_2_show_hide=='0')echo "checked";?>

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

        <input type="text" name="web_link_2" value="<?php echo $ad->web_link_2; ?>"

            class="form-control" id="web_link_2" <?php if($this->session->userdata('logged_in')->user_role!=1){echo"readonly";} ?> />

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

                <input type="radio" name="Weblink_show_3" class="minimal Weblink_show_3" value="1" id="Weblink_show_3" <?php if($ad->web_link_3_show_hide=='1')echo "checked";?>>Show

                <input type="radio" name="Weblink_show_3" class="minimal Weblink_show_3" value="0" id="Weblink_show_3" <?php if($ad->web_link_3_show_hide=='0')echo "checked";?>

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

        <input type="text" name="web_link_3" value="<?php echo $ad->web_link_3;?>"

            class="form-control" id="web_link_3" <?php if($this->session->userdata('logged_in')->user_role!=1){echo"readonly";} ?>/>

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

    <label for="merchant_name" class="control-label"><span class="text-danger"></span>Merchant Name</label>

    <div class="form-group">

        <input type="text" name="merchant_name" value="<?php echo $ad->merchant_name; ?>" class="form-control" id="merchant_name" />

        <span class="text-danger"><?php echo form_error('merchant_name');?></span>

    </div>

</div>



<div class="col-md-6">

    <label for="merchant_phone" class="control-label"><span class="text-danger"></span>Merchant Phone</label>

    <div class="form-group">

        <input type="tel" name="merchant_phone" value="<?php echo $ad->merchant_phone; ?>" class="form-control" id="merchant_phone" />

        <span class="text-danger"><?php echo form_error('merchant_phone');?></span>

    </div>

</div>













</div>

<!-- /.tab-pane -->

<div class="tab-pane active" id="tab_2">





<div class="col-md-6">

    <label for="merchant_name" class="control-label"><span class="text-danger"></span>Merchant Name</label>

    <div class="form-group">

        <input type="text" name="merchant_name" value="<?php echo $ad->merchant_name; ?>" class="form-control" id="merchant_name" />

        <span class="text-danger"><?php echo form_error('merchant_name');?></span>

    </div>

</div>



<div class="col-md-6">

    <label for="merchant_phone" class="control-label"><span class="text-danger"></span>Merchant Phone</label>

    <div class="form-group">

        <input type="tel" name="merchant_phone" value="<?php echo $ad->merchant_phone; ?>" class="form-control" id="merchant_phone" />

        <span class="text-danger"><?php echo form_error('merchant_phone');?></span>

    </div>

</div>



<div class="col-md-6">

    <label for="merchant_phone" class="control-label"><span class="text-danger"></span>Merchant Address</label>

    <div class="form-group">

        <input type="tel" name="merchant_address" value="<?php echo $ad->merchant_address; ?>" class="form-control" id="merchant_address" />

        <span class="text-danger"><?php echo form_error('merchant_address');?></span>

    </div>

</div>









</div>



<!-- /.tab-pane -->

</div>

<!-- /.tab-content -->

</div>

</div>

</div>  







<!--  <div id="div_hide">



<div class="col-md-6">

    <label for="web_link" class="control-label"><span class="text-danger"></span>Web Link</label>

    <div class="form-group">

        <input type="text" name="web_link" value="<?php //echo $ad->web_link;  ?>" class="form-control" id="web_link" />

        <span class="text-danger"><?php// echo form_error('web_link');?></span>

    </div>

</div>



<div class="col-md-6">

    <label for="merchant_name" class="control-label"><span class="text-danger"></span>Merchant Name</label>

    <div class="form-group">

        <input type="text" name="merchant_name" value="<?php //echo $ad->merchant_name; ?>" class="form-control" id="merchant_name" />

        <span class="text-danger"><?php //echo form_error('merchant_name');?></span>

    </div>

</div>



<div class="col-md-6">

    <label for="merchant_phone" class="control-label"><span class="text-danger"></span>Merchant Phone</label>

    <div class="form-group">

        <input type="tel" name="merchant_phone" value="<?php //echo $ad->merchant_phone; ?>" class="form-control" id="merchant_phone" />

        <span class="text-danger"><?php //echo form_error('merchant_phone');?></span>

    </div>

</div>



<div class="col-md-6">

    <label for="merchant_id" class="control-label"><span class="text-danger"></span>Merchant Id</label>

    <div class="form-group">

        <input type="text" name="merchant_id" value="<?php //echo $ad->merchant_id; ?>" class="form-control" id="merchant_id" />

        <span class="text-danger"><?php //echo form_error('merchant_id');?></span>

    </div>

</div>



<div class="col-md-6">

    <label for="merchant_address" class="control-label"><span class="text-danger"></span>Merchant address</label>

    <div class="form-group">

        <input type="text" name="merchant_address" value="<?php //echo $ad->merchant_address; ?>" class="form-control" id="merchant_address" />

        <span class="text-danger"><?php //echo form_error('merchant_address');?></span>

    </div>

</div>

</div>-->













 <div class="col-md-3">

    <label for="status" class="control-label">Status</label>

    <div class="form-group">

    <input type="radio" name="status" class="minimal" value="1" id="status" <?php if($ad->status=='1')echo "checked";?>>Active

    <input type="radio" name="status" class="minimal" value="0" id="status"<?php if($ad->status=='0')echo "checked";?>>Inactive
<br>
       <div class="form-group">
                active on specific time 
        <div class='input-group date' id='datetimepicker1'>

                 <input type='text' class="form-control"  value="<?php echo $ad->active_on_time; ?>"  name="active_date"/>

                 <span class="input-group-addon">

                <span class="glyphicon glyphicon-calendar"></span>

                 </span>

             </div>
        </div>
        

        <span class="text-danger"><?php echo form_error('status');?></span>

    </div>

</div>

<div class="col-md-12">



    <h5 class="title">Add Your Video Link </h5>



    <div class="row1">

        <div class="col-md-12">

            <div class="form-group">

                <div class="input-group1 cd-filter-block" id="link_input">

                    <input type="text" id="link" name="link" placeholder="Web Link" value="<?php echo $ad->video_link_link; ?>"

                        class="form-control" id="link" autofocus />

                    <div class="input-group-append">

                        <button class="btn btn-warning" style="margin-top:10px" type="button" id="preview_btn">Preview</button><button class="btn btn-info" style="margin-top:10px; margin-left:9px" type="button" id="clear_btn">Clear</button>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-12" id="link_preview" name="link_preview">

            <input type="hidden" name="video_link_description" value="<?php echo $ad->video_link_description; ?>"> 

            <input type="hidden" name="video_link_title" value="<?php echo $ad->video_link_title; ?>">

            <input type="hidden" name="video_link_image" value="<?php echo $ad->video_link_image; ?>">

            <?php if($ad->video_link_image){ ?>

            <table>

            <tr>

                <td><img height="150" width="300" src="<?php echo $ad->video_link_image; ?>"></td>      

                <td style="padding-left: 35px; padding-bottom: 75px;">

                    <div style=" color: #337ab7;font-size: 18px;"><?php echo $ad->video_link_title; ?></div><br>

                    <div><?php echo $ad->video_link_description; ?></div>

                </td>                              

            </tr>

            </table>  

            <?php } ?>                                  

        </div>                            

    </div>



</div>

<div class='col-md-6'>

    <label for="status" class="control-label">Appointment Date</label>

    <div class="form-group">

        <?php  if(($ad->appointment_date=='') || ((json_decode($ad->appointment_date))==null)){ ?>

        <div class='input-group date' id='datetimepicker1'>

            <input type='text' class="form-control" name="appointment_date[]" />

            <span class="input-group-addon">

                <span class="glyphicon glyphicon-calendar"></span>

            </span>

        </div>

        <?php

            }else{

            $cnt=0;

            foreach(json_decode($ad->appointment_date) as $appo_date){ 

            $cnt++;

        ?>

        <div style="margin-top: 15px; margin-bottom: 15px;" class="input-group date"    id="appo_date<?php echo $cnt; ?>">

            <input type="text" class="form-control" name="appointment_date[]" value="<?php echo $appo_date; ?>"  />

            <span class="input-group-addon">

                <span class="glyphicon glyphicon-calendar"></span>

            </span>

            <span class="remove_date" title="close" onclick="abc(this);">x</span>
            <span style=" background: #00a65a; float: left; padding: 7px; color: white; cursor:pointer;" class="get_clone" onclick="clone(this);">Clone</span>

        </div>

        <?php }  }?>

        <div id="show_date"></div>

        <button class="btn btn-info add_more" type="button" style="margin-top:10px" id="add_more">Add

            More</button>

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



<script type="text/javascript">

//jQuery.datetimepicker.setLocale('en');



$(function () {

// $.datetimepicker.ui;

$('#datetimepicker1').datetimepicker({
minDate:new Date()
});

<?php

if($ad->appointment_date && (json_decode($ad->appointment_date)!=null)){

$cnt=0;

foreach(json_decode($ad->appointment_date) as $appo_date){ 

$cnt++;

?>

$('#appo_date<?php echo $cnt;?>').datetimepicker();

<?php } }?>

});







$('.add_more').click(function () {



var new_datepicker = $('<div style="margin-top: 15px; margin-bottom: 15px;" class="input-group date" id="datetimepicker1"><input type="text" class="form-control" name="appointment_date[]"/><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span><span class="remove_date" title="close" onclick="abc(this);">x</span><span style=" background: #00a65a; float: left; padding: 7px; color: white; cursor:pointer;" class="get_clone" onclick="clone(this);">Clone</span></div>').datetimepicker({
minDate:new Date()
});

$('#show_date').append(new_datepicker);

});





function abc(e){

//console.log(e);

$(e).parent().remove();



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

</script>



<script type="text/javascript">

var placeSearch, autocomplete;

var componentForm = {

street_number: 'short_name',

route: 'long_name',

locality: 'long_name',

administrative_area_level_1: 'short_name',

country: 'long_name',

postal_code: 'short_name'

};

function readURL(input) {
var filesAmount = input.files.length;
//input.files[0];
if (input.files && filesAmount==1 ) {
var reader = new FileReader();
$('#img').empty();
reader.onload = function(e) {

$("#img").append("<button type='button' id='"+ x +"' value='rotate' class='fa fa-refresh mrginclass' onClick='rotateImage(this.value,this.id);'></button><input type='hidden' name='rotate["+x+"]'id='b"+x+"' value='0' ><div class='row' id='new' style='margin-left:30px;width: 100px;height: 100px;overflow: hidden;border: 1px solid black;margin-left: 20px;id=;'  ><img src='#' name='image[]' id='blah' alt='img'></div></div>");
$('#blah').attr('src', e.target.result);
}

reader.readAsDataURL(input.files[0]);
}else if (filesAmount>1) {
    
var reader = new FileReader();
var x = 0 ;

for (i = 0; i < filesAmount; i++) {

var reader = new FileReader();

reader.onload = function(event) {
 x++;
  $(".checkimg").remove();
    $("#myimg"+x).remove();


$("#img").append("<button type='button' id='"+ x +"' value='rotate' class='fa fa-refresh mrginclass' onClick='rotateImagess(this.value,this.id);'></button><input type='hidden' name='rotate["+x+"]'id='d"+x+"' value='0' ><div class='row' id='new' style='margin-left:30px;width: 100px;height: 100px;overflow: hidden;border: 1px solid black;margin-left: 20px;id=;'  ><img src='#' name='image[]' id='y"+ x +"' alt='img'></div></div>");

    //var path = event.target.result;
    //alert(path);
    var a = 'y'+x;
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

$("img").hide();
$(".checkimg").css("display", "none");
$(".myim").hide();
$("#new").hide();
//$(".btnRotate").hide();

$("#img").show();
});
$(".btnRotate").on('click', function(event){

var x = $(this).val();
$("#degree").val(x);
});
function rotateImage(degree,id) {
   img = document.getElementById('blah');
    var ok = id ;
    var angle =  $("#b"+ok).val();

       
      
    
document.getElementById(ok).onclick = function() {
   if(angle<=360){
  
  angle = (angle + 90) % 450;
  $("#b"+ok).val(angle);  
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
// function rotateImage(degree) {
// $('#blah').animate({  transform: degree }, {
// step: function(now,fx) {
// $(this).css({
// '-webkit-transform':'rotate('+now+'deg)', 
// '-moz-transform':'rotate('+now+'deg)',
// 'transform':'rotate('+now+'deg)'
// });
// }
// });
// }

function rotateImages(degree,id) {
// var angle = 0,

img = document.getElementById('my'+id);
var ok = id ;
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
function rotateImagess(degree,id) {
// var angle = 0,

img = document.getElementById('y'+id);
var ok = id ;
var angle =  $("#d"+ok).val();

document.getElementById(ok).onclick = function() {

if(angle<=360){

angle = (angle + 90) % 450;
$("#d"+ok).val(angle);
}
var a = 'y'+id;
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
function myrotateImage(degree,id) {
   img = document.getElementById('my0');
 
    var ok = id ;
    var angle =  $("#bb").val();      
    
document.getElementById(ok).onclick = function() {
   if(angle<=360){
  
  angle = (angle + 90) % 450;
  $("#bb").val(angle);  
   }
  $("#my0").animate({  transform: angle }, {

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
function initAutocomplete() {

// Create the autocomplete object, restricting the search to geographical

// location types.

autocomplete = new google.maps.places.Autocomplete(

/** @type {!HTMLInputElement} */(document.getElementById('address')),

{types: ['geocode']});



// When the user selects an address from the dropdown, populate the address

// fields in the form.

autocomplete.addListener('place_changed', fillInAddress);

}



function fillInAddress() {

// Get the place details from the autocomplete object.

var place = autocomplete.getPlace();

//console.log(place.geometry);



$('#lat').val(place.geometry.location.lat());

$('#lng').val(place.geometry.location.lng());



// for (var component in componentForm) {

//   document.getElementById(component).value = '';

//   document.getElementById(component).disabled = false;

// }



// // Get each component of the address from the place details

// // and fill the corresponding field on the form.

for (var i = 0; i < place.address_components.length; i++) {

var addressType = place.address_components[i].types[0];

if(addressType == 'administrative_area_level_2'){

document.getElementById('city').value = place.address_components[i].long_name;

}



if(addressType == 'locality'){

document.getElementById('region').value = place.address_components[i].long_name;

}



if(addressType == 'administrative_area_level_1'){

document.getElementById('state').value = place.address_components[i].long_name;

}

if(addressType == 'country'){

document.getElementById('country').value = place.address_components[i].long_name;

}

if(addressType == 'postal_code'){

document.getElementById('postal_code').value = place.address_components[i].long_name;

}

}

}



// Bias the autocomplete object to the user's geographical location,

// as supplied by the browser's 'navigator.geolocation' object.

function geolocate() {

if (navigator.geolocation) {

navigator.geolocation.getCurrentPosition(function(position) {

var geolocation = {

lat: position.coords.latitude,

lng: position.coords.longitude

};

var circle = new google.maps.Circle({

center: geolocation,

radius: position.coords.accuracy

});

autocomplete.setBounds(circle.getBounds());

});

}

}





</script>



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6D1K61C-VBTXW_g8NxRdq7twVzdvxclk&libraries=places&callback=initAutocomplete"

async defer></script>



<script type="text/javascript">



$( document ).ready(function() {

//check_seller_req();





if($('.seller').is(':checked')){

//var selected = $('.seller').val();

var selected = $("input[name='choose']:checked").val();

if(selected == 'seller'){

hideExtraFields();

}else{

showExtraFields();

}

} 



});



CKEDITOR.replace('description');



function check_seller_req(){



var seller_req = $("input[name='choose']:checked").val();

if(seller_req== 'reqeustor'){

showExtraFields();

}else{

hideExtraFields();

}



}



$('.seller').on('ifClicked', function(event){            



var seller_req = $(this).val();

//console.log($(this).val());

check_seller_req(seller_req);



});



$(function(){

$('.seller').on('ifClicked', function(event){

//$('.seller').trigger('ifChecked');





var selected = $(this).val();

//console.log($(this).val());

if(selected == 'seller'){

hideExtraFields();

}else{

showExtraFields();

}

});



});

//showExtraFields();



function showExtraFields() {

$('#div_hide').slideDown();

}



function hideExtraFields() {

$('#div_hide').slideUp();

}









$('.click_img').click(function() {

$(this).parent(".del_img").remove();

var image_value=$(this).attr('value');

var image_values=$("#image_values").attr('value');

var cid=$("#cid").attr('value');

// console.log(cid);

// console.log(image_value);

// console.log(image_values);



$.post('<?php echo base_url('ads/delete_images') ?>',{image_value:image_value,image_values:image_values,cid:cid,})

.done(function(data){

console.log(data);

$('#image_values').val(data);

// if(data == '1'){

//     alert('Message Sent');

//     $('#modal-default').modal('hide');

// }

});

});



function check_seller_req(){

var seller_req = $("input[name='choose']:checked").val();



if(seller_req==reqeustor){

showExtraFields();

}else{

hideExtraFields();

}

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



$('#weblink input').on('ifChecked', function(event){

var show_val= $(this).val(); // alert value

show_hide_weblink(show_val);

}); 



function show_hide_weblink(show_val){

if(show_val==0){

$("#weblink_show_hide").hide();

}else{

$("#weblink_show_hide").show();

}

}



$('#Weblink_show_1 input').on('ifChecked', function (event) {

var show_val_1 = $(this).val(); // alert value

show_hide_weblink_1(show_val_1);

});

function show_hide_weblink_1(show_val_1) {

if (show_val_1 == 0) {

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




$(document).ready(function(){

var show_val = $("#web_link:checked").val();

show_hide_weblink(show_val);

var show_val_1 = $("#Weblink_show_1:checked").val();

show_hide_weblink_1(show_val_1);

var show_val_2 = $("#Weblink_show_2:checked").val();

show_hide_weblink_2(show_val_2);

var show_val_3 = $("#Weblink_show_3:checked").val();

show_hide_weblink_3(show_val_3);


var link = $('#link').val();

if(link){

// jQuery('#preview_btn').click();

}



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



function load_div(){

// console.log("enter");

final_link = {};

$('#link_preview').html('');

var link = $('#link').val();

//link = link.replace(/%20/g, "");

//console.log(link);

if (ValidURL(link)) {

// console.log(link);

$('#addbtn').attr('disabled', true);

$.ajax({

url: "https://api.linkpreview.net/",

dataType: 'jsonp',

data: {

q: link,

key: '5b63e209be32fddf20ca99b0ddd9a0e505ed7830ea299'

},

success: function (response) {

// console.log(response);



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

        '<input type="hidden" name="video_link_title" value="'+                           response.title +'"><input type="hidden" name="video_link_description" value="'+ response.description +'"> <input type="hidden" name="video_link_image" value="'+ response.image +'"><div class="partbylist"><div class="row"><div class="col-md-4"><div class="postimgage"><a href="#"><img src="' +

        response.image +

        '" alt="image" class="img-responsive"/></a></div></div><div class="col-md-8"><div class="postallcontss"><h4><a href="#">' +

        response.title + '</a></h4><p>' + response.description +

        '</p></div></div></div></div>';

        //console.log(preview);

    $('#link_preview').html(preview);

    $('#addbtn').attr('disabled', false);

}



}

});



}

else {

//$('#link_preview').html('<div class="alert alert-danger">Invalid Url</div>');

$('#link_preview').html('');

//console.log('in else');

}



}

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


function ValidURL(str) {

//console.log(str);

regexp =

/^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;

if (regexp.test(str)) {

return true;

} else {

return false;

}

}



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
<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script>CKEDITOR.replace('description');</script>


</style>