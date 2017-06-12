<div class="index-container">
 <div class="formsection">
  <div align="center">
   <div class="logo"><a href="http://zeemo.com.au/" target="_blank"><img src="<?=base_url()?>images/<?php echo admin;?>/zeemo.png" border="0" alt="Web Design Melbourne, Sydney" title="Web Design Melbourne, Sydney"/></a></div>

  <?php
   echo form_open(base_url().admin.'/login/validate',$attributes['form']);
  ?>
   <div id="wrapper_admin">
    <div id="div_admin_centerpanel">
     <div class="headingwb"><img src="<?=base_url()?>images/<?php echo admin;?>/website-lohin.png" alt="website admin login" title="website admin login" /></div>
     <div class="login_error" id="error_message"><?php echo validation_errors(); ?></div>
     <div class="divInput"><label><?=$captions['username']?></label><br />
      <?php echo form_input($attributes['username']); ?>
     </div><div class="divspacer"></div>
     <div class="divInput"><label><?=$captions['password']?></label><br />
      <?php echo form_password($attributes['password']); ?>
     </div>
     <div class="div_textfields_h1">Login credentials are case sensitive</div>
      <div id="div_textfields_rem">
	  <?php echo form_checkbox($attributes['remember']);?>
      <label for="remember"><?php echo $captions['remember'];?></label>
      <div class="clear"></div>
     </div><div class="clear"></div>
     <div style="padding:10px 0px 10px 0px;">
     <div style="float:left; text-align:left;"><input type="image" name="submit" class="orange" value="submit" src="<?php echo base_url();?>images/<?php echo admin;?>/login.png" ></div>
     <div class="loginfields"><?php echo anchor(base_url().admin.'/forgotpassword', 'Forgot password?');?></div>
    </div>
                 
    <div class="clear"></div>
                  
    <div class="contactno"><img src="<?php echo base_url();?>images/<?php echo admin;?>/callus.png" hspace="5" align="top"><span>Phone Support - 1300 881 594</span></div>
   </div> 
  </div>
   <?php
	echo form_close();
   ?>
 </div>
 <div></div>
 </div>
</div>