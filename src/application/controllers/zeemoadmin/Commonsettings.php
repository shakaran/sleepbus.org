<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Commonsettings extends MY_Controller
 {
  public $uploading_image_info;
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Commonsettings_model');
   $this->load->helper('form');
  }
  public function footer_text()
  {
   $submit_value=$this->input->post('submit_form');
   $values=array();
   if(!empty($submit_value))
   {
	$records['content']=$this->input->post('content');
    $this->Login_model->UpdateTopText($records,1);
	$this->RedirectPage(admin.'/commonsettings/footer-text','Footer content has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(1);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,1);
   $this->data['attributes']=$this->Commonsettings_model->GetTopTextFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/common-settings/footer-text',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  
  public function social_media_icon($values=array())
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs','ValidateCommonSettingsFormJs');
   //$this->admincss->including_css_func=array('PrettyPhotoCss');
   $this->load->helper('form');
   $this->data['icon_list']=$this->Commonsettings_model->GetIconList();
   if(count($this->data['icon_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['attribute']=$this->Login_model->GetAtributesForDeletion($this->data['icon_list'],'icon','no');
   }

   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
   }
   else
   {
    $values['icon_title']="";
    $values['url']="";
	$values['image_alt_title_text']="";
	$values['hover_image_alt_title_text']="";
	$this->data['page_title']="Add Icon";
   }

   if(!empty($this->data['icon_id']))
   {
    $this->data['attributes']=$this->Commonsettings_model->GetIconsFormAttribute($values,$this->data['icon_id']);
   }
   else
   {
    $this->data['attributes']=$this->Commonsettings_model->GetIconsFormAttribute($values);
   }

   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/common-settings/social-media-icon',$this->data);
   $this->load->view(admin.'/templates/footer');
  }

  public function validateicons()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('commonsettings/social-media-icon');  
   $this->data['active_submodule']="social-media-icon";
   $values=array();
   $values['title']="Validate Icon";
   $icon_id=$this->input->post('icon_id');

   $values['url']=$this->input->post('url');
   $values['current_image']=$this->input->post('current_image');
   $values['current_hover_image']=$this->input->post('current_hover_image');
   $values['image_alt_title_text']=$this->input->post('image_alt_title_text');
   $values['hover_image_alt_title_text']=$this->input->post('hover_image_alt_title_text');
   
   
   $values['icon_title']=$this->input->post('icon_title');
   $this->load->library('form_validation');
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_rules('url', 'url', 'trim|required');

   if(!empty($icon_id))
   {
    $values['page_title']="Edit Icon";
    $this->data['icon_id']=$icon_id;
    $this->form_validation->set_rules('icon_title', 'title', 'trim|required');
   }
   else
   {
    $values['page_title']="Add Client";
    $this->form_validation->set_rules('icon_title', 'title', 'trim|required|is_unique['.SOCIAL_MEDIA_ICONS.'.icon_title]');
   }

   $path_to_upload="./images/common-settings/";
   if(!empty($_FILES['image_file']['name']) or empty($icon_id))
   {
	// list of argument for image validation array
// 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $icon_image_info=array("image_file",$path_to_upload,"image","","","","",'');
    $icon_image_info_string=implode("~",$icon_image_info);
    $this->form_validation->set_rules('image_file', 'Image file', "callback_image_validation[{$icon_image_info_string}]");
   }
   if(!empty($_FILES['hover_image']['name']) or empty($icon_id))
   {
	// list of argument for image validation array
// 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $icon_image_info=array("hover_image",$path_to_upload,"footer_image","","","","",'');
    $icon_image_info_string=implode("~",$icon_image_info);
    $this->form_validation->set_rules('hover_image', 'Image file', "callback_image_validation[{$icon_image_info_string}]");
   }

   if($this->form_validation->run() == FALSE)
   {
    // if uploaded file has not error but other field through error then delete the recent uploaded file
	if(!empty($this->uploading_image_info['image']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['image']['file_name']);
	}
	if(!empty($this->uploading_image_info['footer_image']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['footer_image']['file_name']);
	}
	
    $this->social_media_icon($values);
   }
   else
   {
    if(!empty($_FILES['image_file']['name']))
	{
	 // delete previous image
	 if(!empty($values['current_image']))
	 {
	  unlink($path_to_upload.$values['current_image']);
	 }
	 $records['image_file']=$this->uploading_image_info['image']['file_name'];
	}
    if(!empty($_FILES['hover_image']['name']))
	{
	 // delete previous image
	 if(!empty($values['current_hover_image']))
	 {
	  unlink($path_to_upload.$values['current_hover_image']);
	 }
	 $records['hover_image']=$this->uploading_image_info['footer_image']['file_name'];
	}
	
	$records['url']=$values['url'];
	$records['icon_title']=$values['icon_title'];
    $records['image_alt_title_text']=$values['image_alt_title_text'];
    $records['hover_image_alt_title_text']=$values['hover_image_alt_title_text'];

    if(!empty($icon_id))
	{
	 $this->Commonsettings_model->UpdateIcon($records,$icon_id);
	 $this->RedirectPage(admin.'/commonsettings/social-media-icon','Icon updated successfully');
	}
	else
	{
	 $this->Commonsettings_model->InsertIcon($records);
	 $this->RedirectPage(admin.'/commonsettings/social-media-icon','Icon added successfully');
	}
   }
  }

  public function editicon($icon_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('commonsettings/social-media-icon');  
   $this->data['active_submodule']="social-media-icon";
   $this->data['last_modified']=$this->Login_model->LastModify(SOCIAL_MEDIA_ICONS,$icon_id);

   $values=array();
   $values=$this->Commonsettings_model->GetIconDetails($icon_id);
   $values['page_title']="Edit Icon";
   $values['title']="Edit Clients";
   $values['submit_value']="Update";
   $this->data['icon_id']=$icon_id;
   $this->social_media_icon($values);
  }
  
  public function setting($values=array())
  {
   if(count($values) == 0)
   {
    $values=$this->Commonsettings_model->GetCommonSettingsInformation();
   }
   else
   {
    $this->data['title'].=$values['title'];
   }

   $this->data['last_modified']=$this->Login_model->LastModify(COMMON_SETTINGS);
   $this->data['attributes']=$this->Commonsettings_model->GetCommonSettingFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCommonSettingsFormJs');   
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/common-settings/setting',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validatesetting()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('commonsettings/setting');
   $this->data['active_submodule']="setting";
   $values=array();
   $values['title']="Validate Settings";
   $this->load->library('form_validation'); 
   $values['unit_fund']=$this->input->post('unit_fund');
   $this->form_validation->set_error_delimiters('<span>','</span>');
    $this->form_validation->set_message('required','%s');

   $path_to_upload="./images/common-settings/";
   if(!empty($_FILES['website_logo']['name']))
   {
	// list of argument for image validation array
// 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $website_logo_info=array("website_logo",$path_to_upload,"website_logo","","","198","48",'');
    $website_logo_info_string=implode("~",$website_logo_info);
    $this->form_validation->set_rules('website_logo', 'Website Logo', "callback_image_validation[{$website_logo_info_string}]");
   }
   
   if(!empty($_FILES['website_svg_logo']['name']))
   {
	//$path_to_upload="./brochures/generalpages/";
	// list of argument for brochure validation array // 1.file_name,2.path_to_upload,3.image_index,4.max_size
    $svg_image_info=array("website_svg_logo",$path_to_upload,"website_svg_logo",'');
    $svg_image_info_string=implode("~",$svg_image_info);
	
    $this->form_validation->set_rules('website_svg_logo', 'SVG file', "callback_svg_image_validation[{$svg_image_info_string}]");
   }
    $this->form_validation->set_rules('unit_fund', 'Please enter fund price for a safe sleep', "trim|required|numeric");

   $values['current_website_logo']=$this->input->post('current_website_logo');
   $values['current_website_svg_logo']=$this->input->post('current_website_svg_logo');
   

   if($this->form_validation->run() == FALSE)
   { 
    $error=false;
    // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_image_info['website_logo']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['website_logo']['file_name']);
	 $error=true;
	}
	if(!empty($this->uploading_image_info['website_svg_logo']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['website_svg_logo']['file_name']);
	 $error=true;
	}
	
    $this->setting($values);
   }
   else
   {
	$records=array();
    if(!empty($_FILES['website_logo']['name']) and !empty($values['current_website_logo']))
	{
	 // delete previous image
	 unlink($path_to_upload.$values['current_website_logo']);
	 $records['website_logo']=$this->uploading_image_info['website_logo']['file_name'];
	}
    if(!empty($_FILES['website_svg_logo']['name']))
	{
	 // delete previous image
	 if(!empty($values['current_website_svg_logo']))
	 {
	  unlink($path_to_upload.$values['current_website_svg_logo']);
	 }
	 $records['website_svg_logo']=$this->uploading_brochure_info['website_svg_logo']['file_name'];
	}
	$records['unit_fund']=$values['unit_fund'];
	if(count($records) > 0)
	{
	 $this->Commonsettings_model->UpdateSettingRecords($records);
	}
	$this->RedirectPage(admin.'/commonsettings/setting','Common setting updated successfully');
   }
  }
  public function email_validation($emails)
  {
   $this->load->library('CommonFunctions');	
   $emails=trim($emails);
   $all_emails=explode(",",$emails);
   $error=false;
   if(count($all_emails) > 0)
   {
    foreach($all_emails as $email)
	{
     if(!($this->commonfunctions->is_email($email)))
	 {
      $this->form_validation->set_message('email_validation', 'Some of the email addresses are not valid');
	  return false;
	  break;
	 }
	}
   } 
   if($error == false)
   {
    return true;
   }
  }
  public function pageheadings($page_id='',$values=array())
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCommonSettingsFormJs');
   if(count($values) == 0)
   {
    if(!empty($page_id))
	{
	 $values=$this->Commonsettings_model->GetPageHeading($page_id);
	}
	else
	{
	 $values['page_heading']="";
	}
   }
   else
   {
    $this->data['title'].=$values['title'];
   }
   $this->data['page_id']=$page_id;
   if(!empty($page_id))
   {
    $this->data['last_modified']=$this->Login_model->LastModify(PAGE_HEADING,$page_id); 
   }
   $this->data['attributes']=$this->Commonsettings_model->GetPageHeadingFormAttribute($values,$page_id);
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/common-settings/page-heading',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validateheadings()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('commonsettings/pageheadings');
   $this->data['active_submodule']="pageheadings";
   $values=array();
   $values['title']="Validate Headings";
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_rules('page_heading', 'page heading', 'trim|required');
   $this->form_validation->set_rules('heading_id', 'selection of page', 'trim|required');   
   $page_id=$this->input->post('heading_id');
   $values['page_heading']=$this->input->post('page_heading');
   if($this->form_validation->run() == FALSE)
   {
    $this->pageheadings($page_id,$values);
   }
   else
   {
	$records['page_heading']=$values['page_heading'];
    $this->Commonsettings_model->UpdatePageHeadings($page_id,$records);
	$this->RedirectPage(admin.'/commonsettings/pageheadings/'.$page_id,'Page heading updated successfully');
   }
  }
  public function form_lead_types($type_id='',$values=array())
  {
   if(!empty($type_id) and count($values) == 0)
   {
    $this->data['title'] ="Form Lead Types : Update Lead Type";
	$values=$this->Commonsettings_model->GetLeadDetails($type_id);
   }
   elseif(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
   }
   else
   {
    $values=array();
	$values['name']="";
   }

   if(!empty($type_id))
   {
    $this->data['type_id']=$type_id;
    $this->data['page_title']="Edit Lead Type";
	$this->data['last_modified']=$this->Login_model->LastModify(LEAD_SOURCES,$type_id);
   }
   else
   {
    $this->data['page_title']="Add Lead Type";
   }

    $this->data['all_leads']=$this->Commonsettings_model->GetAllLeads();
    // attrubutes for deletion of banners
    $this->data['deletion_attributes']=$this->Login_model->GetAtributesForDeletion($this->data['all_leads'],'lead','no');

   $this->data['attributes']=$this->Commonsettings_model->GetLeadTypeAttributes($values,$type_id);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCommonSettingsFormJs','DragDropJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/common-settings/form-lead-types',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validateleadtypes($type_id='')
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('commonsettings/form-lead-types');
   $this->data['active_submodule']="form-lead-types";
   $values=array();
   $values['title']="Validate Lead Type";
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','Please enter {field}');
   if(empty($type_id))
   {
    $this->form_validation->set_rules('name', 'lead type name', "trim|required|is_unique[".LEAD_SOURCES.".name]");
 
   }
   else
   {
    $this->form_validation->set_rules('name', 'lead type name', 'trim|required|callback_is_unique_on_update['.LEAD_SOURCES.'~name~'.$type_id.'~name]');

   }
   $values['name']=$this->input->post('name');
   if($this->form_validation->run() == FALSE)
   { 
	if(!empty($type_id)) $this->form_lead_types($type_id,$values);
	else $this->form_lead_types('',$values);
    
   }
   else
   {
	$records['name']=$values['name'];
    if(!empty($type_id))
	{
	 $this->Commonsettings_model->UpdateLeadType($records,$type_id);
	 $this->RedirectPage(admin.'/commonsettings/form-lead-types','Lead type has been Updated successfully');
	}
	else
	{
	 $this->Commonsettings_model->InsertLeadType($records);
	 $this->RedirectPage(admin.'/commonsettings/form-lead-types','Lead type has been added successfully');
	}
   }
  }
  public function changestatus($record_id, $status, $section, $parent_id = "")
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('commonsettings/form-lead-types');
  
   $section = str_replace("_","-",$section); 
   
   if($section=='form-lead-types')
   {
    $this->Login_model->ChangeStatus(LEAD_SOURCES,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of lead type changed successfully');
   }
  
   if(!empty($parent_id))
   {
    $section.="/$parent_id";
   }
   header("location:".base_url().admin."/commonsettings/$section");
   exit;
  } 
  public function ConfirmDelete($checked_id, $item_name, $parent_id = '') 
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('commonsettings/form-lead-typess');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_id, $item_name, $parent_id);
  
   /*
   If you have any additional attribute item wise then you can merge it as follows  : 
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   If you have any custom message other than common message item wise then assign message to data variable as follows
   Default message
   */
   if($item_name=="lead")
   {
    $this->data['message'] = "Are you sure want to delete this lead type.";
   }
   else
   {
    $this->data['message']="Are you sure want to delete this record";
   }
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js = array('ConfirmDeleteJs');
   $this->load->view(admin.'/templates/confirm-delete',$this->data);
  }
  
  //mandatory Function for each module
  public function ConfirmSuperadmin($checked_ids,$item_name,$parent_id='') 
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('commonsettings/form-lead-types');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_ids, $item_name, $parent_id);
   /*
   If you have any additional attribute item wise then you can merge it as follows  : 
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   If you have any custom message other than common message item wise then assign message to data variable as follows
   Default message
   */
   
   $this->data['message']="Are you sure want to delete all selected item(s)";
      
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js=array('SuperAdminValidationJs');
   $this->admincss->including_css_func=array('PrettyPhotoCss');  
   $this->load->view(admin.'/templates/superadmin-delete',$this->data);
  }  
  
  //mandatory Function for each module
  public function DeleteRecord($checked_ids, $item_name, $parent_id='') 
  {
   $item_name = urldecode($item_name);
   $all_ids = explode("~",$checked_ids);
   
   // Delete Record item wise and redirect the page to repective module with success message
   if($item_name=="lead")
   {
    if(count($all_ids) > 0)
	{
	 $this->Commonsettings_model->DeleteLeads($all_ids);
	 $this->RedirectPage(admin.'/commonsettings/form-lead-types','Lead type deleted successfully');
	}
   } 
   elseif($item_name=="icon")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('commonsettings/social-media-icon');	  	  
    if(count($all_ids) > 0)
	{
	 $this->Commonsettings_model->DeleteSocialMediaIcons($all_ids);
	 $this->RedirectPage(admin.'/commonsettings/social-media-icon','Social media icon(s) deleted successfully');
	}
   }
  }
  
 }
