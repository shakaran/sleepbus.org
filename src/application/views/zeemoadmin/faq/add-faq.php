           <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open_multipart(base_url().admin.'/faq/validatefaq',$attributes['form']);
			  if(!empty($faq_id))
			  {
			   echo form_hidden('faq_id',$faq_id);
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
                 *Question &nbsp;<span class="error1" id="error1"><?php echo form_error('question'); ?></span>
               </td></tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_input($attributes['question']); ?>&nbsp;
                </td>
               </tr>    
               
    		                          
                <tr>
                  <td style="padding-top:10px;padding-bottom:5px;">
                   *Answer&nbsp;<span class="error1" id="error2"><?php echo form_error('answer'); ?></span>
               	  </td>
                 </tr>
                 <tr>
                  <td colspan="4" align="left">
                   <textarea id="answer" name="answer"><?php echo $attributes['answer'];?></textarea>
                   <?php 
                    $this->ckeditor->config['width'] = '700px';
                    $this->ckeditor->config['height'] = '250px';            
                    echo $this->ckeditor->replace("answer");
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
                     </td>
                 </tr>
                </table> 
                <?php
			     echo form_close();
		   	    ?>  
               </div>
              </div>
