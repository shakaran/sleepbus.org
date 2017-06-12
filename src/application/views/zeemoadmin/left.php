<div id="content">
 <div><img src="<?=base_url()?>images/<?=admin?>/lefttop-bg.png" alt="" title="" /></div>
    <div id="leftbox">
       <a href="<?php echo base_url().admin;?>/home" style="text-decoration:none;">
        	<div <?php if($active_module == "home"){?> class="leftbox_h1 active" <?php } else{ ?> class="leftbox_h1 bdrbot" <?php } ?> id="home_left_box"><img src="<?=base_url()?>images/<?=admin?>/cms-settings/left/home.png" border="0" align="left"/>Home</div>
        </a>
             <?php
			 
              if(count($modules) > 0)
			  {
			   foreach($modules as $module)
			   {
				?>
 		        <a href="<?php echo base_url().admin;?>/<?php echo $module['url'];?>" style="text-decoration:none;"  title="<?php echo $module['module_name'];?>">
      		     <?php
                 if($active_module == $module['module_url'])
				 {
				  ?>
                  <div class="leftbox_h1 active">
                  <?php
				 }
				 else
				 {
				  ?>
                  <div class="leftbox_h1 bdrbot">
                  <?php
				 }
				 ?>
                  <img src="<?php echo base_url();?>images/<?=admin?>/cms-settings/left/<?php echo $module['left_menu_icon'];?>" border="0" align="left" /><?php echo $module['module_name'];?>
                  
                 </div>
                </a>
				<?php   
				
				if(isset($module['sub_module']) and count($module['sub_module']) > 0)   
				{
				 if($active_module == $module['module_url'])
				 {
				  ?>
				   <div>
				  <?php
				 }
				 else
				 {
				  ?>
				  <div style="display:none;">
				  <?php
				 }
				 foreach($module['sub_module'] as $sub_module)
				 {
				  ?>
				  <a href="<?php echo base_url().admin;?>/<?php echo $sub_module['url'];?>" style="text-decoration:none;"  title="<?php echo $sub_module['name'];?>">
       			   <div id="leftbox_subtabs"><img src="<?=base_url()?>images/<?=admin?>/icons/tools/arrow.png" width="4" height="7" hspace="10" vspace="0" border="0" />
                   
                   <span class="<?php if($active_module."/".$active_submodule == $sub_module['url']){?> left_subitem_active<?php }else{ ?> left_subitem <?php }?>">
				    <?php echo $sub_module['name'];?>
                   </span>
                   </div>
       			  </a> 
				  <?php
				 }
				 ?>
				 </div>
				 <?php
				}
			   }  
			  }
			 
			 ?>
             
             <!--End Left Menu -->
                 	<a href="<?php echo base_url().admin;?>/logout" style="text-decoration:none;">
        	<div class="leftbox_h1 bdrbot"><img src="<?=base_url()?>images/<?=admin?>/cms-settings/left/logout.png" border="0" align="left" />Log out</div>
     	</a>
</div></div>
