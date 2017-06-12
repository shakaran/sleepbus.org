<div style="padding:25px;">
 <div id="input_text">
 <?php
  echo form_open_multipart(base_url().admin.'/landingpages/validatelandingpage',$attributes['form']);
  if(!empty($item_id))
  {
   echo form_hidden('item_id',$item_id);
  }
 ?>
  <table width="98%" border="0" cellpadding="0" cellspacing="0">
   <tr>
    <td style="padding-bottom:9px;">
    <span class="main_heading"><?php echo $page_title;?></span>
    </td>
    <td colspan="3">
    <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
    </td>
   </tr>
    <tr><td colspan="4" style="padding-top:0px;padding-bottom:5px;">
     *Page title/name &nbsp;<span class="error1" id="error1"><?php echo form_error('title'); ?></span>
    </td>
   </tr>
   <tr>
    <td colspan="4" align="left" valign="top">
     <?php echo form_input($attributes['title']); ?>&nbsp;<span><?php echo form_input($attributes['limit1']);
      ?></span><span class="remarks">(Max. 85 chars)</span>
    </td>
   </tr>   
   <tr>
    <td style="padding-top:10px;padding-bottom:5px;" colspan="4">
     Page/content heading:&nbsp;<span class="error1" id="error5"><?php echo form_error('page_heading'); ?></span>
    </td>
   </tr>
   <tr  colspan="4">
	<td>
     <?php echo form_input($attributes['page_heading']); ?>
    </td>
   </tr>    
    
   <tr><td colspan="4" style="padding-top:15px;padding-bottom:5px;">
     URL &nbsp;<span class="remarks">(Please do not add domain name in url. If URL is not entered, system will automatically create URL based on page title)</span>
   </td></tr>
   <tr>
    <td colspan="4" align="left" valign="top">
     <?php echo form_input($attributes['url']); ?>
     &nbsp;<span class="error1" id="error3"><?php echo form_error('url'); ?></span>
    </td>
   </tr>    
   
   <tr>
    <td colspan="4" style="padding-top:10px;padding-bottom:5px;">
     *Page content&nbsp;<span class="remarks">(Please do not copy and paste content from word document directly to this editor)</span>
     &nbsp;<span class="error1" id="error2"><?php echo form_error('description'); ?></span>
    </td>
   </tr>
   <tr>
    <td colspan="4" align="left">
     <?php 
      echo form_textarea($attributes['description']);
      $this->ckeditor->config['width'] = '700px';
      $this->ckeditor->config['height'] = '300px';            
      echo $this->ckeditor->replace("description");
     ?>  
    </td>
   </tr>
   
   <tr><td colspan="4" style="padding-top:15px;padding-bottom:5px;">
     Meta title&nbsp;<span class="remarks"></span>&nbsp;<span class="error1" id="error4"><?php echo form_error('meta_title'); ?></span>
   </td></tr>
   <tr>
    <td colspan="4" align="left" valign="top">
     <?php echo form_input($attributes['meta_title']); ?>
    </td>
   </tr>    
   
   <tr><td colspan="4" style="padding-top:15px;padding-bottom:5px;">
     Meta keywords&nbsp;<span class="remarks"></span>&nbsp;<span class="error1" id="error5"><?php echo form_error('meta_keyword'); ?></span>
   </td></tr>
   <tr>
    <td colspan="4" align="left" valign="top">
     <?php echo form_textarea($attributes['meta_keyword']); ?>
    </td>
   </tr>    
   
   <tr><td colspan="4" style="padding-top:15px;padding-bottom:5px;">
     Meta description&nbsp;<span class="remarks"></span>&nbsp;<span class="error1" id="error5"><?php echo form_error('meta_description'); ?></span>
   </td></tr>
   <tr>
    <td colspan="4" align="left" valign="top">
     <?php echo form_textarea($attributes['meta_description']); ?>
    </td>
   </tr>    
   
   
   <tr>
    <td valign="top" align="left" width="55%" style="padding-top:10px;padding-bottom:10px;"></td>
    <td align="left" valign="top"></td>
   </tr>                       
   <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
     <?php
      echo form_submit($attributes['submit']);
     ?>
   </td></tr>
   <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;"></td></tr>
  </table> 
  <?php
   echo form_close();
  ?>  
 </div>
</div>
