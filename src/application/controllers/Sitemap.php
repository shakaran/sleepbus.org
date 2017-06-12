<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sitemap extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
  }
  public function index()
  {
   $this->data['page_heading']=$this->Website_model->GetPageHeading(44);
   $this->data['banner']=$this->Website_model->GetBanner('default','0');
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','7','Sitemap');
   $this->load->view('templates/header',$this->data);
   $this->load->view('sitemap',$this->data);
   $this->load->view('templates/footer');
  }
 }
