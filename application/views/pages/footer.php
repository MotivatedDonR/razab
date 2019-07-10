<ul class="list-inline mb-2">
	<?php foreach($pages as $p){?>
  <li class="list-inline-item">
    <a href="<?php echo base_url('page/').$p->permalink;?>"><?php echo $p->title;?></a>
  </li>
		<?php } ?>
  
</ul>