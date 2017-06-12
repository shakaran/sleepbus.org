<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Userverification extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
  }
  public function validate()
  {
   $user_id=$this->uri->segment(4);
   $password=$this->uri->segment(5);
   $this->data['status']=$this->Login_model->VerifyUserForActivation($user_id,$password);
   $this->load->view(admin.'/user/user-verification',$this->data);
  }
 }
