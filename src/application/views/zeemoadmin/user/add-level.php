          <div style="padding:20px;">
           <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                    
           
           <?php
            echo form_open(base_url().admin.'/user/validatelevel',$attribute['form']);
			if(isset($level_id))
			{
			 ?>
              <input type="hidden" name="level_id" id="level_id" value="<?php echo $level_id;?>" />
			 <?php
			}
			?>
            <input type="hidden" name="total_checkbox" id="total_checkbox" value="<?php echo $attribute['total_checkbox']?>" />
            <input type="hidden" name="checked_box" id="checked_box" value="<?php echo $attribute['checked_box']?>" />

            <div class="main_heading">
            <?php
			echo $form_title." level";
			?>
            </div>
            <div class="free_items"> Level Name : 
             <?php
			  echo form_input($attribute['level_name']);
			  ?>
              &nbsp;&nbsp;
              <span id="name_error" class="error1"><?php echo form_error('level_name');?></span>
		    </div>
			<div class="sub_heading">
			<?php
			echo $form_title." privilege(s) to this level";
			?>
			</div>
            
            
            <?php
			 if(count($attribute['modules']) > 0)
			 {
			  ?>
              <div class="sub_heading" style="color:#F27900">
			   <?php
			   echo form_checkbox($attribute['check_all'])." Check / Uncheck all";
			   ?><span id="checked_box_error" class="error1"><?php echo form_error('checked_box');?></span>
			  </div>
              <div class="new_fields">
               
                <?php
				$i=0;
			    foreach($attribute['modules'] as $module)
			    {
				 $i++;
			     ?>
                 <div class="container-left">
				  <div class="image-section">
                   <img src="<?php echo base_url();?>images/<?=admin?>/cms-settings/home/<?php echo $module['home_page_icon'];?>" alt="" title="" />
                  </div>
				  <?php
			      if(count($module['submodules']) > 0)
			      {
				   ?>
                   <input type="hidden" name="<?php echo "total_submodule_".$module['id'];?>" id="<?php echo "total_submodule_".$module['id'];?>" value="<?php echo $attribute['total_submodule_'.$module['id']];?>" />
				   <div class="check-content">
                    <label class="chk_bold"><?php echo form_checkbox($attribute['module_checkbox_'.$module['id']]); echo $module['module_name']?></label>
                    <div class="pad_label">
               	    <?php	 
			        foreach($module['submodules'] as $submodule)
			        {
				     ?>
					 <label><?php echo form_checkbox($attribute['submodule_checkbox_'.$submodule['id']]);
					  echo $submodule['module_name'];?>
                     </label>
					 <?php
				    }
				    ?>
				    </div>
                   </div>
				   <?php
			      }
			      ?>
				  </div>
				  <?php
				  if($i % 2 == 0)
				  {
				   ?>
				   <div class="clearfix"></div>
				   <?php
				  }
				 }
			     ?>
                
               <div class="clearfix"></div>
              </div>     
			  <?php
			 }
            
			?>
            
       		     
            
            
            
            
            <div class="free_items"><br />
             <div class="clearfix"></div>
             <?php
			  echo form_submit($attribute['submit']);
			  ?>
		    </div>           
            
            
            
            
            
			<?php
		    echo form_close();
		   ?>
           
           
           
         
           
           
           
           
           
           <div class="clearfix"></div>
           
           
          </div>
