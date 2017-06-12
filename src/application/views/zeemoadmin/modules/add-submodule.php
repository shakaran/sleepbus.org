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
  echo form_open_multipart(admin."/modules/validate-submodule", $attributes['form']);
  if(!empty($edit_id))
  {
   echo form_hidden('edit_id',$edit_id);
  }
   echo form_hidden('parent_id',$parent_id);
   echo form_hidden('parent_url',$parent_url);

 ?>

<div style=" padding: 6px 5px 8px 5px !important;">


  <span class="main_heading" style="padding-top:3px;padding-bottom:5px;"><?php echo $page_title;?> for <?php echo $parent_module_name;?></span>
  <?php
   if(isset($last_modified) and count($last_modified) > 0)
   {
	echo "<span class='last_modified_pop_up'>Last Modified by <span class='success'>".$last_modified['username']."</span> on <span class='success'>".$last_modified['time']."</span></span>";
   }
  ?>
 
</div>
             <table width="98%" border="0" cellpadding="0" cellspacing="0" style="color: #636466;font-family: Arial;font-size: 11px;font-weight: bold;text-align: left;padding-left:22px;">
     		    
				<tr><td style="padding-top:10px;padding-bottom:5px;" colspan="2">
                 *Submodule Name  <span class="error1" id="error1"><?php echo form_error('module_name'); ?></span>
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
                 <font color="red"><strong>*</strong></font><span style="padding:4px 0px 4px 4px;background-color:white;"><?php echo $parent_url;?><font size="+1">/</font></span><?php echo form_input($attributes['url']); ?><span class="error1" id="error2"><?php echo form_error('url'); ?></span>	<br /><font color="red"><strong>*</strong></font> <span class="remarks">Parent URL is given, add only submodule URL.</span>
                </td>
               </tr>
               <tr><td colspan="2">&nbsp;</td></tr>
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