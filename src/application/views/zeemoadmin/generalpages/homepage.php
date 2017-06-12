          <div style="padding:25px;">
            <div class="clearfix"></div>
            
            
			<div id="input_text">
             <?php
              echo form_open_multipart(base_url().admin.'/generalpages/validatehomepage',$attributes['form']);
			 ?>
              <table width="98%" border="0" cellpadding="0" cellspacing="0">
               <tr>
                <td colspan="4">
                 <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                </td>
               </tr>
<tr>
                          <td style="padding-top:10px;padding-bottom:5px;">
                           Top Notification Text&nbsp;<span class="remarks">(To be displayed at the top of banner on home page)</span>&nbsp;<div class="error1" id="error1"><?php echo form_error('intro_text'); ?></div>
               			  </td>
                         </tr>
                         <tr>
                          <td colspan="4" align="left"><?php echo form_textarea($attributes['intro_text']);
   				       		$this->ckeditor->config['width'] = '700px';
					   		$this->ckeditor->config['height'] = '100px';            
					   		echo $this->ckeditor->replace("intro_text");
		     	 		  ?>  
                		  </td>
                         </tr> 
                         
<tr>
                          <td style="padding-top:15px;padding-bottom:5px;">
                           *Banner Content&nbsp;<span class="remarks" style="background-color:#FFA;color:#3F3F3F;padding:2px;">(Please don't change any text expressions written in the form [[abc]]. e.g [[BODY]] )</span>&nbsp;<div class="error1" id="error7"><?php echo form_error('banner_content'); ?></div>
               			  </td>
                         </tr>
                         <tr>
                          <td colspan="4" align="left"><?php echo form_textarea($attributes['banner_content']);
   				       		$this->ckeditor->config['width'] = '700px';
					   		$this->ckeditor->config['height'] = '300px';            
					   		echo $this->ckeditor->replace("banner_content");
		     	 		  ?>  
                		  </td>
                         </tr>                                          
                         <tr>
                          <td style="padding-top:15px;padding-bottom:5px;">
                           *Content&nbsp;<span class="remarks" style="background-color:#FFA;color:#3F3F3F;padding:2px;">(Please don't change any text expressions written in the form [[abc]]. e.g [[BODY]] )</span>&nbsp;<div class="error1" id="error6"><?php echo form_error('content'); ?></div>
               			  </td>
                         </tr>
                         <tr>
                          <td colspan="4" align="left"><?php echo form_textarea($attributes['content_id']);
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
					   <tr><td>&nbsp;</td></tr>
                                               
                      </table> 
                     <?php
					  echo form_close();
					 ?>  
                    </div>            
            
            
            
            
           </div>  
           
          
          <!--  Managing Footer Icons               -->


          
          
		            
   
 <!-- End Code for  Managing Footer Icons               -->   