            <div class="record_list">
             <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
             <!-- Data needed for multiple deletion-->   
             <?php
			 if(count($news_list) > 0)
		     {

              echo form_open(base_url().admin.'/news/managenews',$attribute['form']);
		     ?>
             <input type="hidden" name="total_data" id="total_data" value="<?php echo $attribute['total_data']?>" />  
             <input type="hidden" name="deletion_path" id="deletion_path" value="<?php echo $attribute['deletion_path']?>" />   
             <div class="ulTable">
            
            <ul>
            	<li>
                	<div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div class="ulTableinner sn-no-other" style="width:346px;">Title</div>
                	<div class="ulTableinner sn-no-other" style="width:70px;">Status</div>
                    <div class="ulTableinner sn-no-other" style="width:85px;">Date</div>
                	<div class="ulTableinner sn-no-other" style="width:64px;">Tools</div>
                    <div class="ulTableinner sn-no-other" style="width:80px;"><label> <span class="tools_icon"><?php echo form_checkbox($attribute['remove_all']);?>&nbsp;<?php echo img(base_url()."images/".admin."/icons/tools/check.png");?></span></label></div>
                </li>
                
            
            </ul>
            
             
           </div>
            <div class="clearfix"></div>
           
           
           <?php
            if(count($news_list) > 0)
			{
			 ?>
              <!--Data Needed for Positioning-->
              <input type="hidden" name="parent_id" value="0" id="parent_id" />
              <input type="hidden" name="file_path" value="<?php echo base_url().admin."/home/UpdatePosition/".NEWS;?>" id="file_path" />
              <div class="ulTable_record" id="recordList">
              
              <ul>
			  <?php
			  $i=1;
			  $j=1;
			  foreach($news_list as $news)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $news['id'];?>">
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:342px;"><?php echo $news['news_title'];?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:70px;">
                  <?php
				   if($news['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/news/changestatus/'.$news['id'].'/1/managenews', 'Show',array('title'=>'Show'))." | <span class='current_status'>Hide</span>";
				   }
				   else
				   {
				    echo "<span class='current_status'>Show</span> | ".anchor(base_url().admin.'/news/changestatus/'.$news['id'].'/0/managenews', 'Hide',array('title'=>'Hide'));
				   }
                  ?>
                  </div>
                  <div class="ulTableinner_record sn-no-other-record" style="width:89px;">
                   <?php
				    $temp=explode(" ",$news['date_display']);
				    $temp1=$temp[0];
					$date=explode("-",$temp1);
					echo $date[2]."-".$date[1]."-".$date[0];

				   ?>
                  </div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:64px;">
                 <?php
                  if(count($sub_modules) > 0)
				  {
				   foreach($sub_modules as $submodule)
				   {
				    if($submodule['url'] == "news/manageimages" or $submodule['url'] == "news/managedownloads")
					{
				     ?>   
                      <a href="<?php echo base_url().admin;?>/<?php echo $submodule['url'];?>/<?php echo $news['id'];?>" title="<?php echo $submodule['module_name'];?>"><?php echo $submodule['module_name'];?>&nbsp; | &nbsp;</a>
					 <?php
					}
				   }
				  }
				 ?><a href="<?php echo base_url().admin;?>/news/editnews/<?php echo $news['id'];?>" title="Edit">Edit</a>
                    
                    </div>
                    <div class="ulTableinner_record sn-no-other-record" style="width:60px;">
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
			 else
			 {
			  ?>
			   <div class="success"> No News found.</div>
			  <?php
			 }
		    ?>
           <div class="clearfix"></div>
          </div>
