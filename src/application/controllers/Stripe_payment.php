<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Stripe_payment extends CI_Controller {
 
	public function __construct() {
 
		parent::__construct();
 
		}
 
         public function index()
         {
             //$this->load->view('connect/request',$this->data);
		     $this->load->view('payment/payment');
			 echo APPPATH;
          }
 
	public function checkout()
	{
	 try {	
	 include_once('./Stripe/lib/Stripe.php');
	 new Stripe();
	 Stripe::setApiKey("sk_test_spy9yMA1iCYGf5uRbbSK1SOq"); //Replace with your Secret Key
	
	 $charge = Stripe_Charge::create(array(
		"amount" => 2100,
		"currency" => "usd",
		"card" => $_POST['stripeToken'],
		"description" => "Demo Transaction"
	));
	//send the file, this line will be reached if no error was thrown above
	echo "<h1>Your payment has been completed.</h1>";
	//you can send the file to this email:
	echo $_POST['stripeEmail'];
	echo "token=".$_POST['stripeToken'];
  }

 catch(Stripe_CardError $e) {
	
 }

//catch the errors in any way you like

catch (Stripe_InvalidRequestError $e) {
  // Invalid parameters were supplied to Stripe's API

} catch (Stripe_AuthenticationError $e) {
  // Authentication with Stripe's API failed
  // (maybe you changed API keys recently)

} catch (Stripe_ApiConnectionError $e) {
  // Network communication with Stripe failed
} catch (Stripe_Error $e) {

  // Display a very generic error to the user, and maybe send
  // yourself an email
} catch (Exception $e) {

  // Something else happened, completely unrelated to Stripe
}	}
 
}