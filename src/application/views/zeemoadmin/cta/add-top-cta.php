<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo PREFIX_TITLE.$title;?></title>
  <?=$this->admincss->IncludeCssFiles()?>
  <?=$this->adminjavascript->IncludeJsFiles()?>
</head>
<body>
 <?php
  echo form_open_multipart(base_url().admin."/cta/validatecta", $attributes['form']);
  echo form_hidden('page_id',$page_id);
  echo form_hidden('page_type',$page_type);
  echo form_hidden('cta_id',$cta_id);
  echo form_hidden('cta_title',$cta_title);
  echo form_hidden('section',$section);
  echo form_hidden('main_section',$main_section);
  
 ?>

<div style=" padding: 6px 5px 8px 5px !important;">


  <span class="main_heading" style="padding-top:3px;padding-bottom:5px;">CTA Display <span class="success"><b><?php echo ucfirst(urldecode($main_section));?> >> <?php echo ucfirst(urldecode($cta_title));?></b></span> <?php if($page_id == '0'){ ?> (Main Page) <?php }?></span>
  <?php
   if(isset($last_modified) and count($last_modified) > 0)
   {
	echo "<span class='last_modified_pop_up'>Last Modified by <span class='success'>".$last_modified['username']."</span> on <span class='success'>".$last_modified['time']."</span></span>";
   }
  ?>
 
</div>
             <table width="98%" border="0" cellpadding="0" cellspacing="0" style="color: #636466;font-family: Arial;font-size: 11px;font-weight: bold;text-align: left;padding-left:22px;">
     		    <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
               *<?php 
			    echo " You can't check more than 1 item.";   ?>             </td>
                </tr>   <?php 
				 $con=0;
				 $cta1=array();
					$cta1=explode(",",$cta);	
					  $total_checked=0;
				 foreach($cta_info as $info)
				 {
				  $con++;
				  if(isset($cta1) && in_array($info['id'],$cta1))
				  {
					  $total_checked++;
					 
				  }
					 ?><tr><td colspan="4" style="padding-top:0px;padding-bottom:5px;padding-top:5px;">
                 <input type="checkbox" name="cta[]" id="cta<?=$con?>" value="<?php echo $info['id'];?>" <?php if(isset($cta1) && in_array($info['id'],$cta1)){?>checked <?php } ?> onclick="ShowProductAlert('cta<?=$con?>','<?php echo count($cta_info);?>');" /> <?php echo $info['section_icon_name'];?></span>
               </td></tr>
               <?php } ?>
                
			  
               
			   <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
                <input type="hidden" id="total_checked" name="total_checked" value="<?=$total_checked?>"> <?php
				 echo form_submit($attributes['submit']);
                ?>
                 </td>
                </tr>                
               </table>

  <div style="padding-top:13px;padding-bottom:5px;padding-left:3px;">
 </div>



 </form>
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