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
       <?php
	   if($total_records > $ppr)
	   {
	    ?>
        <div class="col8">
        <?php
	   }
	   else
	   {
	    ?>
		 <div class="col6">
		<?php
	   }
        ?>
      <div id="display_news">
      <?php
        $this->load->view('display-news');
	  ?>
      
      </div>
      
      </div>
      
      
      
      <div class="clear">&nbsp;</div>
    </div>
  </div>
