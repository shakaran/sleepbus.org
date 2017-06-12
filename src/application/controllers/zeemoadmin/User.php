<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends MY_Controller
 {
  public $new_password;
  public $confirm_password;
  public $session_user;
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/User_model');
   $this->load->library('CommonFunctions');	
   $this->session_user=$this->session->userdata('username');
  }
  public function addlevel($values=array())
  {
   if(isset($values['form_title']) and !empty($values['form_title']))
   {
    $this->data['form_title']=$values['form_title'];
    $this->data['title'].= $values['title'];
   }
   else
   {
    $this->data['form_title']="Add";
   }
   if(count($values) == 0)
   {
	$values=array();
    $values['submit_value']="Submit";
	$values['level_name']="";
   }
   $this->load->helper('form');
   $this->data['attribute']=$this->User_model->GetLevelFormAttributes($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','AddLevelJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/user/add-level',$this->data);
   $this->load->view(admin.'/templates/footer');
   
  }
  public function validatelevel()
  {
   $values=array();	  
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('user/addlevel');
   $this->data['active_submodule']="addlevel";
   $this->load->library('form_validation'); 
   $level_id=$this->input->post('level_id');
   if(!empty($level_id))
   {
    $this->form_validation->set_rules('level_name', 'Level name', 'required|callback_check_unique_level');
    $values['form_title']="Edit";
    $values['title']="Edit Level";
    $values['submit_value']="Update";
    $this->data['level_id']=$level_id;
   }
   else
   {
    $this->form_validation->set_rules('level_name', 'Level name', 'required|is_unique['.ADMIN_LEVELS.'.name]');
    $values['submit_value']="Submit";
   }
   $this->form_validation->set_rules('checked_box', 'Checked Box', 'callback_validate_checked_box');
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $values['level_name']=$this->input->post('level_name');
   if($this->input->post('checked_box') > 0)
   {
    $checked_modules=$this->input->post('module_checkbox');
    $values['checked_modules']=$checked_modules;
	foreach($checked_modules as $module_id)
	{
	 $checked_submodules=$this->input->post('submodule_checkbox_'.$module_id);
	 $values['checked_modules']=array_merge($values['checked_modules'],$checked_submodules);
	}
   }
   if($this->form_validation->run() == FALSE)
   {  
    $this->addlevel($values);
   }
   else
   {
	if(empty($level_id))
	{
 	 $this->User_model->InsertLevel($values);
     $this->RedirectPage(admin.'/user/managelevels','New level added successfully');
	}
	else
	{
     $this->User_model->UpdateLevelRecord($level_id,$values);
     $this->RedirectPage(admin.'/user/managelevels','Level updated successfully');
	}
   }
  }
  public function validate_checked_box()
  {
   $checked_box=$this->input->post('checked_box');
   if($checked_box == 0)
   {
    $this->form_validation->set_message('validate_checked_box', 'Please check at least one module / submodule');
	return false;
   }
   else return true;
  }
  public function managelevels()
  {
   $this->load->helper('form');    
   $this->data['level_list']=$this->User_model->GetLevelList();
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   if(count($this->data['level_list']) > 0)
   {
    $this->data['attribute']=$this->Login_model->GetAtributesForDeletion($this->data['level_list'],'level','yes');
   }
   else
   {
    $this->data['attribute']=array();
   }
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/user/manage-levels',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function changestatus($record_id,$status,$section,$parent_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('user/managelevels');
   if($section == "managelevels")
   {
    $this->Login_model->ChangeStatus(ADMIN_LEVELS,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of level has been changed successfully');
   }
   if($section == "manageusers")
   {
    $this->Login_model->ChangeStatus(ADMINISTRATORS,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of user has been changed successfully');
   }
   if(!empty($parent_id))
   {
    $section.="/$parent_id";
   }
   header("location:".base_url().admin."/user/$section");
   exit;
  }
  public function ConfirmSuperadmin($checked_ids,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('user/managelevels');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_ids,$item_name,$parent_id);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */   
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message
   if($item_name == "level")
   {
    $this->data['message']="Notice: If you delete the level all user(s) under these level(s) will be deleted automatically";
   }
      
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js=array('SuperAdminValidationJs');
   $this->load->view(admin.'/templates/superadmin-delete',$this->data);
  }
  public function DeleteRecord($checked_ids,$item_name,$parent_id) // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('user/managelevels');	  	  
   $item_name=urldecode($item_name);
   $all_ids=explode("~",$checked_ids);
   // Delete Record item wise and redirect the page to repective module with success message
   if($item_name == "level")
   {
    if(count($all_ids) > 0)
	{
	 $this->User_model->DeleteRecordForLevels($all_ids);
	 if(count($all_ids) > 1)$message="Levels have been deleted successfully";
	 else $message="Level has been deleted successfully";
	 $this->RedirectPage(admin.'/user/managelevels',$message);
	}
   } 
   if($item_name == "user")
   {
    if(count($all_ids) > 0)
	{
	 $this->User_model->DeleteRecordForUsers($all_ids);
	 if(count($all_ids) > 1)$message="Users have been deleted successfully";
	 else $message="User has been deleted successfully";
	 $this->RedirectPage(admin.'/user/manageusers/'.$parent_id,$message);
	}
   }
  }
  public function editlevel($level_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('user/addlevel');	  
   $this->data['active_submodule']="addlevel";
   $this->data['last_modified']=$this->Login_model->LastModify(ADMIN_LEVELS,$level_id);   

   $values=array();
   $values=$this->User_model->GetLevelFormDetails($level_id);
   $values['form_title']="Edit";
   $values['title']="Edit Level";
   $values['submit_value']="Update";
   $this->data['level_id']=$level_id;
   $this->addlevel($values);
  }
  public function check_unique_level()
  {
   $level_name=$this->input->post('level_name');
   $level_id=$this->input->post('level_id');
   if($this->User_model->CheckUniqueLevelName($level_id,$level_name))
   {
    return true;
   }
   else
   {
    $this->form_validation->set_message('check_unique_level', 'This level name already exists');
	return false; 
   }
  }
  public function adduser($level_id='',$values=array())
  {
   if(isset($values['form_title']) and !empty($values['form_title']))
   {
    $this->data['form_title']=$values['form_title'];
    $this->data['title'].= $values['title'];
   }
   else
   {
    $this->data['form_title']="Add";
   }
   $this->data['level_id']=$level_id;
   $this->load->helper('form');
   $this->data['attribute']=$this->User_model->GetUserFormAttributes($values,$level_id);
   $this->adminjavascript->include_admin_js=array('AddUserJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/user/add-user',$this->data);
   $this->load->view(admin.'/templates/footer');
   
   
  }
  public function validateuser()
  {
   $values=array();	
   $update_records=array();  
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('user/adduser');
   $this->data['active_submodule']="adduser";
   $this->load->library('form_validation'); 
   $user_id=$this->input->post('user_id');
   if(!empty($user_id))
   {
	if($user_id != '1')
	{
     $this->form_validation->set_rules('level_id', 'level', 'required');
     $values['level_id']=$this->input->post('level_id');
	 $update_records['level_id']=$values['level_id'];
	}
	$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_unique_email');
    $values['submit_value']="Update";
	   
    $values['form_title']="Edit";
    $values['title']="Edit User";
    $values['submit_value']="Update";
    $this->data['user_id']=$user_id;
   }
   else
   {
    $this->form_validation->set_rules('level_id', 'level', 'required');
    $this->form_validation->set_rules('uname', 'username', 'required|callback_validate_username|is_unique['.ADMINISTRATORS.'.user]');
    $this->form_validation->set_rules('pword', 'password', 'required');
    $this->form_validation->set_rules('confirm_password', 'confirm password', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique['.ADMINISTRATORS.'.email]');
    $values['submit_value']="Submit";
    $values['level_id']=$this->input->post('level_id');
   }
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $values['user']=$this->input->post('uname');
   $values['email']=$this->input->post('email');
   $values['fname']=$this->input->post('fname');
   $values['lname']=$this->input->post('lname');
   $update_records['user']=$values['user'];
   $update_records['email']=$values['email'];
   $update_records['fname']=$values['fname'];
   $update_records['lname']=$values['lname'];
   
   
   $password=$this->input->post('pword');
   $confirm_password=$this->input->post('confirm_password');
   if(!empty($password))
   {
	$this->new_password=$password;
    $this->form_validation->set_rules('pword', 'password', 'callback_validate_password');
	if(!empty($confirm_password))  
	{
	 $this->confirm_password=$confirm_password;
     $this->form_validation->set_rules('confirm_password', 'confirm password', 'callback_Compare_password_comfirm_password');
	}
    $values['password']=$password;
	$update_records['password']=$values['password'];
   }
   

   if($this->form_validation->run() == FALSE)
   {  
    $this->adduser($values['level_id'],$values);
   }
   else
   {
	if(empty($user_id))
	{
 	 $insert_id=$this->User_model->InsertUser($values);
	 $values['id']=$insert_id;
	 $session_user=$this->session->userdata('username');
	 if($session_user != "zeemoadmin")
	 {
	  $this->SendEmailForAddUser($values);
	  $message="New user created and confirmation link sent to given email id. User has to click on confirmation link to activate his account.";
	 }
	 else
	 {
      $this->User_model->ActivateUser($insert_id);
	  $message="New user created";
	 }
	 $this->RedirectPage(admin.'/user/manageusers/'.$values['level_id'],$message);
	}
	else
	{
     $this->User_model->UpdateUserRecord($update_records);
	 $session_user=$this->session->userdata('username');
	 if($session_user != "zeemoadmin")
	 {
	  $this->SendEmailForUpdateUser($update_records);
	 }
	 $this->RedirectPage(admin.'/user/manageusers/'.$values['level_id'],'User account updated successfully');
	}
   }
  }
  public function validate_password()
  {
   if(!$this->commonfunctions->ValidatePassword($this->new_password))
   {
    $this->form_validation->set_message('validate_password', 'Password must be a combination of upper, lower, digit and special characters');
	return false;
   }
   else
   {
    return true;
   }
  }
  public function validate_username()
  {
   $username=$this->input->post('uname');
   if(strlen($username) > 15)
   {
    $this->form_validation->set_message('validate_username', 'Username must be of 15 characters maximum');
	return false;
   }
   else
   {
    return true;
   }
  }
  public function check_unique_email()
  {
   $email=$this->input->post('email');
   $user_id=$this->input->post('user_id');
   if($this->User_model->CheckUniqueEmail($email,$user_id))
   {
    $this->form_validation->set_message('check_unique_email', 'Email address must be unique');
	return false;
   }
   else
   {
    return true;
   }
  }
  
  public function Compare_password_comfirm_password()
  {
   if(!empty($this->new_password) and !empty($this->confirm_password) and ($this->new_password != $this->confirm_password))
   {
    $this->form_validation->set_message('Compare_password_comfirm_password', 'Password and confirm password did not matched');
	return false;
   }
   else
   {
    return true;
   }
  } 
  public function manageusers($level_id='')
  {
   $this->load->helper('form');    
   $this->data['user_list']=$this->User_model->GetUserList($level_id);
   $this->data['admin_details']=$this->Login_model->GetAdminDetails('zeemoadmin');
   $this->data['attribute']=$this->User_model->GetManageUserFormAttributes();
   $this->data['level_id']=$level_id;
   $this->data['user_id']=$this->session->userdata('user_id');
   // Arguments for GetAtributesForDeletion function : 1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 4. parent_id if you have(optional);
   if(count($this->data['user_list']) > 0)
   {
    $this->data['deletion_attributes']=$this->Login_model->GetAtributesForDeletion($this->data['user_list'],'user','yes',$level_id);
   }
   else
   {
    $this->data['deletion_attributes']=array();
   }
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/user/manage-users',$this->data);
   $this->load->view(admin.'/templates/footer');
    
  }
  public function edituser($user_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('user/adduser');	  
   $this->data['active_submodule']="adduser";
   $this->data['last_modified']=$this->Login_model->LastModify(ADMINISTRATORS,$user_id);    
   $values=array();
   $values=$this->User_model->GetUserFormDetails($user_id);
   $values['form_title']="Edit";
   $values['title']="Edit User";
   $values['submit_value']="Update";
   $this->data['user_id']=$user_id;
   $this->adduser('',$values);
  }
  public function SendEmailForAddUser($values)
  {
   $link_url = base_url().admin."/userverification/validate/".$values['id']."/".md5($values['password']);
   $to = $values['email'];
   $admin=array();
   $admin=$this->Login_model->GetAdminDetails();
   $from = $admin['email'];
   $subject = NEW_ACCOUNT_USER_SUBJECT;
   $to_msg= "Hi ".ucfirst(strtolower(trim($values['user']))).",";
  
   $body_msg="";
   $body_msg.="<br><br>Website admin has created an account for you with the following details:<br>";
   $body_msg.="Username: ".$values['user']."<br>Password: ".$values['password']."<br><br>";
   $body_msg.="Please click on the following confirmation link to activate your account with the provided credentials<br><a href='".$link_url."'>$link_url</a><br><br>";
   $from_msg = 'Best Regards,<br /><strong style="font-size:14px;">Zeemo</strong>';
  
   $mailMsg3=file_get_contents(base_url()."email-templates/email.html");
   $mailMsg2=str_replace("[[[TO]]]",$to_msg,$mailMsg3);
   $mailMsg1=str_replace("[[[BODY]]]",$body_msg,$mailMsg2);
   $mailMsg0=str_replace("[[[FROM]]]",$from_msg,$mailMsg1);
   $mailMsg=str_replace("[[[ZEEMO_CONTACT_NO]]]",ZEEMO_CONTACT_NO,$mailMsg0);
   


   $this->load->library('email');
   $this->email->from($from, 'Admin');
   $this->email->to($to); 
   $this->email->subject($subject);
   $this->email->set_mailtype('html');
   $this->email->message($mailMsg);	
   $this->email->send();   
   $this->email->clear();
   //EMAIL TO ADMIN
   $global_admin=$this->Login_model->GetAdminDetails('zeemoadmin');
   $from = $global_admin['email'];
   $to = $admin['email'];
   $subject = NEW_ACCOUNT_ADMIN_SUBJECT;
   $to_msg= "Hi Admin,";
   
   $body_msg="";
   $body_msg.="<br><br>You have created a new user account with the following details:<br>";
   $body_msg.="Username: ".$values['user']."<br>Password: ".$values['password']."<br>Email ID: ".$values['email']."<br><br>";
   $from_msg = 'Best Regards,<br /><strong style="font-size:14px;">Zeemo</strong>';
   
   $mailMsg3=file_get_contents(base_url()."email-templates/email.html");
   $mailMsg2=str_replace("[[[TO]]]",$to_msg,$mailMsg3);
   $mailMsg1=str_replace("[[[BODY]]]",$body_msg,$mailMsg2);
   $mailMsg0=str_replace("[[[FROM]]]",$from_msg,$mailMsg1);
   $mailMsg=str_replace("[[[ZEEMO_CONTACT_NO]]]",ZEEMO_CONTACT_NO,$mailMsg0);
   
   $this->email->from($from, 'Zeemo');
   $this->email->to($to); 
   $this->email->subject($subject);
   $this->email->set_mailtype('html');
   $this->email->message($mailMsg);	
   $this->email->send();   
   $this->email->clear();
  }
  public function SendEmailForUpdateUser($values)
  {
   $to = $values['email'];
   $admin=array();

   if($values['user']=="admin")
   {
    $admin=$this->Login_model->GetAdminDetails('zeemoadmin');
	$from=$admin['email'];
    $from_name="Zeemo";
   }
   else
   {
    $admin=$this->Login_model->GetAdminDetails();
    $from=$admin['email'];
    $from_name="Admin";
   }

   $subject = EDIT_ACCOUNT_USER_SUBJECT;
   $to_msg= "Hi ".ucfirst(strtolower($values['user'])).",";
  
   $body_msg="";
   $body_msg="<br><br>Your account details has been updated as follows:<br>";
   if(isset($values['password'])) $body_msg.= "<br>Password: ".$values['password'];
   $body_msg.="<br>Email: ".$values['email'];
   if(!empty($values['fname']) or !empty($values['lname']))
   {
    $body_msg.="<br>Name: ".ucfirst($values['fname'])." ".$values['lname'];
   }
   $from_msg = '<br><br>Best Regards,<br /><strong style="font-size:14px;">'.$from_name.'</strong>';
  
   $mailMsg3=file_get_contents(base_url()."email-templates/email.html");
   $mailMsg2=str_replace("[[[TO]]]",$to_msg,$mailMsg3);
   $mailMsg1=str_replace("[[[BODY]]]",$body_msg,$mailMsg2);
   $mailMsg0=str_replace("[[[FROM]]]",$from_msg,$mailMsg1);
   $mailMsg=str_replace("[[[ZEEMO_CONTACT_NO]]]",ZEEMO_CONTACT_NO,$mailMsg0);

   $this->load->library('email');
   $this->email->from($from, $from_name);
   $this->email->to($to); 
   $this->email->subject($subject);
   $this->email->set_mailtype('html');
   $this->email->message($mailMsg);	
   $this->email->send();   
   $this->email->clear();
 
 
  
   //EMAIL TO SERVICE PROVIDER IN CASE OF "admin"
   //OR  EMAIL TO "admin" IN CASE OF SUBADMIN
   if($values['user']=="admin") 
   {
    $from = $values['email'];
    $to = $admin['email'];
    $from_name="Admin";
    $subject = EDIT_ACCOUNT_SERVICE_PROVIDER_SUBJECT;      
   } 
   else
   {
	$global_admin=array();
	$global_admin=$this->Login_model->GetAdminDetails('zeemoadmin');
    $to = $admin['email'];
    $from = $global_admin['email'];
    $subject = EDIT_ACCOUNT_ADMIN_SUBJECT; 
    $from_name="Zeemo";  
   }
   $to_msg= "Hi Admin, ";
  
   $body_msg="";
   $body_msg="<br><br>Account details of <b>".$values['user']."</b> has been updated as follows:<br><br>";
   if($values['password']) $body_msg.= "<br>Password: ".$values['password'];
   $body_msg.="<br>Email: ".$values['email']."<br>Name: ".ucfirst($values['fname'])." ".$values['lname']."<br><br><br>";
  
   $from_msg = 'Best Regards,<br /><strong style="font-size:14px;">'.$from_name.'</strong>';
  
   $mailMsg3=file_get_contents(base_url()."email-templates/email.html");
   $mailMsg2=str_replace("[[[TO]]]",$to_msg,$mailMsg3);
   $mailMsg1=str_replace("[[[BODY]]]",$body_msg,$mailMsg2);
   $mailMsg0=str_replace("[[[FROM]]]",$from_msg,$mailMsg1);
   $mailMsg=str_replace("[[[ZEEMO_CONTACT_NO]]]",ZEEMO_CONTACT_NO,$mailMsg0);

   $this->email->from($from, $from_name);
   $this->email->to($to); 
   $this->email->subject($subject);
   $this->email->set_mailtype('html');
   $this->email->message($mailMsg);	
   $this->email->send();   
   $this->email->clear();
  }
  public function superadmin()
  {
   $this->data['attribute']=$this->User_model->GetSuperadminFormAttributes();
   $this->adminjavascript->include_admin_js=array('ValidateSuperAdminFormJs','SuccessMessageJs');
   if($this->session_user == "zeemoadmin") $sup_id=2; else $sup_id=1;
   $this->data['last_modified']=$this->Login_model->LastModify(SUPERADMIN_PASSWORD,$sup_id);    
   $this->load->helper('form');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/user/superadmin-section',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validatesuperadmin()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('user/superadmin');
   $this->data['active_submodule']='superadmin';
   	  
   $this->load->library('form_validation'); 
   $this->form_validation->set_rules('old_password', 'old password', 'required|callback_validate_old_password');
   $this->form_validation->set_rules('new_password', 'new password', 'required|callback_validate_password');
   $this->form_validation->set_rules('confirm_password', 'confirm password', 'required|callback_Compare_password_comfirm_password');
   $this->new_password=$this->input->post('new_password');
   $this->confirm_password=$this->input->post('confirm_password');
   $this->form_validation->set_error_delimiters('<span>','</span>');
   if($this->form_validation->run() == FALSE)
   {
    $this->superadmin();
   }
   else
   {
    $this->User_model->ChangeSuperadminPassword($this->new_password);
	$this->RedirectPage(admin.'/user/superadmin','Superadmin password has been changed successfully');
   }
  }
  public function validate_old_password()
  {
   $old_password=$this->input->post('old_password');
   if(!($this->User_model->ValidateOldPassword($old_password)))
   {
	$this->form_validation->set_message('validate_old_password', 'Old password did not match');
    return false;
   }
   else
   {
    return true;
   }
  }
  function ConfirmForNewSuperadminPassword()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('user/superadmin');	  
   $this->data['attributes']=$this->User_model->GetAskAboutNewSuperadminPasswordFormAttributes();
   $this->adminjavascript->include_admin_js=array('ValidateSuperAdminFormJs');
   $this->load->helper('form');
   $this->load->view(admin.'/user/ask-about-new-superadmin-password',$this->data);
  }
  function GenerateSuperadminPassword()
  {
   $new_password=$this->commonfunctions->GeneratePassword();
   $this->User_model->ChangeSuperadminPassword($new_password);
   $this->SendSuperAdminPassword($new_password);
   $this->RedirectPage(admin.'/user/superadmin','Superadmin new password generated and sent to your email address.');
  }
  function SendSuperAdminPassword($new_password)
  {
	  
   $from = SERVICE_PROVIDER_EMAIL_ADDRESS;
   $admin=$this->Login_model->GetAdminDetails($this->session_user);
   $to=array();
   $to[] = $admin['email'];
   if(($this->session_user != "admin") and ($this->session_user != "zeemoadmin"))
   {
    $mainadmin=$this->Login_model->GetAdminDetails('admin');
	if(count($mainadmin) > 0)
	{
     $to[] = $mainadmin['email'];
	}
   }
   
 
   $subject = CHANGE_SUPERADMIN_PASSWORD_SUBJECT;
   $to_msg= "Hi ".$this->session_user.",";
   $body_msg = ""; 
   $body_msg.="<br><br>Superadmin New Password is:&nbsp;&nbsp;$new_password <br><br>";
   $from_msg = 'Best Regards,<br /><strong style="font-size:14px;">Zeemo</strong>';
   $mailMsg3=file_get_contents(base_url()."email-templates/email.html");
   $mailMsg2=str_replace("[[[TO]]]",$to_msg,$mailMsg3);
   $mailMsg1=str_replace("[[[BODY]]]",$body_msg,$mailMsg2);
   $mailMsg0=str_replace("[[[FROM]]]",$from_msg,$mailMsg1);
   $mailMsg=str_replace("[[[ZEEMO_CONTACT_NO]]]",ZEEMO_CONTACT_NO,$mailMsg0);

   $this->load->library('email');
   $this->email->from($from, 'Zeemo');
   $this->email->to($to); 
   $this->email->subject($subject);
   $this->email->set_mailtype('html');
   $this->email->message($mailMsg);	
   $this->email->send();   
   $this->email->clear();
  }
  public function updateaccount($values=array())
  {
   $user_id=$this->session->userdata('user_id');
   $this->data['last_modified']=$this->Login_model->LastModify(ADMINISTRATORS,$user_id); 
   if(count($values) == 0)
   {   
    $values=array();
    $values=$this->User_model->GetUserFormDetails($user_id);
   }
   $this->data['form_title']="Edit Account";
   $values['title']="Edit Account";
   $values['submit_value']="Update";
   $this->data['user_id']=$user_id;
   $this->data['level_id']=$this->session->userdata('level_id');
   $values['level_id']=$this->data['level_id'];
   $this->load->helper('form');
   $this->data['attribute']=$this->User_model->GetUserFormAttributes($values,$this->data['level_id'],"validateaccountinfo");
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','AddUserJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/user/add-user',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validateaccountinfo()
  {
   $values=array();	
   $update_records=array();  
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('user/updateaccount');
   $this->data['active_submodule']="updateaccount";
   $this->load->library('form_validation'); 
   $user_id=$this->input->post('user_id');
   if(!empty($user_id))
   {
	$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_unique_email');
    $values['submit_value']="Update";
	   
    $values['form_title']="Edit";
    $values['title']="Edit User";
    $values['submit_value']="Update";
    $this->data['user_id']=$user_id;
   }
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $values['user']=$this->input->post('uname');
   $values['email']=$this->input->post('email');
   $values['fname']=$this->input->post('fname');
   $values['lname']=$this->input->post('lname');
   $update_records['user']=$values['user'];
   $update_records['email']=$values['email'];
   $update_records['fname']=$values['fname'];
   $update_records['lname']=$values['lname'];
   
   
   $password=$this->input->post('pword');
   $confirm_password=$this->input->post('confirm_password');
   if(!empty($password))
   {
	$this->new_password=$password;
    $this->form_validation->set_rules('pword', 'password', 'callback_validate_password');
	if(!empty($confirm_password))  
	{
	 $this->confirm_password=$confirm_password;
     $this->form_validation->set_rules('confirm_password', 'confirm password', 'callback_Compare_password_comfirm_password');
	}
    $values['password']=$password;
	$update_records['password']=$values['password'];
   }
   

   if($this->form_validation->run() == FALSE)
   {  
    $this->updateaccount($values);
   }
   else
   {
    $this->User_model->UpdateUserRecord($update_records);
    $session_user=$this->session->userdata('username');
	if($session_user != "zeemoadmin")
	{
	 $this->SendEmailForUpdateUser($update_records);
	}
	$this->RedirectPage(admin.'/user/updateaccount','User account updated successfully');
   }
  }
 }
