          <div style="padding:5px;">
            <div id="input_text">
           <?php
		    echo form_open(base_url().admin.'/user/validatesuperadmin',$attribute['form']);
           ?>
                	<div style="padding:25px;">
                    
                    <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                    
                    
                    					
                    <div id="input_text">
                     <table  style="margin-top: -22px" border="0">
                      <tr height="25" valign="bottom">
                       <td class="main_heading" style="padding-top:25px;">Change Superadmin Password</td>
                      </tr>  
                      <tr height="25" valign="bottom">
                       <td><a class="link1" href="javascript: AskForNewPassword();">&nbsp;Click here to generate superadmin new password</a></td>
                      </tr>                                         
                      <tr height="25" valign="bottom">
                       <td>
                        *Old Password &nbsp;&nbsp;
                        
                       </td>
                      </tr>                      
                      <tr>
                       <td align="left">
                        <?php echo form_password($attribute['old_password']);?><span id="error1" class="error2"><?php echo form_error('old_password');?></span>
                       </td>
                      </tr>                       
                      <tr height="25" valign="bottom">
                       <td>*New Password<br /><span class="remarks">Minimum 10 chars and combination of upper, lower, digit and special characters.</span>
                       </td>
                      </tr>
                      <tr>
                       <td align="left">
                        <?php echo form_password($attribute['new_password']);?>&nbsp;<span id="error2" class="error2"><?php echo form_error('new_password');?></span>
                       </td>
                      </tr>
                      <tr height="25" valign="bottom"><td>*Confirm Password</td></tr>                      
                      <tr>
                       <td align="left">
                        <?php echo form_password($attribute['confirm_password']);?>&nbsp;<span id="error3" class="error2"><?php echo form_error('confirm_password');?></span>
                       </td>
                      </tr> 
                      <tr>
                       <td align="left">
                        <br />
                        <div style="width: auto; text-align: left;">
                          
                          <?php
                           echo form_submit($attribute['submit']);
						  ?>
                         </div>
                        </td>
                      </tr>
                     </table>
                    </div>
                    </div>
                   <?php
                    echo form_close();
		  	       ?>

                </div>
               </div>