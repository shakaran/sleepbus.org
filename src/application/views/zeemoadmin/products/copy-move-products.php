           <div style="padding:10px;">
            <div id="input_text">
             <?php

			  $form_attributes = array('name' => 'copy_move_frm', 'onsubmit' => 'return ValidateCopyMoveProducts()');
              echo form_open(base_url().admin.'/products/copy-move-products', $form_attributes);
			 ?>
             <table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr>
               <td style="padding-bottom:15px;padding-top:10px;">
                <span class="main_heading"><?php echo $page_title;?></span>
               </td>
               <td colspan="3">
                 <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                </td>
              </tr>
              
              <tr height="15" valign="bottom">
              <td style="border-top:thin solid #CCC;border-left:thin solid #CCC;border-right:thin solid #CCC; padding: 4px;width:23%;background-color:#F9F9F9"><span class="navigation"> Source Category</span></td>
              <td style="width:27%">&nbsp;</td>
              <td style="border-top:thin solid #CCC;border-left:thin solid #CCC;border-right:thin solid #CCC; padding: 4px;width:23%;background-color:#F9F9F9"><span class="navigation"> Destination Category</span></td>
              <td style="width:27%">&nbsp;</td>
              </tr> 
              
              <tr height="25" valign="bottom">
               <td colspan="2" align="left" style="border:thin solid #CCC; padding: 2px;width:50%;background-color:#F9F9F9" valign="top">
                <table>
                 <tr>
                  <td valign="top">
                   Select a category
                   <div>
                <?php
				
				echo form_dropdown('scid',$source_navigation_attributes['categories'], $scid,"class='select_action' style='width:158px;' id='scid'  onchange=\"window.location='".base_url().admin."/".$active_module."/".$active_submodule."/'+this.value+'/$s_depth/$dcid/$d_depth'\"");				

                ?>
                   </div>
                  </td>
                  <td valign="top">
                   <?php 
                  
                   if(count($source_navigation_attributes['subcategories']) > 0 and ((($s_depth+1) < $category_level) or ($category_level==0)))
				   {
				    echo "Select a subcategory : ";
					echo form_dropdown('s_subcid',$source_navigation_attributes['subcategories'], '',"class='select_action' style='width:158px;' id='s_subcid'  onchange=\"window.location='".base_url().admin."/".$active_module."/".$active_submodule."/'+this.value+'/".$source_navigation_attributes['subcategory_depth']."/$dcid/$d_depth'\""); 
				   
				   
				    
				   }
				   else
				   {
				    if(($scid > 0) and ((($s_depth+1) < $category_level) or ($category_level==0)))
					{
					 echo "&nbsp;<div style='padding-top:5px;'>&nbsp;&nbsp;No Subcategories Found</div>";
					}
					
				   }					
                  echo form_hidden('s_depth',$s_depth);
 				

               ?>
                   
                  </td>
                  
                 </tr>

                 
                 <?php
				 ksort($source_category_navigation);
				 if(count($source_category_navigation) > 0)
				 {
				  ?>
				  <tr>
                   <td colspan="2" valign="top">				  
				   <?php	 
				   echo "<span class='navigation'> Parent Categories :  <a class='navigation_link' href=".base_url().admin."/".$active_module."/".$active_submodule."/0/0/".$dcid."/".$d_depth.">Main Categories</a> >> </span>";	 
				  $count=0;
				  foreach($source_category_navigation as $navigation)
				  {
				   $count++;
                   if($count != count($source_category_navigation))
				   {
				    ?>
                    <span class='navigation'>
					<a class="navigation_link" href="<?php echo base_url().admin;?>/<?php echo $active_module."/".$active_submodule;?>/<?php echo $navigation['id'];?>/<?php echo $navigation['depth'];?>/<?php echo $dcid."/".$d_depth;?>" title="<?php echo ucfirst($navigation['category_name']);?>"><?php echo ucfirst($navigation['category_name']);?></a>&nbsp;>>&nbsp;</span>
					<?php
				   }
				   else
				   {
				    echo "<span class='navigation_last'>".ucfirst($navigation['category_name'])."</span>";


				   }

                 
				  }
				  ?>
				  </td>
                  </tr>
				  <?php
				 }
                 ?>
				

                 <tr>
                  <td colspan="2">
                   <span id="error1" class="error1"></span>
                  </td>
                 </tr>


                 
                </table>  
               </td>
               <td colspan="2" align="left" style="border:thin solid #CCC; padding: 2px;width:50%;background-color:#F9F9F9" valign="top">
                <table>
                 <tr>
                  <td valign="top">
                   Select a category
                   <div>
                <?php
				
				echo form_dropdown('dcid',$destination_navigation_attributes['categories'], $dcid,"class='select_action' style='width:158px;' id='dcid'  onchange=\"window.location='".base_url().admin."/".$active_module."/".$active_submodule."/$scid/$s_depth/'+this.value+'/$d_depth'\"");				
				
                ?>
                 </div>  
				  </td>
                  <td valign="top">
                  <?php
				
                   if(count($destination_navigation_attributes['subcategories']) > 0 and ((($d_depth+1) < $category_level) or ($category_level==0)))
				   {
				    echo "Select a subcategory : ";
					echo form_dropdown('d_subcid',$destination_navigation_attributes['subcategories'], '',"class='select_action' style='width:158px;' id='d_subcid'  onchange=\"window.location='".base_url().admin."/".$active_module."/".$active_submodule."/$scid/$s_depth/'+this.value+'/".$destination_navigation_attributes['subcategory_depth']."'\""); 
				   
				   
				   

				   }
				   else
				   {
				    if(($dcid > 0) and ((($d_depth+1) < $category_level) or ($category_level==0)))
					{
					 echo "&nbsp;<div style='padding-top:5px;'>&nbsp;&nbsp;No Subcategories Found</div>";
					}
					
				   }	
				   echo form_hidden('d_depth',$d_depth);
				   				
				                  ?>
                   
				  </td>
                  
                 </tr>
                 <?php
				 ksort($destination_category_navigation);
				 if(count($destination_category_navigation) > 0)
				 {
				  ?>
				  <tr>
                   <td colspan="2" valign="top">				  
				   <?php	 
				   echo "<span class='navigation'> Parent Categories :  <a class='navigation_link' href=".base_url().admin."/".$active_module."/".$active_submodule."/".$dcid."/".$d_depth."/0/0>Main Categories</a> >> </span>";	 
				  $count=0;
				  foreach($destination_category_navigation as $navigation)
				  {
				   $count++;
                   if($count != count($destination_category_navigation))
				   {
				    ?>
                    <span class='navigation'>
					<a class="navigation_link" href="<?php echo base_url().admin;?>/<?php echo $active_module."/".$active_submodule;?>/<?php echo $scid."/".$s_depth;?>/<?php echo $navigation['id'];?>/<?php echo $navigation['depth'];?>" title="<?php echo ucfirst($navigation['category_name']);?>"><?php echo ucfirst($navigation['category_name']);?></a> &nbsp;>>&nbsp;</span>
					<?php
				   }
				   else
				   {
				    echo "<span class='navigation_last'>".ucfirst($navigation['category_name'])."</span>";


				   }

                 
				  }
				  ?>
				  </td>
                  </tr>
				  <?php
				 }
                 ?>




                 

                 <tr>
                  <td colspan="2">
                   <span id="error2" class="error1"></span>
                  </td>
                 </tr>
                 
                </table>
               </td>
              </tr>
              
              
              <tr height="35" valign="bottom">
               <td> 
                <?php
				$option_attributes = 'id="option" class="select_action" style="width: 125px;"';
				$options = array('' => 'Select action', 'copy' => 'Copy', 'move' => 'Move', 'clone' => 'Clone');
				echo form_dropdown('option', $options, $option, $option_attributes);
                ?>
               </td>
               <td colspan="3">
                <?php
				 echo form_submit('submit_value','Submit');
				?>
               </td>  
              </tr> 
              <tr valign="top">
               <td align="left" colspan="4"><span id="error3" class="error1"></span></td>
              </tr>
              <tr>
               <td colspan="4" valign="top">
               Note: <span style="font-weight:normal;">To copy/move a products from one category to another, destination category must be diffrent from source category</span><br /><br />
               <?php
               if(count($duplicate_products) > 0)
               {
               ?>
                <span class="error1">Following checked products already exist in destination categegory</span>
               <?php	   
               }
               ?>
               </td>
              </tr>                

              <?php
			  $count = 0;
			  if(count($products) > 0)
			  {
			  ?>
              <tr>
               <td colspan="4">
                <div class="navigation" style="text-align:left;">List of products of category : <span style="color:gray"> <?php echo $category_details['category_name'];?></span></div>
               </td>
              </tr>	   
               <tr>
                <td colspan="4" align="left" valign="top" style="border: solid thin #CCC; padding: 0px; font-weight: normal;">
                 <table width="100%" cellpadding="0" cellspacing="10">
                  <tr><td colspan="4">
                   Please select one or more products from following list to copy/move/clone. &nbsp;&nbsp;
                   <span id="error4" class="error1"></span>
                  </td></tr>
                  <?php
				  $td_cnt = 0;
				  foreach($products as $product)
				  {
				   $td_cnt++; $count++;	  
				   if($td_cnt==1) echo "<tr>";
				   ?>
                   <td>
                   <?php 
				   $check = FALSE;
				   if(in_array($product['id'], $duplicate_products)) $check = TRUE; 
				   $product_list = array
				   (
					'name'    => 'products[]',
					'id'      =>  'product_'.$count,
					'value'   => $product['id'],
					'checked' => $check
				   );
				   echo form_checkbox($product_list)."&nbsp;".$product['product_name']; 
                   if($td_cnt==4) $td_cnt=0;
				  }
				  if($td_cnt < 4) echo "</tr>";
                  ?> 
                </table>
               </td>
              </tr>   
              <?php
			  }
			  else if($scid > 0)
			  {
			  ?>
               <tr><td colspan="4"><span class="error1">No product(s) found in selected category :</span><span style="color:gray"><?php echo $category_details['category_name'];?></span></td></tr>
              <?php
			  }
             ?>
             </table> 
			 <?php
			  echo form_hidden('total_products',$count);
              echo form_close();
			  
			  if($this->session->userdata('session_data'))
			  {
			   $this->session->unset_userdata('session_data');
			  }
             ?>  
            </div>
           </div>