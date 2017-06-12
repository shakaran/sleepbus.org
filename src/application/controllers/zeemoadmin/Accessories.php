<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Accessories extends MY_Controller
 {
  public $uploading_image_info;
  public $uploading_brochure_info;
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Accessories_model');
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
	$this->RedirectPage(admin.'/accessories/toptext','Top text has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(1);    
   }
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,1);
   $this->data['attributes']=$this->Accessories_model->GetTopTextFormAttribute($values);
   $this->load->library('fckeditor',$this->data['attributes']['fckeditorConfig']);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/accessories/top-text',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function addaccessories($values=array())
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateAccessoriesFormJs');
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
   }
   else
   {
    $values['accessories_title']="";
    $values['description']="";	
	$this->data['page_title']="Add Accessories";
   }
   if(!empty($this->data['accessories_id']))
   {
    $this->data['attributes']=$this->Accessories_model->GetAccessoriesFormAttribute($values,$this->data['accessories_id']);
   }
   else
   {
    $this->data['attributes']=$this->Accessories_model->GetAccessoriesFormAttribute($values);
   }
   $this->load->library('fckeditor',$this->data['attributes']['fckeditorConfig']);
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/accessories/addaccessories',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validateaccessories()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('accessories/addaccessories');
   $this->data['active_submodule']="addaccessories";
   $values=array();
   $values['title']="Validate Accessories";
   $accessories_id=$this->input->post('accessories_id');
   
   $values['description']=$this->input->post('description');
   $values['current_image']=$this->input->post('current_image');
   $values['accessories_title']=$this->input->post('accessories_title');
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_rules('description', 'description', 'trim|required');
   
   if(!empty($accessories_id))
   {
    $values['page_title']="Edit Accessories";
    $this->data['accessories_id']=$accessories_id;
    $this->form_validation->set_rules('accessories_title', 'title', 'trim|required|callback_is_unique_on_update['.ACCESSORIES.'~accessories_title~'.$accessories_id.'~accessories title]');
   }
   else
   {
    $values['page_title']="Add Accessories";
    $this->form_validation->set_rules('accessories_title', 'title', 'trim|required|is_unique['.ACCESSORIES.'.accessories_title]');
   }
   
   if(!empty($_FILES['image_file']['name']))
   {
	$path_to_upload="./images/accessories/";
	// list of argument for image validation array
// 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $accessories_image_info=array("image_file",$path_to_upload,"image","","","","",'');
    $accessories_image_info_string=implode("~",$accessories_image_info);
    $this->form_validation->set_rules('image_file', 'Image file', "callback_image_validation[{$accessories_image_info_string}]");
   }
   
   if($this->form_validation->run() == FALSE)
   { 
    // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_image_info['image']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['image']['file_name']);
	}
    $this->addaccessories($values);
   }
   else
   {
    if(!empty($_FILES['image_file']['name']))
	{
	 // delete previous image
	 if(!empty($accessories_id) and !empty($values['current_image']))
	 {
	  unlink($path_to_upload.$values['current_image']);
	 }
	 $records['image_file']=$this->uploading_image_info['image']['file_name'];
	}
	$records['description']=$values['description'];
	$records['accessories_title']=$values['accessories_title'];
    if(!empty($accessories_id))
	{
	 $this->Accessories_model->UpdateAccessories($records,$accessories_id);
	 $this->RedirectPage(admin.'/accessories/manageaccessories','Accessories updated successfully');
	}
	else
	{
	 $this->Accessories_model->InsertAccessories($records);
	 $this->RedirectPage(admin.'/accessories/manageaccessories','Accessories added successfully');
	}
   }
  }
  public function editaccessories($accessories_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('accessories/addaccessories');	  
   $this->data['active_submodule']="addaccessories";
   $this->data['last_modified']=$this->Login_model->LastModify(ACCESSORIES,$accessories_id);   

   $values=array();
   $values=$this->Accessories_model->GetAccessoriesDetails($accessories_id);
   $values['page_title']="Edit Accessories";
   $values['title']="Edit Accessories";
   $values['submit_value']="Update";
   $this->data['accessories_id']=$accessories_id;
   $this->addaccessories($values);
  }  
  public function manageaccessories()
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs');
   //$this->admincss->including_css_func=array('PrettyPhotoCss');   
   $this->load->helper('form');    
   $this->data['accessories_list']=$this->Accessories_model->GetAccessoriesList();
   if(count($this->data['accessories_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['attribute']=$this->Login_model->GetAtributesForDeletion($this->data['accessories_list'],'accessories','no');
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/accessories/manage-accessories',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function managedownloads($accessories_id='')
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateAccessoriesFormJs','DragDropJs');
   $this->load->helper('form');    
   $this->data['accessories_id']=$accessories_id;
   $this->data['drop_down_attributes']=$this->Accessories_model->GetAccessoriesDropDownAttribute();
   if(!empty($accessories_id))$this->data['brochure_list']=$this->Login_model->GetBrochureList(ACCESSORIES_BROCHURES,'accessories_id',$accessories_id);
   else $this->data['brochure_list']=array();
   if(count($this->data['brochure_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['deletion_attribute']=$this->Login_model->GetAtributesForDeletion($this->data['brochure_list'],'brochure','no',$accessories_id);
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/accessories/manage-brochures',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function AddBrochure($accessories_id='',$values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('accessories/managedownloads');	  
   $this->data['active_submodule']="managedownloads";
   $this->adminjavascript->include_admin_js=array('ValidateAccessoriesFormJs');
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
	$this->data['parent_id']=$values['parent_id'];
	$this->data['submit_value']=$values['submit_value']; 
	if(isset($values['edit_id']) and !empty($values['edit_id']))
	{
     $this->data['last_modified']=$this->Login_model->LastModify(ACCESSORIES_BROCHURES,$values['edit_id']);   
	}
   }
   else
   {
    $values['brochure_title']="";
    $values['current_brochure']="";
	$this->data['page_title']="Add Accessories Brochure";
	$this->data['parent_id']=$accessories_id;  
	$this->data['submit_value']="Submit"; 
   }
   if(!empty($this->data['parent_id']))
   {
	$parent_drop_down_list=$this->Accessories_model->GetAccessoriesListForDropDown();
	// argument 1. values, 2.submit_type, 3. parent_drop_down_list
    $this->data['attributes']=$this->Login_model->GetBrochureFormAttribute($values,$this->data['submit_value'],$parent_drop_down_list);
   }
   
   // if you have any remarks then assign as $this->data['remarks']="Max size 33 KB"; other wise it takes default remarks
   
   $this->data['file_path']=base_url().admin."/accessories/validateaccessoriessbrochure";
   $this->data['uploading_path']=base_url()."images/accessories";
   $this->data['parent_drop_down_title']="Selected Accessory";
   $this->load->view(admin.'/templates/add-brochure',$this->data);
  }
  public function validateaccessoriessbrochure()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('accessories/managedownloads');
   $this->data['active_submodule']="managedownloads";
   $values=array();
   $values['title']="Validate Accessories Brochure";
   $values['brochure_title']=$this->input->post('brochure_title');
   $values['current_brochure']=$this->input->post('current_brochure');

   $values['parent_id']=trim($this->input->post('parent_id'));
   $values['submit_value']=$this->input->post('submit_value');
   if($values['submit_value'] == "Submit") $values['page_title']="Add Accessories Brochure";
   else
   {
    $values['page_title']="Edit Accessories Brochure";
    $values['edit_id']=$this->input->post('edit_id');
   }
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required', 'Please enter {field}');    
   
   $this->form_validation->set_rules('brochure_title', 'title', "required");
 
   if(!empty($_FILES['brochure_file']['name']))
   {
	$path_to_upload="./images/accessories/";
	// list of argument for brochure validation array // 1.file_name,2.path_to_upload,3.brochure_index,4.max_size
    $accessories_brochure_info=array("brochure_file",$path_to_upload,"accessories_brochure",'');
    $accessories_brochure_info_string=implode("~",$accessories_brochure_info);
	
    $this->form_validation->set_rules('brochure_file', 'Brochure file', "callback_brochure_validation[{$accessories_brochure_info_string}]");
   }
   else if($values['submit_value'] == "Submit")
   {
    $this->form_validation->set_rules('brochure_file', 'brochure', "required");
   }
   if(($values['submit_value'] == "Submit" or ($values['submit_value'] == "Update" and !empty($_FILES['brochure_file']['name']))) and ($this->form_validation->run() == FALSE))
   { 
    // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_brochure_info['accessories_brochure']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_brochure_info['accessories_brochure']['file_name']);
	}
    $this->AddBrochure('',$values);
   }
   else
   {
    $records=array();
    if(!empty($_FILES['brochure_file']['name']))
	{
	 // delete previous brochure
	 if(!empty($values['current_brochure']))
	 {
	  unlink($path_to_upload.$values['current_brochure']);
	 }
	 $records['brochure_file']=$this->uploading_brochure_info['accessories_brochure']['file_name'];
	}
	$records['brochure_title']=$values['brochure_title'];
	$records['accessories_id']=$values['parent_id'];
    $this->data['redirect_url']=admin."/accessories/managedownloads/".$values['parent_id'];
	if($values['submit_value'] == "Submit")
	{
	 $this->Login_model->InsertBrochure($records,ACCESSORIES_BROCHURES,'accessories_id'); 
	 $this->session->set_flashdata('success_message',"Brochure has been added successfully");
	}
	elseif($values['submit_value'] == "Update")
	{
	 $this->Login_model->UpdateBrochure($records,$values['edit_id'],ACCESSORIES_BROCHURES); 
	 $this->session->set_flashdata('success_message',"Brochure has been updated successfully");
    }
	$this->AddBrochure('',$values);
   }
  }
  public function EditBrochure($brochure_id,$accessories_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('accessories/managedownloads');	  
   $this->data['active_submodule']="managedownloads";
   $this->data['last_modified']=$this->Login_model->LastModify(ACCESSORIES_BROCHURES,$brochure_id);   
   $values=array();
   $values=$this->Login_model->GetImageBrochureDetails($brochure_id,ACCESSORIES_BROCHURES);
   $values['current_brochure']=$values['brochure_file'];
   $values['title']="Edit Accessories Brochure";
   $values['parent_id']=$accessories_id;
   $values['page_title']="Edit Accessories Brochure";
   $values['submit_value']="Update"; 
   $values['edit_id']=$brochure_id;
   $this->AddBrochure($accessories_id,$values);
  }
  public function ConfirmSuperadmin($checked_ids,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('accessories/manageaccessories');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_ids,$item_name);
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
   $this->admincss->including_css_func=array('PrettyPhotoCss');  
   $this->load->view(admin.'/templates/superadmin-delete',$this->data);
  }
  public function ConfirmDelete($checked_id,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('accessories/manageaccessories');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_id,$item_name);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message
   if($item_name == "image")
   {
	$this->data['message']="Are you sure you want to delete this image.";
   }
   elseif($item_name == "brochure")
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
  public function DeleteRecord($checked_ids,$item_name) // mandatory Function for each module
  {
   $item_name=urldecode($item_name);
   $all_ids=explode("~",$checked_ids);
   // Delete Record item wise and redirect the page to repective module with success message
   if($item_name == "accessories")
   {
    if(count($all_ids) > 0)
	{
	 $this->Accessories_model->DeleteRecordForAccessories($all_ids);
	 $this->RedirectPage(admin.'/accessories/manageaccessories','Accessories  deleted successfully');
	}
   } 
   if($item_name == "image")
   {
    $values=array();
    $values=$this->Accessories_model->GetAccessoriesDetails($checked_ids);
	if(!empty($values['current_image']))
	{
	 unlink('./images/accessories/'.$values['current_image']);
	}
	$records['image_file']="";
	$this->Accessories_model->UpdateRecordAfterDeletion($checked_ids,$records);
	$this->RedirectPage(admin.'/accessories/editaccessories/'.$checked_ids,'Image has been deleted successfully');
   }
   if($item_name == "brochure")
   {
    $values=array();
    $table_name=ACCESSORIES_BROCHURES;
	$this->Login_model->DeleteImageBrochureRecord($all_ids,'accessories_id',$parent_id,$table_name,'brochure_file','./images/accessories/');
	$this->RedirectPage(admin.'/accessories/managedownloads/'.$parent_id,'Selected brochure deleted successfully');
   }
   
   
  }
  public function changestatus($record_id,$status,$section,$parent_id="")
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('accessories/manageaccessories');
   if($section == "managedownloads")
   {
    $this->Login_model->ChangeStatus(ACCESSORIES_BROCHURES,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of brochure has been changed successfully'); 
   }
   else
   {
    $this->Login_model->ChangeStatus(ACCESSORIES,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of accessories has been changed successfully');
   }
   if(!empty($parent_id))
   {
    $section.="/$parent_id";
   }
   header("location:".base_url().admin."/accessories/$section");
   exit;
  } 
 }
