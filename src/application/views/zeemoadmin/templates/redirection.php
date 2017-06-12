<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Redirecting</title>
</head>
<body>
  <div align="center" style="padding-top:100px;"><b>Please Wait...<br />Page is being redirected</b></div>
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