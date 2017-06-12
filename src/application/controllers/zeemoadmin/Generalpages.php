<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class GeneralPages extends MY_Controller
 {
  public $uploading_image_info;
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Generalpages_model');
   $this->load->helper('form');
   $this->load->library('CommonFunctions');	   
  }
  public function homepage($values=array())
  {
   $this->SetUpCkeditor(); 
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateGeneralPagesFormJs','DragDropJs');
   $this->admincss->including_css_func=array('PrettyPhotoCss');   

   $this->data['last_modified']=$this->Login_model->LastModify(PAGES,1);


   if(count($values) == 0)
   {
    $values=$this->Generalpages_model->GetHomePageInformation();
   }
   else
   {
    $this->data['title'].=$values['title'];
   }
   $this->data['attributes']=$this->Generalpages_model->GetHomePageFormAttribute($values);
  // $this->load->library('fckeditor',$this->data['attributes']['fckeditorConfig']);
  
  // Managing Footer Icons -------------------------------------------------------------//
   $this->load->helper('form');    
   $this->data['clients_list']=$this->Generalpages_model->GetFooterIconList();
  
  
  
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/generalpages/homepage',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validatehomepage()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/homepage');
   $this->data['active_submodule']="homepage";
   $values=array();
   $values['title']="Validate Home Page";
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');

   $path_to_upload="./images/generalpages/";
   $this->form_validation->set_message('required','Please enter %s');
   $this->form_validation->set_rules('content','home page content',"trim|required");

   $values['content']=$this->input->post('content');
   $values['banner_content']=$this->input->post('banner_content');
   $values['intro_text']=$this->input->post('intro_text');
   $this->form_validation->set_rules('banner_content','banner content',"trim|required");
   

   if($this->form_validation->run() == FALSE)
   { 
    $error=false;
    $this->homepage($values);
   }
   else
   {
	$records=array();
	$records['content']=$values['content'];
	$records['banner_content']=$values['banner_content'];
	$records['intro_text']=$values['intro_text'];
	
	if(count($records) > 0)
	{
	 $this->Generalpages_model->UpdateHomePageRecords($records);
	}
	$this->RedirectPage(admin.'/generalpages/homepage','Content of home page updated successfully');
   }
  }
  public function AddFooterIcon($values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/homepage');	  
   $this->data['active_submodule']="homepage";
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
    $this->data['page_title']=$values['page_title'];
    $this->data['image_quality']=$values['image_quality'];
    $this->data['icon_id']=$values['icon_id'];
	if(isset($this->data['icon_id']) and !empty($this->data['icon_id']))
	{
     $this->data['last_modified']=$this->Login_model->LastModify(CLIENTS,$this->data['icon_id']);   
	}
   }
   else
   {
    $values['clients_title']="";
    $values['current_image']="";
	$values['image_quality']="";
	$values['image_alt_title_text']="";
    $values['url']="";
    $this->data['title'].="Add Footer Icon";
	$this->data['page_title']="Add Footer Icon";
    $this->data['image_quality']='';  
   }

   // if you have any remarks then assign as $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)"; other wise it takes default remarks
    $this->data['remarks']="Max. image size must be (220 x 146) (Width x Height)";

   // Image optimization attributes  
   $this->data['image_quality_options']=$this->Login_model->GetImageQualityOptions();

   $this->adminjavascript->include_admin_js=array('ValidateGeneralPagesFormJs');
   $this->SetUpCkeditor();  
   $this->data['attributes']=$this->Generalpages_model->GetFooterIconFormAttributes($values);
   $this->load->view(admin.'/generalpages/add-footer-icon',$this->data);
  }
  
  public function EditFooterIcon($icon_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/homepage');	  
   $this->data['active_submodule']="homepage";
   //$this->adminjavascript->include_admin_js=array('ValidateFooterIconJs');    $values=array();
   $values=$this->Generalpages_model->GetFooterIconDetails($icon_id);
   $values['title']="Edit Footer Icon";
   $values['page_title']="Edit Footer Icon";
   $values['image_quality']=$values['image_quality'];
   $values['icon_id']=$icon_id;
   $this->AddFooterIcon($values);
  }
  public function validatefootericon()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/homepage');
   $this->data['active_submodule']="homepage";


   $values=array();
   $values['title']="Validate Footer Icon";
   $values['page_title']=$this->input->post('page_title');
   $values['current_image']=$this->input->post('current_image');
   $values['clients_title']=$this->input->post('clients_title');
   $values['icon_id']=$this->input->post('icon_id');
   $values['url']=$this->input->post('url');
   $values['image_quality']=$this->input->post('image_quality');
   $values['image_alt_title_text']=$this->input->post('image_alt_title_text');
   
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','Please enter %s');
   if(!empty($values['url']))
   {
    $this->form_validation->set_rules('url', 'url', 'trim|callback__validate_url'); 
   }
   if(!empty($values['icon_id']))
   {
	$this->form_validation->set_rules('clients_title', 'title', 
	'trim|required|callback_is_unique_on_update['.CLIENTS.'~clients_title~'.$values['icon_id'].'~title]');
   }
   else
   {
    $this->form_validation->set_rules('clients_title', 'title', 'trim|required|is_unique['.CLIENTS.'.clients_title]');
   }
 
   if(empty($values['current_image']) or !empty($_FILES['image_file']['name']))
   {
	$path_to_upload="./images/generalpages/";
	// list of argument for image validation array
// 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $banner_image_info=array("image_file",$path_to_upload,"icon_image","220","146","","",'');
	$banner_image_info_string=implode("~",$banner_image_info);
    $this->form_validation->set_rules('image_file', 'image', "callback_image_validation[{$banner_image_info_string}]");
   }
   //if(($values['submit_value'] == "Submit" or ($values['submit_value'] == "Update" and !empty($_FILES['image_file']['name']))) and ($this->form_validation->run() == FALSE))
   if($this->form_validation->run() == FALSE)   
   { 
    // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_image_info['icon_image']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['icon_image']['file_name']);
	}
    $this->AddFooterIcon($values);
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
	 $records['image_file']=$this->uploading_image_info['icon_image']['file_name'];
	 $this->ReduceImageWeight($records['image_file'],$path_to_upload, $values['image_quality']);
  	 $records['image_quality']=$values['image_quality'];
	}
	$records['url']=$values['url'];
	$records['image_alt_title_text']=$values['image_alt_title_text'];
    $records['clients_title']=$values['clients_title'];
	
	if(isset($values['icon_id']) and !empty($values['icon_id']))
	{
     $this->Generalpages_model->UpdateFooterIcon($records,$values['icon_id']);
	 $success_message="Item has been updated successfully";
	}
	else
	{
     $this->Generalpages_model->AddFooterIcon($records);
	 $success_message="Item has been added successfully";
	}
    $this->RedirectPopupPage(admin."/generalpages/homepage",$success_message);
   }

  }  
  public function _validate_url($news_url)
  {
   if(!($this->commonfunctions->ValidateUrl($news_url)))
   {
	$this->form_validation->set_message('_validate_url','Please enter valid URL');
    return false;
   }
   else
   {
    return true;
   }
  }
  public function pagecontent($page_id='',$values=array())
  {
   $this->SetUpCkeditor(); 
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateGeneralPagesFormJs');
   $this->data['page_id']=$page_id;
   
   if(!empty($page_id))
   {
    $values=$this->Generalpages_model->GetPageInformation($page_id);
    $this->data['last_modified']=$this->Login_model->LastModify(PAGES,$page_id);
   }
   if(count($values)==0)
   {
    $values=array();
	$values['content'] = '';
	$values['page_heading'] = '';	
   }
   
   $this->data['attributes']=$this->Generalpages_model->GetPageFormAttribute($values);
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/generalpages/pagecontent',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validatepagecontent()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/pagecontent');
   $this->data['active_submodule']="pagecontent";
   
   $values=array();
   $values['title']="Validate Page Content";
   $values['content']=$this->input->post('content');
   //$values['page_heading']=$this->input->post('page_heading');
   $values['page_id']=$this->input->post('page_id');
   
   $records['content']=$values['content'];
   //$records['page_heading']=$values['page_heading'];   
   $this->Generalpages_model->UpdateRecords($records,$values['page_id']);
   $this->RedirectPage(admin.'/generalpages/pagecontent/'.$values['page_id'],'Content updated successfully');
  }
  public function contact($values=array())
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateGeneralPagesFormJs');
   if(count($values) == 0)
   {
    $values=$this->Generalpages_model->GetContactInformation();
   }
   else
   {
    $this->data['title'].=$values['title'];
   }
   $this->data['last_modified']=$this->Login_model->LastModify(CONTACT,1);
   $this->data['attributes']=$this->Generalpages_model->GetContactFormAttribute($values);
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/generalpages/contact',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validatecontact()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/contact');
   $this->data['active_submodule']="contact";
   $values=array();
   $values['title']="Validate Contact";
   $this->load->library('form_validation'); 
   $this->form_validation->set_message('required','Please enter %s');
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_rules('address', 'address', 'trim|required');
   $this->form_validation->set_rules('phone', 'phone', 'trim|required');
   $this->form_validation->set_rules('phone2', 'phone', 'trim|required');
   $values['fax']=$this->input->post('fax'); 
   $values['address']=$this->input->post('address'); 
   $values['content']=$this->input->post('form_heading'); 
   $values['other_details']=$this->input->post('other_details');   
   $values['phone']=$this->input->post('phone');  
   $values['phone2']=$this->input->post('phone2');  
   $values['email']=$this->input->post('email');   
   if(!empty($values['email']))
   {
    $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
   }
   if($this->form_validation->run() == FALSE)
   {
    $this->contact($values);
   }
   else
   {
    $records['address']=$values['address'];
    $records['other_details']=$values['other_details'];
    $records['content']=$values['content'];
    $records['phone']=$values['phone'];
    $records['phone2']=$values['phone2'];
    $records['email']=$values['email'];
    $records['fax']=$values['fax'];
    $this->Generalpages_model->UpdateContactRecords($records);
	$this->RedirectPage(admin.'/generalpages/contact','Contact information updated successfully');
   }
  }
  
  public function more_info_section()
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs','ValidateGeneralPagesFormJs');
   $this->load->helper('form');
   $this->data['info_list']=$this->Generalpages_model->GetMoreInfoSectionList();

   if(count($this->data['info_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['deletion_attribute']=$this->Login_model->GetAtributesForDeletion($this->data['info_list'],'more_info_item','no');
   }

   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/generalpages/more-info',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function add_more_info_item($values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/more-info-section');	  
   $this->data['active_submodule']="more-info-section";
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
	$this->data['submit_value']=$values['submit_value']; 
    $this->data['image_quality']=$values['image_quality'];
   	if(isset($values['edit_id']) and !empty($values['edit_id']))
	{
     $this->data['last_modified']=$this->Login_model->LastModify(MORE_INFO_SECTION,$values['edit_id']);   
	}
   }
   else
   {
    $values['info_title']="";
    $values['current_image']="";
    $values['description']="";
    $values['url']="";
    $values['image_alt_title_text']="";
    $values['image_quality']="";
    $this->data['image_quality']="";
	$this->data['page_title']="Add Item";
	$this->data['submit_value']="Submit"; 
   }
   $this->data['attributes']=$this->Generalpages_model->GetMoreInfoSectionAttribute($values);
   $this->SetUpCkeditor();   
   $this->data['image_quality_options']=$this->Login_model->GetImageQualityOptions();
   $this->adminjavascript->include_admin_js=array('ValidateGeneralPagesFormJs');
   // if you have any remarks then assign as $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)"; other wise it takes default remarks
   $this->data['remarks']="Max image size must be (320 x 200) (Width x Height)";
   $this->data['file_path']=base_url().admin."/generalpages/validatemoreinfosectionform";
   $this->data['uploading_path']=base_url()."images/generalpages";
   $this->load->view(admin.'/generalpages/add-more-info',$this->data);
  }
  public function validatemoreinfosectionform()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/more-info-section');
   $this->data['active_submodule']="manageimages";
   $values=array();
   $values['title']="Validate Item";
   $values['info_title']=$this->input->post('info_title');
   $values['current_image']=$this->input->post('current_image');
   $values['description']=$this->input->post('description');
   $values['url']=$this->input->post('url');
   $values['image_quality']=$this->input->post('image_quality');
   $values['image_alt_title_text']=$this->input->post('image_alt_title_text');

   $values['submit_value']=$this->input->post('submit_value');
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message("required","Please enter %s");
//   $this->form_validation->set_rules('description', 'description', "trim|required");
   
   
   if($values['submit_value'] == "Submit")
   {
    $values['page_title']="Add Item";
    $this->form_validation->set_rules('info_title', 'title', 'trim|required');
   }
   else
   {
    $values['page_title']="Edit Item";
    $values['edit_id']=$this->input->post('edit_id');
    $this->form_validation->set_rules('info_title', 'title', 'trim|required');
   }
    $this->form_validation->set_rules('description', 'description', 'trim|required');
   
   
   if(!empty($_FILES['image_file']['name']))
   {
	$path_to_upload="./images/generalpages/";
	// list of argument for image validation array
    // 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $page_image_info=array("image_file",$path_to_upload,"page_image","320","200","","",'');
    $page_image_info_string=implode("~",$page_image_info);
    $this->form_validation->set_rules('image_file', 'image', "callback_image_validation[{$page_image_info_string}]");
   }
   
   if($this->form_validation->run() == FALSE)
   { 
    // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_image_info['page_image']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['page_image']['file_name']);
	}
    $this->add_more_info_item($values);
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
	 $records['image_file']=$this->uploading_image_info['page_image']['file_name'];
	 
	 $this->ReduceImageWeight($records['image_file'],$path_to_upload, $values['image_quality']);
  	 $records['image_quality']=$values['image_quality'];
	}
	$records['info_title']=$values['info_title'];
	$records['description']=$values['description'];
	$records['url']=$values['url'];
	$records['image_alt_title_text']=$values['image_alt_title_text'];
    $this->data['redirect_url']=admin."/generalpages/more-info-section";
	if($values['submit_value'] == "Submit")
	{
	 $this->Generalpages_model->InsertMoreInfoItem($records); 
	 $message="Item has been added successfully";
	}
	elseif($values['submit_value'] == "Update")
	{
	 $this->Generalpages_model->UpdatetMoreInfoItem($records,$values['edit_id']); 
	 $message="Item has been updated successfully";
    }
    $this->RedirectPopupPage(admin."/generalpages/more-info-section",$message);
   }
  }
  public function EditMoreInfoSection($image_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/more-info-section');	  
   $this->data['active_submodule']="more-info-section";
   $this->data['last_modified']=$this->Login_model->LastModify(MORE_INFO_SECTION,$image_id);   
   $values=array();
   $values=$this->Generalpages_model->GetMoreInfoDetails($image_id);
   $values['current_image']=$values['image_file'];
   $values['title']="Edit Section";
   $values['page_title']="Edit Section";
   $values['submit_value']="Update"; 
   $values['edit_id']=$image_id;
   $this->data['image_id']=$image_id;
   $this->add_more_info_item($values);
  }
  
  public function manageimages($page_id='')
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs');
   $this->load->helper('form');    
   $this->data['page_id']=$page_id;
   $this->data['drop_down_attributes']=$this->Generalpages_model->GetPageDropDownAttribute('image');
   if(!empty($page_id))$this->data['image_list']=$this->Login_model->GetImageList(PAGE_IMAGES,'page_id',$page_id);
   else $this->data['image_list']=array();
   if(count($this->data['image_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['deletion_attribute']=$this->Login_model->GetAtributesForDeletion($this->data['image_list'],'Image','no',$page_id);
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/generalpages/manage-images',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function ImageUploader($page_id='',$values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/manageimages');	  
   $this->data['active_submodule']="manageimages";

   $this->data['page_title']="Add Image";
   $this->data['parent_id']=$page_id;   
   if(!empty($this->data['parent_id']))
   {
	$parent_drop_down_list=$this->Generalpages_model->GetPageListForDropDown('image');
	// 1. parent_drop_down_list
    $this->data['attributes']=$this->Login_model->GetImageUploaderFormAttribute($parent_drop_down_list);
   }
   
   // if you have any remarks then assign as $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)"; other wise it takes default remarks
   $this->data['remarks']="Maximum size 1200(w) x 800(h)px";
   // Image validation attributes. All are optional. If you give min. value then not give fixed value and vice versa. Image size must be KB.
   
   $this->data['max_height']="";
   $this->data['max_width']="";
   $this->data['fixed_height']="";
   $this->data['fixed_width']="";
   $this->data['max_size']="";
   
   $this->data['upload_type']="image"; // image/brochure
   $this->data['field_name']="image_file"; // file field name in your database table

   $this->data['path_to_upload']="./images/generalpages";
   $this->data['parent_drop_down_title']="Selected page";
   $this->data['parent_field']="page_id";
   $this->data['table_name']=PAGE_IMAGES;
   $this->data['return_url']=admin."/generalpages/manageimages/".$this->data['parent_id'];

   $this->data['description']=true; // add image details after uploading image, set true/false
   
   $this->admincss->including_css_func=array('FileUploaderCss');   
   $this->load->view(admin.'/templates/image-uploader',$this->data);
  }
  
  public function AddImage($page_id='',$values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/manageimages');	  
   $this->data['active_submodule']="manageimages";
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
	$this->data['parent_id']=$values['parent_id'];
	$this->data['submit_value']=$values['submit_value']; 
    $this->data['image_quality']=$values['image_quality'];  
	
	if(isset($values['edit_id']) and !empty($values['edit_id']))
	{
     $this->data['last_modified']=$this->Login_model->LastModify(PAGE_IMAGES,$values['edit_id']);   
	}
   }
   else
   {
    $this->data['image_quality']='';  
    $values['image_title']="";
    $values['current_image']="";
    $values['image_alt_title_text']="";	
	
	$this->data['page_title']="Add Image";
	$this->data['parent_id']=$page_id;  
	$this->data['submit_value']="Submit"; 
   }
   if(!empty($this->data['parent_id']))
   {
	$parent_drop_down_list=$this->Generalpages_model->GetPageListForDropDown('image');
	// argument 1. values, 2.submit_type, 3. parent_drop_down_list
    $this->data['attributes']=$this->Login_model->GetImageFormAttribute($values,$this->data['submit_value'],$parent_drop_down_list);
   }
   
   // if you have any remarks then assign as $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)"; other wise it takes default remarks
   // Image optimization attributes  
   $this->data['image_quality_options']=$this->Login_model->GetImageQualityOptions();
   
   $this->data['file_path']=base_url().admin."/generalpages/validatepageimage";
   $this->data['uploading_path']=base_url()."images/generalpages";
   $this->data['parent_drop_down_title']="Selected page";
   $this->load->view(admin.'/templates/add-image',$this->data);
  }
  public function EditImage($image_id,$page_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/manageimages');	  
   $this->data['active_submodule']="manageimages";
   $this->data['last_modified']=$this->Login_model->LastModify(PAGE_IMAGES,$image_id);   
   $values=array();
   $values=$this->Login_model->GetImageBrochureDetails($image_id,PAGE_IMAGES);
   $values['current_image']=$values['image_file'];
   $values['title']="Edit Image";
   $values['parent_id']=$page_id;
   $values['page_title']="Edit Image";
   $values['submit_value']="Update"; 
   $values['edit_id']=$image_id;
   $this->AddImage($page_id,$values);
  }
  public function validatepageimage()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/manageimages');
   $this->data['active_submodule']="manageimages";
   $values=array();
   $values['title']="Validate Image";
   $values['image_title']=$this->input->post('image_title');
   $values['current_image']=$this->input->post('current_image');

   $values['parent_id']=trim($this->input->post('parent_id'));
   $values['submit_value']=$this->input->post('submit_value');
   $values['image_alt_title_text']=$this->input->post('image_alt_title_text');
   $values['image_quality']=$this->input->post('image_quality');
   
   if($values['submit_value'] == "Submit") $values['page_title']="Add Image";
   else
   {
    $values['page_title']="Edit Image";
    $values['edit_id']=$this->input->post('edit_id');
   }
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
 
   if(!empty($_FILES['image_file']['name']))
   {
	$path_to_upload="./images/generalpages/";
	// list of argument for image validation array
// 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $page_image_info=array("image_file",$path_to_upload,"page_image","","","","",'');
    $page_image_info_string=implode("~",$page_image_info);
    $this->form_validation->set_rules('image_file', 'image', "callback_image_validation[{$page_image_info_string}]");
   }
   else if($values['submit_value'] == "Submit")
   {
    $this->form_validation->set_rules('image_file', 'image', "required");
   }
   if(($values['submit_value'] == "Submit" or ($values['submit_value'] == "Update" and !empty($_FILES['image_file']['name']))) and ($this->form_validation->run() == FALSE))
   { 
    // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_image_info['page_image']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['page_image']['file_name']);
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
	 $records['image_file']=$this->uploading_image_info['page_image']['file_name'];
	 $this->ReduceImageWeight($records['image_file'],$path_to_upload, $values['image_quality']);
  	 $records['image_quality']=$values['image_quality'];
	}
	$records['image_title']=$values['image_title'];
	$records['page_id']=$values['parent_id'];
	$records['image_alt_title_text']=$values['image_alt_title_text'];
	
	
    $this->data['redirect_url']=admin."/generalpages/manageimages/".$values['parent_id'];
	if($values['submit_value'] == "Submit")
	{
	 $this->Login_model->InsertImage($records,PAGE_IMAGES,'page_id'); 
	 $message="Image has been added successfully";
	}
	elseif($values['submit_value'] == "Update")
	{
	 $this->Login_model->UpdateImage($records,$values['edit_id'],PAGE_IMAGES); 
	 $message='Image has been updated successfully';
    }
	$this->RedirectPopupPage($this->data['redirect_url'],$message);
   }
  }  
  public function managedownloads($page_id='')
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs');
   $this->load->helper('form');    
   $this->data['page_id']=$page_id;
   $this->data['drop_down_attributes']=$this->Generalpages_model->GetPageDropDownAttribute('pdf');
   if(!empty($page_id))$this->data['brochure_list']=$this->Login_model->GetBrochureList(PAGE_BROCHURES,'page_id',$page_id);
   else $this->data['brochure_list']=array();
   if(count($this->data['brochure_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['deletion_attribute']=$this->Login_model->GetAtributesForDeletion($this->data['brochure_list'],'Brochure','no',$page_id);
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/generalpages/manage-brochures',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  
  public function BrochureUploader($page_id='',$values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/managedownloads');	  
   $this->data['active_submodule']="managedownloads";

   $this->data['page_title']="Add Brochure";
   $this->data['parent_id']=$page_id;   
   if(!empty($this->data['parent_id']))
   {
	$parent_drop_down_list=$this->Generalpages_model->GetPageListForDropDown('pdf');
	// 1. parent_drop_down_list
    $this->data['attributes']=$this->Login_model->GetBrochureUploaderFormAttribute($parent_drop_down_list);
   }
   
   // if you have any remarks then assign as $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)"; other wise it takes default remarks
  // $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)px";
   // Image validation attributes. All are optional. If you give min. value then not give fixed value and vice versa. Image size must be KB.
   
   $this->data['max_size']="";
   $this->data['upload_type']="brochure"; // image/brochure
   $this->data['field_name']="brochure_file"; // file field name in your database table
   $this->data['description']=true; // add brochure details after uploading image, set true/false
   

   $this->data['path_to_upload']="./brochures/generalpages/";
   $this->data['parent_drop_down_title']="Selected page";
   $this->data['parent_field']="page_id";
   $this->data['table_name']=PAGE_BROCHURES;
   $this->data['return_url']=admin."/generalpages/managedownloads/".$this->data['parent_id'];

   $this->admincss->including_css_func=array('FileUploaderCss');   
   $this->load->view(admin.'/templates/brochure-uploader',$this->data);
  }

  public function AddBrochure($page_id='',$values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/managedownloads');	  
   $this->data['active_submodule']="managedownloads";
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
	$this->data['parent_id']=$values['parent_id'];
	$this->data['submit_value']=$values['submit_value']; 
	if(isset($values['edit_id']) and !empty($values['edit_id']))
	{
     $this->data['last_modified']=$this->Login_model->LastModify(PAGE_BROCHURES,$values['edit_id']);   
	}
   }
   else
   {
    $values['brochure_title']="";
    $values['current_brochure']="";
	$this->data['page_title']="Add Brochure";
	$this->data['parent_id']=$page_id;  
	$this->data['submit_value']="Submit"; 
   }
   if(!empty($this->data['parent_id']))
   {
	$parent_drop_down_list=$this->Generalpages_model->GetPageListForDropDown('pdf');
	// argument 1. values, 2.submit_type, 3. parent_drop_down_list
    $this->data['attributes']=$this->Login_model->GetBrochureFormAttribute($values,$this->data['submit_value'],$parent_drop_down_list,80);
   }
   $this->data['title_remarks']="Max. 80 chars";
   // if you have any remarks then assign as $this->data['remarks']="Max size 33 KB"; other wise it takes default remarks
   $this->data['file_path']=base_url().admin."/generalpages/validatepagebrochure";
   $this->data['uploading_path']=base_url()."brochures/generalpages";
   $this->data['parent_drop_down_title']="Selected page";
   $this->load->view(admin.'/templates/add-brochure',$this->data);
  }
  public function validatepagebrochure()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/managedownloads');
   $this->data['active_submodule']="managedownloads";
   $values=array();
   $values['title']="Validate Brochure";
   $values['brochure_title']=$this->input->post('brochure_title');
   $values['current_brochure']=$this->input->post('current_brochure');

   $values['parent_id']=trim($this->input->post('parent_id'));
   $values['submit_value']=$this->input->post('submit_value');
   if($values['submit_value'] == "Submit") $values['page_title']="Add Brochure";
   else
   {
    $values['page_title']="Edit Brochure";
    $values['edit_id']=$this->input->post('edit_id');
   }
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required', 'Please enter %s');    
   
   $this->form_validation->set_rules('brochure_title', 'title', "required");

   if(!empty($_FILES['brochure_file']['name']))
   {
	$path_to_upload="./brochures/generalpages/";
	// list of argument for brochure validation array // 1.file_name,2.path_to_upload,3.brochure_index,4.max_size
    $page_brochure_info=array("brochure_file",$path_to_upload,"page_brochure",'');
    $page_brochure_info_string=implode("~",$page_brochure_info);
	
    $this->form_validation->set_rules('brochure_file', 'Brochure file', "callback_brochure_validation[{$page_brochure_info_string}]");
   }
   else if($values['submit_value'] == "Submit")
   {
    $this->form_validation->set_rules('brochure_file', 'brochure', "required");
   }
   if(($values['submit_value'] == "Submit" or ($values['submit_value'] == "Update" and !empty($_FILES['brochure_file']['name']))) and ($this->form_validation->run() == FALSE))
   { 
    // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_brochure_info['page_brochure']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_brochure_info['page_brochure']['file_name']);
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
	 $records['brochure_file']=$this->uploading_brochure_info['page_brochure']['file_name'];
	}
	$records['brochure_title']=$values['brochure_title'];
	$records['page_id']=$values['parent_id'];
    $this->data['redirect_url']=admin."/generalpages/managedownloads/".$values['parent_id'];
	if($values['submit_value'] == "Submit")
	{
	 $this->Login_model->InsertBrochure($records,PAGE_BROCHURES,'page_id'); 
	 $message="Brochure has been added successfully";
	}
	elseif($values['submit_value'] == "Update")
	{
	 $this->Login_model->UpdateBrochure($records,$values['edit_id'],PAGE_BROCHURES); 
	 $message="Brochure has been updated successfully";
    }
	$this->RedirectPopupPage($this->data['redirect_url'],$message);
   }
  }
  public function EditBrochure($brochure_id,$page_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/managedownloads');	  
   $this->data['active_submodule']="managedownloads";
   $this->data['last_modified']=$this->Login_model->LastModify(PAGE_BROCHURES,$brochure_id);   
   $values=array();
   $values=$this->Login_model->GetImageBrochureDetails($brochure_id,PAGE_BROCHURES);
   $values['current_brochure']=$values['brochure_file'];
   $values['title']="Edit Brochure";
   $values['parent_id']=$page_id;
   $values['page_title']="Edit Brochure";
   $values['submit_value']="Update"; 
   $values['edit_id']=$brochure_id;
   $this->AddBrochure($page_id,$values);
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
   if($item_name == "Image" or "About" == $item_name or "more_info_image")
   {
	$this->data['message']="Are you sure you want to delete this image.";
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
	$this->Login_model->DeleteImageBrochureRecord($all_ids,'page_id',$parent_id,$table_name,'brochure_file','./brochures/generalpages/');
	$this->RedirectPage(admin.'/generalpages/managedownloads/'.$parent_id,'Selected brochure deleted successfully');
   }
   elseif("footerIcon" == $item_name)
   {
    $this->Generalpages_model->DeleteFooterIcon($all_ids);
    $this->RedirectPage(admin.'/generalpages/homepage','Footer item has been deleted successfully');
   }
   elseif($item_name == "about item")
   {
    $values=array();
   
	$this->Generalpages_model->DeleteAboutRecord($all_ids);
	$this->RedirectPage(admin.'/generalpages/about-section/','Selected item(s) deleted successfully');
   }
   
   elseif($item_name == "more_info_item")
   {
    $values=array();
   
	$this->Generalpages_model->DeleteMoreInfoRecord($all_ids);
	$this->RedirectPage(admin.'/generalpages/more-info-section/','Selected item(s) deleted successfully');
   }
   elseif("more_info_image" == $item_name)
   {
    $this->Generalpages_model->DeleteMoreInfoImage($checked_ids,'image_file');
    $this->RedirectPage(admin.'/generalpages/EditMoreInfoSection/'.$checked_ids,'Image has been deleted successfully');
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
    $this->session->set_flashdata('success_message',"Status of footer item has been changed successfully"); 
   }
   elseif($section == "about_section")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/about-section');
    $this->Login_model->ChangeStatus(ABOUT_SECTION,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of item has been changed successfully'); 
	$section=str_replace("_","-",$section);
   }
   elseif($section == "more_info_section")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('generalpages/about-section');
    $this->Login_model->ChangeStatus(MORE_INFO_SECTION,$record_id,$status);
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
