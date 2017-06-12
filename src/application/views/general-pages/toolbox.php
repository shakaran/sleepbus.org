<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

  <div class="container">

    <div class="row">

       <div class="toolbox">

       <?php

         echo $top_text['content'];

		?>

       </div> 

        <?php

         echo $branding_content['content'];

		?>

       

       

       </div>

    </div>

  </div>

  

  
<?php if(!empty($video['content'])):?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 toolboxvideo" style="display:none;">

  <div class="container">

    <div class="row">

     <?php

     

	  echo $video['content'];

	 ?>

     

     </div>

    </div>

  </div>
<?php endif;?>
  



<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 timelinebox">

  <div class="container">

    <div class="row">

     <?php echo $facebook_timeline['content'];?>     

     </div>

    </div>

</div>



<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 toolboxvideo">

  <div class="container">

  <div class="twittercontainer">

    <div class="row">

     <?php

      echo $twitter_background['content'];

	 ?>     

     </div>

  </div>   

  </div>

</div>

    