<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class User extends MY_Controller {
    function __construct() {
      parent :: __construct();

      $this->UserSessionCheck();
      $this->load->model('User_model');
    }

  public function index() {
    $this->RedirectPage('user/home');
  }

  public function home() {
    $this->data['active_menu']="user-home";	  
    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','25','Welcome to Sleepbus');
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE','25'); 
    $this->data['user_campaigns']=$this->User_model->GetUserCampaigns($this->data['user_info']['id']);
    $this->data['total_raised']=$this->User_model->GetTotalRaisedAmount($this->data['user_info']['id']);

    $this->data['my_donations']=$this->User_model->GetDonationHistory($this->data['user_info']['id']);
    $this->data['user_donation'] = array_sum(array_column($this->data['my_donations'], 'paid_amount')); 

    $this->websitejavascript->include_footer_js=array('SuccessMessageJs');   
    $this->load->view('templates/header',$this->data);
    $this->load->view('user/home',$this->data);
    $this->load->view('templates/footer');
  }

  public function save() {
    $user_details=$this->User_model->GetUserDetails();

    $campaign_records=array();	  
    $campaign_records=$this->session->userdata('campaign_records'); 
    $campaign_records['user_id']= $user_details['id'];
    $campaign_records['campaign_end_date']=$this->commonfunctions->ChangeDateFormat(str_replace("/","-",$campaign_records['campaign_end_date']));
    $birthday_pledge=array();	  
    $birthday_pledge=$this->session->userdata('birthday_pledge');  

    if (count($birthday_pledge) > 0) {

      if ($birthday_pledge['newsletter_subscription'] == '1') {
        $IsSubscribed=$this->Website_model->getIsSubscribed($birthday_pledge['email']);

        if ($IsSubscribed !=true) {
          $data=array('fname'=>$birthday_pledge['full_name'],'email1'=>$birthday_pledge['email']);
          $subscribe=$this->Website_model->InsertSubscribe($data);
          $data1=array('subscriber_id'=>$subscribe,'group_id'=>1);
          $subscribe=$this->Website_model->InsertSubscribeGroup($data1);
        }
      }

      $dob_real_format=$birthday_pledge['dob_real_format'];
      unset($birthday_pledge['newsletter_subscription']); 
      unset($birthday_pledge['dob_real_format']); 
      $birthday_pledge['full_name']=$this->commonfunctions->ReplaceSpecialChars($birthday_pledge['full_name']); 
      $birthday_pledge['user_id']= $user_details['id'];
      $birthday_pledge['date_of_birth']=$this->commonfunctions->ChangeDateFormat($birthday_pledge['date_of_birth']);
      $this->User_model->InsertBirthdayPledge($birthday_pledge);
      $birthday_pledge['dob_real_format']=$dob_real_format;  

      // to admin
      $email = array(
        'message' => $this->load->view('email/birthday_pledge_admin', $birthday_pledge, TRUE),
        'subject' => 'A new person has pledged their birthday!',
        'from' => getenv('EMAIL_SEND_FROM'),
        'to' => getenv('ADMIN_EMAIL'),
        'reply-to' => '<' . $birthday_pledge['email'] . '> ' . $birthday_pledge['full_name']
      );

      $this->SendEmail($email);

      // to user
      $email = array(
        'message' => $this->load->view('email/birthday_pledge_user', $birthday_pledge, TRUE),
        'subject' => "Your birthday is about to changes lives. Here's how.",
        'from' => getenv('EMAIL_SEND_FROM'),
        'to' => $birthday_pledge['email']
      );

      $this->SendEmail($email);
    }

    if (count($campaign_records) > 0) {
      $this->User_model->InsertCampaignRecords($campaign_records);
      $campaign_records['campaign_end_date']=str_replace("-","/",$this->commonfunctions->ChangeDateFormat($campaign_records['campaign_end_date']));
      $campaign_records['campaign_name']=$this->commonfunctions->ReplaceSpecialChars($campaign_records['campaign_name']);
      $campaign_records['email']=$this->data['user_info']['email'];
      $campaign_records['full_name']=$this->data['user_info']['full_name'];
      $campaign_details=$this->User_model->getCampaignName($campaign_records['campaign_type']);
      $campaign_records['campaign_type']=$campaign_details['type_name'];

      // to admin
      $email = array(
        'message' => $this->load->view('email/campaign_message_to_admin', $campaign_records, TRUE),
        'subject' => 'A new campaign has been created!',
        'from' => getenv('EMAIL_SEND_FROM'),
        'to' => getenv('ADMIN_EMAIL'),
        'reply-to' => '<' . $campaign_records['email'] . '> ' . $campaign_records['full_name']
      );

      $this->SendEmail($email);

      // to user
      $email = array(
        'message' => $this->load->view('email/campaign_message_to_user', $campaign_records, TRUE),
        'subject' => "You're awesome. Thank you",
        'from' => getenv('EMAIL_SEND_FROM'),
        'to' => $campaign_records['email']
      );

      $this->SendEmail($email);
    }

    $this->data['thanks']=$this->Website_model->GetThankMessages(7);

    $this->session->unset_userdata('birthday_pledge');
    $this->session->unset_userdata('campaign_records');
    $this->RedirectPage('user/home',$this->data['thanks']['message']);
  }
 
  public function donations() {
    $user_id = $this->data['user_info']['id'];
    $this->data['user_progress'] = array(
        'onetime' => $this->User_model->HasMadeOneTimeDonation($user_id),
        'monthly' => $this->User_model->HasMadeMonthlyDonation($user_id),
        'birthday' => $this->User_model->HasMadeBirthdayPledge($user_id),
        'campaign' => $this->User_model->HasCreatedCampaign($user_id),
    );

    $this->data['my_donations']=$this->User_model->GetDonationHistory($this->data['user_info']['id']);
    $this->data['my_donations_total'] = array_sum(array_column($this->data['my_donations'], 'paid_amount')); 
    $this->data['my_safe_sleeps'] = '';

    if ($this->data['my_donations_total'] > 0) {
        $this->data['my_safe_sleeps'] = (string)number_format((float)$this->data['my_donations_total'] / 27.5, 2, '.', '');
        $this->data['my_safe_sleeps'] .= ' SAFE SLEEPS';
    } 

    $this->load->view('templates/header',$this->data);
    $this->load->view('user/donations');
    $this->load->view('templates/footer');
  }
 
  public function profile() {
    $this->data['active_menu']="user-home";	  
    $values=array();
    $caller=$this->input->post('caller'); 

    if ($caller == "Send") {
      $values['full_name']=$this->input->post('full_name');
      $values['phone']=$this->input->post('phone');
      $values['email']=$this->input->post('email');
      $values['new_email']=$this->input->post('new_email');
      $values['retype_email']=$this->input->post('retype_email');
      $values['current_password']=$this->input->post('current_password');
      $values['new_password']=$this->input->post('new_password');
      $values['retype_password']=$this->input->post('retype_password');
      $this->load->library('form_validation'); 
      $this->form_validation->set_error_delimiters('<span>','</span>');
      $this->form_validation->set_message('required','%s');
      $this->form_validation->set_message('valid_email','Invalid email address');
      $this->form_validation->set_rules('full_name', 'Please enter your name', 'trim|required');  

      if ($values['phone'] != "") {
        $this->form_validation->set_rules('phone', 'Invalid phone number', 'trim|callback__validatePhone');   
      }

      if (!empty($values['new_email'])) {
        $this->form_validation->set_rules('new_email', 'Please enter valid email address', 'trim|valid_email|callback__compareCurrentToNewEmailIds|callback__compareEmailIds['.$values['retype_email'].']|callback__checkUnique');   
      }

      if (!empty($values['current_password'])) {
        $this->form_validation->set_rules('current_password', 'password', 'trim|callback__verify_old_password');	
      }

      if (!empty($values['new_password']) and !empty($values['current_password'])) {
        $this->form_validation->set_rules('new_password', 'password', 'trim|callback__validate_password|callback__verify_retype_password['.$values['retype_password'].']');   
      } elseif (!empty($values['new_password'])) {
        $this->form_validation->set_rules('current_password', 'Please enter current password', 'trim|required');	
      }

      if ($this->form_validation->run() == TRUE) { 
        $records=array();
        $records['full_name']=$values['full_name'];
        $records['phone']=$values['phone'];

        if (!empty($values['new_email'])) $records['email']=$values['new_email'];
        if (!empty($values['new_password']) and !empty($values['current_password'])) $records['password']=md5($values['new_password']);

        $this->User_model->SaveProfileInfo($records);

        if (!empty($values['new_email'])) {
          $this->session->set_userdata('site_username',$values['new_email']);
        }

        if (!empty($values['new_password']) and !empty($values['current_password'])) {
          $this->session->set_userdata('site_password',$values['new_password']);
        }

        $this->RedirectPage('user/profile','Your profile has been updated successfully');
      }
    } else {
      $values=$this->User_model->GetUserDetails();
      $values['new_email']='';
      $values['retype_email']='';
    }

    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','28','Update Profile');
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE','28'); 
    $this->websitejavascript->include_footer_js=array('UserProfileJs','SuccessMessageJs');
    $this->data['total_raised']=$this->User_model->GetTotalRaisedAmount($this->data['user_info']['id']);
    $this->data['user_donation']=$this->User_model->GetUserDonation($this->data['user_info']['id']);
    $this->data['attributes']=$this->User_model->GetProfileFormAttribute($values);
    $this->load->view('templates/header',$this->data);
    $this->load->view('user/user-profile',$this->data);
    $this->load->view('templates/footer');
  }

  public function _validate_password($password) {
    if (strlen($password) < 6) {
      $this->form_validation->set_message('_validate_password', 'Length of password must be of 6 or more characters');
      return false;
    }

    return true;
  }

  public function _verify_retype_password($retype_password,$new_password) {
    if ($retype_password != $new_password) {
      $this->form_validation->set_message('_verify_retype_password', "'New Password' and 'Retype Password' did not match");
      return false;
    }

    return true;
  }

  public function _verify_old_password($password) {
    $current_password=$this->session->userdata('site_password');

    if ($password != $current_password) {
      $this->form_validation->set_message('_verify_old_password', 'Old password did not match');
      return false;
    }

    return true;
  }

  public function _validatePhone($message) {
    if ($message!='') {
      $pattern = '/^[0-9\)\(\+\s]+$/';

      if (!(preg_match($pattern,$message))) {
        $this->form_validation->set_message('_validatePhone', 'Invalid phone number');
        return false;
      }
      
      return true;
    }
    
    return true;
  }
    
  public function _compareEmailIds($new_email,$retype_email) {
    if ($retype_email != $new_email) {
      $this->form_validation->set_message('_compareEmailIds', 'New email and confirmation email did not match');   
      return false;
    }

    return true;
  }

  public function _compareCurrentToNewEmailIds($new_email) {
    $email=$this->session->userdata('site_username');  

    if ($email == $new_email) {
      $this->form_validation->set_message('_compareCurrentToNewEmailIds', 'Current email and new email addresses are same');   
      return false;
    }

    return true;
  }
  
  public function _checkUnique($new_email) {
    if ($this->User_model->CheckUniqueEmail($new_email)) {
      $this->form_validation->set_message('_checkUnique', 'This email id is already registered');   
      return false;
    }

    return true;
  }
}
