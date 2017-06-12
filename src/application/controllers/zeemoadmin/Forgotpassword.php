<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ForgotPassword extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->helper('form');
   $this->load->library('CommonFunctions');	
   if(!empty($this->admin_id))
   {
	$this->RedirectPage(admin.'/home');
   }
  }
  public function index()
  {
   $this->data['title']="Forgot Password";
   $this->data['success']=$this->session->flashdata('success_message');
   if((empty($this->data['success'])))
   {
    $this->data['attributes']=$this->Login_model->ForgotPasswordAttributes();
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/forgot-password',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validate()
  {
   // Assigning form post values to fields
   $values=array();
   $this->load->library('form_validation');
   $this->form_validation->set_rules('email',"email",'trim|required|valid_email|callback_is_email_exist');

   $this->form_validation->set_error_delimiters('<span>','</span>');
   if($this->form_validation->run() == FALSE)
   {
    $this->index();
   }
   else
   {
	$email=$this->input->post('email');
	$this->SendEmailToSetUpPassword($email);
	$this->RedirectPage(admin."/forgotpassword","Password recovery code sent to your email. <br>Please click through the link to setup your password.");
   }
  }
  public function is_email_exist($email)
  {
   if(!($this->Login_model->CheckEmailId($email)))
   {
    $this->form_validation->set_message('is_email_exist', 'Email address is not registered with us.');
	return false;
   }
   else
   {
	return true;
   }
  } 
  public function SendEmailToSetUpPassword($email)
  {
   $time=md5(time());
   if($this->Login_model->UpdatePasswordRecovery($email,$time))
   {
    $link_url = base_url().admin."/forgotpassword/passwordrecovery/".$time;
    $to = $email;
    $user_details=$this->Login_model->GetAdminDetailsByEmail($email);
    $admin=array();
    if($user_details['user'] == "admin" or $user_details['user'] == "zeemoadmin")
    {
     $admin=$this->Login_model->GetAdminDetails('zeemoadmin');
 	 $best_regards="Zeemo";
    }
    else
    {
     $admin=$this->Login_model->GetAdminDetails();
 	 $best_regards="Admin";
    }
    $from = $admin['email'];
    $subject = "Zeemo - new password setup";
    $to_msg= "Hi ".ucfirst(strtolower(trim($user_details['user']))).",";
  
    $body_msg="";
   
   
    $to_msg= "Hi ".$user_details['user'].",";
    $body_msg.="<br><br>Please click through the following link to setup your new password.<br><br>";
    $body_msg.= "<a href='".$link_url."'>$link_url</a><br><br><br>";
    $from_msg = 'Best Regards,<br /><strong style="font-size:14px;">'.$best_regards.'</strong>';
    $mailMsg3=file_get_contents(base_url()."email-templates/email.html");
    $mailMsg2=str_replace("[[[TO]]]",$to_msg,$mailMsg3);
    $mailMsg1=str_replace("[[[BODY]]]",$body_msg,$mailMsg2);
    $mailMsg=str_replace("[[[FROM]]]",$from_msg,$mailMsg1);
      
 

    $this->load->library('email');
    $this->email->from($from, $best_regards);
    $this->email->to($to); 
    $this->email->subject($subject);
    $this->email->set_mailtype('html');
    $this->email->message($mailMsg);	
    $this->email->send();   
    $this->email->clear();
   }
  } 
  public function passwordrecovery($password_recovery='')
  {
   $this->data['title']="Password Recovery";
   $this->data['password_recovery']=$password_recovery;
   if(!$this->Login_model->ConfirmPasswordRecoveryCode($password_recovery))  
   {
    $this->data['error_message']="Wrong password recovery code.";
   }
   else
   {
    $this->data['attributes']=$this->Login_model->PasswordRecoveryAttributes();
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/forgot-password-step3',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function recoveryvalidation()
  {
   $this->data['title']="Password Recovery";
   $this->data['password_recovery']=$this->input->post('password_recovery');
   $this->load->library('form_validation');
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_rules('password',"password",'trim|required|callback_validate_password');
   $this->form_validation->set_rules('confirm_password', 'confirm password', 'trim|required|callback_Compare_password_comfirm_password');
   
   if($this->form_validation->run() == FALSE)
   {
    $this->passwordrecovery($this->data['password_recovery']);
   }
   else
   {
	$records['password']=md5($this->input->post('password'));
	$this->Login_model->SetUpdatePassword($records,$this->data['password_recovery']);
	$success_message="<b>Password setup successfully.</b><br><a href='".base_url().admin."/login' style='color:#F3791F'>Click here</a> to go to login page.";
	$this->RedirectPage(admin."/forgotpassword",$success_message);
   }
  }
  public function validate_password()
  {
   $password=$this->input->post('password');
   if(!$this->commonfunctions->ValidatePassword($password))
   {
    $this->form_validation->set_message('validate_password', 'Password must be a combination of upper, lower, digit and special characters');
	return false;
   }
   else
   {
    return true;
   }
  }
  public function Compare_password_comfirm_password()
  {
   $password=$this->input->post('password');
   $confirm_password=$this->input->post('confirm_password');
   if(!empty($password) and !empty($confirm_password) and ($password != $confirm_password))
   {
    $this->form_validation->set_message('Compare_password_comfirm_password', 'Password and confirm password did not matched');
	return false;
   }
   else
   {
    return true;
   }
  } 

 }
