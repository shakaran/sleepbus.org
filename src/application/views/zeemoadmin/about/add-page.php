  <?php
  echo form_open_multipart($file_path, $attributes['form']);
  if(!empty($attributes['edit_id']))
  {
   echo form_hidden('edit_id',$attributes['edit_id']);
  }
  ?>
 
  <table border="0" cellpadding="0" cellspacing="0" style="color: #636466;font-family: Arial;font-size: 11px;font-weight: bold;text-align: left;padding-left:22px;">

   <tr>
    <td style="padding-top:30px;padding-bottom:5px;" colspan="2" class="main_heading" >
     <?php echo $page_title; ?>
    </td>
   </tr>
     		    
   <tr>
    <td style="padding-top:10px;padding-bottom:5px;" colspan="2">
     *Page name/title:&nbsp;<span class="error1" id="error1"><?php echo form_error('item_title'); ?></span>
    </td>
   </tr>
   <tr>
	<td colspan="2">
     <?php echo form_input($attributes['item_title']); ?>
     &nbsp;<span><?php echo form_input($attributes['limit1']);?></span>
     <span class="remarks"><?php if(isset($title_remarks)){ echo $title_remarks;}else{ ?>(Max. 50 chars)<?php } ?></span>
    </td>
   </tr>
   <tr>
    <td style="padding-top:10px;padding-bottom:5px;" colspan="2">
     Page/content heading:&nbsp;<span class="error1" id="error6"><?php echo form_error('page_heading'); ?></span>
    </td>
   </tr>
   <tr>
	<td colspan="2">
     <?php echo form_input($attributes['page_heading']); ?>
    </td>
   </tr>
      
   <tr>
    <td align="left" valign="top" colspan="2" style="padding-top: 10px;">
     *Intro text <span class="remarks">(to be displayed on landing page)</span>&nbsp;<span class="error1" id="error2">
	 <?php echo form_error('intro_text'); ?></span>
    </td>
   </tr>
   <tr>      
    <td align="left" valign="middle" colspan="2">
     <?php 

	 echo form_textarea($attributes['intro_text']);
     $this->ckeditor->config['width'] = '700px';
     $this->ckeditor->config['height'] = '150px';            
     echo $this->ckeditor->replace("intro_text");

     ?>  
    </td>
   </tr>
   <tr>
    <td align="left" valign="top" colspan="2" style="padding-top: 10px;">
     *Page type:&nbsp;<span class="error1" id="error3"></span><br />
     <?php
	  $radio1_check = $radio2_check = FALSE;
	  if($attributes['page_type']=='1') $radio1_check = TRUE;
	  if($attributes['page_type']=='2') $radio2_check = TRUE;
	  $radio_data1 = array('id'=>'page_type1','name'=>'page_type','value'=>'1','checked'=>$radio1_check,'onclick'=>'HideShowEditor(1)');
	  echo form_radio($radio_data1);
	 ?>
     New page<span class="remarks">(content will be taken from the editor given below)</span><br />
     <?php
	  $radio_data2 = array('id'=>'page_type2','name'=>'page_type','value'=>'2','checked'=>$radio2_check,'onclick'=>'HideShowEditor(2)');
	  echo form_radio($radio_data2);
	 ?>
     Internal or external page<span class="remarks">(in this case you need to enter complete url of page where it is to be sent)</span>
    </td>
   </tr>
   <tr height="25" valign="bottom" id="url_id" style="display: <?php if($attributes['page_type']=='2') echo 'block'; else echo 'none';?> ">
    <td style="padding-top: 10px;" colspan="2">
     *URL&nbsp;<span class="remarks"><?php echo URL_INSTRUCTION;?>&nbsp;<span class="error1" id="error4"><?php echo form_error('url');?></span>
     <br /><?php
     echo form_input($attributes['url']);
    ?>
    </td>                         
   </tr>
   <tr>
    <td align="left" valign="top" colspan="2" style="padding-top: 10px;">
     <div id="new_page_editor" style="display: <?php if($attributes['page_type']=='1') echo 'block'; else echo 'none';?>" >
     *Content for new page <span class="remarks">(including page heading)</span>
     &nbsp;<span class="error1" id="error5"><?php echo form_error('description'); ?></span><br />
     <?php 
	
	  echo form_textarea($attributes['description']);
      $this->ckeditor->config['width'] = '700px';
      $this->ckeditor->config['height'] = '250px';            
      echo $this->ckeditor->replace("description");
     ?>  
     </div>
    </td>
   </tr>
 
   <tr>
    <td valign="top" align="left" style="padding:20px 0px 10px 0px;border:thin solid white;" width="50%">
     <table width="100%" align="left" cellpadding="0" cellspacing="0" border="0">
      <tr height="10">
       <td align="left" valign="top" colspan="2">
         Upload Image&nbsp;&nbsp;
        &nbsp;<div class="error1" id="error7"><?php echo form_error('image_file'); ?></div>
       </td>
      </tr>
      <tr height="10">
       <td align="left" valign="top">
        <?php echo form_upload($attributes['image_file']);?>
        <br /><span class="remarks"><?php if(isset($image_remarks)){ echo $image_remarks;}?></span>
        <div style="padding-top:10px;">Alt/ Title text <span class="remarks">(For SEO)</span> :</div>
        <div style="padding-top:6px;">  <?php echo form_input($attributes['image_alt_title_text']);?></div> 
        <div style="padding-top:10px;">
         <?php
          echo IMAGE_QUALITY_INSTRUCTION."<br>";
          echo form_dropdown('image_quality',$image_quality_options,$image_quality,'class="select_action"');
         ?>                 
         <span class="remarks"><?php echo IMAGE_QUALITY_REMARKS;?></span> 
        </div>
       </td>
      </tr>                            
     </table>
    </td>
    <td align="center" valign="top" style="padding-top:5x; padding-bottom:10px;background-color:#F7F7F7;border:thin solid white;" width="50%">
     <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
      <tr height="10"><td align="left" valign="top"></td></tr>
      <tr height="10">
       <td align="left" valign="top">
        <?php
		if(!empty($attributes['current_image']))
		{
		 echo "<div style='padding-bottom:5px;'>Current Image</div>";
		 ?>
		 <img src="<?php echo base_url();?>images/generalpages/<?php echo $attributes['current_image'];?>" width="300" height="90" />
		 <br />
		 <span class="gallery">
		  <a href="<?php echo base_url().admin;?>/about/ConfirmDelete/<?php echo $attributes['edit_id'];?>/image?iframe=true&width=320&height=110" rel="prettyPhoto" class="link1"><span class="tools_icon">Delete Image</a></span>
		 <?php
		 echo form_hidden('current_image',$attributes['current_image']);
		} 
		else
		{
		 ?>
		  <div class="remarks" style="text-align:center;">Image Preview</div>
		 <?php
		}
        ?>								
       </td>
      </tr>                            
     </table>                          
    </td>
   </tr> 
 
   <tr height="25" valign="bottom">
    <td colspan="2"><br /><br />&nbsp;<?php echo form_submit($attributes['submit']);?></td>
   </tr>
  </table>
  
  <div style="padding-top:13px;padding-bottom:5px;padding-left:3px;">
 </div>
 </form>
 
