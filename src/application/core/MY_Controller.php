<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public $db_query;
	public $data_link;
	public $path;
	public $admin_id;
	public $data;
  public $title;
	public $General_model;
	public $emailConfig;

	public function __construct() {
	  parent::__construct();	
	  
	  $data = array();
	  $title = array();
    $this->load->Model('commonModel/Global_model');
	  $this->data_link = $this->Global_model->db_link;

	  $this->CommonSettings();
    $segment=$this->uri->segment(1);	

    $this->emailConfig['protocol'] = getenv('PROTOCOL');
    $this->emailConfig['smtp_host'] = getenv('SMTP_HOST');
    $this->emailConfig['smtp_port'] = getenv('SMTP_PORT');
    $this->emailConfig['smtp_user'] = getenv('SMTP_USER');
    $this->emailConfig['smtp_pass'] = getenv('SMTP_PASS');
    $this->emailConfig['mailtype'] = 'html';
    $this->emailConfig['starttls'] = true;
    $this->emailConfig['newline'] = "\r\n";
	  	
	  if($segment == admin)
	  {
	   $this->admin_id=$this->session->userdata('username');	
	   $this->AdminSetting();
	   if($this->uri->segment(2) != "logout" and $this->uri->segment(2) != "login" and $this->uri->segment(2) !="userverification" and $this->uri->segment(2) != "forgotpassword" and $this->uri->segment(2) != "passwordrecovery")
		 {
		  $this->AdminSessionCheck();
   	      $this->data['modules']=$this->Login_model->ModuleListToAccess();
		  $this->data['active_module']=$this->uri->segment(2);
  	      $this->data['active_submodule']=$this->uri->segment(3);
		  $this->data['right_logo']=$this->Login_model->GetImageBrochureDetails(1,CMS_SETTINGS);
		  if($this->uri->segment(2) != "home")
		  {
		   $this->data['sub_modules']=$this->CheckSubModuleAccessibility();
		   $this->data['module_details']=$this->Login_model->GetModuleDetails();
		   $this->data['submodule_details']=$this->Login_model->GetModuleDetails($this->data['active_module']."/".$this->data['active_submodule']);
		   $this->title=$this->Login_model->GetTitleOfPage();
   		   $this->data['title']=$this->title['module']." - ".$this->title['submodule'];
		 
		   /*******************
		   * Assigning category depth for product catelogue module, 
		   * assign 0 for infinite depth, 
		   * assign 1 for max depth=0, 
		   * assign 2 for max_depth=1 and so on ...
		   *******************/
   		   $this->data['category_level']=0;
		   
		   /************************
		   // Assigning all the table name for checking unique urls through out the site i.e globally 
		   // STATIC_PAGE_URLS are by default included, no need to assign here it to global_access_table_list array
		   ************************/
  		   $this->Login_model->global_access_table_list=array(CATEGORIES,CATEGORY_TO_PRODUCTS,LANDINGPAGE,STATIC_PAGE_URLS,ABOUT_SECTION);

 		   /********************* 
		   * Assigning all the table name for checking unique urls in same table i.e locally
		   * This is optional assignment you may leave it empty
		   *********************/
		   // $this->Login_model->local_access_table_list=array(PROJECTS,PROJECT_CATEGORIES);
		  }
		 }
		}
		else // front end settings
		{
         $this->load->library('CommonFunctions');	   
	     $this->data['active_menu']=$segment;
     	 $this->load->library('WebsiteCss');
         $this->load->library('WebsiteJavascript');
 	     $this->load->Model('Website_model');
		 $this->data['ip_address']=$this->GetIPAddress();		 
		 $this->data['ip_country']=$this->GetIpLocation();		 
		/* $this->data['ip_location']=$this->GetIpLocation();		 */

		 $this->load->Model(admin.'/Metatags_model');
		 $this->data['common_settings']=$this->Website_model->GetCommonSettingValues();
		 $this->data['contact_info']=$this->Website_model->GetContactPageContent();
		 // Required for Search Form exists in all pages
		 // Required for google analytics and cannonical link
         $this->data['zeemosettings']=$this->Website_model->GetZeemoSettingsContent(); 		 		 
		 
		 $this->load->helper('form');
		 $this->data['footer_text']=$this->Website_model->GetTopText(1);
   	     $this->load->model('Account_model'); 
    	 $this->user_info=$this->Account_model->CheckUser($this->session->userdata('site_username'),$this->session->userdata('site_password'));
		 
         if($this->uri->segment(1) == "user")
		 {
		  $this->UserSessionCheck();
		 }	
		 // Payment Settings
		 $this->data['price_type']="AUD";	 

	     $this->data['merchantEmail'] = getenv('PP_MERCHANT_EMAIL');
         $this->data['paypal_url'] = getenv('PP_FORM_URL');

	    }
	}
	public function AdminSetting()
	{
     $this->load->library('AdminCss');
     $this->load->library('AdminJavascript');
 	 $this->load->Model(admin.'/Login_model');
	}
	public function CommonSettings()
	{
	 date_default_timezone_set('Australia/ACT');

     // CI upgrade requires the param to be an array
     $this->load->library('General_Query_Functions', [$this->data_link], 'db_query');
	}
    public function RedirectPage($file_url,$message="")
    {
     $this->session->set_flashdata('success_message',$message);
     header("location:".base_url().$file_url);
     exit;
    }
    public function RedirectPopupPage($file_url,$message="")
    {
     $this->data['redirect_url']=$file_url;
     $this->session->set_flashdata('success_message',$message);
     $this->load->view(admin.'/templates/redirection',$this->data);
    }
    public function UserSessionCheck()
    {
     $username=isset($_POST['site_username'])?$_POST['site_username']:$this->session->userdata('site_username');
     $password=isset($_POST['site_password'])?$_POST['site_password']:$this->session->userdata('site_password'); 
     if(!empty($username) and !empty($password))
     {
	  $this->data['user_info']=array();
	  $this->data['user_info']=$this->Account_model->CheckUser($username,$password);
	  
	  if(count($this->data['user_info']) > 0)
	  {
	   $this->session->set_userdata('site_username',$username);
	   $this->session->set_userdata('site_password',$password);
	  }
	  else
	  {
       $this->RedirectPage('logout'); 
	  }
     }
     else
     {
      $this->RedirectPage('signin'); 
     }
    }	
	public function AdminSessionCheck()
	{
	 $session_time=$this->session->userdata('login_time') + 900;	
	 $current_time=time();
	 if($session_time < $current_time){$this->RedirectPage(admin.'/logout','');exit;}	
		
	 $username=isset($_REQUEST['username'])?$_REQUEST['username']:$this->session->userdata('username');
	 $password=isset($_REQUEST['password'])?$_REQUEST['password']:$this->session->userdata('password'); 
	 if(!empty($username) and !empty($password))
	 {
	  $user_info=array();
	  $user_info=$this->Login_model->CheckUser($username,$password);

	  if(count($user_info) > 0)
	  {
	   $this->session->set_userdata('username',$username);
	   $this->session->set_userdata('password',$password);
	   $this->session->set_userdata('level_id',$user_info['level_id']);
	   $this->session->set_userdata('user_id',$user_info['id']);
	   $this->session->set_userdata('login_time',time());
	   $_SESSION['IS_AUTH']=true;	  }
	  else
	  {
       $_SESSION['IS_AUTH']=false;
       $this->RedirectPage(admin.'/logout','user has been logged out successfully'); 
	  }
	 }
	 else
	 {
      $this->RedirectPage(admin.'/login'); 
	 }
	}
	public function CheckSubModuleAccessibility($name='')
	{
	 $access=false;
	 $module=$this->uri->segment(2);
	 $level_id=$this->session->userdata('level_id');
	 if($level_id == 1)
	 {
	  $access=true;
	 }
	 else
	 {
	  if(empty($name))
	  {
	   $module_id=$this->Login_model->GetModuleId($module);
	   if($this->Login_model->CheckModuleAccessibilty($module_id))
	   {
		$access=true;
		$sub_module=$this->uri->segment(3);
		if(!empty($sub_module))
		{
	     $all_submodule_urls=$this->Login_model->GetSubmoduleUrls($module_id);
		 if(in_array($module."/".$sub_module,$all_submodule_urls))
		 {
		  $sub_module_id=$this->Login_model->GetModuleId($module."/".$sub_module);
		  if($this->Login_model->CheckModuleAccessibilty($sub_module_id))
		  {
		   $access=true;
		  }
		  else
		  {
		   $access=false; 
		  }
		 }
		 else
		 {
		  $access=true; // if some function of controller is not defined as sub module like edit,delete etc.
		 }
		}
	   }
	   else
	   {
		$access=false;
	   }
	  }
	  else
	  {
	  // call this function manually by passing argument from controller funcion for edit, delete, changeStatus
	   $sub_module_id=$this->Login_model->GetModuleId($name);
	   if($this->Login_model->CheckModuleAccessibilty($sub_module_id))
	   {
	    $access=true;
	   }
	   else
	   {
	    $access=false; 
	   }
	  }
	 }
	 if($access == true)
	 {
	  return $this->Login_model->GetSubmoduleList($this->Login_model->GetModuleId($module));
	 }
	 else
	 {
	  $this->RedirectPage(admin.'/home','Sorry, You have no permission to visit this page'); 
	 }
	}
	public function image_validation($name,$uploaded_file_info)
	{
     list($file_name,$path_to_upload,$image_index,$max_width,$max_height,$fixed_width,$fixed_height,$max_size)=explode("~",$uploaded_file_info);
	 $config['upload_path'] = $path_to_upload;
	 $config['allowed_types'] = 'gif|jpg|png|jpeg';
	 $config['remove_spaces']=true;
	 if(!empty($max_size)) $config['max_size']	= $max_size;
	 if(!empty($max_width)) $config['max_width']=$max_width;
	 if(!empty($max_height)) $config['max_height']=$max_height;
	 
     $this->load->library('upload');
	 $this->upload->initialize($config);
     if(empty($_FILES[$file_name]['name']))
	 {
      $this->form_validation->set_message('image_validation','Please select an image');
	  return false;
	 }
	 elseif($fixed_height !='' and $fixed_width != '')
	 {
	  $uploading_report=$this->upload->do_upload($file_name);
	  if($uploading_report == true)
	  {
	   list($width, $height) = getimagesize($_FILES[$file_name]['tmp_name']);
       foreach($this->upload->data() as $key=>$file_value)
	   {
	    $this->uploading_image_info[$image_index][$key]=$file_value;
	   }
	   
	   if(($fixed_height != $height) or ($fixed_width != $width))
	   {
	    $this->form_validation->set_message('image_validation','Please upload image of given fixed size');
	    return false;
	   }
	   else
	   {
 	    //foreach($this->upload->data() as $key=>$file_value)
	    //{
	     //$this->uploading_image_info[$image_index][$key]=$file_value;
	    //}
		return true;
	   }
	  }
	  else
	  {
	   $this->form_validation->set_message('image_validation',$this->upload->display_errors());
	   return false;
      }
	 } 
	 else
	 {
	  if(!$this->upload->do_upload($file_name))
	  {
	   $this->form_validation->set_message('image_validation', $this->upload->display_errors());
	   return false;
 	  }
	  else
	  {
		  
	   foreach($this->upload->data() as $key=>$file_value)
	   {
	    $this->uploading_image_info[$image_index][$key]=$file_value;
	   }
	   return true;
	  }
	 }
   }
   public function brochure_validation($name,$uploaded_file_info)
   {
     list($file_name,$path_to_upload,$brochure_index,$max_size)=explode("~",$uploaded_file_info);
	 $config['upload_path'] = $path_to_upload;
	 $config['allowed_types'] = 'pdf|doc|xls|xlsx|docx|zip|mov';
	 $config['remove_spaces']=true;
	 if(!empty($max_size)) $config['max_size']	= $max_size;
	 
     $this->load->library('upload');
	 $this->upload->initialize($config);
     if(empty($_FILES[$file_name]['name']))
	 {
      $this->form_validation->set_message('brochure_validation','Please select brochure');
	  return false;
	 }
	 else
	 {
	  if(!$this->upload->do_upload($file_name))
	  {
	   $this->form_validation->set_message('brochure_validation', $this->upload->display_errors());
	   return false;
 	  }
	  else
	  {
	   foreach($this->upload->data() as $key=>$file_value)
	   {
	    $this->uploading_brochure_info[$brochure_index][$key]=$file_value;
	   }
	  return true;
	 }
	 
	}
       
   }
   public function svg_image_validation($name,$uploaded_file_info)
   {
     list($file_name,$path_to_upload,$brochure_index,$max_size)=explode("~",$uploaded_file_info);
	 $config['upload_path'] = $path_to_upload;
	 $config['allowed_types'] = 'svg';
	 $config['remove_spaces']=true;
	 if(!empty($max_size)) $config['max_size']	= $max_size;
	 
     $this->load->library('upload');
	 $this->upload->initialize($config);
     if(empty($_FILES[$file_name]['name']))
	 {
      $this->form_validation->set_message('svg_image_validation','Please select svg image');
	  return false;
	 }
	 else
	 {
	  if(!$this->upload->do_upload($file_name))
	  {
	   $this->form_validation->set_message('svg_image_validation', $this->upload->display_errors());
	   return false;
 	  }
	  else
	  {
	   foreach($this->upload->data() as $key=>$file_value)
	   {
	    $this->uploading_brochure_info[$brochure_index][$key]=$file_value;
	   }
	  return true;
	 }
	 
	}
       
   }
   
   public function is_unique_on_update($field_value, $field_info)
   {
	list($table_name, $field, $id, $field_name)=explode("~",$field_info);
	if(!$this->Login_model->CheckUniqueOnUpdate($table_name, $field, $field_value, $id))
    {
     $this->form_validation->set_message('is_unique_on_update',"This $field_name already exists");		
     return false;
    }
    else
    {
     return true;
    }
   }

   public function is_unique_with_condition($field_value,$field_info)
   {
	list($table_name,$field,$additional_condition,$field_name)=explode("~",$field_info);
	if(!$this->Login_model->CheckUniqueWithCondition($table_name,$field,$field_value,$additional_condition))
    {
     $this->form_validation->set_message('is_unique_with_condition',"This $field_name already exists");		
     return false;
    }
    else
    {
     return true;
    }
   }
   public function error()
   {
    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','12','Page Not Found');
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',12);   

    $this->load->view('templates/header',$this->data);
    $this->load->view('general-pages/error',$this->data);
    $this->load->view('templates/footer');
   }
   public function ReduceImageWeight($image_file, $path, $quality)
   {
	if($quality != '')
	{
     $ext = pathinfo($image_file, PATHINFO_EXTENSION);
	 if($ext=='jpg' || $ext=='jpeg' || $ext=='JPG' || $ext=='JPEG') 
	 {
	  $suffix = '';
	  $image_path = substr($path,0,-1);
	  $this->ReduceImage($image_file, $image_path, $suffix, $quality);
	 }
	}
   }
    
	public function ReduceImage($img, $imgPath, $suffix, $quality)
	{
	 $ext = pathinfo("$imgPath/$img", PATHINFO_EXTENSION);	
		
	 // Open the original image.
	 if($ext=='jpg' || $ext=='jpeg' || $ext=='JPG' || $ext=='JPEG') 
	 $original = imagecreatefromjpeg("$imgPath/$img") or die("Error Opening original (<em>$imgPath/$img</em>)");
	 else if($ext=='png' || $ext=='PNG') $original = imagecreatefrompng("$imgPath/$img") or die("Error Opening original (<em>$imgPath/$img</em>)");
	 else if($ext=='gif' || $ext=='GIF') $original = imagecreatefromgif("$imgPath/$img") or die("Error Opening original (<em>$imgPath/$img</em>)");
		
	 list($width, $height, $type, $attr) = getimagesize("$imgPath/$img");
	 
	 // Resample the image.
	 $tempImg = imagecreatetruecolor($width, $height) or die("Cant create temp image");
	 imagecopyresized($tempImg, $original, 0, 0, 0, 0, $width, $height, $width, $height) or die("Cant resize copy");
	 
	 if($ext=='png' || $ext=='PNG')  
	 {
	  //imagealphablending($tempImg, true);
	  imagesavealpha($tempImg, true);
	  $color = imagecolorallocatealpha($tempImg,0x00,0x00,0x00,127);
	  imagefill($tempImg, 0, 0, $color); 
	}
	
	// Create the new file name.
	$newNameE = explode(".", $img);
	$newName = ''. $newNameE[0] .''. $suffix .'.'. $newNameE[1] .'';
	 
	// Save the image.
	imagejpeg($tempImg, "$imgPath/$newName", $quality) or die("Cant save image");
	if($ext=='jpg' || $ext=='jpeg' || $ext=='JPG' || $ext=='JPEG') imagejpeg($tempImg, "$imgPath/$newName", $quality) or die("Cant save image");
	else if($ext=='png' || $ext=='PNG')	imagepng($tempImg, "$imgPath/$newName", 9, PNG_ALL_FILTERS) or die("Cant save image");
	else if($ext=='gif' || $ext=='GIF') imagegif($tempImg, "$imgPath/$newName", $quality) or die("Cant save image");
	
	// Clean up.
	imagedestroy($original);
	imagedestroy($tempImg);
	return true;
  }	   
   
  public function SetUpCkeditor()
  {
   $this->load->library('ckeditor');
   $this->load->library('ckfinder');
   $this->ckeditor->basePath = base_url().'application/third_party/ckeditor/';
   $this->ckeditor->config['toolbar'] = array(array('Source','Templates', 'Bold', 'Italic', 'Underline', 'Cut','Copy','Paste','PasteText','PasteFromWord','Undo','Redo','-', 'NumberedList','BulletedList','Outdent','Indent','Blockquote','CreateDiv','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'), array('Link','Unlink','Anchor','Find','Replace','SelectAll','Scayt','Subscript','Superscript','RemoveFormat','ShowBlocks','BidiLtr','BidiRtl','-','Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','Iframe'),array('Styles','Format','Font','FontSize','TextColor','BGColor','Maximize','MediaEmbed','Youtube'));
    $this->ckeditor->config['skin'] = "moono";
   $this->ckeditor->config['extraPlugins'] = 'youtube';   
    $this->ckeditor->config['allowedContent'] = true;	
   
   //Add Ckfinder to Ckeditor
   $this->ckfinder->SetupCKEditor($this->ckeditor, BASE_DIR.'application/third_party/ckfinder/');   
  }
  
  public function GetIPAddress()
  {
   $ipaddress = '';
   if (isset($_SERVER['HTTP_CLIENT_IP']))
    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
   else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
   else if(isset($_SERVER['HTTP_X_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
   else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
   else if(isset($_SERVER['HTTP_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_FORWARDED'];
   else if(isset($_SERVER['REMOTE_ADDR']))
    $ipaddress = $_SERVER['REMOTE_ADDR'];
   else
    $ipaddress = 'UNKNOWN';
   return $ipaddress; 
  } 
  public function GetIpLocation()
  {
   $ip = $_SERVER['REMOTE_ADDR'];
   if(($_SERVER['HTTP_HOST'] == "devs") or ($_SERVER['HTTP_HOST'] == "localhost"))
   {
    $country="India";
   }
   else
   {
  /*  $country = geoip_country_name_by_name($ip); */
  $country ='Somewhere Earth';
   }
   return trim(strtolower($country));
  }
  

  public function SendMailToUser($mailBody, $records, $email_setting_id, $other_info='')
  {
    // You can make a condition with 'other info'(optional variable). 
    $email_message = $this->Website_model->GetEmailMessages($email_setting_id);
    
    if($email_setting_id == 4) {
        $emailTemplate = $this->load->view('email/email2', '', TRUE);
        
        $email_message['message'] = str_replace("[[USER FULL NAME]]", $records['full_name'], $email_message['message']);
    } else if($email_setting_id == 20) {
        //$emailTemplate = file_get_contents(base_url()."email-templates/campaign_receipt.html");
        $emailTemplate = $this->load->view('email/campaign_receipt', '', TRUE);
    } else if($email_setting_id == 13) {
        //$emailTemplate = file_get_contents(base_url()."email-templates/onetime_receipt.html");
        $emailTemplate = $this->load->view('email/onetime_receipt', '', TRUE);
    } else{
        //$emailTemplate = file_get_contents(base_url()."email-templates/email2.html");
        $emailTemplate = $this->load->view('email/email2', '', TRUE);
    }

    $mailBody=str_replace("[[BODY]]",$mailBody,$email_message['message']);
    
    $mailMsg=str_replace("[[[BASE_URL]]]",base_url(),$emailTemplate);
    $mailMsg=str_replace("[[[TO]]]",'',$mailMsg);
    $mailMsg=str_replace("[[[BODY]]]",$mailBody,$mailMsg);
    $mailMsg=str_replace("[[[FROM]]]",'',$mailMsg);
    
    $subject= $email_message['subject'];   

    $this->load->library('email');

    $this->email->initialize($this->emailConfig);
    
    if(!empty($email_message['sender_email']) and  !empty($email_message['sender_name'])) {
        $this->email->from($email_message['sender_email'], $email_message['sender_name']);
    } else {
        $this->email->from($this->data['common_settings']['sender_email'], $this->data['common_settings']['sender_name']); // Global set sender
    }
    
    // $this->email->reply_to($reply_to['email'], $reply_to['name']);
    
    // $to_seo = "webmaster@zeemo.com.au";
    
    $this->email->to($records['email']);
    
    $this->email->subject($subject);
    $this->email->set_mailtype('html');
    $this->email->message($mailMsg);
    $this->email->send();
    $this->email->clear();
    
  }

  public function SendEmail($email) {
    $this->load->library('email');
    $this->email->initialize($this->emailConfig);
    $this->email->from($email['from']);
    $this->email->to($email['to']);
    $this->email->bcc('web@sleepbus.org'); 
    $this->email->subject($email['subject']);
    $this->email->set_mailtype('html');
    $this->email->message($email['message']);

    if (isset($email['reply-to'])) {
      $this->email->reply_to($email['reply-to']);
    }

    if (isset($email['bcc'])) {
      $this->email->bcc($email['bcc'] . ',web@sleepbus.org');
    }

    $this->email->send();
    $this->email->clear();
  }

  public function SendPasswordResetEmail($values) {
    // TODO: remove all these redundant functions
    //       put SendEmail calls at action point
    $email = array(
      'message' => $this->load->view('email/password_reset', $values, TRUE),
      'subject' => 'sleepbus: Password oops',
      'from' => getenv('EMAIL_SEND_FROM'),
      'to' => $values['email']
    );

    $this->SendEmail($email);
  }

  public function SendSignUpEmailToAdmin($values) {
    $email = array(
      'message' => $this->load->view('email/user_signup_confirmation_admin', $values, TRUE),
      'subject' => 'A new user has joined the sleepbus family!',
      'from' => getenv('EMAIL_SEND_FROM'),
      'to' => getenv('ADMIN_EMAIL')
    );

    $this->SendEmail($email);
  }

  public function SendSignUpMessageToUser($values) {
    $email = array(
      'message' => $this->load->view('email/user_signup_confirmation', $values, TRUE),
      'subject' => 'Thank you for signing up to sleepbus!',
      'from' => getenv('EMAIL_SEND_FROM'),
      'to' => $values['email']
    );

    $this->SendEmail($email);
  }

  public function SendConnectMessageToUser($values) {
    $email = array(
      'message' => $this->load->view('email/user_connect_message', $values, TRUE),
      'subject' => 'A person has connected to sleepbus!',
      'from' => getenv('EMAIL_SEND_FROM'),
      'to' => getenv('ADMIN_EMAIL'),
      'reply-to' => '<' . $values['email'] . '> ' . $values['name']
    );

    $this->SendEmail($email);
  }

  public function _validateMessageText($message,$field_name)
  {
   list($field,$caption)=explode("~",$field_name);	  
   if($message!='')
   {
    $pattern = '/^([a-zA-Z0-9_.-]|[\s]|[,]|[\?])+$/';
    if(!(preg_match($pattern,$message)))
    {
     $this->form_validation->set_message('_validateMessageText', 'Special characters are not allowed for the '.$caption.' field');
     return false;
    }
    else return true;
   }
   else return true;
  }
  public function _validateNameText($message,$field_name)
  {
   list($field,$caption)=explode("~",$field_name);	  
   if($message!='')
   {
    $pattern = '/^([a-zA-Z]|[\s])+$/';
    if(!(preg_match($pattern,$message)))
    {
     $this->form_validation->set_message('_validateNameText', 'Special characters are not allowed for the '.$caption.' field');
     return false;
    }
    else return true;
   }
   else return true;
  }
  public function _validateURL($field_value)
  {
   $regexp="|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
   if(!(preg_match($regexp,$field_value)))
   {
    $this->form_validation->set_message('_validateURL', 'Invalid URL');
    return false;
   }
   else return true;
  }
  public function UserSessionCheckOnIndividualPage()
  {
   $username=isset($_POST['site_username'])?$_POST['site_username']:$this->session->userdata('site_username');
   $password=isset($_POST['site_password'])?$_POST['site_password']:$this->session->userdata('site_password'); 
   if(!empty($username) and !empty($password))
   {
	$this->data['user_info']=array();
	$this->data['user_info']=$this->Account_model->CheckUser($username,$password);
	if(count($this->data['user_info']) > 0)
	{
     $this->session->set_userdata('site_username',$username);
	 $this->session->set_userdata('site_password',$password);
	}
	else
	{
	 $this->session->unset_userdata('site_username');
     $this->session->unset_userdata('site_password');
	}
   }
   else
   {
	$this->session->unset_userdata('site_username');
    $this->session->unset_userdata('site_password');
   }
  }	
 }
