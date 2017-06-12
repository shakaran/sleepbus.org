<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class WebsiteJavascript
 {
  public $include_js;
  public $include_footer_js;
  public $path;
  function __construct()
  {
   $this->path=base_url()."js/";
  }
  public function DefaultInclusion()
  {
   ?>
<?php /*?>    <script type="text/javascript" src="<?=$this->path?>commonJs/common.js"></script>
<?php */?>   <?php
  }
  public function HomepageJs()
  {
   ?>
   <?php
  }
  public function ContactUsJs()
  {
   ?>
	<script type='text/javascript' src='<?=$this->path?>connect-validation.js'></script>   
   <?php
  }
  public function SpeakerRequestJs()
  {
   ?>
	<script type='text/javascript' src='<?=$this->path?>speaker-request-validation.js'></script>   
   <?php
  }
  public function PlaceholderInitialize()
  {
   ?>	
    <!-- jquery must be included, in not included then remove comment from line below with using php path variable-->  
    <!--<script src=" $this->path commonJs/jquery.js"></script>--> 
    <script src="<?=$this->path?>commonJs/placeholder.js"></script>
    <script>
	

	if(!Placeholer_field.input.placeholder){

	$('[placeholder]').focus(function() {
	  var input = $(this);
	  if (input.val() == input.attr('placeholder')) {
		input.val('');
		input.removeClass('placeholder');
	  }
	}).blur(function() {
	  var input = $(this);
	  if (input.val() == '' || input.val() == input.attr('placeholder')) {
		input.addClass('placeholder');
		input.val(input.attr('placeholder'));
	  }
	}).blur();
   }

   
   </script>
   <?php
  }
  public function GoogleMapJs()
  {
   ?>
   <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDuLLKAxZvZD2vFZBe7q0GWtsk88lAYm3s&amp;sensor=false">
  </script>   
   <script type='text/javascript' src='<?=$this->path?>google-map.js'></script>    
   <?php
  }
  public function DefaultFooterInclusionJs()
  {
   ?>
   <script src="<?=$this->path?>jquery-1.9.1.min.js"  type="text/javascript"></script>    
    <script src="<?=$this->path?>bootstrap.js" type="text/javascript"></script> 
    <script src="<?=$this->path?>commonJs/common.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
   <script src="<?=$this->path?>scroll-header-dismiss.js"></script>
   <script type="text/javascript">
    $(document).ready(function(){											
       
		 $("#getlocation").click(function(e){
        var header_height=$("div.logo").height()+20;	 
        $('html, body').animate({scrollTop: $("#map").offset().top-header_height}, 600); 
	   });       
       //Navigation Menu Slider
	   hideMenuItem();
        $('#nav-expander').on('click',function(e){
      		e.preventDefault();
      		$('body').toggleClass('nav-expanded');
			
			 if($('body').hasClass('nav-expanded'))
			 {
			  showMenuItem();
			  $(".homeheader").addClass('innerheader')
			 }
			 else
			 {
		      hideMenuItem();	
			  $(".homeheader").removeClass('innerheader')	 	 
			 }
			 
			
      	});
      	$('#nav-close').on('click',function(e){
      		e.preventDefault();
      		$('body').removeClass('nav-expanded');
			hideMenuItem();
      	});
		
// Code for hide menu item when clicking on out side the menu
		$(document).click(function(e) {
		if ((e.which == 1) && (e.target.id != 'menu-top-bar' && !$('#menu-top-bar').find(e.target).length) && (e.target.id != 'top-menu-items' && !$('#top-menu-items').find(e.target).length))
        {
         $('body').removeClass('nav-expanded');
      	 $('#menuitem').removeClass('side-navigation');
		 // return false;
		 hideMenuItem();
        }
		});
		// -------------// End Code for hide menu item when clicking on out side the menu		
		// For Ipad and Mobile device
		$(document).bind( "touchend", function(e){
			//alert(e.target.id);
	  if ((e.target.id != 'menu-top-bar' && !$('#menu-top-bar').find(e.target).length) && (e.target.id != 'top-menu-items' && !$('#top-menu-items').find(e.target).length))
        { 
		 $('body').removeClass('nav-expanded');
      	 $('#menuitem').removeClass('side-navigation');
		 hideMenuItem();
		}
		});
      });

function showMenuItem()
{
 var unit_sec=15;
 var time_interval=11*unit_sec; 
 l=0;
 $("ul.list-unstyled").find('li >a').each(function(k,d)
 {
  l++;
  var time_starter=unit_sec*l;
  $(this).delay(60*l).fadeIn(time_starter,"linear");
  l++;
 });
      	
}
function hideMenuItem()
{
 $("ul.list-unstyled").find('li >a').each(function(k,d)
 {
  if(k > 0)
  {   
   $(this).hide();
  }
 })
}	  
	
$('.SeeMore2').click(function(){
		var $this = $(this);
		$this.toggleClass('SeeMore2');
		if($this.hasClass('SeeMore2')){
			$this.text('Read More');			
		} else {
			$this.text('Collapse');
		}
	});	  	  
 </script>
   <?php
   $this->PlaceholderInitialize();
  }
  public function MediaFooterJs()
  {
   ?>
   <script src="<?=$this->path?>inthemedia.js"></script>
   <?php
  }  
  public function AccountSignUpJs()
  {
   ?>
   <script src="<?=$this->path?>account/signup.js"></script>
   <?php
  }  
  public function AccountSignInJs()
  {
   ?>
   <script src="<?=$this->path?>account/signin.js"></script>
   <?php
  }  
  public function UserProfileJs()
  {
   ?>
   <script src="<?=$this->path?>user/profile.js"></script>
   <?php
  }  
  public function SuccessMessageJs()
  {
   ?>
   <script src="<?=$this->path?>success-message.js"></script>
   <?php
  }  
  public function PledgeJs()
  {
   ?>
   <script src="<?=$this->path?>pledge/pledge-validation.js"></script>
   <?php
  }  
  public function FundraiseJs()
  {
   ?>
   <script src="<?=$this->path?>fundraise/fundraise-validation.js"></script>
   <?php
  }  
  public function UpdateFundraiseJs()
  {
   ?>
   <script src="<?=$this->path?>fundraise/edit-fundraise.js"></script>
   <?php
  }  
  public function DonationJs()
  {
   ?>
   <script src="<?=$this->path?>donation/donation.js"></script>
   <?php
  }  
  public function DonationProcessJs()
  {
   ?>
   <script src="<?=$this->path?>donation/donation-process.js"></script>
   <?php
  }  
  public function CampaignJs()
  {
   ?>
   <script src="<?=$this->path?>campaign/campaign.js"></script>
   <?php
  }  
  public function RecurringDonationJs()
  {
   ?>
   <script src="<?=$this->path?>recurring/monthly-validation.js"></script>
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
  public function IncludeFooterJsFiles()
  {
   $this->DefaultFooterInclusionJs();
   if(count($this->include_footer_js) > 0)
   {
    foreach($this->include_footer_js as $list_func)
	{
	 $this->$list_func();
	}
   }
  }
 }
?>
