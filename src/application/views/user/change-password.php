    <div class="wrapperin">
    <?php
     $this->load->view('user/dashboard-heading');
    ?>

      <div class="advertiser-right">
          <div class="addbusinessheading"><?php echo $page_heading[15]['page_heading'];?></div>
          
          <div class="accountbox2">
		  <?php
            $success_message=$this->session->flashdata('success_message');
            if(!empty($success_message))
			{
		     ?>
			  <div class="success"><?php echo $success_message; ?></div>
			 <?php
			}
		   ?>          
		  <div id="all_error" class="test_form_error" style=" <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline;text-align:left;float:left; <?php }?>"><?php echo validation_errors("<span style='color:#e60000;text-align:left;float:float;'>","<br /></span>"); ?> </div>          
          
		  <?php
     		echo form_open(base_url().$target.'/change-password',$attributes['form']);
            echo form_hidden('caller','Send');
		   ?>           
          
          
          <div class="recipeinput">
              <span>*</span>
              <?php
			   echo form_password($attributes['old_password']);
              ?>
            </div>
          <div class="recipeinput">
              <span>*</span>
              <?php
			   echo form_password($attributes['new_password']);
              ?>
            </div>
          <div class="recipeinput">
              <span>*</span>
              <?php
			   echo form_password($attributes['retype_password']);
              ?>
            </div>
          
          
          </div>
        <div class="accountbox4">          
		<div class="PreviewListingMain">
         <?php echo form_submit($attributes['submit']);?>
          </div>          
        </div>  
          
          
          
      <?php
	   echo form_close();
      ?>  
      </div>
         
         <?php
		  $this->load->view('user/left-menu');
         ?>
 
          
        </div>
