<div class="campaignbox positionrelative"  style="background:url(<?php echo base_url();?>images/campaign/<?php if(!empty($campaign_details['image_file'])){ echo $campaign_details['image_file']; }else{ echo $campaign_settings['common_banner']; } ?>) no-repeat center top;">
  <div class="container">
  <div class="campaignboxin">
  
  <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12 campaignimgboxleft">
  <?php
  if($campaign_details['campaign_type'] == 1)
  {
   ?>
   <img src="<?php echo base_url();?>images/birth-icon33.png" alt="">
   <?php
  }
  else
  {
   ?>
   <img src="<?php echo base_url();?>images/icon33.png" alt="">
   <?php
  }
   ?>
  </div>
  
  <div class="col-lg-11 col-md-11 col-sm-10 col-xs-12">
   <h1><?php echo $campaign_details['campaign_name'];?></h1>
   <p><?php echo $campaign_details['user_full_name'];?></p>
   
   <?php
   
   if($campaign_details['status'] == '1')
   {
   ?>
   <div class="campaignbutton">
    <a class="btn btn-primary" href="<?php echo base_url();?>donation/<?php echo $campaign_details['url'];?>">Donate</a>  <a class="btn btn-info" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo base_url().$campaign_details['url'];?>">    
    <img alt="" src="<?php echo base_url();?>images/fb4.png"></a>
     <a class="btn btn-warning" target="_blank" href="http://twitter.com/share?url=<?php echo base_url().$campaign_details['url'];?>&amp;text=Simple Share Buttons"><img alt="" src="<?php echo base_url();?>images/twitter4.png"></a>
    <?php
	 if($loggedin_user == $campaign_details['username'])
	 {
	  ?>
      <a class="btn btn-primary btn-pledge" href="<?php echo base_url();?>fundraise/<?php echo $campaign_details['url'];?>">edit campaign</a>
      <?php
	 }
	 ?> 
      </div>
    <?php
	}
	else
	{
     ?>
	 <div class="campaignbutton">&nbsp;</div>
	 <?php
	}
	

   ?>   
      
  </div> 
  </div>
  </div>

</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="container">
   <div class="row campaignbody">
     <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12 campaignleft">
      <div class="row">
      	<div class="raisedbox">
             <div class="raisedtext">
								$<?php if($campaign_details['total_raise'] > 0){ $raisedamount = number_format(($campaign_details['total_raise']),2); echo 
	             $raisedamount;}else{?>0<?php }?><sub>Raised</sub></div> 
         <p><img src="<?php echo base_url();?>images/user.png" alt=""><?php if($campaign_details['total_raise'] > 0){ echo floor($campaign_details['total_raise']/27.50);}else{?>0<?php }?> people will get a safe night’s sleep</p>
             <?php
              if($campaign_details['status'] == '1')
			  {
			   ?>
               <p><img src="<?php echo base_url();?>images/timer.png" alt=""><?php if($campaign_details['days_left'] > 0){$day='days';}else $day='days'; echo $campaign_details['days_left'].' '.$day;?>  left to donate</p>
               <?php
			  }
			  else
			  {
			   ?>
			  <p><strong>Closed</strong></p>
               <?php
			  }
			  if($campaign_details['total_raise'] > 0){ $total_percentage=number_format((($campaign_details['total_raise']*100)/$campaign_details['campaign_goal']),2);}else{$total_percentage=0;}
			  ?>
             <div class="priceboxmain">
             <div class="priceboxin">
             	<div class="priceboxtextleft"><?php if($total_percentage > 100){ $total_percentage=100;} echo $total_percentage;?>%</div>
                <div class="priceboxtextright">$<?php echo $campaign_details['campaign_goal'];?></div>
             	<div class="priceboxcolor" style="width:<?php echo $total_percentage;?>%;"></div>	
             </div>
             
            </div>
            <?php
              if($campaign_details['status'] == '1')
			  {
			   ?>
                <a href="<?php echo base_url();?>donation/<?php echo $campaign_details['url'];?>" class="btn btn-primary">Donate</a>
               <?php
			  }
			  else ?> <a href="#">&nbsp;</a> <?php
			  
			  ?>  
        </div>
         <div class="raisedimgbox" id="startoflist"><img src="<?php echo base_url();?>images/campaign/<?php echo $campaign_settings['campaign_logo']; ?>" alt="100% Public Donation Fund SleepBus Projects"></div>
         
        <?php
        if(isset($total_donations) and ($total_donations > 0))
		{
		 ?> 
         <div class="raisedbox2">
           <div class="donationheading"><span><?php echo $total_donations;?> Donation(s)</span> <bdo>Recent</bdo></div>
           <div id="donation-list">
           <?php
		   $this->load->view('campaign/getDonationRecords');
		   ?>  
         </div>
       
       
        </div>
       <?php
       }
	  ?>
      
      
      </div>
     </div>
     <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12 campaignright">
     <?php
      echo nl2br($campaign_details['mission_statement']);
	  
	  ?>
	  
	  <?php

	 if($loggedin_user == $campaign_details['username'])
	 {
	  
      ?>      
      <h2>Copy and share this URL with your friends to raise funds for sleepbus</h2>
       <div class="shareurl"><?php echo base_url().$attributes['share_url'];?></div>
	   
	   <?php
	   
	  if(count($campaign_comments) > 0)
	  {	 
	   ?>
       <h2>Your Comment(s)</h2>
       <?php
       foreach($campaign_comments as $comment)
	   {
	    ?>
	    <p><?php echo nl2br($comment['comments']);?></p>
        <div><a href="<?php echo base_url();?>campaign/deletecomment/<?php echo $attributes['share_url']."/".$comment['id'];?>">Delete</a></span></div>	 
	    <?php
	   }
	  }
	   
      echo form_open(base_url().$campaign_details['url'],$attributes['form']);
      echo form_hidden('caller','Send');
     ?>     
     <h2>Update and comments</h2>
       <?php echo form_textarea($attributes['comments']);?>
       <div class="campaigncheckbox">
       <?php echo form_checkbox($attributes['email_to_donors']);?>
       <label for="email_to_donors"><span></span>email this update to your donors</label> 
       
       <?php echo form_submit($attributes['submit']);?>
       </div>
       
      <?php
       echo form_close();
	   
	 }
	 else
	 {
	  if(count($campaign_comments) > 0)
	  {	 
	   ?>
       <h2>Comments by <?php echo $campaign_details['user_full_name'];?></h2>
       <?php
       foreach($campaign_comments as $comment)
	   {
	    ?>
	    <p><?php echo nl2br($comment['comments']);?></p>
	    <?php
	   }
	  }
	 }
		 
	 ?>   

     </div>
    </div>
  </div>
</div>
