<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="container">
    <div class="row">
       <div class="funding">
        <?php
         echo $top_text['content'];
		?>
        
       </div>
       </div>
    </div>
  </div>
  <?php
   if(count($all_projects) > 0)
   {
	?>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 completedmainbox">
     <div class="row">
     <?php   
     foreach($all_projects as $project)
	 {
	  ?>
	   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 completedbox">
        <a href="<?php echo base_url().$project['url'];?>">
        <?php
         echo $project['intro_text'];
		?> 
       </a>
      </div>
	  <?php	 
     }
     ?>
	 </div>
    </div>
	<?php 
   }
  ?> 