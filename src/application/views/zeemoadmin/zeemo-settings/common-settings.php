           <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open_multipart(base_url().admin.'/zeemosettings/validate-settings',$attributes['form']);
			 ?>
             
              <table width="98%" border="0" cellpadding="0" cellspacing="0">
               <tr>
                <atd colspan="4">
                       <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                      </td>
                      
               </tr>
    		                          
                      
                         <tr>
                          <td style="padding-top:10px;padding-bottom:5px;">
                           Google Analytics Code&nbsp;<span class="error1" id="error2"><?php echo form_error('google_analytics_code'); ?></span>
               			  </td>
                         </tr>
                         <tr>
                          <td colspan="4" align="left">
                           <?php echo form_textarea($attributes['google_analytics_code']);
   				       		$this->ckeditor->config['width'] = '700px';
					   		$this->ckeditor->config['height'] = '100px';            
					   		echo $this->ckeditor->replace("google_analytics_code");
		     	 		  ?>  
                		  </td>
                         </tr>
                       
                         <tr>
                          <td style="padding-top:10px;padding-bottom:5px;">
                           Canonical Link&nbsp;<span class="error1" id="error3"><?php echo form_error('canonical_link'); ?></span>
               			  </td>
                         </tr>
                         <tr>
                          <td colspan="4" align="left">
                           <?php echo form_textarea($attributes['canonical_link']);
   				       		$this->ckeditor->config['width'] = '700px';
					   		$this->ckeditor->config['height'] = '100px';            
					   		echo $this->ckeditor->replace("canonical_link");
		     	 		  ?>  
                		  </td>
                         </tr>
                        
                         
                         <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
                         <?php
						  echo form_submit($attributes['submit']);
                         ?>
                          </td>
                         </tr>
                         
                         <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
                       </td></tr>
                      </table> 
                     <?php
					  echo form_close();
					 ?>  
                    </div>
                   </div>
