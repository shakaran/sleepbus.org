<?php 
try {	
	require_once('Stripe/lib/Stripe.php');
	Stripe::setApiKey("sk_test_spy9yMA1iCYGf5uRbbSK1SOq"); //Replace with your Secret Key
 
	$charge = Stripe_Charge::create(array(
		"amount" => 10000,
		"currency" => "usd",
		"card" => $_POST['stripeToken'],
		"description" => "Demo Transaction"
	));
	echo "<h1>Your payment has been completed.</h1>";	
}
 
catch(Stripe_CardError $e) {
 
}
catch (Stripe_InvalidRequestError $e) {
 
} catch (Stripe_AuthenticationError $e) {
} catch (Stripe_ApiConnectionError $e) {
} catch (Stripe_Error $e) {
} catch (Exception $e) {
}
?>