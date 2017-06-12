<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Support extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->library('CommonFunctions');
   $this->load->model('Support_model');
  }
  public function index()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',17,'Corporate Support');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',17);
   $this->data['all_supports']=$this->Support_model->GetAllSupports();
   $this->data['top_text']=$this->Website_model->GetTopText(3);
   $this->data['our_support']=$this->Website_model->GetTopText(4);
   $this->data['support_items']=$this->load->view('corporate-support/support-item',$this->data,true);
   $this->load->view('templates/header',$this->data);
   $this->load->view('corporate-support/corporate-support',$this->data);
   $this->load->view('templates/footer');
  }
 }
