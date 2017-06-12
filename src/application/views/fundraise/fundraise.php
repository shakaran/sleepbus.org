<div class="sign-up">

<?php

 echo form_open(base_url().'fundraise',$attributes['form']);

 echo form_hidden('caller','Send');

?>

<!-- <input type="hidden" name="unit_fund" value="<?php echo $common_settings['unit_fund'];?>" id="unit_fund"  />-->
<input type="hidden" name="unit_fund" value="27.50" id="unit_fund"  />

  <div class="letgo">

    <?php echo $page_heading[0]['page_heading'];?>

    

<div id="errorDiv" style="height:30px; <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline; <?php }?>"><?php echo validation_errors("<p style='color:#e60000;height:0px;'>","</p>"); ?></div>    

        <div class="form-group" id="campaignfrom">

        

        

          <label for="usr">Campaign name</label>

          <?php echo form_input($attributes['campaign_name']);?>
		  <div class="char-count"> <?php echo form_input($attributes['limit2']);?><span class="remarks">Max. 80 characters.</span></div>
        </div>

        <div class="form-group">

          <label for="usr">Campaign goal</label>

        <div class="birthdayinputname positionrelative">

      <div class="dollar2">$</div>

      <?php echo form_input($attributes['campaign_goal']);?>

      <div class="aud2">AUD</div>

     </div>

     <div class="peoplebox"><span id="people-no">20</span> people will get

a safe night’s sleep</div>

        </div>

	   <div class="form-group">

        

           <div class="birthdayinputname2">

          <label for="usr">Campaign end date</label>
    
        <div class="col-lg-4 col-xs-4 collg1"><?php echo form_input($attributes['day']);?></div>
        <div class="col-lg-4 col-xs-4 collg2"><?php echo form_input($attributes['month']);?></div>
        <div class="col-lg-4 col-xs-4 collg3"><?php echo form_input($attributes['year']);?></div>
</div>
          <?php // echo form_input($attributes['campaign_end_date']);?>

        </div>        

        <div class="form-group">

          <label for="usr">I’m Fundraising</label>

          <?php echo form_dropdown('campaign_type',$attributes['campaign_type'],$attributes['campaign_type_value'],"id='campaign_type' class='form-control' onchange='GetContentTypeInfo()'");?>

        </div>

  </div>

  <div class="clearboth"></div>

  

  <div class="campaignphoto">

  <div id="campaign_info">

  <?php

   if(!empty($attributes['campaign_type_value']))

   {

    ?>

    

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

   if(!empty($attributes['campaign_details']['mission_statement']))

   {

    ?>

	<div class="missionstatementheading">Mission statement</div>  

	 <div class="missionstatementtext"><?php

      echo $attributes['campaign_details']['mission_statement'];

	 ?>

    </div>

	<?php

   }

   ?>



   



  <?php

  }

  ?>  

  </div>  

  

           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ct"> <?php echo form_submit($attributes['submit']);?></div> 

  </div>

  <?php

   echo form_close();

  ?>	

</div>