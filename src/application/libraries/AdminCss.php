<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class AdminCss
 {
  public $including_css_func;
  public $path;
  
  function __construct()
  {
   $this->path=base_url()."style/".admin."/";
  }
  public function DefaultInclusion()
  {
   ?>
   <link href="<?=$this->path?>style.css" rel="stylesheet" type="text/css">
   <?php 
   $this->PrettyPhotoCss();
  }
  public function PrettyPhotoCss()
  {
   ?>
    <link href="<?=base_url()?>style/prettyPhoto.css" rel="stylesheet" type="text/css">
   <?php
  }
  public function CalendarCss()
  {
   ?>
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>plugins/jscalender/css/jscal2.css" />
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>plugins/jscalender/css/border-radius.css" />
	<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="<?=base_url()?>plugins/jscalender/css/win2k/win2k.css" />
	<link id="skin-steel" title="Steel" type="text/css" rel="alternate stylesheet" href="<?=base_url()?>plugins/jscalender/css/steel/steel.css" />
	<link id="skin-gold" title="Gold" type="text/css" rel="alternate stylesheet" href="<?=base_url()?>plugins/jscalender/css/gold/gold.css" />
	<link id="skin-matrix" title="Matrix" type="text/css" rel="alternate stylesheet" href="<?=base_url()?>plugins/jscalender/css/matrix/matrix.css" />
	<link id="skinhelper-compact" type="text/css" rel="alternate stylesheet" href="<?=base_url()?>plugins/jscalender/css/reduce-spacing.css" />
   
   <?php
  }
  public function FileUploaderCss()
  {
   ?>
	<link href="<?php echo base_url();?>js/<?php echo admin;?>/fileUploaderAPI/assets/css/style.css" rel="stylesheet" />
   
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