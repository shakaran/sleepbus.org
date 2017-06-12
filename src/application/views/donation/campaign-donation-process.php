<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container">
<div class="row">
	<div class="funding">
    	<div class="redractingmain">
            <div class="redractingcolor">
                <div class="redractingheading">Redirecting ..<span class="blink">.</span> </div>
                <p>You will now be redirected to our payment processor from Paypal.</p>
				<p>Once your payment is processed, please do not close the window till you have been redirected back to our website.</p>
            </div>
            <div class="landingtext2">If you are not automatically redirected to paypal within 5 seconds...</div>
            
<?php
		   $subscription_id = base64_decode(time());	  
		   $attributes=array();
		   $attributes['form'] = array('id' => 'ppForm');
     		echo form_open_multipart($paypal_url,$attributes['form']);
            echo form_hidden('cmd','_xclick');
            echo form_hidden('upload','1');
            echo form_hidden('business',$merchantEmail);
            echo form_hidden('item_name',$item_name);
            echo form_hidden('item_number',time());
            echo form_hidden('amount',$payable_amount);
            echo form_hidden('quantity','1');
			echo form_hidden('rm','2');
            //echo form_hidden('no_shipping','1');
            //echo form_hidden('no_note','1');
            echo form_hidden('currency_code',$price_type);
            //echo form_hidden('lc','Gb');
            //echo form_hidden('bn','PP-BuyNowBF');
            //echo form_hidden('custom','10002');
            echo form_hidden('cbt','Please click here to confirm your payment');

           // If you have turned on auto return on your paypal profile the next line shows where they will go after they have paid by paypal and they click return to site 
            echo form_hidden('return',base_url().$back_module.'/'.$succes_page);

         //   echo form_hidden('return',base_url().$this->data['campaign_details']['url']."startoflist");
			
			// And this is where they will go if they click cancel 
            echo form_hidden('cancel_return',base_url().$back_module.'/cancel');
			
/*            notes about the following parameter rm
            If your return_url page is a static web page and if Instant Payment Notification is on within the profile, you must to set rm = 1 in the button code so that the return_url page can be called through a GET. If you do not set it, your users will encounter HTTP 405 errors when they try to go to the return page because a static web page can't accept a POST.            So make your return_url a .php file if you have rm=2
*/
            echo form_hidden('rm','2'); // Auto return must be off if rm=2 

            //Next line is where paypal should send the ipn to. we will have set a global value in our paypal account but we can re specify it here  
            echo form_hidden('notify_url',base_url().$back_module.'/notify-ipn');			
            ?>
            
            
            
            
            <div class="reviewlink">
               <input type="submit" id="submit_paypal" value="Click Here" name="submit_paypal"> 
            </div>
            
            <?php
            echo form_close();
			?>
        </div>
    </div>
</div>
</div>
</div>
          