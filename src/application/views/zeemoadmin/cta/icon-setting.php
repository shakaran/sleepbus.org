   <div style="padding:15px 25px 25px 0px;">
    <div id="input_text">
     <?php
      echo form_open_multipart(base_url().admin.'/cta/validateiconsetting',$attributes['form']);
     if(!empty($icon_id)) echo form_hidden('icon_id',$icon_id);
     ?>
      <table width="98%" border="0" cellpadding="0" cellspacing="0" style="padding-left:35px;">
       <tr>
        <td colspan="4">
         <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
        </td>
       </tr>
       <tr>
        <td style="padding-bottom:9px;"><span class="main_heading"><?php echo $page_title;?></span></td>
        <td colspan="3"><div class="error1" id="error">
        <?php if(isset($error_msg)) echo $error_msg; ?>
         </div></td>
        </tr>               
       <tr height="25" valign="bottom">
        <td>*CTA Name &nbsp;&nbsp;<span class="error1" id="error1"><?php echo form_error('section_icon_name');?></span>
        </td>
       </tr>
       <tr height="25">
        <td align="left">
         <?php
          echo form_input($attributes['section_icon_name']);
         ?>
        </td>                         
       </tr>                    
       
       <tr height="25" valign="bottom">
        <td style="padding-top:5px;">
        URL &nbsp;<span class="remarks"><?php echo URL_INSTRUCTION;?></span>&nbsp;&nbsp;
        <span class="error1" id="error2"><?php echo form_error('url');?></span>
        </td>
       </tr>
       <tr height="25">
        <td align="left">
         <?php echo form_input($attributes['url']);?>
        </td>                         
       </tr>                    

       <tr height="25" valign="bottom">
        <td style="padding-top:5px;">
        *CTA content &nbsp;<span class="remarks">(including icon, title and intro text)</span>
        &nbsp;<span class="error1" id="error3"><?php echo form_error('intro_text');?></span>
        </td>
       </tr>
       <tr height="25">
        <td align="left">
		 <?php echo form_textarea($attributes['intro_text']);
         $this->ckeditor->config['width'] = '700px';
         $this->ckeditor->config['height'] = '150px';            
         echo $this->ckeditor->replace("intro_text");
         ?>          
        </td>                         
       </tr>                    

       <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
       <?php
         echo form_submit($attributes['submit']);
        ?>
       </td></tr>
       <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">&nbsp;</td></tr>                                             
      </table>
   
      <!-- Data needed for multiple deletion-->
      <?php
      echo form_close();
    

     if(count($icon_list) > 0)
     {
          echo form_open(base_url().admin.'/cta/icon-setting',$attribute['form']);
      ?>
       <div class="ulTable">
        <ul>
         <li>
         <div class="ulTableinner sn-no" style="width:54px;">&nbsp;&nbsp;S.No</div>
         <div class="ulTableinner sn-no-other" style="width:150px;">Title</div>
         <div class="ulTableinner sn-no-other" style="width:100px;">&nbsp;</div>
         <div class="ulTableinner sn-no-other" style="width:230px;">Status</div>
         <div class="ulTableinner sn-no-other" style="width:75px;">Tools</div>
         <div class="ulTableinner sn-no-other" style="width:96px;"><label><span class="tools_icon"><?php echo form_checkbox($attribute['remove_all']);?>&nbsp;<?php echo img(base_url()."images/".admin."/icons/tools/check.png");?></span></label></div>
        </li>
       </ul>
      </div>
     <div class="clearfix"></div>
    <?php
    if(count($icon_list) > 0)
    {
     ?>
      <!--Data Needed for Positioning-->
      <input type="hidden" name="parent_id" value="0" id="parent_id" />
                 <input type="hidden" name="total_data" id="total_data" value="<?php echo $attribute['total_data']?>" />  
     <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $attribute['deletion_path']?>" />   

      <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".ICON_SETTINGS;?>" id="file_path" />
      <div class="ulTable_record" id="recordList">
       <ul>
       <?php
       $i=1;
       $j=1;
       foreach($icon_list as $list)
       {
        ?>
        <li id="recordsArray_<?php echo $list['id'];?>" style="padding:0px;">
        <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
        <div class="ulTableinner_record sn-no" style="width:150px;">&nbsp;&nbsp;<?php echo $list['section_icon_name'];?></div>
        <div class="ulTableinner_record sn-no-other-record" style="width:100px;">&nbsp;</div>
        <div class="ulTableinner_record sn-no-other-record" style="width:200px;">
        <?php
           if($list['status'] == 0)
           {
            echo anchor(base_url().admin.'/cta/changestatus/'.$list['id'].'/1/icon-setting', 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
           }
           else
           {
            echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/cta/changestatus/'.$list['id'].'/0/icon-setting', 'Hide',array('title'=>'Hide'));
           }
          ?>
        </div>
        <div class="ulTableinner_record sn-no-other-record" style="width:106px;">&nbsp; &nbsp;&nbsp; <a href="<?php echo base_url().admin?>/cta/edit_icon/<?php echo $list['id'];?>" title="Edit"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/edit.png");?></span>&nbsp;Edit</a> </div>
        <div class="ulTableinner_record sn-no-other-record" style="width:100px;">
             <?php
            
             echo form_checkbox($attribute['data'.$i]);
             $i++;
            ?>
            </div>
        <div class="clearfix"></div>
       </li>
       <?php
       $j++;
      }
      ?>
    </ul>
   </div>
    <div class="ulTable" style="padding-top:5px;">
    <ul>
     <li>
        <div class="ulTableinner_record sn-no">&nbsp;</div>
        <div class="ulTableinner_record sn-no-other">&nbsp;</div>
        <div class="ulTableinner_record sn-no-other" style="width:150px;">&nbsp;</div>
        <div class="ulTableinner_record sn-no-other" style="width:154px;">&nbsp;</div>
        <div class="ulTableinner_record sn-no-other" style="width:106px;"><span class="tools_icon">
             <div id="remove_active" style="display:none">
             <?php
              echo form_submit($attribute['delete_all']);
             ?>
             </div>
             <div id="single_remove" style="display: none">
             <?php
              echo form_submit($attribute['delete']);
             ?>
             </div>                         
             <div id="remove_inactive" style="display: block">
             <?php
              echo form_submit($attribute['delete_all']);
             ?>
             </div></span>
            </div>
          </li>
        </ul>
      </div>
      <?php
     }
      echo form_close();
     }
    ?>
<div class="clearfix"></div>

</div>
</div>
                   
