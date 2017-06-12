<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Account extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Account_model');
   $this->load->helper('form');
   $this->load->library('CommonFunctions');	
  }
  public function pageheadings($page_id='',$values=array())
  {
   $this->data['parent_id']=array('1','3','5');	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   if(count($values) == 0)
   {
    if(!empty($page_id))
	{
	 $values=$this->Account_model->GetPageHeading($page_id);
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
   $this->data['attributes']=$this->Account_model->GetPageHeadingFormAttribute($values,$this->data['parent_id'],$page_id);
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/account/page-heading',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validateheadings()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('account/pageheadings');
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
    $this->Account_model->UpdatePageHeadings($page_id,$records);
	$this->RedirectPage(admin.'/account/pageheadings/'.$page_id,'Page heading updated successfully');
   }
  }
  
 
  public function account_type($values=array())
  {
   //for ckeditor   
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs','ValidateAccountJs');
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
   }
   else
   {
    $values['type_name']="";
	$this->data['page_title']="Add Account Type";
   }
   if(!empty($this->data['id']))
   {
    $this->data['attributes']=$this->Account_model->GetAccountTypeFormAttribute($values,$this->data['id']);
   }
   else
   {
    $this->data['attributes']=$this->Account_model->GetAccountTypeFormAttribute($values);
   }
   $this->data['type_list']=$this->Account_model->GetAllCategories();
   if(count($this->data['type_list']) > 0)
   {
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   $this->data['attribute']=$this->Login_model->GetAtributesForDeletion($this->data['type_list'],'type','no');
   }
   
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/account/account-type',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validate_type()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('account/account-type');
   $this->data['active_submodule']="account-type";
   $values=array();
   $values['title']="Validate Account Type";
   $id=$this->input->post('id');
   
   $values['type_name']=$this->input->post('type_name');
   $this->load->library('form_validation'); 
   $this->form_validation->set_message('required','Please enter {field}');
   $this->form_validation->set_error_delimiters('<span>','</span>');
   if(!empty($id))
   {
    $values['page_title']="Edit Account Type";
    $this->data['id']=$id;
    $this->form_validation->set_rules('type_name', 'type name', 'trim|required|callback_is_unique_on_update['.ACCOUNT_TYPE.'~type_name~'.$id.'~type name]');
   }
   else
   {
    $values['page_title']="Add Category";
    $this->form_validation->set_rules('type_name', 'type name', 'trim|required|is_unique['.ACCOUNT_TYPE.'.type_name]');
   }
   
   if($this->form_validation->run() == FALSE)
   { 
    $this->account_type($values);
   }
   else
   {
	$records['type_name']=$values['type_name'];

    if(!empty($id))
	{
	 $this->Account_model->UpdateAccountType($records,$id);
	 $this->RedirectPage(admin.'/account/account-type','Account type has been updated successfully');
	}
	else
	{
	 $this->Account_model->InsertAccountType($records);
	 $this->RedirectPage(admin.'/account/account-type','Account type has been added successfully');
	}
   }
  }
  public function edit_type($id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('account/account-type');	  
   $this->data['active_submodule']="account-type";
   $this->data['last_modified']=$this->Login_model->LastModify(ACCOUNT_TYPE,$id);   

   $values=array();
   $values=$this->Account_model->GetAccountTypeDetails($id);
   $values['page_title']="Edit Account Type";
   $values['title']="Edit Account Type";
   $values['submit_value']="Update";
   $this->data['id']=$id;
   $this->account_type($values);
  }  
  public function manageusers($level_id='')
  {
   $this->load->helper('form');    
   $this->data['user_list']=$this->Account_model->GetUserList();
   
   if(count($this->data['user_list']) > 0)
   {
    $this->data['deletion_attributes']=$this->Login_model->GetAtributesForDeletion($this->data['user_list'],'user','yes');
   }
   else
   {
    $this->data['deletion_attributes']=array();
   }   
   
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/account/manage-users',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function view_details($user_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('account/manageusers');	
   $this->data['active_submodule'] = "manageusers";
   $this->data['user_details']=array();
   $this->data['all_campaigns']=array();
   $this->data['user_campaign_donations']=array();
   $this->data['user_one_time_donations']=array();
   $this->data['user_monthly_donations']=array();
     	  
   $this->data['user_id']=$user_id;
   $this->data['user_details']=$this->Account_model->GetUserDetails($this->data['user_id']);
   $this->data['all_campaigns']=$this->Account_model->GetUserCampaigns($this->data['user_id']);
   $this->data['user_campaign_donations']=$this->Account_model->GetUserCampaignDonations($this->data['user_id']);
   $this->data['user_one_time_donations']=$this->Account_model->GetUserOneTimeDonations($this->data['user_id']);
   $this->data['user_monthly_donations']=$this->Account_model->GetUserMonthlyDonations($this->data['user_id']);

   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/account/user-details',$this->data);
   $this->load->view(admin.'/templates/footer');
   
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
   if($item_name == "account_type")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('account/account-type');	  	  
    $this->data['message']="Are you sure you want to delete this category.";
   }
   else if($item_name == "item")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('account/manage-items');	  	  
    $this->data['message']="Are you sure you want to delete all selected items.";
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
   if($item_name == "account_type")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('account/account-type');	  	  
	$this->data['message']="Are you sure you want to delete this account type.";
   }
   if($item_name == "item")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('account/manage-items');	  	  
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
   if($item_name == "account_type")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('account/account-type');	  	  
    if(count($all_ids) > 0)
	{
	 $this->Account_model->DeleteRecordForAccountType($all_ids);
	 $this->RedirectPage(admin.'/account/account-type','Account type has been deleted successfully');
	}
   } 
   if($item_name == "item")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('account/manage-items');	  	  
    if(count($all_ids) > 0)
	{
	 $this->Account_model->DeleteRecordForItems($all_ids,$parent_id);
	 $this->RedirectPage(admin.'/account/manage-items/'.$parent_id,'Item(s) deleted successfully');
	}
   } 
  }
  public function changestatus($record_id,$status,$section,$parent_id="")
  {
   $section=str_replace("_","-",$section);
   if($section == "account-type")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('account/account-type');
    $this->Login_model->ChangeStatus(ACCOUNT_TYPE,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of category has been changed successfully'); 
   }
   if($section == "manage-items")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('account/manage-items');
    $this->Login_model->ChangeStatus(THINGS_TO_DO_ITEMS,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of item has been changed successfully'); 
   }
   if($section == "manageusers")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('account/manageusers');
    $this->Login_model->ChangeStatus(USERS,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of user has been changed successfully'); 
   }
   
   if(!empty($parent_id))
   {
    $section.="/$parent_id";
   }
   header("location:".base_url().admin."/account/$section");
   exit;
  } 
 }
