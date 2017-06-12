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
  echo form_open_multipart(base_url().admin."/generalpages/validatefootericon", $attributes['form']);
  if(isset($icon_id) and !empty($icon_id))
  {
   echo form_hidden('icon_id',$icon_id);
  }
  echo form_hidden('page_title',$page_title);
 ?>
<div style=" padding: 6px 5px 8px 5px !important;">
  <span class="main_heading" style="padding-top:3px;padding-bottom:5px;"><?php echo $page_title;?></span>
  <?php
   if(isset($last_modified) and count($last_modified) > 0)
   {
	echo "<span class='last_modified_pop_up'>Last Modified by <span class='success'>".$last_modified['username']."</span> on <span class='success'>".$last_modified['time']."</span></span>";
   }
  ?>
</div>
             <table width="98%" border="0" cellpadding="0" cellspacing="0" style="color: #636466;font-family: Arial;font-size: 11px;font-weight: bold;text-align: left;padding-left:22px;">
                        
      <tr>
        <td style="padding-top:0px;padding-bottom:5px;">*Title &nbsp;<span class="error1" id="error1"><?php echo form_error('clients_title'); ?></span></td>
      </tr>
      <tr >
        <td colspan="4" align="left" valign="top"><?php echo form_input($attributes['clients_title']); ?>&nbsp;<span><?php echo form_input($attributes['limit1']);
				  ?></span><span class="remarks">(Max. 24 chars)</span></td>
      </tr>

      
                         
				<tr><td style="padding-top:0px;padding-bottom:5px;padding-top:5px;">
                 URL <span class="remarks"> <?php echo URL_INSTRUCTION;?></span>&nbsp;<span class="error1" id="error3"><?php echo form_error('url'); ?></span>
               </td></tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_input($attributes['url']); ?>
                </td>
               </tr>                          			
                
               
    		   <tr>
                <td valign="top" align="left" width="55%" style="padding-top:10px;padding-bottom:10px;">
                 <table align="left" width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr height="10">
                   <td align="left" valign="top" colspan="2">
					<?php if(empty($attributes['current_image'])) echo "*"; ?> Upload Image
                    &nbsp;&nbsp;
                    &nbsp;<div class="error1" id="error2"><?php echo form_error('image_file'); ?></div>
                             </td>
                            </tr>
                            <tr height="10">
                             <td align="left" valign="top" width="85%">
                              <?php echo form_upload($attributes['image_file']);?>
                              <br /><span class="remarks">*<?php if(isset($remarks)){ echo $remarks;}else{ ?>Icon size must be 462x190px (width x height)px <?php } ?></span>
                              
							  <div style="padding-top:10px;">
                               Alt/ Title text <span class="remarks">(For SEO)</span> :</div><div style="padding-top:6px;">  <?php echo form_input($attributes['image_alt_title_text']);?></div> 
                               
                               
                               <div style="padding-top:10px;">
                 
			    			   <?php
							     echo IMAGE_QUALITY_INSTRUCTION.":&nbsp;&nbsp;";
			     				 echo form_dropdown('image_quality',$image_quality_options,$image_quality,'class="select_action"');
			   					?>                 
				                <div class="remarks"><?php echo IMAGE_QUALITY_REMARKS;?></div> 
                               </div>                              
                              
                              <br /><br />&nbsp;<?php echo form_submit($attributes['submit']);?>
                              </td>
                              <td valign="top">
                               
                              </td>
                             </tr>                            
                            </table>
                           </td>
                           <td align="left" valign="top" style="padding-top:5px;padding-bottom:10px;background-color:#F7F7F7;border:thin solid white;">
                            <table align="left"  width="100%" cellpadding="0" cellspacing="0" border="0">
                             <tr height="10">
                              <td align="left" valign="top"></td>
                             </tr>
                             <tr height="10">
                              <td align="center" valign="top">
                               <?php
							    if(isset($attributes['current_image']) and !empty($attributes['current_image']))
								{
								 echo "<div style='padding-bottom:5px;'>Current Image</div>";
                                 ?>
								 <img src="<?php echo base_url();?>images/generalpages/<?php echo $attributes['current_image'];?>" width="320" height="160" />
                                 <br />
                                 <input type="hidden" name="current_image" id="current_image" value="<?php echo $attributes['current_image']; ?>" />
                                 <?php
                         		 
								}
								else
								{
								 ?>
								  <div class="remarks" style="text-align:center">Image Preview</div>
								 <?php
								}
																	
								//echo form_hidden('current_image',$attributes['current_image']); 
								?>
                                
                              </td>
                             </tr>                            
                            </table>                          
                           </td>
                         </tr>                       
                        </table>

  <div style="padding-top:13px;padding-bottom:5px;padding-left:3px;">
 </div>



 </form>

</body>
</html>