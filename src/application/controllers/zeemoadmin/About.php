<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class About extends MY_Controller
 {
  public $uploading_image_info;
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/About_model');
   $this->load->helper('form');
   $this->load->library('CommonFunctions');	   
  }

  public function manage_pages()
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs','ValidateAboutFormJs');
   $this->load->helper('form');
   $this->data['item_list']=$this->About_model->GetAboutSectionList();

   if(count($this->data['item_list']) > 0)
   {
    /*******************************************
    Arguments for GetAtributesForDeletion function : 
	1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 
	4. parent_id if you have(optional);
    ******************************************/
   $this->data['deletion_attribute']=$this->Login_model->GetAtributesForDeletion($this->data['item_list'],'about page','no');
   }

   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/about/manage-pages',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function add_page($values=array())
  {
   $this->SetUpCkeditor(); 
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('about/add-page');	  
   $this->data['active_submodule']="add-page";
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
	$this->data['submit_value']=$values['submit_value']; 
    $this->data['image_quality']=$values['image_quality'];  			
   	if(isset($values['edit_id']) and !empty($values['edit_id']))
	{
     $this->data['last_modified']=$this->Login_model->LastModify(ABOUT_SECTION,$values['edit_id']);   
	}
   }
   else
   {
    $values['item_title']="";
    $values['page_heading']="";
    $values['intro_text']="";
    $values['description']="";	
    $values['url']="";
	$values['page_type']="1";
    $values['image_alt_title_text']="";	
    $this->data['image_quality']='';  	
	$this->data['page_title']="Add Page";
	$this->data['submit_value']="Submit"; 
   }
   $this->data['attributes']=$this->About_model->GetAboutSectionAttribute($values);
   
   $this->data['image_quality_options']=$this->Login_model->GetImageQualityOptions();
   $this->adminjavascript->include_admin_js=array('ValidateAboutFormJs');
   /*********************************************
   if you have any remarks then assign as 
   $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)"; other wise it takes default remarks
   *********************************************/
   $this->data['file_path']=base_url().admin."/about/validatepage";
   $this->data['image_remarks']="Max size must be (575 x 298) (Width x Height)";
   $this->data['image_quality_options']=$this->Login_model->GetImageQualityOptions();

   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/about/add-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validatepage()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('about/add-page');
   $this->data['active_submodule']="add-page";
   $values=array();
   $values['title']="Validate Page";
   $values['item_title']=$this->input->post('item_title');
   $values['page_heading']=$this->input->post('page_heading');
   $values['intro_text']=$this->input->post('intro_text');
   $values['description']=$this->input->post('description');
   $values['page_type']=$this->input->post('page_type');   
   $values['url']=$this->input->post('url');
   $values['image_alt_title_text'] = $this->input->post('image_alt_title_text');
   $values['image_quality']=$this->input->post('image_quality');   
 
   $values['submit_value']=$this->input->post('submit_value');
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message("required","%s");
   $this->form_validation->set_message("is_unique","%s");
   
   
   $this->form_validation->set_rules('item_title', 'Please enter page name/title', "trim|required");
   $this->form_validation->set_rules('intro_text', 'Please intro text', "trim|required");   
   if($values['page_type']=='2')
   {
	if(trim($values['url'])=='') $this->form_validation->set_rules('url', 'Please intro text', "trim|required");  
	if(trim($values['url'])!='') $this->form_validation->set_rules('url','Invalid URL','trim|callback__validateURL');   	    
   }
   
   if($values['submit_value']=="Submit")
   {
    $values['page_title']="Add Page";
    $this->form_validation->set_rules('item_title', 'This page already eixts', 'trim|required|is_unique['.ABOUT_SECTION.'.item_title]');    
   }
   else
   {
    $values['page_title']="Edit Page";
    $values['edit_id']=$this->input->post('edit_id');
    $this->form_validation->set_rules('item_title', 'title', 'trim|required|callback_is_unique_on_update['.ABOUT_SECTION.'~item_title~'.$values['edit_id'].'~page title]');    
   }
   
   $path_to_upload="./images/generalpages/";
   if(!empty($_FILES['image_file']['name']))
   {
	// list of argument for image validation array
    // 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $page_image_info=array("image_file",$path_to_upload,"page_image","575","298","","",'');
    $page_image_info_string=implode("~",$page_image_info);
    $this->form_validation->set_rules('image_file', 'page image', "callback_image_validation[{$page_image_info_string}]");
   }
      
   if($this->form_validation->run() == FALSE) 
   { 
	if(!empty($this->uploading_image_info['page_image']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['page_image']['file_name']);
	}	   
    $this->add_page($values);
   }
   else
   {
    $records=array();
	$records['item_title']=$values['item_title'];
	$records['page_heading']=$values['page_heading'];
	$records['intro_text']=$values['intro_text'];
	$records['description']=$values['description'];
	$records['page_type']=$values['page_type'];
    if($records['page_type']=='2') $records['description'] = ''; 	
    $records['image_alt_title_text'] = $values['image_alt_title_text'];			
	
    if(!empty($_FILES['image_file']['name']))
	{
	 //delete previous image
	 if(!empty($values['current_image']))
	 {
	  unlink($path_to_upload.$values['current_image']);
	 }
	 $records['image_file']=$this->uploading_image_info['page_image']['file_name'];
	 $this->ReduceImageWeight($records['image_file'],$path_to_upload, $values['image_quality']);
     $records['image_quality']=$values['image_quality'];
	}	
	
    $this->data['redirect_url']=admin."/about/add-page";
	if($values['submit_value']=="Submit")
	{
	 $records['url']=$values['url'];		
	 if($records['page_type']=='1')	
	 {
	  $url = strtolower(str_replace(' ','-',$this->commonfunctions->RemoveSpecialChars($records['item_title'])));		
	  $records['url'] = $this->Login_model->GenerateNewUrl($url);	 
	 }
	 $this->About_model->InsertAboutItem($records); 
	 $message="Item has been added successfully";
	}
	elseif($values['submit_value']=="Update")
	{
	 $prev_record = $this->About_model->GetAboutDetails($values['edit_id']);
	 if($records['page_type']=='1')
	 {
	  if($prev_record['page_type'] != $records['page_type'])	 
	  {
	   $url = strtolower(str_replace(' ','-',$this->commonfunctions->RemoveSpecialChars($records['item_title'])));		
	   $records['url'] = $this->Login_model->GenerateNewUrl($url);	 
	  }
	 }
	 else $records['url']=$values['url'];
	 $this->About_model->UpdatetAboutItem($records,$values['edit_id']); 
	 $message="Item has been updated successfully";
    }
    $this->RedirectPopupPage(admin."/about/manage-pages",$message);
   }
  }
  public function edit_page($page_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('about/add-page');	  
   $this->data['active_submodule']="add-page";
   $this->data['last_modified']=$this->Login_model->LastModify(ABOUT_SECTION,$page_id);   
   $values=array();
   $values=$this->About_model->GetAboutDetails($page_id);
   $values['current_image']=$values['image_file'];
   $values['title']="Edit Page";
   $values['page_title']="Edit Page";
   $values['submit_value']="Update"; 
   $values['edit_id']=$page_id;
   $this->data['image_id']=$page_id;
   $this->add_page($values);
  }

  public function ConfirmSuperadmin($checked_ids,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('about/manage-pages');	  	  	  

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
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('about/manage-pages');	  	  	  

   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_id,$item_name,$parent_id);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message
   if($item_name == "Image")
   {
	$this->data['message']="Are you sure you want to delete this image.";
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
   $all_ids=explode("~",$checked_ids);
   // Delete Record item wise and redirect the page to repective module with success message
   if($item_name=="image")
   {
	$id = $checked_ids[0];   
    $this->About_model->DeletePageImage($id);
	$this->RedirectPage(admin.'/about/edit-page/'.$id, 'Image deleted successfully');
   }
   elseif($item_name == "about page")
   {
    $values=array();
   
	$this->About_model->DeleteAboutRecord($all_ids);
	$this->RedirectPage(admin.'/about/manage-pages/','Selected item(s) deleted successfully');
   }
  
  }
  public function changestatus($record_id,$status,$section,$parent_id="")
  {
   if($section=="manage_pages")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('about/manage-pages');
    $this->Login_model->ChangeStatus(ABOUT_SECTION,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of item has been changed successfully'); 
	$section=str_replace("_","-",$section);
   }
   if(!empty($parent_id))
   {
    $section.="/$parent_id";
   }
   header("location:".base_url().admin."/about/$section");
   exit;
  } 
  
 }
