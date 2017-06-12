<div class="sign-up">
  <div class="container">
  <div class="sign-up-box">
 
     <div class="sign-up-box-in donatefrom">
        <div class="toptext2"><?php echo $page_heading[2]['page_heading'];?></div>
        <h1><?php echo $campaign_details['campaign_name'];?></h1>
	<?php
 	 echo form_open(base_url().'donation',$attribute['form']);
     echo form_hidden('caller','Send');
    ?>
   
    <div id="errorDiv" style="height:30px; <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline; <?php }?>"><?php echo validation_errors("<p style='color:#e60000;'>","</p>"); ?>
     	  </div>         
        <div id="donatefrom">&nbsp;</div>
       <div class="birthdayinputname positionrelative">
      <div class="dollar2">$</div>
      <?php echo form_input($attribute['amount']);?>
      <div class="aud2">AUD</div>
     </div>
       <div class="birthdayinputname"><?php echo form_input($attribute['donor_name']);?></div>
       <div class="birthdayinputname"><?php echo form_input($attribute['email']);?></div>
       
       <div class="birthdayinputname"><?php echo form_textarea($attribute['comment']);?></div>
       <div class="birthdayinputname">
       <div class="singupcheckbox">
       <?php echo form_checkbox($attribute['anonymous']);?>
       <label for="anonymous"><span></span>I want to remain anonymous</label> 
       </div>
       </div>
       <div class="dontelinkbox">
       <?php echo form_input($attribute['submit']);?>
<?php /*?>        <a href="#" class="btn btn-primary">Give by <img src="images/card.png" alt=""></a>
        <a href="#" class="btn btn-success">Give by <img src="images/paypal.png" alt=""></a>
<?php */?>       </div>
       
      <?php
       echo form_close();
	  ?> 
           
       
           </div>  
  </div>
  </div>

</div>