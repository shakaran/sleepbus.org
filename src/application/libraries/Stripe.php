<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Stripe
 {
 public function Stripe()
 {
  $CI = & get_instance();
  log_message('Debug', 'Stripe class is loaded.');
 }
 function load($param=NULL)
 {


		try {	
		     include_once APPPATH.'/stripe/lib/Stripe.php';
             Stripe::setApiKey("sk_test_spy9yMA1iCYGf5uRbbSK1SOq");

			//require_once(APPPATH.'libraries/Stripe/lib/Stripe.php');//or you
			
			//$this->Stripe->setApiKey("sk_test_spy9yMA1iCYGf5uRbbSK1SOq"); //Replace with your Secret Key
 
			$charge = Stripe_Charge::create(array(
				"amount" => 10000,
				"currency" => "usd",
				"card" => $_POST['stripeToken'],
				"description" => "Demo Transaction"
			));
			echo "<h1>Your payment has been completed.</h1>";	
			echo $_POST['stripeEmail'];
		}
 
		catch(Stripe_CardError $e) {
 
		}
		catch (Stripe_InvalidRequestError $e) {
 
		} catch (Stripe_AuthenticationError $e) {
		} catch (Stripe_ApiConnectionError $e) {
		} catch (Stripe_Error $e) {
		} catch (Exception $e) {
		}
	

  //return new Stripe();
 }
 }
?>