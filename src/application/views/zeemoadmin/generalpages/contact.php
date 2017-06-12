           <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open(base_url().admin.'/generalpages/validatecontact',$attributes['form']);
			 ?>
              <table style="margin-top: -15px" width="100%" border="0">
                     <tr>
                      <td colspan="2">
                       <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                      </td>
                      
                       
                      </tr>
                      
                       <tr height="25">
                       <td width="50%" valign="top">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                         <tr height="25" valign="bottom">
                          <td>*Address Heading&nbsp;&nbsp;<span class="error1" id="error1"><?php echo form_error('address');?></span></td>
                         </tr>
                         <tr>
                           <td align="left">
                           <?php
						    echo form_textarea($attributes['address']);
                           ?>
                           </td>                         
                         </tr>                        
                        
                        
                         <tr height="25" valign="bottom">
                           <td>Address Details<span class="error1" id="error2"><?php echo form_error('other_details');?></span></td>
                         </tr>
                         <tr>
                           <td align="left">
                           <?php echo form_textarea($attributes['other_details']);?>
                           </td>                         
                         </tr>
                         
                        </table>
                       </td>
                       <td width="50%" valign="top">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        
						<tr height="25" valign="bottom">
                          <td>Content <span class="remarks">(To be displayed above the contact form)</span>
                           &nbsp;&nbsp;<span class="error1" id="error3"><?php echo form_error('form_heading');?></span></td>
                         </tr>
                         <tr>
                           <td align="left">
                           <?php echo form_textarea($attributes['form_heading']);?></td>                         
                         </tr>   
                         <tr height="22">
                           <td>Email 
                           &nbsp;&nbsp;<span class="error1" id="error5"><?php echo form_error('email');?></span></td>
                          </tr>
                          <tr>
                           <td align="left"><?php echo form_input($attributes['email']);?>
                           </td>
                          </tr>                          
                         <tr height="25" valign="bottom">
                           <td>*Head Office Phone &nbsp;&nbsp;<span class="error1" id="error4"><?php echo form_error('phone');?></span></td>
                         </tr>
						 <tr>
                           <td align="left">
                           <?php
                            echo form_input($attributes['phone']);
						   ?>
                           </td>                         
                         </tr>                         
						                          
						 <tr height="20" valign="bottom">
                           <td>*National Phone  &nbsp;&nbsp;<span class="error1" id="error7"><?php echo form_error('phone2');?></span></td>
                         </tr>
						 <tr>
                           <td align="left">
                           <?php
                            echo form_input($attributes['phone2']);
						   ?><div class="remarks">(It will also be displayed on top right)</div>
                           </td>                         
                         </tr>     
						 <tr height="20" valign="bottom">
                           <td>Fax
                           &nbsp;&nbsp;<span class="error1" id="error6"><?php echo form_error('fax');?></span></td>
                          </tr>
                          <tr>
                           <td align="left"><?php echo form_input($attributes['fax']);?>
                           </td>
                          </tr>                         
                        </table>
                       </td>
                      </tr>                                         
                      
                      <tr>
                       <td colspan="2" align="left" style="padding-right: 5px;">
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
