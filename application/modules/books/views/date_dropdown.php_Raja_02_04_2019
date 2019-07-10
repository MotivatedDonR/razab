<select class="form-control select_dt" id="appo_date">
    <option value="" >Select Time</option>
    <?php foreach($dtas as $dta) {?>

    <option value="<?php echo $dta; ?>">
        <?php echo $dta; ?>
    </option>


    <?php } ?>
</select>


<script type="text/javascript">
    $("#appo_date").change(function () {
        var appo_date = $('#appo_date').find(":selected").text();
        //console.log(appo_date);
        show_time(appo_date);
    });



    function show_time(appo_date){
        var client_id = $('#client_id').val();
        var ad_id = $('#ad_id').val();

            

        $.post("<?php echo base_url('books/get_time');?>", {
                client_id: client_id,
                ad_id: ad_id,
                appo_date:appo_date
            })
            .done(function (data) {
                //console.log(data);
                $('#show_time').html('');
                $('#appointment_label').show();
                $('#show_time').append(data);

            });
    }


</script>