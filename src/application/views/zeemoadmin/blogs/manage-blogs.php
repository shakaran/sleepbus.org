            <div class="record_list">
             <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
             <!-- Data needed for multiple deletion-->   
             
             
           
             
             <?php
			 if(count($blog_list) > 0)
		     {
              echo form_open(base_url().admin.'/blogs/manage-blogs',$attribute['form']);
		      ?>
              <input type="hidden" name="total_data" id="total_data" value="<?php echo $attribute['total_data']?>" />  
              <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $attribute['deletion_path']?>" />   
              <div class="ulTable">
               <ul>
                <li>
                 <div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                 <div class="ulTableinner sn-no-other" style="width:195px;">Blog Name</div>
                 <div class="ulTableinner sn-no-other" style="width:140px;">Category Name</div>
                 
                 <div class="ulTableinner sn-no-other" style="width:140px; text-align:center">Status</div>
                 <div class="ulTableinner sn-no-other" style="width:97px; text-align:center">Tools</div>
                 <div class="ulTableinner sn-no-other" style="width:72px;"><label> <span class="tools_icon"><?php echo form_checkbox($attribute['remove_all']);?>&nbsp;<?php echo img(base_url()."images/".admin."/icons/tools/check.png");?></span></label></div>
                </li>
               </ul>
              </div>
             <div class="clearfix"></div>
             <?php
             if(count($blog_list) > 0)
			 {
			 ?>
              <!--Data Needed for Positioning-->
              <input type="hidden" name="parent_id" value="0" id="parent_id" />
              <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".BLOGS?>" id="file_path" />
              <div class="ulTable_record" id="recordList">
              <ul>
			  <?php
			  $i=1;
			  $j=1;
			  foreach($blog_list as $blog)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $blog['id'];?>" style="padding:2px;">
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:195px;"><?php echo $blog['blog_name'];?></div>
                  <div class="ulTableinner_record sn-no-other-record" style="width:140px;"><?php echo $blog['category'];?></div>
                 
                 <div class="ulTableinner_record sn-no-other-record" style="width:150px; text-align:center;  position:relative; top:2px;">
                  <?php
				   if($blog['display_on_home']!='1' && $blog['cat_status']=='1' && $blog['blogger_status']=='1')
				   {
				   if($blog['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/blogs/changestatus/'.$blog['id'].'/1/manage-blogs', 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/blogs/changestatus/'.$blog['id'].'/0/manage-blogs', 'Hide',array('title'=>'Hide'));
				   }
				   }
				   else echo "&nbsp;";
                  ?>
                  </div>
                  
                 <div class="ulTableinner_record sn-no-other-record" style="width:60px; text-align:center; position:relative; top:-3px;">
                 <a href="<?php echo base_url().admin;?>/blogs/edit-blog/<?php echo $blog['id'];?>/<?php echo $blog['cat_id'];?>/<?php echo $blog['blogger_id'];?>" title="Edit">Edit</a>&nbsp; 
                  </div>
                    <div class="ulTableinner_record sn-no-other-record" style="width:21px;vertical-align:middle; padding-left: 24px; padding-top:5px;">
                     
                         	<input type="checkbox" onclick="AdjustDeleteButton()" id="data<?=$i?>" value="<?php echo $blog['id'];?>" name="checked_ids[]">
                         <?php
					 /*echo form_checkbox($attribute['data'.$i]);*/
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
                	<div class="ulTableinner_record sn-no-other" style="width:70px;">&nbsp;</div>
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
			   <div class="success"> No blog found.</div>
			  <?php
			 }
		    ?>
           <div class="clearfix"></div>
          </div>
