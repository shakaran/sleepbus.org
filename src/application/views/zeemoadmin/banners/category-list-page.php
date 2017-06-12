           <div style="padding-bottom:20px;padding-right:20px;">
            <div id="input_text">
			<div id="submenu" style="padding:40px 40px 20px 40px;">
 			<?php
  			if(count($submenus) > 0)
  			{
   			 ?>
    		 <ul>
     		 <?php
	  		 foreach($submenus as $submenu)
	  		 {
	          ?>
	          <li><a title="<?php echo $submenu['name'];?>" href="<?php echo base_url().admin."/banners/".$submenu['url'];?>" <?php if($submenu['url'] == $section){ echo "class='active'";}?>><span><?php echo $submenu['name'];?></span></a></li>
	          <?php 
	         }
	         ?>
            </ul>
           <?php	   
          }
          ?>
          </div>
           <?php
		    if($section == "products-default-banner")
			{
			 ?>
			  <div align="left" style="padding-left:42px;">
			  <?php
			   $js_function="OpenBannerForm('".base_url()."','0','products','dynamic')";
			   if(empty($banner_details['current_image']))
			   {
			    echo form_submit('add_image','Add Banner','onclick="'.$js_function.'"');
				?>
				 <div class="remarks" style="text-align:center"><b> Banner has not been added</b></div>
				<?php
			   }
			   else
			   {
			    echo form_submit('add_image','Update Banner','onclick="'.$js_function.'"');
				?>
                 <span style="padding-left:20px;">
                  <a href="<?php echo base_url().admin;?>/banners/ConfirmDelete/<?php echo $banner_details['banner_id'];?>/products_default_banner/0&iframe=true&width=294&height=112" rel="prettyPhoto"  style="color: #884400;  text-decoration: none;" > <?php echo form_button('delete','Delete');?></a>
                 </span>   
				 <span style="padding-left:20px;">
                  <b>Status : </b> 
                  <?php 
                   if($banner_details['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/banners/changestatus/'.$banner_details['banner_id'].'/1/products-default-banner/0', 'Show',array('title'=>'Show','style'=>'color: #884400;'))." | <span class='success'><b>Hidden</b></span>";
				   }
				   elseif($banner_details['status'] == 1)
				   {
				    echo "<span class='success'><b>Shown</b></span> | ".anchor(base_url().admin.'/banners/changestatus/'.$banner_details['banner_id'].'/0/products-default-banner/0', 'Hide',array('title'=>'Hide','style'=>'color: #884400;'));
				   }
                  ?>
                 </span>
                 <a href="javascript:void(0)" onclick="<?php echo $js_function;?>" style="text-decoration:none;">  				                 <div align="left" style="padding-top:20px;width:462px;">
                  <?php
				   echo img(base_url()."images/banners/".$banner_details['current_image']);?>
                   <div style="background-color:white;padding:10px 2px 10px 0px;color:#000">
                    <?php
                     echo $banner_details['details'];
					?>
                   </div>
                  </div>
                 </a>
				<?php
			   }
			   ?>
              </div>
			 <?php
			}
		    if($section == "category-banners")
			{
			 ?>
			  <div style="padding-left:38px;">
			 <?php	
				 ksort($category_navigation);
				 if(count($category_navigation) > 0)
				 {
				  echo "<span class='navigation'>Parent Categories: <a class='navigation_link' href=".base_url().admin."/".$active_module."/".$section.">Main Categories</a> >> </span>";	 
				  $count=0;
				  foreach($category_navigation as $navigation)
				  {
				   $count++;
                   if($count != count($category_navigation))
				   {
				    ?>
                    <span class='navigation'>
					<a class="navigation_link" href="<?php echo base_url().admin;?>/<?php echo $active_module."/".$section;?>/<?php echo $navigation['id'];?>/<?php echo $navigation['depth']+1;?>" title="<?php echo ucfirst($navigation['category_name']);?>"><?php echo ucfirst($navigation['category_name']);?></a></span>				 &nbsp;>>&nbsp;
					<?php
				   }
				   else
				   {
				    echo ucfirst($navigation['category_name']);


					
				    echo "<div>Select Parent Category : ";
					echo form_dropdown('parent_id',$parent_category_drop_down_attribute, $parent_id,"class='select_action' style='width:150px;' id='parent_id'  onchange=\"window.location='".base_url().admin."/".$active_module."/".$section."/'+this.value+'/$depth'\"");
					echo "</div>";
				   }

                 
				  }
				 }
			     ?>
                 </div>           
                <?php	 
			   }
		  
			  if(isset($all_banners) and count($all_banners) > 0)
			  {
					   
		      ?>  
              <div class="clearfix">&nbsp;</div>   
              <div class="clearfix"></div>   
              <div class="ulTable">
            
              <ul>
            	<li>
                	<div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div class="ulTableinner sn-no-other" style="width:150px;"><?php echo $item_name;?> Name</div>
                    <div class="ulTableinner sn-no-other" style="width:220px;">Banner</div>
                	<div class="ulTableinner sn-no-other" style="width:70px;">Status</div>
                	<div class="ulTableinner sn-no-other" style="width:215px;">Tools</div>
                    
                </li>
                
                
            
            </ul>
            
             
           </div>
            <div class="clearfix"></div>
           
           
			
              <!-- ------ end ------------>
              <div class="ulTable_record" id="recordList">
              
              <ul>
			  <?php
			  $i=1;
			  foreach($all_banners as $banner)
			  {
			    $upload_banner_for=ucfirst($banner['page_name']);
				$delete_section="category_banners/".$parent_id;
			 
			   ?>
			    <li id="recordsArray_<?php echo $banner['page_id'];?>">
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $i;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:150px;"><?php echo $banner['page_name'];?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="padding:2px;width:220px;">
                 <?php
				  if(!empty($banner['image_file']))
				  {
				   ?>
                   <a href="javascript:void(0)" onclick="OpenBannerForm('<?php echo base_url()?>','<?php echo $banner['page_id']?>','<?php echo $page_type;?>','<?php echo $banner['page_name']?>')" title="Edit" style="color: #884400;  text-decoration: none;"><img src="<?php echo base_url();?>images/banners/<?php echo $banner['image_file'];?>" width="200" height="90" /></a>
                   <?php
				  }
				  else
				  {
				   echo "<span class='remarks'><i>Banner has not been added</i></span>";
				  }
				  ?>
                   </div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:70px;">
                  <?php
				  if(!empty($banner['image_file']))
				  {
				   if($banner['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/banners/changestatus/'.$banner['banner_id'].'/1/'.$delete_section, 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/banners/changestatus/'.$banner['banner_id'].'/0/'.$delete_section, 'Hide',array('title'=>'Hide'));
				   }
				  }
				  else{ echo "&nbsp;";}
                  ?>
                  </div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:215px;">
                 
                 <?php
				  if((($category_level > ($banner['depth']+1)) or ($category_level == 0)))
				  {
   			       if($is_subcategory[$banner['page_id']] == "yes")
				   {		
					?>
					 <a href="<?php echo base_url().admin;?>/<?php echo $active_module;?>/<?php echo $section;?>/<?php echo $banner['page_id'];?>/<?php echo $banner['depth']+1;?>" title="View Subcategories">View Subcategories&nbsp; | &nbsp;</a>   
                     <?php
					}
					else
					{
					 ?>
					  <span class="remarks">&nbsp;&nbsp;&nbsp;No Subcategories </span>&nbsp; | &nbsp;
                     <?php
					}
				   }
                  ?>
                 
                  <a href="javascript:void(0)" onclick="OpenBannerForm('<?php echo base_url()?>','<?php echo $banner['page_id']?>','<?php echo $page_type;?>','dynamic')" title="Edit" style="color: #884400;  text-decoration: none;">&nbsp;Edit</a>
                 
                <?php 
				 if(!empty($banner['image_file']))
				 {
                  ?>  
				  <span class="gallery">
                    &nbsp; |&nbsp;<a href="<?php echo base_url().admin;?>/banners/ConfirmDelete/<?php echo $banner['banner_id'];?>/<?php echo $delete_section;?>&iframe=true&width=294&height=112" rel="prettyPhoto"  style="color: #884400;  text-decoration: none;" >&nbsp;Delete</a>
                   </span>                  
                  <?php
				 }
                 ?>
                 </div>
                 <div class="clearfix"></div>
                </li>
			   <?php
			   $i++;
			  }
			  ?>
               </ul>
			  </div>
              
			                 
              <div class="clear"></div>
			   <?php
			 
			  
   		     }
			?>  
                     
                     
            </div>
           </div>
