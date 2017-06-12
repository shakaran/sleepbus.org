          <div class="record_list">
           <?php
		   if(count($level_list) > 0)
		   {
		    ?>
            <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
            <!-- Data needed for multiple deletion-->   
            <?php
             echo form_open(base_url().admin.'/modules/manage',$attribute['form']);
		    ?>
            <input type="hidden" name="total_data" id="total_data" value="<?php echo $attribute['total_data']?>" />  
            <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $attribute['deletion_path']?>" />   
            <div class="ulTable">
            
             <ul>
            	<li>
                	<div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div class="ulTableinner sn-no-other">Level Name</div>
                	<div class="ulTableinner sn-no-other" style="width:150px;">Status</div>
                	<div class="ulTableinner sn-no-other" style="width:182px;">Tools</div>
                    <div class="ulTableinner sn-no-other" style="width:78px;"><label><span class="tools_icon"><?php echo form_checkbox($attribute['remove_all']);?>&nbsp;<?php echo img(base_url()."images/".admin."/icons/tools/check.png");?></span></label></div>
                </li>
                
            
            </ul>
            
             
           </div>
            <div class="clearfix"></div>
           
           
             <!--Data Needed for Positioning-->
              <input type="hidden" name="parent_id" value="0" id="parent_id" />
              <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".ADMIN_MODULES;?>" id="file_path" />
              <div class="ulTable_record" id="recordList">
              
              <ul>
			  <?php
			  $i=1;
			  $j=1;
			  foreach($level_list as $level)
			  {
			   ?>
			    <li>
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
                 <div class="ulTableinner_record sn-no-other-record"><?php echo ucwords($level['name']);?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:150px;">
                  <?php
				   if($level['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/user/changestatus/'.$level['id'].'/1/managelevels', 'Active',array('title'=>'Active'))." | <span class='current_status'>Inactive</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Active</span> | ".anchor(base_url().admin.'/user/changestatus/'.$level['id'].'/0/managelevels', 'Inactive',array('title'=>'Inactive'));
				   }
                  ?>
                  </div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:200px;">
                  
				   <?php echo anchor(base_url().admin.'/user/adduser/'.$level['id'], 'Add User',array('title'=>'Add User'));?>&nbsp; | &nbsp;
                   <?php echo anchor(base_url().admin.'/user/manageusers/'.$level['id'], 'Manage Users',array('title'=>'Manage Users'));?>&nbsp; |                    
                   
                    <a href="<?php echo base_url().admin;?>/user/editlevel/<?php echo $level['id'];?>" title="Edit"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/edit.png");?></span>&nbsp;Edit</a>
                    </div>
                    <div class="ulTableinner_record sn-no-other-record" style="width:60px;"><span class="tools_icon">
                    <?php
					 echo form_checkbox($attribute['data'.$i]);
					 $i++;
					?>
                    </span>
                    
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
                	<div class="ulTableinner_record sn-no-other" style="width:154px;">&nbsp;</div>
                    <div class="ulTableinner_record sn-no-other" style="width:106px;text-align:right"><span class="tools_icon">
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
		    echo form_close();
		   }
		   else
		   {
			?>
			 <div class="clearfix"></div>
			 <div class="error1"> No Level(s) Found</div>   
		    <?php
           }
		  ?>
          
          <div class="clearfix"></div>
          </div>
