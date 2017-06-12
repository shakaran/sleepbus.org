<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zeemo: User Verification</title>
<link href="<?php echo base_url();?>style/<?=admin?>/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
	body{ background:#005073; padding:0px; margin:0px;}
</style>

</head>

<body>

<div class="index-container">
        <div class="formsection">
        <div class="logo"><a href="http://www.zeemo.com.au/" target="_blank"><img src="<?php echo base_url();?>images/<?=admin?>/zeemo.png" border="0" alt="Web Design Melbourne, Sydney" title="Web Design Melbourne, Sydney"/></a></div>
            	<div id="wrapper_admin">
                <div id="div_admin_centerpanel" align="center">
                  <div style="height: 150px; padding-top: 100px">
                   <?php
				    if($status == "already active")
					{
					 ?>
					  <span style="font-family:Arial, Helvetica, sans-serif; color: #F3791F; font-size: 14px; font-weight: bold">Your acount is already activated<br />Please <a class="link1" style="font-size: 13px; text-decoration:underline; color:#FFFFFF;" href="<?php echo base_url()."admin"?>">click here</a> to login</span>
					 <?php
					}
					elseif($status == "activated")
					{
				     ?>
					 <span style="font-family:Arial, Helvetica, sans-serif; color: #ffffff; font-size: 14px; font-weight: bold"><u>Congratulations!!</u><br /><br /><font color="#F3791F"> Your acount has been activated<br />Please <a class="link1" style="font-size: 13px; text-decoration:underline; color:#FFFFFF;" href="<?php echo base_url()."admin"?>">click here</a> to login</font></span>
					 <?php
					}
					else
					{
					 ?>
					 <span style="font-family:Arial, Helvetica, sans-serif; color: #ffffff; font-size: 14px; font-weight: bold"><u>Sorry!!</u><br /><br /><font color="#F3791F">Your activation URL is incorrect.<br /> Please click on URL which you received in your email</font></span><br />
					 <?php
					}
				    ?>
                  </div>
                    
                </div> 
                      
    
                </div>
        </div>
      
    </div>

</body>
</html>
