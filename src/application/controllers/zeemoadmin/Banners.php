<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Banners extends MY_Controller
 {
  public $uploading_image_info;
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Banner_model');
   $this->load->helper('form');
   $this->load->library('CommonFunctions');	
  }
  public function homepage($banner_id='',$values=array())
  {
   $this->data['total_shown_banner']=count($this->Banner_model->GetShownBannerCount());
   $this->data['all_banners']=$this->Banner_model->GetAllHomePageBanners();
    // attrubutes for deletion of banners
   $this->data['deletion_attributes']=$this->Login_model->GetAtributesForDeletion($this->data['all_banners'],'banner','no');
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','DragDropJs','ValidateBannersFormJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/banners/homepage',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function banner_in_a_glance($banner_id='',$values=array())
  {
   $this->data['all_banners']=$this->Banner_model->GetAllBannersInAGlance();	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateBannersFormJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/banners/banner-in-a-glance',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function service_banner($service_id='')
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateBannersFormJs');
   $this->load->helper('form');    
   $this->data['service_id']=$service_id;
   $this->data['drop_down_attributes']=$this->Banner_model->GetServiceDropDownAttribute();
   if(!empty($service_id) or $service_id == '0')
   {
    $this->data['service_name']=$this->Banner_model->GetServiceName($service_id);
	$this->data['banner_details']=$this->Banner_model->GetBannerDetails($this->data['service_id'],'services');
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/banners/service-banners',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function news_banner($news_id='')
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateBannersFormJs');
   $this->load->helper('form');    
   $this->data['news_id']=$news_id;
   $this->data['drop_down_attributes']=$this->Banner_model->GetNewsDropDownAttribute();
   if(!empty($news_id) or $news_id == '0')
   {
    $this->data['news_name']=$this->Banner_model->GetNewsName($news_id);
	$this->data['banner_details']=$this->Banner_model->GetBannerDetails($this->data['news_id'],'news');
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/banners/news-banners',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function products_default_banner()
  {
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateBannersFormJs');
   $this->data['banner_details']=$this->Banner_model->GetBannerDetails('0','products');
   $this->data['submenus']=$this->Banner_model->ProductSubmenu();
   $this->data['section']="products-default-banner";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/banners/product-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  } 
  public function category_banners($parent_id=0,$depth=0)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('banners/products-default-banner');
   $this->data['active_submodule']="products-default-banner";
   $this->data['title'].="Category Banners";  
   
   $this->load->Model(admin.'/Product_model');
 
   $this->data['parent_id']=$parent_id;
   $this->data['depth']=$depth;
   
   
   
   $this->data['all_banners']=$this->Banner_model->GetCategoryBanners($this->data['parent_id']);
   
   $this->data['category_list'] = $this->Product_model->GetCategoryList($this->data['parent_id']);
   $this->data['is_subcategory']=$this->Product_model->GetCategoryListWithoutSubcateories($this->data['category_list']);
   $this->data['category_navigation']=$this->Product_model->GetCategoryNavigation($this->data['parent_id'],$this->data['depth']);
   
   if($this->data['parent_id'] != 0)
   {
    $this->data['parent_category_drop_down_attribute']=$this->Product_model->ParentCategoryDropDownAttributes($this->data['parent_id']);
   }
   
   
   
    // attrubutes for deletion of banners
   $this->data['deletion_attributes']=$this->Login_model->GetAtributesForDeletion($this->data['all_banners'],'category_banner','no');
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateBannersFormJs');
   $this->data['submenus']=$this->Banner_model->ProductSubmenu();
   $this->data['section']="category-banners";
   $this->data['page_type']="categories";
   $this->data['item_name']="Category";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/banners/category-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function product_banners($category_id=0,$depth=0)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('banners/products-default-banner');
   $this->data['active_submodule']="products-default-banner";
   $this->data['title'].="Product Banners";  

   $this->load->Model(admin.'/Product_model');

   $this->data['category_id']=$category_id;
   
   $this->data['depth']=$depth;
	
   $this->data['navigation_attributes']=$this->Product_model->CategoryNavigationAttributes($this->data['category_id'],$this->data['depth']);   
   $this->data['category_navigation']=$this->Product_model->GetCategoryNavigationForProducts($this->data['category_id'],$this->data['depth']);
  
   
   
   
   
   if(!empty($this->data['category_id'])) 
   {
    $this->data['all_banners']=$this->Banner_model->GetProductBanners($this->data['category_id']);
    // attrubutes for deletion of banners
    $this->data['deletion_attributes']=$this->Login_model->GetAtributesForDeletion($this->data['all_banners'],'product_banners','no');
   }
	  
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs','ValidateBannersFormJs');
   $this->data['submenus']=$this->Banner_model->ProductSubmenu();
   $this->data['section']="product-banners";
   $this->data['page_type']="products";
   $this->data['item_name']="Product";
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/banners/product-list-page',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function AddBanner($page_type,$page_id,$upload_banner_for,$values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('banners/banner-in-a-glance');	  
   $this->data['active_submodule']="banner-in-a-glance";
   $this->adminjavascript->include_admin_js=array('ValidateBannersFormJs');
   if(count($values) > 0)
   {
    $this->data['title'].=$values['title'];
	$this->data['page_title']=$values['page_title'];
	$this->data['page_id']=$values['page_id'];
	$this->data['banner_id']=$values['banner_id'];
	$this->data['page_type']=$values['page_type'];
   }
   else
   {
    $this->data['title'].=" Add Banner";
	$values=$this->Banner_model->GetBannerDetails($page_id,$page_type);
	if($upload_banner_for != "dynamic") $this->data['page_title']=$upload_banner_for;
	else $this->data['page_title']=$this->Banner_model->GetPageHeading($page_type,$page_id);
	$this->data['page_id']=$page_id;
	$this->data['banner_id']=$values['banner_id'];
	$this->data['page_type']=$page_type;
   }
   $this->data['image_quality']=$values['image_quality'];
  
   if(!empty($this->data['banner_id']))
   {
	if($this->data['page_type'] == "homepage" and $this->data['banner_id'] !='0')
	{
     $this->data['last_modified']=$this->Login_model->LastModify(HOMEPAGE_BANNERS,$this->data['banner_id']);   
    }
	else
	{   
     $this->data['last_modified']=$this->Login_model->LastModify(BANNERS,$this->data['banner_id']);   
	}
   }
   // if you have any remarks then assign as $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)"; other wise it takes default remarks
   if($this->data['page_type'] == "homepage")
   {
    $this->data['remarks']="Banner size must be (462 x 240) (Width x Height)";
   }

   // Image optimization attributes  
   $this->data['image_quality_options']=$this->Login_model->GetImageQualityOptions();

   $this->SetUpCkeditor();    
   $this->data['attributes']=$this->Banner_model->GetBannerFormAttributes($values);
   $this->load->view(admin.'/banners/add-banner',$this->data);
  }
  public function validatebanner()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('banners/banner-in-a-glance');
   $this->data['active_submodule']="manageimages";

   $this->load->Model(admin.'/Product_model');


   $values=array();
   $values['title']="Validate Banner";
   $values['current_image']=$this->input->post('current_image');

   $values['page_id']=$this->input->post('page_id');
   $values['page_type']=$this->input->post('page_type');
   $values['page_title']=$this->input->post('page_title');
   $values['banner_id']=$this->input->post('banner_id');
   $values['details']=$this->input->post('details');
   $values['url']=$this->input->post('url');
   $values['image_quality']=$this->input->post('image_quality');
   $values['image_alt_title_text']=$this->input->post('image_alt_title_text');


   
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','Please enter {field}');
   $this->form_validation->set_rules('details', 'banner content', 'trim|required');
   if(!empty($values['url']))
   {
    $this->form_validation->set_rules('url', 'url', 'trim|callback__validate_url'); 
   }
 
   if(empty($values['current_image']) or !empty($_FILES['image_file']['name']))
   {
	$path_to_upload="./images/banners/";
	// list of argument for image validation array
// 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    if($values['page_type'] == "homepage")
	{
     $banner_image_info=array("image_file",$path_to_upload,"banner_image","","","462","240",'');
	}
	else
	{
     $banner_image_info=array("image_file",$path_to_upload,"banner_image","","","462","190",'');
    }
	$banner_image_info_string=implode("~",$banner_image_info);
    $this->form_validation->set_rules('image_file', 'image', "callback_image_validation[{$banner_image_info_string}]");
   }
   //if(($values['submit_value'] == "Submit" or ($values['submit_value'] == "Update" and !empty($_FILES['image_file']['name']))) and ($this->form_validation->run() == FALSE))
   if($this->form_validation->run() == FALSE)   
   { 
    // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_image_info['banner_image']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['banner_image']['file_name']);
	}
    $this->AddBanner('','','',$values);
   }
   else
   {
    $records=array();
    if(!empty($_FILES['image_file']['name']))
	{
	 // delete previous image
	 if(!empty($values['current_image']))
	 {
	  unlink($path_to_upload.$values['current_image']);
	 }
	 $records['image_file']=$this->uploading_image_info['banner_image']['file_name'];
	 $this->ReduceImageWeight($records['image_file'],$path_to_upload, $values['image_quality']);
  	 $records['image_quality']=$values['image_quality'];
	}
	$records['details']=$values['details'];
	$records['url']=$values['url'];
	$records['image_alt_title_text']=$values['image_alt_title_text'];
	
    if(!empty($values['banner_id']))
	{
	 if($values['page_type'] == "homepage")
	 {
	  $this->session->set_flashdata('success_message',"Banner has been updated successfully");
	  $this->Banner_model->UpdateHomePageBanners($records,$values['banner_id']);
	 }
	 else
	 {
	  $this->Banner_model->UpdateBanner($records,$values['banner_id']); 
	  $this->session->set_flashdata('success_message',"Banner has been updated successfully");
	 }
	} 
    else
	{
	 if($values['page_type'] == "homepage")
	 {
  	  $this->Banner_model->InsertHomePageBanners($records); 
	 }
	 else
	 {
	  $records['page_id']=$values['page_id'];
	  $records['page_type']=$values['page_type'];
	  $records['dateadded']=date("Y-m-d h:i:s");
  	  $this->Banner_model->InsertBanner($records); 
	 }
	}
	switch($values['page_type'])
	{
	 case "services":
	 $this->data['redirect_url']=admin."/banners/service-banner/".$values['page_id'];
	 break;
	 case "news":
	 $this->data['redirect_url']=admin."/banners/news-banner/".$values['page_id'];
	 break;
	 case "homepage":
	 $this->data['redirect_url']=admin."/banners/homepage";
	 break;
	 case "products":
	  if($values['page_id'] == '0')
	  {
       $this->data['redirect_url']=admin."/banners/products-default-banner";
	  }
	  else
	  {
	   $category_id=$this->Banner_model->GetCategoryId($values['page_id']);	 
	   $category_details=$this->Product_model->GetCategoryDetails($category_id);
	   
	   $this->data['redirect_url']=admin."/banners/product-banners/".$category_id."/".$category_details['depth'];
	  }
	 break;
	 case "categories":
	 $category_details=$this->Product_model->GetCategoryDetails($values['page_id']);
	 $this->data['redirect_url']=admin."/banners/category-banners/".$category_details['parent_id']."/".$category_details['depth'];
	 break;
	 default:
     $this->data['redirect_url']=admin."/banners/banner-in-a-glance";
     break;
	}
    $this->RedirectPopupPage($this->data['redirect_url'],"Banner has been updated successfully");
   }
  }  
  public function _validate_url($news_url)
  {
   if(!($this->commonfunctions->ValidateUrl($news_url)))
   {
	$this->form_validation->set_message('_validate_url','Please enter valid URL');
    return false;
   }
   else
   {
    return true;
   }
  }
  public function changestatus($record_id,$status,$section,$parent_id='')
  {
   $section=str_replace("_","-",$section);
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('banners/'.$section);
   if($section == "homepage")
   {
    $this->Login_model->ChangeStatus(HOMEPAGE_BANNERS,$record_id,$status);
   }
   
   elseif($section == "product-banners" or $section == "category-banners")
   {
    $this->load->Model(admin.'/Product_model');
    $this->Login_model->ChangeStatus(BANNERS,$record_id,$status);
	
	$category_details=$this->Product_model->GetCategoryDetails($parent_id);
	if($section == "product-banners")
    {
     $depth=$category_details['depth'];
	}
	elseif($parent_id > 0)
	{
     $depth=$category_details['depth']+1;
	}
   }
   else
   {
    $this->Login_model->ChangeStatus(BANNERS,$record_id,$status);
   }
   if(!empty($parent_id) or $parent_id == '0')
   {
    $section.="/$parent_id";
	if(isset($depth))
	{
     $section.="/$depth";
	}
   }
   $this->session->set_flashdata('success_message','Status of banner has been changed successfully');
   header("location:".base_url().admin."/banners/$section");
   exit;
  }
  public function ConfirmSuperadmin($checked_ids,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('banners/banner-in-a-glance'); 	  
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
   $this->load->view(admin.'/templates/superadmin-delete',$this->data);
  }
  public function ConfirmDelete($checked_id,$item_name,$parent_id='') // mandatory Function for each module
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('banners/banner-in-a-glance');	  	  
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_id,$item_name,$parent_id);
   // If you have any additional attribute item wise then you can merge it as follows  : 
   /*   
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   */
   // If you have any custom message other than common message item wise then assign message to data variable as follows
   // Default message
   $this->data['message']="Are you sure you want to delete this banner.";
   $this->load->helper('form'); 
   $this->adminjavascript->include_admin_js=array('ConfirmDeleteJs');
   $this->load->view(admin.'/templates/confirm-delete',$this->data);
  }
  public function DeleteRecord($checked_ids,$item_name,$parent_id='') // mandatory Function for each module
  {
   $item_name=urldecode($item_name);
   $all_ids=explode("~",$checked_ids);
   // Delete Record item wise and redirect the page to repective module with success message
   $section=str_replace("_","-",$item_name);
   if($item_name == "banner")
   {
    if(count($all_ids) > 0)
	{
	 $this->Banner_model->DeleteStaticPageBanner($all_ids);
	 $this->RedirectPage(admin.'/banners/banner-in-a-glance',"Banner has been deleted successfully");
	}
   } 
   elseif($item_name == "homepage_banner")
   {
	$this->Banner_model->DeleteHomePageBanner($all_ids); 
	$this->RedirectPage(admin.'/banners/homepage/'.$parent_id,"Banner has been deleted successfully");
   }
   elseif($item_name == "category_banners" or $item_name == "product_banners")
   {
    $this->load->Model(admin.'/Product_model');
    if(count($all_ids) > 0)
	{
	 $this->Banner_model->DeleteBanner($all_ids); 
	 $category_details=$this->Product_model->GetCategoryDetails($parent_id);
	 if($item_name == "product_banners")
	 {
	  $depth=$category_details['depth'];
	 }
	 elseif($parent_id > 0) $depth=$category_details['depth']+1;
	 $this->RedirectPage(admin.'/banners/'.$section.'/'.$parent_id.'/'.$depth,"Banner has been deleted successfully");
	}
   } 
   else
   {
    if(count($all_ids) > 0)
	{
	 $this->Banner_model->DeleteBanner($all_ids); 
	 $this->RedirectPage(admin.'/banners/'.$section.'/'.$parent_id,"Banner has been deleted successfully");
	}
   } 
  }
  public function setTimeInterval($values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('banners/homepage');
   $this->adminjavascript->include_admin_js=array('ValidateBannersFormJs','PrettyPhotoJs');
   $this->admincss->including_css_func=array('PrettyPhotoCss');  
   if(count($values) == 0)
   {
    $values=array();
    $values=$this->Banner_model->GetHomeBannerInterval();   
	$this->data['title'] .=" : Set Time Interval";
   }
   else
   {
    $this->data['title'] .=$values['title'];
	if(isset($values['success_message']) and !empty($values['success_message']))
	{
     $this->data['redirect_url']=admin."/banners/homepage";
	 $this->session->set_flashdata('success_message',$values['success_message']);
	}
   }

   $this->data['last_modified']=$this->Login_model->LastModify(BANNER_INTERVALS,1);
   $this->data['attributes']=$this->Banner_model->GetBannerIntervalAttributes($values); 
   $this->load->view(admin.'/banners/set-time-interval',$this->data);
  }
  public function validateTimeInterval()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('banners/homepage');
   $values=array();
   $values['title']="Validate Time Interval";
   $this->load->library('form_validation'); 
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_rules('time_interval','time interval','trim|required|callback_timeValidate');
   $values['time_interval']=$this->input->post('time_interval');
   if($this->form_validation->run() == FALSE)
   {
    $this->setTimeInterval($values);
   }
   else
   {
	$records['time_interval']=$values['time_interval'];
    $this->Banner_model->UpdateTimeInterval($records,1);
	$values['success_message']="Time interval updated successfully";
	$this->setTimeInterval($values);
   }
  }
  public function timeValidate($time_interval)
  {
   $error=false;
   if(!(preg_match('/^([1-9][0-9]*)$/',$time_interval)))
   {
	$error=true;
   }
   else
   {
    $error=false;
   }
   if($error == true)
   {
    $this->form_validation->set_message('timeValidate','Interval time must be a nubmer other than zero');
	return false;
   }
   else
   {
    return true;
   }
  }
 }
