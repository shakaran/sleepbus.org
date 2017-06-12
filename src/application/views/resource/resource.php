<!-- page title -->
<div class="page-title">
     <ul>
    <li><a href="<?php echo base_url();?>"> <img src="<?php echo base_url();?>images/home-icon1.png" width="13" height="13" /> </a></li>
    <li><span>  > </span> <?php echo $page_content['breadcrumb'];?>  </li>
  </ul>
   </div>
<!-- page title -->

<div class="middle-section"> <!--middle section -->
     
<h2> <?php echo $page_content['page_heading'];?> </h2>
 <div class="why-us">
  <?php
   echo $page_content['content'];
  ?>
 </div>
