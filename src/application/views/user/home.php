<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 profilemain">

   <div class="container">

   <h1><span class="h1arrow"><img src="<?php echo base_url();?>images/h1arrow.png" alt=""> </span>Welcome, <?php echo $user_info['full_name'];?></h1>

    <div class="row">

      <?php

       $this->load->view('user/left-menu');

	  ?>

      <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 profileright">

       <div class="signedupright">

         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 signeduprightbox1">

             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 signeduprightbox1left"> <?php echo count($user_campaigns)?> Active campaign(s)</div>

             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 signeduprightbox1right"> <a href="<?php echo base_url();?>fundraise">start a campaign</a></div>

         </div>

         

         <?php

         if(count($user_campaigns) > 0)

		 {

		  foreach($user_campaigns as $campaign)

		  {

		   ?>

		   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 signeduprightbox2">

             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 signeduprightbox2left">

             <a href="<?php echo '/campaign/' . $campaign['url']; ?>">

             <?php if($campaign['campaign_type'] == 1){?> <img src="<?php echo base_url();?>images/icon29.png" alt=""> <?php }else{?> <img src="<?php echo base_url();?>images/icon28.png" alt=""> <?php }?>
               <div class="viewcampaign">View Campaign</div> 
             </a>

               </div>

             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 signeduprightbox2mid">

             <h2>$<?php if($campaign['amount']['raised_amount'] > 0) echo $campaign['amount']['raised_amount']; else echo "0";?> Raised</h2>

             <p><?php echo $campaign['campaign_name'];?></p>

             </div>

             

             <?php

             if($campaign['status'] == '1')

			 {

			  ?>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 signeduprightbox2right">

               <a href="<?php echo base_url();?>donation/<?php echo $campaign['url'];?>">donate</a></div>

              <?php

			 }

			 else

			 {

			  ?>

			  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 signeduprightbox2right2"> closed

			  <?php

			 }

			 ?>

             </div>

		   <?php

		  }

		 }

		 

		 ?>

       </div> 

      </div>

    </div>  

   </div>

</div>
