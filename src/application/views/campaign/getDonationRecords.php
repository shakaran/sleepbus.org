<?php
 foreach($donations as $donation)
 {
  ?>
  <div class="donationbox">
   <h2><sup>$</sup><?php echo $donation['paid_amount'];?></h2>
   <h3><?php if($donation['anonymous'] == "yes"){ echo "Anonymous";}else{ echo $donation['donor_name']; }?></h3>
   <p><?php echo $donation['time_ago'];?> ago</p>
   <h4><?php echo $donation['comment'];?></h4>
  </div>
 <?php
 }
?> 
<div class="donationheading2">
<div class="pagelink2">
<?php
		   if($pagination['previous_page'] > 0)
		   {
		    ?>
             <a onclick="getMoreRecords('<?php echo $pagination['previous_page'];?>','<?php echo $campaign_id;?>')" href="javascript:void(0)">  <img alt="" src="<?php echo base_url();?>images/arrowright2.png"></a>
            <?php
		   }
		   ?>
                      
                        </div>
<?php echo ($pagination['start_limit']+1);?>-<?php echo ($pagination['start_limit']+$pagination['end_limit']);?> <span>of</span> <?php echo $total_donations;?> <span>donations</span>
         <div class="pagelink">
           <?php
		   if($pagination['next_page'] > 0)
		   {
		    ?>
            <a href="javascript:void(0)" onclick="getMoreRecords('<?php echo $pagination['next_page'];?>','<?php echo $campaign_id;?>')">  <img src="<?php echo base_url();?>images/arrowleft2.png" alt=""></a>
            <?php
		   }
		   ?>
            </div></div>