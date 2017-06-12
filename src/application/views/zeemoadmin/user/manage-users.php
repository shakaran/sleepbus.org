         <?php
		  if($user_id == 1)
		  {
          ?>
           <div style="padding:25px 25px 2px 40px;">
           <div class="main_heading" style="padding-bottom:10px;">
            Administrator Details
           </div>
   			<table width="100%" border="0" cellspacing="0" cellpadding="0">
                       <tr style="height: 25px">
                        <td width="30%" align="center" valign="middle" class="list_heading">Username</td> 
                        <td width="30%" align="center" valign="middle" class="list_heading">Name</td>
                        <td width="20%" align="center" valign="middle" class="list_heading">Email</td>
                        <td width="20%" align="center" valign="middle" class="list_heading">Tools</td>
                       </tr>                      
					   <tr style="background-color:#f8fafb;">
                        <td width="30%" align="center" valign="middle" class="cate_result1"><?php echo $admin_details['user'];?></td> 
                        <td width="30%" align="center" valign="middle" class="cate_result1"><?php echo $admin_details['fname']." ".$admin_details['lname'];?></td>
                        <td width="20%" align="center" valign="middle" class="cate_result1"><?php echo $admin_details['email'];?></td>
                        <td width="20%" align="center" valign="middle" class="cate_result1"><a href="<?php echo base_url().admin;?>/user/edituser/<?php echo $admin_details['id'];?>" title="Edit" style="color: #884400;  text-decoration: none;"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/edit.png");?></span>&nbsp;Edit</a></td>
                       </tr> 
                       <tr><td colspan="4">&nbsp;</td></tr>
                                   
                    </table>    
                  </div>          
                <?php
		       }
			  
			  ?>
              <table width="90%" style="padding-top:15px;">
              <tr>
                       <td><span class="main_heading" style="padding-bottom:10px;">User List</span></td>
                       <td colspan="3" class="cate_result1" style="font-weight:bold;text-align:right">
                       <?php
					    echo form_open(base_url().admin.'/user/manageusers','id=manageuser_dropdown_form');
						
                       ?>
                        Select Level : <?php echo form_dropdown('level_id',$attribute['level_id'],$level_id,"class='select_action' style='width:145px;' onchange=SubmitManageUserForm('".base_url().admin."/user/manageusers/'+this.value)");
						echo form_close();
						?>
                       </td>
                       </tr>    
              </table>
            <div style="padding-right:26px;padding-top:20px;padding-bottom:20px;">
            <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
            <?php
            if(count($user_list) > 0)
		    {
		     ?>  
             <div class="clearfix"></div>   
             <div class="ulTable">
            
             <ul>
            	<li>
                	<div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div class="ulTableinner sn-no-other" style="width:100px;">Username</div>
                	<div class="ulTableinner sn-no-other" style="width:175px;">Email</div>
                	<div class="ulTableinner sn-no-other" style="width:100px;">Level</div>                    
                    <div class="ulTableinner sn-no-other" style="width:125px;">Current Status</div>
                	<div class="ulTableinner sn-no-other" style="width:100px;">Tools</div>
                    <div class="ulTableinner sn-no-other" style="width:60px;"><label><span class="tools_icon"><?php echo form_checkbox($deletion_attributes['remove_all']);  ?>&nbsp;<?php echo img(base_url()."images/".admin."/icons/tools/check.png");?></span></label></div>
                </li>
            
            </ul>
            
             
           </div>
            <div class="clearfix"></div>
           
           
           <?php
             echo form_open(base_url().admin.'/modules/managesubmodules',$deletion_attributes['form']);
		     ?>
			  <input type="hidden" name="total_data" id="total_data" value="<?php echo $deletion_attributes['total_data']?>" />    
			  <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $deletion_attributes['deletion_path']?>" />              
              <div class="ulTable_record" id="recordList">
              
              <ul>
			  <?php
			  $i=1;
			  foreach($user_list as $user)
			  {
			   ?>
			    <li>
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $i;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:100px;"><?php echo $user['user'];?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:175px;"><?php echo $user['email'];?></div>                 <div class="ulTableinner_record sn-no-other-record" style="width:100px;"><?php echo $user['level_name'];?></div>                 
                 <div class="ulTableinner_record sn-no-other-record" style="width:125px;">
                  <?php
				   if($user['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/user/changestatus/'.$user['id'].'/1/manageusers/'.$level_id, 'Active',array('title'=>'Active','class'=>'current_status_link'))." | <span class='current_status'>Inactive</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Active</span> | ".anchor(base_url().admin.'/user/changestatus/'.$user['id'].'/0/manageusers/'.$level_id, 'Inactive',array('title'=>'Inactive'));
				   }
                  ?>
                  </div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:100px;">
                 <a href="<?php echo base_url().admin;?>/user/edituser/<?php echo $user['id'];?>" title="Edit"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/edit.png");?></span>&nbsp;Edit</a>
                  
                    </div>
                    <div class="ulTableinner_record sn-no-other-record" style="width:60px;">
                    <?php
					 echo form_checkbox($deletion_attributes['data'.$i]);
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
              
			   <div class="ulTable" style="padding-top:5px;">
               <ul>
            	<li>
                	<div class="ulTableinner_record sn-no">&nbsp;</div>
                	<div class="ulTableinner_record sn-no-other">&nbsp;</div>
                	<div class="ulTableinner_record sn-no-other" style="width:150px;">&nbsp;</div>
                	<div class="ulTableinner_record sn-no-other" style="width:59px;">&nbsp;</div>
                    <div class="ulTableinner_record sn-no-other" style="width:221px;text-align:right"><span class="tools_icon">
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
              
			   <?php
			  
			  echo form_close();
			
		   }
		   else
		   {
		    ?>
			 <div class="error1" style="padding-bottom:10px;"> No record(s) found</div>
			<?php
		   }
           ?>
           
           
           <div class="clearfix"></div>
           
         </div>