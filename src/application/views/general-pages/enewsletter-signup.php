<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="container">
    <div class="row">
       <div class="contact" >
	<?php
 	 echo form_open(base_url().'enewsletter-signup',$newsletter_attributes['form']);
     echo form_hidden('caller','Send');	 
	?>  
<div id="errorDiv" style="height:30px; <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline; <?php }?>"><?php echo validation_errors("<p style='color:#e60000;'>","</p>"); ?></div>
       
        <?php
         echo $contents['content'];
        ?> 
       <div class="contactin" id="form-block">
       <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo form_input($newsletter_attributes['name']); ?></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo form_input($newsletter_attributes['email']); ?></div> 

           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ct"> <?php echo form_submit($newsletter_attributes['submit']); ?></div> 
        </div>   
        
        <?php
        echo form_close();
       ?> 
       </div> 
       </div>
       </div>
    </div>
  </div>         
