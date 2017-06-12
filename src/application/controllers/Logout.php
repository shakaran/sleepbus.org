<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Logout extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
  // $this->UserSessionCheck();
   $this->load->model('User_model');
  }
  public function index($values=array())
  {
   $this->session->unset_userdata('site_username');
   $this->session->unset_userdata('site_password');
   $this->RedirectPage('signin');
  // header("location:".base_url()."home");
  // exit;  
  }
 }
