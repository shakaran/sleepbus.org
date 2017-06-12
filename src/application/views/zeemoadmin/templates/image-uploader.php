<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo PREFIX_TITLE.$title;?></title>
  <?=$this->admincss->IncludeCssFiles()?>

</head>

<body>
 <?php
  echo form_open_multipart(base_url().admin.'/home/uploadImages', $attributes['form']);
  echo form_hidden('max_height',$max_height);
  echo form_hidden('max_width',$max_width);
  echo form_hidden('fixed_width',$fixed_width);
  echo form_hidden('fixed_height',$fixed_height);
  echo form_hidden('max_size',$max_size);
  
 ?>
<input type="hidden" id="base_path" name="base_path" value="<?php echo base_url()?>" />
<input type="hidden" id="path_to_upload" name="path_to_upload" value="<?php echo $path_to_upload;?>" />
<input type="hidden" id="upload_type" name="upload_type" value="<?php echo $upload_type;?>" />
<input type="hidden" id="field_name" name="field_name" value="<?php echo $field_name;?>" />
<input type="hidden" id="table_name" name="table_name" value="<?php echo $table_name;?>" />
<input type="hidden" id="parent_field" name="parent_field" value="<?php echo $parent_field;?>" />
<input type="hidden" id="parent_id" name="parent_id" value="<?php echo $parent_id;?>" />
<input type="hidden" id="description" name="description" value="<?php echo $description;?>" />

<div style=" padding: 6px 5px 8px 5px !important;">


  <span class="main_heading" style="padding-top:3px;padding-bottom:5px;"><?php echo $page_title;?></span>

 
</div>
             <table width="98%" border="0" cellpadding="0" cellspacing="0" style="color: #636466;font-family: Arial;font-size: 11px;font-weight: bold;text-align: left;padding-left:22px;">
     		   <tr>
                <td colspan="2">
                 <?php echo $parent_drop_down_title;?> :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_dropdown('parents',$attributes['parents'],$parent_id,"class='select_action' style='width:285px;' id='parents' disabled='disabled'")?>&nbsp;<span class="remarks"> *(Disabled)</span>&nbsp;<span id="error1" class="error2"><?php echo form_error('parents');?></span>
                </td>
               </tr> 
               </table>
               <div id="drop">
               <div style="float:right;" class="pos"><a href="<?php echo base_url().admin;?>/home/redirectToParentPage/<?php echo str_replace("/","~",$return_url);?>" title="Close"><img src="<?php echo base_url();?>images/<?php echo admin;?>/icons/tools/close-uploader.png" /></a></div>
				<div style="padding-left:209px;" class="image-uploader-aside"><span class="drop-here">Drop files here <span style="color:#999999;">or</span></span>

				<a class="browse">SELECT FILES</a>
				<input type="file" name="image_file" id="image_file" multiple />
                
                <?php
                if(isset($remarks) and !empty($remarks))
				{
				 ?>
                 <span id="remarks" style="padding-top:6px;float:left;"><?php echo $remarks;?></span>
                 <?php
				}
				?>
               </div> 
			</div>

			<ul>
				<!-- The file uploads will be shown here -->
			</ul>

 <?php
  echo form_close();
 ?>


  <div style="padding-top:13px;padding-bottom:5px;padding-left:3px;">
 </div>


 <?=$this->adminjavascript->UploaderFileFooterJs()?>
<div id="result"></div>
</body>
</html>