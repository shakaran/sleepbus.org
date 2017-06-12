           <div style="padding-bottom:20px;padding-right:20px;">
            <div id="input_text">
			<div class="main_heading" style="padding:30px;font-weight:normal !important;">
             <?php
			 echo "Meta / Title Tags >> ".$submodule_details['module_name']." >> ";
			 echo $section_name;
             ?>
            </div>           
           <div id="submenu" style="margin-left:40px;">
 			<?php
  			if(count($submenus) > 0)
  			{
   			 ?>
    		 <ul>
     		 <?php
	  		 foreach($submenus as $submenu)
	  		 {
	          ?>
	          <li><a title="<?php echo $submenu['name'];?>" href="<?php echo base_url().admin."/metatags/".$submenu['url'];?>" <?php if($submenu['url'] == $section){ echo "class='active'";}?>><span><?php echo $submenu['name'];?></span></a></li>
	          <?php 
	         }
	         ?>
            </ul>
           <?php	   
          }
          ?>
          </div>
        <div style="clear:both"></div>

            <div id="input_text" style="margin-left:40px;">
            
             <?php
              echo form_open(base_url().admin.'/metatags/validateblognotifications',$attributes['form']);
			 ?>
              <table width="98%" border="0" cellpadding="0" cellspacing="0">
                    
                   <tr height="25" valign="bottom">
                    <td align="left"><div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                     Note: <span class="remarks">For more than one email id, please use comma as separater</span>
                    </td>
                   </tr>                                        
                   <tr height="25" valign="bottom">
                    <td align="left">
                     *Notification email to   &nbsp;&nbsp;<span id="error1" class="error1"><?php echo form_error('blog_to_emailid');?></span>
                    </td>
                   </tr>                                        
                   <tr height="25">
                    <td align="left">
                     <?php
                      echo form_input($attributes['blog_to_emailid']);
					 ?>
                    
                    </td>
                   </tr>  
				   <tr height="25" valign="bottom">
                    <td align="left">
                    Notification email cc   &nbsp;&nbsp;<span id="error2" class="error1"><?php echo form_error('blog_cc_emailid');?></span>
                    </td>
                   </tr>                                        
                   <tr height="25">
                    <td align="left">
                     <?php
                      echo form_input($attributes['blog_cc_emailid']);
					 ?>
                    
                      
                    </td>
                   </tr>                    
                  <tr height="25" valign="bottom">
                    <td align="left">
                    Notification email bcc   &nbsp;&nbsp;<span id="error2" class="error1"><?php echo form_error('blog_bcc_emailid');?></span>
                    </td>
                   </tr>                                        
                   <tr height="25">
                    <td align="left">
                     <?php
                      echo form_input($attributes['blog_bcc_emailid']);
					 ?>
                    
                      
                    </td>
                   </tr>    
                  
                  <tr height="50" valign="bottom">
                    <td align="left">
                    <?php
                     echo form_submit($attributes['submit']);
					?>
                    </td>
                   </tr>
                 </table> 
                     <?php
					  echo form_close();
					 ?>  
                    </div>
                   </div>
                  </div> 
