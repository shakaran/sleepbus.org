<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo PREFIX_TITLE;?> Ask About Generating New Superadmin Password</title>
  <?=$this->admincss->IncludeCssFiles()?>
  <?=$this->adminjavascript->IncludeJsFiles()?>
  <style type="text/css">
  body{ margin:0px; padding:0px; height:30px;}
  	iframe{ border:1px solid #515151; height:500px;}
  </style>
</head>
<body>
 <?php
  echo form_open('','return false;');
 ?>

<div style="border: solid thin #c1d7e6; padding: 6px 5px 23px 5px; background-color: #F5F5F5;">

  <span class="main_heading">Add Help Text for </span>  <span class="success"><b><?php echo $module_name;?> :  <?php echo $submodule_name;?></b></span>
  <div class="popup_alert_msg"><br />
  <center> <?php $success_message=$this->session->flashdata('success_message');
     if(isset($success_message)) echo $success_message;?></center>
  </div>
  
  <div style="padding-top:10.1px;padding-left:3px; text-align:center">
   <?php
    echo form_textarea($attributes['help_text']);
   	$this->ckeditor->config['width'] = '830px';
	$this->ckeditor->config['height'] = '270px';            
	echo $this->ckeditor->replace("help_text");
		     	 		  
  
   echo form_submit($attributes['submit']);
   echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
   echo form_button($attributes['option2']);
   echo form_close();
  ?>
 </div>


</div>

</body>
</html>