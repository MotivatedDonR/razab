<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>My Ads
            <small><a href="<?php echo base_url().'ads/add';?>" class="btn btn-primary btn-sm">Add New</a> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="#">Ads</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Ads Management </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Appointment Details</th>
                        <th>In Live Queue</th>
                        <th>Status</th>                        
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($ads as $ad) {
                        $status_class = 'danger';
                        $status_text = 'Inactive';
                        if ($ad->status){
                            $status_class = 'success';
                            $status_text = 'Active';
                        }
                         
                        ?>
                        <tr>
                            <td><?php echo $ad->adtitle; ?></td>
                            <td>
                                <div class="btn-group btn-group-xs check_date_time in_que"> <button class="btn btn-success">Click </button></div><input type="hidden" value="<?php echo $ad->id;  ?>" >
                            </td>
                            <td>
                                <div class="btn-group btn-group-xs"> <?php if($ad->live_queue_status){ ?><a href="<?php echo base_url().'books/show_live_queue/'.$ad->id;?>" class="btn btn-warning liv_que">View List</a><?php } ?><button class="btn btn-success srt_qu" adid="<?php echo $ad->id; ?>"><?php if(!$ad->live_queue_status){ echo "Start Queue";} else{ echo "Stop Queue";} ?></button></div>
                            </td>
                            <td>
                                <a href="<?php echo base_url().'ads/togglestatus/'.$ad->id;?>"><span class="label label-<?php echo $status_class;?>"><?php echo $status_text?></span></a> 
                            </td>
                            <td>
                                <div class="btn-group btn-group-xs"><a href="<?php echo base_url().'ads/edit/'.$ad->id;?>" class="btn btn-info">Edit</a> <a href="<?php echo base_url().'ads/delete/'.$ad->id;?>" class="btn btn-danger del">Delete</a></div> 
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <?php if($ads){ ?>
                    <input type="text"  style="display:none" value="<?php echo $ad->user_id;?>" id="client_id">
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Appointment Details</th>
                        <th>In Live Queue</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>



<div class="modal fade" id="my_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            <div class="col-md-12">  <h3> Select Date</h3></div>
                <div class="col-md-4">
                    <label for="number" class="control-label">Appointment Date</label>
                    <div class="form-group">
                        
                            <div id="show_date"></div>
                            <div id="varify_date"> </div>
                        
                    </div>
                </div>
                <div class="col-md-4">   
                    <label for="number" class="control-label" id="appointment_label">Appointment Time</label>
                    <div class="form-group">                         
                        <div id="show_time"></div>   
                    </div>                         
                </div>
                <div id="modal_ad_id" style="display:none"></div>
            </div>
            <div class="modal-footer" style="margin-top: 15px;display: block; clear: both;">
                <button type="button" class="btn btn-default cls" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary conf">Enter</button>
                <button type="button" class="btn btn-primary lv_que">Enter Live Queue</button>
            </div>
        </div>
    </div>
</div>


<script>

    // $('#my_modal').on('hidden.bs.modal', function () {
    //         $('.modal-body').find('div').text('');
    // });


    function validation() {

        var show_time = $('#show_date option:selected').val();

        var date_flag = 0;


        if (show_time == '') {
            $('#varify_date').html('<div style="color:red;">Please Select Appointment Date Field...</div>');
        } else {
            date_flag = 1;
            $('#varify_date').html('');
        }

       
        //return
        if (date_flag == 1) {
            return true;            
        }else{
            return false;
        }
    }
    
    

    $(".srt_qu").click(function(){

        //var ad_id =$('#modal_ad_id').text();
        var ad_id = $(this).attr('adid');
        console.log(ad_id);
        //console.log($(this).closest('div'));

           $(this).closest('div').find('.liv_que').toggle();

        // return 
        // $(".liv_que").toggle();

            if ($(this).text() === 'Start Queue') {
                $(this).text('Stop Queue');
            }
            else {
                $(this).text('Start Queue');
            }
        //return
        $.post("<?php echo base_url('books/update_live_queue');?>", {
                ad_id: ad_id
            })
            .done(function (data) {
                //console.log(data);
                location.reload();

            });
        
    });

    $('#example1').DataTable();

    $(document).ready(function(){

        //$(".liv_que").hide();

        $(".del").click(function(){
            if (!confirm("Do you want to delete")){
                return false;
            }
        });
    });
    
    $('.live_que').click(function () {
        $('.conf').hide();
        $('.lv_que').show();
    });

    $('.in_que').click(function () {
        $('.lv_que').hide();
        $('.conf').show();
    });

    $('.conf').click(function () {
       
        if(validation()){
            //in_queue();       
        
            //clear_modal();
            var appo_date = $('#appo_date').find(":selected").text();
            var appo_time = $('#appo_time').find(":selected").text();
            appo_date =appo_date.replace(/\s/g, '');
            //appo_date =appo_date.replace(/[^a-zA-Z0-9]/g,'_');;
            appo_time =appo_time.replace(/^\s+/,"");
            appo_date_time = appo_date + ' ' +appo_time;
            // console.log(appo_date_time);
            // return
            var client_id =$('#client_id').val();
            var ad_id =$('#modal_ad_id').text();
            location.href = "<?php echo base_url('books/index/')?>"+ad_id+'?appo_date_time='+appo_date_time ;
        }
    });

    $('.lv_que').click(function () {
       
       //clear_modal();
       var appo_date = $('#appo_date').find(":selected").text();
       var appo_time = $('#appo_time').find(":selected").text();
       appo_date =appo_date.replace(/\s/g, '');
       //appo_date =appo_date.replace(/[^a-zA-Z0-9]/g,'_');;
       appo_time =appo_time.replace(/^\s+/,"");
       appo_date_time = appo_date + ' ' +appo_time;
       // console.log(appo_date_time);
       // return
       var client_id =$('#client_id').val();
       var ad_id =$('#modal_ad_id').text();
       location.href = "<?php echo base_url('books/show_live_queue/')?>"+ad_id+'?appo_date_time='+appo_date_time ;
   });


    $('.cls').click(function () {
        clear_modal();
    });

    function clear_modal(){
        $('#show_date').html('');
        $('#show_time').html('');
    }

    $('.check_date_time').click(function () {

        $('#my_modal').modal({
            backdrop: 'static',   // This disable for click outside event
            keyboard: true        // This for keyboard event
        })

        var client_id = <?php echo $ad->user_id; ?>;
        var ad_id = $(this).parent().find("input").val();
        
        $('#my_modal').modal('show');
        show_date(client_id,ad_id);
        $('#modal_ad_id').html(ad_id);
        $('#appointment_label').hide();
        
    });

    function show_date(client_id,ad_id){
        
        // console.log(client_id);
        // console.log(ad_id);
        $.post("<?php echo base_url('books/get_date_client');?>", {
                client_id: client_id,
                ad_id: ad_id
            })
            .done(function (data) {
                //console.log(data);
                $('#show_date').append(data);

            });
    }

</script>