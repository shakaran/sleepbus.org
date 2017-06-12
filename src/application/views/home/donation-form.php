	<?php
 	 echo form_open(base_url().'donation/donate',$attribute_monthly['form']);
     echo form_hidden('caller2','Send');
    ?>
<div id="errorDiv2" style="height:30px; <?php $errors=validation_errors(); $show_error=form_error('monthly_amount'); if(empty($show_error)){?>display:none;<?php } else{?> display:inline;color: #e60000; <?php }?>"><?php echo $show_error; ?>
     	  </div>     
    <div id="donatemonthlyfrom"></div>
<div class="form-group positionrelative">
<div class="dollar">$</div>
<?php echo form_input($attribute_monthly['monthly_amount']);?>
<div class="aud">AUD/MONTH</div>
</div>

<div class="homelinkbox"><?php echo form_input($attribute_monthly['monthly_submit']);?></div>
<?php
     echo form_close();
	?> 
     