<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
 class Support extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Support_model');
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
    $this->Login_model->UpdateTopText($records,3);
	$this->RedirectPage(admin.'/support/toptext','Top text has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(3);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,2);
   $this->data['attributes']=$this->Support_model->GetTopTextFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/support/top-text',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function support_text()
  {
   $submit_value=$this->input->post('submit_form');
   $values=array();
   if(!empty($submit_value))
   {
	$records['content']=$this->input->post('content');
    $this->Login_model->UpdateTopText($records,4);
	$this->RedirectPage(admin.'/support/support-text','Our support text has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(4);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,2);
   $this->data['attributes']=$this->Support_model->GetTopTextFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/support/support-text',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function add_item($values=array())
  {
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs','ValidateSupportFormJs');
   // $this->admincss->including_css_func = array('CalendarCss'); 
   if(count($values) > 0)
   {
    $this->data['title'] .= $values['title']; //this is meta title
	$this->data['page_title'] = $values['page_title']; //this is page heading
   }
   else
   {
    $values['support_title'] = '';
   $values['intro_text']="";	
	
	$this->data['page_title'] = 'Add an Item';
	$this->data['file_error'] = '';
   }
   if(!empty($this->data['edit_id'])) $this->data['attributes'] = $this->Support_model->GetSupportFormAttribute($values,$this->data['edit_id']);
   else $this->data['attributes'] = $this->Support_model->GetSupportFormAttribute($values);
   $this->SetUpCkeditor(); 
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/support/add-support',$this->data);
   $this->load->view(admin.'/templates/footer');
  }  
  
  public function validate_support()
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('support/add-item');
   $this->data['active_submodule'] = 'add-item';

   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','{field}');
   $this->form_validation->set_message('is_unique','Item title already exists');

   $values = array();
   $file_uploaded = FALSE;

   $submit_value = $this->input->post('submit_value');   
   $values['title'] = 'Validate Item';   
   $values['support_title'] = $this->input->post('support_title');
   $values['intro_text'] = $this->input->post('intro_text');

   if($submit_value=='Update')
   {
    $values['page_title'] = 'Edit Item'; //this is page heading
	$edit_id = $this->input->post('edit_id');
    $this->data['edit_id'] = $edit_id;
    
	$this->form_validation->set_rules('support_title', 'Please enter title', 
	'trim|required|callback_is_unique_with_condition['.SUPPORTS.'~support_title~id !='.$edit_id.'~support]');
   }
   if($submit_value=='Submit')
   {
    $values['page_title'] = 'Add an Item'; //this is page heading
    //$this->form_validation->set_rules('support_title', '', 'trim|required|is_unique['.SUPPORTS.'.support_title]');

	$this->form_validation->set_rules('support_title', 'Please enter title', 
	'trim|required|is_unique['.SUPPORTS.'.support_title]');
    
   }
   $this->form_validation->set_rules('intro_text', 'Please enter introduction text', 'trim|required');

 
   if($this->form_validation->run()==FALSE) 
   {
	$this->add_item($values);
   }
   else
   {
    $records['support_title'] = $values['support_title'];
    $records['intro_text'] = $values['intro_text'];

    if($submit_value=='Update')
	{
	 $this->Support_model->UpdateSupport($records,$edit_id);
	 $this->RedirectPage(admin.'/support/manage-items/','Item updated successfully');
	}
	else
	{
     //genereate support url

	 $edit_id=$this->Support_model->InsertSupport($records);
	 $this->RedirectPage(admin.'/support/manage-items','Item added successfully');
	}
   }
  }
  public function edit_support($edit_id)
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('support/add-item');	  
   $this->data['active_submodule'] = "add-item";
   $this->data['last_modified'] = $this->Login_model->LastModify(SUPPORTS,$edit_id);   

   $values = array();
   $values = $this->Support_model->GetSupportDetails($edit_id);
   $values['page_title'] = 'Edit Item';
   $values['title'] = 'Edit Item';
   $values['submit_value'] = 'Update';
   $this->data['edit_id'] = $edit_id;
   $this->add_item($values);
  }
  public function manage_items()
  {
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs','DragDropJs');
   
   $this->data['support_list'] = array();
   $this->data['support_list'] = $this->Support_model->GetSupportList();

   if(count($this->data['support_list']) > 0)
   {
    // Arguments for GetAtributesForDeletion function : 
    // 1. item list to be deleted, 
    // 2. which type of item to be deleted, 
    // 3. single delete permission-> value would be 'yes' or 'no' and 
    // 4. parent_id if you have(optional);
    	
    $this->data['attribute'] = $this->Login_model->GetAtributesForDeletion($this->data['support_list'],'item','no');
   }
   
   
  
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/support/manage-supports',$this->data);
   $this->load->view(admin.'/templates/footer');
  }  
  
  
  public function changestatus($record_id, $status, $section, $parent_id = '', $edit_id = '')
  {
   $section = str_replace("_","-",$section); 
   
   if($section=='manage-items')
   {
    $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('support/manage-items');
    $this->Login_model->ChangeStatus(SUPPORTS,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of support changed successfully');
   }

   if(!empty($parent_id)) $section .= '/'.$parent_id; 
   if(!empty($edit_id)) $section .= '/'.$edit_id;

   header("location:".base_url().admin."/support/$section");
   exit;
  } 
  
  
  // mandatory Function for each module
  public function ConfirmDelete($checked_id, $item_name, $parent_id = '', $edit_id = '') 
  {
   $this->adminjavascript->include_admin_js = array('ConfirmDeleteJs');
   
   if($item_name=='item') 
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('support/manage-items');	  	  
   
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
   if($item_name == "support_image_delete")
   {
	$this->data['message']="Are you sure want to delete this image.";
   }
   elseif($item_name == "remove_clone")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('support/manage-support');	  	  
	$this->data['message']="Are you sure want to unlink this support from selected support.";
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
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('support/manage-items');	  	  
   else if($item_name=='image') $this->data['sub_modules']=$this->CheckSubModuleAccessibility('support/manage-images');	  	     
   
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
	 $this->Support_model->DeleteSupports($all_ids, $parent_id);
	 $this->RedirectPage(admin.'/support/manage-items', 'Selected support item(s) deleted successfully');
	}
   } 
  }    
  
 }

