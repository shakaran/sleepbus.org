<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Enewsletter extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
  }
  public function index()
  {

   $caller=$this->input->post('caller'); 
   $values=array(); 
   if($caller == "Send")
   {
    if(!preg_match('/'.$_SERVER['HTTP_HOST'].'/',$_SERVER['HTTP_REFERER']))
    {
     $this->RedirectPage(); exit;
    }	   
	   
    $values['name']=trim($this->input->post('newsletter_name'));
    $values['email']=trim($this->input->post('newsletter_email'));
	
    $this->load->library('form_validation'); 
    $this->form_validation->set_message('valid_email','Please enter a valid email id');
    $this->form_validation->set_message('required','Please enter %s');
    $this->form_validation->set_rules('newsletter_name','name','trim|required');//field name~caption
    $this->form_validation->set_rules('newsletter_email','email','trim|required|valid_email');

    if($this->form_validation->run() == TRUE)
    { 
     //mailchimp integration 
/*	 $this->load->library('Mcapi');
	 $list_id = "0af5fb2649";
	 $mergeVars = array('FNAME'=>$values['name'],'LNAME'=>'');
	 $this->mcapi->listSubscribe($list_id, $values['email'], $mergeVars);
*/	
     if(!$this->Website_model->getIsSubscribed($values['email']))
     {
 	  $name=$this->commonfunctions->ReplaceSpecialChars($values['name']);   
      $data=array('fname'=>$values['name'],'email1'=>$values['email']);
      $subscribe=$this->Website_model->InsertSubscribe($data);
      $data1=array('subscriber_id'=>$subscribe,'group_id'=>1);
      $subscribe=$this->Website_model->InsertSubscribeGroup($data1);
     }
     $this->RedirectPage('enewsletter-thanks');
    }
    //else { $this->RedirectPage(); exit;}
    
   }
   // Required for Newsletter Form Attributes in all pages
   $this->data['newsletter_attributes']=$this->Website_model->NewsLetterFormAttribute($values);

   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','13','eNewsletter Singup');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',13);   
   $this->data['contents']=$this->Website_model->GetPageContent(7);
   $this->load->view('templates/header',$this->data);
   $this->load->view('general-pages/enewsletter-signup',$this->data);
   $this->load->view('templates/footer');
  }
 }
