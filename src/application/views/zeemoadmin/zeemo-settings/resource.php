           <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open_multipart(base_url().admin.'/zeemosettings/validate-resource',$attributes['form']);
			 ?>
             
              <table width="98%" border="0" cellpadding="0" cellspacing="0">
               <tr>
                <td colspan="4">
                       <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                      </td>
                      
               </tr>
               <tr>
                 <td colspan="4" style="padding-top:0px;padding-bottom:5px;padding-top:5px;">
                 *Page Heading &nbsp;<span class="error1" id="error1"><?php echo form_error('page_heading'); ?></span>
                 </td>
                </tr>
                <tr>
                 <td colspan="4" align="left" valign="bottom">
                 <?php echo form_input($attributes['page_heading']); ?>
                 </td>
                </tr> 

               <tr>
                 <td colspan="4" style="padding-top:0px;padding-bottom:5px;padding-top:5px;">
                 BreadCrumb &nbsp;<span class="error1" id="error2"><?php echo form_error('breadcrumb'); ?></span>
                 </td>
                </tr>
                <tr>
                 <td colspan="4" align="left" valign="bottom">
                 <?php echo form_input($attributes['breadcrumb']); ?>
                 </td>
                </tr> 
               
			   <tr><td style="padding-top:0px;padding-bottom:5px;padding-top:5px;">
                 *Meta Title &nbsp;<span class="error1" id="error3"><?php echo form_error('meta_title'); ?></span>
               </td></tr>
               <tr>
                <td colspan="4" align="left" valign="bottom">
                 <?php echo form_textarea($attributes['meta_title']); ?>
                 &nbsp;<span style="padding-bottom:5px;"><?php echo form_input($attributes['limit1']);
				  ?><span class="remarks">&nbsp;&nbsp;(Max. 200 chars)</span></span>
                </td>
               </tr> 
			   <tr><td style="padding-top:0px;padding-bottom:5px;padding-top:5px;">
                 Meta Keyword &nbsp;<span class="error1" id="error4"><?php echo form_error('meta_keyword'); ?></span>
               </td></tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_textarea($attributes['meta_keyword']); ?>
                 &nbsp;<span><?php echo form_input($attributes['limit2']);
				  ?><span class="remarks">&nbsp;&nbsp;(Max. 200 chars)</span></span>
                </td>
               </tr> 
			   <tr><td style="padding-top:0px;padding-bottom:5px;padding-top:5px;">
                 Meta Description &nbsp;<span class="error1" id="error5"><?php echo form_error('meta_description'); ?></span>
               </td></tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_textarea($attributes['meta_description']); ?>
                 &nbsp;<span><?php echo form_input($attributes['limit3']);
				  ?><span class="remarks">&nbsp;&nbsp;(Max. 200 chars)</span></span>
                </td>
               </tr> 


			   <tr><td style="padding-top:0px;padding-bottom:5px;padding-top:5px;">
                 JSON Code <span class="remarks">&nbsp;&nbsp;(For SEO)</span><span class="error1" id="error6"><?php echo form_error('json_code'); ?></span>
               </td></tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_textarea($attributes['json_code']); ?>
                </td>
               </tr> 
    		                          
                      
                         <tr>
                          <td style="padding-top:10px;padding-bottom:5px;">
                           Content&nbsp;<span class="error1" id="error7"><?php echo form_error('content'); ?></span>
               			  </td>
                         </tr>
                         <tr>
                          <td colspan="4" align="left">
                           <?php echo form_textarea($attributes['content_id']);
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
