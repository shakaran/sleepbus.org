           <style>
		   .sn-no-other-record p{margin:0; padding:0;}
		   </style>

           <div style="padding-bottom:20px;padding-right:20px;">
            <div id="input_text">
            <div class="main_heading" style="padding:30px;font-weight:normal !important;">
             <?php
			 echo "Top Cta >> ".$submodule_details['module_name']." >> ";
			 echo $section_name;
             ?>
            </div>
			<div id="submenu" style="margin-left:40px;">
 			<?php
  			if(count($submenus) > 0)
  			{
   			 ?>
    		 <ul>
     		 <?php
	  		 foreach($submenus as $submenu)
	  		 {
	          ?>
	          <li><a title="<?php echo $submenu['name'];?>" href="<?php echo base_url().admin."/cta/".$submenu['url'];?>" <?php if($submenu['url'] == $section){ echo "class='active'";}?>><span><?php echo $submenu['name'];?></span></a></li>
	          <?php 
	         }
	         ?>
            </ul>
           <?php	   
          }
          ?>
          </div>
          <div style="padding:35px 0px 35px 0px;">
                      
            <?php					 
			if(count($all_pages) > 0)
			{
					   
		     ?>  
             <div class="clearfix">&nbsp;</div>   
             <div class="clearfix"></div>   
             <div class="ulTable">
            
             <ul>
            	<li>
                	<div class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div class="ulTableinner sn-no-other" style="width:150px;">Page Name</div>
                	<div class="ulTableinner sn-no-other" style="width:390px;">CTA Title</div>
                	<div class="ulTableinner sn-no-other" style="width:124px;">Tools</div>
                    
                </li>
                
                
            
            </ul>
            
             
           </div>
            <div class="clearfix"></div>
           
           
			
              <!-- ------ end ------------>
              <div class="ulTable_record" id="recordList">
              
              <ul>
			  <?php
			  $i=1;
			  foreach($all_pages as $page)
			  {
			   ?>
			    <li id="recordsArray_<?php echo $page['id'];?>" <?php if($page['id'] == '0'){ $i=""; ?> style="background-color:white;"<?php }?>>
                 <div class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $i;?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:150px;">
				 <?php echo $page['page_name']; if($page['id'] == '0'){ ?> <span style="color:#FF8000"><b>(Main Page)</b></span> <?php }?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:386px;padding:2px;"><?php if(!empty($page['cta']))
				 {
					 $k=0;
					 foreach($page['cta'] as $cta){
						 $k++;
					  if($k==2)
					  {
					   echo ", ".$cta['section_icon_name'];
					  }
					  elseif($k==3)
					  {
				  	   echo ", ".$cta['section_icon_name'];
					  }
					  else echo $cta['section_icon_name']; 
				 }
				 }else echo "&nbsp;";?></div>
                 
                 
                 <div class="ulTableinner_record sn-no-other-record" style="width:120px;">
                  <a href="javascript:void(0)" onclick="OpenCtaForm('<?php echo base_url()?>','<?php echo $page['id']?>','<?php echo $page_type;?>','<?php echo $section_name;?>','<?php echo $section;?>')" title="Edit" style="color: #884400;  text-decoration: none;"><span class="tools_icon"><?php echo img(base_url()."images/".admin."/icons/tools/edit.png");?></span>&nbsp;Edit</a>
                 </div>
                 <div class="clearfix"></div>
                </li>
			   <?php
			   $i++;
			  }
			  ?>
               </ul>
			  </div>
              
			                 
              <div class="clear"></div>
			   <?php
			 
			  
   		     }
			?>  
                     
             </div>        
            </div>
           </div>
