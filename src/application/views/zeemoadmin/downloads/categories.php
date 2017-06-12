           <div style="padding-bottom:30px;padding-right:20px;padding-top:20px;">
            <div id="input_text">
             <?php
			 if(!empty($cat_id))
			 {
              echo form_open(base_url().admin.'/downloads/validatecategory/'.$cat_id,$attributes['form']);
			 }
			 else
			 {
              echo form_open(base_url().admin.'/downloads/validatecategory',$attributes['form']);
			 }
			 ?>
              <table width="98%" border="0" cellpadding="0" cellspacing="0" style="padding-left:38px;">
               <tr>
               <td colspan="2">
                <div class="main_heading"><?php echo $page_title;?></div>
               </td>
                <td colspan="2">
                       <div class="error1" id="error"><?php  if(isset($error_msg)) echo $error_msg; ?></div>
                       
                      </td>
                      
               </tr>
               
				
               
    		   <tr height="25" valign="bottom">
                 <td>*Category Name  &nbsp;&nbsp;<span id="error1" class="error2"><?php echo form_error('category_name');?></span></td>
                </tr>
                <tr>
                 <td style="padding-top:8px;">
                  <?php
                   echo form_input($attributes['category_name']);
				  ?>
                  &nbsp;
				  <?php
                   echo form_input($attributes['limit1']);
				  ?><span class="remarks">(*Maximum 75 chars)</span>
                  
                 </td>
                </tr>                       
                         
                         
                        <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
                         <?php
						  echo form_submit($attributes['submit']);
                         ?>
                       </td></tr>
                       <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
                       </td></tr>
                      </table> 
                     <?php
					  echo form_close();
					 
			if(count($all_categories) > 0)
			{
					   
		     ?>  
             <div class="clearfix">&nbsp;</div>   
             <div class="clearfix"></div>   
             <div class="ulTable">
            
             <ul>
            	<li>
                	<div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div class="ulTableinner sn-no-other" style="width:255px;">Category</div>
                	<div class="ulTableinner sn-no-other" style="width:100px;">Status</div>
                	
                    <div class="ulTableinner sn-no-other" style="width:200px;"> Tools &nbsp;</div>
                    <div class="ulTableinner sn-no-other" style="width:109px;"><label>
                    <span class="tools_icon"><?php echo form_checkbox($deletion_attributes['remove_all']);  ?>&nbsp;<?php echo img(base_url()."images/".admin."/icons/tools/check.png");?></span></label></div>
                </li>
                
                
            
            </ul>
            
             
           </div>
            <div class="clearfix"></div>
           
           
           <?php
             echo form_open(base_url().admin.'/downloads/categories',$deletion_attributes['form']);
		     ?>
			  <input type="hidden" name="total_data" id="total_data" value="<?php echo $deletion_attributes['total_data']?>" />    
			  <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $deletion_attributes['deletion_path']?>" />              
			
             <!-- Mandatory attributes for  positioning as well as change status -->
              <input type="hidden" name="parent_id" value="0" id="parent_id" />
              <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".DOWNLOAD_CATEGORIES;?>" id="file_path" />
              <!-- ------ end ------------>
              <div class="ulTable_record" id="recordList">
              
              <ul>
			  <?php
			  $i=1;
			  foreach($all_categories as $category)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $category['id'];?>">
                 <div class="ulTableinner_record sn-no" >&nbsp;&nbsp;<?php echo $i;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:247px;padding:2px;"><?php echo $category['category_name']?></div>
                 
                 <div class="ulTableinner_record sn-no-other-record" style="width:100px;">
                  <?php
				   if($category['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/downloads/changestatus/'.$category['id'].'/1/categories', 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/downloads/changestatus/'.$category['id'].'/0/categories', 'Hide',array('title'=>'Hide'));
				   }
                  ?>
                  </div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:200px;">
                  <?php
                  if(count($sub_modules) > 0)
				  {
				   foreach($sub_modules as $submodule)
				   {
				    if($submodule['url'] == "downloads/managedownloads")
					{
				     ?>   
                      <a href="<?php echo base_url().admin;?>/<?php echo $submodule['url'];?>/<?php echo $category['id'];?>" title="<?php echo $submodule['module_name'];?>"><?php echo $submodule['module_name'];?>&nbsp; | &nbsp;</a>
					 <?php
					}
				   }
				  }
				 ?>
                 
                  
                  <a href="<?php echo base_url().admin;?>/downloads/categories/<?php echo $category['id'];?>" title="Edit" style="color: #884400;  text-decoration: none;"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/edit.png");?></span>&nbsp;Edit</a>
                  </div>
                  <div class="ulTableinner_record sn-no-other-record" style="width:109px;">
                  <span class="gallery"><span class="tools_icon">
                    <?php
					 echo form_checkbox($deletion_attributes['data'.$i]);
					?></span>
                   </span>
                  
                  
                 </div>
                 <div class="clearfix"></div>
                </li>
			   <?php
			   $i++;
			  }
			  ?>
               </ul>
			  </div>
              
              
			   <div class="ulTable" style="padding-top:5px;">
               <ul>
            	<li>
                	<div class="ulTableinner_record sn-no">&nbsp;</div>
                	<div class="ulTableinner_record sn-no-other">&nbsp;</div>
                	<div class="ulTableinner_record sn-no-other" style="width:145px;">&nbsp;</div>
                	<div class="ulTableinner_record sn-no-other" style="width:184px;">&nbsp;</div>
                    <div class="ulTableinner_record sn-no-other" style="width:105px;"><span class="tools_icon">
                     <div id="remove_active" style="display:none">
                     <?php
					  echo form_submit($deletion_attributes['delete_all']);
                     ?>
                     </div>
                     <div id="single_remove" style="display: none">
                     <?php
					  echo form_submit($deletion_attributes['delete']);
                     ?>
                     </div>                         
                     <div id="remove_inactive" style="display: block">
                     <?php
					  echo form_submit($deletion_attributes['delete_all']);
                     ?>
					 </div></span>
                    </div>
                  </li>
                
            
                </ul>
            
             
               </div>              
              <div class="clear"></div>
			   <?php
			 
			  echo form_close();
   		     }
			?>  
                     
                     
                     
                     
                     
                     
                     
                     
                    </div>
                   </div>
