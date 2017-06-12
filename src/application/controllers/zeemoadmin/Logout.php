<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
  }
  public function index($values=array())
  {
   $this->session->unset_userdata('username');
   $this->session->unset_userdata('password');
   $this->session->unset_userdata('login_time');
   $this->session->unset_userdata('level_id');
   $this->session->unset_userdata('user_id'); 
   $this->session->set_flashdata('success_message','User logged out successfully');
   header("location:".base_url().admin."/login");
   exit;  
  }
 }
