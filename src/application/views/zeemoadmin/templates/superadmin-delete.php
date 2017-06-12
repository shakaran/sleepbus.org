<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo PREFIX_TITLE;?> Confirm Superadmin</title>
  <?=$this->admincss->IncludeCssFiles()?>
  <?=$this->adminjavascript->IncludeJsFiles()?>
 <style type="text/css">
  body{ padding:10px !important; margin:0px !important;height:30px; background:#F5F5F5;}
  	iframe{ border:1px solid #515151; height:500px;}
	*html{ padding:0px !important; margin:0px !important;}
  </style>
  </head>
<body style="padding:7px;  background-color: #F5F5F5;">
 <?php
  echo form_open('',$attributes['form'],$attributes['hidden']);
 ?>

<div>

  <span class="popup_title">Superadmin Password</span>
  <div class="super_admin_alert_msg">
  <?php
   if(!empty($message))
   {
    echo $message;
   }
  ?>&nbsp;
  </div>
  <div class="super_admin_fix_msg">Please enter superadmin password</div>
  <div class="error_popup" id="show_error">&nbsp;</div>

  <?php echo form_password($attributes['superadmin']);?>
  <div style="padding-top:10.4px;padding-left:3px;">
  <?php
   echo form_submit($attributes['option1']);
   echo "&nbsp";
   echo form_button($attributes['option2']);
   echo form_close();
  ?>
 </div>


</div>

</body>
</html>