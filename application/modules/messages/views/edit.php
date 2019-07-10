<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit message
        <small>Fill up the form bellow</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">messages</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">message Edit</h3>
            </div>
            <?php echo form_open(current_url()); ?>
            <div class="box-body">
                <div class="row clearfix">

                   
                    <div class="col-md-6">
                        <label for="form_id" class="control-label"><span class="text-danger">*</span>From</label>
                        <div class="form-group">
                            <input type="text" name="form_id" value="<?php echo $message->form_id; ?>" class="form-control" id="form_id" />
                            <span class="text-danger"><?php echo form_error('form_id');?></span>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <label for="to_id" class="control-label"><span class="text-danger">*</span>To</label>
                        <div class="form-group">
                            <input type="text" name="to_id" value="<?php echo $message->to_id; ?>" class="form-control"   id="to_id" />
                            <span class="text-danger"><?php echo form_error('to_id');?></span>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="message" class="control-label"><span class="text-danger">*</span>Message</label>
                        <div class="form-group">
                            <textarea rows="5" name="message"  class="form-control" id="message" /><?php echo $message->message; ?></textarea>
                            <span class="text-danger"><?php echo form_error('message');?></span>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="form_email" class="control-label"><span class="text-danger">*</span>Email</label>
                        <div class="form-group">
                            <input type="email" name="form_email" value="<?php echo $message->form_email; ?>" class="form-control" id="form_email" />
                            <span class="text-danger"><?php echo form_error('form_email');?></span>
                        </div>
                    </div>
                   
                     <div class="col-md-3">
                        <label for="status" class="control-label">Status</label>
                        <div class="form-group">
                        <input type="radio" name="status" class="minimal" value="1" id="status" <?php if($message->status=='1')echo "checked";?>>Active
                        <input type="radio" name="status" class="minimal" value="0" id="status"<?php if($message->status=='0')echo "checked";?>>Inactive
                            
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