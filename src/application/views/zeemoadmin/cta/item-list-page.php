           <style>
		   .sn-no-other-record p{margin:0; padding:0;}
		   </style>
           <div style="padding-bottom:20px;padding-right:20px;">
            <div id="input_text">
            <div class="main_heading" style="padding:30px 30px 0px 41px;font-weight:normal !important;">
             <?php
			 echo "CTA Display >> ".$submodule_details['module_name'];
			 if($page_type == "SINGLE_PAGE")
			 {
			  ?>
              <div class="success" style="text-align:left; padding:20px 0px 5px 0px; color:#4E4E4E">List of pages having single page content</div>
              <?php
			 }
             ?>
            </div>
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
                <div class="ulTableinner sn-no-other" style="width:250px;">Page Name</div>
                <div class="ulTableinner sn-no-other" style="width:290px;">CTA Title</div>
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
                 <div class="ulTableinner_record sn-no-other-record" style="width:250px;">
				 <?php echo $page['page_name']; if($page['id'] == '0'){ ?> <span style="color:#FF8000"><b>(Main Page)</b></span> <?php }?></div>
                 <div class="ulTableinner_record sn-no-other-record" style="width:286px;padding:2px;"><?php if(!empty($page['cta']))
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
