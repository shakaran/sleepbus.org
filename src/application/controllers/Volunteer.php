<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Volunteer extends MY_Controller
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
	   
    $values['name']=trim($this->input->post('volunteer_name'));
    $values['email']=trim($this->input->post('volunteer_email'));
	
    $this->load->library('form_validation'); 
    $this->form_validation->set_message('valid_email','Please enter a valid email id');
    $this->form_validation->set_message('required','Please enter %s');
    $this->form_validation->set_rules('volunteer_name','name','trim|required');//field name~caption
    $this->form_validation->set_rules('volunteer_email','email','trim|required|valid_email');

    if($this->form_validation->run() == TRUE) { 
      if(!$this->Website_model->getIsVolunteer($values['email'])) {
        $name=$this->commonfunctions->ReplaceSpecialChars($values['name']);   
        $data=array('fname'=>$values['name'],'email1'=>$values['email']);
        $subscribe=$this->Website_model->InsertVolunteer($data);
        $data1=array('subscriber_id'=>$subscribe,'group_id'=>1);
        $subscribe=$this->Website_model->InsertVolunteerGroup($data1);
      }

      $this->RedirectPage('volunteer-signup-thanks');
   }
    
   }
   // Required for Newsletter Form Attributes in all pages
   $this->data['volunteer_attributes']=$this->Website_model->VolunteerFormAttribute($values);

   $this->data['meta'] = array('page_title' => 'Volunteer with sleepbus');

   $this->load->view('templates/header',$this->data);
   $this->load->view('general-pages/volunteer',$this->data);
   $this->load->view('templates/footer');
  }
 }
