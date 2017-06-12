<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Metatags extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Metatags_model');
   $this->load->helper('form');
   $this->load->library('CommonFunctions');	
  }
  public function single_page_metas()
  {
   $this->data['all_pages']=$this->Metatags_model->GetAllSinglePagesList();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="SINGLE_PAGE";
   $this->data['section']="single-page-metas";
   $this->data['section_name']="single page metas";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/metatags/item-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  public function service_metas()
  {
   $this->data['all_pages']=$this->Metatags_model->GetServiceList();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="SERVICES";
   $this->data['section']="service-metas";
   $this->data['section_name']="Services";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/metatags/item-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  public function news_metas()
  {
   $this->data['all_pages']=$this->Metatags_model->GetNewsList();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="NEWS";
   $this->data['section']="news-metas";
   $this->data['section_name']="News";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/metatags/item-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  public function project_default_metas()
  {
   $this->data['all_pages']=$this->Metatags_model->GetProjectList();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="PROJECTS";
   $this->data['section']="project-default-metas";
   $this->data['section_name']="Project";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/metatags/item-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  
  public function about_section_metas()
  {
   $this->data['all_pages']=$this->Metatags_model->GetAllAboutPages();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="ABOUT_SECTION";
   $this->data['section']="about-section-metas";
   $this->data['section_name']="About Section";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/metatags/about-section-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  
  public function product_default_metas()
  {
   $this->data['all_pages']=$this->Metatags_model->GetDefaultProductPage();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="PRODUCTS";
   $this->data['submenus']=$this->Metatags_model->ProductSubmenu();
   $this->data['section']="product-default-metas";
   $this->data['section_name']="Product Page";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/metatags/product-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  public function category_metas($parent_id=0,$depth=0)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('metatags/product-default-metas');
   $this->data['active_submodule']="product-default-metas";
   $this->data['submodule_details']=$this->Login_model->GetModuleDetails($this->data['active_module']."/".$this->data['active_submodule']);   
   $this->data['section']="category-metas";
   $this->data['section_name']="Category pages";
   $this->data['title'].=$this->data['section_name'];
   
   $this->load->Model(admin.'/Product_model');
   
   $this->data['parent_id']=$parent_id;
   $this->data['depth']=$depth;
   $this->data['category_list'] = $this->Metatags_model->GetCategoriesList($this->data['parent_id']);
   $this->data['is_subcategory']=$this->Product_model->GetCategoryListWithoutSubcateories($this->data['category_list']);
   $this->data['category_navigation']=$this->Product_model->GetCategoryNavigation($this->data['parent_id'],$this->data['depth']);
   
   if($this->data['parent_id'] != 0)
   {
    $this->data['parent_category_drop_down_attribute']=$this->Product_model->ParentCategoryDropDownAttributes($this->data['parent_id']);
   }


   //$this->data['all_pages']=$this->Metatags_model->GetCategoriesList();	  
  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="CATEGORIES";
   $this->data['submenus']=$this->Metatags_model->ProductSubmenu();
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/metatags/category-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  public function product_metas($category_id =0,$depth=0)
  {
   $this->load->Model(admin.'/Product_model');
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('metatags/product-default-metas');
   $this->data['active_submodule']="product-default-metas";
   $this->data['submodule_details']=$this->Login_model->GetModuleDetails($this->data['active_module']."/".$this->data['active_submodule']);  

   $this->data['section']="product-metas";
   $this->data['section_name']="Product pages";
   $this->data['title'].=$this->data['section_name'];
   $this->data['page_type']="PRODUCTS";
 
   

  // $this->data['drop_down_attributes']=$this->Metatags_model->GetCategoryDropDownAttribute();
   $this->data['category_id']=$category_id;
   $this->data['depth']=$depth;
  
   $this->data['navigation_attributes']=$this->Product_model->CategoryNavigationAttributes($this->data['category_id'],$this->data['depth']);   

  
   $this->data['category_navigation']=$this->Product_model->GetCategoryNavigationForProducts($this->data['category_id'],$this->data['depth']);
 
  
   $this->data['all_pages']=array();
   if(!empty($this->data['category_id'])) 
   {
    $this->data['all_pages']=$this->Metatags_model->GetProductList($this->data['category_id']);	 
	$this->data['category_details']=$this->Metatags_model->GetCategoryDetails($this->data['category_id']);  
   }
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['submenus']=$this->Metatags_model->ProductSubmenu();
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/metatags/product-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  public function blog_default_metas()
  {
   $this->data['all_pages']=$this->Metatags_model->GetDefaultBlogPage();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="BLOGS";
   $this->data['submenus']=$this->Metatags_model->BlogSubmenu();
   $this->data['section']="blog-default-metas";
   $this->data['section_name']="Blog Page";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/metatags/blog-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  public function blog_category_metas()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('metatags/blog-default-metas');
   $this->data['active_submodule']="blog-default-metas";
   $this->data['submodule_details']=$this->Login_model->GetModuleDetails($this->data['active_module']."/".$this->data['active_submodule']);   
   $this->data['section']="blog-category-metas";
   $this->data['section_name']="Blog Category pages";
   $this->data['title'].=$this->data['section_name'];
   $this->data['all_pages']=$this->Metatags_model->GetBlogCategoriesList();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="BLOGS_CATEGORIES";
   $this->data['submenus']=$this->Metatags_model->BlogSubmenu();
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/metatags/blog-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  
  public function blog_archive_metas()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('metatags/blog-default-metas');
   $this->data['active_submodule']="blog-default-metas";
   $this->data['submodule_details']=$this->Login_model->GetModuleDetails($this->data['active_module']."/".$this->data['active_submodule']);   
   $this->data['section']="blog-archive-metas";
   $this->data['section_name']="Blog Archive pages";
   $this->data['title'].=$this->data['section_name'];
   $this->data['all_pages']=$this->Metatags_model->GetBlogArchiveList();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="BLOGS_ARCHIVE";
   $this->data['submenus']=$this->Metatags_model->BlogSubmenu();
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/metatags/blog-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  }  
  
  public function blog_metas()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('metatags/blog-default-metas');
   $this->data['active_submodule']="blog-default-metas";
   $this->data['submodule_details']=$this->Login_model->GetModuleDetails($this->data['active_module']."/".$this->data['active_submodule']);  

   $this->data['section']="blog-metas";
   $this->data['section_name']="Blog pages";
   $this->data['title'].=$this->data['section_name'];

  
   $this->data['all_pages']=array();
  
   $this->data['all_pages']=$this->Metatags_model->GetBlogList();	 
   
  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="BLOGS";
   $this->data['submenus']=$this->Metatags_model->BlogSubmenu();
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/metatags/blog-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  
   
  public function blog_notifications($values=array())
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('metatags/blog-default-metas');
   $this->data['active_submodule']="blog-default-metas";
   if(count($values) == 0)
   {
    $values=$this->Metatags_model->GetBlogEmailInformation();
   }
   else
   {
    $this->data['title'].=$values['title'];
   }
   $this->data['submodule_details']=$this->Login_model->GetModuleDetails($this->data['active_module']."/".$this->data['active_submodule']);   
   $this->data['section']="blog-notifications";
   $this->data['section_name']="Blog Notifications";

   $this->data['page_type']="BLOGS";
   $this->data['submenus']=$this->Metatags_model->BlogSubmenu();
   $this->data['last_modified']=$this->Login_model->LastModify(BLOG_NOTIFICATIONS);   
   $this->data['attributes']=$this->Metatags_model->GetBlogEmailFormAttribute($values);
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/metatags/blog-notifications',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function validateblognotifications()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('metatags/blog-default-metas');
   $this->data['active_submodule']="blog-default-metas";
   $values=array();
   $values['title']="Validate Blog Notifications Email Id";
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $values['blog_to_emailid']=$this->input->post('blog_to_emailid');
   $this->form_validation->set_rules('blog_to_emailid', 'Receiver email id', 'trim|required|callback_email_validation');
   $values['blog_cc_emailid']=$this->input->post('blog_cc_emailid');
   if(!empty($values['blog_cc_emailid']))
   {
    $this->form_validation->set_rules('blog_cc_emailid', 'Receiver email id to cc', 'callback_email_validation');
   }
   $values['blog_bcc_emailid']=$this->input->post('blog_bcc_emailid');
   if(!empty($values['blog_bcc_emailid']))
   {
    $this->form_validation->set_rules('blog_bcc_emailid', 'Receiver email id to bcc', 'callback_email_validation');
   }
   
   if($this->form_validation->run() == FALSE)
   { 
    $this->blog_notifications($values); 
   }
   else
   {
    $records['blog_to_emailid']=$values['blog_to_emailid'];
    $records['blog_cc_emailid']=$values['blog_cc_emailid'];
	$records['blog_bcc_emailid']=$values['blog_bcc_emailid'];
	$this->Metatags_model->UpdateBlogEmailSettings($records);
	$this->RedirectPage(admin.'/metatags/blog-notifications','Notification details updated successfully');
   }
  }   
  public function email_validation($emails)
  {
   $this->load->library('CommonFunctions');	
   $emails=trim($emails);
   $all_emails=explode(",",$emails);
   $error=false;
   if(count($all_emails) > 0)
   {
    foreach($all_emails as $email)
	{
     if(!($this->commonfunctions->is_email($email)))
	 {
      $this->form_validation->set_message('email_validation', 'Email addresses are not valid');
	  return false;
	  break;
	 }
	}
   } 
   if($error == false)
   {
    return true;
   }
  }  
  
  public function AddMetaTags($page_type,$page_id,$main_section,$section,$values=array())
  {
   $this->adminjavascript->include_admin_js=array('ValidateMetatagsFormJs');
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['heading']=$values['heading'];
	$this->data['page_id']=$values['page_id'];
	$this->data['page_type']=$values['page_type'];
    $this->data['section']=$values['section']; 
    $this->data['main_section']=$values['main_section']; 
   }
   else
   {
    $this->data['title'].=" Add Meta / Title Tags";
	$this->data['heading']=$this->Metatags_model->GetMetaPageHeading($page_type,$page_id);
	$this->data['page_id']=urldecode($page_id);
	$this->data['page_type']=$page_type;
    $section=str_replace("_","-",$section);
    $this->data['section']=$section;
    $this->data['main_section']=$main_section; 

	$values=$this->Metatags_model->GetMetaTags($page_type,$page_id,str_replace("_","-",urldecode($this->data['heading'])));
	if($this->data['page_id'] != '0' and ($this->data['section'] !="single-page-metas") and ($this->data['section'] !="blog-archive-metas"))
	{
	 if($this->data['page_type'] == "PRODUCTS")
	 {
	  $values['url']=$this->Metatags_model->GetUrlValue(CATEGORY_TO_PRODUCTS,$this->data['page_id']);
	 }
	 else
	 {
	  $values['url']=$this->Metatags_model->GetUrlValue(strtolower($this->data['page_type']),$this->data['page_id']);
	 }
	}
   } 
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('metatags/'.$this->data['section']);	  
   $this->data['meta_id']=$values['meta_id']; 
   if(!empty($this->data['meta_id']))
   {
    $this->data['last_modified']=$this->Login_model->LastModify(META_TAGS,$this->data['meta_id']);   
   }
   if($this->data['page_id'] != '0' and ($this->data['section'] !="single-page-metas") and ($this->data['section'] !="blog-archive-metas"))
   {
    $this->data['attributes']=$this->Metatags_model->GetMetaTagsUrlFormAttributes($values);
   }
   else
   {
    $this->data['attributes']=$this->Metatags_model->GetMetaTagsFormAttributes($values);
   }
   $this->load->view(admin.'/metatags/add-metatags',$this->data);
  }
  public function validatemetatags()
  {
   $values['section']=$this->input->post('section');
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('metatags/'.$values['section']);
   $values=array();
   $values['title']="Validate Meta / Title tags";
   $values['current_image']=$this->input->post('current_image');

   $values['page_id']=$this->input->post('page_id');
   $values['page_type']=$this->input->post('page_type');
   $values['heading']=$this->input->post('heading');
   $values['meta_id']=$this->input->post('meta_id');
   $values['section']=$this->input->post('section');
   $values['main_section']=$this->input->post('main_section');

   $values['page_title']=$this->input->post('page_title');
   $values['meta_keyword']=$this->input->post('meta_keyword');
   $values['meta_description']=$this->input->post('meta_description');
   $values['json_code']=$this->input->post('json_code');
   
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','Please enter {field}');
   $this->form_validation->set_rules('page_title', 'title', 'trim|required');
   
   if($values['page_id'] != '0' and ($values['section'] !="single-page-metas") and ($values['section'] !="blog-archive-metas"))
   {
    $values['url']=$this->input->post('url');
	$values['url'] = trim(strtolower(str_replace(" ","-",$this->commonfunctions->RemoveSpecialChars($values['url']))));
	// arguments : 1.page_type(table_name), 2.url_field,3.url_value 4.id_value, 5. Parent_field and 6.parent_id_value
    if($values['page_type'] == "PRODUCTS")
	{
	 $cat_id=$this->Metatags_model->GetCategoryId($values['page_id'])	;
     $url_info=array(CATEGORY_TO_PRODUCTS,'url',$values['url'],$values['page_id'],"cat_id",$cat_id);
	}
	else
	{	
     $url_info=array(strtolower($values['page_type']),'url',$values['url'],$values['page_id'],"","");
	}
    $url_info_string=implode("~",$url_info);
	$this->form_validation->set_rules('url', 'url', "trim|required|callback__IsUrlUnique[{$url_info_string}]");
   } 
 
   if($this->form_validation->run() == FALSE)   
   { 
    $this->AddMetaTags('','','','',$values);
   }
   else
   {
    $records=array();
	$records['page_title']=$values['page_title'];
	$records['meta_keyword']=$values['meta_keyword'];
	$records['meta_description']=$values['meta_description'];
	$records['json_code']=$values['json_code'];
	

    $records['page_id']=$values['page_id'];
	$records['page_type']=$values['page_type'];

    $message=$this->Metatags_model->SetMetaTags($records,$values['meta_id']); 
	switch($values['page_type'])
	{
	 case "SERVICES":
     $this->data['redirect_url']=admin."/metatags/service-metas";
	 $url_table=SERVICES;
	 break;
	 case "NEWS":
     $this->data['redirect_url']=admin."/metatags/news-metas";
	 $url_table=NEWS;
     break;
	 case "PROJECTS":
     $this->data['redirect_url']=admin."/metatags/project-default-metas";
	 $url_table=PROJECTS;
     break;
	 
	 case "PRODUCTS":
	 if($values['page_id'] == '0') $this->data['redirect_url']=admin."/metatags/product-default-metas/";
	 else
	 {
	  $category_id=$this->Metatags_model->GetCategoryId($values['page_id']);
	  $category_details=$this->Metatags_model->GetCategoryDetails($category_id);	 
      $this->data['redirect_url']=admin."/metatags/product-metas/".$category_id."/".$category_details['depth'];
	  $url_table=CATEGORY_TO_PRODUCTS;
	 }
     break;
	 case "CATEGORIES":
	 $category_details=$this->Metatags_model->GetCategegoryInformation($records['page_id']);
     $this->data['redirect_url']=admin."/metatags/category-metas/".$category_details['parent_id']."/".$category_details['depth'];
	 $url_table=CATEGORIES;
     break;
	 case "BLOGS_ARCHIVE":
     $this->data['redirect_url']=admin."/metatags/blog-archive-metas";
     break;
	 
	 case "BLOGS_CATEGORIES":
     $this->data['redirect_url']=admin."/metatags/blog-category-metas";
	 $url_table=BLOGS_CATEGORIES;
     break;
	 
	 case "BLOGS":
     if($values['page_id'] == '0') $this->data['redirect_url']=admin."/metatags/blog-default-metas";
	
	 else
	 {
	  $this->data['redirect_url']=admin."/metatags/blog-metas";
	  $url_table=BLOGS;
	 }
     break;

	 case "ABOUT_SECTION":
      $this->data['redirect_url']=admin."/metatags/about-section-metas";
	  $url_table=ABOUT_SECTION;
	 break;
	 
	 default:
     $this->data['redirect_url']=admin."/metatags/single-page-metas";
     break;
	}
	if(isset($url_table) and !empty($url_table) and $values['page_id'] != '0')
	{
	 $this->Metatags_model->UpdateURL($url_table,$values['url'],$values['page_id']);
	}
    $this->RedirectPopupPage($this->data['redirect_url'],$message);
   }
  }  
  public function _IsUrlUnique($url,$url_info_string)
  {
   list($table_name,$url_field,$url_value,$id_value,$parent_field,$parent_value)=explode("~",$url_info_string);
   if($this->Login_model->IsDuplicateUrl($table_name,$url_field,$url_value,$id_value,$parent_field,$parent_value))
   {
    $this->form_validation->set_message('_IsUrlUnique','URL already exists');
    return false;
   }
  }
 }
