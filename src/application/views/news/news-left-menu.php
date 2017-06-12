 <?php
 if(count($year_news) > 0)
 {
  ?>
  <ul class="leftnav newsborder">
   <li><a href="<?php echo base_url();?>news" <?php if(empty($year)){ ?> class="active" <?php } ?>>Recent</a></li>
   <?php
    foreach($year_news as $news)
    {
	 ?>
     <li><a href="<?php echo base_url();?>news/<?php echo $news['year'];?>" <?php if(isset($year) and $year ==$news['year'] ){ ?> class="active" <?php } ?>><?php echo $news['year'];?> News</a></li>
     <?php
	 if(isset($year) and $year == $news['year'])
	 {
	  foreach($all_months as $months)
	  {
	   ?>
       <ul>
	    <li><a href="<?php echo base_url();?>news/<?php echo $news['year'];?>/<?php echo strtolower($months['month']);?>" <?php if(isset($month) and $month == strtolower($months['month'])){ ?> class="active" <?php } ?>><?php echo $months['short_month_name']." ".$months['year'];?></a></li>
        </ul>
	   <?php
	  }
	 }
	}
	?>
   </ul>
  <?php
 }
 ?>
