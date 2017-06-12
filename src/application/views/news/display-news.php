       <?php
	   if($total_records > $ppr)
	   {
	    ?>
         <div class="pagetitle">
		  <div class="pagination">
		   <ul>
            <?php
			if($pagination['previous_page'] > 0)
			{
			 ?>
	         <li><a href="javascript:void(0)" onclick="SendNewsInfo('<?php echo base_url();?>','<?php echo $pagination['previous_page'];?>','<?php echo $ppr;?>','<?php echo $news_section?>','<?php echo $year?>','<?php echo $month?>')" class="prevnext"><img src="<?php echo base_url();?>images/prev-arrow.gif"alt="prev-arrow"></a></li>
             <?php
			}
			else
			{
			 ?>
	         <li><a href="javascript:void(0)" class="prevnext disablelink"><img src="<?php echo base_url();?>images/prev-arrow.gif" alt="prev-arrow"></a></li>
             <?php
			}
			
			for($i=1;$i<=$pagination['total_page'];$i++)
			{
             ?>
		     <li><a href="javascript:void(0)" onclick="SendNewsInfo('<?php echo base_url();?>','<?php echo $i;?>','<?php echo $ppr;?>','<?php echo $news_section?>','<?php echo $year?>','<?php echo $month?>')" <?php if($cp == $i){?> class="currentpage" <?php }?>><?php echo $i;?></a></li>
		     <?php
			}
			if($pagination['next_page'] > 0)
			{
             ?>
             <li><a href="javascript:void(0)" onclick="SendNewsInfo('<?php echo base_url();?>','<?php echo $pagination['next_page'];?>','<?php echo $ppr;?>','<?php echo $news_section?>','<?php echo $year?>','<?php echo $month?>')" class="prevnext"><img src="<?php echo base_url();?>images/next-arrow.gif" alt="next-arrow"></a></li>
		     <?php
			}
			else
			{
			 ?>
	         <li><a href="javascript:void(0)" class="prevnext disablelink"><img src="<?php echo base_url();?>images/next-arrow.gif" alt="next-arrow"></a></li>
             <?php
			}
            ?>
           </ul>
		  </div>        
         </div>
         <?php
	    }
		
		
		
		$total_news=count($all_news);
		if($total_news > 0)
		{
        ?>
         <div class="home-news">
         <?php
		 $j=0;
		 foreach($all_news as $news)
		 {
		  $j++;
		  if($total_news == $j)
		  {
		   ?>
           <div class="no_grid">
		   <?php
		  }
		  else
		  {
		   ?>
           <div class="grid">
		   <?php
		  }	 
		  ?>
           <h2 class="heading"><a href="<?php echo base_url();?>news/<?php echo $news['url'];?>"> <?php echo ucfirst($news['news_title']);?> </a></h2>
            <span class="newsdate"> <?php  echo $news['news_date'];?> </span>
            <p><?php echo $news['intro_text'];?></p>
            <p class="height2"><a href="<?php echo base_url();?>news/<?php echo $news['url'];?>" class="readmore readmorediv">more</a></p>
           </div>
		  <?php
		 }
		 ?>
         </div>
        <?php
		}
		
		
      
	   if($total_records > $ppr)
	   {
	    ?>
         <div class="pagetitle">
		  <div class="pagination">
		   <ul>
            <?php
			if($pagination['previous_page'] > 0)
			{
			 ?>
	         <li><a href="javascript:void(0)" onclick="SendNewsInfo('<?php echo base_url();?>','<?php echo $pagination['previous_page'];?>','<?php echo $ppr;?>','<?php echo $news_section?>','<?php echo $year?>','<?php echo $month?>')" class="prevnext"><img src="<?php echo base_url();?>images/prev-arrow.gif"alt="prev-arrow"></a></li>
             <?php
			}
			else
			{
			 ?>
	         <li><a href="javascript:void(0)" class="prevnext disablelink"><img src="<?php echo base_url();?>images/prev-arrow.gif" alt="prev-arrow"></a></li>
             <?php
			}
			
			for($i=1;$i<=$pagination['total_page'];$i++)
			{
             ?>
		     <li><a href="javascript:void(0)" onclick="SendNewsInfo('<?php echo base_url();?>','<?php echo $i;?>','<?php echo $ppr;?>','<?php echo $news_section?>','<?php echo $year?>','<?php echo $month?>')" <?php if($cp == $i){?> class="currentpage" <?php }?>><?php echo $i;?></a></li>
		     <?php
			}
			if($pagination['next_page'] > 0)
			{
             ?>
             <li><a href="javascript:void(0)" onclick="SendNewsInfo('<?php echo base_url();?>','<?php echo $pagination['next_page'];?>','<?php echo $ppr;?>','<?php echo $news_section?>','<?php echo $year?>','<?php echo $month?>')" class="prevnext"><img src="<?php echo base_url();?>images/next-arrow.gif" alt="next-arrow"></a></li>
		     <?php
			}
			else
			{
			 ?>
	         <li><a href="javascript:void(0)" class="prevnext disablelink"><img src="<?php echo base_url();?>images/next-arrow.gif" alt="next-arrow"></a></li>
             <?php
			}
			
            ?>
           </ul>
		  </div>        
         </div>
         <?php
	    }
		
		
