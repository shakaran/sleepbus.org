<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Faq extends MY_Controller
 {
  public $uploading_image_info;
  public $uploading_brochure_info;
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Faq_model');
   $this->load->helper('form');
   $this->load->library('CommonFunctions');	
  }
  public function toptext()
  {
   $submit_value=$this->input->post('submit_form');
   $values=array();
   if(!empty($submit_value))
   {
	$records['content']=$this->input->post('content');
    $this->Login_model->UpdateTopText($records,1);
	$this->RedirectPage(admin.'/faq/toptext','Bottom text has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(1);    
   }
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,1);
   $this->data['attributes']=$this->Faq_model->GetTopTextFormAttribute($values);
   
   $this->SetUpCkeditor();
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/faq/top-text',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
 
  public function add_faq($values=array())
  {
   //for ckeditor   
   $this->SetUpCkeditor(); 
	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateFaqFormJs');
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
   }
   else
   {
    $values['question']="";
    $values['answer']="";
	$this->data['page_title']="Add FAQ";
   }
   if(!empty($this->data['faq_id']))
   {
    $this->data['attributes']=$this->Faq_model->GetFaqFormAttribute($values,$this->data['faq_id']);
   }
   else
   {
    $this->data['attributes']=$this->Faq_model->GetFaqFormAttribute($values);
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/faq/add-faq',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validatefaq()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('faq/add-faq');
   $this->data['active_submodule']="add-faq";
   $values=array();
   $values['title']="Validate FAQ";
   $faq_id=$this->input->post('faq_id');
   
   $values['answer']=$this->input->post('answer');
   $values['question']=$this->input->post('question');
   $this->load->library('form_validation'); 
   $this->form_validation->set_message('required','Please enter {field}');
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_rules('answer', 'answer', 'trim|required');
   if(!empty($faq_id))
   {
    $values['page_title']="Edit Faq";
    $this->data['faq_id']=$faq_id;
    $this->form_validation->set_rules('question', 'question', 'trim|required|callback_is_unique_on_update['.FAQ.'~question~'.$faq_id.'~question]');
   }
   else
   {
    $values['page_title']="Add FAQ";
    $this->form_validation->set_rules('question', 'question', 'trim|required|is_unique['.FAQ.'.question]');
   }
   
   if($this->form_validation->run() == FALSE)
   { 
    $this->add_faq($values);
   }
   else
   {
	$records['answer']=$values['answer'];
	$records['question']=$values['question'];

    if(!empty($faq_id))
	{
	 $this->Faq_model->UpdateFaq($records,$faq_id);
	 $this->RedirectPage(admin.'/faq/manage-faqs','FAQ has been updated successfully');
	}
	else
	{
	 $this->Faq_model->InsertFaq($records);
	 $this->RedirectPage(admin.'/faq/manage-faqs','FAQ has been added successfully');
	}
   }
  }
  public function edit_faq($faq_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('faq/add-faq');	  
   $this->data['active_submodule']="add-faq";
   $this->data['last_modified']=$this->Login_model->LastModify(FAQ,$faq_id);   

   $values=array();
   $values=$this->Faq_model->GetFaqDetails($faq_id);
   $values['page_title']="Edit Faq";
   $values['title']="Edit Faq";
   $values['submit_value']="Update";
   $this->data['faq_id']=$faq_id;
   $this->add_faq($values);
  }  
  public function manage_faqs()
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs');
   $this->load->helper('form');    
   $this->data['faq_list']=$this->Faq_model->GetFaqList();
   if(count($this->data['faq_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['attribute']=$this->Login_model->GetAtributesForDeletion($this->data['faq_list'],'faq','no');
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/faq/manage-faqs',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function ConfirmSuperadmin($checked_ids,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('faq/manage-faqs');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_ids,$item_name,$parent_id);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */   
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message
   if($item_name == "faq")
   {
    $this->data['message']="Are you sure you want to delete all selected item(s).";
   }
   else
   {
    $this->data['message']="Are you sure you want to delete all selected item(s)";
   }
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js=array('SuperAdminValidationJs');
   $this->load->view(admin.'/templates/superadmin-delete',$this->data);
  }
  public function ConfirmDelete($checked_id,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('faq/manage-faqs');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_id,$item_name,$parent_id);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message
   if($item_name == "faq")
   {
	$this->data['message']="Are you sure you want to delete this record.";
   }
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js=array('ConfirmDeleteJs');
   $this->load->view(admin.'/templates/confirm-delete',$this->data);
  }
  public function DeleteRecord($checked_ids,$item_name,$parent_id='') // mandatory Function for each module
  {
   $item_name=urldecode($item_name);
   $all_ids=explode("~",$checked_ids);
   // Delete Record item wise and redirect the page to repective module with success message
   if($item_name == "faq")
   {
    if(count($all_ids) > 0)
	{
	 $this->Faq_model->DeleteRecordForFaq($all_ids);
	 $this->RedirectPage(admin.'/faq/manage-faqs','FAQ has been deleted successfully');
	}
   } 
  }
  public function changestatus($record_id,$status,$section,$parent_id="")
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('faq/manage-faqs');
   $section=str_replace("_","-",$section);
   if($section == "manage-faqs")
   {
    $this->Login_model->ChangeStatus(FAQ,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of FAQ has been changed successfully'); 
   }
   if(!empty($parent_id))
   {
    $section.="/$parent_id";
   }
   header("location:".base_url().admin."/faq/$section");
   exit;
  } 
 }
