
<div style="padding:25px;">
  <div id="input_text">
    <?php
              echo form_open_multipart(base_url().admin.'/blogs/validate-blogger',$attributes['form']);
			  if(!empty($blogger_id)) echo form_hidden('blogger_id',$blogger_id);
			 ?>
    <table width="98%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td style="padding-bottom:9px;"><span class="main_heading"><?php echo $page_title;?></span></td>
        <td colspan="3"><div class="error1" id="error">
            <?php if(isset($error_msg)) echo $error_msg; ?>
          </div></td>
      </tr>
      <tr>
        <td style="padding-top:0px;padding-bottom:5px;"> *Blogger name&nbsp;<span class="error1" id="error1"><?php echo form_error('blogger_name'); ?></span></td>
      </tr>
      <tr>
        <td colspan="4" align="left" valign="top"><?php echo form_input($attributes['blogger_name']); ?>&nbsp;<span><?php echo form_input($attributes['limit1']);
				  ?></span><span class="remarks">&nbsp;(Max. 25 chars)</span></td>
      </tr>
      <tr>
        <td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;"><?php echo form_submit($attributes['submit']);?></td>
      </tr>
    </table>
    <?php
              echo form_close();
             ?>
  </div>
</div>
<div class="record_list">
  <div class="error1" id="error">
    <?php if(isset($error_msg)) echo $error_msg; ?>
  </div>
  <!-- Data needed for multiple deletion-->
  <?php
			 if(count($blogger_list) > 0)
		     {
              echo form_open(base_url().admin.'/blogs/add-blogger',$attribute['form']);
		      ?>
  <input type="hidden" name="total_data" id="total_data" value="<?php echo $attribute['total_data']?>" />
  <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $attribute['deletion_path']?>" />
  <div class="ulTable">
    <ul>
      <li>
        <div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
        <div class="ulTableinner sn-no-other" style="width:272px;">Category Name</div>
        <div class="ulTableinner sn-no-other" style="width:180px; text-align:center">Status</div>
        <div class="ulTableinner sn-no-other" style="width:190px; text-align:center">Tools</div>
      </li>
    </ul>
  </div>
  <div class="clearfix"></div>
  <?php
             if(count($blogger_list) > 0)
			 {
			 ?>
  <!--Data Needed for Positioning-->
  <input type="hidden" name="parent_id" value="0" id="parent_id" />
  <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".BLOGGER;?>" id="file_path" />
  <div class="ulTable_record" id="recordList">
    <ul>
      <?php
			  $i=1;
			  $j=1;
			  foreach($blogger_list as $blogger)
			  {
			   ?>
      <li id="recordsArray_<?php echo $blogger['id'];?>" style="padding:2px;">
        <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
        <div class="ulTableinner_record sn-no-other-record" style="width:270px;"><?php echo $blogger['blogger_name'];?></div>
        <div class="ulTableinner_record sn-no-other-record" style="width:190px; text-align:center">
          <?php
				  
				   if($blogger['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/blogs/changestatus/'.$blogger['id'].'/1/add-blogger', 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/blogs/changestatus/'.$blogger['id'].'/0/add-blogger', 'Hide',array('title'=>'Hide'));
				   }
				  
                  ?>
        </div>
        <div class="ulTableinner_record sn-no-other-record" style="width:140px; text-align:center; vertical-align:baseline;"> <a href="<?php echo base_url().admin;?>/blogs/edit-blogger/<?php echo $blogger['id'];?>" title="Edit">Edit</a> &nbsp;
          
          &nbsp; |&nbsp;<a href="<?php echo base_url().admin;?>/blogs/ConfirmSuperadmin/<?php echo $blogger['id'];?>/blogger&iframe=true&width=294&height=162" rel="prettyPhoto"  style="color: #884400;  text-decoration: none;" > <span class="tools_icon"> &nbsp;<?php  echo img(base_url()."images/".admin."/icons/tools/drop.png");?></span></span>&nbsp;Delete</a>
          
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
        <div class="ulTableinner_record sn-no-other" style="width:100px;">&nbsp;</div>
        <div class="ulTableinner_record sn-no-other" style="width:150px; text-align:right;"><span class="tools_icon">
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
          <div id="remove_inactive" style="display: none">
            <?php
					  echo form_submit($attribute['delete_all']);
                     ?>
          </div>
          </span> </div>
      </li>
    </ul>
  </div>
  <?php
			 }
			 echo form_close();
			 }
			 else
			 {
			  ?>
  <div class="success"> No blogger found.</div>
  <?php
			 }
		    ?>
  <div class="clearfix"></div>
</div>
