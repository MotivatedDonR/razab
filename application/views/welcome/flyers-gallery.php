<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lightbox/simplelightbox.min.css"><!-- 
  <script type="text/javascript" src="<?php echo base_url();?>assets/themes/default/js/jquery.min.js"></script> -->
  <script type="text/javascript" src="<?php echo base_url();?>assets/lightbox/simple-lightbox.js"></script>


  <title></title>
</head>
<body>

<div class="gallery">
  <ul>
    <?php 
      foreach ($gallery as $image) {
    
    ?>
    <li>
      <a href="<?php echo base_url('uploads/flyers/').$image;?>"><img src="<?php echo base_url('uploads/flyers/').$image;?>" height="250" width="250"/></a>
    </li>
    <?php 
  }
    ?>
  </ul>
</div>


</body>
<script>
  jQuery(function(){
    var $gallery = jQuery('.gallery a').simpleLightbox();

    $gallery.on('show.simplelightbox', function(){
      console.log('Requested for showing');
    })
    .on('shown.simplelightbox', function(){
      console.log('Shown');
    })
    .on('close.simplelightbox', function(){
      console.log('Requested for closing');
    })
    .on('closed.simplelightbox', function(){
      console.log('Closed');
    })
    .on('change.simplelightbox', function(){
      console.log('Requested for change');
    })
    .on('next.simplelightbox', function(){
      console.log('Requested for next');
    })
    .on('prev.simplelightbox', function(){
      console.log('Requested for prev');
    })
    .on('nextImageLoaded.simplelightbox', function(){
      console.log('Next image loaded');
    })
    .on('prevImageLoaded.simplelightbox', function(){
      console.log('Prev image loaded');
    })
    .on('changed.simplelightbox', function(){
      console.log('Image changed');
    })
    .on('nextDone.simplelightbox', function(){
      console.log('Image changed to next');
    })
    .on('prevDone.simplelightbox', function(){
      console.log('Image changed to prev');
    })
    .on('error.simplelightbox', function(e){
      console.log('No image found, go to the next/prev');
      console.log(e);
    });
  });
</script>
<style type="text/css">
  .gallery ul{
    margin: 0px;
    padding: 0px;
  }
  .gallery ul li{
    list-style: none;
    display: inline-block;
    margin: 5px;
    border: 1px solid #000;
  }
</style>
</html>