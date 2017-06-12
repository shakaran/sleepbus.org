<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><div id="setInnerHeight">
    
        <table width="1000" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td width="40" valign="top">
             <!-- Left Menu -->
              <?php
               $this->load->view(admin.'/left');
			  ?>
            </td>
            <td align="center" valign="top">
            <div class="homesection">
            <?php
             if(count($modules) > 0)
			 {
			  $i=0;
			  foreach($modules as $module)
			  {
			   if($i%3==0 and $i != 0)
			   echo '<div class="spacerbot"></div>';
			   else if($i != 0)
			   echo '<div class="spacercat"></div>';
			   $i++;
			   ?>
			   <div class="Tabssection">
               <a href="<?php echo base_url().admin;?>/<?php echo $module['url'];?>" style="text-decoration:none;">
			    <div class="main-icons"><img src="<?php echo base_url();?>images/<?php echo admin;?>/cms-settings/home/<?php echo $module['home_page_icon'];?>" alt="<?php echo $module['module_name'];?>" title="<?php echo $module['module_name'];?>">
                </div>
  			    <div class="commonTabs"><h2 class="span_cms"><?php echo $module['module_name'];?></h2>
                <?php
                 if(isset($module['sub_module']) and count($module['sub_module']) > 0)
				 {
				  ?>
				  <ul>
				  <?php
				  foreach($module['sub_module'] as $sub_module)
				  {
				   ?>
				    <li><a href="<?php echo base_url().admin;?>/<?php echo $sub_module['url']?>" title="<?php echo $sub_module['name'];?>"><?php echo $sub_module['name'];?></a></li>
				   <?php
				  }
				  ?>
				  </ul>
				  <?php
				 }
				?>
  		        </div>
               </a>
               </div>
                
			   <?php
			   }
			  }
			 ?>    
				 
            <div class="clear"></div>
            </div>
            </td>
          </tr>
        </table>
      </div></td>
  </tr>
</table>
<div class="clear"></div>
<br />