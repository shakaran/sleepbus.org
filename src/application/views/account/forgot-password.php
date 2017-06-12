<div class="sign-up">
  <div class="container">
   <?php echo $page_heading[0]['page_heading'];?>
    <div class="sign-up-box">
      <div class="sign-up-box-in" id="forgotfrom">  
      
		<?php
     	 echo form_open(base_url().'forgot-password',$attributes['form']);
         echo form_hidden('caller','Send');
         ?>
		<div id="errorDiv" style="height:30px; <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline; <?php }?>"><?php echo validation_errors("<p style='color:#e60000;'>","</p>"); ?></div>        
        <div class="birthdayinputname">
          <?php echo form_input($attributes['email']);?>
        </div>
        <div class="birthdayinputname2">
        <?php
         echo form_submit($attributes['submit']);
   	    ?>
        </div>
        
        <?php
         echo form_close();
		?>
      </div>
    </div>
  </div>
</div>