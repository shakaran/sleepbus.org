           <div style="padding:25px;">
            <div id="input_text">
            
              <table width="98%" border="0" cellpadding="0" cellspacing="0">
               <tr>
               <td style="padding-bottom:9px;">
                <span class="main_heading">User Details</span>
               </td>
                <td colspan="3">
                  <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                 </td>
               </tr>
               
              </table> 
              <table width="98%" border="0" cellpadding="0" cellspacing="0">
			 <?php
			  if(count($user_details) > 0)
			   {
				?>          
				
			
				<tr>
				 <td colspan="4" style="padding:3px 0px 5px 3px;background-color:#5685a6;color:#fff;font-weight:bold;font-size:13px;">User Information</td>
				</tr>                 
				<tr> 
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Full Name &nbsp;
				  </td>
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $user_details['full_name'];?>
				  </td>
				  
                  
				<td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Date &nbsp;
				  </td>
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $user_details['signup_date'];?>
				  </td>                  
                 
			
				
			    </tr> 
				<tr> 
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  email &nbsp;
				  </td>
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $user_details['email'];?>
				  </td>
				  
                  
				<td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  phone &nbsp;
				  </td>
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $user_details['phone'];?>
				  </td>                  
                 
			
				
			    </tr>                  
                 
				<tr> 
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Account Type &nbsp;
				  </td>
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php
				  if($user_details['type_name'] != NULL)
				  {
				   echo $user_details['type_name'];
				  }
                  else echo "Other : ".$user_details['other_type']; 
                  ?>
                  </td>
				  
                  
				<td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Status &nbsp;
				  </td>
				 <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php if($user_details['status'] == '1') echo "Active"; else echo "Inactive";?>
				  </td>                  
                 
			
				
			    </tr>                  
                   
			    <?php
			   }
			   if(count($all_campaigns) > 0)
			   {
				$c=1;  
				?>
				<tr>
				 <td colspan="4" style="padding:3px 0px 5px 3px;background-color:#5685a6;color:#fff;font-weight:bold;font-size:13px;">Campaign Information</td>
				</tr>
				<?php 
			    foreach($all_campaigns as $campaigns)
				{
			     ?>
				 <tr>
                  <td style="padding:3px 0px 3px 3px;background-color:#6CF;border:thin solid white;font-weight:bold;color:#009" colspan="4">Campaign <?php echo $c++;?></td>
                 </tr>
				 <?php		
				 foreach($campaigns as $campaign)
				 {
				  ?>	
			       
                  
                  <tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Campaign Name &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <?php echo $campaign['campaign_name'];?>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				   Campaign Type &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;<?php  if($campaign['campaign_type_id'] == '1'){ ?>background-color:#FC9; <?php }else{?>background-color:#F7F7F7;<?php }?>border:thin solid white;font-weight:normal;">
				  <?php echo $campaign['campaign_type'];?>
				  </td>
                  
                  </tr> 
                  
<tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Campaign Creation Date &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <?php echo $campaign['creation_date'];?>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				   Campaign End Date &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $campaign['end_date'];?>
				  </td>
                  
                  </tr>   
<tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Campaign Goal &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   $<?php echo $campaign['campaign_goal'];?>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				   Raised Amount &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">$<?php if(empty($campaign['raised_amount'])) echo '0'; else echo $campaign['raised_amount'];?>
				  </td>
                  
                  </tr> 
<tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Status &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <?php if($campaign['status'] == '1') echo '<font color="#66CC00"><b>Active</b></font>'; else 'Inactive';?>
				   </td>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  URL &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <a href="<?php echo '/campaign/' . $campaign['url']; ?>" target="_blank"><?php echo '/campaign/' . $campaign['url']; ?></a>
				   </td>
                  
                  </tr>                   
                                    
                                  
                  <?php
				 }
				}
			   }
			   if(count($user_campaign_donations) > 0)
			   {
				$c=1;  
				?>
				<tr>
				 <td colspan="4" style="padding:3px 0px 5px 3px;background-color:#5685a6;color:#fff;font-weight:bold;font-size:13px;">User Donations For Campaign</td>
				</tr>
				<?php 
			    foreach($user_campaign_donations as $donation)
				{
			     ?>
				 <tr>
                  <td style="padding:3px 0px 3px 3px;background-color:#6CF;border:thin solid white;font-weight:bold;color:#009" colspan="4">Donation <?php echo $c++;?></td>
                 </tr>
				 
                  
                  <tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Campaign Name &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <?php echo $donation['campaign_name'];?>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				   Campaign URL &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo base_url().$donation['url'];?>
				  </td>
                  
                  </tr> 
                  
<tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Donation Amount &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <b>$<?php echo $donation['total_donation'];?></b>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				   Donation Date &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $donation['donation_date'];?>
				  </td>
                  
                  </tr>   
               
<tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Donor Email &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <?php echo $donation['payer_email'];?>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				   Status &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $donation['status'];?>
				  </td>
                  
                  </tr>                                       
                                  
                  <?php
				 
				}
			   }
			   
			   
			   if(count($user_one_time_donations) > 0)
			   {
				$c=1;  
				?>
				<tr>
				 <td colspan="4" style="padding:3px 0px 5px 3px;background-color:#5685a6;color:#fff;font-weight:bold;font-size:13px;">One Time Donation</td>
				</tr>
				<?php 
			    foreach($user_one_time_donations as $donation)
				{
			     ?>
				 <tr>
                  <td style="padding:3px 0px 3px 3px;background-color:#6CF;border:thin solid white;font-weight:bold;color:#009" colspan="4">Donation <?php echo $c++;?></td>
                 </tr>
				 
                  

                  
				<tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Donation Amount &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <b>$<?php echo $donation['total_donation'];?></b>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				   Donation Date &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $donation['donation_date'];?>
				  </td>
                  
                  </tr>   
               
					<tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Donor Email &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <?php echo $donation['payer_email'];?>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				   Status &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $donation['status'];?>
				  </td>
                  
                  </tr>                                      
                                  
                  <?php
				 
				}
			   }
			   
			   if(count($user_monthly_donations) > 0)
			   {
				$c=1;  
				?>
				<tr>
				 <td colspan="4" style="padding:3px 0px 5px 3px;background-color:#5685a6;color:#fff;font-weight:bold;font-size:13px;">Monthly Donation</td>
				</tr>
				<?php 
			    foreach($user_monthly_donations as $donation)
				{
			     ?>
				 <tr>
                  <td style="padding:3px 0px 3px 3px;background-color:#6CF;border:thin solid white;font-weight:bold;color:#009" colspan="4">Donation <?php echo $c++;?></td>
                 </tr>
				 
                  

                  
				<tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Donation Amount &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <b>$<?php echo $donation['total_donation'];?></b>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				   Recurring Donation Start Date &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $donation['donation_date'];?>
				  </td>
                  
                  </tr>   
               
					<tr>
                   <td height="35" align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				  Donor Email &nbsp;
				   </td>
				   <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				   <?php echo $donation['payer_email'];?>
				   </td>
                   <td align="left" valign="top" style="padding:3px 0px 3px 3px;background-color:#F7F7F7;border:thin solid white;font-weight:bold;">
				   Status &nbsp;
				   </td>
				  <td align="left" valign="top" style="padding:3px 0px 3px 3px;padding-bottom:10px;padding-left:6px;background-color:#F7F7F7;border:thin solid white;font-weight:normal;">
				  <?php echo $donation['status'];?>
				  </td>
                  
                  </tr>                                      
                                  
                  <?php
				 
				}
			   }
			   
			   ?>	              
                 
             
            
              <tr style="padding-top:20px;">
               <td align="left" colspan="4"><p><a href="<?php echo base_url().admin?>/account/manageusers"  style="text-decoration:none; color:#5685a6; text-align:left;">
                 <input type="button" value="Go Back"/>
                </a></p>
               </td>
              </tr>
              </table> 
            </div>
           </div>
           
           
           
           
