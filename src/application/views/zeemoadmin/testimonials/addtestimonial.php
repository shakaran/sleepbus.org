          <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open_multipart(base_url().admin.'/testimonials/validatetestimonials',$attributes['form']);
			  if(!empty($testimonials_id))
			  {
			   echo form_hidden('testimonials_id',$testimonials_id);
			  }
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
                 *Title &nbsp;<span class="error1" id="error1"><?php echo form_error('testimonials_title'); ?></span>
               </td></tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_input($attributes['testimonials_title']); ?>&nbsp;<span><?php echo form_input($attributes['limit1']);
				  ?></span><span class="remarks">(Max. 85 chars)</span>
                </td>
               </tr>    
               
               <tr>
                <td style="padding-top:10px;padding-bottom:5px;">
                 *Description&nbsp;<span class="error1" id="error2"><?php echo form_error('description'); ?></span>
               	</td>
               </tr>
               <tr>
                <td colspan="4" align="left">
                 <?php echo form_textarea($attributes['description']);
   				       		$this->ckeditor->config['width'] = '700px';
					   		$this->ckeditor->config['height'] = '300px';            
					   		echo $this->ckeditor->replace("description");
		     	 		  ?>  
           		</td>
               </tr>
               
    		   <tr>
                <td valign="top" align="left" width="55%" style="padding-top:10px;padding-bottom:10px;">
                           </td>
                           <td align="left" valign="top">
                                                      
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
