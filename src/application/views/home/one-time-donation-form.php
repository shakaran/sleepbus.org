<?php
//Form for ONE_TIME_DONATION_FORM

 	 echo form_open(base_url().'donation/donate',$attribute['form']);
     echo form_hidden('caller','Send');
    ?>
<div id="errorDiv2" style="height:30px; <?php $errors=validation_errors(); $show_error=form_error('amount'); if(empty($show_error)){?>display:none;<?php } else{?> display:inline;color: #e60000; <?php }?>"><?php echo $show_error; ?>
     	  </div>     
    <div id="donatefrom"></div>
<div class="form-group positionrelative">
<div class="dollar">$</div>
<?php echo form_input($attribute['amount']);?>
<div class="aud">AUD</div>
</div>

<div class="homelinkbox"><?php echo form_input($attribute['submit']);?></div>
<?php
     echo form_close();
	?>