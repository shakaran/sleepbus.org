<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class WebsiteJavascript
 {
  public $include_js;
  public $path;
  function __construct()
  {
   $this->path=base_url()."js/";
  }
  public function DefaultInclusion()
  {
   ?>
    <script type="text/javascript" src="<?=$this->path?>common.js"></script>
   <?php
  }
  public function HomepageJs()
  {
   ?>
	<script src="<?=$this->path?>jquery-1.3.2.min.js" type="text/javascript"></script>
	<script src="<?=$this->path?>jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="<?=$this->path?>jquery.timers-1.2.js" type="text/javascript"></script>
	<script src="<?=$this->path?>jquery.dualSlider.0.3.js" type="text/javascript"></script>
	<script type="text/javascript">
		
		$(document).ready(function() {
			
			$(".carousel").dualSlider({
				auto:true,
				autoDelay: 6000,
				easingCarousel: "swing",
				easingDetails: "easeOutBack",
				durationCarousel: 1000,
				durationDetails: 500,
			});
			
		});
		
		
	</script>
   <?php
  }
  public function ImageGalleryJs()
  {
   ?>
    <script type="text/javascript" src="<?=base_url()?>fancybox/scripts/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>fancybox/scripts/jquery.fancybox-1.2.1.js"></script>
    <script type="text/javascript" src="<?=$this->path?>gallery.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function() {
	$(".gallery a").fancybox();
    });
    </script>
   <?php
  }
  public function PopUpImageGalleryJs()
  {
   ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>fancybox/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="<?=$this->path?>popup-image-gallery.js"></script>
    <script type="text/javascript" src="<?=base_url()?>fancybox/js/jquery.chili-2.2.js"></script>    
   <?php
  }
  public function ContactUsJs()
  {
   ?>
	<script type='text/javascript' src='<?=$this->path?>jquery.min.js'></script>   
	<script type='text/javascript' src='<?=$this->path?>contactus_validation.js'></script>   
   <?php
  }
  public function NewsJs()
  {
   ?>
	<script type='text/javascript' src='<?=$this->path?>jquery.min.js'></script>   
    <script type='text/javascript' src='<?=$this->path?>news.js'></script>   
   <?php 
  }
  public function ReferenceJs()
  {
   ?>
	<script type='text/javascript' src='<?=$this->path?>jquery.min.js'></script>   
    <script type='text/javascript' src='<?=$this->path?>references.js'></script>   
   <?php 
  }
  public function ProductJs()
  {
   ?>
	<script type='text/javascript' src='<?=$this->path?>jquery.min.js'></script>   
    <script type='text/javascript' src='<?=$this->path?>products.js'></script>   
   <?php 
  }
  public function IncludeJsFiles()
  {
   $this->DefaultInclusion();
   if(count($this->include_js) > 0)
   {
    foreach($this->include_js as $list_func)
	{
	 $this->$list_func();
	}
   }
  }
 }
?>