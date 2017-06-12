<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Testnewheader extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->library('CommonFunctions');
  }

  public function index()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',6,'About Us');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',6);
   $this->data['contents']=$this->Website_model->GetPageContent(2);
   $this->load->view('templates/newheader',$this->data);
   $this->load->view('general-pages/about-us',$this->data);
   $this->load->view('templates/footer');
  }

  
 }
