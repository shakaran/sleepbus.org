          <div style="padding:25px;">
           <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
            <div class="main_heading" style="padding-bottom:25px;">
            <?php
			echo $form_title." User";
			?>
            </div>
           
			<div id="input_text">
             <table style="margin-top: -22px" border="0">
             <?php
              echo form_open(base_url().admin.'/user/'.$attribute['called_by'],$attribute['form']);
			  if(!isset($user_id) or ($user_id !='1' and $attribute['called_by'] !="validateaccountinfo"))
			  {
			   ?>
               <tr height="25" valign="bottom">
                <td>
                 *Select Level :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_dropdown('level_id',$attribute['level_id'],$attribute['selected_level_id'],"class='select_action' style='width:185px;' id='level_id'");?>&nbsp;<span id="error5" class="error2"><?php echo form_error('level_id');?></span>
                </td>
               </tr>
			   <?php
			  }
	         
			  if(isset($user_id) and !empty($user_id))
			  {
			   ?>
                <tr height="25" valign="bottom">
                 <td>
                  USERNAME: <span style="font-size:12px; color:#000000;"><?=$attribute['username']['value']?></span>
                  <input type="hidden" name="uname" value="<?=$attribute['username']['value']?>" />
                  <input type="hidden" name="user_id" id="user_id" value="<?=$user_id?>" />
                  <input type="hidden" name="called_by" id="called_by" value="<?=$attribute['called_by']?>" />
                  </td>
                 </tr>
			   <?php
			  }
			  else
			  {
			   ?>
                <tr height="25" valign="bottom">
                 <td>*Username<br /><span class="remarks">*Maximum 15 chars</span></td>
                </tr>
                <tr>
                 <td>
                  <?php
                   echo form_input($attribute['username']);
				  ?>
                  &nbsp;
				  <?php
                   echo form_input($attribute['limit1']);
				  ?>
                  <span id="error1" class="error2"><?php echo form_error('uname');?></span>
                 </td>
                </tr>
                <?php
			   }
			   ?> 
               <tr height="25" valign="bottom">
                <td>
                 <?php
				  if(isset($username)) echo "New Password";
				  else echo "*Password";
				 ?> 
                 <br /><span class="remarks">*Minimum 10 chars and combination of upper, lower, digit and special characters . </span>
                </td>
               </tr>
               <tr>
                <td align="left">
                 <?php echo form_password($attribute['password']);?>
                 &nbsp;<span id="error2" class="error2"><?php echo form_error('pword');?></span>
                </td>
               </tr>
               <tr height="25" valign="bottom">
                <td>
                 <?php
	  	         if(isset($username)) echo "Confirm Password";
				 else echo "*Confirm Password";
				 ?> 
                </td>
               </tr>                      
               <tr>
                <td align="left">
                 <?php
                  echo form_password($attribute['confirm_password']);
				 ?>&nbsp;<span id="error3" class="error2"><?php echo form_error('confirm_password');?></span>
                </td>
               </tr> 
               <tr height="25" valign="bottom"><td>*Email</td></tr>
               <tr>
                <td>
                 <?php
                   echo form_input($attribute['email']);
				  ?>
                  &nbsp;<span id="error4" class="error2"><?php echo form_error('email');?></span>
                </td>
               </tr>                                                                         
               <tr height="25" valign="bottom"><td>First Name</td></tr>
                <tr>
                 <td>
                   <?php
                   echo form_input($attribute['fname']);
				  ?>
                 </td>
                </tr>
                <tr height="25" valign="bottom"><td>Last Name</td></tr>
                 <tr>
                  <td>
                 <?php
                   echo form_input($attribute['lname']);
				  ?>
                  </td>
                 </tr>                      
                 <tr>
                  <td align="left">
                   <div style="width: 250px; text-align: right;">
                    <br />
                     <?php
	  			      echo form_submit($attribute['submit']);
					 ?>      
                    </div>
                   </td>
                  </tr>
                 <?php
                  echo form_close();
				 ?>
                </table>
               </div>           
          
              <div class="clearfix"></div>
           
           
          </div>
