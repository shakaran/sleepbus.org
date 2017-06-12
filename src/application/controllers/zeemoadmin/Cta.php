<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Cta extends MY_Controller
 {
  public $uploading_image_info; 

  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Cta_model');
   $this->load->helper('form');
   $this->load->library('CommonFunctions');	
  }
    
  public function icon_setting($values=array())
  {
   $this->SetUpCkeditor(); 	  	  
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('cta/icon-setting');
   $this->data['active_submodule']="icon-setting";
   if(count($values) > 0)
   {
    $this->data['title'].="";
	$this->data['page_title']="Edit CTA";
   }
   else 
   {
    $this->data['title'].="CTA Settings";	 
    $this->data['page_title']="Add CTA";
    $values['section_icon_name']="";
	$values['intro_text'] = "";
	$values['url']=""; 
   }
   if(!empty($this->data['icon_id']))
   {
    $this->data['attributes']=$this->Cta_model->GetIconSettingFormAttribute($values,$this->data['icon_id']);
   }
   else
   {
    $this->data['attributes']=$this->Cta_model->GetIconSettingFormAttribute($values);
   }
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCtaFormJs','DragDropJs');
   $this->load->helper('form');  
     
   $this->data['icon_list']=$this->Cta_model->GetIconList();
   if(count($this->data['icon_list']) > 0)
   {
    /******************************************
    Arguments for GetAtributesForDeletion function : 
    1. item list to be deleted, 2. which type of item to be deleted, 3. single delete permission-> value would be 'yes' or 'no' and 
    4. parent_id if you have(optional);
    *****************************************/
    $this->data['attribute']=$this->Login_model->GetAtributesForDeletion($this->data['icon_list'],'icon','no');
   }
   //$this->data['section_url'] = "icon-setting";
   //$this->data['section_name'] = "Logo Settings";
     
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/cta/icon-setting',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function edit_icon($icon_id)
  {
   $values=array();
   $values=$this->Cta_model->GetIconDetails($icon_id);
   	  
   $values['page_title'] = "Edit CTA";
   //$values['title'] = "Edit CTA";
   $values['submit_value'] = "Update";
   //$this->data['page_title'] = "Edit CTA";
   $this->data['last_modified']=$this->Login_model->LastModify(ICON_SETTINGS,$icon_id);
   $this->data['icon_id']=$icon_id;
   $this->icon_setting($values);
  }
  public function validateiconsetting()
  {
   $values=array();

   $values['section_icon_name']=$this->input->post('section_icon_name');
   $values['intro_text']=$this->input->post('intro_text');
   $values['url']=$this->input->post('url');
   
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','%s');
   $this->form_validation->set_rules('intro_text','Please enter CTA content',"trim|required");
   if($values['url'] != '') $this->form_validation->set_rules('url','Invalid URL','trim|callback__validateURL');
      
   $icon_id=$this->input->post('icon_id');
   $this->data['icon_id']=$icon_id;
   if(!empty($icon_id))
   {
	if($values['section_icon_name']=='') $this->form_validation->set_rules('section_icon_name','Please enter CTA title',"trim|required");  
    else $this->form_validation->set_rules('section_icon_name', 'CTA title', 'trim|callback_is_unique_on_update['.ICON_SETTINGS.'~section_icon_name~'.$icon_id.'~CTA title]');
   }
   else
   {
	if($values['section_icon_name']=='') $this->form_validation->set_rules('section_icon_name','Please enter CTA title',"trim|required");  
    else $this->form_validation->set_rules('section_icon_name', 'CTA title', 'trim|is_unique['.ICON_SETTINGS.'.section_icon_name]');
   }

   if($this->form_validation->run()==FALSE)
   { 
    $this->icon_setting($values);
   }
   else
   {
	$records=array();
	$records['section_icon_name']=trim($values['section_icon_name']);
	$records['url']=$values['url'];
	$records['intro_text']=$values['intro_text'];
	
	if(!empty($icon_id))
	{
	 $this->Cta_model->UpdateIconSettingRecords($this->data['icon_id'],$records);
	 $message="CTA updated successfully";
	}
	else
	{
	 $this->Cta_model->InsertIconSettingRecords($records);
	 $message="CTA added successfully";
    }
	$this->RedirectPage(admin.'/cta/icon-setting',$message);
   }
  }

  public function single_pages()
  {
   $this->data['all_pages']=$this->Cta_model->GetAllSinglePagesList();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCtaFormJs');
   $this->data['page_type']="SINGLE_PAGE";
   $this->data['section']="single-pages";
   $this->data['section_name']="single page cta";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/cta/item-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  public function blog_default_cta()
  {
   $this->data['all_pages']=$this->Cta_model->GetDefaultBlogPage();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCtaFormJs');
   $this->data['page_type']="BLOGS";
   $this->data['submenus']=$this->Cta_model->BlogSubmenu();
   $this->data['section']="blog-default-cta";
   $this->data['section_name']="Blog Page";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/cta/blog-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  public function blog_category()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('cta/blog-default-cta');
   $this->data['active_submodule']="blog-default-cta";
   $this->data['submodule_details']=$this->Login_model->GetModuleDetails($this->data['active_module']."/".$this->data['active_submodule']); 

   $this->data['section']="blog-category";
   $this->data['section_name']="Blog Category pages";
   $this->data['title'].=$this->data['section_name'];
   $this->data['all_pages']=array();
   $this->data['all_pages']=$this->Cta_model->GetBlogCategoriesList();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCtaFormJs');
   $this->data['page_type']="BLOGS_CATEGORIES";
   $this->data['submenus']=$this->Cta_model->BlogSubmenu();
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/cta/blog-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  
  public function blog_archive()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('cta/blog-default-cta');
   $this->data['active_submodule']="blog-default-cta";
   $this->data['submodule_details']=$this->Login_model->GetModuleDetails($this->data['active_module']."/".$this->data['active_submodule']); 
   $this->data['section']="blog-archive";
   $this->data['section_name']="Blog Archive pages";
   $this->data['title'].=$this->data['section_name'];
   $this->data['all_pages']=$this->Cta_model->GetBlogArchiveList();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCtaFormJs');
   $this->data['page_type']="BLOGS_ARCHIVE";
   $this->data['submenus']=$this->Cta_model->BlogSubmenu();
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/cta/blog-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  }  
  
  public function blogs()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('cta/blog-default-cta');
   $this->data['active_submodule']="blog-default-cta";
   $this->data['submodule_details']=$this->Login_model->GetModuleDetails($this->data['active_module']."/".$this->data['active_submodule']);  
   $this->data['section']="blogs";
   $this->data['section_name']="Blog pages";
   $this->data['title'].=$this->data['section_name'];
   $this->data['all_pages']=array();
   $this->data['all_pages']=$this->Cta_model->GetBlogList();	 
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCtaFormJs');
   $this->data['page_type']="BLOGS";
   $this->data['submenus']=$this->Cta_model->BlogSubmenu();
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/cta/blog-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  }

  public function news_default_cta()
  {
   $this->data['all_pages']=$this->Cta_model->GetDefaultNewsPage();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCtaFormJs');
   $this->data['page_type']="NEWS";
    $this->data['section']="news-default-cta";
   $this->data['section_name']="News Page";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/cta/news-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  public function project_default_cta()
  {
   $this->data['all_pages']=$this->Cta_model->GetDefaultProjectPage();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCtaFormJs');
   $this->data['page_type']="PROJECTS";
    $this->data['section']="project-default-cta";
   $this->data['section_name']="Project Page";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/cta/item-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 

  public function landing_page_cta()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('cta/landing-page-cta');
   $this->data['all_pages']=$this->Cta_model->GetAllLandingPages();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCtaFormJs');
   $this->data['page_type']="LANDING_PAGE";
   $this->data['section']="landing-page-cta";
   $this->data['section_name']="Landing Page";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/cta/landing-pages',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 

  public function about_section_cta()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('cta/about-section-cta');	  
   $this->data['all_pages']=$this->Cta_model->GetAllAboutPages();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCtaFormJs');
   $this->data['page_type']="ABOUT_SECTION";
   $this->data['section']="about-section-cta";
   $this->data['section_name']="About Section";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/cta/about-section-pages',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 

  public function product_default_cta()
  {
   $this->data['all_pages']=$this->Cta_model->GetDefaultProductPage();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCtaFormJs');
   $this->data['page_type']="PRODUCTS";
   $this->data['section']="product-default-cta";
   $this->data['submenus']=$this->Cta_model->ProductSubmenu();
   $this->data['section_name']="Product Page";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/cta/product-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  public function category_cta($parent_id=0,$depth=0)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('cta/product-default-cta');
   $this->data['active_submodule']="product-default-cta";
   $this->data['submodule_details']=$this->Login_model->GetModuleDetails($this->data['active_module']."/".$this->data['active_submodule']);  
   $this->data['section']="category-cta";
   $this->data['section_name']="Category pages";
   $this->data['title'].=$this->data['section_name'];
   
   $this->load->Model(admin.'/Product_model');
   
   $this->data['parent_id']=$parent_id;
   $this->data['depth']=$depth;
   $this->data['category_list'] = $this->Cta_model->GetCategoriesList($this->data['parent_id']);
   $this->data['is_subcategory']=$this->Product_model->GetCategoryListWithoutSubcateories($this->data['category_list']);
   $this->data['category_navigation']=$this->Product_model->GetCategoryNavigation($this->data['parent_id'],$this->data['depth']);
   
   if($this->data['parent_id'] != 0)
   {
    $this->data['parent_category_drop_down_attribute']=$this->Product_model->ParentCategoryDropDownAttributes($this->data['parent_id']);
   }




 //  $this->data['all_pages']=$this->Cta_model->GetDefaultProductPage();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCtaFormJs');
   $this->data['page_type']="CATEGORIES";
   $this->data['submenus']=$this->Cta_model->ProductSubmenu();
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/cta/category-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 

  public function product_cta($category_id =0,$depth=0)
  {
   $this->load->Model(admin.'/Product_model');
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('cta/product-default-cta');
   $this->data['active_submodule']="product-default-cta";
   $this->data['submodule_details']=$this->Login_model->GetModuleDetails($this->data['active_module']."/".$this->data['active_submodule']);  

   $this->data['section']="product-cta";
   $this->data['section_name']="Product pages";
   $this->data['title'].=$this->data['section_name'];
   $this->data['page_type']="PRODUCTS";
  // $this->data['drop_down_attributes']=$this->Cta_model->GetCategoryDropDownAttribute();
   $this->data['category_id']=$category_id;
   $this->data['depth']=$depth;
  
   $this->data['navigation_attributes']=$this->Product_model->CategoryNavigationAttributes($this->data['category_id'],$this->data['depth']);   
 
   $this->data['category_navigation']=$this->Product_model->GetCategoryNavigationForProducts($this->data['category_id'],$this->data['depth']);
   $this->data['all_pages']=array();
   if(!empty($this->data['category_id'])) 
   {
    $this->data['all_pages']=$this->Cta_model->GetProductList($this->data['category_id']);	 
	$this->data['category_details']=$this->Cta_model->GetCategoryDetails($this->data['category_id']);  
   }
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateCtaFormJs');
   $this->data['submenus']=$this->Cta_model->ProductSubmenu();
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/cta/product-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  

  public function AddCta($page_type,$page_id,$main_section,$section,$values=array())
  {
   $this->adminjavascript->include_admin_js=array('ValidateCtaFormJs');
 
   if(count($values) > 0)
   { 
    $this->data['title'].=$values['title'];
	$this->data['cta_title']=$values['cta_title'];
	$this->data['page_id']=$values['page_id'];
	$this->data['page_type']=$values['page_type'];
    $this->data['section']=$values['section']; 
    $this->data['main_section']=$values['main_section']; 
   }
   else
   {
    $this->data['title'].=" Add CTA";
    $this->data['cta_title']=$this->Cta_model->GetPageHeading($page_type,$page_id);
	$this->data['page_id']=urldecode($page_id);
	$this->data['page_type']=$page_type;
    $section=str_replace("_","-",$section);
    $this->data['section']=$section;
    $this->data['main_section']=$main_section; 
	$values=$this->Cta_model->GetHeading($page_type,$page_id);

 } 
   $this->data['cta']=$values['cta'];
  // $this->data['sub_modules']=$this->CheckSubModuleAccessibility('cta/'.$section);	  
   $this->data['cta_id']=$values['cta_id']; 	
   if(!empty($this->data['cta_id']))
   {
    $this->data['last_modified']=$this->Login_model->LastModify(CTA,$this->data['cta_id']);   
   }
   $this->data['attributes']=$this->Cta_model->GetCtaFormAttributes($values);
   $this->data['cta_info']=$this->Cta_model->GetCta();
   $this->load->view(admin.'/cta/add-top-cta',$this->data);
  }
  
  public function validatecta()
  {
   $values=array();
   $values['section']=$this->input->post('section');
   //$this->data['sub_modules']=$this->CheckSubModuleAccessibility('cta/'.$values['section']);

   $values['title']="Validate CTA";
   $values['current_image']=$this->input->post('current_image');

   $values['page_id']=$this->input->post('page_id');
   $values['page_type']=$this->input->post('page_type');
   $values['cta_title']=$this->input->post('cta_title');
   $values['cta_id']=$this->input->post('cta_id');
   $values['section']=$this->input->post('section');
   $values['main_section']=$this->input->post('main_section');

   $values['cta']=$this->input->post('cta');
   
   $this->load->library('form_validation'); 
   
 
   if($this->form_validation->run() == FALSE)   
   { 
    $this->AddCta('','','','',$values);
   }
   else
   {
  
    $records=array();
	 if(!empty($values['cta']))
	{
	$cta_arr=implode(",",$values['cta']);
	}
	else $cta_arr="";
	$records['cta']=$cta_arr;
	

    $records['page_id']=$values['page_id'];
    $records['page_type']=$values['page_type'];

    $message=$this->Cta_model->SetTopHeading($records,$values['cta_id']); 

	switch($values['page_type'])
	{
	 case "BLOGS_CATEGORIES":
     $this->data['redirect_url']=admin."/cta/blog-category";
	 $url_table=BLOGS_CATEGORIES;
     break;
	 
	 case "BLOGS_ARCHIVE":
     $this->data['redirect_url']=admin."/cta/blog-archive";
     break;
	 
	 case "BLOGS":
     if($values['page_id'] == '0') $this->data['redirect_url']=admin."/cta/blog-default-cta";
	
	 else
	 {
	  $this->data['redirect_url']=admin."/cta/blogs";
	  $url_table=BLOGS;
	 }
     break;
	 
	 case "CATEGORIES":
	 $category_details=$this->Cta_model->GetCategegoryInformation($records['page_id']);
     $this->data['redirect_url']=admin."/cta/category-cta/".$category_details['parent_id']."/".$category_details['depth'];
	 $url_table=CATEGORIES;
     break;

     case "PRODUCTS":
	 if($values['page_id'] == '0') $this->data['redirect_url']=admin."/cta/product-default-cta/";
	 else
	 {
	  $category_id=$this->Cta_model->GetCategoryId($values['page_id']);
	  $category_details=$this->Cta_model->GetCategoryDetails($category_id);	 
      $this->data['redirect_url']=admin."/cta/product-cta/".$category_id."/".$category_details['depth'];
	  $url_table=CATEGORY_TO_PRODUCTS;
	 }
     break;	 
	 
	 case "NEWS":
     $this->data['redirect_url']=admin."/cta/news-default-cta";
	 $url_table=NEWS;
     break;
	 case "PROJECTS":
     $this->data['redirect_url']=admin."/cta/project-default-cta";
	 $url_table=PROJECTS;
     break;
	 
	 case "ABOUT_SECTION":
      $this->data['redirect_url']=admin."/cta/about-section-cta";
	  $url_table=ABOUT_SECTION;
     break;

	 case "LANDING_PAGE":
      $this->data['redirect_url']=admin."/cta/landing-page-cta";
	  $url_table=LANDINGPAGE;
     break;
	 
	 default:
     $this->data['redirect_url']=admin."/cta/single-pages";
     break;
	}
    $this->RedirectPopupPage($this->data['redirect_url'],$message);
   }
  }
  
  
  
  public function changestatus($record_id, $status, $section, $parent_id = "")
  {
  $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('cta/icon-setting');
  
  $section = str_replace("_","-",$section); 
  if($section=="icon-setting")
  { 
   $this->Login_model->ChangeStatus(ICON_SETTINGS,$record_id,$status);
   $this->session->set_flashdata('success_message','Status of icon changed successfully');

	  }
   if(!empty($parent_id))
   {
    $section.="/$parent_id";
   }
   header("location:".base_url().admin."/cta/$section");
   exit;
  } 
  public function ConfirmDelete($checked_id, $item_name, $parent_id = '') 
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('cta/icon-setting');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_id, $item_name, $parent_id);
  
   /*
   If you have any additional attribute item wise then you can merge it as follows  : 
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   If you have any custom message other than common message item wise then assign message to data variable as follows
   Default message
   */
   if($item_name=="icon")
   {
    $this->data['message'] = "Are you sure want to delete this icon.";
   }
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js = array('ConfirmDeleteJs');
   $this->load->view(admin.'/templates/confirm-delete',$this->data);
  }
  
  //mandatory Function for each module
  public function ConfirmSuperadmin($checked_ids,$item_name,$parent_id='') 
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('cta/icon-setting');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_ids, $item_name, $parent_id);
   /*
   If you have any additional attribute item wise then you can merge it as follows  : 
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   If you have any custom message other than common message item wise then assign message to data variable as follows
   Default message
   */
   
   $this->data['message']="Are you sure want to delete all selected item(s)";
      
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js=array('SuperAdminValidationJs');
   $this->admincss->including_css_func=array('PrettyPhotoCss');  
   $this->load->view(admin.'/templates/superadmin-delete',$this->data);
  }  
  
  //mandatory Function for each module
  public function DeleteRecord($checked_ids, $item_name, $parent_id='') 
  {
   $item_name = urldecode($item_name);
   $all_ids = explode("~",$checked_ids);
   
   // Delete Record item wise and redirect the page to repective module with success message
   if($item_name=="icon")
   {
    if(count($all_ids) > 0)
	{
	 $this->Cta_model->DeleteIcon($all_ids);
	 $this->RedirectPage(admin.'/cta/icon-setting','Icon deleted successfully');
	}
   } 
  }
 
 }
