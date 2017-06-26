<!DOCTYPE html>
<html lang="en">
<head>
<?php if (ENVIRONMENT == 'production'): ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5FKJLK7');</script>
    <!-- End Google Tag Manager -->
<?php else: ?>
    <meta property="GTM_placeholder_head" content="wootwoot" />
<?php endif; ?>
	<meta property="og:title" content="Sleepbus.org" />
	<meta property="og:image" content="http://www.sleepbus.org/application/images/share-site-fb-image.jpeg"/>
	<meta property="og:description" 
  content="is a non profit organisation on a mission to end the need for people to sleep rough" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <?php
  if(isset($meta['page_title']) and !empty($meta['page_title']))
  {
    // quick fix lowercase sleepbus in title
    $title = str_replace('sleepbus', 'Sleepbus', $meta['page_title']);

   ?>	  
    <title><?php echo $title; ?></title>
   <?php
  } else {
 ?>
    <title>Sleepbus</title>
<?php
    }
?>
 <?php
  if(isset($meta['meta_description']) and !empty($meta['meta_description']))
  {
   ?>	  
   <meta name="description" content="<?php echo $meta['meta_description'];?>" />
   <?php
  }
  if(isset($meta['meta_keyword']) and !empty($meta['meta_keyword']))
  {
   ?>	  
   <meta name="keywords" content="<?php echo $meta['meta_keyword'];?>" />
   <?php
  }
  if(isset($meta['json_code']) and !empty($meta['json_code']))
  {
   ?>	  
   <?php echo $meta['json_code'];
  }   
  ?>
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <?php
  $this->websitecss->IncludeCssFiles();
  $this->websitejavascript->IncludeJsFiles();  
 ?>
<!--Grab the Stylesheets-->
</head>
<body class="loading">
<?php if (ENVIRONMENT == 'production'): ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FKJLK7"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<?php else: ?>
    <noscript><span id="GTM_placeholder_body"></span></noscript>
<?php endif; ?>
<?php
 $success_message=$this->session->flashdata('success_message');
 ?>
  <input type="hidden" name="success_message" id="success_message" value="<?php echo $success_message; ?>" /> 
  <input type="hidden" name="path" id="path" value="<?php echo base_url(); ?>" /> 
 <?php
 /*if(isset($top_message) and !empty($top_message))
 { 
  ?>
  <div class="toptext"><?php echo $top_message;?> <div class="topclose"><img src="<?php echo base_url();?>images/close.png" alt=""></div></div>
  <?php
 }*/
?>

<!-- Volunteers needed message -->
<!-- Note: you need to have no whitespace between .headerVolunteersNeeded and .headerVolunteersNeeded__container
     to preserve the vertical centering, hence the weird tag syntax -->
<div class="headerVolunteersNeeded"
  ><div class="headerVolunteersNeeded__simonIcon"></div
  ><div class="headerVolunteersNeeded__sleepBusIcon"></div
  ><div class="headerVolunteersNeeded__container">
    <div class="headerVolunteersNeeded__msg">Melbourne VOLUNTEERS required for various roles. Can you help?</div>
    <div class="headerVolunteersNeeded__details"><a href="/volunteer">Click here to join the volunteer database.</a></div>
  </div
></div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="header-band"> <!-- NOT SURE WRAPPER #1 -->

<div class="row positionrelative"> <!-- NOT SURE WRAPPER #2 -->

<div class="homeheader <?php if(empty($active_menu) || ($active_menu == "home")){?>  <?php }else{ ?> innerheader<?php } ?>">

<!-- MAIN HEADER: LOGO -->      
<div class="logo">
  <a href="<?php echo base_url();?>">
    <img src="<?php echo base_url();?>images/common-settings/<?php echo $common_settings['website_svg_logo'];?>" alt="Sleepbus" />
  </a>
</div>
  
<nav class="navbar navbar-default">

<!-- MAIN HEADER: MIDDLE MENU -->      
<ul class="nav navbar-nav">
  <li <?php if(($active_menu == "why-sleep")){?> class="active"<?php }?>><a href="<?php echo base_url();?>why-sleep">why sleep?</a></li>
  <li <?php if(($active_menu == "about-us" or $active_menu == "meet-the-board")){?> class="active"<?php }?>><a href="javascript:void(0)">about us</a>
    <ul>
      <li class="arrow3"><img src="<?php echo base_url();?>images/arrow3.png" alt=""></li>
      <li><a href="<?php echo base_url();?>about-us">Here's what we're about</a></li>
      <li><a href="<?php echo base_url();?>meet-the-board">Meet the board</a></li>
      <li><a href="<?php echo base_url();?>faq">Frequently asked questions</a></li>
      <li>&nbsp;</li>
    </ul>
  </li>
