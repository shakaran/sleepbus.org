<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
 
 class Projects extends MY_Controller
 {
  public $uploading_image_info;
  public $uploading_brochure_info;
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Project_model');
   $this->load->helper('form');
   $this->load->library('form_validation');
   $this->load->library('CommonFunctions');
  }
  public function toptext()
  {
   $submit_value=$this->input->post('submit_form');
   $values=array();
   if(!empty($submit_value))
   {
	$records['content']=$this->input->post('content');
    $this->Login_model->UpdateTopText($records,2);
	$this->RedirectPage(admin.'/projects/toptext','Top text has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(2);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,2);
   $this->data['attributes']=$this->Project_model->GetTopTextFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/projects/top-text',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function add_project($values=array())
  {
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs','ValidateProjectFormJs');
   // $this->admincss->including_css_func = array('CalendarCss'); 
   if(count($values) > 0)
   {
    $this->data['title'] .= $values['title']; //this is meta title
	$this->data['page_title'] = $values['page_title']; //this is page heading
   }
   else
   {
    $values['project_title'] = '';
    $values['description'] = '';	
    $values['intro_text']="";	
	
	$this->data['page_title'] = 'Add Project';
	$this->data['file_error'] = '';
   }
   if(!empty($this->data['edit_id'])) $this->data['attributes'] = $this->Project_model->GetProjectFormAttribute($values,$this->data['edit_id']);
   else $this->data['attributes'] = $this->Project_model->GetProjectFormAttribute($values);
   $this->SetUpCkeditor(); 
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/projects/add-project',$this->data);
   $this->load->view(admin.'/templates/footer');
  }  
  
  public function validate_project()
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('projects/add-project');
   $this->data['active_submodule'] = 'add-project';

   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','{field}');
   $this->form_validation->set_message('is_unique','Project title already exists');

   $values = array();
   $file_uploaded = FALSE;

   $submit_value = $this->input->post('submit_value');   
   $values['title'] = 'Validate Project';   
   $values['project_title'] = $this->input->post('project_title');
   $values['description'] = $this->input->post('description');
   $values['intro_text'] = $this->input->post('intro_text');

   if($submit_value=='Update')
   {
    $values['page_title'] = 'Edit Project'; //this is page heading
	$edit_id = $this->input->post('edit_id');
    $this->data['edit_id'] = $edit_id;
    
	$this->form_validation->set_rules('project_title', 'Please enter project name', 
	'trim|required|callback_is_unique_with_condition['.PROJECTS.'~project_title~id !='.$edit_id.'~project]');
   }
   if($submit_value=='Submit')
   {
    $values['page_title'] = 'Add Project'; //this is page heading
    //$this->form_validation->set_rules('project_title', '', 'trim|required|is_unique['.PROJECTS.'.project_title]');

	$this->form_validation->set_rules('project_title', 'Please enter project name', 
	'trim|required|is_unique['.PROJECTS.'.project_title]');
    
   }
   $this->form_validation->set_rules('intro_text', 'Please enter introduction text', 'trim|required');

   $this->form_validation->set_rules('description', 'Please enter description', 'trim|required');
   $path_to_upload="./images/project/";
 
   if($this->form_validation->run()==FALSE) 
   {
	$this->add_project($values);
   }
   else
   {
    $records['project_title'] = $values['project_title'];
    $records['description'] = $values['description'];
    $records['intro_text'] = $values['intro_text'];

    if($submit_value=='Update')
	{
	 $this->Project_model->UpdateProject($records,$edit_id);
	 $this->RedirectPage(admin.'/projects/manage-projects/','Project updated successfully');
	}
	else
	{
     //genereate project url
	 $cat_url = strtolower(str_replace(' ','-',$this->commonfunctions->RemoveSpecialChars($records['project_title'])));		

	 $records['url'] = $this->Login_model->GenerateNewUrl($cat_url);	 

	 $edit_id=$this->Project_model->InsertProject($records);
	 $this->RedirectPage(admin.'/projects/manage-projects','Project added successfully');
	}
   }
  }
  public function edit_project($edit_id)
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('projects/add-project');	  
   $this->data['active_submodule'] = "add-project";
   $this->data['last_modified'] = $this->Login_model->LastModify(PROJECTS,$edit_id);   

   $values = array();
   $values = $this->Project_model->GetProjectDetails($edit_id);
   $values['page_title'] = 'Edit Project';
   $values['title'] = 'Edit Project';
   $values['submit_value'] = 'Update';
   $this->data['edit_id'] = $edit_id;
   $this->add_project($values);
  }
  public function manage_projects()
  {
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs','DragDropJs');
   
   $this->data['project_list'] = array();
   $this->data['project_list'] = $this->Project_model->GetProjectList();

   if(count($this->data['project_list']) > 0)
   {
    // Arguments for GetAtributesForDeletion function : 
    // 1. item list to be deleted, 
    // 2. which type of item to be deleted, 
    // 3. single delete permission-> value would be 'yes' or 'no' and 
    // 4. parent_id if you have(optional);
    	
    $this->data['attribute'] = $this->Login_model->GetAtributesForDeletion($this->data['project_list'],'project','no');
   }
   
   
  
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/projects/manage-projects',$this->data);
   $this->load->view(admin.'/templates/footer');
  }  
  public function manage_images($project_id='')
  {
   $this->data['active_submodule']="manage-images";
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs');
   $this->load->helper('form');    
   $this->data['project_id']=$project_id;
   $this->data['drop_down_attributes']=$this->Project_model->GetProjectDropDownAttribute();
   if(!empty($project_id))$this->data['image_list']=$this->Login_model->GetImageList(PROJECT_IMAGES,'project_id',$project_id);
   else $this->data['image_list']=array();
   if(count($this->data['image_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['deletion_attribute']=$this->Login_model->GetAtributesForDeletion($this->data['image_list'],'image','no',$project_id);
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/projects/manage-images',$this->data);
   $this->load->view(admin.'/templates/footer');
  }

  public function ImageUploader($project_id='',$values=array())
  {
   //$this->load->Model(admin.'/Generalpages_model');	  
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('projects/manage-images');	  
   $this->data['active_submodule']="manage-images";

   $this->data['page_title']="Add Image";
   $this->data['parent_id']=$project_id;   
   if(!empty($this->data['parent_id']))
   {
	$parent_drop_down_list=$this->Project_model->GetProjectListForDropDown();
	// 1. parent_drop_down_list
    $this->data['attributes']=$this->Login_model->GetImageUploaderFormAttribute($parent_drop_down_list);
   }
   
   // if you have any remarks then assign as $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)"; other wise it takes default remarks
   $this->data['remarks']="Image size must be 1300(w) x 580(h)px";
   // Image validation attributes. All are optional. If you give min. value then not give fixed value and vice versa. Image size must be KB.
   
   $this->data['max_height']="580";
   $this->data['max_width']="1300";
   $this->data['fixed_height']="";
   $this->data['fixed_width']="";
   $this->data['max_size']="";
   
   $this->data['upload_type']="image"; // image/brochure
   $this->data['field_name']="image_file"; // file field name in your database table

   $this->data['path_to_upload']="./images/projects/";
   $this->data['parent_drop_down_title']="Selected Project";
   $this->data['parent_field']="project_id";
   $this->data['table_name']=PROJECT_IMAGES;
   $this->data['return_url']=admin."/projects/manage-images/".$this->data['parent_id'];

   $this->data['description']=false; // add image details after uploading image, set true/false
   
   $this->admincss->including_css_func=array('FileUploaderCss');   
   $this->load->view(admin.'/templates/image-uploader',$this->data);
  }
  public function AddImage($project_id='',$values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('projects/manage-images');	  
   $this->data['active_submodule']="manage-images";
   $this->adminjavascript->include_admin_js=array('ValidateProjectFormJs');
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
	$this->data['parent_id']=$values['parent_id'];
	$this->data['submit_value']=$values['submit_value']; 
    $this->data['image_quality']=$values['image_quality'];  
	if(isset($values['edit_id']) and !empty($values['edit_id']))
	{
     $this->data['last_modified']=$this->Login_model->LastModify(PROJECT_IMAGES,$values['edit_id']);   
	}
   }
   else
   {
    $this->data['image_quality']='';  
    $values['image_title']="";
    $values['current_image']="";
    //$values['description']="";
    $values['image_alt_title_text']="";	
	$this->data['page_title']="Add Project Image";
	$this->data['parent_id']=$project_id;  
	$this->data['submit_value']="Submit"; 
   }
   if(!empty($this->data['parent_id']))
   {
	$parent_drop_down_list=$this->Project_model->GetProjectListForDropDown();
	// argument 1. values, 2.submit_type, 3. parent_drop_down_list 4. Character count of title (optional)
    $this->data['attributes']=$this->Login_model->GetImageFormAttribute($values,$this->data['submit_value'],$parent_drop_down_list,45);
   }
   
   // if you have any remarks then assign as $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)"; other wise it takes default remarks, similarly for title also
   $this->data['title_remarks']="*(Max 45 Chars)";
   $this->data['remarks']="Image size must be (1300 x 580) (Width x Height)";
   $this->data['image_quality_options']=$this->Login_model->GetImageQualityOptions();
   $this->data['file_path']=base_url().admin."/projects/validateProjectimage";
   $this->data['uploading_path']=base_url()."images/projects";
   $this->data['parent_drop_down_title']="Selected Project";
   $this->load->view(admin.'/templates/add-image',$this->data);
  }
  public function edit_image($image_id,$project_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('projects/manage-images');	  
   $this->data['active_submodule']="manage-images";
   $this->data['last_modified']=$this->Login_model->LastModify(PROJECT_IMAGES,$image_id);   
   $values=array();
   $values=$this->Login_model->GetImageBrochureDetails($image_id,PROJECT_IMAGES);
   unset($values['description']);
   $values['current_image']=$values['image_file'];
   $values['title']="Edit Image";
   $values['parent_id']=$project_id;
   $values['page_title']="Edit Image";
   $values['submit_value']="Update"; 
   $values['edit_id']=$image_id;
   $this->AddImage($project_id,$values);
  }
  public function validateProjectimage()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('projects/manage-images');
   $this->data['active_submodule']="manage-images";
   $values=array();
   $values['title']="Validate Project Image";
   $values['image_title']=$this->input->post('image_title');
   $values['current_image']=$this->input->post('current_image');
   // if there is a description field
   $values['description']=trim($this->input->post('description'));
   $values['parent_id']=trim($this->input->post('parent_id'));
   $values['submit_value']=$this->input->post('submit_value');
   $values['image_alt_title_text']=$this->input->post('image_alt_title_text');
   $values['image_quality']=$this->input->post('image_quality');
   if($values['submit_value'] == "Submit") $values['page_title']="Add Project Image";
   else
   {
    $values['page_title']="Edit Project Image";
    $values['edit_id']=$this->input->post('edit_id');
   }
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
 
   if(!empty($_FILES['image_file']['name']))
   {
	$path_to_upload="./images/projects/";
	// list of argument for image validation array
// 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $project_image_info=array("image_file",$path_to_upload,"project_image","1300","500","","",'');
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
	$records['project_id']=$values['parent_id'];
	$records['description']=$values['description'];
	
    $this->data['redirect_url']=admin."/projects/manage-images/".$values['parent_id'];
	if($values['submit_value'] == "Submit")
	{
	 $this->Login_model->InsertImage($records,PROJECT_IMAGES,'project_id'); 
	 $message="Image has been added successfully";
	}
	elseif($values['submit_value'] == "Update")
	{
	 $this->Login_model->UpdateImage($records,$values['edit_id'],PROJECT_IMAGES); 
	  $message="Image has been updated successfully";
    }
	$this->RedirectPopupPage($this->data['redirect_url'],$message);
   }
  } 

  
  public function changestatus($record_id, $status, $section, $parent_id = '', $edit_id = '')
  {
   $section = str_replace("_","-",$section); 
   
   if($section=='manage-projects')
   {
    $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('projects/manage-projects');
    $this->Login_model->ChangeStatus(PROJECTS,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of project changed successfully');
   }
   elseif($section=='manage-images')
   {
    $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('projects/manage-images');
    $this->Login_model->ChangeStatus(PROJECT_IMAGES, $record_id, $status);
    $this->session->set_flashdata('success_message','Status of project image changed successfully');
   }

   if(!empty($parent_id)) $section .= '/'.$parent_id; 
   if(!empty($edit_id)) $section .= '/'.$edit_id;

   header("location:".base_url().admin."/projects/$section");
   exit;
  } 
  
  
  // mandatory Function for each module
  public function ConfirmDelete($checked_id, $item_name, $parent_id = '', $edit_id = '') 
  {
   $this->adminjavascript->include_admin_js = array('ConfirmDeleteJs');
   
   if($item_name=='project') 
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('projects/manage-projects');	  	  
   else if($item_name=='image') $this->data['sub_modules']=$this->CheckSubModuleAccessibility('projects/manage-images');	  	     
   
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_id, $item_name, $parent_id);
   if($edit_id != '')
   {
    $attributes2 = array('edit_id' => $edit_id);
    $this->data['attributes']['hidden'] = array_merge($this->data['attributes']['hidden'],$attributes2);
   }
   /*
   If you have any additional attribute item wise then you can merge it as follows  : 
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   If you have any custom message other than common message item wise then assign message to data variable as follows
   Default message
   */
   if($item_name == "project_image_delete")
   {
	$this->data['message']="Are you sure want to delete this image.";
   }
   elseif($item_name == "remove_clone")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('projects/manage-projects');	  	  
	$this->data['message']="Are you sure want to unlink this project from selected project.";
   }
   else
   {
    $this->data['message'] = "Are you sure you want to delete selected ".$item_name;
   }
   $this->load->view(admin.'/templates/confirm-delete',$this->data);
  }
  
  //mandatory Function for each module
  public function ConfirmSuperadmin($checked_ids, $item_name, $parent_id='', $edit_id='') 
  {
   if($item_name=='project') 
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('projects/manage-projects');	  	  
   else if($item_name=='image') $this->data['sub_modules']=$this->CheckSubModuleAccessibility('projects/manage-images');	  	     
   
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_ids, $item_name, $parent_id);
   
   if($edit_id != '')
   {
    $attributes2 = array('edit_id'=>$edit_id);
    $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   }
   /*
   If you have any additional attribute item wise then you can merge it as follows  : 
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   If you have any custom message other than common message item wise then assign message to data variable as follows
   Default message
   */
   if($item_name=='project') $this->data['message'] = "If you delete selected project, all related images will be deleted. Are you sure you want to delete?";
   else $this->data['message'] = "Are you sure you want to delete all selected item(s)";
      
   $this->adminjavascript->include_admin_js = array('SuperAdminValidationJs');
   $this->admincss->including_css_func = array('PrettyPhotoCss');  
   $this->load->view(admin.'/templates/superadmin-delete',$this->data);
  }
  
  //mandatory Function for each module
  public function DeleteRecord($checked_ids, $item_name, $parent_id = '', $edit_id = '') 
  {
   $item_name = urldecode($item_name);
   $all_ids = explode("~",$checked_ids);
   
   // Delete Record item wise and redirect the page to repective module with success message
   if($item_name=="project")
   {
    if(count($all_ids) > 0)
	{
	 $this->Project_model->DeleteProjects($all_ids, $parent_id);
	 $this->RedirectPage(admin.'/projects/manage-projects', 'Selected project deleted successfully');
	}
   } 
   else if($item_name=="image")
   {
    $values = array();
    $table_name = PROJECT_IMAGES;
	$this->Login_model->DeleteImageBrochureRecord($all_ids, 'project_id', $parent_id, $table_name, 'image_file','./images/projects/');
	
    $this->RedirectPage(admin.'/projects/manage-images/'.$parent_id,'Selected image(s) deleted successfully');
   }
  }    
  
 }

