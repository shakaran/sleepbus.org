<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller
{
    public $site_username;
    public $site_password;


    function __construct()
    {
        parent :: __construct();

        $user_id=$this->session->userdata('site_username');

        if(!empty($user_id)) {
            $this->RedirectPage('user/home');
        }

        $this->data['active_menu'] = "account";
    }


    public function signin()
    {
        $values=array();

        $caller=$this->input->post('caller');

        $this->data['active_menu'] = "signin";

        if($caller == "Send") {
            $values['site_username'] = $this->input->post('site_username');
            $values['site_password'] = $this->input->post('site_password');

            $this->site_username = $this->input->post('site_username');
            $this->site_password = $this->input->post('site_password');

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<span>','</span>');
            $this->form_validation->set_message('required','%s');
            $this->form_validation->set_rules('site_username', 'Please enter username', 'trim|callback__validate_user');

            if($this->form_validation->run() == TRUE) {
                $session_values = array("site_username" => $this->site_username, "site_password" => $this->site_password);
                $this->session->set_userdata($session_values);

                $campaign_records = array();
                $campaign_records = $this->session->userdata('campaign_records');

                $birthday_pledge = array();
                $birthday_pledge = $this->session->userdata('birthday_pledge');

                if((count($campaign_records) > 0) or (count($birthday_pledge) > 0)) {
                    $this->RedirectPage('user/save');
                } else {
                    $this->RedirectPage('user/home');
                }
            }
        }



        $this->data['meta'] = $this->Metatags_model->GetMetaTags('SINGLE_PAGE', '22', 'Sign In');
        $this->data['cta'] = $this->Website_model->GetCTAButtons('SINGLE_PAGE', '22');

        $this->websitejavascript->include_footer_js = array('AccountSignInJs');

        $this->data['attributes'] = $this->Account_model->GetSignInFormAttributes($values);
        $this->data['page_heading'] = $this->Website_model->GetPageHeading(3);

        $this->load->view('templates/header', $this->data);
        $this->load->view('account/signin', $this->data);
        $this->load->view('templates/footer');
    }


    public function _validate_user() {
        $this->user_info = $this->Account_model->CheckUser($this->site_username, $this->site_password);

        if(count($this->user_info) == 0) {
            $this->form_validation->set_message('_validate_user', 'Invalid username / password.');

            $this->user_info = array();

            return false;
        } else {
            return true;
        }
    }

    public function signup($type='', $package_id='')
    {
        $values = array();
        $caller = $this->input->post('caller');

        if ( $caller == "Send" ) {
            $form_token = $this->session->userdata('form_token');

            if ( !isset($form_token) ) {
                $this->RedirectPage(); exit;
            } else if( isset($form_token ) && $form_token != 'signup') {
                $this->RedirectPage(); exit;
            }

            if( !preg_match('/'.$_SERVER['HTTP_HOST'].'/',$_SERVER['HTTP_REFERER']) ) {
                $this->RedirectPage(); exit;
            }

            $values['full_name'] = $this->input->post('full_name');
            $values['email'] = $this->input->post('email');
            $values['password'] = $this->input->post('password');
            $values['account_type'] = $this->input->post('account_type');
            $values['other_type'] = $this->input->post('other_type');
            $values['newsletter_subscription'] = $this->input->post('newsletter_subscription');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_message('required', '%s');
            $this->form_validation->set_message('is_unique', "This email address is already registered.<br /> Have you <a href='".base_url()."forgot-password'>forgotten your password</a>?");
            $this->form_validation->set_message('valid_email', 'Invalid email address');

            $this->form_validation->set_rules('full_name', 'Please enter your name', 'trim|callback__value_required[full_name]');
            $this->form_validation->set_rules('email', 'Please enter email', 'trim|required|valid_email|is_unique['.USERS.'.email]');
            $this->form_validation->set_rules('password', 'Please enter password', 'callback__value_required[password]|callback__validate_password');

            if( $values['account_type'] == "other" ) {
                $this->form_validation->set_rules('other_type', 'Please specify your other type', 'trim|required');
            }

            if ( $this->form_validation->run() == TRUE ) {
                $records=array();
                $records['full_name'] = $this->commonfunctions->ReplaceSpecialChars($values['full_name']);
                $records['email'] = $values['email'];
                $records['password'] = password_hash($values['password'], PASSWORD_DEFAULT);
                $records['account_type'] = $values['account_type'];

                if ( $records['account_type'] == "other" ) {
                    $records['other_type'] = $this->commonfunctions->ReplaceSpecialChars($values['other_type']);
                }

                $this->Account_model->InsertUserInformation($records);

                if ( $values['newsletter_subscription'] == '1' ) {
                    $IsSubscribed = $this->Website_model->getIsSubscribed($records['email']);

                    if ( $IsSubscribed != true ) {
                        $data = array('fname' => $this->commonfunctions->ReplaceSpecialChars($records['full_name']), 'email1' => $records['email']);

                        $subscribe = $this->Website_model->InsertSubscribe($data);
                        $data1 = array('subscriber_id' => $subscribe, 'group_id' => 1);
                        $subscribe = $this->Website_model->InsertSubscribeGroup($data1);
                    }
                }

                $session_values = array("site_username" => $values['email'], "site_password" => $values['password']);
                $this->session->set_userdata($session_values);

                if ( !empty($records['account_type']) and ($records['account_type'] != "other") ) {
                    $account = $this->Account_model->GetAccountTypeDetails($records['account_type']);
                    $records['account_type'] = $account['type_name'];
                }

                // to admin
                $email = array(
                  'layout' => 'email/layouts/transactional',
                  'body' => $this->load->view('email/user_signup_confirmation_admin', $records, TRUE),
                  'subject' => 'A new user has joined the sleepbus family!',
                  'from' => getenv('EMAIL_SEND_FROM'),
                  'to' => getenv('ADMIN_EMAIL')
                );

                $this->SendEmail($email);

                // to user
                $email = array(
                  'layout' => 'email/layouts/transactional',
                  'body' => $this->load->view('email/user_signup_confirmation', $records, TRUE),
                  'subject' => 'Thank you for signing up to sleepbus!',
                  'from' => getenv('EMAIL_SEND_FROM'),
                  'to' => $values['email']
                );

                $this->SendEmail($email);

                $this->session->unset_userdata('form_token');
                $campaign_records = array();
                $campaign_records = $this->session->userdata('campaign_records');
                $birthday_pledge = array();
                $birthday_pledge = $this->session->userdata('birthday_pledge');
                
                if( (count($campaign_records) > 0) or (count($birthday_pledge) > 0) ) {
                    $this->RedirectPage('user/save');
                } else {
                    $this->RedirectPage('user/home');
                }
            }

        } else {  // if ($caller == "Send")
					$this->session->set_userdata('form_token', 'signup');
    		}

    $this->data['page_heading'] = $this->Website_model->GetPageHeading(1);
    $this->data['meta'] = $this->Metatags_model->GetMetaTags('SINGLE_PAGE', '23', 'Sign Up');
    $this->data['cta'] = $this->Website_model->GetCTAButtons('SINGLE_PAGE', '23');
    $this->websitejavascript->include_footer_js = array('AccountSignUpJs');
    $this->data['attributes'] = $this->Account_model->GetSignUpFormAttributes($values);
    $this->load->view('templates/header', $this->data);
    $this->load->view('account/signup', $this->data);
    $this->load->view('templates/footer');
}


public function _check_verification_code($code) {
    include("captcha/securimage.php");

    $img = new Securimage();

    $verification = $img->check($code);

    if($verification==true) {
        return true;
    } else {
        $this->form_validation->set_message('_check_verification_code', 'Wrong verification code');

        return false;
    }
}


public function _validate_password($password) {
    if(strlen($password) < 6) {
        $this->form_validation->set_message('_validate_password', 'Length of password must be of 6 or more characters');

        return false;
    } else {
      return true;
  }
}


public function reset_password($reset_link) {
    if($this->Account_model->CheckResetLink($reset_link)) {
        $values=array();

        $this->data['reset_link']=$reset_link;

        $caller=$this->input->post('caller');

        if ($caller == "Send") {
            $values['reset_password'] = $this->input->post('reset_password');
            $values['retype_password'] = $this->input->post('retype_password');

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_message('required', '%s');
            $this->form_validation->set_rules('reset_password', 'Please enter password', 'trim|required|callback__compare_passwords['. $values['retype_password'].']');
            $this->form_validation->set_rules('retype_password', 'Please retype password', 'trim|required');

            if ($this->form_validation->run() == TRUE)
            {
                $records['reset_link'] = '';
                $records['password'] = password_hash($values['reset_password'], PASSWORD_DEFAULT);

                $this->Account_model->ResetUserPassword($records, $this->data['reset_link']);
                $this->RedirectPage('reset-password-thanks');
            }
        }

        $this->data['meta'] = $this->Metatags_model->GetMetaTags('SINGLE_PAGE', '27', 'Reset Password');
        $this->data['cta'] = $this->Website_model->GetCTAButtons('SINGLE_PAGE', '27');

        $this->websitejavascript->include_footer_js = array('AccountSignInJs');
        $this->data['attributes'] = $this->Account_model->GetResetPasswordFormAttributes($values);
        $this->data['page_heading'] = $this->Website_model->GetPageHeading(7);

        $this->load->view('templates/header', $this->data);
        $this->load->view('account/reset-password', $this->data);
        $this->load->view('templates/footer');
    } else { // if($this->Account_model->CheckResetLink($reset_link))
        $this->error();
    }
}


public function _compare_passwords($password, $retype_password) {
    if($password != $retype_password) {
        $this->form_validation->set_message('_compare_passwords', 'New password and retype password don\'t match');

        return false;
    } else {
      return true;
  }
}


public function _value_required($field_value, $field) {
    switch($field) {
        case "full_name":

        if($field_value == "Enter your full name" or $field_value == "") {
            $this->form_validation->set_message('_value_required', 'Please enter name');

            return false;
        } else {
            return true;
        }

        break;


        case "password":

        if($field_value == "Enter a password" or $field_value == "") {
            $this->form_validation->set_message('_value_required', 'Please enter password');

            return false;
        } else {
            return true;
        }

        break;


        default:
        return true;
        break;
    }
}

public function forgot_password() {
    $values = array();

    $caller = $this->input->post('caller');

    $this->data['message_settings'] = "";
    if ($caller == "Send") {
        $values['email'] = $this->input->post('email');

        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_message('required', '%s');
        $this->form_validation->set_message('valid_email', 'Invalid email address');
        $this->form_validation->set_rules('email', 'Please enter email', 'trim|required|valid_email|callback__is_exist');

        if ($this->form_validation->run() == TRUE) {
            $records = array();
            $records['reset_link'] = bin2hex(openssl_random_pseudo_bytes(32));

            $this->Account_model->UpdateForgotPassword($records, $values['email']);
						$values['reset_link'] = $records['reset_link'];

            $email = array(
              'layout' => 'email/layouts/transactional',
              'body' => $this->load->view('email/password_reset', $records, TRUE),
              'subject' => 'sleepbus: Password oops',
              'from' => getenv('EMAIL_SEND_FROM'),
              'to' => $values['email']
            );

            $this->SendEmail($email);

            $this->RedirectPage('forgot-password-thanks');
        }
    }


    $this->data['meta'] = $this->Metatags_model->GetMetaTags('SINGLE_PAGE', '24', 'Forgot Password');

    $this->data['cta'] = $this->Website_model->GetCTAButtons('SINGLE_PAGE', '24');

    $this->data['page_heading'] = $this->Website_model->GetPageHeading(5);

    $this->websitejavascript->include_footer_js = array('AccountSigninJs');

    $this->data['attributes'] = $this->Account_model->GetForgotPasswordFormAttributes($values);

    $this->load->view('templates/header', $this->data);
    $this->load->view('account/forgot-password', $this->data);
    $this->load->view('templates/footer');
}


public function _is_exist($email) {
    if($this->Account_model->IsUserExist($email)) {
        return true;
    } else {
        $this->form_validation->set_message('_is_exist', "This email address is not registered with us");

        return false;
    }
	}


}
