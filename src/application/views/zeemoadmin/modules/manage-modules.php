          <div style="padding-right:590px;padding-top:20px;">
           <?php
            $js_function="OpenAddModule('".base_url().admin."/modules/add_module')";
		    echo form_submit('add_new_module','Add New Module','onclick="'.$js_function.'"');			              
           ?>
          
          </div> 
          <div style="padding:10px 45px 20px 0px;">
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
                	<div class="ulTableinner sn-no-other">Module Name</div>
                	<div class="ulTableinner sn-no-other" style="width:150px;">Status</div>
                	<div class="ulTableinner sn-no-other" style="width:164px;">Tools</div>
                    <div class="ulTableinner sn-no-other" style="width:96px;"><label> <span class="tools_icon"><?php echo form_checkbox($attribute['remove_all']);?>&nbsp;<?php echo img(base_url()."images/".admin."/icons/tools/check.png");?></span></label></div>
                </li>
                
            
            </ul>
            
             
           </div>
            <div class="clearfix"></div>
           
           
           <?php
            if(count($module_list) > 0)
			{
			 ?>
             <!--Data Needed for Positioning-->
              <input type="hidden" name="parent_id" value="0" id="parent_id" />
              <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".ADMIN_MODULES;?>" id="file_path" />
              <div class="ulTable_record" id="recordList">
              
              <ul>
			  <?php
			  $i=1;
			  $j=1;
			  foreach($module_list as $module)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $module['id'];?>">
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="background:#5685A6;color:#FFF"><img src="<?=base_url()?>images/<?php echo admin;?>/cms-settings/left/<?php echo $module['left_menu_icon'];?>" border="0" align="left" />&nbsp;<?php echo $module['module_name'];?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:150px;padding-left:10px;">
                  <?php
				  if($module['url'] != "modules")
				  {
				   if($module['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/modules/changestatus/'.$module['id'].'/1/manage', 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/modules/changestatus/'.$module['id'].'/0/manage', 'Hide',array('title'=>'Hide'));
				   }
				  }
				  else
				  {
				   echo "&nbsp;";
				  }
                  ?>
                  </div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:250px;">
                  
				   <?php echo anchor(base_url().admin.'/modules/managesubmodules/'.$module['id'], 'Manage Submodules',array('title'=>'Manage Submodules'));?>&nbsp; | 
                   <?php
                    $js_update_function="OpenAddModule('".base_url().admin."/modules/edit_module/".$module['id']."')";

				   ?>
                    <a href="javascript:void(0)" title="Edit" onclick="<?php echo $js_update_function;?>"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/edit.png");?></span>&nbsp;Edit</a>
                    
                    <?php
					if($module['url'] != "modules")
					{
					 echo "&nbsp; | &nbsp;".form_checkbox($attribute['data'.$i]);
					 $i++;
					}
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
		    ?>
           <div class="clearfix"></div>
          </div>
