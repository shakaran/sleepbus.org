     <?php

      echo $blog_details['banner_image_text'];

	 ?>







<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

  <div class="container">

   <div class="row blogdetailin">

    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">

    <div class="blogdetailleft">

    <div class="row">

    <div class="blogdate"><?php echo $blog_details['real_date'];?>, Posted by <?php echo $blog_details['blogger'];?></div>

     <?php

      echo $blog_details['description'];

	 ?>

   </div>

    </div>

    </div>

    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">

    <div class="blogdetailright">

    <div class="row">

       <?php

        if(count($right_blogs) > 1)

		{

	     foreach($right_blogs as $blog)

		 {

		  if($blog['id'] != $blog_details['id'])

		  {	 

		   ?>

		   <div class="blogrighttext">

            <div class="blogdate2"><?php echo $blog['blog_date'];?></div>

            <p><?php $string = character_limiter($blog['blog_title'], 35); echo $string ;?></p>

<p><a href="<?php echo base_url()."blog/".$blog['cat_url']."/".$blog['url'];?>">Read more </a></p>

           </div>

		   <?php

		  }

		 }

		}

	   ?>

       </div> 

    </div>

    </div>

  </div>

   <div class="blogsharebox"><a href="<?php echo base_url();?>blog/<?php echo $cat_url;?>" class="btn btn-primary">see more blogs</a> <a href="http://www.facebook.com/sharer.php?u=<?php echo base_url();?>blog/<?php echo $cat_url;?>/<?php echo $blog_url; ?>" target="_blank" class="btn btn-primary btn-facebook"><img src="<?php echo base_url();?>images/fb3.png" alt=""> share it!</a> <a href="http://twitter.com/share?url=<?php echo base_url();?>blog/<?php echo $cat_url;?>/<?php echo $blog_url; ?>&text=" target="_blank" class="btn btn-info"><img src="<?php echo base_url();?>images/twitter2.png" alt="">share it!</a></div>

   <div class="backtoblog">&#60; <a href="<?php echo base_url();?>blog">Back to blogs</a></div>

  </div>

</div> 

 
