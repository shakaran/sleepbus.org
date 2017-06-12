<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo PREFIX_TITLE.$title;?></title>
  <?=$this->admincss->IncludeCssFiles()?>
  <?=$this->adminjavascript->IncludeJsFiles()?>
  </head>

 <?php
  if(!empty($this->admin_id))
  {
   $success_message=$this->session->flashdata('success_message');
   ?> 
   <body>
   <!--<div id="flash" style=" position:absolute; top:0px; width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-align:center;color:#5685A6;"></div>-->
   <input type="hidden" name="success_message" id="success_message" value="<?php echo $success_message; ?>" />
   <div id="wrapper_cms" align="center">
    <div id="cms_wrapper_inner" align="center">
     <div class="displaycms">
   	  <div id="logotop_cms"><a href="http://www.zeemo.com.au"><img src="<?=base_url()?>images/<?=admin?>/<?php echo LEFT_LOGO;?>" title="Web Design Melbourne, Sydney" alt="Web Design Melbourne, Sydney" border="0" ></a></div>
       <div id="banner_cms">Content Management System</div>
        <div id="logotop_right_cms">
         <span class="user_top_heading">Logged in as:</span> <span class="logout_btn"><?=$this->admin_id;?></span><br />
    <a href="<?php echo base_url().admin;?>/logout" class="logout_btnh8">Log out</a><br />
    
			   <?php
			   $open_popup_to_edit_logo="OpenAddImageForm('".base_url().admin."/home/EditImage','1')";
			   ?>
    
    <div id="drop_box"><a href="javascript:void(0)" id="edit_logo_anchor" class="link1" onclick="<?php echo $open_popup_to_edit_logo;?>"><div style="padding-top:60px;display:none;padding-right:8px;" id="link_container">Edit Logo</div></a></div><a href="<?php echo base_url().admin;?>/home" id="logo_anchor" ><img src="<?=base_url()?>images/<?=admin?>/cms-settings/logo/<?php echo $right_logo['right_logo_image_file']?>" alt="<?php echo $right_logo['right_logo_image_alt_title_text']?>" title="<?php echo $right_logo['right_logo_image_alt_title_text']?>" class="logotop" id="logo_container"/></a>
   </div>

  <div class="clearheight"></div>
   <div class="headcontainer">
    <div class="header-heading">
    <?php
	 if($this->uri->segment(2) == "home")
	 {
      ?>
      <img src="<?=base_url()?>images/<?=admin?>/cms-settings/top/<?=HEADER_PAGE_ICON?>" /><span><?=HEADER_TEXT?></span>      <?php
	 }
	 else
	 {
	  ?>
      <img src="<?=base_url()?>images/<?=admin?>/cms-settings/top/<?php echo $module_details['header_icon']?>" /><span><?php echo $module_details['module_name'];?></span>
      <?php
	 }
	 if($this->data['active_module'] != "home" and ($this->Login_model->HelpTextExist($active_module."/".$active_submodule)))
	 {
	  ?>
	  <!--<div class='helpText' style="text-align:right"><a href="<?php // echo base_url()?>admin/home/viewhelptext/<?php // echo $active_module;?>/<?php // echo $active_submodule;?>?iframe=true&width=900&height=520" rel="prettyPhoto"><span class="tools_icon"><?php // echo img(base_url()."images/admin/icons/left/service.png");?></span>Help</a></div>-->
	  <?php
     }

	 if(isset($last_modified) and count($last_modified) > 0)
	 {
	  echo "<div class='last_modified'>Last Modified by <span class='success'>".$last_modified['username']."</span> on <span class='success'>".$last_modified['time']."</span></div>";
	 }
	 
	 ?><!--<div id="ResponseMessage" style="text-align:center;color:#000; position:absolute;width:300px;
    left:30%;margin-left:-70px;background-color:#2ccc00;margin-top:20%;-webkit-box-shadow: 0px 5px 9px rgba(92, 50, 50, 0.75);-moz-box-shadow:    0px 5px 9px rgba(92, 50, 50, 0.75);box-shadow:0px 5px 9px rgba(92, 50, 50, 0.75);border-radius:5px;font-weight:bold;"></div>-->  
     </div>
   </div>
  </div>
  
  <?php
   if($this->data['active_module'] != "home")
   {
    ?>
    <table width="100%" height="306" border="0" cellpadding="0" cellspacing="0">
     <tr>
      <td align="center">
       <div id="setInnerHeight">
        <table width="1000" border="0" cellspacing="0" cellpadding="0" >
         <tr>
          <td width="40" valign="top">
		   <?php
		   $this->load->view(admin.'/left.php');
		   ?>
          </td>
          <td align="center" valign="top">
          <div id="div_cate_top">
          <?php
		  $this->load->view(admin.'/templates/sub-header.php');
		  ?>
          <div id="div_center_cms">
	<?php
   }
  }
  else
  {
   ?>
   <body class="login_body"> 
   <?php
  }
  ?>
