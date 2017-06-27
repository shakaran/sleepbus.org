<?php
 $this->load->view('templates/cta'); 
 ?>
 <footer <?php if(($active_menu =="signin") || ($active_menu =="account") || ($active_menu =="user") || ($active_menu =="pledge") || ($active_menu =="fundraise" )|| ($active_menu =="donation")){?> class="mrtopnone" <?php }?>>


<div class="container">
<div class="col-lg-6 col-md-8 col-sm-6 leftfooter">
<div class="row">
<ul>
  <li>Get to know us</li>
  <li><a href="/why-sleep">Why sleep?</a></li>
  <li><a href="/about-us">About us</a></li>
  <li><a href="/meet-the-board">Meet the board</a></li>
  <li><a href="/completed-projects">Projects</a></li>
</ul>

<ul>
  <li>Resources</li>
  <li><a href="/sleepbus-toolbox">sleepbus toolbox</a></li>
  <li><a href="/in-the-media">In the media</a></li>
  <li><a href="/speaker-request">Speaker request</a></li>
  <li><a href="/blog">Blog</a></li>
</ul>

<ul>
  <li>Get involved</li>
  <li><a href="/donate">Donate</a></li>
  <li><a href="/pledge">Pledge</a></li>
  <li><a href="/fundraise">Fundraise</a></li>
  <li><a href="/corporate-supporters">Corporate support</a></li>
</ul>

<ul>
  <li><a href="/connect">Connect</a></li>
  <li><a href="/volunteer">Volunteer</a></li>
</ul>
</div>
</div>

<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 rightfooter" id="charitylogo"><img alt="ACNC Registered Charity" src="/images/ACNC-Registered-Charity-Logo_reverse_300.png" /></div>

<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 rightfooter">
<div class="awesomeemails"><a href="/enewsletter-signup">get our awesome emails</a></div>

<div class="footerfbbox"><a class="fb" href="https://www.facebook.com/sleepbusaustralia" target="_blank"><span>fb</span></a> <a class="twitter" href="https://twitter.com/sleepbus" target="_blank"><span>twitter</span></a> <a class="youtube" href="https://www.youtube.com/channel/UCsfnzxuWrjMsKxjdZyFdXEA" target="_blank"><span>youtube</span></a></div>

<p><span style="color:#fff">Registered DGR | All Donations over $2 are Tax Deductible </span><a href="/privacy-policy">Privacy policy.</a> &copy; 2016</p>
</div>
</div>


 </footer>
 <?php
 $this->websitejavascript->IncludeFooterJsFiles();  
?>
<script>
    window.onbeforeunload = function(){
        window.scrollTo(0,0);
    }
</script>
</body>
</html>
