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
  echo form_open_multipart(admin."/modules/validate-module", $attributes['form']);
  if(!empty($edit_id))
  {
   echo form_hidden('edit_id',$edit_id);
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
                 *Module Name  <span class="error1" id="error1"><?php echo form_error('module_name'); ?></span>
               </td></tr>
               <tr>
                <td colspan="2">
                 <?php echo form_input($attributes['module_name']); ?>	
                </td>
               </tr>
				<tr><td style="padding-top:10px;padding-bottom:5px;" colspan="2">
                 *URL <span class="remarks">(Special characters not allowed, please use underscore(_) or hypen(-) to separate words</span>
               </td></tr>
               <tr>
                <td colspan="2">
                 <?php echo form_input($attributes['url']); ?>	<span class="error1" id="error2"><?php echo form_error('url'); ?></span>
                </td>
               </tr>
    		   <tr>
                <td valign="top" align="left" width="55%" style="padding-top:10px;padding-bottom:10px;">
                 <table align="left" width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr height="10">
                   <td align="left" valign="top" colspan="2">
					<?php if(empty($attributes['edit_id'])) echo "*"; ?> Upload Home Page Icon
                    &nbsp;&nbsp;
                    &nbsp;<span class="error1" id="error3"><?php echo form_error('home_page_icon'); ?></span>
                             </td>
                            </tr>
                            <tr height="10">
                             <td align="left" valign="top" width="85%">
                              <?php echo form_upload($attributes['home_page_icon']);?>
                              <br /><span class="remarks">*<?php if(isset($home_page_icon_remarks)){ echo $home_page_icon_remarks;}?></span>
                              </td>
                             </tr>                            
                            </table>
                           </td>
                           <td align="center" valign="top" style="padding-top:5px;padding-bottom:10px;background-color:#F8FAFB;border:thin solid white;">
                            <table align="left"  width="100%" cellpadding="0" cellspacing="0" border="0">
                             <tr height="10">
                              <td align="left" valign="top"></td>
                             </tr>
                             <tr height="10">
                              <td align="center" valign="top">
                               <?php
							    if(!empty($attributes['current_home_page_icon']))
								{
								 echo "<div style='padding-bottom:5px;'>Current Icon</div>";
                                 ?>
								 <img src="<?php echo base_url();?>/images/<?php echo admin;?>/cms-settings/home/<?php echo $attributes['current_home_page_icon'];?>" width="75" height="75" />
                                 <br />
                                 
                                 <?php
                         		 echo form_hidden('current_home_page_icon',$attributes['current_home_page_icon']);
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

<tr>
                <td valign="top" align="left" width="55%" style="padding-top:10px;padding-bottom:10px;">
                 <table align="left" width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr height="10">
                   <td align="left" valign="top" colspan="2">
					<?php if(empty($attributes['edit_id'])) echo "*"; ?> Upload Header Icon
                    &nbsp;&nbsp;
                    &nbsp;<span class="error1" id="error4"><?php echo form_error('header_icon'); ?></span>
                             </td>
                            </tr>
                            <tr height="10">
                             <td align="left" valign="top" width="85%">
                              <?php echo form_upload($attributes['header_icon']);?>
                              <br /><span class="remarks">*<?php if(isset($header_icon_remarks)){ echo $header_icon_remarks;}?></span>
                              </td>
                             </tr>                            
                            </table>
                           </td>
                           <td align="center" valign="top" style="padding-top:5px;padding-bottom:10px;background-color:#F8FAFB;border:thin solid white;">
                            <table align="left"  width="100%" cellpadding="0" cellspacing="0" border="0">
                             <tr height="10">
                              <td align="left" valign="top"></td>
                             </tr>
                             <tr height="10">
                              <td align="center" valign="top">
                               <?php
							    if(!empty($attributes['current_header_icon']))
								{
								 echo "<div style='padding-bottom:5px;'>Current Icon</div>";
                                 ?>
								 <img src="<?php echo base_url();?>/images/<?php echo admin;?>/cms-settings/top/<?php echo $attributes['current_header_icon'];?>" width="45" height="45" />
                                 <br />
                                 
                                 <?php
                         		 echo form_hidden('current_header_icon',$attributes['current_header_icon']);
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
<tr>
                <td valign="top" align="left" width="55%" style="padding-top:10px;padding-bottom:10px;">
                 <table align="left" width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr height="10">
                   <td align="left" valign="top" colspan="2">
					<?php if(empty($attributes['edit_id'])) echo "*"; ?> Upload Left Menu Icon
                    &nbsp;&nbsp;
                    &nbsp;<span class="error1" id="error5"><?php echo form_error('left_menu_icon'); ?></span>
                             </td>
                            </tr>
                            <tr height="10">
                             <td align="left" valign="top" width="85%">
                              <?php echo form_upload($attributes['left_menu_icon']);?>
                              <br /><span class="remarks">*<?php if(isset($left_menu_icon_remarks)){ echo $left_menu_icon_remarks;}?></span>
                              </td>
                             </tr>                            
                            </table>
                           </td>
                           <td align="center" valign="top" style="padding-top:5px;padding-bottom:10px;background-color:#5685A6;border:thin solid white;">
                            <table align="left"  width="100%" cellpadding="0" cellspacing="0" border="0">
                             <tr height="10">
                              <td align="left" valign="top"></td>
                             </tr>
                             <tr height="10">
                              <td align="center" valign="top">
                               <?php
							    if(!empty($attributes['current_left_menu_icon']))
								{
								 echo "<div style='padding-bottom:5px;color:white'>Current Icon</div>";
                                 ?>
								 <img src="<?php echo base_url();?>/images/<?php echo admin;?>/cms-settings/left/<?php echo $attributes['current_left_menu_icon'];?>" width="25" height="25" />
                                 <br />
                                 
                                 <?php
                         		 echo form_hidden('current_left_menu_icon',$attributes['current_left_menu_icon']);
								} 
								else
								{
								 ?>
								  <div class="remarks" style="text-align:center;color:white">Image Preview</div>
								 <?php
								}
								?>									
								
                              </td>
                             </tr>                            
                            </table>                          
                           </td>
                         </tr>
                         
                         <tr>
                          <td>
                           <?php echo form_submit($attributes['submit']);?>
                          </td>
                         </tr>                    
                        </table>
                        <?php
 echo form_close();
?>







</body>
</html>