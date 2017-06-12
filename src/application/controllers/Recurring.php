<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Recurring extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->helper('paypalfunctions');
   $this->load->model('Recurring_model');   
  }  
  public function expresscheckout()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','13','eNewsletter Thanks');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',13);

	$paymentAmount=$this->session->userdata('monthly_amount');
    if(empty($paymentAmount))
	{
	 $this->error();
	}
	else
	{
     $this->session->unset_userdata('monthly_amount');
		
	 $BILLINGFREQUENCY='1';
	 $BILLINGPERIOD='Month';
	 $CURRENCYCODE=$this->data['price_type'];

/*	$BILLINGFREQUENCY=$this->input->post('BILLINGFREQUENCY');
	$BILLINGPERIOD=$this->input->post('BILLINGPERIOD');
	$CURRENCYCODE=$this->input->post('CURRENCYCODE');
*/
	 $newdata=array('Payment_Amount'=>$paymentAmount,'BILLINGFREQUENCY'=>$BILLINGFREQUENCY,'BILLINGPERIOD'=>$BILLINGPERIOD,'CURRENCYCODE'=>$CURRENCYCODE);
 	 $this->session->set_userdata($newdata);
 	
	 $currencyCodeType = $this->data['price_type'];
	
	 $paymentType = "Sale";
	 $returnURL = base_url()."recurring/review";
	 $cancelURL = base_url()."recurring/cancel";

	 $resArray = CallShortcutExpressCheckout($paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL);
	
	
	 $ack = strtoupper($resArray["ACK"]);
	 if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
	 {
			RedirectToPayPal($resArray["TOKEN"]);
	 } 
	 else  
	 {
		//Display a user friendly Error on the page using any of the following error information returned by PayPal
		$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
		$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
		$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
		$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
	
		echo "SetExpressCheckout API call failed. "; 
		echo "<br />Detailed Error Message: " . $ErrorLongMsg;
		echo "<br />Short Error Message: " . $ErrorShortMsg;
		echo "<br />Error Code: " . $ErrorCode;
		echo "<br />Error Severity Code: " . $ErrorSeverityCode;
	 }
	}
  }
  
  public function review(){
	  $token = $this->input->get('token', TRUE);

	if ( $token != "" )
	{
		$resArray = GetShippingDetails( $token );
		$ack = strtoupper($resArray["ACK"]);
		
        $this->session->unset_userdata('shipping_details');
        $this->session->set_userdata('shipping_details',$resArray);
		if( $ack == "SUCCESS" || $ack == "SUCESSWITHWARNING") 
		{
			/*
			' The information that is returned by the GetExpressCheckoutDetails call should be integrated by the partner into his Order Review 
			' page		
			*/
			$email 			= $resArray["EMAIL"]; // ' Email address of payer.
			$payerId 			= $resArray["PAYERID"]; // ' Unique PayPal customer account identification number.
			$payerStatus		= $resArray["PAYERSTATUS"]; // ' Status of payer. Character length and limitations: 10 single-byte alphabetic characters.
//			$salutation			= $resArray["SALUTATION"]; // ' Payer's salutation.
			$firstName			= $resArray["FIRSTNAME"]; // ' Payer's first name.
//			$middleName			= $resArray["MIDDLENAME"]; // ' Payer's middle name.
			$lastName			= $resArray["LASTNAME"]; // ' Payer's last name.
//			$suffix				= $resArray["SUFFIX"]; // ' Payer's suffix.
			$cntryCode			= $resArray["COUNTRYCODE"]; // ' Payer's country of residence in the form of ISO standard 3166 two-character country codes.
//			$business			= $resArray["BUSINESS"]; // ' Payer's business name.
			$shipToName			= $resArray["SHIPTONAME"]; // ' Person's name associated with this address.
			$shipToStreet		= $resArray["SHIPTOSTREET"]; // ' First street address.
//			$shipToStreet2		= $resArray["SHIPTOSTREET2"]; // ' Second street address.
			$shipToCity			= $resArray["SHIPTOCITY"]; // ' Name of city.
			$shipToState		= $resArray["SHIPTOSTATE"]; // ' State or province
			$shipToCntryCode	= $resArray["SHIPTOCOUNTRYCODE"]; // ' Country code. 
			$shipToZip			= $resArray["SHIPTOZIP"]; // ' U.S. Zip code or other country-specific postal code.
			$addressStatus 		= $resArray["ADDRESSSTATUS"]; // ' Status of street address on file with PayPal   
//			$invoiceNumber		= $resArray["INVNUM"]; // ' Your own invoice or tracking number, as set by you in the element of the same name in SetExpressCheckout request .
//			$phonNumber			= $resArray["PHONENUM"]; // ' Payer's contact telephone number. Note:  PayPal returns a contact telephone number only if your Merchant account profile settings require that the buyer enter one. 
		} 
		else  
		{
			//Display a user friendly Error on the page using any of the following error information returned by PayPal
			$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
			$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
			$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
			$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
			
			echo "GetExpressCheckoutDetails API call failed. ";
			echo "Detailed Error Message: " . $ErrorLongMsg;
			echo "Short Error Message: " . $ErrorShortMsg;
			echo "Error Code: " . $ErrorCode;
			echo "Error Severity Code: " . $ErrorSeverityCode;
		}
		
     $this->load->view('recurring/review',$this->data);
    }
 
  }
 public function order_confirm()
 {	
  $PaymentOption = "PayPal";
  if( $PaymentOption == "PayPal" )
  {
	/*
	'------------------------------------
	' The paymentAmount is the total value of 
	' the shopping cart, that was set 
	' earlier in a session variable 
	' by the shopping cart page
	'------------------------------------
	*/
	
	$finalPaymentAmount = $this->session->userdata('Payment_Amount');
	//$finalPaymentAmount = 5;
	/*
	'------------------------------------
	' Calls the DoExpressCheckoutPayment API call
	'
	' The ConfirmPayment function is defined in the file PayPalFunctions.jsp,
	' that is included at the top of this file.
	'-------------------------------------------------
	*/
	
    $resArray=CreateRecurringPaymentsProfile();	
/*    echo "<pre>";
	echo print_r($resArray);
	echo "</pre>";
*/    
	$paymentArray = ConfirmPayment ( $finalPaymentAmount );// Remove comment with ontime payment.
/*    echo "<pre>";
	echo print_r($paymentArray);
	echo "</pre>";
	exit;
*///	$resArray=CreateRecurringPaymentsProfile();
	$ack = strtoupper($paymentArray["ACK"]);
	if( $ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING" )
	{
		/*
		'********************************************************************************************************************
		'
		' THE PARTNER SHOULD SAVE THE KEY TRANSACTION RELATED INFORMATION LIKE 
		'                    transactionId & orderTime 
		'  IN THEIR OWN  DATABASE
		' AND THE REST OF THE INFORMATION CAN BE USED TO UNDERSTAND THE STATUS OF THE PAYMENT 
		'
		'********************************************************************************************************************
		*/

		//$transactionId		= $resArray["TRANSACTIONID"]; // ' Unique transaction ID of the payment. Note:  If the PaymentAction of the request was Authorization or Order, this value is your AuthorizationID for use with the Authorization & Capture APIs. 
		//$transactionType 	= $resArray["TRANSACTIONTYPE"]; //' The type of transaction Possible values: l  cart l  express-checkout 
		//$paymentType		= $resArray["PAYMENTTYPE"];  //' Indicates whether the payment is instant or delayed. Possible values: l  none l  echeck l  instant 
		//$orderTime 			= $resArray["ORDERTIME"];  //' Time/date stamp of payment
		//$amt				= $resArray["AMT"];  //' The final amount charged, including any shipping and taxes from your Merchant Profile.
		//$currencyCode		= $resArray["CURRENCYCODE"];  //' A three-character currency code for one of the currencies listed in PayPay-Supported Transactional Currencies. Default: USD. 
		//$feeAmt				= $resArray["FEEAMT"];  //' PayPal fee amount charged for the transaction
		//$settleAmt			= $resArray["SETTLEAMT"];  //' Amount deposited in your PayPal account after a currency conversion.
		//$taxAmt				= $resArray["TAXAMT"];  //' Tax charged on the transaction.
		//$exchangeRate		= $resArray["EXCHANGERATE"];  //' Exchange rate if a currency conversion occurred. Relevant only if your are billing in their non-primary currency. If the customer chooses to pay with a currency other than the non-primary currency, the conversion occurs in the customer’s account.
		
		/*
		' Status of the payment: 
				'Completed: The payment has been completed, and the funds have been added successfully to your account balance.
				'Pending: The payment is pending. See the PendingReason element for more information. 
		*/
		
		//$paymentStatus	= $resArray["PAYMENTSTATUS"]; 

		/*
		'The reason the payment is pending:
		'  none: No pending reason 
		'  address: The payment is pending because your customer did not include a confirmed shipping address and your Payment Receiving Preferences is set such that you want to manually accept or deny each of these payments. To change your preference, go to the Preferences section of your Profile. 
		'  echeck: The payment is pending because it was made by an eCheck that has not yet cleared. 
		'  intl: The payment is pending because you hold a non-U.S. account and do not have a withdrawal mechanism. You must manually accept or deny this payment from your Account Overview. 		
		'  multi-currency: You do not have a balance in the currency sent, and you do not have your Payment Receiving Preferences set to automatically convert and accept this payment. You must manually accept or deny this payment. 
		'  verify: The payment is pending because you are not yet verified. You must verify your account before you can accept this payment. 
		'  other: The payment is pending for a reason other than those listed above. For more information, contact PayPal customer service. 
		*/
		
		//$pendingReason	= $resArray["PENDINGREASON"];  

		/*
		'The reason for a reversal if TransactionType is reversal:
		'  none: No reason code 
		'  chargeback: A reversal has occurred on this transaction due to a chargeback by your customer. 
		'  guarantee: A reversal has occurred on this transaction due to your customer triggering a money-back guarantee. 
		'  buyer-complaint: A reversal has occurred on this transaction due to a complaint about the transaction from your customer. 
		'  refund: A reversal has occurred on this transaction because you have given the customer a refund. 
		'  other: A reversal has occurred on this transaction due to a reason not listed above. 
		*/
		
		//$reasonCode		= $resArray["REASONCODE"]; 
		
		
		
		// Insert into table
		
		// Send Mail to admin and user
		//print_r($resArray);
		$donation=array();
		$donation=$this->session->userdata('shipping_details');
		
/*		echo "<pre>";
		print_r($donation);
		echo "</pre>";
*/		
		$payment=array();
		if((count($resArray)> 0) and (count($donation) > 0) and (count($paymentArray) > 0))
        {
	     $payment['payer_email']=$donation['EMAIL'];
	     $payment['payment_date']=$paymentArray['TIMESTAMP'];
	     $payment['paid_amount']=$donation['AMT'];
		 if(isset($paymentArray['TRANSACTIONID']) and !(empty($paymentArray['TRANSACTIONID'])))
		 {
	      $payment['transaction_no']=$paymentArray['TRANSACTIONID'];
		 }
		 $payment['status']=$paymentArray['PAYMENTSTATUS'];
	 
	     $payment['donor_name']=$donation['FIRSTNAME']." ".$donation['LASTNAME'];
	     $payment['correlation_id']=$resArray['CORRELATIONID'];
	     $payment['donation_type']='monthly';
/*	     if(count($this->user_info) > 0)
	     {
	      $payment['registered_user_id']=$this->user_info['id'];
	     }
*/		}
		
		$payment['profile_id']=$resArray['PROFILEID'];
		$payment['profile_status']=$resArray['PROFILESTATUS'];
		$payment['version']=$resArray['VERSION'];
		$payment['build']=$resArray['BUILD'];
        
		$this->Recurring_model->InsertDonationDetails($payment);
		
		
	    $this->SendMessageToAdmin($payment);
	    if(!empty($payment['payer_email']))
	    {
	     $this->SendMessageToDonor($payment);
	    }
		
		
		$this->RedirectPage('recurring/success');
		
		$this->session->unset_userdata('shipping_details');
	  }
	  else  
	  {
		//Display a user friendly Error on the page using any of the following error information returned by PayPal
		$this->data['ErrorCode'] = urldecode($resArray["L_ERRORCODE0"]);
		$this->data['ErrorShortMsg'] = urldecode($resArray["L_SHORTMESSAGE0"]);
		$this->data['ErrorLongMsg'] = urldecode($resArray["L_LONGMESSAGE0"]);
		$this->data['ErrorSeverityCode'] = urldecode($resArray["L_SEVERITYCODE0"]);
    
       $this->session->unset_userdata('shipping_details');
       
	   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','37','Sorry !!! Monthly Donation Setup Unsuccessful');
       $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',37);
	
	   $this->load->view('templates/header',$this->data);
       $this->load->view('recurring/unsuccess-message',$this->data);
       $this->load->view('templates/footer');
		
	}
   }	


  }
  public function success()
  {
   $this->session->unset_userdata('shipping_details');
   
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','35','Monthly Donation Setup Successful');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',35);

   $this->data['thanks']=$this->Website_model->GetThankMessages(12);
   $this->load->view('templates/header',$this->data);
   $this->load->view('recurring/success-message',$this->data);
   $this->load->view('templates/footer');
  }
  public function cancel()
  {
   $this->session->unset_userdata('shipping_details');	  
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','36','Donation Cancelled!');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',36);

   $this->data['thanks']=$this->Website_model->GetThankMessages(13);
   $this->load->view('templates/header',$this->data);
   $this->load->view('recurring/cancel',$this->data);
   $this->load->view('templates/footer');
  }
  public function SendMessageToAdmin($values)
  {
   $mailBody="<div style='clear:both;'></div>
   <div style='margin:0px; padding-top:15px; padding-bottom:15px;background:#fff;color:#000;'>
	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Monthly Amount:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>$".$values['paid_amount']."</div>

      <div style='clear:both;'></div>
	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Profile ID.:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".$values['profile_id']."</div>

      <div style='clear:both;'></div>
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Profile Status.:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".$values['profile_status']."</div>
      <div style='clear:both;'></div>
	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Correlation ID.:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".$values['correlation_id']."</div>

      <div style='clear:both;'></div>
	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Status:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".$values['status']."</div>
		
      <div style='clear:both;'></div>
	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Payment Date:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".date('d m Y h : i : s',strtotime($values['payment_date']))."</div>";
		
	  if(!empty($payment['donor_name']))
	  {
	   $mailBody.="<div style='clear:both;'></div>	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Name:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".$values['donor_name']."</div>";	  
		  
	  }
	  if(!empty($payment['payer_email']))
	  {
	   $mailBody.="<div style='clear:both;'></div>	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Email(Paypal Account):</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".$values['payer_email']."</div>";	  
		  
	  }
	  if(!empty($payment['transaction_no']))
	  {
	   $mailBody.="<div style='clear:both;'></div>	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Transaction No.:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".$values['transaction_no']."</div>";	  
		  
	  }



	$mailBody.="<div style='clear:both;'></div>
		       <div style='clear:both;'></div></div>";
	
	if(!empty($payment['payer_email']) && !empty($payment['donor_name']))
	{
	 $reply_to=array();
	 $reply_to['email']=$values['payer_email'];
	 $reply_to['name']=$values['donor_name'];
	}
	else
	{
	 $reply_to=array();
	 $reply_to['email']='';
	 $reply_to['name']='';
	}
    $this->SendMail($mailBody,$reply_to,14); 
   } 
   
  public function SendMessageToDonor($values)
  {
   // Mail to user	  
   $mailBody="<div style='clear:both;'></div>
   <div style='margin:0px; padding-top:15px; padding-bottom:15px;background:#fff;color:#000;'>
	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Monthly Amount:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>$".$values['paid_amount']."</div>

      <div style='clear:both;'></div>
	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Profile ID.:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".$values['profile_id']."</div>

      <div style='clear:both;'></div>
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Profile Status.:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".$values['profile_status']."</div>
      <div style='clear:both;'></div>
	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Correlation ID.:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".$values['correlation_id']."</div>

      <div style='clear:both;'></div>
	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Status:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".$values['status']."</div>
		
      <div style='clear:both;'></div>
	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Payment Date:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".date('d m Y h : i : s',strtotime($values['payment_date']))."</div>";
		
	  if(!empty($payment['donor_name']))
	  {
	   $mailBody.="<div style='clear:both;'></div>	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Name:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".$values['donor_name']."</div>";	  
		  
	  }
	  if(!empty($payment['payer_email']))
	  {
	   $mailBody.="<div style='clear:both;'></div>	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Email(Paypal Account):</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".$values['payer_email']."</div>";	  
		  
	  }
	  if(!empty($payment['transaction_no']))
	  {
	   $mailBody.="<div style='clear:both;'></div>	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000;'>Transaction No.:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;color:#000'>".$values['transaction_no']."</div>";	  
		  
	  }



	$mailBody.="<div style='clear:both;'></div><div style='clear:both;'></div></div>";
	$mailto=array();
	$mailto['email']=$values['payer_email'];
	$mailto['name']=$values['donor_name'];;
	 
   $this->SendMailToUser($mailBody,$mailto,15,$other_info=''); 
    
  }
  
 }
