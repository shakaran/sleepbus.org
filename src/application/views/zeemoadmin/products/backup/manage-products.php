            <div class="record_list">
             <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
             <!-- Data needed for multiple deletion-->   
             
             
             <div style="color: #636466;font-family: Arial;font-size: 11px;font-weight: bold;text-align: left;padding-left:42px;padding-bottom:20px;">
             *Select a category :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_dropdown('cat_id',$category_list, $selected_cat_id, "class='select_action' style='width:200px;' id='project_id' onchange=\"window.location='".base_url()."admin/products/manage-products/'+this.value\"");?>&nbsp;<span id="error1" class="error2"><?php echo form_error('product_id');?></span>
             </div>
             
             <?php
			 if(count($product_list) > 0)
		     {
              echo form_open(base_url().'admin/products/manage-products',$attribute['form']);
		      ?>
              <input type="hidden" name="total_data" id="total_data" value="<?php echo $attribute['total_data']?>" />  
              <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $attribute['deletion_path']?>" />   
              <div class="ulTable">
               <ul>
                <li>
                 <div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                 <div class="ulTableinner sn-no-other" style="width:170px;">Product Name</div>
                 <div class="ulTableinner sn-no-other" style="width:140px; text-align:center">Status</div>
                 <div class="ulTableinner sn-no-other" style="width:270px; text-align:center">Tools</div>
                 <div class="ulTableinner sn-no-other" style="width:50px;"><label> <span class="tools_icon"><?php echo form_checkbox($attribute['remove_all']);?>&nbsp;<?php echo img(base_url()."images/admin/icons/tools/drop.png");?></span></label></div>
                </li>
               </ul>
              </div>
             <div class="clearfix"></div>
             <?php
             if(count($product_list) > 0)
			 {
			 ?>
              <!--Data Needed for Positioning-->
              <input type="hidden" name="parent_id" value="<?php echo $selected_cat_id;?>" id="parent_id" />
              <input type="hidden" name="file_path" value="<?php echo base_url()."admin/home/UpdatePosition/category_to_products"?>/cat_id" id="file_path" />
              <div class="ulTable_record" id="recordList">
              <ul>
			  <?php
			  $i=1;
			  $j=1;
			  foreach($product_list as $product)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $product['cpid'];?>" style="padding:2px;">
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:170px;"><?php echo $product['product_name'];?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:140px; text-align:center">
                  <?php
				   if($product['status']==0)
				   {
				    echo anchor(base_url().'admin/products/changestatus/'.$product['cpid'].'/1/manage-products/'.$product['cat_id'], 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().'admin/products/changestatus/'.$product['cpid'].'/0/manage-products/'.$product['cat_id'], 'Hide',array('title'=>'Hide'));
				   }
                  ?>
                  </div>
                  
                 <div class="ulTableinner_record sn-no-other-record" style="width:270px; text-align:center; vertical-align:baseline;">

                 <a href="<?php echo base_url()?>admin/products/edit-product/<?php echo $product['id'];?>/<?php echo $product['cat_id'];?>" title="Edit">Edit</a>&nbsp;|&nbsp;
                 <a href="<?php echo base_url()?>admin/products/manage-images/<?php echo $product['id'];?>/<?php echo $product['cat_id'];?>" title="Manage Images">Images</a>&nbsp;|&nbsp;
                 <a href="<?php echo base_url()?>admin/products/manage-brochures/<?php echo $product['id'];?>/<?php echo $product['cat_id'];?>" title="Manage Downloads">Downloads</a>&nbsp;|&nbsp;
                <a href="<?php echo base_url()?>admin/products/related-projects/<?php echo $product['cat_id'];?>/<?php echo $product['id'];?>" title="Related Projects">Related Projects</a>
                 

                   
                  </div>
                    <div class="ulTableinner_record sn-no-other-record" style="width:40px;">
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
                	<div class="ulTableinner_record sn-no-other" style="width:100px;">&nbsp;</div>
                    <div class="ulTableinner_record sn-no-other" style="width:150px; text-align:right;"><span class="tools_icon">
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
			   <div class="success"> No product found.</div>
			  <?php
			 }
		    ?>
           <div class="clearfix"></div>
          </div>
