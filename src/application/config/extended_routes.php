<?php
//echo "<pre>"; print_r($_SERVER); exit;
 if(isset($_SERVER['REQUEST_URI']))
 {
  $requested_url=str_replace("/","",$_SERVER['REQUEST_URI']);
  $pattern = '/^([a-zA-Z0-9_.-]|[\s]|[\?])+$/';
  if((preg_match($pattern,$requested_url)))
  {
   switch($requested_url)
   {
    case  "connect-thanks" : $route['connect-thanks']="thanks/connect-thanks";	break;
    case  "completed-projects" : $route['completed-projects']="projects";	break;
    case  "corporate-supporters" : $route['corporate-supporters']="support";	break;
    case  "blog" : $route['blog']="blog/blog_list";	break;
    case  "about-us" : $route['about-us']="generalpages/about-us";	break;
    case  "faq" : $route['faq']="generalpages/faq";	break;
    case  "testnewheader" : $route['testnewheader']="testnewheader";	break;
    case  "why-sleep" : $route['why-sleep']="generalpages/why-sleep";	break;
    case  "speaker-request" : $route['speaker-request']="speaker/request";	break;
    case  "speaker-request-thanks" : $route['speaker-request-thanks']="thanks/speaker-request-thanks";	break;
    case  "connect" : $route['connect']="connect";	break;
    case  "enewsletter-thanks" : $route['enewsletter-thanks']="thanks/enewsletter-thanks";	break;
    case  "enewsletter-signup" : $route['enewsletter-signup']="enewsletter";	break;
    case  "sitemap" : $route['sitemap']="generalpages/sitemap";	break;
    case  "privacy-policy" : $route['privacy-policy']="generalpages/privacy-policy";	break;
    case  "meet-the-board" : $route['meet-the-board']="generalpages/meet-the-board";	break;
    case  "in-the-media" : $route['in-the-media']="generalpages/media";	break;
    case  "sleepbus-toolbox" : $route['sleepbus-toolbox']="generalpages/toolbox";	break;
    case  "simon-story" : $route['simon-story']="generalpages/simon-story";	break;
    case  "signin" : $route['signin']="account/signin";	break;
    case  "signup" : $route['signup']="account/signup";	break;
    case  "forgot-password" : $route['forgot-password']="account/forgot-password";	break;
    case  "forgot-password-thanks" : $route['forgot-password-thanks']="thanks/forgot-password-thanks";	break;
    case  "reset-password-thanks" : $route['reset-password-thanks']="thanks/reset-password-thanks";	break;
    case  "donate" : $route['donate']="donation/donate";	break;
    case  "one-year-safe-sleep" : $route['one-year-safe-sleep']="donation/one-year-safe-sleep";	break;

    default:
    {
     $route['reset-password/(:any)']="account/reset-password/$1";

    $route['campaign/(:any)'] = "campaign/show/$1";

    /*
        redirect campaigns prior to /campaign/{URL} route
        campaigns which are no longer needed will be removed
        once analytics is in production, those with no incoming
        direct traffic can also have their redirections removed
        so this should end up only a few rules. as such, keeping
        them here in routes is simpler than adding to server config
     */
    $route['simon-s-birthday'] = 'campaign/show/simon-s-birthday';
    $route['anne-s-test-campaign'] = 'campaign/show/anne-s-test-campaign';
    $route['ethan-s-birthday'] = 'campaign/show/ethan-s-birthday';
    $route['ethan-s-birthday-1'] = 'campaign/show/ethan-s-birthday-1';
    $route['anne-is-cool'] = 'campaign/show/anne-is-cool';
    $route['annie-test-2'] = 'campaign/show/annie-test-2';
    $route['annie-does-white-castle'] = 'campaign/show/annie-does-white-castle';
    $route['missy-moo'] = 'campaign/show/missy-moo';
    $route['bruno'] = 'campaign/show/bruno';
    $route['test-3'] = 'campaign/show/test-3';
    $route['this-is-a-very-long-campaign-name-but-does-it-fit'] = 'campaign/show/this-is-a-very-long-campaign-name-but-does-it-fit';
    $route['hksdf-asdf-asdlkfl-skdf-lksadl-fka-sdkf-laskdfl-aksdl-fkasldfkklklfklskdf-lkasdlfkkla-sdlfk-asdfasdfasdf'] = 'campaign/show/hksdf-asdf-asdlkfl-skdf-lksadl-fka-sdkf-laskdfl-aksdl-fkasldfkklklfklskdf-lkasdlfkkla-sdlfk-asdfasdfasdf';
    $route['test-campaign'] = 'campaign/show/test-campaign';
    $route['test-birthday'] = 'campaign/show/test-birthday';
    $route['this-year-my-birthday-wish-is-to-help-get-20-people-of-the-street-for-the-night'] = 'campaign/show/this-year-my-birthday-wish-is-to-help-get-20-people-of-the-street-for-the-night';
    $route['paws-pals-living-ruff-in-sa-spsf-loves-sleepbus-for-sa'] = 'campaign/show/paws-pals-living-ruff-in-sa-spsf-loves-sleepbus-for-sa';
    $route['belinda-jane-staff-friends'] = 'campaign/show/belinda-jane-staff-friends';
    $route['o-toole-birthday-pledge'] = 'campaign/show/o-toole-birthday-pledge';
    $route['sleepbus-birthday-pledge-fun-draiser'] = 'campaign/show/sleepbus-birthday-pledge-fun-draiser';
    $route['30th-birthday-bypass'] = 'campaign/show/30th-birthday-bypass';
    $route['brownies-birthday'] = 'campaign/show/brownies-birthday';
    $route['safe-place-haven'] = 'campaign/show/safe-place-haven';
    $route['helping-the-homeless'] = 'campaign/show/helping-the-homeless';
    $route['byronshire'] =  'campaign/show/byronshire';
    $route['sleep-50-for-my-50th-please'] =  'campaign/show/sleep-50-for-my-50th-please';
    $route['a-warm-safe-bed'];
    $route['perth'];
    $route['sleepbus'];
    $route['slumber-party-for-sleepbus'];
    $route['grace-sleepbus'];
    $route['testing-campaign-after-migration'];
    $route['qlik'];
    $route['stroll-to-the-shack-for-sleepbus'];

     if((preg_match("/\/blog\//i", $_SERVER['REQUEST_URI'])))
     {
     //blog
/*     $months=array("january","february","march","april","may","june","july","august","september","october","november","december"); 
     foreach($months as $month)
     {
      $route["blog/$month-(:num)"]="blog/BlogArchive/$month/$1";
      $route["blog/$month-(:num)/page/(:num)"]="blog/BlogArchive/$month/$1/$2";
     }
     $route['blog/(:any)/page/(:num)']="blog/BlogCategory/$1/$2";
     $route['blog/page/(:num)']="blog/blog_list/$1";
*/   $route['blog/(:any)/(:any)']="blog/BlogDetails/$1/$2";
     $route['blog/(:any)']="blog/BlogCategory/$1";
    }
    else
	{
     include_once("database.php");
	 $linkdb=mysqli_connect($db['default']['hostname'],$db['default']['username'],$db['default']['password']);
	 $seldblink=mysqli_select_db($linkdb,$db['default']['database']);
	 $get_url=false;
	 
	 if($get_url == false)
	 {
	  $sql="select url,id from projects where status='1' and url='".$requested_url."'";
      $res=mysqli_query($linkdb,$sql);
      if(mysqli_num_rows($res) > 0)
      {
       $row=mysqli_fetch_array($res);	   
       $route[$row['url']]="projects/details/".$row['id'];
	   $get_url=true;
	  }
	  else $get_url=false;
	 }
	 // for campaign edit page
	    if(($get_url == false) && (preg_match("/\/fundraise\//i", $_SERVER['REQUEST_URI'])))
	    {	
		 $temp_url=str_replace("fundraise","",$requested_url); 
	     $sql="SELECT id,url from user_campaigns  where url='".$temp_url."' and status='1'";	 
         $res=mysqli_query($linkdb,$sql);
         if(mysqli_num_rows($res) > 0)
         {
          $row=mysqli_fetch_array($res);	   
          $route['fundraise/'.$row['url']]="fundraise/edit/".$row['id'];
	      $get_url=true;
	     }
	     else $get_url=false;
	    }
		// for donation of campaign pages
	    if(($get_url == false) && (preg_match("/\/donation\//i", $_SERVER['REQUEST_URI'])))
	    {	
		 $temp_url=str_replace("donation","",$requested_url); 
	     $sql="SELECT id,url from user_campaigns  where url='".$temp_url."' and status='1'";	 
         $res=mysqli_query($linkdb,$sql);
         if(mysqli_num_rows($res) > 0)
         {
          $row=mysqli_fetch_array($res);	   
          $route['donation/'.$row['url']]="donation/donate-fund/".$row['id'];
	      $get_url=true;
	     }
	     else $get_url=false;
	    }
       } 
      }
     }
    }
   }
?>
