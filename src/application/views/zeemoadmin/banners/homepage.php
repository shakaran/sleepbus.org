           <div style="padding-bottom:30px;padding-right:20px;">
            <div id="input_text">
             <?php
			 
		    $upload_banner_for="Home Page";
		    $js_function="OpenBannerForm('".base_url()."','0','homepage','".$upload_banner_for."')";
			?>
            <div class="gallery" align="right" style="padding-right:18px;padding-top:8px;display:none;">
               <a href="<?php echo base_url().admin."/banners/setTimeInterval"?>&iframe=true&width=345&height=148" rel="prettyPhoto" class="link1">Click here</a> to update interval time of banner slider
              </div>
			<div style="padding:30px;">
			<?php
		    echo form_submit('add_image','Add New Banner','onclick="'.$js_function.'"');
			?>
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
                	<div class="ulTableinner sn-no-other">Banner</div>
                	<div class="ulTableinner sn-no-other" style="width:180px;">Banner URL</div>
                	<div class="ulTableinner sn-no-other" style="width:105px;">Status</div>
                	<div class="ulTableinner sn-no-other" style="width:148px;">Tools</div>
                </li>
                
                
            
            </ul>
            
             
           </div>
            <div class="clearfix"></div>
           
           
           <?php
             echo form_open(base_url().admin.'/banners/homepage',$deletion_attributes['form']);
		     ?>
			  <input type="hidden" name="total_data" id="total_data" value="<?php echo $deletion_attributes['total_data']?>" />    
			  <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $deletion_attributes['deletion_path']?>" />              
			
             <!-- Mandatory attributes for  positioning as well as change status -->
              <input type="hidden" name="parent_id" value="0" id="parent_id" />
              <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".HOMEPAGE_BANNERS;?>" id="file_path" />
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
                 <div class="ulTableinner_record sn-no-other-record" style="padding:2px;"><img src="<?php echo base_url();?>images/banners/<?php echo $banner['image_file'];?>" width="180" height="60" /></div>
                 <div class="ulTableinner_record sn-no" style="width:180px;"><?php echo $banner['url'];?>&nbsp;</div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:105px;">
                  <?php
				  if($total_shown_banner == 1 and $banner['status'] == 1)
				  {
				   echo "<span class='current_status'>Show</span>";
				  }
				  elseif($banner['status'] == 0)
				  {
				    echo anchor(base_url().admin.'/banners/changestatus/'.$banner['id'].'/1/homepage', 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/banners/changestatus/'.$banner['id'].'/0/homepage', 'Hide',array('title'=>'Hide'));
				   }
                  ?>
                  </div>
                  <?php
				   $js_function="OpenBannerForm('".base_url()."','".$banner['id']."','homepage','Home Page')";
				   
                  ?>
                 <div class="ulTableinner_record sn-no-other-record" style="width:148px;">
                  <a href="javascript:void(0)" title="Edit" style="color: #884400;  text-decoration: none;" onclick="<?php echo $js_function;?>"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/edit.png");?></span>&nbsp;Edit</a>
                  <?php
                   if($total_shown_banner == 1 and $banner['status'] == 1)
				   {
				    echo "&nbsp;";
				   }
				   else
				   {
				    ?>
                    <span class="gallery">
                    &nbsp; |&nbsp;<a href="<?php echo base_url().admin;?>/banners/ConfirmDelete/<?php echo $banner['id'];?>/homepage_banner&iframe=true&width=294&height=112" rel="prettyPhoto"  style="color: #884400;  text-decoration: none;" > <span class="tools_icon"> <?php echo img(base_url()."images/".admin."/icons/tools/drop.png");?></span>&nbsp;Delete</a>
                   </span>
                    <?
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
			 
			  echo form_close();
   		     }
			?>  
                     
                     
                     
                     
                     
                     
                     
                     
                    </div>
                   </div>
