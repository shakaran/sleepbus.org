<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class News extends MY_Controller
 {
  public $uploading_image_info;
  public $uploading_brochure_info;
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/News_model');
   $this->load->helper('form');
   $this->load->library('CommonFunctions');	
  }
  public function addnews($values=array())
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateNewsFormJs','CalendarJs');
   $this->admincss->including_css_func=array('CalendarCss'); 
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
   }
   else
   {
    $values['news_title']="";
    $values['description']="";
    $values['intro_text']="";
	$values['date_display']=date("d-m-Y");
	$this->data['page_title']="Add News";
   }
   if(!empty($this->data['news_id']))
   {
    $this->data['attributes']=$this->News_model->GetNewsFormAttribute($values,$this->data['news_id']);
   }
   else
   {
    $this->data['attributes']=$this->News_model->GetNewsFormAttribute($values);
   }
   $this->SetUpCkeditor();    
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/news/add-news',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validatenews()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('news/addnews');
   $this->data['active_submodule']="addnews";
   $values=array();
   $values['title']="Validate News";
   $news_id=$this->input->post('news_id');
   
   $values['description']=$this->input->post('description');
   $values['news_title']=$this->input->post('news_title');
   $values['intro_text']=trim($this->input->post('intro_text'));
   $values['date_display']=$this->input->post('date_display');
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required',"Please enter {field}");   

   if(!empty($news_id))
   {
    $values['page_title']="Edit News";
    $this->data['news_id']=$news_id;
    $this->form_validation->set_rules('news_title', 'news title', 'trim|required|callback_is_unique_on_update['.NEWS.'~news_title~'.$news_id.'~news title]');
   }
   else
   {
    $values['page_title']="Add News";
    $this->form_validation->set_rules('news_title', 'news title', 'trim|required|is_unique['.NEWS.'.news_title]');
   }
   
   $this->form_validation->set_rules('intro_text', 'intro text', 'trim|required'); 
   
   $this->form_validation->set_rules('description', 'description', 'trim|required');
   

   if($this->form_validation->run() == FALSE)
   { 
    $this->addnews($values);
   }
   else
   {
	$records['description']=$values['description'];
	$records['news_title']=$values['news_title'];
	$records['intro_text']=$values['intro_text'];
	$records['date_display']=$values['date_display'];
    $news_url = strtolower(str_replace(" ","-",$this->commonfunctions->RemoveSpecialChars($records['news_title'])));

    if(!empty($news_id))
	{
	 $this->News_model->UpdateNews($records,$news_id);
	 $this->RedirectPage(admin.'/news/managenews','News has been Updated successfully');
	}
	else
	{
     $records['url'] = $this->Login_model->GenerateURL(NEWS,"url",$news_url);
	 $this->News_model->InsertNews($records);
	 $this->RedirectPage(admin.'/news/managenews','News has been added successfully');
	}
   }
  }
  public function editnews($news_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('news/addnews');	  
   $this->data['active_submodule']="addnews";
   $this->data['last_modified']=$this->Login_model->LastModify(NEWS,$news_id);   

   $values=array();
   $values=$this->News_model->GetNewsDetails($news_id);
   $values['page_title']="Edit News";
   $values['title']="Edit News";
   $values['submit_value']="Update";
   $this->data['news_id']=$news_id;
   $this->addnews($values);
  }  
  public function managenews()
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs');
   $this->load->helper('form');    
   $this->data['news_list']=$this->News_model->GetNewsList();
   if(count($this->data['news_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['attribute']=$this->Login_model->GetAtributesForDeletion($this->data['news_list'],'news','yes');
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/news/manage-news',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function manageimages($news_id='')
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs');
   $this->load->helper('form');    
   $this->data['news_id']=$news_id;
   $this->data['drop_down_attributes']=$this->News_model->GetNewsDropDownAttribute();
   if(!empty($news_id))$this->data['image_list']=$this->Login_model->GetImageList(NEWS_IMAGES,'news_id',$news_id);
   else $this->data['image_list']=array();
   if(count($this->data['image_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['deletion_attribute']=$this->Login_model->GetAtributesForDeletion($this->data['image_list'],'Image','no',$news_id);
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/news/manage-images',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function AddImage($news_id='',$values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('news/manageimages');	  
   $this->data['active_submodule']="manageimages";
   $this->adminjavascript->include_admin_js=array('ValidateNewsFormJs');
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
	$this->data['parent_id']=$values['parent_id'];
	$this->data['submit_value']=$values['submit_value']; 
    $this->data['image_quality']=$values['image_quality'];  
	if(isset($values['edit_id']) and !empty($values['edit_id']))
	{
     $this->data['last_modified']=$this->Login_model->LastModify(NEWS_IMAGES,$values['edit_id']);   
	}
   }
   else
   {
    $this->data['image_quality']='';  
    $values['image_title']="";
    $values['current_image']="";
    $values['description']="";
    $values['image_alt_title_text']="";	
	$this->data['page_title']="Add News Image";
	$this->data['parent_id']=$news_id;  
	$this->data['submit_value']="Submit"; 
   }
   if(!empty($this->data['parent_id']))
   {
	$parent_drop_down_list=$this->News_model->GetNewsListForDropDown();
	// argument 1. values, 2.submit_type, 3. parent_drop_down_list 4. Character count of title (optional)
    $this->data['attributes']=$this->Login_model->GetImageFormAttribute($values,$this->data['submit_value'],$parent_drop_down_list,30);
   }
   
   // if you have any remarks then assign as $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)"; other wise it takes default remarks, similarly for title also
   $this->data['title_remarks']="*(Max 30 Chars)";
   $this->data['image_quality_options']=$this->Login_model->GetImageQualityOptions();
   $this->data['file_path']=base_url().admin."/news/validatenewsimage";
   $this->data['uploading_path']=base_url()."images/news";
   $this->data['parent_drop_down_title']="Selected News";
   $this->load->view(admin.'/templates/add-image',$this->data);
  }
  public function EditImage($image_id,$news_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('news/manageimages');	  
   $this->data['active_submodule']="manageimages";
   $this->data['last_modified']=$this->Login_model->LastModify(NEWS_IMAGES,$image_id);   
   $values=array();
   $values=$this->Login_model->GetImageBrochureDetails($image_id,NEWS_IMAGES);
   $values['current_image']=$values['image_file'];
   $values['title']="Edit Image";
   $values['parent_id']=$news_id;
   $values['page_title']="Edit Image";
   $values['submit_value']="Update"; 
   $values['edit_id']=$image_id;
   $this->AddImage($news_id,$values);
  }
  public function edit_brochure($brochure_id,$news_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('news/managedownloads');	  
   $this->data['active_submodule']="managedownloads";
   $this->data['last_modified']=$this->Login_model->LastModify(NEWS_BROCHURES,$brochure_id);   
   $values=array();
   $values=$this->Login_model->GetImageBrochureDetails($brochure_id,NEWS_BROCHURES);
   $values['current_brochure']=$values['brochure_file'];
   $values['title']="Edit News Brochure";
   $values['parent_id']=$news_id;
   $values['page_title']="Edit News Brochure";
   $values['submit_value']="Update"; 
   $values['edit_id']=$brochure_id;
   $this->AddBrochure($news_id,$values);
  }
  public function validatenewsimage()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('news/manageimages');
   $this->data['active_submodule']="manageimages";
   $values=array();
   $values['title']="Validate News Image";
   $values['image_title']=$this->input->post('image_title');
   $values['current_image']=$this->input->post('current_image');
   // if there is a description field
   $values['description']=$this->input->post('description');
   $values['parent_id']=trim($this->input->post('parent_id'));
   $values['submit_value']=$this->input->post('submit_value');
   $values['image_alt_title_text']=$this->input->post('image_alt_title_text');
   $values['image_quality']=$this->input->post('image_quality');
   if($values['submit_value'] == "Submit") $values['page_title']="Add News Image";
   else
   {
    $values['page_title']="Edit News Image";
    $values['edit_id']=$this->input->post('edit_id');
   }
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
 
   if(!empty($_FILES['image_file']['name']))
   {
	$path_to_upload="./images/news/";
	// list of argument for image validation array
// 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $news_image_info=array("image_file",$path_to_upload,"news_image","","","","",'');
    $news_image_info_string=implode("~",$news_image_info);
    $this->form_validation->set_rules('image_file', 'image', "callback_image_validation[{$news_image_info_string}]");
   }
   else if($values['submit_value'] == "Submit")
   {
    $this->form_validation->set_rules('image_file', 'image', "required");
   }
   if($this->form_validation->run() == FALSE)
   { 
    // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_image_info['news_image']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['news_image']['file_name']);
	}
    $this->AddImage('',$values);
   }
   else
   {
    $records=array();
    if(!empty($_FILES['image_file']['name']))
	{
	 // delete previous image
	 if(!empty($values['current_image']))
	 {
	  unlink($path_to_upload.$values['current_image']);
	 }
	 $records['image_file']=$this->uploading_image_info['news_image']['file_name'];
	 $this->ReduceImageWeight($records['image_file'],$path_to_upload, $values['image_quality']);
  	 $records['image_quality']=$values['image_quality'];
	}
	$records['image_alt_title_text']=$values['image_alt_title_text'];
	$records['image_title']=$values['image_title'];
	$records['news_id']=$values['parent_id'];
	$records['description']=$values['description'];
	
    $this->data['redirect_url']=admin."/news/manageimages/".$values['parent_id'];
	if($values['submit_value'] == "Submit")
	{
	 $this->Login_model->InsertImage($records,NEWS_IMAGES,'news_id'); 
	 $message="Image has been added successfully";
	}
	elseif($values['submit_value'] == "Update")
	{
	 $this->Login_model->UpdateImage($records,$values['edit_id'],NEWS_IMAGES); 
	  $message="Image has been updated successfully";
    }
	$this->RedirectPopupPage($this->data['redirect_url'],$message);
   }
  }  
  public function managedownloads($news_id='')
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs');
   $this->load->helper('form');    
   $this->data['news_id']=$news_id;
   $this->data['drop_down_attributes']=$this->News_model->GetNewsDropDownAttribute();
   if(!empty($news_id))$this->data['brochure_list']=$this->Login_model->GetBrochureList(NEWS_BROCHURES,'news_id',$news_id);
   else $this->data['brochure_list']=array();
   if(count($this->data['brochure_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['deletion_attribute']=$this->Login_model->GetAtributesForDeletion($this->data['brochure_list'],'Brochure','no',$news_id);
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/news/manage-brochures',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function AddBrochure($news_id='',$values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('news/managedownloads');	  
   $this->data['active_submodule']="managedownloads";
   $this->adminjavascript->include_admin_js=array('ValidateNewsFormJs');
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
	$this->data['parent_id']=$values['parent_id'];
	$this->data['submit_value']=$values['submit_value']; 
	if(isset($values['edit_id']) and !empty($values['edit_id']))
	{
     $this->data['last_modified']=$this->Login_model->LastModify(NEWS_BROCHURES,$values['edit_id']);   
	}
   }
   else
   {
    $values['brochure_title']="";
    $values['current_brochure']="";
	$this->data['page_title']="Add News Brochure";
	$this->data['parent_id']=$news_id;  
	$this->data['submit_value']="Submit"; 
   }
   if(!empty($this->data['parent_id']))
   {
	$parent_drop_down_list=$this->News_model->GetNewsListForDropDown();
	// argument 1. values, 2.submit_type, 3. parent_drop_down_list
    $this->data['attributes']=$this->Login_model->GetBrochureFormAttribute($values,$this->data['submit_value'],$parent_drop_down_list,30);
   }
   
   // if you have any remarks then assign as $this->data['remarks']="Max size 33 KB"; other wise it takes default remarks
   $this->data['title_remarks']="*(Max 30 Chars)";
   $this->data['file_path']=base_url().admin."/news/validatenewsbrochure";
   $this->data['uploading_path']=base_url()."images/news";
   $this->data['parent_drop_down_title']="Selected News";
   $this->load->view(admin.'/templates/add-brochure',$this->data);
  }
  public function validatenewsbrochure()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('news/managedownloads');
   $this->data['active_submodule']="managedownloads";
   $values=array();
   $values['title']="Validate News Brochure";
   $values['brochure_title']=$this->input->post('brochure_title');
   $values['current_brochure']=$this->input->post('current_brochure');

   $values['parent_id']=trim($this->input->post('parent_id'));
   $values['submit_value']=$this->input->post('submit_value');
   if($values['submit_value'] == "Submit") $values['page_title']="Add News Brochure";
   else
   {
    $values['page_title']="Edit News Brochure";
    $values['edit_id']=$this->input->post('edit_id');
   }
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required', 'Please enter {field}');    
   
   $this->form_validation->set_rules('brochure_title', 'title', "required");

 
   if(!empty($_FILES['brochure_file']['name']))
   {
	$path_to_upload="./brochures/news/";
	// list of argument for brochure validation array // 1.file_name,2.path_to_upload,3.brochure_index,4.max_size
    $news_brochure_info=array("brochure_file",$path_to_upload,"news_brochure",'');
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
	if(!empty($this->uploading_brochure_info['news_brochure']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_brochure_info['news_brochure']['file_name']);
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
	 $records['brochure_file']=$this->uploading_brochure_info['news_brochure']['file_name'];
	}
	$records['brochure_title']=$values['brochure_title'];
	$records['news_id']=$values['parent_id'];
    $this->data['redirect_url']=admin."/news/managedownloads/".$values['parent_id'];
	if($values['submit_value'] == "Submit")
	{
	 $this->Login_model->InsertBrochure($records,NEWS_BROCHURES,'news_id'); 
	 $this->session->set_flashdata('success_message',"Brochure has been added successfully");
	}
	elseif($values['submit_value'] == "Update")
	{
	 $this->Login_model->UpdateBrochure($records,$values['edit_id'],NEWS_BROCHURES); 
	 $this->session->set_flashdata('success_message',"Brochure has been updated successfully");
    }
	$this->AddBrochure('',$values);
   }
  }
  public function EditBrochure($brochure_id,$news_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('news/managedownloads');	  
   $this->data['active_submodule']="managedownloads";
   $this->data['last_modified']=$this->Login_model->LastModify(NEWS_BROCHURES,$brochure_id);   
   $values=array();
   $values=$this->Login_model->GetImageBrochureDetails($brochure_id,NEWS_BROCHURES);
   $values['current_brochure']=$values['brochure_file'];
   $values['title']="Edit News Brochure";
   $values['parent_id']=$news_id;
   $values['page_title']="Edit News Brochure";
   $values['submit_value']="Update"; 
   $values['edit_id']=$brochure_id;
   $this->AddBrochure($news_id,$values);
  }
  public function ConfirmSuperadmin($checked_ids,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('news/managenews');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_ids,$item_name,$parent_id);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */   
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message
   if($item_name == "news")
   {
    $this->data['message']="Are you sure you want to delete all selected item(s).<br /> All images and brochures related to news will also be deleted automatically";
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
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('news/managenews');	  	  
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
   $all_ids=explode("~",$checked_ids);
   // Delete Record item wise and redirect the page to repective module with success message
   if($item_name == "news")
   {
    if(count($all_ids) > 0)
	{
	 $this->News_model->DeleteRecordForNews($all_ids);
	 $this->RedirectPage(admin.'/news/managenews','News has been deleted successfully');
	}
   } 
   if($item_name == "Image")
   {
    $values=array();
    $table_name=NEWS_IMAGES;
	$this->Login_model->DeleteImageBrochureRecord($all_ids,'news_id',$parent_id,$table_name,'image_file','./images/news/');
	$this->RedirectPage(admin.'/news/manageimages/'.$parent_id,'Selected image deleted successfully');
   }
   if($item_name == "Brochure")
   {
    $values=array();
    $table_name=NEWS_BROCHURES;
	$this->Login_model->DeleteImageBrochureRecord($all_ids,'news_id',$parent_id,$table_name,'brochure_file','./images/news/');
	$this->RedirectPage(admin.'/news/managedownloads/'.$parent_id,'Selected brochure deleted successfully');
   }
   
  }
  public function changestatus($record_id,$status,$section,$parent_id="")
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('news/managenews');
   if($section == "managenews")
   {
    $this->Login_model->ChangeStatus(NEWS,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of news has been changed successfully'); 
   }
   elseif($section == "manageimages")
   {
    $this->Login_model->ChangeStatus(NEWS_IMAGES,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of image has been changed successfully'); 
   }
   elseif($section == "managedownloads")
   {
    $this->Login_model->ChangeStatus(NEWS_BROCHURES,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of brochure has been changed successfully'); 
   }
   if(!empty($parent_id))
   {
    $section.="/$parent_id";
   }
   header("location:".base_url().admin."/news/$section");
   exit;
  } 
 }
