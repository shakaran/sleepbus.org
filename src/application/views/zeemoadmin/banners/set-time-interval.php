<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo PREFIX_TITLE.$title;?> </title>
  <?=$this->admincss->IncludeCssFiles()?>
  <?=$this->adminjavascript->IncludeJsFiles()?>
</head>
<body style="padding:7px;background-color:white;background-color: #F5F5F5;">
 <?php
  echo form_open(base_url().admin."/banners/validateTimeInterval",$attributes['form']);
 ?>

<div>
   <div style="font-family:Arial; float:left;color:#5685a6;font-weight:bold;font-size:11px;padding-bottom:7px;">Last Modified by <span class="success"><?php  echo $last_modified['username']; ?> </span> on <span class="success"> <?php  echo $last_modified['time']; ?></span> </div>
 <div class="clearfix"></div>
  <div class="popup_title" style="float:left;">Set Banner Time Interval</div>
  <div class="clearfix"></div>
  <span class="error1" id="show_error"><?php if(isset($success_message)){ ?> <span class="success"> <?php echo $success_message;?></span> <?php }else{ echo form_error('time_interval');}?></span>
  <div class="super_admin_fix_msg">Time Interval &nbsp;&nbsp;<?php echo form_input($attributes['time_interval']);?> </div>
 

  
  <div style="padding-top:10.4px;padding-left:3px;">
  <?php
   echo form_submit($attributes['time_option1']);
   echo "&nbsp";
   echo form_button($attributes['option2']);
   echo form_close();
  ?>
 </div>

</div>
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