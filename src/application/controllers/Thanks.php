<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Thanks extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
  }
  public function connect_thanks()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','14','Thank You');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',14);
   $this->data['thanks']=$this->Website_model->GetThankMessages(1);

   $this->load->view('templates/header',$this->data);
   $this->load->view('thanks/thanks',$this->data);
   $this->load->view('templates/footer');
  }
  public function speaker_request_thanks()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','16','Thank You');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',16);
   $this->data['thanks']=$this->Website_model->GetThankMessages(2);

   $this->load->view('templates/header',$this->data);
   $this->load->view('thanks/thanks',$this->data);
   $this->load->view('templates/footer');
  }
  public function forgot_password_thanks()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','24','Thank You');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',24);
   $this->data['thanks']=$this->Website_model->GetThankMessages(4);

   $this->load->view('templates/header',$this->data);
   $this->load->view('thanks/thanks',$this->data);
   $this->load->view('templates/footer');
  }
  public function reset_password_thanks()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','27','Thank You');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',27);
   $this->data['thanks']=$this->Website_model->GetThankMessages(5);

   $this->load->view('templates/header',$this->data);
   $this->load->view('thanks/thanks',$this->data);
   $this->load->view('templates/footer');
  }
  
  public function enewsletter_thanks()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','13','eNewsletter Thanks');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',13);
   $this->data['thanks']=$this->Website_model->GetThankMessages(3);

   $this->load->view('templates/header',$this->data);
   $this->load->view('thanks/thanks',$this->data);
   $this->load->view('templates/footer');
  }
 }
