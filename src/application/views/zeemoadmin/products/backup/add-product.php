           <div style="padding:25px;">
            <div id="input_text">
             <?php
			  $form_attributes = array('onsubmit' => 'return ValidateCopyMoveProducts()');
              echo form_open_multipart(base_url().'admin/products/validate-product',$attributes['form'], $form_attributes);
			  
			  if(!empty($product_id)) echo form_hidden('product_id',$product_id);
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
                 *Select a category&nbsp;<span class="error1" id="error4"><?php echo form_error('cat_id'); ?></span>
               </td></tr>
               
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php 
				 $disabled = '';
				 if(!empty($product_id)) $disabled = 'disabled';
				 echo form_dropdown('cat_id',$attributes['cat_id'], $attributes['selected_item'],"class='select_action' style='width:150px;' id='cat_id' ".$disabled)?>     
                 <?php
				   if(!empty($product_id)) echo form_hidden('cat_id',$attributes['selected_item']);
				 ?>
                </td>
               </tr>    
               
			   <tr><td style="padding-top:10px;padding-bottom:5px;">
                 *Product name&nbsp;<span class="error1" id="error1"><?php echo form_error('product_name'); ?></span>
               </td></tr>
               
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_input($attributes['product_name']); ?>&nbsp;<span><?php echo form_input($attributes['limit1']);
				  ?></span><span class="remarks">&nbsp;(Max. 35 chars)</span>
                </td>
               </tr>    

			   <tr>
                <td style="padding-top:10px;padding-bottom:5px;">
                 *Intro text<span class="remarks">&nbsp;(to be displayed on product landing page)</span>
                 &nbsp;<span class="error1" id="error2"><?php echo form_error('intro_text'); ?></span>
                </td>
               </tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_textarea($attributes['intro_text']); ?>&nbsp;<span><?php echo form_input($attributes['limit2']);?></span>
                 <span class="remarks">&nbsp;(Max. 300 chars)</span>
                </td>
               </tr>    

               <tr>
                <td style="padding-top:8px;padding-bottom:5px;">
                *Description&nbsp;<span class="error1" id="error3"><?php echo form_error('description'); ?></span>
                </td>
               </tr>
               <tr>
                <td colspan="4" align="left">
                 <?php echo $this->fckeditor->Create();  ?>
                </td>
               </tr>

               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_submit($attributes['submit']); ?>
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