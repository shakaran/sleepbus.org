<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class ZeemoSettings extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Zeemosettings_model');
   $this->load->helper('form');
   $this->load->library('CommonFunctions');	
  }
  public function resource($values=array())
  {
   $this->SetUpCkeditor(); 
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateZeemoSettingsJs');
   if(count($values) == 0)
   {
    $values=$this->Zeemosettings_model->GetResourceInformation();
	if(empty($values['meta_title'])) $values['meta_title']="Resource".DEFAULT_SUFFIX;
   }
   $this->data['last_modified']=$this->Login_model->LastModify(ZEEMO_RESOURCE,1);
   
   $this->data['attributes']=$this->Zeemosettings_model->GetResourceFormAttribute($values);
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/zeemo-settings/resource',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validate_resource()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('zeemosettings/resource');
   $this->data['active_submodule']="resource";
   $values=array();
   $values['title']="Validate Resource Page";
   $values['content']=$this->input->post('content');
   $values['page_heading']=$this->input->post('page_heading');
   $values['breadcrumb']=$this->input->post('breadcrumb');
   $values['meta_title']=$this->input->post('meta_title');
   $values['meta_keyword']=$this->input->post('meta_keyword');
   $values['meta_description']=$this->input->post('meta_description');
   $values['json_code']=$this->input->post('json_code');
   
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   
   
   $this->form_validation->set_message('required','Please enter {field}');
   $this->form_validation->set_rules('page_heading','page heading',"trim|required");
   $this->form_validation->set_rules('meta_title','meta title',"trim|required");
   $this->form_validation->set_rules('content','content',"trim|required");

   if($this->form_validation->run() == FALSE)
   { 
    $this->resource($values);
   }
   else
   {
    $records['page_heading']=$values['page_heading'];
    $records['breadcrumb']=$values['breadcrumb'];
    $records['meta_title']=$values['meta_title'];
    $records['meta_keyword']=$values['meta_keyword'];
    $records['meta_description']=$values['meta_description'];
    $records['json_code']=$values['json_code'];
    $records['content']=$values['content'];

    $this->Zeemosettings_model->UpdateRecords($records);
    $this->RedirectPage(admin.'/zeemosettings/resource','Content updated successfully');
   }
  }
  public function common_settings($values=array())
  {
   $this->SetUpCkeditor(); 
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   if(count($values) == 0)
   {
    $values=$this->Zeemosettings_model->GetSettingInformation();
   }
   $this->data['last_modified']=$this->Login_model->LastModify(ZEEMO_SETTINGS,1);
   
   $this->data['attributes']=$this->Zeemosettings_model->GetSettingFormAttribute($values);
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/zeemo-settings/common-settings',$this->data);
   $this->load->view(admin.'/templates/footer');
   
  }
  public function validate_settings()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('zeemosettings/common-settings');
   $this->data['active_submodule']="common-settings";
   $values=array();
   $values['title']="Validate Settings of Zeemo";
   $values['google_analytics_code']=$this->input->post('google_analytics_code');
   $values['canonical_link']=$this->input->post('canonical_link');
   
   $this->load->library('form_validation'); 
   if($this->form_validation->run() == FALSE)
   { 
    $this->common_settings($values);
   }
   else
   {
    $records['google_analytics_code']=$values['google_analytics_code'];
    $records['canonical_link']=$values['canonical_link'];
    $this->Zeemosettings_model->UpdateSettingsRecords($records);
    $this->RedirectPage(admin.'/zeemosettings/common-settings','Common settings have been updated successfully');
   }
  }
  
  public function ConfirmSuperadmin($checked_ids,$item_name,$parent_id='') // mandatory Function for each module
  {
   if($item_name == "Image")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/manageimages');	  	  
   }
   if($item_name == "Brochure")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/managedownloads');	  	  
   }
   
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_ids,$item_name,$parent_id);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */   
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message
   $this->data['message']="Are you sure you want to delete all selected item(s)";
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js=array('SuperAdminValidationJs');
   $this->load->view(admin.'/templates/superadmin-delete',$this->data);
  }
  public function ConfirmDelete($checked_id,$item_name,$parent_id='') // mandatory Function for each module
  {
   if($item_name == "Image")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/manageimages');	  	  
   }
   if($item_name == "Brochure")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/managedownloads');	  	  
   }
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_id,$item_name,$parent_id);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message
   if($item_name == "Image" or "About" == $item_name)
   {
	$this->data['message']="Are you sure you want to delete this image.";
   }
   elseif($item_name == "Brochure")
   {
	$this->data['message']="Are you sure you want to delete this brochure.";
   }
   else
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
   $all_ids=array();
   $all_ids=explode("~",$checked_ids);
   // Delete Record item wise and redirect the page to repective module with success message
   if($item_name == "Image")
   {
    $values=array();
    $table_name=PAGE_IMAGES;
	$this->Login_model->DeleteImageBrochureRecord($all_ids,'page_id',$parent_id,$table_name,'image_file','./images/generalpages/');
	$this->RedirectPage(admin.'/generalpages/manageimages/'.$parent_id,'Selected image deleted successfully');
   }
   elseif($item_name == "Brochure")
   {
    $values=array();
    $table_name=PAGE_BROCHURES;
	$this->Login_model->DeleteImageBrochureRecord($all_ids,'page_id',$parent_id,$table_name,'brochure_file','./images/generalpages/');
	$this->RedirectPage(admin.'/generalpages/managedownloads/'.$parent_id,'Selected brochure deleted successfully');
   }
   elseif($item_name == "about item")
   {
    $values=array();
   
	$this->Generalpages_model->DeleteAboutRecord($all_ids);
	$this->RedirectPage(admin.'/generalpages/about-section/','Selected item(s) deleted successfully');
   }
   elseif("About" == $item_name)
   {
    $this->Generalpages_model->DeleteAboutImage($checked_ids,'image_file');
    $this->RedirectPage(admin.'/generalpages/EditAboutSection/'.$checked_ids,'Image has been deleted successfully');
   }
   elseif("footerIcon" == $item_name)
   {
    $this->Generalpages_model->DeleteFooterIcon($all_ids);
    $this->RedirectPage(admin.'/generalpages/homepage','Footer icon has been deleted successfully');
   }
   
   
  }
  public function changestatus($record_id,$status,$section,$parent_id="")
  {
   if($section == "manageimages")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/manageimages');
    $this->Login_model->ChangeStatus(PAGE_IMAGES,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of image has been changed successfully'); 
   }
   elseif($section == "managedownloads")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/managedownloads');
    $this->Login_model->ChangeStatus(PAGE_BROCHURES,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of brochure has been changed successfully'); 
   }
   elseif($section == "homepage")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/homepage');
    $this->Login_model->ChangeStatus(CLIENTS,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of footer icon has been changed successfully'); 
   }
   elseif($section == "about_section")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/about-section');
    $this->Login_model->ChangeStatus(ABOUT_SECTION,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of item has been changed successfully'); 
	$section=str_replace("_","-",$section);
   }
   
   if(!empty($parent_id))
   {
    $section.="/$parent_id";
   }
   header("location:".base_url().admin."/generalpages/$section");
   exit;
  } 
  
 }
