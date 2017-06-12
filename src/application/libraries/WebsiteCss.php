<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class WebsiteCss
 {
  public $including_css_func;
  public $path;
  function __construct()
  {
   $this->path=base_url()."style/";
  }
  public function DefaultInclusion()
  {
   ?>
   <link href="<?php echo $this->path;?>bootstrap.css" type="text/css" rel="stylesheet" />
   <?php 
  }
  public function IncludeCssFiles()
  {
   $this->DefaultInclusion();
   if(count($this->including_css_func) > 0)
   {
    foreach($this->including_css_func as $list_func)
	{
	 $this->$list_func();
	}
   }
  }  
 }
?>