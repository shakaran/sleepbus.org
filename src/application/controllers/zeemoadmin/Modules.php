<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Modules extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Module_List');
   $this->load->helper('form');
   $this->load->library('CommonFunctions');
   $this->load->library('form_validation');   
  }
  public function manage()
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs','UpdateModuleJs');
   $this->load->helper('form');    
   $this->data['module_list']=$this->Module_List->GetModuleList();
   $modules_without_module_list=$this->Module_List->GetModuleList('modules');
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['attribute']=$this->Login_model->GetAtributesForDeletion($modules_without_module_list,'module','yes');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/modules/manage-modules',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function add_module($values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('modules/manage');
   $this->adminjavascript->include_admin_js = array('UpdateModuleJs');
   if(count($values) > 0)
   {
    $this->data['title'] .= $values['title'];
	$this->data['page_title'] = $values['page_title'];
	$this->data['submit_value'] = $values['submit_value']; 
	if(isset($values['edit_id']) and !empty($values['edit_id']))
	{
     $this->data['last_modified'] = $this->Login_model->LastModify(ADMIN_MODULES,$values['edit_id']);   
     $this->data['edit_id']=$values['edit_id'];
	}
   }
   else
   {
    $values['module_name'] = "";
    $values['url'] = "";
    $values['current_home_page_icon'] = "";
    $values['current_header_icon'] = "";	
    $this->data['current_left_menu_icon']='';
	$this->data['page_title'] = "Add Module";
	$this->data['submit_value'] = "Submit"; 
	$this->data['edit_id']='';
   }
   if(!empty($this->data['edit_id'])) $this->data['attributes'] = $this->Module_List->AddModuleFormAttribute($values,$this->data['edit_id']);
   else $this->data['attributes'] = $this->Module_List->AddModuleFormAttribute($values);
   
   $this->data['home_page_icon_remarks']="Max. image size must be 75x75(width x height)px";
   $this->data['header_icon_remarks']="Max. image size must be 45x45(width x height)px";
   $this->data['left_menu_icon_remarks']="Max. image size must be 25x25(width x height)px";
   $this->load->view(admin.'/modules/add-module',$this->data);
  }
  public function edit_module($module_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('modules/manage');
   $values=array();
   $values=$this->Module_List->GetModuleDetails($module_id);
   $values['edit_id']=$module_id;
   $values['current_home_page_icon']=$values['home_page_icon'];
   $values['current_header_icon']=$values['header_icon'];
   $values['current_left_menu_icon']=$values['left_menu_icon'];
   $values['submit_value']="Update";
   $values['page_title']="Edit Module";
   $values['title']="Edit Module";
   
   $this->add_module($values);
  }
  public function validate_module()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('modules/manage');
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $values=array();
   $values['title'] = "Validate Module";
   $values['module_name'] = $this->input->post('module_name');
   $values['url'] = $this->input->post('url');
   
   $values['current_home_page_icon'] = $this->input->post('current_home_page_icon');
   $values['current_header_icon'] = $this->input->post('current_header_icon');
   $values['current_left_menu_icon'] = $this->input->post('current_left_menu_icon');
   $values['submit_value'] = $this->input->post('submit_value');

   if($values['submit_value']=="Submit") $values['page_title']="Add Module";
   else
   {
    $values['page_title']="Edit Module";
    $values['edit_id']=$this->input->post('edit_id');
   }
 
   if(!empty($_FILES['home_page_icon']['name']))
   {
	$path_to_upload_home_page_icon = "./images/".admin."/cms-settings/home/";
	/* 	list of argument for image validation array   1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,	6.fixed_width,7.fixed_height,8.max_size
	*/
    $home_page_icon_info = array("home_page_icon",$path_to_upload_home_page_icon,"home_page_icon", '75','75', '', '', '');
	
    $home_page_icon_info_string = implode("~",$home_page_icon_info);
	
    $this->form_validation->set_rules('home_page_icon', 'image', "callback_image_validation[{$home_page_icon_info_string}]");
   }
   else if($values['submit_value']=="Submit")
   {
    $this->form_validation->set_rules('home_page_icon', 'image', "required");
   }
   if(!empty($_FILES['header_icon']['name']))
   {
	$path_to_upload_header_icon = "./images/".admin."/cms-settings/top/";
	/* 	list of argument for image validation array   1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,	6.fixed_width,7.fixed_height,8.max_size
	*/
    $header_icon_info = array("header_icon",$path_to_upload_header_icon,"header_icon", '45','45', '', '', '');
	
    $header_icon_info_string = implode("~",$header_icon_info);
	
    $this->form_validation->set_rules('header_icon', 'image', "callback_image_validation[{$header_icon_info_string}]");
   }
   else if($values['submit_value']=="Submit")
   {
    $this->form_validation->set_rules('header_icon', 'image', "required");
   }
   if(!empty($_FILES['left_menu_icon']['name']))
   {
	$path_to_upload_left_menu_icon = "./images/".admin."/cms-settings/left/";
	/* 	list of argument for image validation array   1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,	6.fixed_width,7.fixed_height,8.max_size
	*/
    $left_menu_icon_info = array("left_menu_icon",$path_to_upload_left_menu_icon,"left_menu_icon", '25','25', '', '', '');
	
    $left_menu_icon_info_string = implode("~",$left_menu_icon_info);
	
    $this->form_validation->set_rules('left_menu_icon', 'image', "callback_image_validation[{$left_menu_icon_info_string}]");
   }
   else if($values['submit_value']=="Submit")
   {
    $this->form_validation->set_rules('left_menu_icon', 'image', "required");
   }
   
   if($values['submit_value']=="Submit")
   {
    $this->form_validation->set_rules('module_name', 'module name', 'trim|required|callback_is_unique_module[0~0]');
    $this->form_validation->set_rules('url', 'url', 'trim|required|callback__check_special_chars|callback_is_unique_url[0~0]');
   }
   else
   {
    $this->form_validation->set_rules('module_name', 'module name', 'trim|required|callback_is_unique_module[0~'.$values['edit_id'].']');
    $this->form_validation->set_rules('url', 'url', 'trim|required|callback__check_special_chars|callback_is_unique_url[0~'.$values['edit_id'].']');
   }
   
   if($this->form_validation->run()==FALSE)
   { 
    // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_image_info['home_page_icon']['file_name']))
	{
	 unlink($path_to_upload_home_page_icon.$this->uploading_image_info['home_page_icon']['file_name']);
	}
	if(!empty($this->uploading_image_info['header_icon']['file_name']))
	{
	 unlink($path_to_upload_header_icon.$this->uploading_image_info['header_icon']['file_name']);
	}
	if(!empty($this->uploading_image_info['left_menu_icon']['file_name']))
	{
	 unlink($path_to_upload_left_menu_icon.$this->uploading_image_info['left_menu_icon']['file_name']);
	}
    $this->add_module($values);
   }
   else
   {
    $records=array();
    if(!empty($_FILES['home_page_icon']['name']))
	{
	 // delete previous image
	 if(!empty($values['current_home_page_icon']))
	 {
	  unlink($path_to_upload_home_page_icon.$values['current_home_page_icon']);
	 }
	 $records['home_page_icon'] = $this->uploading_image_info['home_page_icon']['file_name'];
	}
    if(!empty($_FILES['header_icon']['name']))
	{
	 // delete previous image
	 if(!empty($values['current_header_icon']))
	 {
	  unlink($path_to_upload_header_icon.$values['current_header_icon']);
	 }
	 $records['header_icon'] = $this->uploading_image_info['header_icon']['file_name'];
	}
    if(!empty($_FILES['left_menu_icon']['name']))
	{
	 // delete previous image
	 if(!empty($values['current_left_menu_icon']))
	 {
	  unlink($path_to_upload_left_menu_icon.$values['current_left_menu_icon']);
	 }
	 $records['left_menu_icon'] = $this->uploading_image_info['left_menu_icon']['file_name'];
	}
    $records['module_name']=$values['module_name'];
    $records['url']=str_replace(" ","-",trim($values['url']));

    $this->data['redirect_url'] = admin."/modules/manage";
	if($values['submit_value']=="Submit")
	{
	 $this->Module_List->InsertModule($records); 
	 $message="Module added successfully";
	}
	elseif($values['submit_value'] == "Update")
	{
	 $this->Module_List->UpdateModule($records,$values['edit_id']); 
	 $message="Module updated successfully";
    }
	$this->RedirectPopupPage($this->data['redirect_url'],$message);
   }
  }  
  public function is_unique_module($field_value,$id_info)
  {
   list($parent_id,$id)=explode("~",$id_info);
   if(strtolower($field_value) == "home" or strtolower($field_value) == "logout")
   {
    $this->form_validation->set_message('is_unique_module',"This module name already exists");		
    return false;
   }
   else
   {
	if($id > 0) $additional_condition=" and id !='$id'"; else $additional_condition="";      
    if(!$this->Login_model->CheckUniqueWithCondition(ADMIN_MODULES,'module_name',$field_value,"parent_id='$parent_id'".$additional_condition))
    {
     if($parent_id > 0) $error_message="This submodule name already exists in given module";
	 else $error_message="This module name already exists";
     $this->form_validation->set_message('is_unique_module',$error_message);		
     return false;
	}
	else
	{
	 return true;
	}
   }
  }  
  public function _check_special_chars($field_value)
  {
   if($this->commonfunctions->CheckSpecialChars($field_value))
   {
    $this->form_validation->set_message('_check_special_chars',"This url contains some special characters");		
    return false;
   }
   else
   {
    return true;
   }
  }
  public function is_unique_url($field_value,$id_info)
  {
   list($parent_id,$id)=explode("~",$id_info);	  
   if(strtolower($field_value) == "home" or strtolower($field_value) == "logout")
   {
    $this->form_validation->set_message('is_unique_url',"This url already exists");		
    return false;
   }
   else
   {
	if($id > 0) $additional_condition=" and id !='$id'"; else $additional_condition="";   
    $field_value1=str_replace("_","-",$field_value);
    $field_value2=str_replace("-","_",$field_value);
    if($parent_id > 0)
	{
	 $error_message="This submodule name already exists in given module";
	 $this->data['module_info']=$this->Module_List->GetModuleDetails($parent_id);
     $field_value1=$this->data['module_info']['url']."/".$field_value1;
     $field_value2=$this->data['module_info']['url']."/".$field_value2;
	}
	else
	{
	 $error_message="This module name already exists";
	}
	if((!$this->Login_model->CheckUniqueWithCondition(ADMIN_MODULES,'url',$field_value1,"parent_id='$parent_id'".$additional_condition)) or (!$this->Login_model->CheckUniqueWithCondition(ADMIN_MODULES,'url',$field_value2,"parent_id='$parent_id'".$additional_condition)))
    {
     $this->form_validation->set_message('is_unique_url',"This url already exists");		
     return false;
	}
	else
	{
	 return true;
	}
   }
  }  
  
  public function managesubmodules($module_id="")
  {
   if(empty($module_id) and $this->input->post('module_id') != "") $module_id=$this->input->post('module_id');
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs','UpdateModuleJs');

   $this->data['attribute']=$this->Module_List->GetSubmoduleFormAttributes();
   $this->data['module_id']=$module_id;
   if(!empty($module_id))
   {
    $this->data['submodule_list']=$this->Module_List->GetSubmoduleList($module_id);
    $this->data['deletion_attributes']=$this->Login_model->GetAtributesForDeletion($this->data['submodule_list'],'submodule','no');
	$module_details=$this->Module_List->GetModuleDetails($module_id);
	$this->data['module_url']=$module_details['url'];
   }
   else $this->data['submodule_list']=array();
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/modules/manage-submodules',$this->data);
   $this->load->view(admin.'/templates/footer');
  }

  public function add_submodule($parent_id,$values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('modules/managesubmodules');
   $this->adminjavascript->include_admin_js = array('UpdateModuleJs');
   $this->data['parent_id']=$parent_id;
   if(count($values) > 0)
   {
    $this->data['title'] .= $values['title'];
	$this->data['page_title'] = $values['page_title'];
	$this->data['submit_value'] = $values['submit_value']; 
	if(isset($values['edit_id']) and !empty($values['edit_id']))
	{
     $this->data['last_modified'] = $this->Login_model->LastModify(ADMIN_MODULES,$values['edit_id']);   
  	 $this->data['edit_id']=$values['edit_id'];
	}
   }
   else
   {
    $values['module_name'] = "";
    $values['url'] = "";
	$this->data['page_title'] = "Add Submodule";
	$this->data['submit_value'] = "Submit"; 
	$this->data['edit_id']='';
   }
   $this->data['parent_info']=$this->Module_List->GetModuleDetails($this->data['parent_id']);
   $this->data['parent_module_name']=$this->data['parent_info']['module_name'];
   $this->data['parent_url']=$this->data['parent_info']['url'];
   
   
   if(!empty($this->data['edit_id'])) $this->data['attributes'] = $this->Module_List->AddSubModuleFormAttribute($values,$this->data['edit_id']);
   else $this->data['attributes']=$this->Module_List->AddSubModuleFormAttribute($values);
   
   $this->load->view(admin.'/modules/add-submodule',$this->data);
  }
  public function edit_submodule($module_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('modules/managesubmodules');
   $values=array();
   $values=$this->Module_List->GetModuleDetails($module_id);
   $values['edit_id']=$module_id;
   $values['current_home_page_icon']=$values['home_page_icon'];
   $values['current_header_icon']=$values['header_icon'];
   $values['current_left_menu_icon']=$values['left_menu_icon'];
   $values['submit_value']="Update";
   $values['page_title']="Edit Submodule";
   $values['title']="Edit Module";
   list($parent_url,$url)=explode("/",$values['url']);
   $values['url']=$url;
   $this->add_submodule($values['parent_id'],$values);
  }
  public function validate_submodule()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('modules/managesubmodules');
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $values=array();
   $values['title'] = "Validate Submodule";
   $values['module_name'] = $this->input->post('module_name');
   $values['url'] = $this->input->post('url');
   $values['parent_url']=$this->input->post('parent_url');
   $values['submit_value'] = $this->input->post('submit_value');
   $values['parent_id']= $this->input->post('parent_id');

   if($values['submit_value']=="Submit") $values['page_title']="Add Submodule";
   else
   {
    $values['page_title']="Edit Submodule";
    $values['edit_id']=$this->input->post('edit_id');
   }
 
   
   if($values['submit_value']=="Submit")
   {
    $this->form_validation->set_rules('module_name', 'submodule name', 'trim|required|callback_is_unique_module['.$values['parent_id'].'~0]');
    $this->form_validation->set_rules('url', 'url', 'trim|required|callback__check_special_chars|callback_is_unique_url['.$values['parent_id'].'~0]');
   }
   else
   {
    $this->form_validation->set_rules('module_name', 'submodule name', 'trim|required|callback_is_unique_module['.$values['parent_id'].'~'.$values['edit_id'].']');
    $this->form_validation->set_rules('url', 'url', 'trim|required|callback__check_special_chars|callback_is_unique_url['.$values['parent_id'].'~'.$values['edit_id'].']');
   }
   
   if($this->form_validation->run()==FALSE)
   { 
    $this->add_submodule($values['parent_id'],$values);
   }
   else
   {
    $records=array();
    $records['module_name']=$values['module_name'];
    $records['url']=str_replace(" ","-",trim($values['parent_url']."/".$values['url']));
    $records['parent_id']=$values['parent_id'];
    $this->data['redirect_url'] = admin."/modules/managesubmodules/".$records['parent_id'];
	if($values['submit_value']=="Submit")
	{
	 $this->Module_List->InsertModule($records,$values['parent_id']); 
	 $message="Submodule added successfully";
	}
	elseif($values['submit_value'] == "Update")
	{
	 $this->Module_List->UpdateModule($records,$values['edit_id']); 
	 $message="Submodule updated successfully";
    }
	$this->RedirectPopupPage($this->data['redirect_url'],$message);
   }
  }  


  
  public function changestatus($record_id,$status,$section,$parent_id="")
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('modules/manage');
   if($section == "manage")
   {
    $this->Login_model->ChangeStatus(ADMIN_MODULES,$record_id,$status,true);
    $this->session->set_flashdata('success_message','Status of module has been changed successfully');
   }
   else
   {
    if($section == "managesubmodules")
    {
     $this->Login_model->ChangeStatus(ADMIN_MODULES,$record_id,$status,true);
     $this->session->set_flashdata('success_message','Status of submodule has been changed successfully');
    }
   }
   if(!empty($parent_id))
   {
    $section.="/$parent_id";
   }
   header("location:".base_url().admin."/modules/$section");
   exit;
  }
  public function UpdatePopUp($module_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('modules/manage');	  
   $this->adminjavascript->include_admin_js=array('UpdateModuleJs');
   $this->data['title'].= "Update Module";
   $values=$this->Module_List->GetModuleDetails($module_id);
   $this->data['parent_id']=$values['parent_id'];
   $this->data['parent_info']=$this->Module_List->GetModuleDetails($this->data['parent_id']);
   $this->data['attributes']=$this->Module_List->GetUpdateModuleFormAttributes($values);
   $this->load->view(admin.'/modules/update_module',$this->data);
  }
  public function checkDuplicate()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('modules/manage');	  	  
   $module_name=$this->input->post('module_name');
   $module_id=$this->input->post('module_id');
   $parent_id=$this->input->post('parent_id');
   echo $this->Module_List->ValidateModuleName($module_name,$module_id,$parent_id);
  }
  public function Update($parent_id)
  { 
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('modules/manage');	  
   if($parent_id == 0) $this->RedirectPage(admin.'/modules/manage','Module name updated successfully'); 
   else $this->RedirectPage(admin.'/modules/managesubmodules/'.$parent_id,'Submodule name updated successfully');
  }
  public function ConfirmSuperadmin($checked_ids,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('modules/manage');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_ids,$item_name);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */   
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message
   $this->data['message']="Are you sure want to delete all selected item(s)";
      
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js=array('SuperAdminValidationJs');
   $this->load->view(admin.'/templates/superadmin-delete',$this->data);
  }
  public function ConfirmDelete($checked_id,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('modules/manage');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_id,$item_name);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message
   $this->data['message']="Are you sure want to delete this record.";
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js=array('ConfirmDeleteJs');
   $this->load->view(admin.'/templates/confirm-delete',$this->data);
  }
  public function DeleteRecord($checked_ids,$item_name) // mandatory Function for each module
  {
   $item_name=urldecode($item_name);
   $all_ids=explode("~",$checked_ids);
   // Delete Record item wise and redirect the page to repective module with success message
   if($item_name == "module")
   {
    if(count($all_ids) > 0)
	{
	 $this->Module_List->DeleteRecordForModules($all_ids);
	 $this->RedirectPage(admin.'/modules/manage','Module has been deleted successfully');
	}
   } 
   if($item_name == "submodule")
   {
    $module_id=$this->Module_List->GetModuleId($all_ids[0]);
	$this->Module_List->DeleteRecordForSubmodules($all_ids);
	$this->RedirectPage(admin.'/modules/managesubmodules/'.$module_id,'Selected Submodule has been deleted successfully');
   }
  }
  public function helptext($submodule_id,$module_id)
  {
   $submit_value=$this->input->post('submit_form');
   $values=array();
   
   $this->data['module_name']=$this->Login_model->GetModuleName($module_id);
   $this->data['submodule_name']=$this->Login_model->GetModuleName($submodule_id);
   
   if(!empty($submit_value))
   {
	$records['help_text']=$this->input->post('help_text');
    $this->Module_List->UpdateHelpText($records,$submodule_id);
	$this->RedirectPopupPage(admin.'/modules/managesubmodules/'.$module_id,'Help text has been updated successfully');
   }
   else
   {
    $values=$this->Login_model->GetHelpTextForUpdation($submodule_id);    
    $this->SetUpCkeditor(); 
    //$this->data['last_modified']=$this->Login_model->LastModify(ADMIN_MODULES,$submodule_id);
    $this->load->helper('form');
    $this->data['attributes']=$this->Module_List->GetHelpTextFormAttribute($values);
    $this->load->view(admin.'/modules/help-text.php',$this->data);
   }
  }
 
 }
