           <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open_multipart(base_url().admin.'/products/validate-category',$attributes['form']);
			  
			  if(!empty($cat_id)){ echo form_hidden('cat_id',$cat_id);$activity="updating";}else{$activity="adding";}
			  
			  echo form_hidden('depth',$depth);
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
               <tr>
               <td  colspan="4" style="padding-bottom:9px;">
                
                <?php
				 ksort($category_navigation);
				 if(count($category_navigation) > 0)
				 {
				  if(count($category_navigation) > 1)
				  {
				   echo "<span class='navigation'>Parent Category : </span>";	 
				  }
				  $count=0;
				  foreach($category_navigation as $navigation)
				  {
				   $count++;
				   if($count == count($category_navigation))
				   {
				    echo "<div>Select Parent Category : ";
					echo form_dropdown('parent_id',$parent_category_drop_down_attribute, $parent_id,"class='select_action' style='width:150px;' id='parent_id' ");
					echo "</div>";
				   }
				   else
				   {
				    ?><span class='navigation'>
                    <?php
					 if($count > 1)
					 {
                      ?>
					   &nbsp; >> &nbsp;
					  <?php
					 }
					?>
					<a class="link1" href="<?php echo base_url().admin;?>/<?php echo $active_module."/".$active_submodule;?>/<?php echo $navigation['id'];?>/<?php echo $navigation['depth']+1;?>" title="<?php echo ucfirst($navigation['category_name']);?>"><?php echo ucfirst($navigation['category_name']);?></a></span>				 
					<?php
				   }
				  }
				 }
				 else
				 {
				  ?>
				   You are <?php echo $activity;?> main category
				  <?php
				  echo form_hidden('parent_id',$parent_id);
				 }
                ?>
                </span>
               </td>
               </tr>

			   
               
			   <tr><td style="padding-top:0px;padding-bottom:5px;">
                 *Category name&nbsp;<span class="error1" id="error1"><?php echo form_error('category_name'); ?></span>
               </td></tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_input($attributes['category_name']); ?>&nbsp;<span><?php echo form_input($attributes['limit1']);
				  ?></span><span class="remarks">&nbsp;(Max. 25 chars)</span>
                </td>
               </tr>    

			   <tr>
                <td style="padding-top:10px;padding-bottom:5px;">
                 Description&nbsp;<span class="error1" id="error2"><?php echo form_error('description'); ?></span>
                </td>
               </tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_textarea($attributes['description']); ?>&nbsp;<span><?php echo form_input($attributes['limit2']);?></span>
                 <span class="remarks">&nbsp;(Max. 300 chars)</span>
                </td>
               </tr>    
              
  		       <tr>
                <td valign="top" align="left" width="55%" style="padding:10px 0px 10px 10px;border:thin solid white;">
                 <table align="left" width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr height="10">
                   <td align="left" valign="top" colspan="2">
					 Upload Image
                    &nbsp;&nbsp;
                    &nbsp;<div class="error1" id="error3"><?php echo form_error('image_file'); ?></div>
                             </td>
                            </tr>
                            <tr height="10">
                             <td align="left" valign="top" width="85%">
                              <?php echo form_upload($attributes['image_file']);?>
                              <br /><span class="remarks"><?php if(isset($image_remarks)){ echo $image_remarks;}?></span>
								<div style="padding-top:10px;">
                               Alt/ Title text <span class="remarks">(For SEO)</span> :</div><div style="padding-top:6px;">  <?php echo form_input($attributes['image_alt_title_text']);?></div> 
                               
                               
                               <div style="padding-top:10px;">
                 
			    			   <?php
							     echo IMAGE_QUALITY_INSTRUCTION.":&nbsp;&nbsp;";
			     				 echo form_dropdown('image_quality',$image_quality_options,$image_quality,'class="select_action"');
			   					?>                 
				                <div class="remarks"><?php echo IMAGE_QUALITY_REMARKS;?></div> 
                               
               	               
                                                            
                              
                              </div>
                              </td>
                              
                             </tr>                            
                            </table>
                           </td>
                           <td align="left" valign="top" style="padding-top:5px;padding-bottom:10px;background-color:#F7F7F7;border:thin solid white;">
                            <table align="left"  width="100%" cellpadding="0" cellspacing="0" border="0">
                             <tr height="10">
                              <td align="left" valign="top"></td>
                             </tr>
                             <tr height="10">
                              <td align="center" valign="top">
                               <?php
							    if(!empty($attributes['current_image']))
								{
								 echo "<div style='padding-bottom:5px;'>Current Image</div>";
                                 ?>
								 <img src="<?php echo base_url();?>images/category/<?php echo $attributes['current_image'];?>" width="240" height="160" />
                                 <br />
                                 <span class="gallery">
								  <a href="<?php echo base_url().admin;?>/products/ConfirmDelete/<?php echo $cat_id;?>/category_image_delete?iframe=true&width=320&height=110" rel="prettyPhoto" class="link1"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/delete.png");?></span> &nbsp;Delete Image</a></span>
                                 <?php
                         		 echo form_hidden('current_image',$attributes['current_image']);
								} 
								else
								{
								 ?>
								  <div class="remarks" style="text-align:center">Image Preview</div>
								 <?php
								}
								?>								
								
                              </td>
                             </tr>                            
                            </table>                          
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