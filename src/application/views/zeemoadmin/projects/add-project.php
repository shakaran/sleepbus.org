           <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open_multipart(base_url().admin.'/projects/validate-project',$attributes['form']);
			  
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
                 *Project name&nbsp;<span class="error1" id="error1"><?php echo form_error('project_title'); ?></span>
               </td></tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_input($attributes['project_title']); ?>&nbsp;
                </td>
               </tr> 
               
               

			   <tr>
                <td style="padding-top:10px;padding-bottom:5px;">
                 *Intro Text&nbsp;<span class="remarks">(To be displayed as list item on project landing page)</span>&nbsp;<span class="error1" id="error2"><?php echo form_error('intro_text'); ?></span>
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

			   <tr>
                <td style="padding-top:10px;padding-bottom:5px;">
                 *Description&nbsp;<span class="error1" id="error3"><?php echo form_error('description'); ?></span>
                </td>
               </tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_textarea($attributes['description']); 
   				           $this->ckeditor->config['width'] = '700px';
					       $this->ckeditor->config['height'] = '300px';            
					       echo $this->ckeditor->replace("description");
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