<!DOCTYPE html>
<html lang="en">
<body>
<div class='web'>
<?php /*?><form action="<?php echo site_url('Stripe_payment/checkout');?>" method="POST">
<?php */?>
<form action="payment.php" method="POST">
<script src="https://checkout.stripe.com/checkout.js"
class="stripe-button"
data-key="pk_test_wC80rwnm2VoiKUvfiSxhrssh"
data-image="http://zeemo.com.au/images/logo.png"
data-name="w3code.in"
data-description="Demo Transaction ($100.00)"
data-amount="10000" />
</script>
</form>
</div>
</body>
</html>