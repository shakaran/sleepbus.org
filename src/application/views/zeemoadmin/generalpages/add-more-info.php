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
     		    
				<tr><td style="padding-top:10px;padding-bottom:5px;" colspan="2">
                 *Title :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_input($attributes['info_title']); ?>&nbsp;<span><?php echo form_input($attributes['limit1']);
				  ?></span><span class="remarks"><?php if(isset($title_remarks)){ echo $title_remarks;}else{ ?>(Max. 50 chars)<?php } ?></span><span class="error1" id="error1"><?php echo form_error('info_title'); ?></span>
               </td></tr>
					<tr>
                      <td align="left" valign="top" colspan="2">Description:<span class="error1" id="error2"><?php echo form_error('description'); ?></span>
                    </td>
                </tr>
                <tr>      
                      <td align="left" valign="middle" colspan="2" style="padding-top:8px;"> <?php echo form_textarea($attributes['description']);
   				       		$this->ckeditor->config['width'] = '700px';
					   		$this->ckeditor->config['height'] = '100px';            
					   		echo $this->ckeditor->replace("description");
		     	 		  ?>  </td>
               </tr>
						 <tr height="25" valign="bottom">
                          <td>URL&nbsp;&nbsp;<span class="error1" id="error4"><?php echo form_error('url');?></span></td>
                         </tr>
						 <tr>
                           <td align="left">
                           <?php
                            echo form_input($attributes['url']);
						   ?>
                           &nbsp;&nbsp;<div class="remarks"><?php echo URL_INSTRUCTION;?></div>
                           </td>                         
                         </tr>
                           <tr>
                            <td valign="top" align="left" width="55%" style="padding-top:10px;padding-bottom:10px;">
                             <table align="left" width="100%" cellpadding="0" cellspacing="0" border="0">
                              <tr height="10">
                               <td align="left" valign="top" colspan="2">
                                <?php if(empty($attributes['edit_id'])) echo ""; ?> Upload Image
                                &nbsp;&nbsp; <span class="error1" id="error3"><?php echo form_error('image_file'); ?></span>
                                &nbsp;
                             </td>
                            </tr>
                            <tr height="10">
                             <td align="left" valign="top" width="85%">
                              <?php echo form_upload($attributes['image_file']);?>
                              <br /><span class="remarks"><?php if(isset($remarks)){ echo $remarks;}?></span>
                               <div style="padding-top:10px;">
                               Alt/ Title text <span class="remarks">(For SEO)</span> :</div><div style="padding-top:6px;">  <?php echo form_input($attributes['image_alt_title_text']);?></div> 
                               <div style="padding-top:10px;">
			    			   <?php
							     echo IMAGE_QUALITY_INSTRUCTION.":&nbsp;&nbsp;";
			     				 echo form_dropdown('image_quality',$image_quality_options,$image_quality,'class="select_action"');
			   					?>                 
				                <div class="remarks"><?php echo IMAGE_QUALITY_REMARKS;?></div> 
                               </div>      
                              <br /><br />&nbsp;<?php echo form_submit($attributes['submit']);?>
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
								 <img src="<?php echo $uploading_path;?>/<?php echo $attributes['current_image'];?>" />
                                 <br /> <span class="gallery">
								  <a href="<?php echo base_url().admin;?>/generalpages/ConfirmDelete/<?php echo $image_id;?>/more_info_image?iframe=true&width=320&height=110" rel="prettyPhoto" class="link1"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/delete.png");?></span> &nbsp;Delete Image</a></span>
                                 <?php echo form_hidden('current_image',$attributes['current_image']);
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