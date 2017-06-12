           <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open_multipart(base_url().admin.'/notification/email-messages/'.$page_id,$attributes['form']);
			 ?>
             <div style="color: #636466;font-family: Arial;font-size: 11px;font-weight: bold;text-align: left;padding-top:20px;">
             *Select a form :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_dropdown('page_id',$attributes['page_id'],$page_id,"class='select_action' style='width:285px;' id='page_id' onchange=OpenPageContentForm('".base_url().admin."/notification/email-messages/'+this.value)");
			 echo form_hidden('caller','submit');
			 ?>&nbsp;<span id="error7" class="error2"><?php echo form_error('page_id');?></span>
             </div>
              <table width="98%" border="0" cellpadding="0" cellspacing="0">
               <tr>
                <td colspan="4">
                       <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                      </td>
                      
               </tr>
               
    		                          
                      <?php
                       if(!empty($page_id))
					   {
					    ?>
                         <tr>
                          <td width="90%">
                           <table width="100%" style="background-color:#F8FAFA;margin-top:20px;padding-bottom:20px;">
                           <tr>
                            <td style="padding-top:5px;">Sender Information</td>
                           </tr>
                           <tr>
                           
                           <tr>
                            <td style="border-top:thin solid #CCC;border-bottom:thin solid #CCC;padding:5px;background-color:white;">Note: <div class="remarks" style="font-weight:bold;padding:5px;">The sender information for the website has been already set in 'Email Sender Information' section. If you want to set new sender information for this form only then please enter relevant information.</div></td>
                           </tr>
                           <tr>
                           <td style="padding-top:10px;padding-bottom:5px;">
                           Sender Email&nbsp;<span class="remarks">(From):</span><span class="error1" id="error1"><?php echo form_error('sender_email'); ?></span>
               			    </td>
                           </tr>
                           <tr>
                           <td colspan="4" align="left">
                            <?php echo form_input($attributes['sender_email']); ?>  
                		    </td>
                           </tr>
                           <tr>

                           <tr>
                            <td style="padding-top:10px;padding-bottom:5px;">
                            Sender Name&nbsp;<span class="error1" id="error2"><?php echo form_error('sender_name'); ?></span>
               			    </td>
                           </tr>
                           <tr>
                            <td colspan="4" align="left">
                            <?php echo form_input($attributes['sender_name']); ?>  
                		    </td>
                           </tr>
                          </table>
                          </td>
                        </tr>
                        
                        
<tr>
                          <td width="90%">
                           <table width="100%" style="background-color:#F8FAFA;margin-top:20px;padding-bottom:20px;">
                           <tr>
                            <td style="padding-top:5px;">Receiver</td>
                           </tr>
                           <tr>

                           <tr>
                            <td style="padding-top:5px;padding-bottom:10px;"><?php echo form_radio($attributes['receiver_yes']);?> Yes &nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_radio($attributes['receiver_no']);?> No</td>
                           </tr>
                            <tr>
                              <td style="border-top:thin solid #CCC;border-bottom:thin solid #CCC;padding:5px;background-color:white;">Note: <div class="remarks" style="font-weight:bold;padding:5px;"><font color="#000066">Yes</font> : Click on 'Yes', if receiver(s) of the form are fixed.
                            <br />
                            <font color="#000066">No</font> &nbsp;&nbsp;: Click on 'No', if receiver(s) of the form are not fixed. They are visitors or general users.
                            </div></td>
                           </tr>

                            
                           <tr>
                            <td width="100%">
                             <div id="receiver_box" <?php if($receiver == '0'){?> style="display:none;" <?php } ?>>
                             <table width="100%">
                           <tr>
                           <td style="padding-top:10px;padding-bottom:5px;">
                           *Receiver Email Ids&nbsp;<span class="remarks">(For more than one email id, please use comma as separater):</span><span class="error1" id="error3"><?php echo form_error('receiver_to_emails'); ?></span>
               			    </td>
                           </tr>
                           <tr>
                           <td colspan="4" align="left">
                            <?php echo form_textarea($attributes['receiver_to_emails']); ?>  
                		    </td>
                           </tr>
                           
                          <tr>
                           <td style="padding-top:10px;padding-bottom:5px;">
                           CC Email Ids&nbsp;<span class="remarks">(For more than one email id, please use comma as separater):</span><span class="error1" id="error4"><?php echo form_error('receiver_cc_emails'); ?></span>
               			    </td>
                           </tr>
                           <tr>
                           <td colspan="4" align="left">
                            <?php echo form_textarea($attributes['receiver_cc_emails']); ?>  
                		    </td>
                           </tr>
                          <tr>
                           <td style="padding-top:10px;padding-bottom:5px;">
                           BCC Email Ids&nbsp;<span class="remarks">(For more than one email id, please use comma as separater):</span><span class="error1" id="error8"><?php echo form_error('receiver_bcc_emails'); ?></span>
               			    </td>
                           </tr>
                           <tr>
                           <td colspan="4" align="left">
                            <?php echo form_textarea($attributes['receiver_bcc_emails']); ?>  
                		    </td>
                           </tr>
                           <tr>
                          </table>
                          </td>
                        </tr>                        
                           
                           
                          </table>
                          </div>
                         </td>
                         </tr>  
                           
                           
                           <tr>


                         <tr>
                          <td style="padding-top:10px;padding-bottom:5px;">
                           *Subject&nbsp;<span class="error1" id="error5"><?php echo form_error('subject'); ?></span>
               			  </td>
                         </tr>
                         <tr>
                          <td colspan="4" align="left">
                           <?php echo form_input($attributes['subject']); ?>  
                		  </td>
                         </tr>
                         <tr>
                         <tr>


                          <td style="padding-top:10px;padding-bottom:5px;">
                           *Message&nbsp;<span class="remarks" style="background-color:#FFA;color:#3F3F3F;padding:2px;">(Please don't change any text expressions written in the form [[abc]]. e.g [[BODY]] )</span><span class="error1" id="error6"><?php echo form_error('message'); ?></span>
               			  </td>
                         </tr>
                         <tr>
                          <td colspan="4" align="left">
                           <?php echo form_textarea($attributes['message']);
   				       		$this->ckeditor->config['width'] = '700px';
					   		$this->ckeditor->config['height'] = '200px';            
					   		echo $this->ckeditor->replace("message");
		     	 		  ?>  
                		  </td>
                         </tr>
                         <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
                         <?php
						  echo form_submit($attributes['submit']);
                         ?>
                          </td>
                         </tr>
                         <?php
					     }
						 else
						 {
						  ?>
						   <tr>
                			<td colspan="4">
                       		 <div class="success">Please select a form</div>
                      		</td>
               			  </tr>
						  <?php
						 }
						 ?> 
                         <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
                       </td></tr>
                      </table> 
                     <?php
					  echo form_close();
					 ?>  
                    </div>
                   </div>
