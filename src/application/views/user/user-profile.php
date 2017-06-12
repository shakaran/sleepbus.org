<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 profilemain">
   <div class="container"><h1><span class="h1arrow"><img src="<?php echo base_url();?>images/h1arrow.png" alt=""> </span>Update profile</h1>
    <div class="row">
    
    <?php
     echo form_open(base_url().'user/profile',$attributes['form']);
     echo form_hidden('caller','Send');
    ?>
	     
       <?php
       $this->load->view('user/left-menu');
	  ?>
      <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 profileright">
      <div id="errorDiv" style="height:30px; <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline; <?php }?>"><?php echo validation_errors("<p style='color:#e60000;'>","</p>"); ?></div>
       <div class="row" id="profilefrom">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
          <label for="usr">Full name</label>
          <?php echo form_input($attributes['full_name']);?>
        </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
          <label for="usr">Phone number</label>
          <?php echo form_input($attributes['phone']);?>
        </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mrtop5">
          <div class="form-group">
          <label for="usr">Current email address</label>
          <?php echo form_input($attributes['email']);?>
        </div>
        </div>
   	
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
          <label for="usr">New email address</label>
          <?php echo form_input($attributes['new_email']);?>
        </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
          <label for="usr">Email address confirmation</label>
          <?php echo form_input($attributes['retype_email']);?>
        </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mrtop5">
          <div class="form-group">
          <label for="usr">Current password</label>
          <?php echo form_password($attributes['current_password']);?>
        </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
          <label for="usr">New password</label>
          <?php echo form_password($attributes['new_password']);?>
        </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
          <label for="usr">Password confirmation</label>
          <?php echo form_password($attributes['retype_password']);?>
        </div>
        </div>
        <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mrtop5b">
          <div class="form-group">
          <label for="usr">Copy and share this URL with your friends to raise funds for sleepbus</label>
          <input type="text" id="usr" class="form-control" placeholder="https://www.sleepbus.org/simonrowe">
        </div>
        </div>-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mrtop5b">
        <?php echo form_submit($attributes['submit']);?>
        </div>
       
       <?php
        echo form_close();
	   ?>
       </div> 
       
      </div>
    </div>  
   </div>
</div>