            <div class="record_list">
             <?php
              echo form_open(base_url().admin.'/products/manage-brochures',$drop_down_attributes['form']);
			 ?>
             <div style="color: #636466;font-family: Arial;font-size: 11px;font-weight: bold;text-align: left;padding-left:42px;padding-bottom:20px;">
             *Select a product:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_dropdown('product_id',$drop_down_attributes['product_id'],$product_id,"class='select_action' style='width:285px;' id='product_id' onchange=SubmitManageImageForm('".base_url().admin."/products/manage-brochures/'+this.value+'/$cat_id')");?>&nbsp;<span id="error1" class="error2"><?php echo form_error('product_id');?></span>
             </div>
             <?php
              if(!empty($product_id))
			  {
			   ?>
			   <div align="left" style="padding-left:42px;">
			   <?php
			   $js_function = "OpenAddBrochureForm('".base_url().admin."/products/add-brochure','".$product_id."/".$cat_id."')";
			   echo form_submit('add_brochure','Add Brochure','onclick="'.$js_function.'"');
			   ?>
               
               &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="<?php echo base_url().admin;?>/products/manage-products/<?php echo $cat_id;?>/<?php echo $cat_details['depth'];?>"><?php echo form_button('go_back','Go Back');?></a>
               
               </div>
			   <?php
			  }
			 ?>
             <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
             <!--Data Needed for Positioning-->
              <input type="hidden" name="parent_id" value="<?php echo $product_id;?>" id="parent_id" />
              <input type="hidden" name="cat_id" value="<?php echo $cat_id;?>" id="cat_id" />
              <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".PRODUCT_BROCHURES;?>/product_id" id="file_path" />
             <?php
			 echo form_close();
			 if(count($brochure_list) > 0)
		     {
              echo form_open(base_url().admin.'/products/manage-brochures',$deletion_attribute['form']);
		     ?>
             <!-- Data needed for multiple deletion-->
              <input type="hidden" name="total_data" id="total_data" value="<?php echo $deletion_attribute['total_data']?>" />  
              <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $deletion_attribute['deletion_path']?>" /> 
             <br />
             <div class="ulTable">
            
            <ul>
            	<li>
                	<div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div class="ulTableinner sn-no-other" style="width:275px;">Title</div>
                    <div class="ulTableinner sn-no-other" style="width:90px;  text-align:center;">Status</div>
                	<div class="ulTableinner sn-no-other" style="width:225px;  text-align:center;">Tools</div>
                    <div class="ulTableinner sn-no-other" style="width:50px;"><label> <span class="tools_icon"><?php echo form_checkbox($deletion_attribute['remove_all']);?>&nbsp;<?php echo img(base_url()."images/".admin."/icons/tools/check.png");?></span></label></div>
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

                 <div class="ulTableinner_record sn-no-other-record" style="width:275px;"><a href="<?php echo base_url()."pdfs/product/".$brochure['brochure_file'];?>" target="_blank"><?php echo ucwords($brochure['brochure_title']);?></a>&nbsp;</div>
                
                 <div class="ulTableinner_record sn-no-other-record" style="width:90px; text-align:center;">
                  <?php
				    if($brochure['status']==0)
				    {
				     echo anchor(base_url().admin.'/products/changestatus/'.$brochure['id'].'/1/manage-brochures/'.$product_id.'/'.$cat_id, 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				    }
				    elseif($brochure['status']==1)
				    {
				     echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin."/products/changestatus/".$brochure['id'].'/0/manage-brochures/'.$product_id.'/'.$cat_id, 'Hide',array('title'=>'Hide'));
				    }
                  ?>
                  </div>
                  
                 <div class="ulTableinner_record sn-no-other-record" style="width:225px;  text-align:center;">&nbsp;  
                  <?php
                  $js_edit_function = "OpenProductEditBrochureForm('".base_url().admin."/products/edit-brochure','".$brochure['id']."','".$product_id."','".$cat_id."')";
				  ?>
                   <a href="javascript:void(0)" onclick="<?php echo $js_edit_function;?>" title="Edit"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/edit.png");?></span>&nbsp;Edit</a>
                    </div>
                    <div class="ulTableinner_record sn-no-other-record" style="width:40px;">
                     <?php
					  echo form_checkbox($deletion_attribute['data'.$i]);
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
                    <div class="ulTableinner_record sn-no-other" style="width:175px; text-align:right;"><span class="tools_icon">
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
			 elseif(empty($product_id))
			 {
			  ?>
			   <div class="success"> Please select project</div>
			  <?php
			 }
			 else
			 {
			  ?>
			   <div class="success"> No download available.</div>
			  <?php
			 }
		    ?>
           <div class="clearfix"></div>
          </div>
