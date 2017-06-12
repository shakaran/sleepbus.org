           <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open_multipart(base_url().admin.'/support/validate-support',$attributes['form']);
			  
			  if(!empty($edit_id)){ echo form_hidden('edit_id',$edit_id);$activity="updating";}else{$activity="adding";}
			  
			  
			 ?>
              <table width="98%" border="0" cellpadding="0" cellspacing="0">
               <tr>
               <td style="padding-bottom:9px;">
                <span class="main_heading"><?php echo $page_title;?></span>
               </td>
                <td colspan="3">
                  <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                 </td>
                      
               </tr>
               

			   
               
			   <tr><td style="padding-top:0px;padding-bottom:5px;">
                 *Supporter title&nbsp;<span class="error1" id="error1"><?php echo form_error('support_title'); ?></span>
               </td></tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_input($attributes['support_title']); ?>&nbsp;
                </td>
               </tr> 
               
               

			   <tr>
                <td style="padding-top:10px;padding-bottom:5px;">
                 *Intro. Text & Image&nbsp;<span class="remarks">(Image will be displayed default and text will be displayed on hover of image)</span>&nbsp;<span class="error1" id="error2"><?php echo form_error('intro_text'); ?></span>
                </td>
               </tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_textarea($attributes['intro_text']); 
   				           $this->ckeditor->config['width'] = '700px';
					       $this->ckeditor->config['height'] = '300px';            
					       echo $this->ckeditor->replace("intro_text");
			    ?>
                </td>
               </tr>                      

			   
              
  		          
				<tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
               
               &nbsp;<?php echo form_submit($attributes['submit']);?>
               </td></tr>                         

               <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
               </td></tr>
              </table> 
			 <?php
              echo form_close();
             ?>  
            </div>
           </div>