           <div style="padding:25px;">
            <div id="input_text">
             <?php
             echo form_open(base_url().admin.'/campaign/validateheadings',$attributes['form']);
			 if(isset($sub_heading))
			 {
			  ?>
              <input type="hidden" name="sub_heading" value="<?php echo $sub_heading;?>" id="sub_heading" />
              <?php
			 }
			 ?>
              <table width="100%" style="margin-top: -15px">
               <tr>
                <td>
                 <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                </td>
               </tr>                       
               <tr>
                <td>Select page section
                       &nbsp;&nbsp;<span class="error1" id="error1"><?php echo form_error('heading_id');?></span></td></tr>
                      <tr>
                       <td>
                        <?php
						 $css="class='select_action' style='width:280px;'";
						 $js="onchange=window.location='".base_url().admin."/campaign/pageheadings/'+this.value";
						 
						 echo form_dropdown('heading_id',$attributes['heading_id'],$page_id,$css." id='heading_id' ".$js);?>
                       </td>
                      </tr>


                      <tr height="25" valign="bottom"><td>
                      <?php
                       if(isset($sub_heading) and ($sub_heading == "1") and !empty($page_id))
					   {
					    ?>
                       Page heading / subheading&nbsp;&nbsp;<span class="error1" id="error2"><?php echo form_error('page_heading');?></span>             <?php
					   }
					   elseif(!empty($page_id))
					   {
					    ?>
                       Page heading / subheading&nbsp;&nbsp;<span class="error1" id="error2"><?php echo form_error('page_heading');?></span>
                        <?php
					   }
					   ?>
                       </td>
                      </tr>
                      <tr>
                       <td align="left">
                        <?php
						if(isset($sub_heading) and ($sub_heading == "1"))
						{
					     ?>
						 <textarea id="page_heading" name="page_heading"><?php echo $attributes['page_heading_text'];?></textarea>
                         
						 <?php
 			       		 $this->ckeditor->config['width'] = '700px';
					   	 $this->ckeditor->config['height'] = '300px';            
					   	 echo $this->ckeditor->replace("page_heading");
						}
						elseif(!empty($page_id))
						{
						 echo form_input($attributes['page_heading']);
                         ?>
                         &nbsp;&nbsp;
                         <?php
                          echo form_input($attributes['limit1']);
                         ?> 
						 &nbsp;<span class="remarks">*Maximum 45 chars</span>&nbsp;&nbsp;
                         <?php
						}
                        ?>
                       </td>
                      </tr>  
                      <tr height="30" valign="bottom">
                       <td align="left">
                       <?php
					   if(!empty($page_id))
                       {
					    echo form_submit($attributes['submit']);
					   }
					   ?>
					   </td>
                      </tr>  
                      
                      <tr height="100"><td></td></tr>
                    </table> 
                     <?php
					  echo form_close();
					 ?>  
                    </div>
                   </div>
