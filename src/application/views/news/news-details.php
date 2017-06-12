<div class="col1"> 
    <!-- left panel -->
    <div class="leftpanel">
      <h2><?php echo $page_heading['0']['page_heading'];?></h2>
      <?php
       $this->load->view('news-left-menu');
	  ?>
    </div>
    <!-- end left part --> 
    <!-- right part -->
    <div class="col2">
      <div class="pagetitle">
        <h1><?php echo $page_heading['0']['page_heading'];?></h1>
        
      </div>
      <div class="col6">
        <div class="home-news">
          <div class="no_grid">
            <h2 class="heading"><?php echo ucfirst($news_details['news_title']);?></h2>
            <span class="newsdate"><?php  echo $news_details['news_date'];?></span>
            <?php  echo $news_details['description'];
			$back_url=base_url()."news";
			if($news_section == "monthly")
			{
			 $back_url.="/".$year."/".$month;
			}
			elseif($news_section == "yearly")
			{
			 $back_url.="/".$year;
			}
			?>
            <div style="padding-top:10px;">
            <a href="<?php echo $back_url;?>" class="f_left backbtn">Back</a>
            </div>
            <div class="clearfix">&nbsp;</div>
            
          </div>
        </div>
        
        
         <?php
		 if(count($brochures) > 0)
		 {
		  ?>
		  <div class="builders">
           <?php
		    foreach($brochures as $brochure)
			{
			 ?>
             <div class="infosheet"><a href="javascript:void(0)" onclick="downloads('<?php echo base_url();?>news/','<?php echo $brochure['id'];?>')"><?php echo ucfirst($brochure['brochure_title']);?></a></div>
			 <?php
			}
		   ?>
          </div> 
		  <?php
		 }
  	    if($total_records > 0)
	    {
		 ?>
         <div id="image_gallery"> 
         <?php $this->load->view('display-image-gallery');?>
         </div>
         <?php
	    }
	    ?>        
      
      
      
       </div>
      <div class="clear">&nbsp;</div>
    </div>
  </div>