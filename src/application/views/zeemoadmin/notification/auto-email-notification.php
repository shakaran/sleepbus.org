           <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open_multipart(base_url().admin.'/notification/validateemailmessages',$attributes['form']);
			 ?>
             <div style="color: #636466;font-family: Arial;font-size: 11px;font-weight: bold;text-align: left;padding-top:20px;">
             *Select Notification Type :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_dropdown('page_id',$attributes['page_id'],$page_id,"class='select_action' style='width:325px;' id='page_id' onchange=OpenPageContentForm('".base_url().admin."/notification/setup-email-notification/'+this.value)");?>&nbsp;<span id="error2" class="error2"><?php echo form_error('page_id');?></span>
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
                          <td style="padding-top:10px;padding-bottom:5px;">
                           *Subject&nbsp;<span class="error1" id="error3"><?php echo form_error('subject'); ?></span>
               			  </td>
                         </tr>
                         <tr>
                          <td colspan="4" align="left">
                           <?php echo form_input($attributes['subject']); ?>  
                		  </td>
                         </tr>
                         <tr>
                          <td style="padding-top:10px;padding-bottom:5px;">
                           *Sender Email Id&nbsp;<span class="error1" id="error4"><?php echo form_error('sender_email'); ?></span>
               			  </td>
                         </tr>
                         <tr>
                          <td colspan="4" align="left">
                           <?php echo form_input($attributes['sender_email']); ?>  
                		  </td>
                         </tr>

                         <tr>
                          <td style="padding-top:10px;padding-bottom:5px;">
                           *Message&nbsp;<span class="remarks" style="background-color:#FFA;color:#3F3F3F;padding:2px;">(Please don't change any text expressions written in the form [[abc]]. e.g [[USERNAME]] )</span><span class="error1" id="error1"><?php echo form_error('message'); ?></span>
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
                       		 <div class="success">Please select a page</div>
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
