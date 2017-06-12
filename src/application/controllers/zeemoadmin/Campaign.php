<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Campaign extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Campaign_model');
   $this->load->helper('form');
   $this->load->library('CommonFunctions');	
  }
  public function pageheadings($page_id='',$values=array())
  {
   $this->data['parent_id']=array('9','11');	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   if(count($values) == 0)
   {
    if(!empty($page_id))
	{
	 $values=$this->Campaign_model->GetPageHeading($page_id);
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

   if(isset($values['sub_heading']))
   {
    $this->data['sub_heading']=$values['sub_heading'];
    if($this->data['sub_heading'] == '1')
    {
     $this->SetUpCkeditor(); 
    }
   }
   $this->data['page_id']=$page_id;
   if(!empty($page_id))
   {
    $this->data['last_modified']=$this->Login_model->LastModify(PAGE_HEADING,$page_id); 
   }
   $this->data['attributes']=$this->Campaign_model->GetPageHeadingFormAttribute($values,$this->data['parent_id'],$page_id);
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/campaign/page-heading',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validateheadings()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('campaign/pageheadings');
   $this->data['active_submodule']="pageheadings";
   $values=array();
   $values['title']="Validate Headings";
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
 //  $this->form_validation->set_rules('page_heading', 'page heading', 'trim|required');
   $this->form_validation->set_rules('heading_id', 'selection of page', 'trim|required');   
   $page_id=$this->input->post('heading_id');
   $values['page_heading']=$this->input->post('page_heading');
   $values['sub_heading']=$this->input->post('sub_heading');
   
   if($this->form_validation->run() == FALSE)
   {
    $this->pageheadings($page_id,$values);
   }
   else
   {
	$records['page_heading']=$values['page_heading'];
    $this->Campaign_model->UpdatePageHeadings($page_id,$records);
	$this->RedirectPage(admin.'/campaign/pageheadings/'.$page_id,'Page heading updated successfully');
   }
  }
  
  public function pledge_content()
  {
   $submit_value=$this->input->post('submit_form');
   $values=array();
   if(!empty($submit_value))
   {
	$records['content']=$this->input->post('content');
    $this->Login_model->UpdateTopText($records,13);
	$this->RedirectPage(admin.'/campaign/pledge-content','Birthday pledge content has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(13);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,13);
   $this->data['attributes']=$this->Campaign_model->GetTopTextFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/campaign/birthday-pledge',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
 
  public function campaign_type($values=array())
  {
   //for ckeditor   
   $this->SetUpCkeditor(); 
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs','ValidateCampaignJs');
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
   }
   else
   {
    $values['type_name']="";
    $values['mission_statement']="";	
	$this->data['page_title']="Add Campaign Type";
   }
   if(!empty($this->data['id']))
   {
    $this->data['attributes']=$this->Campaign_model->GetCampaignTypeFormAttribute($values,$this->data['id']);
   }
   else
   {
    $this->data['attributes']=$this->Campaign_model->GetCampaignTypeFormAttribute($values);
   }
   $this->data['type_list']=$this->Campaign_model->GetAllCategories();
   if(count($this->data['type_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['attribute']=$this->Login_model->GetAtributesForDeletion($this->data['type_list'],'type','no');
   }
   
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/campaign/campaign-type',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validate_type()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('campaign/campaign-type');
   $this->data['active_submodule']="campaign-type";
   $values=array();
   $values['title']="Validate Campaign Type";
   $id=$this->input->post('id');
   
   $values['type_name']=$this->input->post('type_name');
   $values['mission_statement']=$this->input->post('mission_statement');
   
   $this->load->library('form_validation'); 
   $this->form_validation->set_message('required','Please enter {field}');
   $this->form_validation->set_error_delimiters('<span>','</span>');
   if(!empty($id))
   {
    $values['page_title']="Edit Campaign Type";
    $this->data['id']=$id;
    $this->form_validation->set_rules('type_name', 'type name', 'trim|required|callback_is_unique_on_update['.CAMPAIGN_TYPE.'~type_name~'.$id.'~type name]');
   }
   else
   {
    $values['page_title']="Add Category";
    $this->form_validation->set_rules('type_name', 'type name', 'trim|required|is_unique['.CAMPAIGN_TYPE.'.type_name]');
   }
   $this->form_validation->set_rules('mission_statement', 'mission statement', 'trim|required');
   
   if($this->form_validation->run() == FALSE)
   { 
    $this->campaign_type($values);
   }
   else
   {
	$records['type_name']=$values['type_name'];
	$records['mission_statement']=$values['mission_statement'];

    if(!empty($id))
	{
	 $this->Campaign_model->UpdateCampaignType($records,$id);
	 $this->RedirectPage(admin.'/campaign/campaign-type','Campaign type has been updated successfully');
	}
	else
	{
	 $this->Campaign_model->InsertCampaignType($records);
	 $this->RedirectPage(admin.'/campaign/campaign-type','Campaign type has been added successfully');
	}
   }
  }
  public function edit_type($id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('campaign/campaign-type');	  
   $this->data['active_submodule']="campaign-type";
   $this->data['last_modified']=$this->Login_model->LastModify(CAMPAIGN_TYPE,$id);   

   $values=array();
   $values=$this->Campaign_model->GetCampaignTypeDetails($id);
   $values['page_title']="Edit Campaign Type";
   $values['title']="Edit Campaign Type";
   $values['submit_value']="Update";
   $this->data['id']=$id;
   $this->campaign_type($values);
  }  
  public function manage_images($campaign_id='')
  {
   $this->data['active_submodule']="manage-images";
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs');
   $this->load->helper('form');    
   $this->data['campaign_id']=$campaign_id;
   $this->data['drop_down_attributes']=$this->Campaign_model->GetCampaignDropDownAttribute();
   if(!empty($campaign_id))$this->data['image_list']=$this->Login_model->GetImageList(CAMPAIGN_IMAGES,'campaign_id',$campaign_id);
   else $this->data['image_list']=array();
   if(count($this->data['image_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['deletion_attribute']=$this->Login_model->GetAtributesForDeletion($this->data['image_list'],'image','no',$campaign_id);
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/campaign/manage-images',$this->data);
   $this->load->view(admin.'/templates/footer');
  }

  public function ImageUploader($campaign_id='',$values=array())
  {
   //$this->load->Model(admin.'/Generalpages_model');	  
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('campaign/manage-images');	  
   $this->data['active_submodule']="manage-images";

   $this->data['page_title']="Add Image";
   $this->data['parent_id']=$campaign_id;   
   if(!empty($this->data['parent_id']))
   {
	$parent_drop_down_list=$this->Campaign_model->GetCampaignListForDropDown();
	// 1. parent_drop_down_list
    $this->data['attributes']=$this->Login_model->GetImageUploaderFormAttribute($parent_drop_down_list);
   }
   
   // if you have any remarks then assign as $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)"; other wise it takes default remarks
   $this->data['remarks']="Max. image size must be 1280(w) x 475(h)px";
   // Image validation attributes. All are optional. If you give min. value then not give fixed value and vice versa. Image size must be KB.
   
   $this->data['max_height']="";
   $this->data['max_width']="";
   $this->data['fixed_height']="475";
   $this->data['fixed_width']="1280";
   $this->data['max_size']="";
   
   $this->data['upload_type']="image"; // image/brochure
   $this->data['field_name']="image_file"; // file field name in your database table

   $this->data['path_to_upload']="./images/campaign/";
   $this->data['parent_drop_down_title']="Selected Compaign";
   $this->data['parent_field']="campaign_id";
   $this->data['table_name']=CAMPAIGN_IMAGES;
   $this->data['return_url']=admin."/campaign/manage-images/".$this->data['parent_id'];

   $this->data['description']=false; // add image details after uploading image, set true/false
   
   $this->admincss->including_css_func=array('FileUploaderCss');   
   $this->load->view(admin.'/templates/image-uploader',$this->data);
  }
  public function AddImage($campaign_id='',$values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('campaign/manage-images');	  
   $this->data['active_submodule']="manage-images";
   $this->adminjavascript->include_admin_js=array('ValidateCampaignJs');
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
	$this->data['parent_id']=$values['parent_id'];
	$this->data['submit_value']=$values['submit_value']; 
    $this->data['image_quality']=$values['image_quality'];  
	if(isset($values['edit_id']) and !empty($values['edit_id']))
	{
     $this->data['last_modified']=$this->Login_model->LastModify(CAMPAIGN_IMAGES,$values['edit_id']);   
	}
   }
   else
   {
    $this->data['image_quality']='';  
    $values['image_title']="";
    $values['current_image']="";
    //$values['description']="";
    $values['image_alt_title_text']="";	
	$this->data['page_title']="Add Compaign Image";
	$this->data['parent_id']=$campaign_id;  
	$this->data['submit_value']="Submit"; 
   }
   if(!empty($this->data['parent_id']))
   {
	$parent_drop_down_list=$this->Campaign_model->GetCampaignListForDropDown();
	// argument 1. values, 2.submit_type, 3. parent_drop_down_list 4. Character count of title (optional)
    $this->data['attributes']=$this->Login_model->GetImageFormAttribute($values,$this->data['submit_value'],$parent_drop_down_list,45);
   }
   
   // if you have any remarks then assign as $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)"; other wise it takes default remarks, similarly for title also
   $this->data['title_remarks']="*(Max 45 Chars)";
   $this->data['remarks']="Image size must be (1280 x 475) (Width x Height)";
   $this->data['image_quality_options']=$this->Login_model->GetImageQualityOptions();
   $this->data['file_path']=base_url().admin."/campaign/validateCompaignimage";
   $this->data['uploading_path']=base_url()."images/campaign";
   $this->data['parent_drop_down_title']="Selected Compaign";
   $this->load->view(admin.'/templates/add-image',$this->data);
  }
  public function edit_image($image_id,$campaign_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('campaign/manage-images');	  
   $this->data['active_submodule']="manage-images";
   $this->data['last_modified']=$this->Login_model->LastModify(CAMPAIGN_IMAGES,$image_id);   
   $values=array();
   $values=$this->Login_model->GetImageBrochureDetails($image_id,CAMPAIGN_IMAGES);
   unset($values['description']);
   $values['current_image']=$values['image_file'];
   $values['title']="Edit Image";
   $values['parent_id']=$campaign_id;
   $values['page_title']="Edit Image";
   $values['submit_value']="Update"; 
   $values['edit_id']=$image_id;
   $this->AddImage($campaign_id,$values);
  }
  public function validateCompaignimage()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('campaign/manage-images');
   $this->data['active_submodule']="manage-images";
   $values=array();
   $values['title']="Validate Compaign Image";
   $values['image_title']=$this->input->post('image_title');
   $values['current_image']=$this->input->post('current_image');
   // if there is a description field
   $values['description']=trim($this->input->post('description'));
   $values['parent_id']=trim($this->input->post('parent_id'));
   $values['submit_value']=$this->input->post('submit_value');
   $values['image_alt_title_text']=$this->input->post('image_alt_title_text');
   $values['image_quality']=$this->input->post('image_quality');
   if($values['submit_value'] == "Submit") $values['page_title']="Add Compaign Image";
   else
   {
    $values['page_title']="Edit Compaign Image";
    $values['edit_id']=$this->input->post('edit_id');
   }
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
 
   if(!empty($_FILES['image_file']['name']))
   {
	$path_to_upload="./images/campaign/";
	// list of argument for image validation array
// 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $project_image_info=array("image_file",$path_to_upload,"project_image","1280","475","","",'');
    $project_image_info_string=implode("~",$project_image_info);
    $this->form_validation->set_rules('image_file', 'image', "callback_image_validation[{$project_image_info_string}]");
   }
   else if($values['submit_value'] == "Submit")
   {
    $this->form_validation->set_rules('image_file', 'image', "required");
   }
   if($this->form_validation->run() == FALSE)
   { 
    // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_image_info['project_image']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['project_image']['file_name']);
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
	 $records['image_file']=$this->uploading_image_info['project_image']['file_name'];
	 $this->ReduceImageWeight($records['image_file'],$path_to_upload, $values['image_quality']);
  	 $records['image_quality']=$values['image_quality'];
	}
	$records['image_alt_title_text']=$values['image_alt_title_text'];
	$records['image_title']=$values['image_title'];
	$records['campaign_id']=$values['parent_id'];
	$records['description']=$values['description'];
	
    $this->data['redirect_url']=admin."/campaign/manage-images/".$values['parent_id'];
	if($values['submit_value'] == "Submit")
	{
	 $this->Login_model->InsertImage($records,CAMPAIGN_IMAGES,'campaign_id'); 
	 $message="Image has been added successfully";
	}
	elseif($values['submit_value'] == "Update")
	{
	 $this->Login_model->UpdateImage($records,$values['edit_id'],CAMPAIGN_IMAGES); 
	  $message="Image has been updated successfully";
    }
	$this->RedirectPopupPage($this->data['redirect_url'],$message);
   }
  } 
  
  public function setting($values=array())
  {
   if(count($values) == 0)
   {
    $values=$this->Campaign_model->GetCampaignInformation();
   }
   else
   {
    $this->data['title'].=$values['title'];
   }

   $this->data['last_modified']=$this->Login_model->LastModify(CAMPAIGN_SETTINGS);
   $this->data['attributes']=$this->Campaign_model->GetCommonSettingFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');   
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/campaign/setting',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validatesetting()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('campaign/setting');
   $this->data['active_submodule']="setting";
   $values=array();
   $values['title']="Validate Settings";
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');


   $path_to_upload="./images/campaign/";
   if(!empty($_FILES['campaign_logo']['name']))
   {
	// list of argument for image validation array
// 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $campaign_logo_info=array("campaign_logo",$path_to_upload,"campaign_logo","","","","",'');
    $campaign_logo_info_string=implode("~",$campaign_logo_info);
    $this->form_validation->set_rules('campaign_logo', 'Logo', "callback_image_validation[{$campaign_logo_info_string}]");
   }
   
   if(!empty($_FILES['common_banner']['name']))
   {
	//$path_to_upload="./brochures/generalpages/";
	// list of argument for brochure validation array // 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $banner_image_info=array("common_banner",$path_to_upload,"common_banner","","","1280","475",'');
    $banner_image_info_string=implode("~",$banner_image_info);
	
    $this->form_validation->set_rules('common_banner', 'Banner', "callback_image_validation[{$banner_image_info_string}]");
   }

   $values['current_campaign_logo']=$this->input->post('current_campaign_logo');
   $values['current_common_banner']=$this->input->post('current_common_banner');
   

   if($this->form_validation->run() == FALSE)
   { 
    $error=false;
    // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_image_info['campaign_logo']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['campaign_logo']['file_name']);
	 $error=true;
	}
	if(!empty($this->uploading_image_info['common_banner']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['common_banner']['file_name']);
	 $error=true;
	}
	
    $this->setting($values);
   }
   else
   {
	$records=array();
    if(!empty($_FILES['campaign_logo']['name']) and !empty($values['current_campaign_logo']))
	{
	 // delete previous image
	// unlink($path_to_upload.$values['current_campaign_logo']);
	 $records['campaign_logo']=$this->uploading_image_info['campaign_logo']['file_name'];
	}
    if(!empty($_FILES['common_banner']['name']))
	{
	 // delete previous image
	 if(!empty($values['current_common_banner']))
	 {
	  unlink($path_to_upload.$values['current_common_banner']);
	 }
	 $records['common_banner']=$this->uploading_image_info['common_banner']['file_name'];
	}
	
	if(count($records) > 0)
	{
	 $this->Campaign_model->UpdateSettingRecords($records);
	}
	$this->RedirectPage(admin.'/campaign/setting','Common setting updated successfully');
   }
  }
  
  public function ConfirmSuperadmin($checked_ids,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_ids,$item_name,$parent_id);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */   
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message
   if($item_name == "campaign_type")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('campaign/campaign-type');	  	  
    $this->data['message']="Are you sure you want to delete this category.";
   }
   else if($item_name=='image')
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('projects/manage-images');
    $this->data['message']="Are you sure you want to delete all selected images(s)";
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
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_id,$item_name,$parent_id);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message
   if($item_name == "campaign_type")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('campaign/campaign-type');	  	  
	$this->data['message']="Are you sure you want to delete this campaign type.";
   }
   else if($item_name=='image')
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('projects/manage-images');
    $this->data['message']="Are you sure you want to delete all selected images(s)";
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
   if($item_name == "campaign_type")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('campaign/campaign-type');	  	  
    if(count($all_ids) > 0)
	{
	 $this->Campaign_model->DeleteRecordForCampaignType($all_ids);
	 $this->RedirectPage(admin.'/campaign/campaign-type','Campaign type has been deleted successfully');
	}
   } 
   else if($item_name=="image")
   {
    $values = array();
    $table_name = CAMPAIGN_IMAGES;
	$this->Login_model->DeleteImageBrochureRecord($all_ids, 'campaign_id', $parent_id, $table_name, 'image_file','./images/campaign/');
	$this->Campaign_model->DeleteUserCampaignImage($all_ids);
	
    $this->RedirectPage(admin.'/campaign/manage-images/'.$parent_id,'Selected image(s) deleted successfully');
   }
  }
  public function changestatus($record_id,$status,$section,$parent_id="")
  {
   $section=str_replace("_","-",$section);
   if($section == "campaign-type")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('campaign/campaign-type');
    $this->Login_model->ChangeStatus(CAMPAIGN_TYPE,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of category has been changed successfully'); 
   }
   elseif($section=='manage-images')
   {
    $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('campaign/manage-images');
    $this->Login_model->ChangeStatus(CAMPAIGN_IMAGES, $record_id, $status);
    $this->session->set_flashdata('success_message','Status of campaign image changed successfully');
   }
   if(!empty($parent_id))
   {
    $section.="/$parent_id";
   }
   header("location:".base_url().admin."/campaign/$section");
   exit;
  } 
 }
