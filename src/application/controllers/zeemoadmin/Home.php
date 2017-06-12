<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
  }
  public function index($values=array())
  {
   $this->data['title']="Admin Home";
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/home/home',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function UpdatePosition($table_name,$parent_field_name='')
  {
   $parent_id=$this->input->post('parent_id'); 
   $listingCounter = 1;
   $updateRecordsArray 	= $this->input->post('recordsArray');
   $this->Login_model->UpdatePosition($table_name, $updateRecordsArray, $parent_id, $parent_field_name);
   //echo 'Item repositioned successfully. If you refresh the page, you will see that records will stay just as you modified.';
   echo 'Item repositioned successfully.';
  }
  public function validateSuperadminPassword()
  {
   $password=$this->input->post('superadmin');
   echo $this->Login_model->CheckSuperadminPassword($password);
  }
  
  public function viewhelptext($module,$submodule)
  {
   $this->data['module_name']=$this->Login_model->GetModuleNameByUrl($module);
   $this->data['submodule_name']=$this->Login_model->GetModuleNameByUrl($module."/".$submodule);
   $this->data['help_text']=$this->Login_model->GetHelpText($module."/".$submodule); 
   $this->load->view(admin.'/view-help',$this->data);
  }
  public function AddImage($values=array())
  {
   $this->load->helper('form');	  
   if(count($values) > 0)
   {
	$this->data['title']=$values['title'];   
	$this->data['page_title']=$values['page_title'];
	$this->data['submit_value']=$values['submit_value']; 
    $this->data['image_quality']=$values['image_quality'];  
    $this->data['last_modified']=$this->Login_model->LastModify(CMS_SETTINGS,$values['edit_id']);   
   }
	$parent_drop_down_list=array();
	// argument 1. values, 2.submit_type, 3. parent_drop_down_list
    $this->data['attributes']=$this->Login_model->GetImageFormAttribute($values,$this->data['submit_value'],$parent_drop_down_list);   
   // if you have any remarks then assign as $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)"; other wise it takes default remarks
   // Image optimization attributes  
   $this->data['image_quality_options']=$this->Login_model->GetImageQualityOptions();
   $this->data['remarks']="Max. image size must be 280x90(Width x Height)px";
   
   $this->data['file_path']=base_url().admin."/home/validatepageimage";
   $this->data['uploading_path']=base_url()."images/".admin."/cms-settings/logo/";
   $this->data['parent_drop_down_title']="Selected page";
   $this->load->view(admin.'/home/add-image',$this->data);
  }
  public function EditImage()
  {
   $this->data['last_modified']=$this->Login_model->LastModify(CMS_SETTINGS,1);   
   $values=array();
   $values=$this->Login_model->GetImageBrochureDetails(1,CMS_SETTINGS);
   $values['current_image']=$values['right_logo_image_file'];
   $values['title']="Edit Logo";
   $values['image_title']=$values['right_logo_image_title'];  
   
   $values['image_quality']=$values['right_logo_image_quality'];  
   $values['image_alt_title_text']=$values['right_logo_image_alt_title_text'];  
  
   $values['page_title']="Edit Logo";
   $values['submit_value']="Update"; 
   $values['edit_id']=1;
   $this->AddImage($values);
  }
  public function validatepageimage()
  {
   $values=array();
   $values['title']="Validate Image";
   $values['image_title']=$this->input->post('image_title');
   $values['current_image']=$this->input->post('current_image');

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
	$path_to_upload="./images/".admin."/cms-settings/logo/";
	// list of argument for image validation array
// 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $page_image_info=array("image_file",$path_to_upload,"page_image","280","90","","",'');
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
    $this->AddImage($values);
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
	 $records['right_logo_image_file']=$this->uploading_image_info['page_image']['file_name'];
	 $this->ReduceImageWeight($records['right_logo_image_file'],$path_to_upload, $values['image_quality']);
  	 $records['right_logo_image_quality']=$values['image_quality'];
	}
	$records['right_logo_image_title']=$values['image_title'];
	$records['right_logo_image_alt_title_text']=$values['image_alt_title_text'];
    $this->data['redirect_url']=admin."/home";
	if($values['submit_value'] == "Update")
	{
	 $this->Login_model->UpdateImage($records,$values['edit_id'],CMS_SETTINGS); 
	 $message='Image has been updated successfully';
    }
	$this->RedirectPopupPage($this->data['redirect_url'],$message);
   }
  }  
  public function uploadImages()
  {
   $this->load->library('form_validation'); 
   //$this->form_validation->set_error_delimiters('<span>','</span>');
   $path_to_upload=$this->input->post('path_to_upload');
   $parent_field=$this->input->post('parent_field');
   $parent_id=$this->input->post('parent_id');
   $table_name=$this->input->post('table_name');

   $max_width=$this->input->post('max_width');
   $max_height=$this->input->post('max_height');
   $fixed_height=$this->input->post('fixed_height');
   $fixed_width=$this->input->post('fixed_width');
   $max_size=$this->input->post('max_size');


   if(!empty($_FILES['image_file']['name']))
   {
	//$path_to_upload="./images/".admin."/cms-settings/logo/";
	// list of argument for image validation array
    // 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $page_image_info=array("image_file",$path_to_upload,"page_image",$max_width,$max_height,$fixed_width,$fixed_height,$max_size);
    $page_image_info_string=implode("~",$page_image_info);
    $this->form_validation->set_rules('image_file', 'image', "callback_image_validation[{$page_image_info_string}]");
   }
   if($this->form_validation->run() == FALSE)
   { 
    // if uploaded file has error then delete the recent uploaded file 
	if(!empty($this->uploading_image_info['page_image']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['page_image']['file_name']);
	}
	$error_message= strip_tags(form_error('image_file'));
	echo 'Error:'.$error_message;
	exit;
   }
   else
   {
    $records=array();
    if(!empty($_FILES['image_file']['name']))
	{
	 $records['image_file']=$this->uploading_image_info['page_image']['file_name'];
	}
	if(!empty($parent_field) and !empty($parent_id))
	{
	 $records[$parent_field]=$parent_id;
	}
    $insert_id=$this->Login_model->InsertImage($records,$table_name,$parent_field); 
	//echo '{"status":"success"}';
	$file_name=$records['image_file'];
	echo 'success:'.$file_name.":".$insert_id;
	exit;
   }
   echo 'Error:php error';
   exit;   

  } 
  public function showImage()
  {
   $img_src=$this->input->post('img_src');
   echo "<img src='".$img_src."' class='show-image' />";
  } 
  public function uploadBrochures()
  {
   $this->load->library('form_validation'); 
   //$this->form_validation->set_error_delimiters('<span>','</span>');
   $path_to_upload=$this->input->post('path_to_upload');
   $parent_field=$this->input->post('parent_field');
   $parent_id=$this->input->post('parent_id');
   $table_name=$this->input->post('table_name');

   $max_size=$this->input->post('max_size');


   if(!empty($_FILES['brochure_file']['name']))
   {
	$path_to_upload="./brochures/generalpages/";
	// list of argument for brochure validation array // 1.file_name,2.path_to_upload,3.brochure_index,4.max_size
    $page_brochure_info=array("brochure_file",$path_to_upload,"page_brochure",$max_size);
    $page_brochure_info_string=implode("~",$page_brochure_info);
	
    $this->form_validation->set_rules('brochure_file', 'Brochure file', "callback_brochure_validation[{$page_brochure_info_string}]");
   }
   if($this->form_validation->run() == FALSE)
   { 
   
   // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_brochure_info['page_brochure']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_brochure_info['page_brochure']['file_name']);
	}
	$error_message= strip_tags(form_error('brochure_file'));
	echo 'Error:'.$error_message;
	exit;
   }
   else
   {
    $records=array();
    if(!empty($_FILES['brochure_file']['name']))
	{
	 $records['brochure_file']=$this->uploading_brochure_info['page_brochure']['file_name'];
	}
	if(!empty($parent_field) and !empty($parent_id))
	{
	 $records[$parent_field]=$parent_id;
	}
    $insert_id=$this->Login_model->InsertBrochure($records,$table_name,$parent_field); 
	//echo '{"status":"success"}';
	$file_name=$records['brochure_file'];
	echo 'success:'.$file_name.":".$insert_id;
	exit;
   }
   echo 'Error:php error';
   exit;   

  }  
   
  public function redirectToParentPage($return_url)
  {
   $this->data['redirect_url']=str_replace("~","/",$return_url);
   $this->RedirectPopupPage($this->data['redirect_url'],'');
  }
  public function deleteRecord()
  {
   $path_to_upload=$this->input->post('path_to_upload')."/";
   $parent_field=$this->input->post('parent_field');
   $parent_id=$this->input->post('parent_id');
   $table_name=$this->input->post('table_name');
   $item_id=$this->input->post('item_id');
   $field_name=$this->input->post('field_name');
   $all_items=array('0'=>$item_id);
   $this->Login_model->DeleteImageBrochureRecord($all_items,$parent_field,$parent_id,$table_name,$field_name,$path_to_upload);   
	echo true;
  }
  public function updateImageTitleDescription()
  {
   $table_name=$this->input->post('table_name');
   $item_id=$this->input->post('item_id');
   $records=array();
   $records['image_title']=$this->input->post('image_title');
   $is_description=$this->input->post('is_description');
   if($is_description)
   {
    $records['description']=$this->input->post('description');
   }
   $this->Login_model->UpdateImage($records,$item_id,$table_name);
   echo true;
  }
  public function updateBrochureTitleDescription()
  {
   $table_name=$this->input->post('table_name');
   $item_id=$this->input->post('item_id');
   $records=array();
   $records['brochure_title']=$this->input->post('brochure_title');
   $is_description=$this->input->post('is_description');
   if($is_description)
   {
    $records['description']=$this->input->post('description');
   }
   $this->Login_model->UpdateImage($records,$item_id,$table_name);
   echo true;
  }
  
 }
