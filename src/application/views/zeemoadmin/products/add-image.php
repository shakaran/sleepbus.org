<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo PREFIX_TITLE.$title;?></title>
  <?=$this->admincss->IncludeCssFiles()?>
  <?=$this->adminjavascript->IncludeJsFiles()?>
</head>
<body>
 <?php
  echo form_open_multipart($file_path, $attributes['form']);
  if(!empty($attributes['edit_id']))
  {
   echo form_hidden('edit_id',$attributes['edit_id']);
  }
  echo form_hidden('cat_id',$cat_id);
  echo form_hidden('parent_id',$parent_id);  
 ?>

<div style=" padding: 6px 5px 8px 5px !important;">


  <span class="main_heading" style="padding-top:3px;padding-bottom:5px;"><?php echo $page_title;?></span>
  <?php
   if(isset($last_modified) and count($last_modified) > 0)
   {
	echo "<span class='last_modified_pop_up'>Last Modified by <span class='success'>".$last_modified['username']."</span> on <span class='success'>".$last_modified['time']."</span></span>";
   }
  ?>
 
</div>
             <table width="98%" border="0" cellpadding="0" cellspacing="0" style="color: #636466;font-family: Arial;font-size: 11px;font-weight: bold;text-align: left;padding-left:22px;">
     		   <tr>
                <td colspan="2">
                 <?php echo $parent_drop_down_title;?> :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_dropdown('parents',$attributes['parents'],$parent_id,"class='select_action' style='width:285px;' id='parents' disabled='disabled'")?>&nbsp;<span class="remarks"> *(Disabled)</span>&nbsp;<span id="error1" class="error2"><?php echo form_error('parents');?></span>
                </td>
               </tr> 
				<tr><td style="padding-top:10px;padding-bottom:5px;" colspan="2">
                 Image Title :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_input($attributes['image_title']); ?>&nbsp;<span><?php echo form_input($attributes['limit1']);
				  ?></span><span class="remarks"><?php if(isset($title_remarks)){ echo $title_remarks;}else{ ?>(Max. 20 chars)<?php } ?></span><span class="error1" id="error2"><?php echo form_error('image_title'); ?></span>
               </td></tr>
               <?php
               if(isset($attributes['description']))
			   {
			   ?>
				<tr>
                      <td align="left" valign="top" colspan="2">Description :</td>
                </tr>
                <tr>      
                      <td align="left" valign="middle" colspan="2"><?php echo form_textarea($attributes['description']); ?>&nbsp;<span><?php echo form_input($attributes['limit2']);
				  ?></span><span class="remarks"> (Max. 200 chars)</span><span class="error1" id="error4"><?php echo form_error('description'); ?></span></td>
               </tr>                
               <?php
			   }
			   ?>
    		   <tr>
                <td valign="top" align="left" width="55%" style="padding-top:10px;padding-bottom:10px;">
                 <table align="left" width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr height="10">
                   <td align="left" valign="top" colspan="2">
					<?php if(empty($attributes['edit_id'])) echo "*"; ?> Upload Image
                    &nbsp;&nbsp;
                    &nbsp;<div class="error1" id="error3"><?php echo form_error('image_file'); ?></div>
                             </td>
                            </tr>
                            <tr height="10">
                             <td align="left" valign="top" width="85%">
                              <?php echo form_upload($attributes['image_file']);?>
                              <br /><span class="remarks">*<?php if(isset($remarks)){ echo $remarks;}else{ ?>Image size should be less than equal to 210x240px (width x height) <?php } ?></span>
                              <div style="padding-top:10px;">
                               Alt/ Title text <span class="remarks">(For SEO)</span> :</div><div style="padding-top:6px;">  <?php echo form_input($attributes['image_alt_title_text']);?></div> 
                               
                               
                               <div style="padding-top:10px;">
                 
			    			   <?php
							     echo IMAGE_QUALITY_INSTRUCTION.":&nbsp;&nbsp;";
			     				 echo form_dropdown('image_quality',$image_quality_options,$image_quality,'class="select_action"');
			   					?>                 
				                <div class="remarks"><?php echo IMAGE_QUALITY_REMARKS;?></div> 
                               
               	               
                                                            
                              <br /><br />&nbsp;<?php echo form_submit($attributes['submit']);?>
                              
                               </div>
                              </td>
                             </tr>                            
                            </table>
                           </td>
                           <td align="center" valign="top" style="padding-top:5px;padding-bottom:10px;background-color:#F7F7F7;border:thin solid white;">
                            <table align="left"  width="100%" cellpadding="0" cellspacing="0" border="0">
                             <tr height="10">
                              <td align="left" valign="top"></td>
                             </tr>
                             <tr height="10">
                              <td align="center" valign="top">
                               <?php
							    if(!empty($attributes['current_image']))
								{
								 echo "<div style='padding-bottom:5px;'>Current Image</div>";
                                 ?>
								 <img src="<?php echo $uploading_path;?>/<?php echo $attributes['current_image'];?>" width="240" height="160" />
                                 <br />
                                 
                                 <?php
                         		 echo form_hidden('current_image',$attributes['current_image']);
								} 
								else
								{
								 ?>
								  <div class="remarks" style="text-align:center">Image Preview</div>
								 <?php
								}
								?>									
								
                              </td>
                             </tr>                            
                            </table>                          
                           </td>
                         </tr>                       
                        </table>

  <div style="padding-top:13px;padding-bottom:5px;padding-left:3px;">
 </div>



 </form>


</body>
</html>