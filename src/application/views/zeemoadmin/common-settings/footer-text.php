           <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open(base_url().admin.'/commonsettings/footer-text',$attributes['form']);
			 ?>
              <table width="98%" border="0" cellpadding="0" cellspacing="0">
               <tr>
                <td colspan="4">
                       <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                      </td>
                      
               </tr>
               
    		                          
                         <tr>
                          <td style="padding-top:10px;padding-bottom:5px;">
                          Footer Content&nbsp;<span class="error1" id="error1"><?php echo form_error('content'); ?></span>
               			  </td>
                         </tr>
                         <tr>
                         <td colspan="4" align="left">
                           <?php echo form_textarea($attributes['content']);
   				       		$this->ckeditor->config['width'] = '700px';
					   		$this->ckeditor->config['height'] = '300px';            
					   		echo $this->ckeditor->replace("content_id");
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
