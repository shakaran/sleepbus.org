<div class="sign-up">
<?php
 echo form_open(base_url().'fundraise/'.$campaign_details['url'],$attributes['form']);
 echo form_hidden('caller','Send');
?>
 <input type="hidden" name="unit_fund" value="<?php echo $common_settings['unit_fund'];?>" id="unit_fund"  />
  <div class="letgo">
    <h1><?php echo $page_heading[1]['page_heading'];?></h1>
    
<div id="errorDiv" style="height:30px; <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline; <?php }?>"><?php echo validation_errors("<p style='color:#e60000;height:0px;'>","</p>"); ?></div>    
        <div class="form-group" id="campaignfrom">
        
        
          <label for="usr">Campaign name</label>
          <?php echo form_input($attributes['campaign_name']);?>
          <div class="char-count"><?php echo form_input($attributes['limit2']);?><span class="remarks">Max. 80 characters.</span></div>
        </div>
        <div class="form-group">
          <label for="usr">Campaign goal</label>
        <div class="birthdayinputname positionrelative">
      <div class="dollar2">$</div>
      <?php echo form_input($attributes['campaign_goal']);?>
      <div class="aud2">AUD</div>
     </div>
     <div class="peoplebox"><span id="people-no">10</span> people will get
a safe night’s sleep</div>
        </div>
	           
 </div>
 <div class="clearboth"></div>


<div class="campaignphoto">

  <div id="campaign_info">

  <?php
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
   ?>
	<div class="missionstatementheading">Share why you want to provide safe sleeps</div>  
	 <div class="missionstatementtext"><?php
      echo form_textarea($attributes['statement']);
	 ?>
    </div>

   


  
             </div>  

  

           

  </div>
    



        
 
  <div class="clearboth"></div>
  
  <div class="campaignphoto">
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ct"> <?php echo form_submit($attributes['submit']);?></div> 
  </div>
  <?php
   echo form_close();
  ?>	
</div>