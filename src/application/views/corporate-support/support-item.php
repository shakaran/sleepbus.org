 <?php
 if(count($all_supports) > 0)
 {
 ?>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <?php
  foreach($all_supports as $support)
  {
   ?>
   <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 crcbox">
    <img src="<?php echo base_url();?>images/icon30.png" alt="">
    <?php echo $support['intro_text'];?>
    </div>
   <?php
  }
  ?>
  </div>
  <?php
 }
 ?>  