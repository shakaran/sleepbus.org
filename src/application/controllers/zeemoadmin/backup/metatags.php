<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Metatags extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->Model('admin/Metatags_model');
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
   $this->load->view('admin/templates/header',$this->data);
   $this->load->view('admin/metatags/item-list-page',$this->data);
   $this->load->view('admin/templates/footer');
  } 
  public function service_metas()
  {
   $this->data['all_pages']=$this->Metatags_model->GetServiceList();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="SERVICES";
   $this->data['section']="service-metas";
   $this->data['section_name']="Services";
   $this->load->view('admin/templates/header',$this->data);
   $this->load->view('admin/metatags/item-list-page',$this->data);
   $this->load->view('admin/templates/footer');
  } 
  public function reference_metas()
  {
   $this->data['all_pages']=$this->Metatags_model->GetReferenceList();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="PROJECTS";
   $this->data['section']="reference-metas";
   $this->data['section_name']="References";
   $this->load->view('admin/templates/header',$this->data);
   $this->load->view('admin/metatags/item-list-page',$this->data);
   $this->load->view('admin/templates/footer');
  } 
  public function news_metas()
  {
   $this->data['all_pages']=$this->Metatags_model->GetNewsList();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="NEWS";
   $this->data['section']="news-metas";
   $this->data['section_name']="News";
   $this->load->view('admin/templates/header',$this->data);
   $this->load->view('admin/metatags/item-list-page',$this->data);
   $this->load->view('admin/templates/footer');
  } 
  public function product_default_metas()
  {
   $this->data['all_pages']=$this->Metatags_model->GetDefaultProductPage();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="PRODUCTS";
   $this->data['submenus']=$this->Metatags_model->ProductSubmenu();
   $this->data['section']="product-default-metas";
   $this->data['section_name']="Product Page";
   $this->load->view('admin/templates/header',$this->data);
   $this->load->view('admin/metatags/product-list-page',$this->data);
   $this->load->view('admin/templates/footer');
  } 
  public function category_metas()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('banners/product-default-metas');
   $this->data['active_submodule']="product-default-metas";
   $this->data['submodule_details']=$this->Login_model->GetModuleDetails($this->data['active_module']."/".$this->data['active_submodule']);   
   $this->data['section']="category-metas";
   $this->data['section_name']="Category pages";
   $this->data['title'].=$this->data['section_name'];
   $this->data['all_pages']=$this->Metatags_model->GetCategoriesList();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="CATEGORIES";
   $this->data['submenus']=$this->Metatags_model->ProductSubmenu();
   $this->load->view('admin/templates/header',$this->data);
   $this->load->view('admin/metatags/product-list-page',$this->data);
   $this->load->view('admin/templates/footer');
  } 
  public function product_metas($category_id = '')
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('banners/product-default-metas');
   $this->data['active_submodule']="product-default-metas";
   $this->data['submodule_details']=$this->Login_model->GetModuleDetails($this->data['active_module']."/".$this->data['active_submodule']);  

   $this->data['section']="product-metas";
   $this->data['section_name']="Product pages";
   $this->data['title'].=$this->data['section_name'];

   $this->data['drop_down_attributes']=$this->Metatags_model->GetCategoryDropDownAttribute();
   $this->data['category_id']=$category_id;
   $this->data['all_pages']=array();
   if(!empty($this->data['category_id'])) 
   {
    $this->data['all_pages']=$this->Metatags_model->GetProductList($this->data['category_id']);	 
	$category_details=$this->Metatags_model->GetCategoryDetails($category_id);
   }
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateMetatagsFormJs');
   $this->data['page_type']="PRODUCTS";
   $this->data['submenus']=$this->Metatags_model->ProductSubmenu();
   $this->load->view('admin/templates/header',$this->data);
   $this->load->view('admin/metatags/product-list-page',$this->data);
   $this->load->view('admin/templates/footer');
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
	$this->data['heading']=$this->Metatags_model->GetMetaPageHeading($section,$page_type,$page_id);
	$this->data['page_id']=$page_id;
	$this->data['page_type']=$page_type;
    $section=str_replace("_","-",$section);
    $this->data['section']=$section;
    $this->data['main_section']=$main_section; 

	$values=$this->Metatags_model->GetMetaTags($page_type,$page_id,str_replace("_","-",urldecode($this->data['heading'])));
	if($this->data['page_id'] != '0' and ($this->data['section'] !="single-page-metas"))
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
   if($this->data['page_id'] != '0' and ($this->data['section'] !="single-page-metas"))
   {
    $this->data['attributes']=$this->Metatags_model->GetMetaTagsUrlFormAttributes($values);
   }
   else
   {
    $this->data['attributes']=$this->Metatags_model->GetMetaTagsFormAttributes($values);
   }
   $this->load->view('admin/metatags/add-metatags',$this->data);
  }
  public function validatemetatags()
  {
   $values['section']=$this->input->post('section');
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('banners/'.$values['section']);
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
   
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','Please enter %s');
   $this->form_validation->set_rules('page_title', 'title', 'trim|required');
   
   if($values['page_id'] != '0' and ($values['section'] !="single-page-metas"))
   {
    $values['url']=$this->input->post('url');
	$values['url'] = trim(strtolower(str_replace(" ","-",$this->commonfunctions->RemoveSpecialChars($values['url']))));
	// arguments : 1.page_type(table_name), 2.url_field,3.url_value 4.id_value, 5. Parent_field and 6.parent_id_value
    if($values['page_type'] == "PRODUCTS")
	{
     $url_info=array(CATEGORY_TO_PRODUCTS,'url',$values['url'],$values['page_id'],"","");
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
	

    $records['page_id']=$values['page_id'];
	$records['page_type']=$values['page_type'];

    $message=$this->Metatags_model->SetMetaTags($records,$values['meta_id']); 
    $this->session->set_flashdata('success_message',$message);
	switch($values['page_type'])
	{
	 case "SERVICES":
     $this->data['redirect_url']="admin/metatags/service-metas";
	 $url_table=SERVICES;
	 break;
	 case "PROJECTS":
     $this->data['redirect_url']="admin/metatags/reference-metas";
	 $url_table=PROJECTS;
     break;
	 case "NEWS":
     $this->data['redirect_url']="admin/metatags/news-metas";
	 $url_table=NEWS;
     break;
	 case "PRODUCTS":
	 if($values['page_id'] == '0') $this->data['redirect_url']="admin/metatags/product-default-metas/";
	 else
	 {
	  $category_id=$this->Metatags_model->GetCategoryId($values['page_id']);	 
      $this->data['redirect_url']="admin/metatags/product-metas/".$category_id;
	  $url_table=CATEGORY_TO_PRODUCTS;
	 }
     break;
	 case "CATEGORIES":
     $this->data['redirect_url']="admin/metatags/category-metas";
	 $url_table=CATEGORIES;
     break;
	 default:
     $this->data['redirect_url']="admin/metatags/single-page-metas";
     break;
	}
	if(isset($url_table) and !empty($url_table) and $values['page_id'] != '0')
	{
	 $this->Metatags_model->UpdateURL($url_table,$values['url'],$values['page_id']);
	}
    $this->AddMetaTags('','','','',$values);
   }
  }  
  public function _IsUrlUnique($url,$url_info_string)
  {
   list($table_name,$url_field,$url_value,$id_value,$parent_field,$parent_value)=explode("~",$url_info_string);
   if($table_name == CATEGORIES or $table_name == CATEGORY_TO_PRODUCTS)
   {
    if($this->Login_model->IsDuplicateUrl($table_name,$url_field,$url_value,$id_value,'',''))
    {
     $this->form_validation->set_message('_IsUrlUnique','URL already exists');
     return false;
    }
   }
   elseif($this->Login_model->IsDuplicateUrlInSameTable($table_name,$url_field,$url_value,$id_value,'',''))
   {
    $this->form_validation->set_message('_IsUrlUnique','URL already exists');
    return false;
   }
   else
   {	  
    return true;
   }
  }
 }
