<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recurring extends MY_Controller {
  function __construct() {
    parent :: __construct();

    $this->load->helper('paypalfunctions');
    $this->load->model('Recurring_model');   
  }  

  public function expresscheckout() {
    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','13','eNewsletter Thanks');
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',13);

    $paymentAmount=$this->session->userdata('monthly_amount');
    if (empty($paymentAmount)) {
      $this->error();
    } else {
      $this->session->unset_userdata('monthly_amount');
      $BILLINGFREQUENCY='1';
      $BILLINGPERIOD='Month';
      $CURRENCYCODE=$this->data['price_type'];
      $newdata=array('Payment_Amount'=>$paymentAmount,'BILLINGFREQUENCY'=>$BILLINGFREQUENCY,'BILLINGPERIOD'=>$BILLINGPERIOD,'CURRENCYCODE'=>$CURRENCYCODE);
      $this->session->set_userdata($newdata);
      $currencyCodeType = $this->data['price_type'];
      $paymentType = "Sale";
      $returnURL = base_url()."recurring/review";
      $cancelURL = base_url()."recurring/cancel";
      $resArray = CallShortcutExpressCheckout($paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL);
      $ack = strtoupper($resArray["ACK"]);

      if ($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING") {
        RedirectToPayPal($resArray["TOKEN"]);
      } else  {
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

  public function review() {
    $token = $this->input->get('token', TRUE);

    if ($token != "") {
      $resArray = GetShippingDetails( $token );
      $ack = strtoupper($resArray["ACK"]);
      $this->session->unset_userdata('shipping_details');
      $this->session->set_userdata('shipping_details',$resArray);

      if ( $ack == "SUCCESS" || $ack == "SUCESSWITHWARNING") {
        /*
           ' The information that is returned by the GetExpressCheckoutDetails call should be integrated by the partner into his Order Review 
           ' page		
         */
        $email 			= $resArray["EMAIL"];
        $payerId 			= $resArray["PAYERID"];
        $payerStatus		= $resArray["PAYERSTATUS"];
        $firstName			= $resArray["FIRSTNAME"];
        $lastName			= $resArray["LASTNAME"];
        $cntryCode			= $resArray["COUNTRYCODE"];
        $shipToName			= $resArray["SHIPTONAME"];
        $shipToStreet		= $resArray["SHIPTOSTREET"];
        $shipToCity			= $resArray["SHIPTOCITY"];
        $shipToState		= $resArray["SHIPTOSTATE"];
        $shipToCntryCode	= $resArray["SHIPTOCOUNTRYCODE"];
        $shipToZip			= $resArray["SHIPTOZIP"];
        $addressStatus 		= $resArray["ADDRESSSTATUS"];
      } else  {
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

  public function order_confirm() {	
    $PaymentOption = "PayPal";

    if ($PaymentOption == "PayPal") {
      $finalPaymentAmount = $this->session->userdata('Payment_Amount');

      $resArray=CreateRecurringPaymentsProfile();	
      $paymentArray = ConfirmPayment ( $finalPaymentAmount );// Remove comment with ontime payment.
      $ack = strtoupper($paymentArray["ACK"]);

      if ( $ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING" ) {

        // Send Mail to admin and user
        $donation=array();
        $donation=$this->session->userdata('shipping_details');

        $payment=array();

        if ((count($resArray)> 0) and (count($donation) > 0) and (count($paymentArray) > 0)) {
          $payment['payer_email']=$donation['EMAIL'];
          $payment['payment_date']=$paymentArray['TIMESTAMP'];
          $payment['paid_amount']=$donation['AMT'];

          if (isset($paymentArray['TRANSACTIONID']) and !(empty($paymentArray['TRANSACTIONID']))) {
            $payment['transaction_no']=$paymentArray['TRANSACTIONID'];
          }

          $payment['status']=$paymentArray['PAYMENTSTATUS'];
          $payment['donor_name']=$donation['FIRSTNAME']." ".$donation['LASTNAME'];
          $payment['correlation_id']=$resArray['CORRELATIONID'];
          $payment['donation_type']='monthly';
        }

        $payment['profile_id']=$resArray['PROFILEID'];
        $payment['profile_status']=$resArray['PROFILESTATUS'];
        $payment['version']=$resArray['VERSION'];
        $payment['build']=$resArray['BUILD'];
        $this->Recurring_model->InsertDonationDetails($payment);

        $email = array(
          'layout' => 'email/layouts/transactional',
          'body' => $this->load->view('email/recurring_donation_to_admin', $payment, TRUE),
          'subject' => 'A new recurring donation has been setup!',
          'from' => getenv('EMAIL_SEND_FROM'),
          'to' => getenv('ADMIN_EMAIL'),
          'reply-to' => '<' . $payment['email'] . '> ' . $payment['name']
        );

        $this->SendEmail($email);

        if (!empty($payment['payer_email'])) {
          $email = array(
            'layout' => 'email/layouts/transactional',
            'body' => $this->load->view('email/recurring_donation_to_donor', $payment, TRUE),
            'subject' => 'Thank you for setting up a recurring donation with sleepbus!',
            'from' => getenv('EMAIL_SEND_FROM'),
            'to' => $payment['email']
          );

          $this->SendEmail($email);
        }

        $this->RedirectPage('recurring/success');

        $this->session->unset_userdata('shipping_details');
      } else  {
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

  public function success() {
    $this->session->unset_userdata('shipping_details');
    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','35','Monthly Donation Setup Successful');
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',35);
    $this->data['thanks']=$this->Website_model->GetThankMessages(12);
    $this->load->view('templates/header',$this->data);
    $this->load->view('recurring/success-message',$this->data);
    $this->load->view('templates/footer');
  }

  public function cancel() {
    $this->session->unset_userdata('shipping_details');	  
    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','36','Donation Cancelled!');
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',36);
    $this->data['thanks']=$this->Website_model->GetThankMessages(13);
    $this->load->view('templates/header',$this->data);
    $this->load->view('recurring/cancel',$this->data);
    $this->load->view('templates/footer');
  }
}
