<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
 class Blogs extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Blog_model');
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
    $this->Login_model->UpdateTopText($records,5);
	$this->RedirectPage(admin.'/blogs/toptext','Top text has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(5);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,5);
   $this->data['attributes']=$this->Blog_model->GetTopTextFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/blogs/top-text',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function SetBlogHomePage($blog_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('blogs/manage-blogs');	  
   $this->adminjavascript->include_admin_js=array('ValidateBlogFormJs','DragDropJs');
   $this->Blog_model->SetBlogOnHomePage($blog_id);
   $this->RedirectPage(admin.'/blogs/manage-blogs/',"Display on footer updated successfully"); 
  }
  public function add_category($values=array())
  {	
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs','ValidateBlogFormJs','DragDropJs');
   $this->admincss->including_css_func = array('CalendarCss'); 
   
   if(count($values) > 0)
   {
    $this->data['title'] .= $values['title']; //this is meta title
	$this->data['page_title'] = $values['page_title']; //this is page heading
   }
   else
   {
    $values['category_name'] = '';
	$this->data['page_title'] = 'Add Category';
   }
   if(!empty($this->data['cat_id'])) $this->data['attributes'] = $this->Blog_model->GetCategoryFormAttribute($values,$this->data['cat_id']);
   else $this->data['attributes'] = $this->Blog_model->GetCategoryFormAttribute($values);
  
   $this->data['category_list'] = $this->Blog_model->GetCategoryList();
   
   $this->data['category_id']=$this->Blog_model->DisplayBlogOnHome();
   if(count($this->data['category_list']) > 0)
   {
	 /*   
     Arguments for GetAtributesForDeletion function : 
	 1. item list to be deleted, 
	 2. which type of item to be deleted, 
	 3. single delete permission-> value would be 'yes' or 'no' and 
	 4. parent_id if you have(optional);
    */	
    $this->data['attribute'] = $this->Login_model->GetAtributesForDeletion($this->data['category_list'],'category','yes');
   }
   
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/blogs/add-category',$this->data);
   $this->load->view(admin.'/templates/footer');
  }  
  
  public function validate_category()
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('blogs/add-category');
   $this->data['active_submodule'] = 'add-category';

   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','Please enter {field}');
   $this->form_validation->set_message('is_unique','Category with same name already exists');

   $values = array();
   $file_uploaded = FALSE;

   $submit_value = $this->input->post('submit_value');   
   $values['title'] = 'Validate Category';   
   $values['category_name'] = $this->input->post('category_name');
   
   if($submit_value=='Update')
   {
    $values['page_title'] = 'Edit Category'; //this is page heading
   	
	$cat_id = $this->input->post('cat_id');
    $this->data['cat_id'] = $cat_id;
    
	$this->form_validation->set_rules('category_name', 'Please enter category name', 
	'trim|required|callback_is_unique_on_update['.BLOGS_CATEGORIES.'~category_name~'.$cat_id.'~category]');
   }
   if($submit_value=='Submit')
   {
    $values['page_title'] = 'Add Category'; //this is page heading
    $this->form_validation->set_rules('category_name', '', 'trim|required|is_unique['.BLOGS_CATEGORIES.'.category_name]');
    
	
   }

   if($this->form_validation->run()==FALSE) 
   {
	$this->add_category($values);
   }
   else
   {
    $records['category_name'] = $values['category_name'];

    if($submit_value=='Update')
	{
    
	 $this->Blog_model->UpdateCategory($records,$cat_id);
	 $this->RedirectPage(admin.'/blogs/add-category','Category updated successfully');
	}
	else
	{
     //genereate category url
	 $cat_url = strtolower(str_replace(' ','-',$this->commonfunctions->RemoveSpecialChars($records['category_name'])));		

	 $records['url'] = $this->Login_model->GenerateNewUrl($cat_url);	 

	 $cat_id=$this->Blog_model->InsertCategory($records);
	 $this->RedirectPage(admin.'/blogs/add-category','Category added successfully');
	}
   }
  }
  
  public function edit_category($cat_id)
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('blogs/add-category');	  
   $this->data['active_submodule'] = "add-category";
   $this->data['last_modified'] = $this->Login_model->LastModify(BLOGS_CATEGORIES,$cat_id);   

   $values = array();
   $values = $this->Blog_model->GetCategoryDetails($cat_id);
   $values['page_title'] = 'Edit Category';
   $values['title'] = 'Edit Category';
   $values['submit_value'] = 'Update';
   $this->data['cat_id'] = $cat_id;
   $this->add_category($values);
  } 
  
  
  
  public function add_blogger($values=array())
  {	
  
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs','ValidateBlogFormJs','DragDropJs');
   $this->admincss->including_css_func = array('CalendarCss'); 
   
   if(count($values) > 0)
   {
    $this->data['title'] .= $values['title']; //this is meta title
	$this->data['page_title'] = $values['page_title']; //this is page heading
	
   }
   else
   {
    $values['blogger_name'] = '';
	$this->data['page_title'] = 'Add Blogger';
   }
   if(!empty($this->data['blogger_id'])) $this->data['attributes'] = $this->Blog_model->GetBloggerFormAttribute($values,$this->data['blogger_id']);
   else $this->data['attributes'] = $this->Blog_model->GetBloggerFormAttribute($values);
  
   $this->data['blogger_list'] = $this->Blog_model->GetBloggerList();
   if(count($this->data['blogger_list']) > 0)
   {
	 /*   
     Arguments for GetAtributesForDeletion function : 
	 1. item list to be deleted, 
	 2. which type of item to be deleted, 
	 3. single delete permission-> value would be 'yes' or 'no' and 
	 4. parent_id if you have(optional);
    */	
    $this->data['attribute'] = $this->Login_model->GetAtributesForDeletion($this->data['blogger_list'],'blogger','yes');
   }
   
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/blogs/add-blogger',$this->data);
   $this->load->view(admin.'/templates/footer');
  }  
  
  public function validate_blogger()
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('blogs/add-blogger');
   $this->data['active_submodule'] = 'add-blogger';

   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','{field}');
   $this->form_validation->set_message('is_unique','Blogger with same name already exists');

   $values = array();
   $file_uploaded = FALSE;

   $submit_value = $this->input->post('submit_value');   
   $values['title'] = 'Validate Blogger';   
   $values['blogger_name'] = $this->input->post('blogger_name');
   
   if($submit_value=='Update')
   {
    $values['page_title'] = 'Edit Blogger'; //this is page heading
	
   	
   	$blogger_id = $this->input->post('blogger_id');

    $this->data['blogger_id'] = $blogger_id;
    
	$this->form_validation->set_rules('blogger_name', 'Please enter blogger name', 
	'trim|required|callback_is_unique_on_update['.BLOGGER.'~blogger_name~'.$blogger_id.'~blogger]');
   }
   if($submit_value=='Submit')
   {
    $values['page_title'] = 'Add Blogger'; //this is page heading
    $this->form_validation->set_rules('blogger_name', '', 'trim|required|is_unique['.BLOGGER.'.blogger_name]');
    
	
   }

   if($this->form_validation->run()==FALSE) 
   {
	$this->add_blogger($values);
   }
   else
   {
    $records['blogger_name'] = $values['blogger_name'];

    if($submit_value=='Update')
	{
    
	 $this->Blog_model->UpdateBlogger($records,$blogger_id);
	 $this->RedirectPage(admin.'/blogs/add-blogger','Blogger updated successfully');
	}
	else
	{
     //genereate blogger url
	 $blogger_url = strtolower(str_replace(' ','-',$this->commonfunctions->RemoveSpecialChars($records['blogger_name'])));		

	 $records['url'] = $this->Login_model->GenerateNewUrl($blogger_url);	 

	 $blogger_id=$this->Blog_model->InsertBlogger($records);
	 $this->RedirectPage(admin.'/blogs/add-blogger','Blogger added successfully');
	}
   }
  }
  
  
  public function edit_blogger($blogger_id)
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('blogs/add-blogger');	  
   $this->data['active_submodule'] = "add-blogger";
   $this->data['last_modified'] = $this->Login_model->LastModify(BLOGGER,$blogger_id);   

   $values = array();
   $values = $this->Blog_model->GetBloggerDetails($blogger_id);
   $values['page_title'] = 'Edit Blogger';
   $values['title'] = 'Edit Blogger';
   $values['submit_value'] = 'Update';
   $this->data['blogger_id'] = $blogger_id;
   $this->add_blogger($values);
  }
  
  
  public function add_blog($cat_id = '',$blogger_id = '', $values = array())
  {	
   $this->SetUpCkeditor(); 
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs','ValidateBlogFormJs','CalendarJs');
   $this->admincss->including_css_func = array('CalendarCss'); 
   
   if(count($values) > 0)
   {
    $this->data['title'] .= $values['title']; //this is meta title
	$this->data['page_title'] = $values['page_title']; //this is page heading
   }
   else 
   {
    $values['blog_name'] = '';
	$values['intro_text'] = '';
    $values['description'] = '';
	$values['banner_image_text']="";	
	$this->data['page_title'] = 'Add Blog';
	$this->data['file_error'] = '';
	$values['date_display']=date("d-m-Y");
   }
   $values['selected_cat_id'] = $cat_id;
   $values['selected_blogger_id']=$blogger_id;

   $category_list = $this->Blog_model->GetCategoryForDropDown();
   $blogger_list=$this->Blog_model->GetBloggerForDropDown();
   if(!empty($this->data['blog_id'])) 
   $this->data['attributes'] = $this->Blog_model->GetBlogFormAttribute($values, $category_list,$blogger_list, $this->data['blog_id']);
   else $this->data['attributes'] = $this->Blog_model->GetBlogFormAttribute($values, $category_list,$blogger_list);

   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/blogs/add-blog',$this->data);
   $this->load->view(admin.'/templates/footer');
  }  
  
  public function edit_blog($blog_id, $cat_id,$blogger_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('blogs/add-blog');	  
   $this->data['active_submodule'] = "add-blog";
   $this->data['last_modified']=$this->Login_model->LastModify(BLOGS,$blog_id);   

   $values = array();
   $values = $this->Blog_model->GetBlogDetails($blog_id);
  // var_dump($values);

   $values['page_title'] = "Edit Product";
   $values['title'] = "Edit Product";
   $values['submit_value'] = "Update";
   $this->data['blog_id'] = $blog_id;
   $this->add_blog($cat_id,$blogger_id, $values);
  }  
  
  public function validate_blog()
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('blogs/add-blog');
   $this->data['active_submodule'] = 'add-blog';

   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','{field}');
   $this->form_validation->set_message('is_unique','Blog with same name already exists in selected category');

   $values = array();

   $submit_value = $this->input->post('submit_value');   
   $values['title'] = 'Validate Blog';  
   $values['cat_id'] = $this->input->post('cat_id');
   $values['blogger_id'] = $this->input->post('blogger_id');
   $values['blog_name'] = $this->input->post('blog_name');
   $values['intro_text'] = $this->input->post('intro_text');
   $values['description'] = $this->input->post('description');
   $values['banner_image_text']=$this->input->post('banner_image_text');
   $values['date_display']=$this->input->post('date_display');
   $blog_name = $this->input->post('blog_name');
   $cat_id = $this->input->post('cat_id');
   $blogger_id = $this->input->post('blogger_id'); 

   if($submit_value=='Update')
   {
    $values['page_title'] = 'Edit Blog'; //this is page heading
	$blog_id = $this->input->post('blog_id');
    $this->data['blog_id'] = $blog_id;
  //  $this->form_validation->set_rules('blog_name', 'Please enter blog name','trim|required|callback_is_unique_on_update['.BLOGS.'~blog_name~'.$blog_id.'~blog]');
	
	$this->form_validation->set_rules('blog_name', 'Please enter blog name', 'trim|required|callback_is_unique_blog['.$cat_id.'~'.$blog_name.'~'.$blog_id.']');
   }
   if($submit_value=='Submit')
   {
    $values['page_title'] = 'Add Blog'; //this is page heading
    $this->form_validation->set_rules('blog_name', 'Please enter blog name', 'trim|required|callback_is_unique_blog['.$cat_id.'~'.$blog_name.']');
   }
   $this->form_validation->set_rules('cat_id', 'Please select a category', 'trim|required');
   $this->form_validation->set_rules('blogger_id','Please select a blogger','trim|required');
   $this->form_validation->set_rules('intro_text', 'Please enter short description of blog', 'trim|required');
   $this->form_validation->set_rules('description', 'Please enter description of blog', 'trim|required');
   $this->form_validation->set_rules('banner_image_text', 'Please enter banner content', 'trim|required');

   if($this->form_validation->run()==FALSE) 
   {
	$this->add_blog($cat_id, $blogger_id, $values);
   }
   else
   {
    $records1['blog_name'] = $values['blog_name'];
    $records1['intro_text'] = $values['intro_text'];	
    $records1['description'] = $values['description'];
	$records1['date_display'] = $values['date_display'];
	$records1['cat_id'] = $values['cat_id'];
	$records1['blogger_id'] = $values['blogger_id'];
    $records1['banner_image_text'] = $values['banner_image_text'];
	
    if($submit_value=='Update')
	{
	 $this->Blog_model->UpdateBlog($records1, $blog_id);
	 $this->RedirectPage(admin.'/blogs/manage-blogs','Blog updated successfully');
	}
	else
	{
     //genereate blog url
	 $url = strtolower(str_replace(' ','-',$this->commonfunctions->RemoveSpecialChars($records1['blog_name'])));		
	 $records1['url'] = $this->Login_model->GenerateNewUrl($url);	 
	 $records1['cat_id'] = $cat_id;
	 $records1['blogger_id']=$blogger_id;
	 $this->Blog_model->InsertBlog($records1);
	  //EMAIL TO ADMIN
	   $global_admin=$this->Login_model->GetAdminDetails('zeemoadmin');
	   $from = $global_admin['email'];
	   $admin=array();
       $admin=$this->Blog_model->GetBlogNotificationEmailId();
      
	 
	   
	   $subject = "New blog post on your website  ".DEFAULT_SUFFIX;
	   $to_msg= "Hi Admin,";
	   
	   $body_msg="";
	   $body_msg.="<br><br>A new blog post has been added onto your website by us as per our regular search engine optimisation program of your website.<br><br>";
	   $body_msg.="Feel free to contact us on ".ZEEMO_CONTACT_NO." if you have any questions.<br><br><br>";
	   $from_msg = 'Regards,<br /><strong style="font-size:14px;">Zeemo</strong>';
	   
	   $mailMsg3=file_get_contents(base_url()."email-templates/email.html");
	   $mailMsg2=str_replace("[[[TO]]]",$to_msg,$mailMsg3);
	   $mailMsg1=str_replace("[[[BODY]]]",$body_msg,$mailMsg2);
       $mailMsg0=str_replace("[[[FROM]]]",$from_msg,$mailMsg1);
       $mailMsg=str_replace("[[[ZEEMO_CONTACT_NO]]]",ZEEMO_CONTACT_NO,$mailMsg0);
	   
	   $this->load->library('email');
	   $this->email->from($from, 'Zeemo');
	   $this->email->to($admin[0]['blog_to_emailid']);
	   if(!empty($admin[0]['blog_cc_emailid']))
	   { 
	    $this->email->cc($admin[0]['blog_cc_emailid']); 
	   }
	   if(!empty($admin[0]['blog_bcc_emailid']))
	   {
        $this->email->bcc($admin[0]['blog_bcc_emailid']);
	   }
  
	   $this->email->subject($subject);
	   $this->email->set_mailtype('html');
	   $this->email->message($mailMsg);	
	   $this->email->send();   
	   $this->email->clear();
	   $this->RedirectPage(admin.'/blogs/manage-blogs','Blog added successfully');
	}
   }
  }  

  public function is_unique_blog($pname, $fields)
  {
   $fields_arr = explode('~', $fields);	 
   $blog_id = ''; 	  
   if(count($fields_arr)==3) list($cat_id, $blog_name, $blog_id) = explode('~', $fields);	  
   else list($cat_id, $blog_name) = explode('~', $fields);
   
   if(!$this->Blog_model->IsUniqueBlog($cat_id, $blog_name, $blog_id))
   {
    $this->form_validation->set_message('is_unique_blog',"This blog already exists in selected category");		
    return false;
   }
   else return true;
  }
  
  public function manage_blogs($cat_id = '',$blogger_id='')
  {
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs','DragDropJs');
   //$this->admincss->including_css_func = array('PrettyPhotoCss');   
 
   if($cat_id=='') $cat_id = $this->db_query->GetFirstItemId(BLOGS_CATEGORIES,'id');
   
  // $this->data['category_list'] = $this->Blog_model->GetCategoryForDropDown();
   //$this->data['selected_cat_id'] = $cat_id;
   
   $this->data['blog_list'] = array();
   $this->data['blog_list'] = $this->Blog_model->GetBlogList();

   if(count($this->data['blog_list']) > 0)
   {
	/*   
     Arguments for GetAtributesForDeletion function : 
	 1. item list to be deleted, 
	 2. which type of item to be deleted, 
	 3. single delete permission-> value would be 'yes' or 'no' and 
	 4. parent_id if you have(optional);
    */	
    $this->data['attribute'] = $this->Login_model->GetAtributesForDeletion($this->data['blog_list'],'blog','no', $cat_id);
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/blogs/manage-blogs',$this->data);
   $this->load->view(admin.'/templates/footer');
  }  

 
  
  public function changestatus($record_id, $status, $section, $parent_id = '', $cat_id = '')
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('blogs/manage-blogs');
  
   $section = str_replace("_","-",$section); 
   
   if($section=='add-category')
   {
    $this->Login_model->ChangeStatus(BLOGS_CATEGORIES,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of category changed successfully');
   }
   elseif($section=='add-blogger')
   {
    $this->Login_model->ChangeStatus(BLOGGER,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of blogger changed successfully');
   }
   elseif($section=='manage-blogs')
   {
    $this->Login_model->ChangeStatus(BLOGS, $record_id, $status);
    $this->session->set_flashdata('success_message','Status of blog changed successfully');
   }
   

   if(!empty($parent_id)) $section .= '/'.$parent_id; 
   if(!empty($cat_id)) $section .= '/'.$cat_id;

   header("location:".base_url().admin."/blogs/$section");
   exit;
  } 
  
  
  // mandatory Function for each module
  public function ConfirmDelete($checked_id, $item_name, $parent_id = '', $cat_id = '') 
  {
   $this->adminjavascript->include_admin_js = array('ConfirmDeleteJs');
   
   if($item_name=='blog' || $item_name=='image' || $item_name=='brochure') 
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('blogs/manage-blogs');	  	  
   else if($item_name=='category') $this->data['sub_modules']=$this->CheckSubModuleAccessibility('blogs/add-category');	  	     
   
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_id, $item_name, $parent_id);
   if($cat_id != '')
   {
    $attributes2 = array('cat_id' => $cat_id);
    $this->data['attributes']['hidden'] = array_merge($this->data['attributes']['hidden'],$attributes2);
   }
   /*
   If you have any additional attribute item wise then you can merge it as follows  : 
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   If you have any custom message other than common message item wise then assign message to data variable as follows
   Default message
   */
   $this->data['message'] = "Are you sure you want to delete selected ".$item_name;

   $this->load->view(admin.'/templates/confirm-delete',$this->data);
  }
  
  //mandatory Function for each module
  public function ConfirmSuperadmin($checked_ids, $item_name, $parent_id='', $cat_id='') 
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('blogs/manage-blogs');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_ids, $item_name, $parent_id);
   
   if($cat_id != '')
   {
    $attributes2 = array('cat_id'=>$cat_id);
    $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   }
   /*
   If you have any additional attribute item wise then you can merge it as follows  : 
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   If you have any custom message other than common message item wise then assign message to data variable as follows
   Default message
   */
   if($item_name=='category') $this->data['message'] = "If you delete selected category, all related blogs  will be deleted. Are you sure you want to delete?";
   elseif($item_name=='blogger') $this->data['message'] = "If you delete selected blogger, all related blogs  will be deleted. Are you sure you want to delete?";
   else $this->data['message'] = "Are you sure you want to delete all selected item(s)";
      
   $this->adminjavascript->include_admin_js = array('SuperAdminValidationJs');
   $this->admincss->including_css_func = array('PrettyPhotoCss');  
   $this->load->view(admin.'/templates/superadmin-delete',$this->data);
  }
  
  //mandatory Function for each module
  public function DeleteRecord($checked_ids, $item_name, $parent_id = '', $cat_id = '') 
  {
   $item_name = urldecode($item_name);
   $all_ids = explode("~",$checked_ids);
   
   // Delete Record item wise and redirect the page to repective module with success message
   if($item_name=="category")
   {
    if(count($all_ids) > 0)
	{
	 $this->Blog_model->DeleteCategories($all_ids, $parent_id);
	 $this->RedirectPage(admin.'/blogs/add-category', 'Selected category deleted successfully');
	}
   } 
   else if($item_name=="blogger")
   {
    if(count($all_ids) > 0)
	{
	 $this->Blog_model->DeleteBlogger($all_ids, $parent_id);
	 $this->RedirectPage(admin.'/blogs/add-blogger', 'Selected blogger deleted successfully');
	}
   } 
   else if($item_name=="blog")
   {
    if(count($all_ids) > 0)
	{
	 $this->Blog_model->DeleteBlogs($all_ids);
	 $this->RedirectPage(admin.'/blogs/manage-blogs', 'Selected blog(s) deleted successfully');
	}
   } 
  
  }    
  
 }

