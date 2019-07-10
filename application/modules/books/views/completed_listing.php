<div class="content-wrapper">
    <!-- Content Hequeueer (Page hequeueer) -->
    <section class="content-hequeueer">
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-hequeueer">
                <h3 class="box-title"> Completed Guests Listing </h3>
            </div>
            <!-- /.box-hequeueer -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach ($guests_complete as $guest_complete) {
                        $status_class = 'danger';
                        $status_text = 'Inactive';
                        if ($guest_complete->status){
                            $status_class = 'success';
                            $status_text = 'Active';
                        }
                         
                        ?>
                        <tr>
                            <td>
                                <?php echo $guest_complete->booking_person_name; ?>
                            </td>
                            <td>
                                <?php echo $guest_complete->booking_person_email; ?>
                            </td>
                            <td>
                                <?php echo $guest_complete->booking_person_number; ?>
                            </td>
                            <!-- <td><a href="<?php echo base_url().'queues/togglestatus/'.$guest_complete->id;?>"><span class="label label-<?php echo $status_class;?>">
                                        <?php echo $status_text?></span></a> </td>
                             <td><div class="btn-group btn-group-xs"><a href="<?php echo base_url().'queues/edit/'.$queue->id;?>" class="btn btn-info">Edit</a> <a href="<?php echo base_url().'queues/delete/'.$queue->id;?>" class="btn btn-danger del">Delete</a></div> </td> -->
                            <!-- <td> 
                                <div class="checkbox"><label><input type="checkbox" name="mark_as_read" id="mark_as_read"
                                            value="<?php echo $guest_complete->id; ?>"> Completed</label></div>
                            </td> -->
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </tfoot>
                </table>
                <!-- <button type="button" class="btn btn-success compl"> Updated </button> -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>



<script>
    $('#example1').DataTable();

    // $(document).requeuey(function () {
    //     $(".del").click(function () {
    //         if (!confirm("Do you want to delete")) {
    //             return false;
    //         }
    //     });
    // });

    $('.compl').click(function () {
        update_booking_person();
    });

    function update_booking_person() {

        var ids = [];
        $(':checkbox:checked').each(function (i) {
            ids[i] = $(this).val();


        });
        $.post("<?php echo base_url('books/update_guest_list');?>", {
                ids: ids
            })
        .done(function (data) {
            console.log(data);
            if (data == '1') {
                //$('#suc_msg').html('Updated Successfully');
                location.reload();
            }

        });

    }
</script>