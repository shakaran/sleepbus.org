          <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open_multipart(base_url().admin.'/campaign/validatesetting',$attributes['form']);
			 ?>
              <table width="98%" border="0" cellpadding="0" cellspacing="0">
               <tr>
                <td colspan="4">
                 <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                </td>
               </tr>
               
               
    		   <tr>
                <td valign="top" align="left" width="55%" style="padding-top:10px;padding-bottom:10px;">
                 <table align="left" width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr height="10">
                   <td align="left" valign="top" colspan="2">
					<?php
					 if(!empty($attributes['current_campaign_logo'])) echo "*Upload Campaign Logo";
                     else echo "*Upload Campaign Logo";
                    ?>	<span class="remarks">(To be displayed on user campaign page)</span>
                    &nbsp;&nbsp;
                    &nbsp;<span class="error1" id="error1"><?php echo form_error('campaign_logo'); ?></span>
                             </td>
                            </tr>
                            <tr height="10">
                             <td align="left" valign="top" width="85%">
                              <?php echo form_upload($attributes['campaign_logo']);
							  ?>
                              <br /><span class="remarks">*Max image size must be 215x215px (width x height)px</span>
                              </td>
                              <td valign="top">
                               
                              </td>
                             </tr>                            
                            </table>
                           </td>
                           <td align="left" valign="top">
                            <table align="left"  width="100%" cellpadding="0" cellspacing="0" border="0">
                             <tr height="10">
                              <td align="left" valign="top"></td>
                             </tr>
                             <tr height="10">
                              <td align="left" valign="top">
                               <?php
							    if(!empty($attributes['current_campaign_logo']))
								{
								 echo "Current Logo<br /><br />";
                                 ?>
								 <img src="<?php echo base_url();?>images/campaign/<?php echo $attributes['current_campaign_logo'];?>" width="215" height="215" />
                                 <?php
                         		 echo form_hidden('current_campaign_logo',$attributes['current_campaign_logo']);
								} 
								?>
                              </td>
                             </tr>                            
                            </table>                          
                           </td>
                         </tr>  
                         
						                         
						 
						                                                      
						                         
<tr>
                <td valign="top" align="left" width="55%" style="padding-top:10px;padding-bottom:10px;">
                 <table align="left" width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr height="10">
                   <td align="left" valign="top" colspan="2">
					<?php
					 if(!empty($attributes['current_common_banner'])) echo "*Upload Common Banner";
                     else echo "*Upload Common Banner";
                    ?>	
                    &nbsp;&nbsp;<span class="remarks">(To be displayed as a default banner if banner has not been uploaded for a campaign type)</span>
                    &nbsp;<span class="error1" id="error2"><?php echo form_error('common_banner'); ?></span>
                             </td>
                            </tr>
                            <tr height="10">
                             <td align="left" valign="top" width="85%">
                              <?php echo form_upload($attributes['common_banner']);
							  ?>
                              <br /><span class="remarks">*Image size must be 1280x475px (width x height)px</span>
                              </td>
                              <td valign="top">
                               
                              </td>
                             </tr>                            
                            </table>
                           </td>
                           <td align="left" valign="top">
                            <table align="left"  width="100%" cellpadding="0" cellspacing="0" border="0">
                             <tr height="10">
                              <td align="left" valign="top"></td>
                             </tr>
                             <tr height="10">
                              <td align="left" valign="top">
                               <?php
							    if(!empty($attributes['current_common_banner']))
								{
								 echo "Current Banner<br /><br />";
                                 ?>
								 <img src="<?php echo base_url();?>images/campaign/<?php echo $attributes['current_common_banner'];?>"  width="350" height="120" />
                             
                                 <?php
                         		 echo form_hidden('current_common_banner',$attributes['current_common_banner']);
								} 
								?>
                              </td>
                             </tr>                            
                            </table>                          
                           </td>
                         </tr>                         
						 
						                                 
                         
                         
                        <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
                         <?php
						  echo form_submit($attributes['submit']);
                         ?>
                       </td></tr>
                       <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
                       </td></tr>
                      </table> 
                     <?php
					  echo form_close();
					 ?>  
                    </div>
                   </div>
