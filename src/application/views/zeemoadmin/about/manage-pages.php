            <div class="record_list">
             <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                          
              <div style="clear:both"></div>
             <?php
			 
			 if(count($item_list) > 0)
		     {
              echo form_open(base_url().admin.'/about/about-section',$deletion_attribute['form']);
		     ?>
             <!-- Data needed for multiple deletion-->
              <input type="hidden" name="total_data" id="total_data" value="<?php echo $deletion_attribute['total_data']?>" />              <input type="hidden" name="parent_id" id="parent_id" value="0" />  
             <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $deletion_attribute['deletion_path']?>" /> 
			  
              
                           
             <br />
             <div class="ulTable">
            
            <ul><!--<li style="width:865px; font-family:Arial, Helvetica, sans-serif; text-align:left; padding-bottom:10px;color:#636466;"><span style="color:#F30; font-weight:bold;">* </span> First three items are displaying on home page</li>-->
            	<li>
                	<div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div class="ulTableinner sn-no-other" style="width:200px;">Page Title</div>
                    <div class="ulTableinner sn-no-other" style="width:160px;">Status</div>
                	<div class="ulTableinner sn-no-other" style="width:182px;">Tools</div>
                    <div class="ulTableinner sn-no-other" style="width:100px;"><label> <span class="tools_icon"><?php echo form_checkbox($deletion_attribute['remove_all']);?>&nbsp;<?php echo img(base_url()."images/".admin."/icons/tools/check.png");?></span></label></div>
                </li>
                
            
            </ul>
            
             
           </div>
            <div class="clearfix"></div>
           
           
           <?php
            if(count($item_list) > 0)
			{
			 ?>
			 <!--Data Needed for Positioning-->
              <input type="hidden" name="parent_id" value="0" id="parent_id" />
              <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".ABOUT_SECTION;?>" id="file_path" />             
              <div class="ulTable_record" id="recordList">
              
              <ul>
			  <?php
			  $i=1;
			  $j=1;
			  foreach($item_list as $item)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $item['id'];?>" style="padding:2px;">
                 <div class="ulTableinner_record sn-no" style="width: 46px;">&nbsp;&nbsp;<?php echo $j;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:190px;"><?php echo ucwords($item['item_title']);?>&nbsp;</div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:160px;">
                  <?php
				   if($item['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/about/changestatus/'.$item['id'].'/1/manage-pages', 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   elseif($item['status'] == 1)
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/about/changestatus/'.$item['id'].'/0/manage-pages', 'Hide',array('title'=>'Hide'));
				   }
                  ?>
                  </div>
                  
                 <div class="ulTableinner_record sn-no-other-record" style="width:175px;">&nbsp;  
                  <?php
                  $js_edit_function="OpenEditWhyUsForm('".base_url().admin."/about/edit-page','".$item['id']."')";
				  ?>
                   <a href="<?php echo base_url().admin."/about/edit-page/".$item['id'];?>" title="Edit"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/edit.png");?></span>&nbsp;Edit</a>
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
                	<div class="ulTableinner_record sn-no-other" style="width:289px;">&nbsp;</div>
                    <div class="ulTableinner_record sn-no-other" style="width:70px;"><span class="tools_icon">
                     <div id="remove_active" style="display:none;  width:70px;">
                     <?php
					  echo form_submit($deletion_attribute['delete_all']);
                     ?>
                     </div>
                     <div id="single_remove" style="display: none; width:70px;">
                     <?php
					  echo form_submit($deletion_attribute['delete']);
                     ?>
                     </div>                         
                     <div id="remove_inactive" style="display: block; width:70px;">
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
