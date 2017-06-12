<html>
 <head><title>Redirecting to merchant account</title>
 <script src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"  type="text/javascript"></script>  
<script language="javascript">
 $(document).ready(function(){	
 $(window).load(function(){
 $("body").css('cursor', 'wait');    
	  document.getElementById('review_form').submit();
	 })
 })
</script> 
 </head>
<body> 

<div align="center" style="margin:100px;">
<h2>Please Wait!!!</h2>
<h1>You're redirected to merchant website. Please don't close the window</h1>
<form action='<?php echo base_url();?>recurring/order-confirm' METHOD='POST' id="review_form">
</form>
</div>
</body>
</html>
