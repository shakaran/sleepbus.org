<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donation extends MY_Controller {
  function __construct() {
    parent :: __construct();

    $this->load->model('User_model');   
    $this->load->model('Donation_model');   
  }

  public function donate_fund($campaign_id) {
    $this->session->unset_userdata('donate_campaign_id');
    $this->session->set_userdata('donate_campaign_id',$campaign_id);
    $this->RedirectPage('donation');
  }

  public function index() {
    $campaign_id=$this->session->userdata('donate_campaign_id');
    if(empty($campaign_id)) $this->RedirectPage();
    else {
      $this->data['campaign_id']=$campaign_id;	  
      $this->data['campaign_details']=$this->User_model->GetCampaignDetails($this->data['campaign_id']);	
      $values=array();
      $caller=$this->input->post('caller');
      if($caller == 'Send') {
        $form_token = $this->session->userdata('form_token');
        if(!isset($form_token)) { $this->RedirectPage(); exit; }
        else if(isset($form_token) && $form_token != 'donation') { $this->RedirectPage(); exit; }

        if(!preg_match('/'.$_SERVER['HTTP_HOST'].'/',$_SERVER['HTTP_REFERER'])) {
          $this->RedirectPage(); exit;
        }	   

        $values['donor_name']=$this->input->post('donor_name');
        $values['email']=$this->input->post('email');
        $values['amount']=$this->input->post('amount');
        $values['comment']=$this->input->post('comment');
        $values['anonymous']=$this->input->post('anonymous');

        $this->load->library('form_validation'); 
        $this->form_validation->set_error_delimiters('<span>','</span>');
        $this->form_validation->set_message('required','{field}');
        $this->form_validation->set_message('numeric','Invalid entry for campaign goal');


        $this->form_validation->set_rules('donor_name','Please enter name', 'trim|callback__value_required[donor_name]');
        $this->form_validation->set_rules('email','Please enter email', 'trim|required|valid_email');

        $this->form_validation->set_rules('amount','Please enter donation amount', 'trim|required|numeric');

        if($this->form_validation->run() == TRUE) { 
          $donation=array();
          $donation['donor_name']=$values['donor_name'];
          $donation['email']=$values['email'];
          $donation['amount']=$values['amount'];
          $donation['comment']=$values['comment'];
          $donation['anonymous']=$values['anonymous'];
          $this->session->unset_userdata('donation');
          $this->session->set_userdata('donation',$donation);
          $this->RedirectPage('donation/process');
          $this->session->unset_userdata('form_token');
        }
      } else {
        $this->session->set_userdata('form_token','donation');
      }

      $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',32,'Donate : '.$this->data['campaign_details']['campaign_name']);
      $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',32);
      $this->data['page_heading']=$this->Website_model->GetPageHeading(9);
      $this->data['attribute']=$this->Donation_model->GetDonateFormAttributes($values,$this->data['common_settings']['unit_fund']);
      $this->websitejavascript->include_footer_js=array('DonationJs');
      $this->load->view('templates/header',$this->data);
      $this->load->view('donation/donation-form',$this->data);
      $this->load->view('templates/footer');
    }
  }

  public function process() {
    $donation=array();	  
    $donation=$this->session->userdata('donation');
    $this->data['campaign_id']=$this->session->userdata('donate_campaign_id'); 
    $this->data['campaign_details']=$this->User_model->GetCampaignDetails($this->data['campaign_id']);	

    if((count($donation) == 0) or empty($this->data['campaign_id'])) {
      $this->RedirectPage();
    } else {
      $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',32,'Redirect to paypal : Please wait...');
      $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',32);
      $this->websitejavascript->include_footer_js=array('DonationProcessJs');
      $this->data['payable_amount']=$donation['amount']; 
      $this->data['back_module']="donation";
      $this->data['succes_page']="success";
      $this->data['item_name']=$this->data['campaign_details']['campaign_name'];
      $this->load->view('templates/header',$this->data);
      $this->load->view('donation/donation-process',$this->data);
      $this->load->view('templates/footer');
    }
  }

  public function success() {
    $paypal_values=array();

    if(count($_POST) > 0) {
      $paypal_values['txn_id']=$_POST['txn_id'];
      $paypal_values['payer_email']=$_POST['payer_email'];
      $paypal_values['merchant_email']=$_POST['business'];
      $paypal_values['payment_date']=$_POST['payment_date'];
      $paypal_values['payment_get_date']='';
      $paypal_values['paid_amount']=$_POST['mc_gross'];
      $paypal_values['payment_status']=$_POST['payment_status'];
      if(isset($_POST['payment_date']) and !empty($_POST['payment_date'])) {
        $paypal_values['payment_date']=date("Y-m-d H:i:s", strtotime($_POST['payment_date'])); 
      } else $paypal_values['payment_date']=date('Y-m-d H:i:s',mktime());

    } else if(count($_GET) > 0) {
      $paypal_values['txn_id']=$_GET['tx'];

      if(isset($_GET['payer_email'])) $paypal_values['payer_email']=$_GET['payer_email'];
      else $paypal_values['payer_email']='';
      $paypal_values['merchant_email']=$this->data['merchantEmail'];
      $paypal_values['payment_status']=$_GET['st'];
      /*	 if(isset($_GET['payment_date']))$paypal_values['payment_date']=$_GET['payment_date']; else $paypal_values['payment_date']=date('Y-m-d H:i:s',mktime());
       */     
      $paypal_values['payment_get_date']=date('Y-m-d H:i:s',mktime());
      $paypal_values['paid_amount']=$_GET['amt'];
      $paypal_values['payment_status']=$_GET['st'];

      if(isset($_GET['payment_date']) and !empty($_GET['payment_date'])) {
        $paypal_values['payment_date']=date("Y-m-d H:i:s", strtotime($_GET['payment_date'])); 
      } else $paypal_values['payment_date']=date('Y-m-d H:i:s',mktime());
    }

    $donation=array();	  
    $donation=$this->session->userdata('donation');
    $this->data['campaign_id']=$this->session->userdata('donate_campaign_id'); 
    $this->data['campaign_details']=$this->User_model->GetCampaignDetails($this->data['campaign_id']);	

    if(count($paypal_values) > 0) {
      $payment=array();
      $payment['payer_email']=$donation['email'];
      $payment['payment_date']=$paypal_values['payment_date'];
      $payment['paid_amount']=$paypal_values['paid_amount'];
      $payment['transaction_no']=$paypal_values['txn_id'];
      $payment['status']=$paypal_values['payment_status'];

      $payment['donor_name']=$this->commonfunctions->ReplaceSpecialChars($donation['donor_name']);
      $payment['comment']=$this->commonfunctions->ReplaceSpecialChars($donation['comment']);
      $payment['anonymous']=$donation['anonymous'];
      $payment['donation_type']='campaign';
      $payment['campaign_id']=$this->data['campaign_id'];

      if(count($this->user_info) > 0) {
        $payment['registered_user_id']=$this->user_info['id'];
        if(empty($payment['payer_email'])) $payment['payer_email']=$this->user_info['email'];
        if(empty($payment['donor_name'])) $payment['donor_name']=$this->user_info['full_name'];
      }

      $this->Donation_model->InsertDonationDetails($payment);
      $campaign_details=array();
      $campaign_details=$this->Donation_model->GetCampaignDetails($this->data['campaign_id']);
      $payment['campaign_name']=$campaign_details['campaign_name'];
      $payment['campaign_creator_name']=$campaign_details['user_full_name'];
      $payment['campaign_email']=$campaign_details['username'];
      $payment['url']=$campaign_details['url'];

      // to admin
      $email = array(
        'message' => $this->load->view('email/campaign_donation_to_admin', $payment, TRUE),
        'subject' => 'A new campaign donation has been made!',
        'from' => getenv('EMAIL_SEND_FROM'),
        'to' => getenv('ADMIN_EMAIL'),
        'reply-to' => '<' . $payment['payer_email'] . '> ' . $payment['donor_name']
      );

      $this->SendEmail($email);

      if(!empty($payment['payer_email'])) {
        // to donor
        $email = array(
          'message' => $this->load->view('email/campaign_donation_to_donor', $payment, TRUE),
          'subject' => "You're awesome!",
          'from' => getenv('EMAIL_SEND_FROM'),
          'to' => $payment['payer_email']
        );

        $this->SendEmail($email);
      }

      // to campaign creator
      $email = array(
        'message' => $this->load->view('email/campaign_donation_to_creator', $payment, TRUE),
        'subject' => "A new donation has been made to your campaign!",
        'from' => getenv('EMAIL_SEND_FROM'),
        'to' => $payment['campaign_email']
      );

      $this->SendEmail($email);

      $this->session->unset_userdata('donation');
      $this->session->unset_userdata('donate_campaign_id');
    }

    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','33','Donation Successful');
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',33);
    $this->data['thanks']=$this->Website_model->GetThankMessages(10);
    $this->load->view('templates/header',$this->data);
    $this->load->view('donation/success-message',$this->data);
    $this->load->view('templates/footer');
  }

  public function cancel() {
    $this->session->unset_userdata('donation');
    $this->session->unset_userdata('donate_campaign_id');
    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','36','Donation Cancelled!');
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',36);
    $this->data['thanks']=$this->Website_model->GetThankMessages(13);
    $this->load->view('templates/header',$this->data);
    $this->load->view('donation/cancel',$this->data);
    $this->load->view('templates/footer');
  }

  public function unsuccess() {
    $this->session->unset_userdata('donation');
    $this->session->unset_userdata('donate_campaign_id');
    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','37','Donation Unsuccessful!');
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',37);
    $this->data['thanks']=$this->Website_model->GetThankMessages(14);
    $this->load->view('templates/header',$this->data);
    $this->load->view('donation/unsuccess-message',$this->data);
    $this->load->view('templates/footer');
  }

  public function _value_required($field_value,$field) {
    switch($field) {
      case "donor_name" :
        if($field_value == "Name" or $field_value == "") {
          $this->form_validation->set_message('_value_required', 'Please enter your name');
          return false;
        }

        return true;
        break;

      default:
        return true;
        break;
    }
  }

  public function donate() {
    $values=array();
    $values_monthly=array();	
    $caller=$this->input->post('caller');
    $caller2=$this->input->post('caller2');

    if($caller == 'Send') {
      $form_token = $this->session->userdata('form_token');

      if(!isset($form_token)) { $this->RedirectPage(); exit; }
      else if(isset($form_token) && $form_token != 'donation') { $this->RedirectPage(); exit; }

      if(!preg_match('/'.$_SERVER['HTTP_HOST'].'/',$_SERVER['HTTP_REFERER'])) {
        $this->RedirectPage(); exit;
      }	   

      $values['amount']=$this->input->post('amount');
      $this->load->library('form_validation'); 
      $this->form_validation->set_error_delimiters('<span>','</span>');
      $this->form_validation->set_message('required','{field}');
      $this->form_validation->set_message('numeric','Please enter valid amount');
      $this->form_validation->set_rules('amount','Please enter donation amount', 'trim|required|numeric');

      if($this->form_validation->run() == TRUE)
      { 
        $donation=array();
        $donation['amount']=$values['amount'];
        $this->session->unset_userdata('donation');
        $this->session->set_userdata('donation',$donation);
        $this->RedirectPage('donation/donate-process');
        $this->session->unset_userdata('form_token');
      }
    } else if($caller2 == 'Send') {
      $form_token = $this->session->userdata('form_token');

      if(!isset($form_token)) { $this->RedirectPage(); exit; }
      else if(isset($form_token) && $form_token != 'donation') { $this->RedirectPage(); exit; }

      if(!preg_match('/'.$_SERVER['HTTP_HOST'].'/',$_SERVER['HTTP_REFERER'])) {
        $this->RedirectPage(); exit;
      }	   

      $values_monthly['monthly_amount']=$this->input->post('monthly_amount');
      $this->load->library('form_validation'); 
      $this->form_validation->set_error_delimiters('<span>','</span>');
      $this->form_validation->set_message('required','{field}');
      $this->form_validation->set_message('numeric','Please enter valid amount');
      $this->form_validation->set_rules('monthly_amount','Please enter donation amount', 'trim|required|numeric');

      if($this->form_validation->run() == TRUE) { 
        $donation=array();
        $monthly_amount=$values_monthly['monthly_amount'];
        $this->session->unset_userdata('monthly_amount');
        $this->session->set_userdata('monthly_amount',$monthly_amount);
        $this->session->unset_userdata('form_token');
        $this->RedirectPage('recurring/expresscheckout');
      }
    } else {
      $this->session->set_userdata('form_token','donation');
    }

    $this->data['attribute']=$this->Donation_model->GetDonateFormForOneTimeAttributes($values,$this->data['common_settings']['unit_fund']);
    $this->data['attribute_monthly']=$this->Website_model->GetMonthlyDonateFormAttributes($values_monthly,$this->data['common_settings']['unit_fund']);
    $this->websitejavascript->include_footer_js=array('DonationJs','RecurringDonationJs');
    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',38,'Donate');
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',38);
    $this->data['top_text']=$this->Website_model->GetTopText(14);
    $this->data['one_time_donation_form']=$this->load->view('donation/one-time-donation-form',$this->data,true);
    $this->data['monthly_donation_form']=$this->load->view('donation/monthly-donation-form',$this->data,true);
    $this->load->view('templates/header',$this->data);
    $this->load->view('donation/donate-page',$this->data);
    $this->load->view('templates/footer');
  }

  public function donate_process() {
    $donation=array();	  
    $donation=$this->session->userdata('donation');

    if((count($donation) == 0)) {
      $this->RedirectPage();
    } else {
      $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',33,'Redirect to paypal : Please wait...');
      $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',33);

      $this->websitejavascript->include_footer_js=array('DonationProcessJs');
      $this->data['payable_amount']=$donation['amount']; 
      $this->data['back_module']="donation";
      $this->data['succes_page']="donation-success";
      $this->data['item_name']="One time donation";
      $this->load->view('templates/header',$this->data);
      $this->load->view('donation/donation-process',$this->data);
      $this->load->view('templates/footer');
    }
  }

  public function one_year_safe_sleep() {
    $values=array();
    $caller=$this->input->post('caller');

    if($caller == 'Send') {
      $form_token = $this->session->userdata('form_token');

      if(!isset($form_token)) { $this->RedirectPage(); exit; }
      else if(isset($form_token) && $form_token != 'one-time-donation') { $this->RedirectPage(); exit; }

      if(!preg_match('/'.$_SERVER['HTTP_HOST'].'/',$_SERVER['HTTP_REFERER'])) {
        $this->RedirectPage(); exit;
      }	   

      $values['amount']=$this->input->post('amount');
      $this->load->library('form_validation'); 
      $this->form_validation->set_error_delimiters('<span>','</span>');
      $this->form_validation->set_message('required','{field}');
      $this->form_validation->set_message('numeric','Please enter valid amount');
      $this->form_validation->set_rules('amount','Please enter donation amount', 'trim|required|callback__numeric_value');

      if($this->form_validation->run() == TRUE) { 
        $donation=array();
        $donation['amount']=$values['amount'];
        $this->session->unset_userdata('donation');
        $this->session->set_userdata('donation',$donation);
        $this->RedirectPage('donation/donate-process');
        $this->session->unset_userdata('form_token');
      }
    } else {
      $this->session->set_userdata('form_token','one-time-donation');
    }

    $this->data['attribute']=$this->Donation_model->GetDonateFormForOneTimeAttributes($values,$this->data['common_settings']['unit_fund'],365);

    $this->websitejavascript->include_footer_js=array('DonationJs');
    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',39,'Provide one year of safe sleeps');
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',39);
    $this->data['top_text']=$this->Website_model->GetTopText(15);
    $this->data['page_text']=$this->Website_model->GetTopText(16);
    $this->data['one_time_donation_form']=$this->load->view('donation/one-year-safe-sleep-form',$this->data,true);
    $this->load->view('templates/header',$this->data);
    $this->load->view('donation/one-year-safe-sleep',$this->data);
    $this->load->view('templates/footer');
  }

  public function donation_success() {
    $paypal_values=array();

    if(count($_POST) > 0) {
      $paypal_values['txn_id']=$_POST['txn_id'];
      $paypal_values['payer_email']=$_POST['payer_email'];
      $paypal_values['first_name']=$_POST['first_name'];
      $paypal_values['last_name']=$_POST['last_name'];
      $paypal_values['merchant_email']=$_POST['business'];
      $paypal_values['payment_date']=$_POST['payment_date'];
      $paypal_values['payment_get_date']='';
      $paypal_values['paid_amount']=$_POST['mc_gross'];
      $paypal_values['payment_status']=$_POST['payment_status'];

      if(isset($_POST['payment_date']) and !empty($_POST['payment_date'])) {
        $paypal_values['payment_date']=date("Y-m-d H:i:s", strtotime($_POST['payment_date'])); 
      } else $paypal_values['payment_date']=date('Y-m-d H:i:s',mktime());

    } else if(count($_GET) > 0) {
      $paypal_values['txn_id']=$_GET['tx'];
      if(isset($_GET['payer_email'])) $paypal_values['payer_email']=$_GET['payer_email'];
      else $paypal_values['payer_email']='';

      $paypal_values['merchant_email']=$this->data['merchantEmail'];
      $paypal_values['payment_status']=$_GET['st'];
      $paypal_values['payment_get_date']=date('Y-m-d H:i:s',mktime());
      $paypal_values['paid_amount']=$_GET['amt'];
      $paypal_values['payment_status']=$_GET['st'];

      if(isset($_GET['payment_date']) and !empty($_GET['payment_date'])) {
        $paypal_values['payment_date']=date("Y-m-d H:i:s", strtotime($_GET['payment_date'])); 
      } else $paypal_values['payment_date']=date('Y-m-d H:i:s',mktime());
    }

    if(count($paypal_values) > 0) {
      $payment=array();
      $payment['payer_email']=$paypal_values['payer_email'];
      $payment['payment_date']=$paypal_values['payment_date'];
      $payment['paid_amount']=$paypal_values['paid_amount'];
      $payment['transaction_no']=$paypal_values['txn_id'];
      $payment['status']=$paypal_values['payment_status'];
      $payment['donation_type']='one-time-donation';

      if(count($this->user_info) > 0) {
        $payment['registered_user_id']=$this->user_info['id'];
        if(empty($payment['payer_email'])) $payment['payer_email']=$this->user_info['email'];
        if(empty($payment['donor_name'])) $payment['donor_name']=$this->user_info['full_name'];
      } else {
        $payment['donor_name']=$paypal_values['first_name']." ".$paypal_values['last_name'];
      }

      $this->Donation_model->InsertDonationDetails($payment);

      // to admin
      $email = array(
        'message' => $this->load->view('email/onetime_donation_to_admin', $payment, TRUE),
        'subject' => 'A onetime donation has been made!',
        'from' => getenv('EMAIL_SEND_FROM'),
        'to' => getenv('ADMIN_EMAIL'),
        'reply-to' => '<' . $payment['payer_email'] . '> ' . $payment['donor_name']
      );

      $this->SendEmail($email);

      if(!empty($payment['payer_email'])) {
        // to donor
        $email = array(
          'message' => $this->load->view('email/onetime_donation_to_donor', $payment, TRUE),
          'subject' => "You're awesome!",
          'from' => getenv('EMAIL_SEND_FROM'),
          'to' => $payment['payer_email']
        );

        $this->SendEmail($email);
      }

      $this->session->unset_userdata('donation');
    }

    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','34','Donation Successful');
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',34);
    $this->data['thanks']=$this->Website_model->GetThankMessages(11);
    $this->load->view('templates/header',$this->data);
    $this->load->view('donation/success-message',$this->data);
    $this->load->view('templates/footer');
  }     

  public function _numeric_value($amount) {
    $amount=str_replace(",","",$amount);	  

    if(!preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $amount)) {
      $this->form_validation->set_message('_numeric_value', 'Please enter valid amount');
      return false;
    }

    return true;
  } 
}
