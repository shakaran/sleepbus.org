          <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open_multipart(base_url().admin.'/commonsettings/validatesetting',$attributes['form']);
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
					 if(!empty($attributes['current_website_logo'])) echo "*Upload Website Logo";
                     else echo "*Upload Website Logo";
                    ?>	
                    &nbsp;&nbsp;
                    &nbsp;<span class="error1" id="error1"><?php echo form_error('website_logo'); ?></span>
                             </td>
                            </tr>
                            <tr height="10">
                             <td align="left" valign="top" width="85%">
                              <?php echo form_upload($attributes['website_logo']);
							  ?>
                              <br /><span class="remarks">*Image size must be 198x48px (width x height)px</span>
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
							    if(!empty($attributes['current_website_logo']))
								{
								 echo "Current Image<br /><br />";
                                 ?>
								 <img src="<?php echo base_url();?>images/common-settings/<?php echo $attributes['current_website_logo'];?>" width="214" height="66" />
                                 <?php
                         		 echo form_hidden('current_website_logo',$attributes['current_website_logo']);
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
					 if(!empty($attributes['current_website_svg_logo'])) echo "*Upload Website SVG Logo";
                     else echo "*Upload Website SVG Logo";
                    ?>	
                    &nbsp;&nbsp;
                    &nbsp;<span class="error1" id="error2"><?php echo form_error('website_svg_logo'); ?></span>
                             </td>
                            </tr>
                            <tr height="10">
                             <td align="left" valign="top" width="85%">
                              <?php echo form_upload($attributes['website_svg_logo']);
							  ?>
                              <!--<br /><span class="remarks">*Image size must be 157x86px (width x height)px</span>-->
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
							    if(!empty($attributes['current_website_svg_logo']))
								{
								 echo "Current Image<br /><br />";
                                 ?>
								 
                                 <object type="image/svg+xml" class="my-svg" data="<?php echo base_url();?>images/common-settings/<?php echo $attributes['current_website_svg_logo'];?>"></object>
                                 <?php
                         		 echo form_hidden('current_website_svg_logo',$attributes['current_website_svg_logo']);
								} 
								?>
                              </td>
                             </tr>                            
                            </table>                          
                           </td>
                         </tr>                         
						 
						                                 
						                         
    		 	  <tr height="25" valign="bottom">
                 <td style="padding-bottom:10px;" colspan="2">*Amount for a safe sleep<span class="remarks">(Set a fund price for a person safe sleep)</span> <span id="error3" class="error2"><?php echo form_error('unit_fund');?></span></td>
                </tr>
                <tr>
                 <td>
                   $<?php
                   echo form_input($attributes['unit_fund']);
				  ?>
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
