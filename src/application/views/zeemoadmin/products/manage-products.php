            <div class="record_list">
             <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
             <!-- Data needed for multiple deletion-->   
              <div style="text-align:left;padding:0px 0px 10px 35px;">
              <div class="main_heading">Manage Products</div>
              
               <?php
				 ksort($category_navigation);
				 if(count($category_navigation) > 0)
				 {
				  echo "<span class='navigation'> Parent Categories :  <a class='navigation_link' href=".base_url().admin."/".$active_module."/".$active_submodule.">Main Categories</a> >> </span>";	 
				  $count=0;
				  foreach($category_navigation as $navigation)
				  {
				   $count++;
                   if($count != count($category_navigation))
				   {
				    ?>
                    <span class='navigation'>
					<a class="navigation_link" href="<?php echo base_url().admin;?>/<?php echo $active_module."/".$active_submodule;?>/<?php echo $navigation['id'];?>/<?php echo $navigation['depth'];?>" title="<?php echo ucfirst($navigation['category_name']);?>"><?php echo ucfirst($navigation['category_name']);?></a></span>				 &nbsp;>>&nbsp;
					<?php
				   }
				   else
				   {
				    echo ucfirst($navigation['category_name']);


				   }

                 
				  }
				 }
				    echo "<div>&nbsp;&nbsp;Select Category : ";
					echo form_dropdown('category',$navigation_attributes['categories'], $cat_id,"class='select_action' style='width:150px;' id='category'  onchange=\"window.location='".base_url().admin."/".$active_module."/".$active_submodule."/'+this.value+'/$depth'\"");
				
				    
					
                   if(count($navigation_attributes['subcategories']) > 0 and ((($depth+1) < $category_level) or ($category_level==0)))
				   {
				    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subcategories : ";
					echo form_dropdown('subcategory',$navigation_attributes['subcategories'], '',"class='select_action' style='width:150px;' id='subcategory'  onchange=\"window.location='".base_url().admin."/".$active_module."/".$active_submodule."/'+this.value+'/".$navigation_attributes['subcategory_depth']."'\""); 
				   
				   }
				   else
				   {
				    if(($cat_id > 0) and ((($depth+1) < $category_level) or ($category_level==0)))
					{
					 echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='navigation'>No Subcategories Found</span>";
					}
					
				   }					
					
					
					echo "</div>";
				 
                ?>
                </span>

              </div>
              <div style="text-align:left;padding-left:38px;">
               <?php
			   if($cat_id > 0)
			   {
				$js_function="OpenAddProductForm('".base_url()."','".$cat_id."','".$depth."')";
				echo form_submit('add_new_product','Add New Product','onclick="'.$js_function.'"');			               }
				?>
					
			   </div>  
			   <?php
                if(count($product_list) > 0)
				{
			     foreach($product_list as $prod)
				 {
				  if($prod['clone'] == 'true')
				  {
				   ?>
				   <div style="padding:8px 0px 0px 40px;">
               	   <div id="note" class="ulTableinner_record sn-no-other" style="width:580px;background-color:white;border:thin solid #CACAFF;padding: 0px 10px 0px 10px;"><b>Note :-</b>
                   <div><font color="red">Remove Clone</font><sup style="font-size:12px;"><font color="blue">*</font></sup>
                    : It will unlink the product from selected category only.
                    </div>
                   <div><font color="#000099">Delete Product</font> : &nbsp;It will delete the product from database. i.e after deletion of a product there will be no existence of the product in any cateories</div>
                    
                    </div>
                    </div>
                    <div style="clear:both;">&nbsp;</div>
				   <?php	  
				   break;
				  }
				 }
				}
			   ?>                 
			 <?php
			  
			 if(count($product_list) > 0)
		     {
              echo form_open(base_url().admin.'/products/manage-products',$attribute['form']);
		      ?>
              <div class="navigation" style="text-align:left;padding-left:38px;">List of products of category : <span style="color:gray"> <?php echo $category_details['category_name'];?></span></div>
              <input type="hidden" name="total_data" id="total_data" value="<?php echo $attribute['total_data']?>" />  
              <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $attribute['deletion_path']?>" />   
              <div class="ulTable">
               <ul>
                <li>
                 <div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                 <div class="ulTableinner sn-no-other" style="width:170px;">Product Name</div>
                 <div class="ulTableinner sn-no-other" style="width:140px; text-align:center">Status</div>
                 <div class="ulTableinner sn-no-other" style="width:270px; text-align:center">Tools</div>
                 <div class="ulTableinner sn-no-other" style="width:50px;"><label> <span class="tools_icon"><?php echo form_checkbox($attribute['remove_all']);?>&nbsp;<?php echo img(base_url()."images/".admin."/icons/tools/check.png");?></span></label></div>
                </li>
               </ul>
              </div>
             <div class="clearfix"></div>
             <?php
             if(count($product_list) > 0)
			 {
			 ?>
              <!--Data Needed for Positioning-->
              <input type="hidden" name="parent_id" value="<?php echo $cat_id;?>" id="parent_id" />
              <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/category_to_products"?>/cat_id" id="file_path" />
              <div class="ulTable_record" id="recordList">
              <ul>
			  <?php
			  $i=1;
			  $j=1;
			  foreach($product_list as $product)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $product['cpid'];?>" style="padding:2px;">
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:170px;"><?php echo $product['product_name'];?><?php if($product['clone']=='true') echo '<sup class="clone_marker">clone</sup>';?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:140px; text-align:center">
                  <?php
				   if($product['status']==0)
				   {
				    echo anchor(base_url().admin.'/products/changestatus/'.$product['cpid'].'/1/manage-products/'.$product['cat_id'], 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/products/changestatus/'.$product['cpid'].'/0/manage-products/'.$product['cat_id'], 'Hide',array('title'=>'Hide'));
				   }
                  ?>
                  </div>
                  
                 <div class="ulTableinner_record sn-no-other-record" style="width:270px; text-align:center; vertical-align:baseline;">

				 <a href="javascript:void(0)" onclick="OpenEditProductForm('<?php echo base_url()?>','<?php echo $product['id'];?>','<?php echo $cat_id;?>','<?php echo $depth;?>')" title="Edit" style="color: #884400;  text-decoration: none;">Edit&nbsp; | &nbsp;</a>

                 
                 <a href="<?php echo base_url().admin;?>/products/manage-images/<?php echo $product['id'];?>/<?php echo $product['cat_id'];?>" title="Manage Images">Images</a>&nbsp;|&nbsp;
                 <a href="<?php echo base_url().admin;?>/products/manage-brochures/<?php echo $product['id'];?>/<?php echo $product['cat_id'];?>" title="Manage Downloads">Downloads</a>
                 
				<?php
				 if($product['clone']=='true')
				 {
				  ?>
				  &nbsp;|&nbsp;
                  <a href="<?php echo base_url().admin;?>/products/ConfirmDelete/<?php echo $product['cpid'];?>/remove_clone/<?php echo $cat_id;?>/<?php echo $depth;?>?iframe=true&width=320&height=110" rel="prettyPhoto" style="color:red;">Remove Clone<sup style="font-size:12px"><font color="blue">*</font></sup></a></span>
				  <?php
				 }
				 ?>
                   
                  </div>
                    <div class="ulTableinner_record sn-no-other-record" style="width:40px;">
                     <?php
					
					 echo form_checkbox($attribute['data'.$i]);
					 $i++;
					?>
                    </div>
                 <div class="clearfix"></div>
                </li>
			   <?php
			   $j++;
			  }
			  ?>
               </ul>
			  </div>

              <div class="ulTable" style="padding-top:5px;">
               <ul>
            	<li>
                	<div class="ulTableinner_record sn-no">&nbsp;</div>
                	<div class="ulTableinner_record sn-no-other">&nbsp;</div>
                	<div class="ulTableinner_record sn-no-other" style="width:150px;">&nbsp;</div>
                	<div class="ulTableinner_record sn-no-other" style="width:100px;">&nbsp;</div>
                    <div class="ulTableinner_record sn-no-other" style="width:150px; text-align:right;"><span class="tools_icon">
                     <div id="remove_active" style="display:none">
                     <?php
					  echo form_submit($attribute['delete_all']);
                     ?>
                     </div>
                     <div id="single_remove" style="display: none">
                     <?php
					  echo form_submit($attribute['delete']);
                     ?>
                     </div>                         
                     <div id="remove_inactive" style="display: block">
                     <?php
					  echo form_submit($attribute['delete_all']);
                     ?>
					 </div></span>
                    </div>
                </li>
               </ul>
              </div>              
			  <?php
			 }
			 echo form_close();
			 }
			 else
			 {
			  ?>
			   <div class="success"> No product found.</div>
			  <?php
			 }
		    ?>
           <div class="clearfix"></div>
          </div>
