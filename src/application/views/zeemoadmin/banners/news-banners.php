            <div class="record_list">
             <?php
              echo form_open(base_url().admin.'/banners/news-banner',$drop_down_attributes['form']);
			 ?>
             <div style="color: #636466;font-family: Arial;font-size: 11px;font-weight: bold;text-align: left;padding-left:42px;padding-bottom:20px;">
             *Select News :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_dropdown('news_id',$drop_down_attributes['news_id'],$news_id,"class='select_action' style='width:285px;' id='news_id' onchange=SubmitManageImageForm('".base_url().admin."/banners/news-banner/'+this.value)");?>&nbsp;<span id="error1" class="error2"><?php echo form_error('news_id');?></span>
             </div>
             <?php
              if(!empty($news_id) or $news_id == '0')
			  {
			   ?>
			   <div align="left" style="padding-left:42px;">
			   <?php
			   $upload_banner_for="News >> ".$news_name;
			   $js_function="OpenBannerForm('".base_url()."','".$news_id."','news','dynamic')";
			   if(empty($banner_details['current_image']))
			   {
			    echo form_submit('add_image','Add Banner','onclick="'.$js_function.'"');
				?>
				 <div class="remarks" style="text-align:center"><b> Banner has not been added</b></div>
				<?php
			   }
			   else
			   {
			    echo form_submit('add_image','Update Banner','onclick="'.$js_function.'"');
				?>
                 <span style="padding-left:20px;">
                 <a href="<?php echo base_url().admin;?>/banners/ConfirmDelete/<?php echo $banner_details['banner_id'];?>/news_banner/<?php echo $news_id;?>&iframe=true&width=294&height=112" rel="prettyPhoto"  style="color: #884400;  text-decoration: none;" > <?php echo form_button('delete','Delete');?></a>
                 </span>   
				 <span style="padding-left:20px;">
                  <b>Status : </b> 
                  <?php 
                   if($banner_details['status'] == 0)
				   {
				    echo anchor(base_url().admin.'/banners/changestatus/'.$banner_details['banner_id'].'/1/news-banner/'.$news_id, 'Show',array('title'=>'Show','style'=>'color: #884400;'))." | <span class='success'><b>Hidden</b></span>";
				   }
				   elseif($banner_details['status'] == 1)
				   {
				    echo "<span class='success'><b>Shown</b></span> | ".anchor(base_url().admin.'/banners/changestatus/'.$banner_details['banner_id'].'/0/news-banner/'.$news_id, 'Hide',array('title'=>'Hide','style'=>'color: #884400;'));
				   }
                 ?>
                 </span>
                 <a href="javascript:void(0)" onclick="<?php echo $js_function;?>" style="text-decoration:none;">                   
 				 <div align="left" style="padding-top:20px;width:462px;">
                  <?php
				    echo img(base_url()."images/banners/".$banner_details['current_image']);?>
                    <div style="background-color:white;padding:10px 2px 10px 0px;color:#000">
                     <?php
                      echo $banner_details['details'];
					 ?>
                    </div>
                 </div>
                 </a>
				<?php
			   }
			   ?>
               </div>
               
			   <?php
			  }
			  else
			  {
			   ?>
			   <div class="success"> Please select news</div>
			   <?php
			  }
			  echo form_close();
		     ?>
           <div class="clearfix"></div>
          </div>
