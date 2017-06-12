<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Testimonials extends MY_Controller
 {
  public $uploading_image_info;
  public $uploading_brochure_info;

  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Testimonials_model');
   $this->load->helper('form');
   $this->load->library('CommonFunctions');	
  }
  public function addtestimonial($values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('testimonials/addtestimonial');	  	  

   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateTestimonialsFormJs');
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
   }
   else
   {
    $values['testimonials_title']="";
    $values['description']="";	
	$this->data['page_title']="Add Testimonial";
   }
   if(!empty($this->data['testimonials_id']))
   {
    $this->data['attributes']=$this->Testimonials_model->GetTestimonialsFormAttribute($values,$this->data['testimonials_id']);
   }
   else
   {
    $this->data['attributes']=$this->Testimonials_model->GetTestimonialsFormAttribute($values);
   }
   $this->SetUpCkeditor(); 
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/testimonials/addtestimonial',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validatetestimonials()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('testimonials/addtestimonial');
   $this->data['active_submodule']="addtestimonial";
   $values=array();
   $values['title']="Validate Testimonials";
   $testimonials_id=$this->input->post('testimonials_id');
   
   $values['description']=$this->input->post('description');
   $values['testimonials_title']=$this->input->post('testimonials_title');
   $this->load->library('form_validation'); 
   $this->form_validation->set_message('required', 'Please enter {field}', 'trim|required');
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_rules('description', 'description', 'trim|required');
   
   if(!empty($testimonials_id))
   {
    $values['page_title']="Edit Testimonials";
    $this->data['testimonials_id']=$testimonials_id;
    $this->form_validation->set_rules('testimonials_title', 'title', 'trim|required|callback_is_unique_on_update['.TESTIMONIALS.'~testimonials_title~'.$testimonials_id.'~testimonials title]');
   }
   else
   {
    $values['page_title']="Add Testimonials";
    $this->form_validation->set_rules('testimonials_title', 'title', 'trim|required|is_unique['.TESTIMONIALS.'.testimonials_title]');
   }
   
   if($this->form_validation->run() == FALSE)
   { 
    $this->addtestimonial($values);
   }
   else
   {
	$records['description']=$values['description'];
	$records['testimonials_title']=$values['testimonials_title'];
    if(!empty($testimonials_id))
	{
	 $this->Testimonials_model->UpdateTestimonials($records,$testimonials_id);
	 $this->RedirectPage(admin.'/testimonials/managetestimonials','Testimonial updated successfully');
	}
	else
	{
	 $this->Testimonials_model->InsertTestimonials($records);
	 $this->RedirectPage(admin.'/testimonials/managetestimonials','Testimonial added successfully');
	}
   }
  }
  
  public function edittestimonials($testimonials_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('testimonials/addtestimonial');	  
   $this->data['active_submodule']="addtestimonial";
   $this->data['last_modified']=$this->Login_model->LastModify(TESTIMONIALS,$testimonials_id);   

   $values=array();
   $values=$this->Testimonials_model->GetTestimonialsDetails($testimonials_id);
   $values['page_title']="Edit Testimonials";
   $values['title']="Edit Testimonials";
   $values['submit_value']="Update";
   $this->data['testimonials_id']=$testimonials_id;
   $this->addtestimonial($values);
  }  
  public function managetestimonials()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('testimonials/managetestimonials');	  	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs');
   //$this->admincss->including_css_func=array('PrettyPhotoCss');   
   $this->load->helper('form');    
   $this->data['testimonials_list']=$this->Testimonials_model->GetTestimonialsList();
   if(count($this->data['testimonials_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['attribute']=$this->Login_model->GetAtributesForDeletion($this->data['testimonials_list'],'testimonial','no');
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/testimonials/manage-testimonials',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  
  // by sarita
  
  public function video_testimonials($video_id='',$values=array())
  {
   if(!empty($video_id) and count($values) == 0)
   {
    $this->data['title'] ="Testimonials : Update Video";
	$values=$this->Testimonials_model->GetVideoDetails($video_id);
   }
   elseif(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
   }
   else
   {
    $values=array();
	$values['video_title']="";
	$values['video_code']="";
   }

   if(!empty($video_id))
   {
    $this->data['video_id']=$video_id;
    $this->data['page_title']="Edit Video";
	$this->data['last_modified']=$this->Login_model->LastModify(VIDEO_TESTIMONIALS,$video_id);
   }
   else
   {
    $this->data['page_title']="Add Video";
   }

    $this->data['all_videos']=$this->Testimonials_model->GetAllVideos();
    // attrubutes for deletion of banners
    $this->data['deletion_attributes']=$this->Login_model->GetAtributesForDeletion($this->data['all_videos'],'video','yes');
	if($video_id!="")
	{
     $this->data['attributes']=$this->Testimonials_model->GetVideoAttributes($values,$video_id);
	}
	else
	{
     $this->data['attributes']=$this->Testimonials_model->GetVideoAttributes($values,"");
	}
	
   $this->adminjavascript->include_admin_js=array('ValidateTestimonialsFormJs','SuccessMessageJs','DragDropJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/testimonials/video-testimonials',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validatevideo($video_id='')
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('testimonials/addtestimonial');
   $this->data['active_submodule']="video_testimonials";
   $values=array();
   $values['title']="Validate Video";
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','Please enter {field}');
   $this->form_validation->set_rules('video_code', 'video code', "trim|required");
   $this->form_validation->set_rules('video_title', 'video title', "trim|required");
   $values['video_title']=$this->input->post('video_title');
   $values['video_code']=$this->input->post('video_code');
   if($this->form_validation->run() == FALSE)
   { 
	if(!empty($video_id)) $this->video_testimonials($video_id,$values);
	else $this->video_testimonials('',$values);
    
   }
   else
   {
	$records['video_title']=$values['video_title'];
	$records['video_code']=$values['video_code'];
    if(!empty($video_id))
	{
	 $this->Testimonials_model->UpdateVideo($records,$video_id);
	 $this->RedirectPage(admin.'/testimonials/video-testimonials','Video has been Updated successfully');
	}
	else
	{
	 $this->Testimonials_model->InsertVideo($records);
	 $this->RedirectPage(admin.'/testimonials/video-testimonials','Video has been added successfully');
	}
   }
  }

  public function ConfirmSuperadmin($checked_ids,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('testimonials/managetestimonials');	  	  
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
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('testimonials/managetestimonials');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_id,$item_name);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message
  
   
    $this->data['message']="Are you sure you want to delete this record.";
  
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js=array('ConfirmDeleteJs');
   $this->load->view(admin.'/templates/confirm-delete',$this->data);
  }
  public function DeleteRecord($checked_ids,$item_name) // mandatory Function for each module
  {
   $item_name=urldecode($item_name);
   $all_ids=explode("~",$checked_ids);
   // Delete Record item wise and redirect the page to repective module with success message
   if($item_name == "testimonial")
   {
    if(count($all_ids) > 0)
	{
	 $this->Testimonials_model->DeleteRecordForTestimonials($all_ids);
	 $this->RedirectPage(admin.'/testimonials/managetestimonials','Testimonial(s) deleted successfully');
	}
   } 
   if($item_name == "video")
   {
    if(count($all_ids) > 0)
	{
	 $this->Testimonials_model->DeleteRecordForVideos($all_ids);

	 $this->RedirectPage(admin.'/testimonials/video-testimonials','Video Testimonial(s) deleted successfully');
	}
   } 
  }

  public function changestatus($record_id,$status,$section,$parent_id="")
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('testimonials/managetestimonials');
   if($section == "video_testimonials")
   {
    $this->Login_model->ChangeStatus(VIDEO_TESTIMONIALS,$record_id,$status);
    $this->session->set_flashdata('success_message','Status has been changed successfully'); 
    $section=str_replace("_","-",$section);
   }
   else
   {
    $this->Login_model->ChangeStatus(TESTIMONIALS,$record_id,$status);
    $this->session->set_flashdata('success_message','Status has been changed successfully');
   }
   if(!empty($parent_id))
   {
    $section.="/$parent_id";
   }
   header("location:".base_url().admin."/testimonials/$section");
   exit;
  } 
 }