<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends MY_Controller
 {
  public $username;
  public $password;
  function __construct()
  {
   parent :: __construct();
   $this->load->helper('form'); 
   if(!empty($this->admin_id))
   {
	$this->RedirectPage(admin.'/home');
   }
  }
  public function index($values=array())
  {
	 //if(isset())
	 //$this->data['success_message']=$this->session->flashdata('success_message');
	 $this->data['title']="Admin Login";
	 $this->data['attributes']=$this->Login_model->FieldAttributes($values);
	 $this->data['captions']=$this->Login_model->FormCaptions();
	 
	 
 	 $this->load->view(admin.'/templates/header',$this->data);
	 $this->load->view(admin.'/login_form',$this->data);
	 $this->load->view(admin.'/templates/footer');
	}
	public function validate()
	{
	 // Assigning form post values to fields
     $values=array();
     $this->username=$this->input->post('username');
     $this->password=$this->input->post('password');
	 $this->load->library('form_validation');
     $this->form_validation->set_rules('user_pass',"user_pass",'callback_validate_user');

	 $this->form_validation->set_error_delimiters('<span>','</span>');
     
	  if($this->form_validation->run() == FALSE)
	  {
	   $this->index($values);
	  }
	  else
	  {
	   $session_values=array("username"=>$this->username,"password"=>$this->password,"login_time"=>time());
	   $this->session->set_userdata($session_values);
	   if($this->input->post('remember'))
	   {
	    $cookie_username=array("name"=>'username',"value"=>$this->username,"expire"=>'86500');
	    $cookie_password=array("name"=>'password',"value"=>$this->password,"expire"=>'86500');
	    $cookie_remember=array("name"=>'remember',"value"=>'yes',"expire"=>'86500');
		set_cookie($cookie_username);
		set_cookie($cookie_password);
		set_cookie($cookie_remember);
	   }
	   else
	   {
	    delete_cookie('username');
	    delete_cookie('password');
	    delete_cookie('remember');
	   }
	  $this->RedirectPage(admin.'/home','');
	 }
    }
   	public function validate_user()
	{
	 if(count($this->Login_model->CheckUser($this->username,$this->password)) == 0)
	 {
      $this->form_validation->set_message('validate_user', 'Invalid username password.');
	  return false;
	 }
	 else
	 {
	  return true;
	 }
	}  
  }
