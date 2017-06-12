           <div style="padding:25px;">
            <div id="input_text">
            
              <table width="98%" border="0" cellpadding="0" cellspacing="0">
               <tr>
               <td style="padding-bottom:9px;">
                <span class="main_heading">Donation Details</span>
               </td>
                <td colspan="3">
                  <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                 </td>
               </tr>
               
              </table> 
              <table width="98%" border="0" cellpadding="0" cellspacing="0">
			 <?php
			  if(count($donation_details) > 0)
			   {
				?>          
				
			
				<tr>
				 <td colspan="4" style="padding:3px 0px 5px 3px;background-color:#5685a6;color:#fff;font-weight:bold;font-size:13px;">Donation Information</td>
				</tr>                 
				<tr> 
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Type &nbsp;
				  </td>
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo ucwords(str_replace("-"," ",$donation_details['donation_type']));?>
				  </td>
				  
                  
				<td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Amount &nbsp;
				  </td>
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  $<?php echo $donation_details['paid_amount'];?>
				  </td>                  
                 
			
				
			    </tr> 
				<tr> 
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Date &nbsp;
				  </td>
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $donation_details['donation_date'];?>
				  </td>
				  
                  
				<td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Transaction No. &nbsp;
				  </td>
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $donation_details['transaction_no'];?>
				  </td>                  
                 
			
				
			    </tr>                  

				<tr> 
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Status &nbsp;
				  </td>
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $donation_details['status'];?>
				  </td>
				  
                  
				<td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Payer Email. &nbsp;
				  </td>
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $donation_details['payer_email'];?>
				  </td>                  
                 
			
				
			    </tr> 
				<tr> 
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Donor Name &nbsp;
				  </td>
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $donation_details['donor_name'];?>
				  </td>
				  
                  
				<td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Donated By Registered User. &nbsp;
				  </td>
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php if($donation_details['registered_user_id'] > 0) echo 'Yes'; else echo 'No';?>
				  </td>                  
                 
			
				
			    </tr> 
                
				<?php
                 if(($donation_details['registered_user_id'] > 0) and (count($donation_details['registered_user_details']) > 0))
				 {
				  ?>
                  <tr>
				   <td colspan="4" style="padding:3px 0px 5px 3px;background-color:#5685a6;color:#fff;font-weight:bold;font-size:13px;">Registered User Information</td>
				  </tr>
                  
                  
                  <tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Full Name &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <?php echo $donation_details['registered_user_details']['full_name'];?>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				   Email &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $donation_details['registered_user_details']['email'];?>
				  </td>
                  
                  </tr> 
                                                   
 <tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Phone &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <?php echo $donation_details['registered_user_details']['phone'];?>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Status &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php if($donation_details['registered_user_details']['status'] == "1") echo "<font color='green'><b>Active</b></font>"; else echo "Inactive"; ?>
				  </td>
                  
                  </tr> 
                                           
               <?php
			   }
			   ?>                  
				<?php
                 if(($donation_details['donation_type'] ==  'monthly'))
				 {
				  ?>
                  <tr>
				   <td colspan="4" style="padding:3px 0px 5px 3px;background-color:#5685a6;color:#fff;font-weight:bold;font-size:13px;">Recurring Profile Information</td>
				  </tr>
                  
                  
                  <tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Profile Id &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <?php echo $donation_details['profile_id'];?>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				   Profile Status &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $donation_details['profile_status'];?>
				  </td>
                  
                  </tr> 
                                                   
 <tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Correlation Id &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <?php echo $donation_details['correlation_id'];?>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">&nbsp;
				  </td>
                  
                  </tr> 
                                           
               <?php
			   }
			   ?>                  

                <?php
                 if(($donation_details['donation_type'] == 'campaign') and ($donation_details['campaign_id'] > 0) and (count($donation_details['campaign_details']) > 0))
				 {
				  ?>
                  <tr>
				   <td colspan="4" style="padding:3px 0px 5px 3px;background-color:#5685a6;color:#fff;font-weight:bold;font-size:13px;">Campaign Information</td>
				  </tr>
                  
                  
                  <tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Campaign Name &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <?php echo $donation_details['campaign_details']['campaign_name'];?>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				   Campaign Type &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;<?php  if($donation_details['campaign_details']['campaign_type_id'] == '1'){ ?>background-color:#FC9; <?php }else{?>background-color:#F7F7F7;<?php }?>border:thin solid white;font-weight:normal;">
				  <?php echo $donation_details['campaign_details']['campaign_type'];?>
				  </td>
                  
                  </tr> 
                  
<tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Creation Date &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <?php echo $donation_details['campaign_details']['start_date'];?>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  End Date &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $donation_details['campaign_details']['end_date'];?>
				  </td>
                  
                  </tr>   
<tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Campaign Goal &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   $<?php echo $donation_details['campaign_details']['campaign_goal'];?>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				   Raised Amount &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">$<?php if(empty($donation_details['campaign_details']['raised_amount'])) echo '0'; else echo $donation_details['campaign_details']['raised_amount'];?>
				  </td>
                  
                  </tr> 
<tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Status &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <?php if($donation_details['campaign_details']['status'] == '1') echo '<font color="#66CC00"><b>Active</b></font>'; else 'Inactive';?>
				   </td>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  URL &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <a href="<?php echo  base_url().$donation_details['campaign_details']['url']; ?>" target="_blank"><?php  echo base_url().$donation_details['campaign_details']['url'];?></a>
				   </td>
                  
                  </tr>                   
                  
                  
                  <?php
				 }
			    }
				 ?>
                 
                 
             
            
              <tr style="padding-top:20px;">
               <td align="left" colspan="4"><p><a href="<?php echo base_url().admin?>/donation/reporting"  style="text-decoration:none; color:#5685a6; text-align:left;">
                 <input type="button" value="Go Back"/>
                </a></p>
               </td>
              </tr>
              </table> 
            </div>
           </div>
           
           
           
           
