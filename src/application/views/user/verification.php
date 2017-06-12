  <div class="recipesheading">List your business</div>
  <div class="wrapperin2">
    <div class="recipesubmissionbox">
      <div class="recipeinputleftmian">
        <div class="stepbox">
          <ul>
            <li> <span><img src="<?php echo base_url();?>images/icon24.png" /></span>
              <bdo> Step 1 <br />
              <img src="<?php echo base_url();?>images/tick.png" width="18" height="15" /> Create account</bdo>
            </li>
            <li> <strong><img src="<?php echo base_url();?>images/icon27.png" /> </strong> </li>
            <li> <span><img src="<?php echo base_url();?>images/icon25.png" /></span>
              <bdo> Step 2 <br />
              <img src="<?php echo base_url();?>images/tick.png" width="18" height="15" /> Your details</bdo>
            </li>
            <li> <strong><img src="<?php echo base_url();?>images/icon27.png" /> </strong> </li>
            <li> <span><img src="<?php echo base_url();?>images/icon30.png" /></span>
              <bdo class="bdoactive">Step 3 <br />
              Verification</bdo>
            </li>
          </ul>
        </div>
        <div class="standardpackage">
          <div class="standardpackagemid">
            <div class="standardpackagemidbg">
              <div class="yourenquiry"><?php echo $page_heading[3]['page_heading'];?></div>
              <?php
               if(count($package_details) > 0)
			   {
			    ?>
                <h2><?php echo $package_details['package_title'];?></h2>
                <h2><?php if(empty($package_details['price'])) echo "Free"; else echo "$".$package_details['price'];?> - <?php echo $package_details['time_period'];?> month(s)</h2>
				<?php
			   }
			  ?>
              <div class="createaccthree">
              <?php
			   echo form_open(base_url().'user/verification',$package_attributes['form']);
               echo form_dropdown('package_id',$package_attributes['package_id'],'',"id='package_id' onchange='SubmitPackage()' class='country_id'")?>
               <?php
			    echo form_close();
              ?> 
              </div>
            </div>
          </div>
        </div>
        <div class="standardpackage">
          <div class="standardpackagemid">
            <div class="standardpackagemidbg">
              <div class="yourenquiry"><?php echo $page_heading[4]['page_heading'];?></div>
              <h2><?php echo $this->user_info['first_name']." ".$this->user_info['last_name'];?></h2>
              <h2><?php echo $this->user_info['business_name'];?></h2>
              <h2><?php echo $this->user_info['email2'];?></h2>
              <h2><?php echo $this->user_info['phone'];?></h2>
            </div>
          </div>
        </div>
              
        <?php
         echo form_open(base_url().$attributes['target'],$attributes['form']);
		?>
              <input type="hidden" id="selected_package_id" name="selected_package_id" value="<?php echo $package_id;?>" />
              <input type="hidden" id="paying_price" name="paying_price" value="<?php echo $attributes['paying_price'];?>" />
              <input type="hidden" id="scrollTo" name="scrollTo" value="<?php echo $scrollTo;?>" />
        
        <div class="standardpackage" id="billing_address">
          <div class="standardpackagemid">
            <div class="standardpackagemidbg standardnone" id="billing_content">
              <div class="yourenquiry" id="billing_heading"><?php echo $page_heading[5]['page_heading'];?></div>
              <h2><?php echo $this->user_info['address']." ".$this->user_info['suburb']." ".$this->user_info['state']." ".$this->user_info['postcode'];?></h2>
              
              <?php
			   if(!(empty($package_details['price']) or ($package_details['price'] == 0)))
			   {
                if(count($promocode_details) > 0 and !($attributes['pay_now']))
				{
			     ?>
                 <div class="accountbox" style="text-align:center" id="promo_code_error">
                  <div id="all_error" class="test_form_error" style=" <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline;text-align:left;float:left; <?php }?>"><?php echo validation_errors("<div style='color:#e60000;text-align:center;float:float;'>","<br /></div>"); ?> </div> 
                 </div>
                 <div class="promocode">
                 <div class="promocodebutton">Promo code</div>
                 <?php
                  echo form_input($attributes['promo_code']);
				 ?>
                 </div>
                 <?php
				}
			   }
              ?>
              <div id="price_details" <?php if(!$attributes['pay_now']){?> style="display:none;" <?php } ?>>
               <h2><strong>Package Price :</strong> $<?php echo $package_details['price']; ?>&nbsp;&nbsp;&nbsp;&nbsp; <strong>Discount</strong> : <?php echo $attributes['discount_allowed'];?>&nbsp;&nbsp;&nbsp;&nbsp; <strong>Payable Amount</strong> : $<?php echo $attributes['paying_price']?><br />&nbsp;&nbsp;&nbsp;&nbsp; <strong>GST</strong> : <?php echo $common_settings['gst'];?>%&nbsp;&nbsp;&nbsp;&nbsp; <strong>Grand Payable Amount</strong> : <?php $grand_payable_amount=($attributes['paying_price']+(($attributes['paying_price']*$common_settings['gst'])/100)); echo "$".$grand_payable_amount;?> (included GST)</h2>
              </div>
              <div class="submitrecipebutton2">
                <?php
				 echo form_submit($attributes['submit']);
                ?>
              </div>
			     
			  
                 
              
              
                                    
              
            </div>
            <?php
             if($attributes['pay_now'])
			 {
			  ?>
			  <div class="redirectingbox" id="redirecting" style="display:none;">
              	<div class="redirectingboxleft"><img src="<?php echo base_url();?>images/icon31.png" /></div>
                <div class="redirectingboxright">
                <div class="redirectingheading">Redirecting...</div>
                <p>You will now be redirected to our payment processor from Paypal.</p>
				<p>Once your payment is processed, please do not close the window will you have been redirected back to our website.</p>
                </div>
                <div>&nbsp;</div>
              </div> 
              <?php
			 }
             ?>             
            
			  <div class="pay" <?php if(!$attributes['pay_now']){?> style="display:none;" <?php } ?>>
                <img src="<?php echo base_url();?>images/paypal.png" />
              </div>   
              
            
          </div>
        </div>
        <?php 
			   echo form_close();
			  ?>
        
      </div>
    </div>
  </div>
  
