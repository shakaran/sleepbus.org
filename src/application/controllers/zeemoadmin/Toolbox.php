<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
 class Toolbox extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Toolbox_model');
   $this->load->helper('form');
   $this->load->library('form_validation');
   $this->load->library('CommonFunctions');
  }
  public function toptext()
  {
   $submit_value=$this->input->post('submit_form');
   $values=array();
   if(!empty($submit_value))
   {
	$records['content']=$this->input->post('content');
    $this->Login_model->UpdateTopText($records,8);
	$this->RedirectPage(admin.'/toolbox/toptext','Top text has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(8);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,8);
   $this->data['attributes']=$this->Toolbox_model->GetTopTextFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/toolbox/top-text',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function branding_content()
  {
   $submit_value=$this->input->post('submit_form');
   $values=array();
   if(!empty($submit_value))
   {
	$records['content']=$this->input->post('content');
    $this->Login_model->UpdateTopText($records,9);
	$this->RedirectPage(admin.'/toolbox/branding-content','Branding content has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(9);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,9);
   $this->data['attributes']=$this->Toolbox_model->GetTopTextFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/toolbox/branding',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function videos()
  {
   $submit_value=$this->input->post('submit_form');
   $values=array();
   if(!empty($submit_value))
   {
	$records['content']=$this->input->post('content');
    $this->Login_model->UpdateTopText($records,10);
	$this->RedirectPage(admin.'/toolbox/videos','Video content has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(10);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,10);
   $this->data['attributes']=$this->Toolbox_model->GetTopTextFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/toolbox/videos',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function facebook_timeline()
  {
   $submit_value=$this->input->post('submit_form');
   $values=array();
   if(!empty($submit_value))
   {
	$records['content']=$this->input->post('content');
    $this->Login_model->UpdateTopText($records,11);
	$this->RedirectPage(admin.'/toolbox/facebook-timeline','Facebook timeline content has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(11);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,11);
   $this->data['attributes']=$this->Toolbox_model->GetTopTextFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/toolbox/facebook-timeline',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function twitter_backgrounds()
  {
   $submit_value=$this->input->post('submit_form');
   $values=array();
   if(!empty($submit_value))
   {
	$records['content']=$this->input->post('content');
    $this->Login_model->UpdateTopText($records,12);
	$this->RedirectPage(admin.'/toolbox/twitter_backgrounds','Twitter background content has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(12);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,12);
   $this->data['attributes']=$this->Toolbox_model->GetTopTextFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/toolbox/twitter-backgrounds',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  
 }

