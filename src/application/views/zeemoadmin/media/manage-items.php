            <div class="record_list">
             <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
             
              <div style="text-align:left;padding:0px 0px 10px 35px;">
               <span class="main_heading">Manage Items</span>
               </span>
              </div>
             
             <?php
			 if(count($media_list) > 0)
		     {
              echo form_open(base_url().admin.'/medias/manage-items',$attribute['form']);
		      ?>
              <input type="hidden" name="total_data" id="total_data" value="<?php echo $attribute['total_data']?>" />  
              <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $attribute['deletion_path']?>" />   
              <div class="ulTable">
               <ul>
                <li>
                 <div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                 <div class="ulTableinner sn-no-other" style="width:200px;">Topic</div>
                 <div class="ulTableinner sn-no-other" style="width:245px;">Publication</div>
                 <div class="ulTableinner sn-no-other" style="width:70px; text-align:center">Status</div>
                 <div class="ulTableinner sn-no-other" style="width:80px; text-align:center">Tools</div>
                 <div class="ulTableinner sn-no-other" style="width:50px;"><label> <span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/check.png");?>&nbsp;<?php echo form_checkbox($attribute['remove_all']);?>&nbsp;</span></label></div>
                </li>
               </ul>
              </div>
             <div class="clearfix"></div>
             <?php
             if(count($media_list) > 0)
			 {
			 ?>
              <!--Data Needed for Positioning-->
            <input type="hidden" name="parent_id" id="parent_id" value="0" />                
              <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".MEDIA_ITEMS;?>" id="file_path" />
              
              <div class="ulTable_record" id="recordList">
              <ul>
			  <?php
			  $i=1;
			  $j=1;
			  
			  foreach($media_list as $media)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $media['id'];?>" style="padding:2px;">
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:200px;"><a href="<?php echo $media['url'];?>" target="_blank"><?php echo $media['media_title'];?></a></div>
				 <div class="ulTableinner_record sn-no-other-record" style="width:245px;"><?php echo $media['publication'];?></div>                 
                 <div class="ulTableinner_record sn-no-other-record" style="width:65px; text-align:center">
                  <?php
				   if($media['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/media/changestatus/'.$media['id'].'/1/manage-items/', 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/media/changestatus/'.$media['id'].'/0/manage-items/', 'Hide',array('title'=>'Hide'));
				   }
                  ?>
                  </div>
                  
                 <div class="ulTableinner_record sn-no-other-record" style="width:100px; text-align:center; vertical-align:baseline;">
                 
				                                              
                 <a href="<?php echo base_url().admin;?>/media/edit-item/<?php echo $media['id'];?>" title="Edit">Edit</a>
                   
                  </div>
                    <div class="ulTableinner_record sn-no-other-record" style="width:20px;">
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
			   <div class="success"> No medias found.</div>
			  <?php
			 }
		    ?>
           <div class="clearfix"></div>
          </div>
