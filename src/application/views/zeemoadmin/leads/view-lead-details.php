<html>
<head>
<title></title>
<style type="text/css">
	body{ font-family:Arial, Helvetica, sans-serif; font-size:12px;}
	.list_heading{
	font-family:Arial;
	color:#636466;
	font-size:12px;
	line-height:17px;
}
</style>
 
</head>
<body>
<div id="map" style="width:550px; padding-left:20px;">
 <span class="list_heading" style="color: black;"><strong>User Details</strong></span>
 <table width="100%" border="1" cellpadding="5" cellspacing="0" align="center" style="border:solid thin gray; border-collapse:collapse;">
  <tr style="height: 25px">
   <td width="40%" align="left" valign="top" class="list_heading"><strong>Name</strong> </td> 
   <td align="left" valign="top" class="list_heading"> <?php echo $records_data['name'];?> </td> 
 </tr> 
 
 <tr style="height: 25px">
  <td align="left" valign="top" class="list_heading"><strong>Email ID</strong> </td> 
  <td align="left" valign="top" class="list_heading" ><?=$records_data['email'];?></td>
 </tr>
 
 
 <tr style="height: 25px">
  <td align="left" valign="top" class="list_heading"><strong>Phone</strong> </td> 
  <td align="left" valign="top" class="list_heading" ><?=$records_data['contact_no'];?></td>
 </tr>

 <?php 
 if(!empty($records_data['company']))
 { 
 ?>
  <tr style="height: 25px">
   <td align="left" valign="top" class="list_heading"><strong>Company</strong> </td> 
   <td align="left" valign="top" class="list_heading" ><?=$records_data['company'];?></td>
  </tr>
 <?php
 }
 ?>

 <?php 
 if(!empty($records_data['postcode']))
 { 
 ?>
  <tr style="height: 25px">
   <td align="left" valign="top" class="list_heading"><strong>Postcode</strong> </td> 
   <td align="left" valign="top" class="list_heading" ><?=$records_data['postcode'];?></td>
  </tr>
 <?php
 }
 ?>

 <tr style="height: 25px">
  <td align="left" valign="top" class="list_heading"><strong>How did you hear about us?</strong> </td> 
  <td align="left" valign="top" class="list_heading" ><?=$records_data['question'];?></td>
 </tr>
  
 <tr style="height: 25px">
  <td align="left" valign="top" class="list_heading"><strong>Message</strong> </td> 
  <td align="left" valign="top" class="list_heading" ><?=$records_data['message'];?></td>
 </tr>
  
 <tr style="height: 25px">
  <td align="left" valign="top" class="list_heading"><strong>Date</strong> </td> 
  <td align="left" valign="top" class="list_heading" ><?=$records_data['date'];?></td>
 </tr>
  
 </table>

</div>
</body>
</html>