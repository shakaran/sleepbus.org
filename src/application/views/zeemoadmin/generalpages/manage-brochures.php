            <div class="record_list">
             
             

             <?php
              echo form_open(base_url().admin.'/generalpages/managedownloads',$drop_down_attributes['form']);
			 ?>
             <div style="color: #636466;font-family: Arial;font-size: 11px;font-weight: bold;text-align: left;padding-left:42px;padding-bottom:20px;">
             *Select a page :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_dropdown('page_id',$drop_down_attributes['page_id'],$page_id,"class='select_action' style='width:285px;' id='page_id' onchange=SubmitManageImageForm('".base_url().admin."/generalpages/managedownloads/'+this.value)");?>&nbsp;<span id="error1" class="error2"><?php echo form_error('page_id');?></span>
             </div>
             <?php
              if(!empty($page_id))
			  {
			   ?>
			   <div align="left" style="padding-left:42px;">
			   <?php
			    $js_function="OpenAddBrochureForm('".base_url().admin."/generalpages/AddBrochure','".$page_id."')";
			    echo form_submit('add_image','Upload Single Brochure','onclick="'.$js_function.'"');
			   if(!(preg_match('/(?i)msie [1-9]/',$_SERVER['HTTP_USER_AGENT'])))
			   {
			    $js_function="OpenAddBrochureForm('".base_url().admin."/generalpages/BrochureUploader','".$page_id."')";
				echo "&nbsp;&nbsp;".form_submit('add_image','Upload Bulk of Brochures','onclick="'.$js_function.'"');
			   }
			   
			   ?>
               </div>
               
			   <?php
			  }
			 ?>
             <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
             <!--Data Needed for Positioning-->
              <input type="hidden" name="parent_id" value="<?php echo $page_id;?>" id="parent_id" />
              <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".PAGE_BROCHURES;?>/page_id" id="file_path" />
             <?php
			 echo form_close();
			 if(count($brochure_list) > 0)
		     {
              echo form_open(base_url().admin.'/generalpages/managedownloads',$deletion_attribute['form']);
		     ?>
             <!-- Data needed for multiple deletion-->
              <input type="hidden" name="total_data" id="total_data" value="<?php echo $deletion_attribute['total_data']?>" />  
             <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $deletion_attribute['deletion_path']?>" /> 
             <br />
             <div class="ulTable">
            
            <ul>
            	<li>
                	<div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div class="ulTableinner sn-no-other" style="width:280px;">Title</div>
                    <div class="ulTableinner sn-no-other" style="width:110px;">Status</div>
                	<div class="ulTableinner sn-no-other" style="width:110px;">Tools</div>
                    <div class="ulTableinner sn-no-other" style="width:140px;"><label> <span class="tools_icon"><?php echo form_checkbox($deletion_attribute['remove_all']);?>&nbsp;<?php echo img(base_url()."images/".admin."/icons/tools/check.png");?></span></label></div>
                </li>
                
            
            </ul>
            
             
           </div>
            <div class="clearfix"></div>
           
           
           <?php
            if(count($brochure_list) > 0)
			{
			 ?>
             
              <div class="ulTable_record" id="recordList">
              
              <ul>
			  <?php
			  $i=1;
			  $j=1;
			  foreach($brochure_list as $brochure)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $brochure['id'];?>" style="padding:2px;">
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:275px;"><a href="<?php echo base_url()."brochures/generalpages/".$brochure['brochure_file'];?>" target="_blank"><?php echo ucwords($brochure['brochure_title']);?></a>&nbsp;</div>
                 
                 <div class="ulTableinner_record sn-no-other-record" style="width:105px;">
                  <?php
				   if($brochure['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/generalpages/changestatus/'.$brochure['id'].'/1/managedownloads/'.$page_id, 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   elseif($brochure['status'] == 1)
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/generalpages/changestatus/'.$brochure['id'].'/0/managedownloads/'.$page_id, 'Hide',array('title'=>'Hide'));
				   }
                  ?>
                  </div>
                  
                 <div class="ulTableinner_record sn-no-other-record" style="width:100px;">&nbsp;  
                  <?php
                  $js_edit_function="OpenEditBrochureForm('".base_url().admin."/generalpages/EditBrochure','".$page_id."','".$brochure['id']."')";
				  ?>
                   <a href="javascript:void(0)" onclick="<?php echo $js_edit_function;?>" title="Edit">&nbsp;Edit</a>

                  | <a target="_blank" href="<?php echo base_url()."brochures/generalpages/".$brochure['brochure_file'];?>" title="View">&nbsp;View</a>
                    
                    
                    
                    
                    
                    </div>
                    <div class="ulTableinner_record sn-no-other-record" style="width:100px;">
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
                	<div class="ulTableinner_record sn-no-other" style="width:234px;">&nbsp;</div>
                    <div class="ulTableinner_record sn-no-other" style="width:156px;"><span class="tools_icon">
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
			   <div class="success"> Please select a page</div>
			  <?php
			 }
			 else
			 {
			  ?>
			   <div class="success"> No brochure(s) Found.</div>
			  <?php
			 }
		    ?>
           <div class="clearfix"></div>
          </div>
