<div class="sign-up">
  <div class="container">
  <h1><?php echo $page_heading[0]['page_heading'];?></h1>
  
  <div class="sign-up-box">
     <div class="sign-up-box-in" id="signinfrom">

		<?php
     		echo form_open(base_url().'signin',$attributes['form']);
            echo form_hidden('caller','Send');
          ?>
		<div id="errorDiv" style="height:30px; <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline; <?php }?>"><?php echo validation_errors("<p style='color:#e60000;'>","</p>"); ?></div>
       <div class="birthdayinputname"><?php echo form_input($attributes['site_username']);?></div>
       <div class="birthdayinputname"><div class="showtext" id="toggle-view">Show</div><?php echo form_password($attributes['site_password']);?></div>
       <div class="birthdayinputname2">
	   <?php
         echo form_submit($attributes['submit']);
   	   ?>
       </div>
       <div class="forgotpassword"><a href="<?php echo base_url();?>forgot-password">Forgot password?</a></div>
          
          
 		<?php
           echo form_close();
		  ?>          
                    
           </div> 
           
     <div class="birthdayinputname3"><a class="btn btn-primary" href="<?php echo base_url();?>signup">Need an account? join now</a></div>       
  </div>
  </div>

</div>