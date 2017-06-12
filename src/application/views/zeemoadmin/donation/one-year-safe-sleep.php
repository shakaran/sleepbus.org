           <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open(base_url().admin.'/donation/one-year-safe-sleep',$attributes['form']);
			 ?>
              <table width="98%" border="0" cellpadding="0" cellspacing="0">
               <tr>
                <td colspan="4">
                       <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                      </td>
                      
               </tr>
               
    		                          
                         <tr>
                          <td style="padding-top:10px;">
                           <div style="padding-bottom:5px;">Banner Content&nbsp;&nbsp;<span class="error1" id="error1"><?php echo form_error('content1'); ?></span></div><div class="remarks" style="background-color:#FFA;color:#3F3F3F;padding:0px;">Please don't change any text expressions written in the form [[abc]]. e.g <b>[[ONE_TIME_DONATION_FORM]]</b></div>&nbsp;
               			  </td>
                         </tr>
                         <tr>
                         <td colspan="4" align="left">
                           <?php echo form_textarea($attributes['content1']);
   				       		$this->ckeditor->config['width'] = '700px';
					   		$this->ckeditor->config['height'] = '300px';            
					   		echo $this->ckeditor->replace("content1");
		     	 		  ?>  
                		  </td>
                        </tr>
                          <tr>
                          <td style="padding-top:10px;">
                           <div style="padding-bottom:5px;">Page Content&nbsp;&nbsp;<span class="error1" id="error2"><?php echo form_error('content2'); ?></span></div>&nbsp;
               			  </td>
                         </tr>
                         <tr>
                         <td colspan="4" align="left">
                           <?php echo form_textarea($attributes['content2']);
   				       		$this->ckeditor->config['width'] = '700px';
					   		$this->ckeditor->config['height'] = '300px';            
					   		echo $this->ckeditor->replace("content2");
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