</ul>  


<!-- MAIN HEADER: RIGHT MENU -->      
<ul class="nav navbar-nav navright">
  <li <?php if(($active_menu == "donate") || ($active_menu == "corporate-supporters" )){?> class="active"<?php }?>><a href="<?php echo base_url();?>donate">donate</a>
    <ul>
      <li class="arrow3"> <img src="<?php echo base_url();?>images/arrow3.png" alt=""></li>
      <li><a href="<?php echo base_url();?>donate">Give once</a></li>
      <li><a href="<?php echo base_url();?>donate">Give monthly</a></li>
      <li><a href="<?php echo base_url();?>pledge">Pledge</a></li>
      <li><a href="<?php echo base_url();?>one-year-safe-sleep">Provide one year of safe sleeps</a></li>
      <li><a href="<?php echo base_url();?>corporate-supporters">Corporate support</a></li>
      <li>&nbsp;</li>
    </ul>
  </li>

  <li <?php if(($active_menu == "fundraise")){?> class="active"<?php }?>><a href="<?php echo base_url();?>fundraise">fundraise</a></li>
  <?php
  if(count($this->user_info) == 0)
{
?>
  <li <?php if(($active_menu == "signin")){?> class="active"<?php }?>><a href="<?php echo base_url();?>signin"><img src="<?php echo base_url();?>images/icon8.png" alt=""> sign in</a></li>
 <?php
}
else
{
 ?>
  <li class="myaccount"><a href="<?php echo base_url();?>user/home" <?php if($active_menu=="user-home"){?>class="active"<?php }?>>My Account</a>
    <ul>
      <li class="arrow3"><img alt="" src="<?php echo base_url();?>images/arrow3.png"></li>
      <li><a href="<?php echo base_url();?>user/profile" class="linkcolor">Profile settings</a></li>
      <li><a href="<?php echo base_url();?>logout" class="linkcolor">Log out</a></li>
      <li>&nbsp;</li>
    </ul>
  </li>
 <?php
}
 ?> 
</ul>

</nav>    
</div> <!-- END homeheader -->


<!-- MENU SHOWN TO MOBILE USERS -->
<div class="mobilemenu">

     <nav>

      <div class="navbg" id="top-menu-items">
       <?php if(count($this->user_info) == 0): ?>

      	 <div class="menusignup"><a href="<?php echo base_url();?>signin"><img src="<?php echo base_url();?>images/icon8.png" alt=""> Sign In</a> <a href="<?php echo base_url();?>signup">Sign up</a></div>

         <?php else: ?>

		 <div class="menusignup"><a href="<?php echo base_url();?>user/home"><img src="<?php echo base_url();?>images/icon8.png" alt=""> My Account</a> <a href="<?php echo base_url();?>logout">Log out</a></div>		 
      <?php endif; ?>

        <ul class="list-unstyled main-menu">
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li><a href="<?php echo base_url();?>donate">donate</a></li>
          <li><a href="<?php echo base_url();?>pledge">pledge</a></li>
          <li><a href="<?php echo base_url();?>fundraise">fundraise</a></li>
          <li><a href="<?php echo base_url();?>corporate-supporters">Corporate support</a></li>
          <li><a href="<?php echo base_url();?>why-sleep">why sleep?</a></li>
          <li><a href="<?php echo base_url();?>about-us">about us</a></li>
          <li><a href="<?php echo base_url();?>meet-the-board">meet the board </a></li>
          <li><a href="<?php echo base_url();?>sleepbus-toolbox">sleepbus toolbox</a></li>
          <li><a href="<?php echo base_url();?>in-the-media">In the media</a></li>
          <li><a href="<?php echo base_url();?>speaker-request">request a speaker</a></li>
          <li><a href="<?php echo base_url();?>connect">Connect</a></li>
        </ul>
      </div>

    </nav>

    <div class="navbar navbar-inverse navbar-fixed-top" id="menu-top-bar">
      <div class="navbar-header"> <a id="nav-expander" class="nav-expander fixed"> 
        <span class="menu-bar1 menu"></span> <span class="menu-bar2 menu"></span> <span class="menu-bar3 menu"></span> </a> 
      </div>
    </div>

 </div> <!-- END mobilemenu -->

    <?php
	 if(empty($active_menu) || ($active_menu == "home"))
	 {
	  $this->load->view('home/display-banner'); 
	 }
    ?>

  </div> <!-- END: NOT SURE WRAPPER #2 -->

</div> <!-- END: NOT SURE WRAPPER #1 -->

