<div class="birthdaybox">

  <div class="container">
  <?php echo $page_heading[0]['page_heading'];?>

  <div class="birthdayinputbox" id="pledgefrom">
		<?php
     		echo form_open(base_url().'pledge',$attributes['form']);
            echo form_hidden('caller','Send');
          ?>
<div id="errorDiv" style="height:30px; <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline; <?php }?>"><?php echo validation_errors("<p style='color:#e60000;height:0px;'>","</p>"); ?></div>

        <label for="birthday"><span></span>Your Date of Birth </label>  
       <div class="birthdayinputname">
       
        <div class="col-lg-4 col-xs-4 collg1"><?php echo form_input($attributes['day']);?></div>
        <div class="col-lg-4 col-xs-4 collg2"><?php echo form_input($attributes['month']);?></div>
        <div class="col-lg-4 col-xs-4 collg3"><?php echo form_input($attributes['year']);?></div>
       </div>
     <div class="birthdayinputname"><?php echo form_input($attributes['full_name']);?></div>
     <div class="birthdayinputname"><?php echo form_input($attributes['email']);?></div>
     <div class="birthdayinputname">
       <div class="singupcheckbox">
       <?php echo form_checkbox($attributes['newsletter_subscription']);?>
       <label for="newsletter_subscription"><span></span>Keep me updated on email</label> 
       </div>
       </div>
     <div class="birthdayinputname"><?php echo form_submit($attributes['submit']);?></div>
 
  </div>
  
  
  </div>

</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fundraise" id="page-content">
<div class="container positionrelative">
<div class="arrow4"><img height="54" id="scroll-down" src="https://www.sleepbus.org/images/arrow4.png" width="83" /></div>

<div class="row">
<h2>How does it work?</h2>

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome height_450">
<div class="donatehomeimg"><img alt="" src="https://www.sleepbus.org/images/icon23.png" /></div>

<h2>Pledge your birthday</h2>

<p>The first step is simple - just pledge your birthday by using the form above, and share your pledge to let the world know you&rsquo;re serious.</p>
</div>

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome height_450">
<div class="donatehomeimg"><img alt="" src="https://www.sleepbus.org/images/icon24.png" /></div>

<h2>Setup a campaign</h2>

<p>Once you have pledged your Birthday for safe sleeps, setup your campaign. We&#39;ll remind you to start fundraising when we get closer to your big day.</p>
</div>

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome height_450">
<div class="donatehomeimg"><img alt="" src="https://www.sleepbus.org/images/icon25.png" /></div>

<h2>Always use 100%</h2>

<p>We&rsquo;ll use 100% of the money you raise to fund sleepbus projects. You&rsquo;ll receive photos of the bus your funds support and its location so you can go and see it for yourself. There&rsquo;s no better present than getting people off the street and providing safe sleeps.</p>
</div>
</div>
</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fundraisecolor">
<div class="container">
<div class="row">
<h2>Australian birthday facts</h2>

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 fundraisecolorbox">
<h2>66,000</h2>

<p>birthdays are celebrated in Australia everyday.</p>
</div>

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 fundraisecolorbox">
<h2>$770</h2>

<p>average amount raised by a person&rsquo;s birthday campaign.</p>
</div>

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 fundraisecolorbox">
<h2>28 People</h2>

<p>have a safe sleep as a result of an average birthday campaign</p>
</div>
</div>
</div>
</div>

