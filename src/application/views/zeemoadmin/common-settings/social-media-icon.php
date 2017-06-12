          <div style="padding:25px;">
            <div id="input_text">
             <?php
			// if(count($icon_list) < 12 or isset($icon_id) && $icon_id!="")
			 //{
              echo form_open_multipart(base_url().admin.'/commonsettings/validateicons',$attributes['form']);
			  if(!empty($icon_id))
			  {
			   echo form_hidden('icon_id',$icon_id);
			  }
			  
			 ?>
              <table width="98%" border="0" cellpadding="0" cellspacing="0">
               <tr>
               <td style="padding-bottom:9px;">
                <span class="main_heading"><?php echo $page_title;?></span>
               </td>
                <td colspan="3">
                       
                      </td>
               </tr>
				<tr><td style="padding-top:0px;padding-bottom:5px;">
                 *Title &nbsp;<span class="error1" id="error1"><?php echo form_error('icon_title'); ?></span>
               </td></tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_input($attributes['icon_title']); ?>&nbsp;<span><?php echo form_input($attributes['limit1']);
				  ?></span><span class="remarks">(Max. 20 chars)</span>
                </td>
               </tr>    
    		   <tr>
                <td valign="top" align="left" width="55%" style="padding-top:10px;padding-bottom:10px;">
                 <table align="left" width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr height="10">
                   <td align="left" valign="top" colspan="2">
					*Upload Image <span class="remarks">(To be displayed on small window scrolling on right side)</span>
                    &nbsp;&nbsp;
                    &nbsp;<div class="error1" id="error3"><?php echo form_error('image_file'); ?></div>
                             </td>
                            </tr>
                            <tr height="10">
                             <td align="left" valign="top" width="85%">
                              <?php echo form_upload($attributes['image_file']);
							  ?>
                              <br />
<span class="remarks">*Image size must be 26x26px (width x height)px</span>

								<div style="padding-top:8px;">
                                 Alt Title Text
                                 <br />
                                <?php echo form_input($attributes['image_alt_title_text']);  ?>
                                </div>
                              </td>
                              <td valign="top">
                              </td>
                             </tr> 
                            </table>
                           </td>
                           <td align="left" valign="top">
                            <table align="left"  width="100%" cellpadding="0" cellspacing="0" border="0">
                             <tr height="10">
                              <td align="left" valign="top"></td>
                             </tr>
                             <tr height="10">
                              <td align="left" valign="top">
                               <?php
							    if(!empty($attributes['current_image']))
								{
								 echo "Current Image<br />";
                                 ?>
								 <img src="<?php echo base_url();?>images/common-settings/<?php echo $attributes['current_image'];?>" />
                                
                                 <?php
                         		 echo form_hidden('current_image',$attributes['current_image']);
								} 
								?>
                              </td>
                             </tr>                            
                            </table>                          
                           </td>
                         </tr>    
<tr>
                <td valign="top" align="left" width="55%" style="padding-top:10px;padding-bottom:10px;">
                 <table align="left" width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr height="10">
                   <td align="left" valign="top" colspan="2">
					*Upload Footer Image <span class="remarks">(To be displayed on footer)</span>
                    &nbsp;&nbsp;
                    &nbsp;<div class="error1" id="error4"><?php echo form_error('hover_image'); ?></div>
                             </td>
                            </tr>
                            <tr height="10">
                             <td align="left" valign="top" width="85%">
                              <?php echo form_upload($attributes['hover_image']);  ?>
                              <br />
							   <span class="remarks">*Image size must be 50x50px (width x height)px</span>
								<div style="padding-top:8px;">
                                 Alt Title Text
                                 <br />
                                <?php echo form_input($attributes['hover_image_alt_title_text']);  ?>
                                </div>
                               
                              </td>
                              <td valign="top">
                              </td>
                             </tr> 
							                                                         
                            </table>
                           </td>
                           <td align="left" valign="top">
                            <table align="left"  width="100%" cellpadding="0" cellspacing="0" border="0">
                             <tr height="10">
                              <td align="left" valign="top"></td>
                             </tr>
                             <tr height="10">
                              <td align="left" valign="top">
                               <?php
							    if(!empty($attributes['current_hover_image']))
								{
								 echo "Current Image<br />";
                                 ?>
								 <img src="<?php echo base_url();?>images/common-settings/<?php echo $attributes['current_hover_image'];?>" />
                                
                                 <?php
                         		 echo form_hidden('current_hover_image',$attributes['current_hover_image']);
								} 
								?>
                              </td>
                             </tr>  
							                                                         
							                                                         
                                                       
                            </table>                          
                           </td>
                         </tr>                                            
                          <tr>
                <td style="padding-top:10px;padding-bottom:5px;">
                 *Url&nbsp;<span class="remarks"><?php echo URL_INSTRUCTION;?></span><span class="error1" id="error2"><?php echo form_error('url'); ?></span>
               	</td>
               </tr>
               <tr>
                <td colspan="4" align="left">
                 <?php echo form_input($attributes['url']); ?>&nbsp;   		</td>
               </tr>
                        <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
                         <?php
						  echo form_submit($attributes['submit']);
                         ?>
                       </td></tr>
                       <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
                       </td></tr>
                      </table> 
                     <?php
			    
					  echo form_close();
			         
					 ?>  

 </div>
