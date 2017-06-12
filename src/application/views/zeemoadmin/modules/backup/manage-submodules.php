          <div class="record_list">
           <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
            <?php
   			 echo form_open(base_url().'admin/modules/managesubmodules','id=submodule_dropdown_form');
			 
            ?>
            <div class="ulTableinner_record sn-no" style="width:400px;padding-left:40px;font-weight:bold;" >Select Module <?php echo form_dropdown('module_id',$attribute['module_id'],$module_id,"class='select_action' style='width:185px;' onchange=SubmitModuleForm()");?></div>
            <?php
			echo form_close();
            if(count($submodule_list) > 0)
		    {
		     ?>  
             <div class="clearfix">&nbsp;</div>   
             <div class="clearfix"></div>   
             <div class="ulTable">
            
             <ul>
            	<li>
                	<div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div class="ulTableinner sn-no-other">Sub Module Name</div>
                	<div class="ulTableinner sn-no-other" style="width:150px;">Status</div>
                	<div class="ulTableinner sn-no-other" style="width:39px;">Tools</div>
                    <div class="ulTableinner sn-no-other" style="width:221px;"><label>&nbsp;<?php if($module_url != "modules"){ ?> <span class="tools_icon"><?php echo form_checkbox($deletion_attributes['remove_all']);  ?>&nbsp;<?php echo img(base_url()."images/admin/icons/tools/drop.png");?></span><?php }else{ echo "&nbsp";} ?></label></div>
                </li>
                
                
            
            </ul>
            
             
           </div>
            <div class="clearfix"></div>
           
           
           <?php
             echo form_open(base_url().'admin/modules/managesubmodules',$deletion_attributes['form']);
		     ?>
			  <input type="hidden" name="total_data" id="total_data" value="<?php echo $deletion_attributes['total_data']?>" />    
			  <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $deletion_attributes['deletion_path']?>" />              
			
             <!-- Mandatory attributes for  positioning as well as change status -->
              <input type="hidden" name="parent_id" value="<?php echo $module_id;?>" id="parent_id" />
              <input type="hidden" name="file_path" value="<?php echo base_url()."admin/home/UpdatePosition/".ADMIN_MODULES;?>/parent_id" id="file_path" />
              <!-- ------ end ------------>
              <div class="ulTable_record" id="recordList">
              
              <ul>
			  <?php
			  $i=1;
			  foreach($submodule_list as $module)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $module['id'];?>">
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $i;?></div>
                 <div class="ulTableinner_record sn-no-other-record"><?php echo $module['module_name'];?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:150px;">
                  <?php
				  if($module_url != "modules")
				  {
				   if($module['status'] == 0)
				   {
				    echo anchor(base_url().'admin/modules/changestatus/'.$module['id'].'/1/managesubmodules/'.$module_id, 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().'admin/modules/changestatus/'.$module['id'].'/0/managesubmodules/'.$module_id, 'Hide',array('title'=>'Hide'));
				   }
				  }
				  else
				  {
				   echo "&nbsp;";
				  }
                  ?>
                  </div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:250px;">
                  <span class="gallery">
                    <a href="<?php echo base_url()?>admin/modules/UpdatePopUp/<?php echo $module['id'];?>?iframe=true&width=320&height=120" rel="prettyPhoto"><span class="tools_icon"><?php echo img(base_url()."images/admin/icons/tools/edit.png");?></span>&nbsp;Edit</a>&nbsp; <!--|&nbsp;<a href="<?php echo base_url()?>admin/modules/helptext/<?php // echo $module['id'];?>/<?php // echo $module_id;?>?iframe=true&width=900&height=520" rel="prettyPhoto"><span class="tools_icon"><?php // echo img(base_url()."images/admin/icons/left/service.png");?></span>Help Text</a>-->
                    
                    <?php
					if($module_url != "modules")
					{
					 echo "&nbsp; |&nbsp; ".form_checkbox($deletion_attributes['data'.$i]);
					}
					?>
                    
                    
                    </span>
                 </div>
                 <div class="clearfix"></div>
                </li>
			   <?php
			   $i++;
			  }
			  ?>
               </ul>
			  </div>
              
              <?php
			  if($module_url != "modules")
			  {
			  ?>
			   <div class="ulTable" style="padding-top:5px;">
               <ul>
            	<li>
                	<div class="ulTableinner_record sn-no">&nbsp;</div>
                	<div class="ulTableinner_record sn-no-other">&nbsp;</div>
                	<div class="ulTableinner_record sn-no-other" style="width:150px;">&nbsp;</div>
                	<div class="ulTableinner_record sn-no-other" style="width:89px;">&nbsp;</div>
                    <div class="ulTableinner_record sn-no-other" style="width:171px;"><span class="tools_icon">
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
			  }
			  echo form_close();
			
		   }
		   elseif($module_id != 0)
		   {
		    ?><div class="clearfix"></div>
			 <div class="error1"> No Submodule(s) Found</div>
			<?php
		   }
		   else
		   {
		    ?><div class="clearfix"></div>
			 <div class="error1"> Please select module form dropdown </div>
			<?php
		   }
		   ?>
            
           
           
           
           
           
           
           
           <div class="clearfix"></div>
           
           
          </div>
