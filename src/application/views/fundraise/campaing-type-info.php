  <?php
   if(!empty($campign_type))
   {
    if(count($attributes['campaign_images']) > 0)
	{
	?>
    <h2>Choose a campaign photo</h2>
    
     <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     
     <?php
      foreach($attributes['campaign_images'] as $image)
	  {
	   ?>
	   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
         <div class="row">
         	<div class="campaignimgbox"><img src="<?php echo base_url();?>images/campaign/<?php echo $image['image_file'];?>" alt="<?php echo $image['image_title'];?>"></div>
            <div class="campaigcheck">
            <?php
             echo form_radio($attributes['campaign_image_'.$image['id']]);
			?>
            
            <label for="<?php echo 'campaign_image_'.$image['id'];?>"><span></span>Select this photo</label> 
           </div>
         </div>
         </div>
	   <?php
	  }
	 ?>
      </div>    
    </div>
    <?php
   }
   if(!empty($attributes['campaign_details']['mission_statement']))
   {
    ?>
	<div class="missionstatementheading">Share why you want to provide safe sleeps</div>  
	 <div class="missionstatementtext"><?php
      echo form_textarea($attributes['statement']);
	 ?>
    </div>
	<?php
   }
   ?>

   

  <?php
  }
  ?>  
  
  
           