           <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open_multipart(base_url().admin.'/generalpages/validatepagecontent',$attributes['form']);
			 ?>
             <div style="color: #636466;font-family: Arial;font-size: 11px;font-weight: bold;text-align: left;padding-top:20px;">
             *Select a page :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_dropdown('page_id',$attributes['page_id'],$page_id,"class='select_action' style='width:285px;' id='page_id' onchange=OpenPageContentForm('".base_url().admin."/generalpages/pagecontent/'+this.value)");?>&nbsp;<span id="error1" class="error2"><?php echo form_error('page_id');?></span>
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
                   Content/Page heading&nbsp;<span class="error1" id="error1"><?php echo form_error('page_heading'); ?></span>
                  </td>
                 </tr>
                 <tr>
                  <td colspan="4" align="left">
                   <?php echo form_input($attributes['page_heading']); ?>  
                  </td>
                 </tr>

                 <tr>
                  <td style="padding-top:10px;padding-bottom:5px;">
                   Content&nbsp;<span class="error1" id="error2"><?php echo form_error('content'); ?></span>
                  </td>
                 </tr>
                 <tr>
                  <td colspan="4" align="left">
                   <?php 
				    echo form_textarea($attributes['content_id']);
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
