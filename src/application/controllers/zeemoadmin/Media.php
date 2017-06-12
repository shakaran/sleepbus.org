<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
 class Media extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Media_model');
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
    $this->Login_model->UpdateTopText($records,6);
	$this->RedirectPage(admin.'/media/toptext','Top text has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(6);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,6);
   $this->data['attributes']=$this->Media_model->GetTopTextFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/media/top-text',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function bottom_text()
  {
   $submit_value=$this->input->post('submit_form');
   $values=array();
   if(!empty($submit_value))
   {
	$records['content']=$this->input->post('content');
    $this->Login_model->UpdateTopText($records,7);
	$this->RedirectPage(admin.'/media/bottom-text','Bottom text has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(7);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,7);
   $this->data['attributes']=$this->Media_model->GetTopTextFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/media/bottom-text',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function add_item($values=array())
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMediaFormJs','CalendarJs');
   $this->admincss->including_css_func=array('CalendarCss'); 
   if(count($values) > 0)
   {
    $this->data['title'] .= $values['title']; //this is meta title
	$this->data['page_title'] = $values['page_title']; //this is page heading
   }
   else
   {
    $values['media_title'] = '';
	$values['date_display']=date("d-m-Y");
    $values['url']="";		
    $values['publication']="";		
	
	$this->data['page_title'] = 'Add an Item';
	$this->data['file_error'] = '';
   }
   if(!empty($this->data['edit_id'])) $this->data['attributes'] = $this->Media_model->GetMediaFormAttribute($values,$this->data['edit_id']);
   else $this->data['attributes'] = $this->Media_model->GetMediaFormAttribute($values);
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/media/add-item',$this->data);
   $this->load->view(admin.'/templates/footer');
  }  
  
  public function validate_item()
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('media/add-item');
   $this->data['active_submodule'] = 'add-item';

   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','{field}');
   $this->form_validation->set_message('is_unique','Item title already exists');

   $values = array();
   $file_uploaded = FALSE;

   $submit_value = $this->input->post('submit_value');   
   $values['title'] = 'Validate Item';   
   $values['media_title'] = $this->input->post('media_title');
   $values['date_display'] = $this->input->post('date_display');
   $values['url'] = $this->input->post('url');
   $values['publication'] = $this->input->post('publication');

   if($submit_value=='Update')
   {
    $values['page_title'] = 'Edit Item'; //this is page heading
	$edit_id = $this->input->post('edit_id');
    $this->data['edit_id'] = $edit_id;
  }
   if($submit_value=='Submit')
   {
    $values['page_title'] = 'Add an Item'; //this is page heading
    //$this->form_validation->set_rules('media_title', '', 'trim|required|is_unique['.MEDIA_ITEMS.'.media_title]');

    
   }
   $this->form_validation->set_rules('media_title', 'Please enter topic', 'trim|required');
   $this->form_validation->set_rules('publication', 'Please enter publication', 'trim|required');
   
   $this->form_validation->set_rules('url', 'Please enter url', 'trim|required|callback__validate_url');

 
   if($this->form_validation->run()==FALSE) 
   {
	$this->add_item($values);
   }
   else
   {
    $records['media_title'] = $values['media_title'];
    $records['url'] = $values['url'];
    $records['publication'] = $values['publication'];
    $records['date_display'] = $this->commonfunctions->ChangeDateFormat($values['date_display']);

    if($submit_value=='Update')
	{
	 $this->Media_model->UpdateMedia($records,$edit_id);
	 $this->RedirectPage(admin.'/media/manage-items/','Item updated successfully');
	}
	else
	{
     //genereate media url

	 $edit_id=$this->Media_model->InsertMedia($records);
	 $this->RedirectPage(admin.'/media/manage-items','Item added successfully');
	}
   }
  }
  public function edit_item($edit_id)
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('media/add-item');	  
   $this->data['active_submodule'] = "add-item";
   $this->data['last_modified'] = $this->Login_model->LastModify(MEDIA_ITEMS,$edit_id);   

   $values = array();
   $values = $this->Media_model->GetMediaDetails($edit_id);
   $values['date_display']=$this->commonfunctions->ChangeDateFormat($values['date_display']);
   $values['page_title'] = 'Edit Item';
   $values['title'] = 'Edit Item';
   $values['submit_value'] = 'Update';
   $this->data['edit_id'] = $edit_id;
   $this->add_item($values);
  }
  public function manage_items()
  {
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs','DragDropJs');
   
   $this->data['media_list'] = array();
   $this->data['media_list'] = $this->Media_model->GetMediaList();

   if(count($this->data['media_list']) > 0)
   {
    // Arguments for GetAtributesForDeletion function : 
    // 1. item list to be deleted, 
    // 2. which type of item to be deleted, 
    // 3. single delete permission-> value would be 'yes' or 'no' and 
    // 4. parent_id if you have(optional);
    	
    $this->data['attribute'] = $this->Login_model->GetAtributesForDeletion($this->data['media_list'],'item','no');
   }
   
   
  
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/media/manage-items',$this->data);
   $this->load->view(admin.'/templates/footer');
  }  
  
  public function _validate_url($url)
  {
   if(!($this->commonfunctions->ValidateUrl($url)))
   {
	$this->form_validation->set_message('_validate_url','Please enter valid URL');
    return false;
   }
   else
   {
    return true;
   }
  }
  
  public function changestatus($record_id, $status, $section, $parent_id = '', $edit_id = '')
  {
   $section = str_replace("_","-",$section); 
   
   if($section=='manage-items')
   {
    $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('media/manage-items');
    $this->Login_model->ChangeStatus(MEDIA_ITEMS,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of item changed successfully');
   }

   if(!empty($parent_id)) $section .= '/'.$parent_id; 
   if(!empty($edit_id)) $section .= '/'.$edit_id;

   header("location:".base_url().admin."/media/$section");
   exit;
  } 
  
  
  // mandatory Function for each module
  public function ConfirmDelete($checked_id, $item_name, $parent_id = '', $edit_id = '') 
  {
   $this->adminjavascript->include_admin_js = array('ConfirmDeleteJs');
   
   if($item_name=='item') 
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('media/manage-items');	  	  
   
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
   if($item_name == "media_image_delete")
   {
	$this->data['message']="Are you sure want to delete this image.";
   }
   else
   {
    $this->data['message'] = "Are you sure you want to delete selected items";
   }
   $this->load->view(admin.'/templates/confirm-delete',$this->data);
  }
  
  //mandatory Function for each module
  public function ConfirmSuperadmin($checked_ids, $item_name, $parent_id='', $edit_id='') 
  {
   if($item_name=='item') 
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('media/manage-items');	  	  
	     
   
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
   if($item_name=='item') $this->data['message'] = "Are you sure you want to delete all selected item(s)";
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
   if($item_name=="item")
   {
    if(count($all_ids) > 0)
	{
	 $this->Media_model->DeleteMedias($all_ids, $parent_id);
	 $this->RedirectPage(admin.'/media/manage-items', 'Selected item(s) deleted successfully');
	}
   } 
  }    
  
 }

