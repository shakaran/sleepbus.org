<div class="birthdaybox">

  <div class="container">
  <?php echo $page_heading[0]['page_heading'];?>

  <div class="birthdayinputbox" id="pledgefrom">
		<?php
     		echo form_open(base_url().'pledge',$attributes['form']);
            echo form_hidden('caller','Send');
          ?>
<div id="errorDiv" style="height:30px; <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline; <?php }?>"><?php echo validation_errors("<p style='color:#e60000;height:0px;'>","</p>"); ?></div>

        <label for="birthday"><span></span>Your Date of Birth </label>  
       <div class="birthdayinputname">
       
        <div class="col-lg-4 col-xs-4 collg1"><?php echo form_input($attributes['day']);?></div>
        <div class="col-lg-4 col-xs-4 collg2"><?php echo form_input($attributes['month']);?></div>
        <div class="col-lg-4 col-xs-4 collg3"><?php echo form_input($attributes['year']);?></div>
       </div>
     <div class="birthdayinputname"><?php echo form_input($attributes['full_name']);?></div>
     <div class="birthdayinputname"><?php echo form_input($attributes['email']);?></div>
     <div class="birthdayinputname">
       <div class="singupcheckbox">
       <?php echo form_checkbox($attributes['newsletter_subscription']);?>
       <label for="newsletter_subscription"><span></span>Keep me updated on email</label> 
       </div>
       </div>
     <div class="birthdayinputname"><?php echo form_submit($attributes['submit']);?></div>
 
    <?php
    echo form_close();
   ?>
  </div>
  
  
  </div>

</div>

 <?php
  echo $top_text['content'];
 ?>