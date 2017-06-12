<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo PREFIX_TITLE;?> Confirm Delete</title>
  
  <?=$this->admincss->IncludeCssFiles()?>
  <?=$this->adminjavascript->IncludeJsFiles()?>
  
  <style type="text/css">
  body{ padding:0px !important; margin:0px !important;height:30px; background:#f5f5f5;}
  	iframe{ border:1px solid #515151; height:300px;}
	*html{ padding:0px !important; margin:0px !important;}
  </style>
</head>
<body>
 <?php
  echo form_open('',$attributes['form'], $attributes['hidden']);
 ?>

<div style=" padding: 6px 5px 0px 5px !important; background-color: #F5F5F5;">

  <span class="popup_title">Confirm Delete</span>
  <div class="popup_alert_msg"><br /><center>
  <?php
   if(!empty($message))
   {
    echo $message;
   }
  ?>&nbsp;</center>
  </div>
  
  <div style="padding-top:10.1px;padding-left:3px; text-align:center">
  <?php
   echo form_submit($attributes['option1']);
   echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
   echo form_button($attributes['option2']);
   echo form_close();
  ?>
 </div>


</div>

</body>
</html>