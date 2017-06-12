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
  if(isset($cat_id)) echo form_hidden('cat_id',$cat_id);

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
                 <?php echo $parent_drop_down_title;?> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_dropdown('parents',$attributes['parents'],$parent_id,"class='select_action' style='width:285px;' id='parents' disabled='disabled'")?>&nbsp;<span class="remarks"> *(Disabled)</span><span id="error1" class="error2"><?php echo form_error('parents');?></span>
                </td>
               </tr> 
				<tr><td style="padding-top:10px;padding-bottom:5px;" colspan="2">
                 *Brochure Title :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_input($attributes['brochure_title']); ?>&nbsp;<span><?php echo form_input($attributes['limit1']);
				  ?></span><span class="remarks"> <?php if(isset($title_remarks)){ echo $title_remarks;}else{ ?>(Max. 45 chars)<?php } ?></span><span class="error1" id="error2"><?php echo form_error('brochure_title'); ?></span>
               </td></tr>
                
               
    		   <tr>
                <td valign="top" align="left" width="55%" style="padding-top:10px;padding-bottom:10px;">
                 <table align="left" width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr height="10">
                   <td align="left" valign="top" colspan="2">
					<?php if(empty($attributes['edit_id'])) echo "*"; ?> Upload Brochure
                    &nbsp;&nbsp;
                    &nbsp;<div class="error1" id="error3"><?php echo form_error('brochure_file'); ?></div>
                             </td>
                            </tr>
                            <tr height="10">
                             <td align="left" valign="top" width="85%">
                              <?php echo form_upload($attributes['brochure_file']);?>
                              <br /><span class="remarks"><?php if(isset($remarks)){ echo "*".$remarks;}?></span>
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
                              <td align="center" valign="top">
                               <?php
							    if(!empty($attributes['current_brochure']))
								{
								 echo "Current brochure<br />";
                                 ?>
								 <a href="<?php echo $uploading_path;?>/<?php echo $attributes['current_brochure'];?>" target="_blank"><img src="<?php echo base_url();?>images/<?=admin?>/download_icon.png" width="150" height="150" /></a>
                                 <br />
                                 Click to view
                                 <?php
                         		 echo form_hidden('current_brochure',$attributes['current_brochure']);
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
 <?php
  if(isset($redirect_url) and !empty($redirect_url))
  {
   ?>
    <script language="javascript">
	 parent.location="<?php echo base_url().$redirect_url;?>";
	 parent.$.prettyPhoto.close();
    </script>
   <?php
  }
 ?>

</body>
</html>