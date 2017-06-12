<div id="div_top_cms">
 <div id="menu">
 <?php
  if(count($sub_modules) > 0)
  {
   ?>
    <ul>
     <?php
	  foreach($sub_modules as $sub_module)
	  {
	   ?>
	    <li><a title="<?php echo $sub_module['module_name'];?>" href="<?php echo base_url().admin."/".$sub_module['url'];?>" <?php if($sub_module['url'] == $active_module."/".$active_submodule){ echo "class='active'";}?>><span><?php echo $sub_module['module_name'];?></span></a></li>
	   <?php 
	  }
	 ?>
    </ul>
   <?php	   
  }
 ?>
 </div>
</div>


        


