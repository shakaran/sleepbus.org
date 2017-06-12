<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class AdminJavascript
 {
  public $include_admin_js;
  public $path;
  public $include_admin_footer_js;
  public function __construct()
  {
   $this->path=base_url()."js/".admin."/";
  }
  public function DefaultInclusion()
  {
   ?>
   <script language="javascript" type="text/javascript" src="<?=$this->path?>admin.js"></script>
   <script language="javascript" type="text/javascript" src="<?=$this->path?>common.js"></script>
   <?php 
   $this->JqueryInc();
   $this->PrettyPhotoJs();
   $this->UpdateRightLogoJs();
  }
  public function JqueryInc()
  {
   ?>
	<script src="http://www.google.com/jsapi" type="text/javascript"></script>
    <script type="text/javascript" charset="utf-8">
			google.load("jquery", "1.6.4");
    </script>
   <?php  
  }
  public function SuccessMessageJs()
  {
   ?>
    <script language="javascript" type="text/javascript" src="<?=$this->path?>success-message.js"></script>
   <?php 
  }
  public function DragDropJs()
  {
   ?>
	<script type="text/javascript" src="<?=$this->path?>jquery-ui-1.7.1.custom.min.js"></script>
    <script type="text/javascript" src="<?=$this->path?>drag-drop.js"></script>
   <?php
  }
  public function AddLevelJs()
  {
   ?>
	<script type="text/javascript" src="<?=$this->path?>user/add-level.js"></script>
   <?php
  }
  public function AddUserJs()
  {
   ?>
	<script type="text/javascript" src="<?=$this->path?>user/add-user.js"></script>
   <?php
  }
  
  public function CalendarJs()
  {
   ?>
   <script src="<?=base_url()?>plugins/jscalender/js/jscal2.js"></script>
   <script src="<?=base_url()?>plugins/jscalender/js/lang/en.js"></script>
   <?php 
  }
  public function PrettyPhotoJs()
  {
   ?>
	<script src="<?=$this->path?>jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
	 $("a[rel^='prettyPhoto']").prettyPhoto(
     {
       deeplinking: false
     });
	// for cancel button
	 $("#option2").click(function() 
     {
	  parent.$.prettyPhoto.close();
     });	
	});
    </script>
    
   <?php
  }
  public function PrettyPhotoGallaryJs()
  {
   ?>
	<script src="<?=$this->path?>jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
    
    
   <?php
  }
  
  public function UpdateRightLogoJs()
  {
	?>  
    <script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
      /*$("#logo_container").hover(function(){
		   $("#drop_box").fadeIn();
		  
		  })*/
      $("#drop_box").hover(function(){$("#link_container").fadeIn(100);},function(){$("#link_container").fadeOut(100);})
	});
    </script>
   <?php 
  }
  public function UpdateModuleJs()
  {
   ?>
    <script type="text/javascript" src="<?=$this->path?>module/update-module.js"></script>
   <?php
  }
  public function ValidateFaqFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>faq/faq-validation.js"></script>
   <?php   
  }  
  
  public function SuperAdminValidationJs()
  {
   ?>
    <script type="text/javascript" src="<?=$this->path?>superadmin-validation.js"></script>
   <?php
  }
  public function ValidateSuperAdminFormJs()
  {
   ?>
    <script type="text/javascript" src="<?=$this->path?>user/validate-superadmin-form.js"></script>
   <?php
  }
  
  public function ConfirmDeleteJs()
  {
   ?>
    <script type="text/javascript" src="<?=$this->path?>confirm-delete.js"></script>
   <?php
  }
  public function ValidateGeneralPagesFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>generalpages/generalpages-form-validation.js"></script>
   <?php
  }
  public function ValidateCommonSettingsFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>common-settings/setting-form-validation.js"></script>
   <?php
  }  
  public function ValidateBannersFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>banners/banner-form-validation.js"></script>
   <?php   
  }
  public function ValidateNewsFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>news/news-form-validation.js"></script>
   <?php   
  }
  public function ValidateBlogFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>blog/blog-validation.js"></script>
   <?php   
  }
  public function ValidateTestimonialsFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>testimonials/testimonials-validation.js"></script>
   <?php   
  }
  public function ValidateMetatagsFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>metatags/metatags-form-validation.js"></script>
   <?php   
  }
  public function ValidateDownloadsFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>downloads/download-form-validation.js"></script>
   <?php   
  }
  public function ValidateProductFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>product/product-validation.js"></script>
   <?php   
  }
  public function ValidateZeemoSettingsJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>zeemosettings/zeemo-settings-validation.js"></script>
   <?php   
  }
  public function ValidateCtaFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>cta/cta-form-validation.js"></script>
   <?php   
  }
  public function ValidateNotificationFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>notification/email-notification-validation.js"></script>
   <?php
  }  
  public function UploaderFileFooterJs()
  {
   ?>
   <script language="javascript" type="text/javascript" src="<?=$this->path?>admin.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="<?=$this->path?>fileUploaderAPI/assets/js/jquery.knob.js"></script>

		<!-- jQuery File Upload Dependencies -->
	<script src="<?=$this->path?>fileUploaderAPI/assets/js/jquery.ui.widget.js"></script>
	<script src="<?=$this->path?>fileUploaderAPI/assets/js/jquery.iframe-transport.js"></script>
	<script src="<?=$this->path?>fileUploaderAPI/assets/js/jquery.fileupload.js"></script>
		
		<!-- Our main JS file -->
	<script src="<?=$this->path?>fileUploaderAPI/assets/js/script.js"></script>
   <?php
  }
  public function ValidateAboutFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>about/about-form-validation.js"></script>
   <?php   
  }
  
  public function ValidateLandingFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>landingpages/landingpages-validation.js"></script>
   <?php   
  }
  public function ValidateProjectFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>projects/project-validation.js"></script>
   <?php   
  }
  public function ValidateSupportFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>supports/support-validation.js"></script>
   <?php   
  }
  public function ValidateMediaFormJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>media/media-form-validation.js"></script>
   <?php   
  }
  public function ValidateAccountJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>account/form-validation.js"></script>
   <?php   
  }
  public function ValidateCampaignJs()
  {
   ?>
   <script type="text/javascript" src="<?=$this->path?>campaign/form-validation.js"></script>
   <?php   
  }
  public function IncludeFooterJsFiles()
  {
   //$this->DefaultInclusion();
   if(count($this->include_admin_footer_js) > 0)
   {
    foreach($this->include_admin_footer_js as $list_func)
	{
	 $this->$list_func();
	}
   }
  }
  
  public function IncludeJsFiles()
  {
   $this->DefaultInclusion();
   if(count($this->include_admin_js) > 0)
   {
    foreach($this->include_admin_js as $list_func)
	{
	 $this->$list_func();
	}
   }
  }
 }
?>