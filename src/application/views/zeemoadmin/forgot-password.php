<div class="index-container">
 <div class="formsection">
  <div class="logo"><a href="http://zeemo.com.au/" target="_blank"><img src="<?=base_url()?>images/<?=admin?>/zeemo.png" border="0" alt="Web Design Melbourne, Sydney" title="Web Design Melbourne, Sydney"/></a></div>
   	<div id="wrapper_admin">
     <div id="div_admin_centerpanel" align="center">
      <div id="div_center">
       <div class="headingwb"><img src="<?=base_url()?>images/<?=admin?>/forgot-password.png" alt="" title="" /></div>
		<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left; color:#03bedf; padding-top:4px; padding-bottom:4px; height:20px;" id="error">	
  		 <?php echo form_error('email');  if(isset($success)) echo $success;?></div>
         <?php  	    if(empty($success))
						{
						 echo form_open(base_url().admin.'/forgotpassword/validate',$attributes['form']);
						 ?>
                         <div class="statictop">
                          <label for="email"><strong>Step 1:</strong> Enter your e-mail address.</label>
                          </span></div>
                        <div class="divInput">
                          <?php
                           echo form_input($attributes['email']);
						  ?>
                        </div>
                        
                    <div style="height:60px; padding:10px; padding-left:0px;">
                          <div style="float:left; text-align:left;"><input type="image" src="<?php echo base_url();?>images/<?=admin?>/submit.png" name="submit" value="submit"></div>
                       <div class="loginfields"><a href="<?php echo base_url().admin."/login";?>" style="padding-right:5px;">Exit Wizard</a></div>
					   <div class="clear"></div>
                       <div class="div_textfields_h1" style="float:left; line-height:18px;"><strong>Step 2:</strong> Once you click Continue, we'll send you an e-mail message containing a validation link.</div>
                    </div>       
                    <div style="margin:10px 0px">                           
                           <div class="div_textfields_h1" style="float:left;  line-height:18px; margin:0px;"><strong>Step 3: </strong>Click on the validation link to come back to the website and setup your new password.</div>
                           
                    </div>
                        <?php
						 echo form_close();
						}
						?>  <div class="clear"></div>
                    
                       
                  </div>
                    <div class="clear"></div>
                  <div class="contactnoforgot"><img src="<?php echo base_url();?>images/<?=admin?>/callus.png" hspace="5" align="top"><span>Phone Support - 1300 881 594</span></div>
                </div>
                </div>
            </form>
        </div>
        <div></div>
    </div>