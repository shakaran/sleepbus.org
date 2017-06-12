<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo PREFIX_TITLE.$title;?></title>
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
  echo form_open(base_url().admin.'/modules/manage',$attributes['form']);
 ?>

<div style=" padding: 6px 5px 0px 5px !important; background-color: #F5F5F5;">


  <span class="popup_title"><?php if($parent_id == 0){ echo "Module Name";}else{ echo "Submodule Name";}?></span><br />
  <div class="error_popup" id="show_error">&nbsp;</div>

  <?php echo form_input($attributes['module_name']);
    echo form_hidden($attributes['path']);
	echo form_hidden($attributes['parent_id']);
	echo form_hidden($attributes['module_id']);	
   ?>
  <div style="padding-top:13px;padding-bottom:5px;padding-left:3px;">
  <?php
   echo form_submit($attributes['option1']);
   echo "&nbsp";
   echo form_button($attributes['option2']);
  ?>
 </div>


</div>
 </form>
 

</body>
</html>