</div>
<div class="record_list">
             <div class="error1" id="error" align="right"><?php if(isset($error_msg)) echo $error_msg; ?></div>
             <!-- Data needed for multiple deletion-->   
             <?php
			 if(count($icon_list) > 0)
		     {

              echo form_open(base_url().admin.'/commonsettings/social_media_icon',$attribute['form']);
		     ?>
             <input type="hidden" name="total_data" id="total_data" value="<?php echo $attribute['total_data']?>" />  
             <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $attribute['deletion_path']?>" />   
             <div class="ulTable">
            
            <ul>
            	<li>
                	<div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div class="ulTableinner sn-no-other">Title</div>
                    <div class="ulTableinner sn-no-other" style="width:130px;">Image</div>                							                    <div class="ulTableinner sn-no-other" style="width:90px;">Status</div>
                	<div class="ulTableinner sn-no-other" style="width:84px;">Tools</div>
                    <div class="ulTableinner sn-no-other" style="width:106px;"><label>&nbsp;<span class="tools_icon"><?php echo form_checkbox($attribute['remove_all']);?>&nbsp;<?php echo img(base_url()."images/".admin."/icons/tools/check.png");?></span></label></div>
                </li>
                
            
            </ul>
            
             
           </div>
            <div class="clearfix"></div>
           
           
           <?php
		   
            if(count($icon_list) > 0)
			{
			 ?>
             <!--Data Needed for Positioning-->
              <input type="hidden" name="parent_id" value="0" id="parent_id" />
              <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".SOCIAL_MEDIA_ICONS;?>" id="file_path" />
              <div class="ulTable_record" id="recordList">
              <ul>
			  <?php
			  $i=1;
			  $j=1;
			  foreach($icon_list as $icon)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $icon['id'];?>" style="padding:2px;">
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
                 <div class="ulTableinner_record sn-no-other-record"><?php echo $icon['icon_title'];?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:130px;">
                 <?php
				  if(!empty($icon['image_file']))
				  {
				   ?>
				    <img src="<?php echo base_url();?>images/common-settings/<?php echo $icon['image_file'];?>"  />
				   <?php
				  }
				  else
				  {
				   echo "&nbsp;";
				  }
                 ?>
                   
                  </div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:90px;">
                  <?php
				   if($icon['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/commonsettings/changestatus/'.$icon['id'].'/1/social-media-icon', 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/commonsettings/changestatus/'.$icon['id'].'/0/social-media-icon', 'Hide',array('title'=>'Hide'));
				   }
                  ?>
                  </div>
                  
                 <div class="ulTableinner_record sn-no-other-record" style="width:84px;">&nbsp; &nbsp;&nbsp; 
                  
                   <a href="<?php echo base_url().admin;?>/commonsettings/editicon/<?php echo $icon['id'];?>" title="Edit"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/edit.png");?></span>&nbsp;Edit</a>
                    
                    </div>
                    <div class="ulTableinner_record sn-no-other-record" style="width:106px;">
                     <?php
					
					 echo "&nbsp; &nbsp;&nbsp; &nbsp;".form_checkbox($attribute['data'.$i]);
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
			   <!--<div class="success"> No icon found. Please <a href="<?php echo base_url();?>admin/commonsettings/social_media_icon" class="link1">click here</a> to add an icon.</div>-->
			  <?php
			 }
		    ?>
           <div class="clearfix"></div>
          </div>