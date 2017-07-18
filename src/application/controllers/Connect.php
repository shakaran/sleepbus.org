<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connect extends MY_Controller {
  function __construct() {
    parent :: __construct();
  }

  public function index() {
    $caller=$this->input->post('caller'); 
    $values=array(); 

    if ($caller == "Send") {
      $form_token = $this->session->userdata('form_token');

      if (!isset($form_token)) {
        $this->RedirectPage(); exit;
      } else if(isset($form_token) && $form_token != 'contact') {
        $this->RedirectPage(); exit;
      }
       
      if (!preg_match('/'.$_SERVER['HTTP_HOST'].'/',$_SERVER['HTTP_REFERER'])) {
        $this->RedirectPage(); exit;
      }	   

      $values['name']=$this->input->post('name');
      $values['email']=$this->input->post('email');
      $values['phone']=$this->input->post('phone');
      $values['message']=$this->input->post('message');
      $values['hear_about_us']=$this->input->post('hear_about_us');

      $this->load->library('form_validation'); 
      $this->form_validation->set_message('valid_email','Please enter a valid email id');
      $this->form_validation->set_rules('name','name','trim|callback__value_required[name]');
      $this->form_validation->set_rules('phone','contact number', 'trim|callback__value_required[phone]|callback__validatePhone[contact number]');
      $this->form_validation->set_rules('email','email','trim|callback__value_required[email]|valid_email');

      $this->form_validation->set_rules('hear_about_us','\'How did you find out about us?\'', 'trim|callback__value_required[hear_about_us]');
    
      if($this->form_validation->run() == TRUE) {  
        if($values['message'] == "Message") $values['message']="";
     
        $arrData= array(
            'report_type' => 'Contact-Enquiry' ,
            'name' => $this->commonfunctions->ReplaceSpecialChars($values['name']),
            'email' => $values['email'],
            'contact_no' =>$values['phone'],
            'question' => $values['hear_about_us'],
            'message' => $this->commonfunctions->ReplaceSpecialChars($values['message'])
        );
     
        $this->Website_model->SaveConnect($arrData);
        $this->session->unset_userdata('form_token');	 	 

        $email = array(
          'layout' => 'email/layouts/transactional',
          'body' => $this->load->view('email/user_connect_message', $values, TRUE),
          'subject' => 'A person has connected to sleepbus!',
          'from' => getenv('EMAIL_SEND_FROM'),
          'to' => getenv('ADMIN_EMAIL'),
          'reply-to' => '<' . $values['email'] . '> ' . $values['name']
        );

        $this->SendEmail($email);

        $this->RedirectPage('connect-thanks');
      }
    } else $this->session->set_userdata('form_token','contact');

    $this->data['attribute']=$this->Website_model->ContactFormAttribute($values);
    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','4','Connect');
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',4);
    $this->websitejavascript->include_footer_js=array('ContactUsJs');
    $this->data['contents']=$this->Website_model->GetPageContent(5);

    $this->load->view('templates/header',$this->data);
    $this->load->view('connect/connect',$this->data);
    $this->load->view('templates/footer');
  }

  public function _check_verification_code($code) {
    include("captcha/securimage.php");

    $img = new Securimage();
    $verification = $img->check($code);

    if ($verification == true) {
      return true;
    } 

    $this->form_validation->set_message('_check_verification_code', 'Wrong verfication code');
    return false;
  }

  public function _value_required($field_value,$field) {
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
