<?php
/**
 * Created by PhpStorm.
 * User: sunil
 * Date: 02-02-2018
 * Time: 05:55 PM
 */

$user_details = $this->session->userdata('logged_in');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-3">
        <h1>
            User Profile
        </h1>
        </div>
        <div class="col-md-3" style="margin-top: 25px;">
            <button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-success">Change Password</button>
        </div>
    </div>
        
        
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
           
            <!-- /.col -->
            <div class="col-md-<?php echo ($user_details->user_role==1)?'12':'8';?>">
                <div class="box box-primary">
         

                        <div class="box-body" id="settings">
                            <?php $attributes = array('class' => 'form-horizontal1'); echo form_open_multipart(current_url(),$attributes); ?>
                            
                            <div class="row clearfix">    

                                    <div class="col-md-4">
                                        <label for="first_name" class="control-label">First Name</label>
                                        <div class="form-group">
                                            <input type="text" name="first_name" value="<?php echo$user->first_name; ?>" class="form-control" id="first_name" />
                                            <span class="text-danger"><?php echo form_error('first_name');?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="last_name" class="control-label">Last Name</label>
                                        <div class="form-group">
                                            <input type="text" name="last_name" value="<?php echo$user->last_name; ?>" class="form-control" id="last_name" />
                                            <span class="text-danger"><?php echo form_error('last_name');?></span>
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <label for="email" class="control-label">Email</label>
                                        <div class="form-group">
                                            <input type="text" name="email" value="<?php echo$user->email; ?>" class="form-control" id="email" />
                                            <span class="text-danger"><?php echo form_error('email');?></span>
                                            <input type="hidden" name="old_email" value="<?php echo$user->email; ?>">
                                        </div>
                                    </div>

                            </div>
                            <div class="row clearfix">     

                                

                                <div class="col-md-4">
                                    <label for="phone" class="control-label">Phone</label>
                                    <div class="form-group">
                                        <input type="number" name="phone" value="<?php echo$user->phone; ?>" class="form-control" id="phone" />
                                        <span class="text-danger"><?php echo form_error('phone');?></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="address" class="control-label">Address</label>
                                    <div class="form-group">
                                        <input type="text" name="address" value="<?php echo$user->address; ?>" onFocus="geolocate()" class="form-control" id="address" />
                                        <span class="text-danger"><?php echo form_error('address');?></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="region" class="control-label">Region</label>
                                    <div class="form-group">
                                        <input type="text" name="region" value="<?php echo$user->region; ?>" class="form-control" id="region" />
                                        <span class="text-danger"><?php echo form_error('region');?></span>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row clearfix">     

                                

                                <div class="col-md-4">
                                    <label for="city" class="control-label">City</label>
                                    <div class="form-group">
                                        <input type="text" name="city" value="<?php echo$user->city; ?>" class="form-control" id="city" />
                                        <span class="text-danger"><?php echo form_error('city');?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="state" class="control-label">State</label>
                                    <div class="form-group">
                                        <input type="text" name="state" value="<?php echo$user->state; ?>" class="form-control" id="state" />
                                        <span class="text-danger"><?php echo form_error('state');?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="country" class="control-label">Country</label>
                                    <div class="form-group">
                                        <input type="text" name="country" value="<?php echo$user->country; ?>" class="form-control" id="country" />
                                        <span class="text-danger"><?php echo form_error('country');?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <label for="postal_code" class="control-label">Postal Code</label>
                                    <div class="form-group">
                                        <input type="text" name="postal_code" value="<?php echo$user->postal_code; ?>" class="form-control" id="postal_code" />
                                        <span class="text-danger"><?php echo form_error('postal_code');?></span>
                                    </div>
                                </div>
                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lng" id="lng">
                                <div class="col-md-4">
                                    <label for="userfile" class="control-label"><span class="text-danger">*</span>Image</label>
                                    <div class="form-group">
                                        <input type="file" name="userfile"  class="form-control"  id="userfile" />
                                        
                                    </div> 
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="category" class="control-label">Category</label>
                                    <div class="form-group">
                                        <input type="text" value="<?php echo $user->category_name;?>"  readonly class="form-control" />
                                        
                                    </div> 
                                </div>
                                
                                
                            </div>
                            <div class="box-footer">
                                <div id="submit"> </div>
                                <button type="button" class="btn btn-warning edt ">Edit Profile</button>
                            </div>
                            <?php echo form_close(); ?>
                            
                        </div>
                        <!-- /.tab-pane -->
                    
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <?php if($user_details->user_role !=1){?>
            <div class="col-md-4">

                <?php 
                    if(count($certificate)){
                ?>
              <div class="box box-widget widget-user-2">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa  fa-check-circle-o"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text"><h4><strong>Certified</strong></h4></span>
                      <span class="info-box-number"><a href="<?php echo base_url('users/client_documents/').$user_details->id;?>" class="btn btn-info btn-xs"><i class="fa fa-search"></i> View Documents</a></span>
                    </div>
                <!-- /.info-box-content -->
                </div>
              </div>
              <?php 
                }else{
              ?>


                <div class="box box-widget widget-user-2">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa  fa-times"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text"><h4><strong>Not Certified</strong></h4></span>
                      
                    </div>
                <!-- /.info-box-content -->
                </div>
              </div>

              <?php 
                }
              ?>


              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div id="photo_container">
                </div>
                <div class="box-footer">
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#photo-upload">
                    Add More Images
                  </button>
                </div>
              </div>
              <!-- /.widget-user -->
            </div>
            <?php } ?>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="photo-upload">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close drop_hide" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload New Photos</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url().'users/dropzone_upload';?>" class="dropzone"></form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left drop_hide" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary drop_hide" data-dismiss="modal">See Changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change Password</h4>
              </div>
              <div class="modal-body">
                      <div id="msgshowhide">
                          <div id="msg" class="alert"></div>
                      </div>
                      <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd">
                      </div>
                      <div class="form-group">
                        <label for="pwd">Confirm Password:</label>
                        <input type="password" class="form-control" id="confpwd">
                      </div>
                      
                   
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="chngpass" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


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

        load_photos();

        $('.drop_hide').click(function(){
            load_photos();
        });
    });

    $(document).ready(function(){
        $(".del").click(function(){
            if (!confirm("Do you want to delete")){
                return false;
            }
        });
    });


    function load_photos(){
        $('#photo_container').html('<span></span>');
        $.get('<?php echo base_url();?>users/load_photos')
        .done(function(data){
            var response = JSON.parse(data);
            response.forEach(function(elem){
                var verified_text = '';
                var verified_sec = '';
                var delete_photo = '';
                if(elem.verified == 1){
                    verified_sec = '<span class="fa fa-check-circle verified"></span>';
                    verified_text = '<small><strong>(<i class="fa fa-check"></i> Verified)</strong></small>';
                }else{
                    delete_photo = '<span class="box-tools pull-right delete-photo"><button type="button" title="Delete" class="btn btn-box-tool del" onclick="delete_photo('+elem.id+')"><i class="fa fa-times"></i></button></span>';
                }
                $('#photo_container').append('<div class="info-box">'+verified_sec+'<img class="info-box-icon img-circle" src="<?php echo base_url();?>uploads/gallery/'+elem.file_name+'"><div class="info-box-content"><span class="info-box-text"><strong>Date:</strong> '+elem.timestamp.substr(0,10)+' '+verified_text+'</span><span><strong>Comment:</strong> <br>'+elem.comment+'</span>'+delete_photo+'</div></div>');
            })
        })
    }




    function delete_photo(id){
        if(id){
            if(confirm("Are you sure?")){
                $.post('<?php echo base_url();?>users/delete_photo',{id:id})
                .done(function(data){
                    if(data){
                        load_photos();
                    }
                })
            }
        }
    }





  
    $(".edt").click(function () {
        //var country =$('#popcountry').html();
    $("#submit").html('<button type="submit" class="btn btn-success">Update</button>');
    });


    // $(function(){
    //         //initMap();
    //         $("#address").geocomplete();
        
    //     });


    // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

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
        console.log(place.geometry);

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

    #submit{ float:left;
             margin-right:10px
         }
    .info-box{
        margin-bottom: 2px;
        position: relative;
    }
    .delete-photo{
        position: absolute;
        top:5px;
        right: 5px;
    }

    .verified{
        left: 75px;
        top: 0;
        font-size: 15px;
        position: absolute;
        color:#80ffff;
    }
    
</style>


<script type="text/javascript">
    $('#msgshowhide').hide();
    $('#msg').html('');
    $('#chngpass').click(()=>{
        let password = $('#pwd').val();
        let confPassword = $('#confpwd').val();
        if(password !== confPassword){
            $('#msg').html('Password did not match');
            $('#msg').addClass('alert-danger');
            $('#msgshowhide').slideDown();
            return;
        }
        $('#msg').html('');
        $('#msgshowhide').slideUp();
        $('#msg').removeClass('alert-danger');
        

        $.post('<?php echo base_url('users/auth/changepassword')?>',{password: password})
        .done((data)=>{
            if(data.trim() == 1){
                $('#pwd').val('');
                $('#confpwd').val('');
                $('#msg').html('Password changed successfully');
                $('#msg').addClass('alert-success');
                $('#msgshowhide').slideDown();
                setTimeout(function(){
                    $('#modal-default').modal('hide');
                }, 2000);
                
            }else{
                $('#msg').html('Error Occured');
                $('#msg').addClass('alert-danger');
                $('#msgshowhide').slideDown();
            }
        });
    });
</script>