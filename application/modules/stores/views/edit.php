<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Store
        <small>Fill up the form bellow</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Stores</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Store Edit</h3>
            </div>
            <?php echo form_open(current_url()); ?>
            <div class="box-body">
                <div class="row clearfix">

                    <div class="col-md-6">
                        <label for="name" class="control-label"><span class="text-danger">*</span>Name</label>
                        <div class="form-group">
                            <input type="text" name="name" value="<?php echo $store->name; ?>" class="form-control" id="name" />
                            <span class="text-danger"><?php echo form_error('name');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="address" class="control-label"><span class="text-danger">*</span>Address</label>
                        <div class="form-group">
                            <input type="text" name="address" value="<?php echo $store->address; ?>" class="form-control"  onFocus="geolocate()" id="address" />
                            <span class="text-danger"><?php echo form_error('address');?></span>
                            
                        </div>
                    </div>
                     <div class="col-md-6">
                        <label for="region" class="control-label"><span class="text-danger">*</span>Region</label>
                        <div class="form-group">
                            <input type="text" name="region" value="<?php echo $store->region; ?>" class="form-control" id="region" />
                            <span class="text-danger"><?php echo form_error('region');?></span>
                            
                        </div>
                    </div>
                     <div class="col-md-6">
                        <label for="city" class="control-label"><span class="text-danger">*</span>City</label>
                        <div class="form-group">
                            <input type="text" name="city" value="<?php echo $store->city; ?>" class="form-control" id="city" />
                            <span class="text-danger"><?php echo form_error('city');?></span>
                            
                        </div>
                    </div>
                     <div class="col-md-6">
                        <label for="state" class="control-label"><span class="text-danger">*</span>State</label>
                        <div class="form-group">
                            <input type="text" name="state" value="<?php echo $store->state; ?>" class="form-control" id="state" />
                            <span class="text-danger"><?php echo form_error('state');?></span>
                            
                        </div>
                    </div>
                     <div class="col-md-6">
                        <label for="country" class="control-label"><span class="text-danger">*</span>Country</label>
                        <div class="form-group">
                            <input type="text" name="country" value="<?php echo $store->country; ?>" class="form-control" id="country" />
                            <span class="text-danger"><?php echo form_error('country');?></span>
                            
                        </div>
                    </div>
                     <div class="col-md-6">
                        <label for="postal_code" class="control-label"><span class="text-danger">*</span>Postal Code</label>
                        <div class="form-group">
                            <input type="text" name="postal_code" value="<?php echo $store->postal_code; ?>" class="form-control" id="postal_code" />
                            <span class="text-danger"><?php echo form_error('postal_code');?></span>
                            
                        </div>
                    </div>
                      <div class="col-md-6">
                        <label for="manager_name" class="control-label"><span class="text-danger">*</span>Manager Name</label>
                        <div class="form-group">
                            <input type="text" name="manager_name" value="<?php echo $store->manager_name; ?>" class="form-control" id="manager_name" />
                            <span class="text-danger"><?php echo form_error('manager_name');?></span>
                            
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="web_link" class="control-label"><span class="text-danger">*</span>Web Link</label>
                        <div class="form-group">
                            <input type="text" name="web_link" value="<?php echo $store->web_link; ?>" class="form-control" id="web_link" />
                            <span class="text-danger"><?php echo form_error('web_link');?></span>
                            
                        </div>
                    </div>
                  
                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lng" id="lng">
                    
                   
                     <div class="col-md-3">
                        <label for="status" class="control-label">Status</label>
                        <div class="form-group">
                        <input type="radio" name="status" class="minimal" value="1" id="status" <?php if($store->status=='1')echo "checked";?>>Active
                        <input type="radio" name="status" class="minimal" value="0" id="status"<?php if($store->status=='0')echo "checked";?>>Inactive
                            
                            <span class="text-danger"><?php echo form_error('status');?></span>
                        </div>
                    </div>
					<div class="col-md-6">
                        <label for="fax" class="control-label"><span class="text-danger">*</span>Fax Number</label>
                        <div class="form-group">
                            <input type="number" name="fax" value="<?php echo $store->fax; ?>" class="form-control" id="fax" />
                            <span class="text-danger"><?php echo form_error('fax');?></span>
                            
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