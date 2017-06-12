<!DOCTYPE html>
<html lang="en">
<body>
<div class='web'>
<?php /*?><form action="<?php echo site_url('Stripe_payment/checkout');?>" method="POST">
<?php */?>
<form action="<?php echo base_url();?>stripe-payment/checkout" method="POST">
<script src="https://checkout.stripe.com/checkout.js" 
		class="stripe-button" 
		data-key="pk_test_wC80rwnm2VoiKUvfiSxhrssh" 
		data-image="http://www.stepblogging.com/wp-content/uploads/2014/12/logo1.png" 
		data-name="StepBlogging.com" 
		data-description="Demo Transaction ($21.00)"
		data-amount="2100" />
		</script>
</form>
</div>
</body>
</html>