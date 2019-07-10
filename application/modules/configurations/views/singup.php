
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Singin Setting
        <small> Singin Setting</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Singin Setting</li>
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

                  <form action="<?php site_url("cur")  ?>" method="post">
                    <div class="row">
                        <div class="col-md-12">
                           <div class="checkbox">
                <?php      

                   $chk =  $value ; ?>
                     <label>
                      <input type="hidden" id="uid" name="uid" value="<?php echo $_GET['uid']; ?>">
                      <input type="checkbox" name="singup" id="signup" value="<?php echo $chk ; ?>"
                        <?php if($chk){echo "checked";} else{

                        } ?>
                        >
                    Check to enable login option 
                    </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript">

        


 

$("#signup").click(function(){
    var value = $("#signup").val();
     var uid = $("#uid").val();
        var x = 'singup/'
        <?php $x =  site_url('configurations/singup/updatebtn'); ?>
      
           
    $.ajax({
            
            url:'<?php echo $x ; ?>',
           type: 'POST',
           data: {value: value, uid: uid},
              dataType: 'json',            
          
           success: function(data) {
                
                alert("Record added successfully");  
           },
            error: function() {
              alert('Button visibilty changed');

           }
        });  
        });

    // $("#search_product").click({  
    //     minLength:0, 
    //      delay:0,    
    //     source:'<?php //echo site_url('index.php/configurations/singup/lookup'); ?>', 
    //       success : function(response){
    //            $('.checkbillno').attr('data-content', response.toolTip);
    //       }
    //     });
    // });

        </script>