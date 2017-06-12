<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Downloads extends MY_Controller
 {
  public $uploading_image_info;
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Downloads_model');
   $this->load->helper('form');
   $this->load->library('CommonFunctions');	
  }
  public function categories($cat_id='',$values=array())
  {
   if(!empty($cat_id) and count($values) == 0)
   {
    $this->data['title'] ="Categories : Update Category";
	$values=$this->Downloads_model->GetCategoryDetails($cat_id);
   }
   elseif(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
   }
   else
   {
    $values=array();
	$values['category_name']="";
   }

   if(!empty($cat_id))
   {
    $this->data['cat_id']=$cat_id;
    $this->data['page_title']="Edit Category";
	$this->data['last_modified']=$this->Login_model->LastModify(DOWNLOAD_CATEGORIES,$cat_id);
   }
   else
   {
    $this->data['page_title']="Add Category";
   }

    $this->data['all_categories']=$this->Downloads_model->GetAllCategories();
    // attrubutes for deletion of banners
    $this->data['deletion_attributes']=$this->Login_model->GetAtributesForDeletion($this->data['all_categories'],'brochure category','yes');

   $this->data['attributes']=$this->Downloads_model->GetCategoryAttributes($values,$cat_id);
   $this->adminjavascript->include_admin_js=array('ValidateDownloadsFormJs','SuccessMessageJs','DragDropJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/downloads/categories',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validatecategory($cat_id='')
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('downloads/categories');
   $this->data['active_submodule']="categories";
   $values=array();
   $values['title']="Validate Category";
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','Please enter {field}');
   if(empty($cat_id))
   {
    $this->form_validation->set_rules('category_name', 'category name', "trim|required|is_unique[".DOWNLOAD_CATEGORIES.".category_name]");
 
   }
   else
   {
    $this->form_validation->set_rules('category_name', 'category name', 'trim|required|callback_is_unique_on_update['.DOWNLOAD_CATEGORIES.'~category_name~'.$cat_id.'~category name]');

   }
   $values['category_name']=$this->input->post('category_name');
   if($this->form_validation->run() == FALSE)
   { 
	if(!empty($cat_id)) $this->categories($cat_id,$values);
	else $this->categories('',$values);
    
   }
   else
   {
	$records['category_name']=$values['category_name'];
    if(!empty($cat_id))
	{
	 $this->Downloads_model->UpdateCategory($records,$cat_id);
	 $this->RedirectPage(admin.'/downloads/categories','Category has been Updated successfully');
	}
	else
	{
	 $this->Downloads_model->InsertCategory($records);
	 $this->RedirectPage(admin.'/downloads/categories','Category has been added successfully');
	}
   }
  }
  
  public function managedownloads($cat_id='')
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs');
   $this->load->helper('form');    
   $this->data['cat_id']=$cat_id;
   $this->data['drop_down_attributes']=$this->Downloads_model->GetCategoriesDropDownAttribute();
   if(!empty($cat_id))$this->data['brochure_list']=$this->Login_model->GetBrochureList(DOWNLOADS,'cat_id',$cat_id);
   else $this->data['brochure_list']=array();
   if(count($this->data['brochure_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['deletion_attribute']=$this->Login_model->GetAtributesForDeletion($this->data['brochure_list'],'brochure','no',$cat_id);
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/downloads/manage-brochures',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function AddBrochure($cat_id='',$values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('downloads/managedownloads');	  
   $this->data['active_submodule']="managedownloads";
   $this->adminjavascript->include_admin_js=array('ValidateDownloadsFormJs');
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
	$this->data['parent_id']=$values['parent_id'];
	$this->data['submit_value']=$values['submit_value']; 
	if(isset($values['edit_id']) and !empty($values['edit_id']))
	{
     $this->data['last_modified']=$this->Login_model->LastModify(DOWNLOADS,$values['edit_id']);   
	}
   }
   else
   {
    $values['brochure_title']="";
    $values['current_brochure']="";
	$this->data['page_title']="Add Brochure";
	$this->data['parent_id']=$cat_id;  
	$this->data['submit_value']="Submit"; 
   }
   if(!empty($this->data['parent_id']))
   {
	$parent_drop_down_list=$this->Downloads_model->GetCategoryListForDropDown();
	// argument 1. values, 2.submit_type, 3. parent_drop_down_list
    $this->data['attributes']=$this->Login_model->GetBrochureFormAttribute($values,$this->data['submit_value'],$parent_drop_down_list,80);
   }
   // if you have any remarks then assign as $this->data['remarks']="Max size 33 KB"; other wise it takes default remarks
   $this->data['title_remarks']="Max. 80 chars";
   $this->data['file_path']=base_url().admin."/downloads/validatecategorybrochure";
   $this->data['uploading_path']=base_url()."brochures/downloads";
   $this->data['parent_drop_down_title']="Selected Category";
   $this->load->view(admin.'/templates/add-brochure',$this->data);
  }
  public function validatecategorybrochure()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('downloads/managedownloads');
   $this->data['active_submodule']="managedownloads";
   $values=array();
   $values['title']="Validate Brochure";
   $values['brochure_title']=$this->input->post('brochure_title');
   $values['current_brochure']=$this->input->post('current_brochure');

   $values['parent_id']=trim($this->input->post('parent_id'));
   $values['submit_value']=$this->input->post('submit_value');
   if($values['submit_value'] == "Submit") $values['page_title']="Add  Brochure";
   else
   {
    $values['page_title']="Edit Brochure";
    $values['edit_id']=$this->input->post('edit_id');
   }
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required', 'Please enter {field}');    
   
   $this->form_validation->set_rules('brochure_title', 'title', "required");
 
   if(!empty($_FILES['brochure_file']['name']))
   {
	$path_to_upload="./brochures/downloads/";
	// list of argument for brochure validation array // 1.file_name,2.path_to_upload,3.brochure_index,4.max_size
    $news_brochure_info=array("brochure_file",$path_to_upload,"download_brochure",'');
    $news_brochure_info_string=implode("~",$news_brochure_info);
	
    $this->form_validation->set_rules('brochure_file', 'Brochure file', "callback_brochure_validation[{$news_brochure_info_string}]");
   }
   else if($values['submit_value'] == "Submit")
   {
    $this->form_validation->set_rules('brochure_file', 'brochure', "required");
   }
   if(($values['submit_value'] == "Submit" or ($values['submit_value'] == "Update" and !empty($_FILES['brochure_file']['name']))) and ($this->form_validation->run() == FALSE))
   { 
    // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_brochure_info['download_brochure']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_brochure_info['download_brochure']['file_name']);
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
	 $records['brochure_file']=$this->uploading_brochure_info['download_brochure']['file_name'];
	}
	$records['brochure_title']=$values['brochure_title'];
	$records['cat_id']=$values['parent_id'];
    $this->data['redirect_url']=admin."/downloads/managedownloads/".$values['parent_id'];
	if($values['submit_value'] == "Submit")
	{
	 $this->Login_model->InsertBrochure($records,DOWNLOADS,'cat_id'); 
	 $this->session->set_flashdata('success_message',"Brochure has been added successfully");
	}
	elseif($values['submit_value'] == "Update")
	{
	 $this->Login_model->UpdateBrochure($records,$values['edit_id'],DOWNLOADS); 
	 $this->session->set_flashdata('success_message',"Brochure has been updated successfully");
    }
	$this->AddBrochure('',$values);
   }
  }
  public function EditBrochure($brochure_id,$cat_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('downloads/managedownloads');	  
   $this->data['active_submodule']="managedownloads";
   $this->data['last_modified']=$this->Login_model->LastModify(DOWNLOADS,$brochure_id);   
   $values=array();
   $values=$this->Login_model->GetImageBrochureDetails($brochure_id,DOWNLOADS);
   $values['current_brochure']=$values['brochure_file'];
   $values['title']="Edit Brochure";
   $values['parent_id']=$cat_id;
   $values['page_title']="Edit Brochure";
   $values['submit_value']="Update"; 
   $values['edit_id']=$brochure_id;
   $this->AddBrochure($cat_id,$values);
  }
  
  public function ConfirmSuperadmin($checked_ids,$item_name,$parent_id='') // mandatory Function for each module
  {
   if($item_name == "brochure_category")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('downloads/categories');	
	$this->data['message']="If you delete this category, all brochures under this category will be deleted automatically";  	  
   }
   else
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('downloads/manage-downloads');
	$this->data['message']="Are you sure you want to delete all selected item(s)";	  	  
   }
   // 1. checked_ids, 2. item_name, 3. (optional) parent id
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_ids,$item_name,$parent_id);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */   
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message

      
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js=array('SuperAdminValidationJs');
   $this->load->view(admin.'/templates/superadmin-delete',$this->data);
  }
  public function ConfirmDelete($checked_id,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('nowshowing/manageshows');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_id,$item_name,$parent_id);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message
   if($item_name == "brochure category")
   {
	$this->data['message']="If you delete this category, all downloads under this category will be deleted automatically.";
   }
   else
   {
    $this->data['message']="Are you sure you want to delete this brochure.";
   }
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js=array('ConfirmDeleteJs');
   $this->load->view(admin.'/templates/confirm-delete',$this->data);
  }
  public function DeleteRecord($checked_ids,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('downloads/manageproducts');	  	  
	  
   $item_name=urldecode($item_name);
   $all_ids=explode("~",$checked_ids);
   // Delete Record item wise and redirect the page to repective module with success message
   if($item_name == "brochure category")
   {
    if(count($all_ids) > 0)
	{
	 // must delete the products also.
	 $this->Downloads_model->DeleteRecordForCategories($all_ids);
	 $this->RedirectPage(admin.'/downloads/categories','Category has been deleted successfully');
	}
   } 
   if($item_name == "brochure")
   {
    $values=array();
	$this->Login_model->DeleteImageBrochureRecord($all_ids,'cat_id',$parent_id,DOWNLOADS,'brochure_file','./brochures/downloads/');
	$this->RedirectPage(admin.'/downloads/managedownloads/'.$parent_id,'Selected brochure deleted successfully');
   }
  }
  public function changestatus($record_id,$status,$section,$parent_id="")
  {
   if($section == "categories")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('downloads/categories');
    $this->Login_model->ChangeStatus(DOWNLOAD_CATEGORIES,$record_id,$status);
	$message="Status of category has been changed successfully";
   }
   else
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('downloads/managedownloads');
    $this->Login_model->ChangeStatus(DOWNLOADS,$record_id,$status);
	$message="Status of brochure has been changed successfully";
   }
   if(!empty($parent_id))
   {
    $section.="/$parent_id";
   }
   $this->RedirectPage(admin."/downloads/$section",$message);
  } 
 }
