<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Landingpages extends MY_Controller
 {
  public $uploading_image_info;
  public $uploading_brochure_info;

  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Landingpages_model');
   $this->load->helper('form');
   $this->load->library('CommonFunctions');	
  }
  public function add_landing_page($values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('landingpages/add-landing-page');	  	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateLandingFormJs');
   
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
   }
   else
   {
    $values['title'] = '';
    $values['page_heading']="";
    $values['url'] = '';	
    $values['description'] = '';	
    $values['meta_title'] = '';
    $values['meta_keyword'] = '';	
    $values['meta_description'] = '';	
	$this->data['page_title']="Add Landing Page";
   }
   if(!empty($this->data['item_id'])) {
	$this->data['attributes']=$this->Landingpages_model->GetLandingpagesFormAttribute($values,$this->data['item_id']);
   }
   else {
    $this->data['attributes']=$this->Landingpages_model->GetLandingpagesFormAttribute($values);
   }

   $this->SetUpCkeditor(); 
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/landingpages/add-landing-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validatelandingpage()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('landingpages/add-landing-page');
   $this->data['active_submodule']="add-landing-page";
   $values=array();
   $values['title']="Validate Landing Page";
   $item_id=$this->input->post('item_id');
   
   $values['description']=$this->input->post('description');
   $values['page_heading']=$this->input->post('page_heading');   
   $values['title']=$this->input->post('title');
   $values['url']=$this->input->post('url');
   $values['meta_title']=$this->input->post('meta_title');   
   $values['meta_keyword']=$this->input->post('meta_keyword');      
   $values['meta_description']=$this->input->post('meta_description');         
   
   $this->load->library('form_validation'); 
   $this->form_validation->set_message('required', 'Please enter {field}', 'trim|required');
   $this->form_validation->set_message('is_unique', '%s');   
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_rules('description', 'description', 'trim|required');

   
   if(!empty($item_id))
   {
    $values['page_title']="Edit Landing Page";
    $this->data['item_id']=$item_id;
    $this->form_validation->set_rules('title', 'title', 'trim|required|callback_is_unique_on_update['.LANDINGPAGE.'~title~'.$item_id.'~page title]');
    $url_info=array(LANDINGPAGE,'url',$values['url'],$item_id);
   }
   else
   {
    $values['page_title']="Add Landing Page";
    $this->form_validation->set_rules('title', 'This page title already eixts', 'trim|required|is_unique['.LANDINGPAGE.'.title]');
    $url_info=array(LANDINGPAGE,'url',$values['url']);
   }
   
   if(!empty($values['url']))
   {
    $url = strtolower(str_replace(' ','-',$this->commonfunctions->RemoveSpecialChars($values['url'])));		
	   
	if(!empty($item_id)) $url_info=array(LANDINGPAGE,'url',$url,$item_id);
	else $url_info=array(LANDINGPAGE,'url',$url);  

    $url_info_string=implode("~",$url_info);
    $this->form_validation->set_rules('url', 'url', "trim|callback__IsUrlUnique[{$url_info_string}]");
	
	$records['url'] = $url;
   }
   
   if($this->form_validation->run()==FALSE) 
   { 
	$this->add_landing_page($values);
   }
   else
   {
	$records['description']=$values['description'];
	$records['page_heading']=$values['page_heading'];	
	$records['title']=$values['title'];
	$records['meta_title']=$values['meta_title'];	
	$records['meta_keyword']=$values['meta_keyword'];		
	$records['meta_description']=$values['meta_description'];			

	if(empty($values['url']) && empty($item_id)) 
	{
	 $url = strtolower(str_replace(' ','-',$this->commonfunctions->RemoveSpecialChars($records['title'])));		
	 $url = $this->Login_model->GenerateNewUrl($url);
 	 $records['url'] = $url;
	}

    if(!empty($item_id))
	{
	 $this->Landingpages_model->UpdateLandingpage($records,$item_id);
	 $this->RedirectPage(admin.'/landingpages/manage-landing-pages','Landing page updated successfully');
	}
	else
	{
	 $this->Landingpages_model->InsertLandingpage($records);
	 $this->RedirectPage(admin.'/landingpages/manage-landing-pages','Landing page added successfully');
	}
   }
  }
  
  public function editlandingpages($item_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('landingpages/add-landing-page');	  
   $this->data['active_submodule']="add-landing-page";
   $this->data['last_modified']=$this->Login_model->LastModify(LANDINGPAGE,$item_id);   

   $values=array();
   $values=$this->Landingpages_model->GetLandingpagesDetails($item_id);
   $values['page_title']="Edit Landing Page";
   $values['test_title']="Edit Landing Page";
   $values['submit_value']="Update";
   $this->data['item_id']=$item_id;
   $this->add_landing_page($values);
  }  
  public function manage_landing_pages()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('landingpages/manage-landing-pages');	  	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs');
   //$this->admincss->including_css_func=array('PrettyPhotoCss');   
   $this->load->helper('form');    
   $this->data['page_list']=$this->Landingpages_model->GetLandingpagesList();
   if(count($this->data['page_list']) > 0)
   {
    /*****************************************
    * Arguments for GetAtributesForDeletion function : 
	1. item list to be deleted, 
	2. which type of item to be deleted, 
	3. single delete permission-> value would be 'yes' or 'no' and 
	4. parent_id if you have(optional);
    ******************************************/
    $this->data['attribute']=$this->Login_model->GetAtributesForDeletion($this->data['page_list'],'landingpage','no');
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/landingpages/manage-landing-pages',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  
  public function ConfirmSuperadmin($checked_ids,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('landingpages/manage-landing-pages');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_ids,$item_name);
   /********************************************
   * If you have any additional attribute item wise then you can merge it as follows  : 
   * $attributes2=array('field1'=>'value1','field2'=>'value2');
   * $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   * if you have any custom message other than common message item wise then assign message to data variable as follows
   * Default message
   ********************************************/
   $this->data['message']="Are you sure you want to delete all selected item(s)";
      
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js=array('SuperAdminValidationJs');
   $this->admincss->including_css_func=array('PrettyPhotoCss');  
   $this->load->view(admin.'/templates/superadmin-delete',$this->data);
  }
  public function ConfirmDelete($checked_id,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('landingpages/manage-landing-pages');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_id,$item_name);

   /********************************************
   * If you have any additional attribute item wise then you can merge it as follows  : 
   * $attributes2=array('field1'=>'value1','field2'=>'value2');
   * $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   * If you have any custom message other than common message item wise then assign message to data variable as follows
   * Default message
   *********************************************/
   
   $this->data['message']="Are you sure you want to delete this record.";
  
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js=array('ConfirmDeleteJs');
   $this->load->view(admin.'/templates/confirm-delete',$this->data);
  }
  public function DeleteRecord($checked_ids,$item_name) // mandatory Function for each module
  {
   $item_name=urldecode($item_name);
   $all_ids=explode("~",$checked_ids);
   // Delete Record item wise and redirect the page to repective module with success message
   if($item_name == "landingpage")
   {
    if(count($all_ids) > 0)
	{
	 $this->Landingpages_model->DeleteRecordForLandingpages($all_ids);
	 $this->RedirectPage(admin.'/landingpages/manage-landing-pages','Page(s) deleted successfully');
	}
   } 
  }

  public function changestatus($record_id,$status,$section,$parent_id="")
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('landingpages/manage-landing-pages');

   $this->Login_model->ChangeStatus(LANDINGPAGE,$record_id,$status);
   $this->session->set_flashdata('success_message','Status has been changed successfully');

   if(!empty($parent_id))
   {
    $section.="/$parent_id";
   }
   $section=str_replace("_","-",$section);
   header("location:".base_url().admin."/landingpages/$section");
   exit;
  } 
  public function _IsUrlUnique($url,$url_info_string)
  {
   $id_value = '';
   $url_info_array = explode("~",$url_info_string);
   if(count($url_info_array)==4) list($table_name,$url_field,$url_value,$id_value)=$url_info_array;
   else list($table_name,$url_field,$url_value)=$url_info_array;
   
   if($this->Login_model->IsDuplicateUrl($table_name,$url_field,$url_value,$id_value))
   {
    $this->form_validation->set_message('_IsUrlUnique','URL already exists');
    return false;
   }
  }
 }