            <div class="record_list">
             <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
             <!-- Data needed for multiple deletion-->   
              <div style="text-align:left;padding:0px 0px 10px 35px;">
              <div class="main_heading">Add Product</div>
              <div class="remarks">(To add product click on 'Add Products' link corresponding to each category)</div>
               <?php
				 ksort($category_navigation);
  			     $sub_heading="List of cateogries";	 
				 if(count($category_navigation) > 0)
				 {
				  $sub_heading="List of subcateogries";	 
				  echo "<span class='navigation'><a class='navigation_link' href=".base_url().admin."/".$active_module."/".$active_submodule.">Main Categories</a> : </span>";	 
				  $count=0;
				  foreach($category_navigation as $navigation)
				  {
				   $count++;
                   if($count != count($category_navigation))
				   {
				    ?>
                    <span class='navigation'>
					<a class="navigation_link" href="<?php echo base_url().admin;?>/<?php echo $active_module."/".$active_submodule;?>/<?php echo $navigation['id'];?>/<?php echo $navigation['depth']+1;?>" title="<?php echo ucfirst($navigation['category_name']);?>"><?php echo ucfirst($navigation['category_name']);?></a></span>				 &nbsp;>>&nbsp;
					<?php
				   }
				   else
				   {
				    echo ucfirst($navigation['category_name']);


					
				    echo "<div>Select Parent Category : ";
					echo form_dropdown('parent_id',$parent_category_drop_down_attribute, $parent_id,"class='select_action' style='width:150px;' id='parent_id'  onchange=\"window.location='".base_url().admin."/".$active_module."/".$active_submodule."/'+this.value+'/$depth'\"");
					echo "</div>";
				   }

                 
				  }
				 }
                ?>
                

              </div>
              
             <?php
			 if(count($category_list) > 0)
		     {
			  ?>
              <div class="navigation" style="text-align:left;padding-left:38px;"><?php echo $sub_heading;?></div>
              <div class="ulTable">
               <ul>
                <li>
                 <div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                 <div class="ulTableinner sn-no-other" style="width:190px;">Category Name</div>
                 
                 <div class="ulTableinner sn-no-other" style="width:405px; text-align:center">Tools</div>
                 <div class="ulTableinner sn-no-other" style="width:50px;">&nbsp;</div>
                </li>
               </ul>
              </div>
             <div class="clearfix"></div>
             <?php
             if(count($category_list) > 0)
			 {
			 ?>
              <!--Data Needed for Positioning-->
              
              <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".CATEGORIES;?>/<?php echo $parent_id;?>" id="file_path" />
              <div class="ulTable_record" id="recordList">
              <ul>
			  <?php
			  $i=1;
			  $j=1;
			  foreach($category_list as $category)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $category['id'];?>" style="padding:2px;">
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:190px;"><?php echo $category['category_name'];?></div>
                 
                  
                 <div class="ulTableinner_record sn-no-other-record" style="width:425px; text-align:center; vertical-align:baseline;">
                 <?php
                  if(count($sub_modules) > 0)
				  {
				   foreach($sub_modules as $submodule)
				   {
					if($submodule['url']=="products/add-product" and (($category_level > ($category['depth']+1)) or ($category_level == 0)))
					{
					 if($is_subcategory[$category['id']] == "yes")
					 {		
					  ?>						
					 
					  <a href="<?php echo base_url().admin;?>/products/add-product/<?php echo $category['id'];?>/<?php echo $category['depth']+1;?>" title="View Subcategories">View Subcategories&nbsp; | &nbsp;</a>   
                     <?php
					 }
					 else
					 {
					  ?>
					  <span class="remarks">&nbsp;&nbsp;No Subcategories </span>&nbsp; | &nbsp;   
                      <?php
					 }
					}					   
				    if($submodule['url']=="products/add-product")
					{
				     ?>   
                      <a href="<?php echo base_url().admin;?>/<?php echo $submodule['url'];?>/<?php echo $category['id'];?>" title="<?php echo $submodule['module_name'];?>">Add Products&nbsp; | &nbsp;</a>
                      
					 <?php
					}
					if($submodule['url']=="products/manage-products")
					{
					 if($is_subcategory["product_".$category['id']] == "yes")	
					 {
					  ?>
					  <a href="<?php echo base_url().admin;?>/<?php echo $submodule['url'];?>/<?php echo $category['id'];?>/<?php echo $category['depth'];?>" title="View Products">View Products&nbsp; | &nbsp;</a>
          			  <?php
					 }
					 else
					 {
					  ?>
					  <span class="remarks">&nbsp;&nbsp;No Products </span>&nbsp; | &nbsp;   
                      <?php
					 }
					}
					
					
				   }
				  }
				 ?>    
				                                              
                 
                   
                  </div>
                    <div class="ulTableinner_record sn-no-other-record" style="width:20px;">
                     <?php
					
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
                     
                     </div>
                     <div id="single_remove" style="display: none">
                     
                     </div>                         
                     <div id="remove_inactive" style="display: block">
                     
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
			   <div class="success"> No category found.</div>
			   <div style="padding : 0px 0px 10px 35px;text-align:left;"> <a style="text-decoration:none;" href="<?php echo base_url().admin;?>/products/add-category/<?php echo $parent_id;?>/<?php echo $depth;?>"><input type="button" value="Add Category" /></a></div>
               
			  <?php
			 }
		    ?>
           <div class="clearfix"></div>
          </div>
