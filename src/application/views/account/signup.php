<style>
.field_error{box-shadow: 0px 0px 0px #FFE6D9;border-radius:2px!important; border:red 1px solid!important;}
</style>
<div class="sign-up">
  <div class="container">
  <h1><?php echo $page_heading[0]['page_heading'];?></h1>
  
  <div class="sign-up-box">
		<?php
     		echo form_open(base_url().'signup',$attributes['form']);
            echo form_hidden('caller','Send');
          ?>
  
     <div class="sign-up-box-in" id="signupfrom">
     <div id="errorDiv" style="height:30px; <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline; <?php }?>"><?php echo validation_errors("<p style='color:#e60000;'>","</p>"); ?></div>
       <div class="birthdayinputname"><?php echo form_input($attributes['full_name']);?></div>
       <div class="birthdayinputname"><?php echo form_input($attributes['email']);?></div>
       <div class="birthdayinputname"><div class="showtext" id="toggle-view">Show</div><?php echo form_password($attributes['password']);?></div>
       <p>Account type</p>
       <div class="birthdayinputname">
       <?php echo form_dropdown('account_type',$attributes['account_type'],$attributes['account_type_value'],"id='account_type' class='form-control'");?>
      
      </div>
       <div class="birthdayinputname" id="other_access" <?php if($attributes['account_type_value'] != "other"){?>style="display:none;"<?php }?>><?php echo form_input($attributes['other_type']);?></div>
       <div class="birthdayinputname">
       <div class="singupcheckbox">
       <?php echo form_checkbox($attributes['newsletter_subscription']);?>
       <label for="newsletter_subscription"><span></span>Keep me updated on email</label> 
       </div>
       </div>
<?php /*?>       <div class="birthdayinputname">
       <div class="singupcheckbox">
       <?php echo form_checkbox($attributes['agree']);?>
       <label for="agree"><span></span>I’m over 13 or have parental consent to join</label> 
       </div>
       </div>
<?php */?>
     <div class="birthdayinputname2"><?php echo form_submit($attributes['submit']);?></div>
           </div> 
           
     <?php
      echo form_close();
	 ?>       
  </div>
  </div>

</div>