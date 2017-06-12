<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="container">
    <div class="row">
       <div class="funding">
       <h1><?php echo $project_details['project_title'];?></h1> 
       </div>
       </div>
    </div>
  </div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="container">
  
  <?php
  if(count($project_images) > 0)
  {
   ?>
   <div class="row">
    <div class="projectslider">
    <div data-ride="carousel" class="carousel slide" id="myCarousel">  
     <div class="carousel-inner">                     
      <?php
	   $i=0; 
       foreach($project_images as $image)
	   {
		$i++;   
	    ?>
		<div class="item <?php if($i == 1){ ?>active<?php }?>"><img title="<?php echo $image['image_alt_title_text']?>" alt="<?php echo $image['image_alt_title_text']?>" src="<?php echo base_url();?>images/projects/<?php echo $image['image_file']?>">
        </div>
		<?php
	   }
	   ?>
    
     </div>	
     <?php
	 if(count($project_images) > 1)
	 {
	  ?>
	    
      <a data-slide="prev" href="#myCarousel" class="carousel-control left"> <span class="glyphicon glyphicon-chevron-left"></span> </a> <a data-slide="next" href="#myCarousel" class="carousel-control right"> <span class="glyphicon glyphicon-chevron-right"></span> </a> 
      <?php
	 }
	  ?>
     </div>
   </div>  
  
   
    </div>
   <?php
  }
  ?>
   
    <?php
	 $details=str_replace("[[BACK_URL]]",base_url().'completed-projects',$project_details['description']);
     echo $details;
	?>
  </div>
 </div>