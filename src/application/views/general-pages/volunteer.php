<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="container">
    <div class="row">
       <div class="contact" >
	<?php
 	 echo form_open(base_url().'volunteer',$volunteer_attributes['form']);
     echo form_hidden('caller','Send');	 
	?>  
<div id="errorDiv" style="height:30px; <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline; <?php }?>"><?php echo validation_errors("<p style='color:#e60000;'>","</p>"); ?></div>
       

<h1>Volunteer</h1>

<p><b>Keep up to date with the latest volunteering opportunities here.</b></p>

<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
  	<div class="col-md-4 text-center">
				<a href="https://www.facebook.com/sleepbusaustralia" target="_blank"><img src="/images/fb2.png" height=54 style="margin-right:32px;" /></a>
				<a href="https://twitter.com/sleepbus" target="_blank"><img src="/images/twitter-hover.png" height=54 /></a>
		</div>
  	<div class="col-md-4"></div>
	</div>
</div>

<br />

<p><b>Or, sign up to our Volunteers database now.</b></p>



       <div class="contactin" id="form-block">
       <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo form_input($volunteer_attributes['name']); ?></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo form_input($volunteer_attributes['email']); ?></div> 

           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ct"> <?php echo form_submit($volunteer_attributes['submit']); ?></div> 
        </div>   
        
        <?php
        echo form_close();
       ?> 
       </div> 
       </div>
       </div>
    </div>
  </div>         
