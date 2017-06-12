              
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
                	<div class="ulTableinner sn-no-other" style="width:100px;">Full Name</div>
                	<div class="ulTableinner sn-no-other" style="width:175px;">Email</div>
                	<div class="ulTableinner sn-no-other" style="width:100px;">Date</div>                    
                    <div class="ulTableinner sn-no-other" style="width:125px;">Status</div>
                	<div class="ulTableinner sn-no-other" style="width:80px;">Campaign</div>                    
                	<div class="ulTableinner sn-no-other" style="width:80px;">Tools</div>
                    <?php /*?><div class="ulTableinner sn-no-other" style="width:60px;"><label><span class="tools_icon"><?php echo form_checkbox($deletion_attributes['remove_all']);  ?>&nbsp;<?php echo img(base_url()."images/".admin."/icons/tools/check.png");?></span></label></div><?php */?>
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
                 <div class="ulTableinner_record sn-no-other-record" style="width:100px;"><?php echo $user['full_name'];?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:175px;"><?php echo $user['email'];?></div>                 <div class="ulTableinner_record sn-no-other-record" style="width:100px;"><?php echo $user['signup_date'];?></div>                 
                 <div class="ulTableinner_record sn-no-other-record" style="width:125px;">
                  <?php
				  
				  
				   if($user['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/account/changestatus/'.$user['id'].'/1/manageusers/', 'Activate',array('title'=>'Active','class'=>'current_status_link'))." | <span class='current_status'>Inactive</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Active</span> | ".anchor(base_url().admin.'/account/changestatus/'.$user['id'].'/0/manageusers/', 'Deactivate',array('title'=>'Inactive'));
				   }
                  ?>
                  </div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:80px;">
                 <?php
                 if($user['is_campaign'] > 0) echo "Yes"; else echo "No";
				 
				 ?>	 
                 
                  
                  </div>

                 <div class="ulTableinner_record sn-no-other-record" style="width:80px;">
                 	 
                 <a href="<?php echo base_url().admin;?>/account/view-details/<?php echo $user['id'];?>" title="View Details">&nbsp;View Details</a>
                  
                  </div>
                  
                    <?php /*?><div class="ulTableinner_record sn-no-other-record" style="width:60px;">
                    <?php
					 echo form_checkbox($deletion_attributes['data'.$i]);
					?>
                    
                    
                    
                 </div><?php */?>
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
					 // echo form_submit($deletion_attributes['delete_all']);
                     ?>
                     </div>
                     <div id="single_remove" style="display: none">
                     <?php
					 // echo form_submit($deletion_attributes['delete']);
                     ?>
                     </div>                         
                     <div id="remove_inactive" style="display: block">
                     <?php
					 // echo form_submit($deletion_attributes['delete_all']);
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