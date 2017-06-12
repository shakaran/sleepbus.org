<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Speaker extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
  }
  public function request()
  {
   $caller=$this->input->post('caller'); 
   $values=array(); 
   if($caller == "Send")
   {
	$form_token = $this->session->userdata('form_token');
    if(!isset($form_token)) { $this->RedirectPage(); exit; }
	else if(isset($form_token) && $form_token != 'speaker') { $this->RedirectPage(); exit; }
	   
    if(!preg_match('/'.$_SERVER['HTTP_HOST'].'/',$_SERVER['HTTP_REFERER']))
    {
     $this->RedirectPage(); exit;
    }	   
    $values['name']=$this->input->post('name');
    $values['email']=$this->input->post('email');
    $values['phone']=$this->input->post('phone');
	$values['message']=$this->input->post('message');
	$values['hear_about_us']=$this->input->post('hear_about_us');
    $this->load->library('form_validation'); 
	$this->form_validation->set_message('valid_email','Please enter a valid email id');

    $this->form_validation->set_rules('name','name','trim|callback__value_required[name]');//field name~caption
    $this->form_validation->set_rules('phone','contact number', 'trim|callback__value_required[phone]|callback__validatePhone[contact number]');
    $this->form_validation->set_rules('email','email','trim|callback__value_required[email]|valid_email');

    $this->form_validation->set_rules('hear_about_us','\'how did hear about us?\'', 'trim|callback__value_required[hear_about_us]');

/*	if($values['message'] != "Message" or $values['message'] == "")
	{
     $this->form_validation->set_rules('message','message','trim|callback__validateMessageText[message~message]');		     //field name~caption
	
	}
*/
	
    if($this->form_validation->run() == TRUE)
    {  
	 if($values['message'] == "Message") $values['message']="";
	 
	 $arrData= array(
		   'report_type' => 'speaker-request' ,
		   'name' => $this->commonfunctions->ReplaceSpecialChars($values['name']),
		   'email' => $values['email'],
		   'contact_no' =>$values['phone'],
		   'question' => $values['hear_about_us'],
		   'message' => $this->commonfunctions->ReplaceSpecialChars($values['message'])
	 );
	 
     $this->Website_model->SaveConnect($arrData);

     $this->session->unset_userdata('form_token');	 	 

	 $this->SendMessage($values);
	 $this->RedirectPage('speaker-request-thanks');
	}
   } else $this->session->set_userdata('form_token','speaker');
   $this->data['attribute']=$this->Website_model->SpeakerRequestFormAttribute($values);

   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','5','Speaker Request');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',5);
   // if contact us form submit successfully, then we set the message

   $this->websitejavascript->include_footer_js=array('SpeakerRequestJs');

   $this->data['contents']=$this->Website_model->GetPageContent(6);

   // Send address as an argument to Map address function to get map attributes.

   $this->load->view('templates/header',$this->data);
   $this->load->view('connect/request',$this->data);
   $this->load->view('templates/footer');
  }
  public function _check_verification_code($code)
  {
   include("captcha/securimage.php");
   $img = new Securimage();
   $verification = $img->check($code);
   if($verification==true)
   {
    return true;
   }
   else
   {
    $this->form_validation->set_message('_check_verification_code', 'Wrong verfication code');
	return false;
   }
  }
  public function SendMessage($values)
  {
   if($values['message'] == "Message") $values['message']="";
   $mailBody="<div style='background:#fff;color:#000; padding:10px'> 
	<p style='font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:normal;'>Please follow up on the following enquiry</p> 
    <div style='clear:both;'></div>
    <div style='margin:0px; padding:0px;'>
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;'>Name:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;'>".$values['name']."</div>
		
      <div style='clear:both;'></div>
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;'>Email:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;'>".$values['email']."</div>
      
      <div style='clear:both;'></div>
	  
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;'>Phone:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;'>".$values['phone']."</div>
	<div style='clear:both;'></div>



      
      
      <div style='clear:both;'></div>
    	<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;'>How did you find out about us?:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;'>".$values['hear_about_us']."</div>
	<div style='clear:both;'></div>";
	
	if($values['message'] != "")
	{
     $mailBody.="<div style='float:left; width:200px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;'>Message:</div> <div style='float:left; width:440px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px;'>".$values['message']."</div>";
	}
	 
     $mailBody.="<div style='clear:both;'></div></div></div>";
   
	 $reply_to=array();
	$reply_to['email']=$values['email'];
	$reply_to['name']=$values['name'];
	 
   $this->SendMail($mailBody,$reply_to,2); 
  }
  public function _value_required($field_value,$field)
  {
   switch($field)
   {
    case "name" :
	if($field_value == "Name" or $field_value == "")
	{
	 $this->form_validation->set_message('_value_required', 'Please enter name');
	 return false;
	}
	else return true;
	break;
    case "email" :
    if($field_value == "Email" or $field_value == "")
    {
 	 $this->form_validation->set_message('_value_required', 'Please enter email id');
	 return false;	
	}
	else return true;
	break;
    case "phone" :
    if($field_value == "Phone" or $field_value == "")
    {
 	 $this->form_validation->set_message('_value_required', 'Please enter phone number');
	 return false;	
	}
	else return true;
	break;
    case "hear_about_us" :
    if($field_value == "How did you find out about us?" or $field_value == "")
    {
 	 $this->form_validation->set_message('_value_required', "Please select 'How did you find out about us?'");
	 return false;	
	}
	else return true;
	break;
	default:
	return true;
	break;
   }
  }
  public function _validatePhone($message,$caption)
  {
   if($message!='')
   {
    $pattern = '/^[0-9\)\(\+\s]+$/';
    if(!(preg_match($pattern,$message)))
    {
     $this->form_validation->set_message('_validatePhone', 'Invalid '.$caption);
     return false;
    }
    else return true;
   }
   else return true;
  }    
 }
