<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Notification extends MY_Controller
 {
  public $uploading_image_info;
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Notificaiton_model');
   $this->load->helper('form');
  }
  public function setup_email_notification($page_id='',$values=array()) // Auto Email Notification
  {
   $this->SetUpCkeditor(); 
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateNotificationFormJs');
   $this->data['page_id']=$page_id;
   if(!empty($page_id))
   {
    $values=$this->Notificaiton_model->GetPageInformation($page_id);
    $this->data['last_modified']=$this->Login_model->LastModify(AUTO_EMAIL_NOTIFICATION,$page_id);
   }
   if(count($values) == 0)
   {
    $values=array();
	$values['message']="";
	$values['subject']="";	
	$values['sender_email']="";	
   }

   $this->data['attributes']=$this->Notificaiton_model->GetPageFormAttribute($values);
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/notification/auto-email-notification',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validateemailmessages()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('notification/setup-email-notification');
   $this->data['active_submodule']="setup-email-notification";
   $values=array();
   $values['title']="Validate Message";
   $values['message']=$this->input->post('message');
   $values['subject']=$this->input->post('subject');
   $values['sender_email']=$this->input->post('sender_email');
   $values['page_id']=$this->input->post('page_id');
   
   $this->load->library('form_validation');
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required', '{field}', 'trim|required');
   $this->form_validation->set_message('valid_email','Invalid email address');

   $this->form_validation->set_rules('subject', 'Please enter subject', 'trim|required');   
   $this->form_validation->set_rules('sender_email', 'Please enter email address', 'trim|required|valid_email');   
   $this->form_validation->set_rules('message', 'Please enter message', 'trim|required');   
   
   if($this->form_validation->run() == TRUE)
   { 
    $records['message']=$values['message'];
    $records['subject']=$values['subject'];
    $records['sender_email']=$values['sender_email'];
    $this->Notificaiton_model->UpdateRecords($records,$values['page_id']);
    $this->RedirectPage(admin.'/notification/setup-email-notification/'.$values['page_id'],'Message updated successfully');
   }
   else
   {
    $this->setup_email_notification($values['page_id'],$values);
   }
  }
  public function email_messages($page_id='')
  {
   $this->SetUpCkeditor(); 
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateNotificationFormJs');
   $this->data['page_id']=$page_id;
   $this->data['caller']=$this->input->post('caller');
   $values=array();
   if($this->data['caller'] == "submit")
   {
	$values['page_id']=$this->input->post('page_id');
	$values['message']=$this->input->post('message');
	$values['subject']=$this->input->post('subject');
	$values['sender_email']=$this->input->post('sender_email');
	$values['sender_name']=$this->input->post('sender_name');
	$values['receiver_to_emails']=$this->input->post('receiver_to_emails');
	$values['receiver_cc_emails']=$this->input->post('receiver_cc_emails');
	$values['receiver_bcc_emails']=$this->input->post('receiver_bcc_emails');
	$values['receiver']=$this->input->post('receiver');
	$this->data['receiver']=$values['receiver'];
	
    $this->load->library('form_validation'); 
    $this->form_validation->set_error_delimiters('<span>','</span>');
	$this->form_validation->set_message('required','please enter {field}');
    $this->form_validation->set_rules('message', 'Please enter message', 'trim|required');
    $this->form_validation->set_rules('subject', 'Please enter subject', 'trim|required');
	$this->form_validation->set_message('valid_email','Invalid email address');


	if($values['receiver'] == '1')
	{
     $this->form_validation->set_rules('receiver_to_emails','receiver email id','trim|required|valid_emails');
     if(!empty($values['receiver_cc_emails']))
     {
      $this->form_validation->set_rules('receiver_cc_emails','Please enter receiver email id to cc','valid_emails');
     }
     if(!empty($values['receiver_bcc_emails']))
     {
      $this->form_validation->set_rules('receiver_bcc_emails','Please enter receiver email id to bcc','valid_emails');
     }
	}
	else
	{
	 $values['receiver_to_emails']='';
	 $values['receiver_cc_emails']='';
	 $values['receiver_bcc_emails']='';

	}
    if(!empty($values['sender_email']) or !empty($values['sender_name']))
    {
     $this->form_validation->set_rules('sender_email', 'sender email id','trim|required|valid_email');
     $this->form_validation->set_rules('sender_name', 'sender name', 'trim|required');
    
	}
   
    if($this->form_validation->run() == TRUE)
    { 
	 $records['message']=$values['message'];
	 $records['subject']=$values['subject'];
	 $records['sender_email']=$values['sender_email'];
	 $records['sender_name']=$values['sender_name'];
	 $records['receiver_to_emails']=$values['receiver_to_emails'];
 	 $records['receiver_cc_emails']=$values['receiver_cc_emails'];
 	 $records['receiver_bcc_emails']=$values['receiver_bcc_emails'];
	 $records['receiver']=$values['receiver'];
	
     $this->Notificaiton_model->UpdateEmailRecords($records,$values['page_id']);
     $this->RedirectPage(admin.'/notification/email-messages/'.$values['page_id'],'Message updated successfully');
	}
   }
   elseif(!empty($page_id))
   {
    $values=$this->Notificaiton_model->GetEmailInformation($page_id);
    $this->data['last_modified']=$this->Login_model->LastModify(EMAIL_MESSAGES,$page_id);
	$this->data['receiver']=$values['receiver'];
   }
   $this->data['attributes']=$this->Notificaiton_model->GetEmailPageFormAttribute($page_id,$values);

   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/notification/email-messages',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function thankyou_messages($page_id='')
  {
   $this->SetUpCkeditor(); 
   $this->data['page_id']=$page_id;
   $this->data['caller']=$this->input->post('caller');
   $values=array();
   if($this->data['caller'] == "submit")
   {
	$values['page_id']=$this->input->post('page_id');   
    $values['message']=$this->input->post('message');
    $this->load->library('form_validation'); 
    $this->form_validation->set_error_delimiters('<span>','</span>');
	$this->form_validation->set_message('required','{field}');
    $this->form_validation->set_rules('message', 'Please enter message', 'trim|required');

    if($this->form_validation->run() == TRUE)
    { 
  	 $records=array();
     $records['message']=$values['message'];
     $this->Notificaiton_model->UpdateThankYouMessage($records,$values['page_id']);
     $this->RedirectPage(admin.'/notification/thankyou-messages/'.$values['page_id'],'Message updated successfully');
	}
   }
   elseif(!empty($page_id))
   {
    $values=$this->Notificaiton_model->GetThankYouPageInformation($page_id);
    $this->data['last_modified']=$this->Login_model->LastModify(THANK_MESSAGES,$page_id);
   }

   $this->data['attributes']=$this->Notificaiton_model->GetThankYouPageFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateNotificationFormJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/notification/thankyou-messages',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  
  public function sender_information()
  {
   $this->SetUpCkeditor(); 
   $this->data['caller']=$this->input->post('caller');
   $values=array();
   if($this->data['caller'] == "submit")
   {
	$values['sender_email']=$this->input->post('sender_email');   
    $values['sender_name']=$this->input->post('sender_name');
    $this->load->library('form_validation'); 
    $this->form_validation->set_error_delimiters('<span>','</span>');
	$this->form_validation->set_message('required','{field}');
	$this->form_validation->set_message('valid_email','Invalid email address');

    $this->form_validation->set_rules('sender_email', 'Please enter sender email address','trim|required|valid_email');
    $this->form_validation->set_rules('sender_name', 'Please enter sender name', 'trim|required');


    if($this->form_validation->run() == TRUE)
    { 
  	 $records=array();
     $records['sender_name']=$values['sender_name'];
     $records['sender_email']=$values['sender_email'];
	 
     $this->Notificaiton_model->UpdateSenderInformation($records);
     $this->RedirectPage(admin.'/notification/sender-information','Sender information updated successfully');
	}
   }
   else
   {
    $values=$this->Notificaiton_model->GetSenderInformation();
    $this->data['last_modified']=$this->Login_model->LastModify(COMMON_SETTINGS);
   }

   $this->data['attributes']=$this->Notificaiton_model->GetSenderInformationFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateNotificationFormJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/notification/sender-information',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  
 }
