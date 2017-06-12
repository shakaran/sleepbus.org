	<?php
 	 echo form_open(base_url().'one-year-safe-sleep',$attribute['form']);
     echo form_hidden('caller','Send');
    ?>
<div id="errorDiv" style="height:30px; <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline; <?php }?>"><?php echo validation_errors("<p style='color:#e60000;'>","</p>"); ?>
     	  </div>
          <div id="donatefrom"></div>
     <div class="form-group positionrelative">
      <div class="dollar">$</div>
      <?php echo form_input($attribute['amount']);?>
      <div class="aud">AUD</div>
     </div>
     <div class="homelinkbox">
      <?php echo form_input($attribute['submit']);?>
	 </div>
    <?php
     echo form_close();
	?> 
          
