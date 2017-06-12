           <div style="padding-bottom:20px;padding-right:20px;">
            <div id="input_text">
            <div class="main_heading" style="padding:30px;font-weight:normal !important;">
             <?php
			 echo "Meta / Title Tags >> ".$submodule_details['module_name']." >> ";
			 echo $section_name;
             ?>
            </div>
			<div id="submenu" style="margin-left:40px;">
 			<?php
  			if(count($submenus) > 0)
  			{
   			 ?>
    		 <ul>
     		 <?php
	  		 foreach($submenus as $submenu)
	  		 {
	          ?>
	          <li><a title="<?php echo $submenu['name'];?>" href="<?php echo base_url().admin."/metatags/".$submenu['url'];?>" <?php if($submenu['url'] == $section){ echo "class='active'";}?>><span><?php echo $submenu['name'];?></span></a></li>
	          <?php 
	         }
	         ?>
            </ul>
           <?php	   
          }
          ?>
          </div>
          
          <div style="padding:35px;">
				<?php
				if($section == "product-metas")
				{
				 ksort($category_navigation);
				 if(count($category_navigation) > 0)
				 {
				  echo "<span class='navigation'> Parent Categories :  <a class='navigation_link' href=".base_url().admin."/".$active_module."/".$section.">Main Categories</a> >> </span>";	 
				  $count=0;
				  foreach($category_navigation as $navigation)
				  {
				   $count++;
                   if($count != count($category_navigation))
				   {
				    ?>
                    <span class='navigation'>
					<a class="navigation_link" href="<?php echo base_url().admin;?>/<?php echo $active_module."/".$section;?>/<?php echo $navigation['id'];?>/<?php echo $navigation['depth'];?>" title="<?php echo ucfirst($navigation['category_name']);?>"><?php echo ucfirst($navigation['category_name']);?></a></span>				 &nbsp;>>&nbsp;
					<?php
				   }
				   else
				   {
				    echo ucfirst($navigation['category_name']);


				   }

                 
				  }
				 }
				    echo "<div>&nbsp;&nbsp;Select Category : ";
					echo form_dropdown('category',$navigation_attributes['categories'], $category_id,"class='select_action' style='width:150px;' id='category'  onchange=\"window.location='".base_url().admin."/".$active_module."/".$section."/'+this.value+'/$depth'\"");
					
                   if(count($navigation_attributes['subcategories']) > 0 and ((($depth+1) < $category_level) or ($category_level==0)))
				   {
				    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subcategories : ";
					echo form_dropdown('subcategory',$navigation_attributes['subcategories'], '',"class='select_action' style='width:150px;' id='subcategory'  onchange=\"window.location='".base_url().admin."/".$active_module."/".$section."/'+this.value+'/".$navigation_attributes['subcategory_depth']."'\""); 
				   
				   }
				   else
				   {
				    if(($category_id > 0) and ((($depth+1) < $category_level) or ($category_level==0)))
					{
					 echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='navigation'>No Subcategories Found</span>";
					}
					
				   }					
					
					
					echo "</div>";
			  }
             ?>
			  </div>
			 <?php   
                
			if(count($all_pages) > 0)
			{
			 if($section == "product-metas")
			 {		   
		      ?>  
			  <div class="navigation" style="text-align:left;padding-left:38px;">List of products of category : <span style="color:gray"> <?php echo $category_details['category_name'];?></span></div>              <?php
			 }
			 ?>

             <div class="clearfix"></div>   
             <div class="ulTable">
            
             <ul>
            	<li>
                	<div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div class="ulTableinner sn-no-other" style="width:150px;">Page Name</div>
                	<div class="ulTableinner sn-no-other" style="width:390px;">Page Title</div>
                	<div class="ulTableinner sn-no-other" style="width:124px;">Tools</div>
                    
                </li>
                
                
            
            </ul>
            
             
           </div>
            <div class="clearfix"></div>
           
           
			
              <!-- ------ end ------------>
              <div class="ulTable_record" id="recordList">
              
              <ul>
			  <?php
			  $i=1;
			  foreach($all_pages as $page)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $page['id'];?>" <?php if($page['id'] == '0'){ $i=""; ?> style="background-color:white;"<?php }?>>
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $i;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:150px;">
				 <?php echo $page['page_name']; if($page['id'] == '0'){ ?> <span style="color:#FF8000"><b>(Main Page)</b></span> <?php }?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:386px;padding:2px;"><?php echo $page['meta']['page_title'];?></div>
                 
                 
                 <div class="ulTableinner_record sn-no-other-record" style="width:120px;">
                  <a href="javascript:void(0)" onclick="OpenMetatagsForm('<?php echo base_url()?>','<?php echo $page['id']?>','<?php echo $page_type;?>','<?php echo $section_name;?>','<?php echo $section;?>')" title="Edit" style="color: #884400;  text-decoration: none;"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/edit.png");?></span>&nbsp;Edit</a>
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
			 elseif($category_id > 0)
			 {
			  ?>
			  <div class="success"> No product found.</div>
			  <?php
			 }
			?>  
                     
                     
            </div>
           </div>
