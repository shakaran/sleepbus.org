           <div style="padding-bottom:30px;padding-right:20px;">
            <div id="input_text">
            <div class="main_heading" style="padding:30px 30px 0px 41px;">
             <?php echo $submodule_details['module_name'];?>
             <div class="success" style="text-align:left; padding:20px 0px 0px 0px; color:#5685A6">Page list having single page content</div>
            </div>
            <?php					 
			if(count($all_banners) > 0)
			{
					   
		     ?>  
             <div class="clearfix">&nbsp;</div>   
             <div class="clearfix"></div>   
             <div class="ulTable">
            
             <ul>
            	<li>
                	<div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div class="ulTableinner sn-no-other" style="width:150px;">Page Name</div>
                    <div class="ulTableinner sn-no-other" style="width:275px;">Banner</div>
                	<div class="ulTableinner sn-no-other" style="width:115px;">Status</div>
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
			  foreach($all_banners as $banner)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $banner['id'];?>">
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $i;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:150px;"><?php echo $banner['page_name'];?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="padding:2px;width:267px;">
                 <?php
				  if(!empty($banner['image_file']))
				  {
				   ?>
                   <a href="javascript:void(0)" onclick="OpenBannerForm('<?php echo base_url()?>','<?php echo $banner['page_id']?>','<?php echo $banner['page_type'];?>','<?php echo $banner['page_name']?>')" title="Edit" style="color: #884400;  text-decoration: none;"><img src="<?php echo base_url();?>images/banners/<?php echo $banner['image_file'];?>" width="200" height="90" /></a>
                   <?php
				  }
				  else
				  {
				   echo "<span class='remarks'><i>Banner has not been added</i></span>";
				  }
				  ?>
                   </div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:115px;">
                  <?php
				   if($banner['id'] == 1) echo "&nbsp;";
				   elseif(!empty($banner['image_file']))
				   {
				    if($banner['status'] == 0)
				    {
				     echo anchor(base_url().admin.'/banners/changestatus/'.$banner['id'].'/1/banner_in_a_glance', 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				    }
				    else
				    {
				     echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/banners/changestatus/'.$banner['id'].'/0/banner_in_a_glance', 'Hide',array('title'=>'Hide'));
				    }
				   }
				   else
				   {
				    echo "&nbsp;";
				   }
                  ?>
                  </div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:120px;">
                  <a href="javascript:void(0)" onclick="OpenBannerForm('<?php echo base_url()?>','<?php echo $banner['page_id']?>','<?php echo $banner['page_type'];?>','<?php echo $banner['page_name']?>')" title="Edit" style="color: #884400;  text-decoration: none;"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/edit.png");?></span>&nbsp;Edit</a>
                 
                <?php 
				 if($banner['page_name'] != "Home Page" and $banner['page_name'] != "Default Banner" and !empty($banner['image_file']))
				 {
                  ?>  
				  <span class="gallery">
                    &nbsp; |&nbsp;<a href="<?php echo base_url().admin;?>/banners/ConfirmDelete/<?php echo $banner['id'];?>/banner&iframe=true&width=294&height=112" rel="prettyPhoto"  style="color: #884400;  text-decoration: none;" > <span class="tools_icon"> <?php echo img(base_url()."images/".admin."/icons/tools/drop.png");?></span>&nbsp;Delete</a>
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
