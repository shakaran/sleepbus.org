<div class="index-container">
  <div class="formsection">
   	   
        <div align="center">
           <div class="logo"><a href="http://zeemo.com.au/" target="_blank"><img src="<?=base_url()?>images/<?=admin?>/zeemo.png" border="0" alt="Web Design Melbourne, Sydney" title="Web Design Melbourne, Sydney"/></a></div>

        	
            	<div id="wrapper_admin">
                <div id="div_admin_centerpanel" align="center">
                  <div id="div_center">
<div class="headingwb"><img src="<?php echo base_url();?>images/<?=admin?>/forgot-password.png" alt="" title="" /></div>
                    	<div style="font-family:Arial; color:#F3791F; padding-top:4px; font-size:12px; text-align:left;" id="error"><?php if(isset($error_message)){ echo $error_message;} if(isset($common_error)){ echo $common_error;}?></div>
                       <?php
                        if(!isset($error_message))
						{
						 echo form_open(base_url().admin."/forgotpassword/recoveryvalidation",$attributes['form']);
						 echo form_hidden('password_recovery',$password_recovery);
					     ?>  
                         <div class="statictop"><label for="email"><strong>Step 3:</strong> Setup your password.</label>
                         </div>
                        <div class="statictop"><label for="password">Enter Your New Password</label><span id="error1" class="error"><?php echo form_error('password');?></span></div>
                         <div class="divInput">
						 <?php
                          echo form_password($attributes['password']);
						 ?>                           
                        </div>
                        <div class="statictop"><label for="cpassword">Confirm Password</label><span id="error2" class="error"><?php echo form_error('confirm_password');?></span></div>
                         <div class="divInput">
                          <?php
                          echo form_password($attributes['confirm_password']);
						 ?>  
                        </div>
                       

                    <div style="height:40px; padding:10px; padding-left:0px;">
                          <div style="float:left; text-align:left;"><input type="image" src="<?php echo base_url()?>images/<?=admin?>/submit.png" name="submit" value="submit">
                          </div> 
                          <div class="loginfields"><a href="<?php echo base_url().admin;?>/login" style="padding-right:5px;">
Exit Wizard</a></div>
                        <?php
						}
						?>
                      
                    </div>

                  </div>
                    
                  <div class="contactnoforgot"><img src="<?php echo base_url();?>images/<?=admin?>/callus.png" hspace="5" align="top"><span>Phone Support - 1300 881 594</span></div>
                </div> 

                </div>
            </form>
        </div>
        <div></div>
    </div>
</div>