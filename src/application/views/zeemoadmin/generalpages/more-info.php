            <div class="record_list">
			   <div align="left" style="padding-left:42px;">
			   <?php
			   $js_function="OpenMoreInfoForm('".base_url().admin."/generalpages/add-more-info-item')";
			  
			   echo form_submit('add_item','Add Item','onclick="'.$js_function.'"');
			   
			   ?>
               </div>
             <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                          
              <div style="clear:both"></div>
             <?php
			 
			 if(count($info_list) > 0)
		     {
              echo form_open(base_url().admin.'/generalpages/moreinfo-section',$deletion_attribute['form']);
		     ?>
             <!-- Data needed for multiple deletion-->
              <input type="hidden" name="total_data" id="total_data" value="<?php echo $deletion_attribute['total_data']?>" />              <input type="hidden" name="parent_id" id="parent_id" value="0" />  
             <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $deletion_attribute['deletion_path']?>" /> 
			  
              
                           
             <br />
             <div class="ulTable">
            
            <ul><!--<li style="width:865px; font-family:Arial, Helvetica, sans-serif; text-align:left; padding-bottom:10px;color:#636466;"><span style="color:#F30; font-weight:bold;">* </span> First three items are displaying on home page</li>-->
            	<li>
                	<div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div class="ulTableinner sn-no-other" style="width:130px;">Title</div>
                    <div class="ulTableinner sn-no-other" style="width:250px;">Image</div>  
                    <div class="ulTableinner sn-no-other" style="width:110px;">Status</div>
                	<div class="ulTableinner sn-no-other" style="width:70px;">Tools</div>
                    <div class="ulTableinner sn-no-other" style="width:80px;"><label> <span class="tools_icon"><?php echo form_checkbox($deletion_attribute['remove_all']);?>&nbsp;<?php echo img(base_url()."images/".admin."/icons/tools/check.png");?></span></label></div>
                </li>
                
            
            </ul>
            
             
           </div>
            <div class="clearfix"></div>
           
           
           <?php
            if(count($info_list) > 0)
			{
			 ?>
			 <!--Data Needed for Positioning-->
              <input type="hidden" name="parent_id" value="0" id="parent_id" />
              <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".MORE_INFO_SECTION;?>" id="file_path" />             
              <div class="ulTable_record" id="recordList">
              
              <ul>
			  <?php
			  $i=1;
			  $j=1;
			  foreach($info_list as $image)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $image['id'];?>" style="padding:2px;">
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:130px;"><?php echo ucwords($image['info_title']);?>&nbsp;</div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:245px;">
                 <?php
				  if(!empty($image['image_file']))
				  {
				   ?>
				    <img src="<?php echo base_url();?>images/generalpages/<?php echo $image['image_file'];?>"  width="150" height="100" />
				   <?php
				  }
				  else
				  {
				   echo "&nbsp;";
				  }
                 ?>
                   
                  </div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:105px;">
                  <?php
				   if($image['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/generalpages/changestatus/'.$image['id'].'/1/more_info_section', 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   elseif($image['status'] == 1)
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/generalpages/changestatus/'.$image['id'].'/0/more_info_section', 'Hide',array('title'=>'Hide'));
				   }
                  ?>
                  </div>
                  
                 <div class="ulTableinner_record sn-no-other-record" style="width:60px;">&nbsp;  
                  <?php
                  $js_edit_function="OpenEditMoreInfoForm('".base_url().admin."/generalpages/EditMoreInfoSection','".$image['id']."')";
				  ?>
                   <a href="javascript:void(0)" onclick="<?php echo $js_edit_function;?>" title="Edit"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/edit.png");?></span>&nbsp;Edit</a>
                   
                    
                    
                    
                    
                    
                    </div>
                    <div class="ulTableinner_record sn-no-other-record" style="width:80px;">
                     <?php
					
					 echo "&nbsp; &nbsp;&nbsp; &nbsp;".form_checkbox($deletion_attribute['data'.$i]);
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
                	<div class="ulTableinner_record sn-no-other" style="width:150px;">
					</div>
                	<div class="ulTableinner_record sn-no-other" style="width:324px;">&nbsp;</div>
                    <div class="ulTableinner_record sn-no-other" style="width:86px;"><span class="tools_icon">
                     <div id="remove_active" style="display:none">
                     <?php
					  echo form_submit($deletion_attribute['delete_all']);
                     ?>
                     </div>
                     <div id="single_remove" style="display: none">
                     <?php
					  echo form_submit($deletion_attribute['delete']);
                     ?>
                     </div>                         
                     <div id="remove_inactive" style="display: block">
                     <?php
					  echo form_submit($deletion_attribute['delete_all']);
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
			 elseif(empty($page_id))
			 {
			  ?>
			   <div class="success"> No records found.</div>
			  <?php
			 }
			 else
			 {
			  ?>
			   <div class="success"> No Images Found.</div>
			  <?php
			 }
		    ?>
           <div class="clearfix"></div>
          </div>
