            <div class="record_list">
             <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
             <!-- Data needed for multiple deletion-->   
             <?php
			 if(count($faq_list) > 0)
		     {

              echo form_open(base_url().admin.'/faq/manage-faqs',$attribute['form']);
		     ?>
             <input type="hidden" name="total_data" id="total_data" value="<?php echo $attribute['total_data']?>" />  
             <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $attribute['deletion_path']?>" />   
             <div class="ulTable">
            
            <ul>
            	<li>
                	<div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div class="ulTableinner sn-no-other" style="width:350px;">Question</div>
                	<div class="ulTableinner sn-no-other" style="width:85px;">Status</div>
                	<div class="ulTableinner sn-no-other" style="width:108px;">Tools</div>
                    <div class="ulTableinner sn-no-other" style="width:96px;"><label><span class="tools_icon"><?php echo form_checkbox($attribute['remove_all']);?>&nbsp;<?php echo img(base_url()."images/".admin."/icons/tools/check.png");?></span></label></div>
                </li>
                
            
            </ul>
            
             
           </div>
            <div class="clearfix"></div>
           
           
           <?php
            if(count($faq_list) > 0)
			{
			 ?>
             <!--Data Needed for Positioning-->
              <input type="hidden" name="parent_id" value="0" id="parent_id" />
              <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".FAQ;?>" id="file_path" />
              <div class="ulTable_record" id="recordList">
              
              <ul>
			  <?php
			  $i=1;
			  $j=1;
			  foreach($faq_list as $faq)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $faq['id'];?>">
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:350px;"><?php echo $faq['question'];?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:85px;">
                  <?php
				   if($faq['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/faq/changestatus/'.$faq['id'].'/1/manage-faqs', 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/faq/changestatus/'.$faq['id'].'/0/manage-faqs', 'Hide',array('title'=>'Hide'));
				   }
                  ?>
                  </div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:108px;">
                 <a href="<?php echo base_url().admin;?>/faq/edit-faq/<?php echo $faq['id'];?>" title="Edit">Edit</a>
                   
                    
                    
                    
                    
                    
                    </div>
                    <div class="ulTableinner_record sn-no-other-record" style="width:96px;">
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
                	<div class="ulTableinner_record sn-no-other" style="width:154px;">&nbsp;</div>
                    <div class="ulTableinner_record sn-no-other" style="width:106px;"><span class="tools_icon">
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
			   <div class="success"> No faq(s) found.</div>
			  <?php
			 }
		    ?>
           <div class="clearfix"></div>
          </div>
