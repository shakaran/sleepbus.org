	<?php
 	 echo form_open(base_url().'donate',$attribute['form']);
     echo form_hidden('caller','Send');
    ?>
<div id="errorDiv" style="height:30px; <?php $errors=validation_errors(); $show_error=form_error('amount'); if(empty($show_error)){?>display:none;<?php } else{?> display:inline;color: #e60000; <?php }?>"><?php echo $show_error; ?>
    </div> 	       
    <div id="donatefrom"></div>
     <div class="form-group positionrelative">
     
 	     
      <div class="dollar2">$</div>
      <?php echo form_input($attribute['amount']);?>
      <div class="aud2">AUD</div>
     </div>
     <div class="dontelinkbox">
     
      <?php echo form_input($attribute['submit']);?>
	 </div>
    <?php
     echo form_close();
	?> 
     