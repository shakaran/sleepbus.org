<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
 
 class Products extends MY_Controller
 {
  public $uploading_image_info;
  public $uploading_brochure_info;
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Product_model');
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
    $this->Login_model->UpdateTopText($records,2);
	$this->RedirectPage(admin.'/products/toptext','Top text has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(2);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,2);
   $this->data['attributes']=$this->Product_model->GetTopTextFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/products/top-text',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function add_category($parent_id=0,$depth=0,$values=array())
  {
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs','ValidateProductFormJs');
   // $this->admincss->including_css_func = array('CalendarCss'); 
   $this->data['parent_id']=$parent_id;
   $this->data['depth']=$depth;
   if(count($values) > 0)
   {
    $this->data['title'] .= $values['title']; //this is meta title
	$this->data['page_title'] = $values['page_title']; //this is page heading
    $this->data['image_quality']=$values['image_quality'];  
   }
   else
   {
    $values['category_name'] = '';
    $values['description'] = '';	
    $values['image_alt_title_text']="";	
    $this->data['image_quality']='';  
	
	$this->data['page_title'] = 'Add Category';
	$this->data['file_error'] = '';
   }
   if(!empty($this->data['cat_id'])) $this->data['attributes'] = $this->Product_model->GetCategoryFormAttribute($values,$this->data['parent_id'],$this->data['cat_id']);
   else $this->data['attributes'] = $this->Product_model->GetCategoryFormAttribute($values,$this->data['parent_id']);

   $this->data['category_navigation']=$this->Product_model->GetCategoryNavigation($this->data['parent_id'],$this->data['depth']);
   
   if($this->data['parent_id'] != 0)
   {
    $this->data['parent_category_drop_down_attribute']=$this->Product_model->ParentCategoryDropDownAttributes($this->data['parent_id']);
   }

   // if you have any remarks then assign as $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)"; other wise it takes default remarks
   // Image optimization attributes  
   $this->data['image_remarks']="Max size must be (1200 x 800) (Width x Height)";    
   
   $this->data['image_quality_options']=$this->Login_model->GetImageQualityOptions();

 
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/products/add-category',$this->data);
   $this->load->view(admin.'/templates/footer');
  }  
  
  public function validate_category()
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('products/add-category');
   $this->data['active_submodule'] = 'add-category';

   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','{field}');
   $this->form_validation->set_message('is_unique','Category with same name already exists in this level');

   $values = array();
   $file_uploaded = FALSE;

   $submit_value = $this->input->post('submit_value');   
   $values['title'] = 'Validate Category';   
   $values['category_name'] = $this->input->post('category_name');
   $values['description'] = $this->input->post('description');
   $values['parent_id'] = $this->input->post('parent_id');
   $values['depth'] = $this->input->post('depth');
   $values['image_alt_title_text'] = $this->input->post('image_alt_title_text');
   $values['image_quality']=$this->input->post('image_quality');
   
   if($submit_value=='Update')
   {
    $values['page_title'] = 'Edit Category'; //this is page heading
    $values['current_image'] = $this->input->post('current_image');
   	
	$cat_id = $this->input->post('cat_id');
    $this->data['cat_id'] = $cat_id;
    
	$this->form_validation->set_rules('category_name', 'Please enter category name', 
	'trim|required|callback_is_unique_with_condition['.CATEGORIES.'~category_name~parent_id='.$values['parent_id'].' and id !='.$cat_id.'~category]');
   }
   if($submit_value=='Submit')
   {
    $values['page_title'] = 'Add Category'; //this is page heading
    //$this->form_validation->set_rules('category_name', '', 'trim|required|is_unique['.CATEGORIES.'.category_name]');

	$this->form_validation->set_rules('category_name', 'Please enter category name', 
	'trim|required|callback_is_unique_with_condition['.CATEGORIES.'~category_name~parent_id='.$values['parent_id'].'~category]');
    
   }
   $this->form_validation->set_rules('description', 'Please enter intro text', 'trim|required');
   $path_to_upload="./images/category/";
   if(!empty($_FILES['image_file']['name']))
   {
	// list of argument for image validation array
    // 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
    $category_image_info=array("image_file",$path_to_upload,"cat_image","","","","",'');
    $category_image_info_string=implode("~",$category_image_info);
    $this->form_validation->set_rules('image_file', 'category image', "callback_image_validation[{$category_image_info_string}]");
   }
   
   if($this->form_validation->run()==FALSE) 
   {
	if(!empty($this->uploading_image_info['cat_image']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['cat_image']['file_name']);
	}
	
	$this->add_category($values['parent_id'],$values['depth'],$values);
   }
   else
   {
    $records['category_name'] = $values['category_name'];
    $records['description'] = $values['description'];
    $records['parent_id'] = $values['parent_id'];
    $records['depth'] = $values['depth'];
    $records['image_alt_title_text'] = $values['image_alt_title_text'];

    if(!empty($_FILES['image_file']['name']))
	 {
	  // delete previous image
	  if(!empty($values['current_image']))
	  {
	   unlink($path_to_upload.$values['current_image']);
	  }
	  $records['image_file']=$this->uploading_image_info['cat_image']['file_name'];
	 
	  $this->ReduceImageWeight($records['image_file'],$path_to_upload, $values['image_quality']);
      $records['image_quality']=$values['image_quality'];
	 }

	

    if($submit_value=='Update')
	{
	
 	
	
	
	 $this->Product_model->UpdateCategory($records,$cat_id);
	 $this->RedirectPage(admin.'/products/manage-categories/'.$records['parent_id'].'/'.$records['depth'].'/'.$cat_id,'Category updated successfully');
	}
	else
	{
     //genereate category url
	 $cat_url = strtolower(str_replace(' ','-',$this->commonfunctions->RemoveSpecialChars($records['category_name'])));		

	 $records['url'] = $this->Login_model->GenerateNewUrl($cat_url);	 

	 $cat_id=$this->Product_model->InsertCategory($records);
	 $this->RedirectPage(admin.'/products/manage-categories/'.$records['parent_id'].'/'.$records['depth'],'Category added successfully');
	}
   }
  }
  
  public function verify_image($filename,$error_msg)
  {
   $error_msg = preg_replace('/(<p>|<\/p>)/','',$error_msg);
   $this->form_validation->set_message('verify_image',$error_msg); 
   return false; 
  }
  
  public function edit_category($parent_id=0,$depth=0,$cat_id)
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('products/add-category');	  
   $this->data['active_submodule'] = "add-category";
   $this->data['last_modified'] = $this->Login_model->LastModify(CATEGORIES,$cat_id);   

   $values = array();
   $values = $this->Product_model->GetCategoryDetails($cat_id);
   $values['page_title'] = 'Edit Category';
   $values['title'] = 'Edit Category';
   $values['submit_value'] = 'Update';
   $this->data['cat_id'] = $cat_id;
   $this->add_category($parent_id,$depth,$values);
  }
    
  public function manage_categories($parent_id=0,$depth=0)
  {
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs','DragDropJs','ValidateProductFormJs');
   //$this->admincss->including_css_func=array('PrettyPhotoCss');   
   $this->data['category_list'] = $this->Product_model->GetCategoryList($parent_id);
   $this->data['is_subcategory']=$this->Product_model->GetCategoryListWithoutSubcateories($this->data['category_list']);
   $this->data['parent_id']=$parent_id;
   $this->data['depth']=$depth;
   
   
   if(count($this->data['category_list']) > 0)
   {
	/* Arguments for GetAtributesForDeletion function : 
	   1. item list to be deleted, 
	   2. which type of item to be deleted, 
	   3. single delete permission-> value would be 'yes' or 'no' and 
	   4. parent_id if you have(optional);
    */	
    $this->data['attribute'] = $this->Login_model->GetAtributesForDeletion($this->data['category_list'],'category','yes',$this->data['parent_id']);
   }
   
   
   $this->data['category_navigation']=$this->Product_model->GetCategoryNavigation($this->data['parent_id'],$this->data['depth']);
   
   if($this->data['parent_id'] != 0)
   {
    $this->data['parent_category_drop_down_attribute']=$this->Product_model->ParentCategoryDropDownAttributes($this->data['parent_id']);
   }
   
   
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/products/manage-categories',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  
  public function AddProductForm($cat_id,$depth,$values = array())
  {	
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('products/manage-products');	  
   $this->data['active_submodule'] = "add-product";
   $this->adminjavascript->include_admin_js = array('ValidateProductFormJs');
   
   if(count($values) > 0)
   {
    $this->data['title'] .= $values['title']; //this is meta title
	$this->data['page_title'] = $values['page_title']; //this is page heading
    $this->data['cat_id'] = $values['cat_id'];
    $this->data['depth'] = $values['depth'];
   }
   else 
   {
    $values['product_name'] = '';
	$values['intro_text'] = '';
    $values['description'] = '';	
	$this->data['page_title'] = 'Add Product';
	$this->data['file_error'] = '';
    $this->data['cat_id'] = $cat_id;
    $this->data['depth'] = $depth;
   }

   $this->data['category_navigation']=$this->Product_model->GetCategoryNavigationForProducts($this->data['cat_id'],$this->data['depth']);
   
   $this->data['current_category']=$this->Product_model->GetCategoryDetails($this->data['cat_id']);

   if(!empty($this->data['product_id'])) 
    $this->data['attributes'] = $this->Product_model->GetProductFormAttribute($values,$this->data['product_id']);
   else $this->data['attributes'] = $this->Product_model->GetProductFormAttribute($values);

   $this->SetUpCkeditor();    
   //$this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/products/add-product-form',$this->data);
   //$this->load->view(admin.'/templates/footer');
  }  

  public function edit_product($product_id,$cat_id,$depth)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('products/manage-products');	  
   $this->data['active_submodule'] = "manage-products";
   $this->data['last_modified']=$this->Login_model->LastModify(PRODUCTS,$product_id);   

   $values = array();
   $values = $this->Product_model->GetProductDetails($product_id);
   $values['page_title'] = "Edit Product";
   $values['title'] = "Edit Product";
   $values['submit_value'] = "Update";
   $values['cat_id']=$cat_id;
   $values['depth']=$depth;
   $this->data['product_id'] = $product_id;
   $this->AddProductForm($cat_id,$depth, $values);
  }  
  
  public function validate_product()
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('products/manage-products');
   $this->data['active_submodule'] = 'manage-products';

   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','{field}');
   $this->form_validation->set_message('is_unique','Product with same name already exists in selected category');

   $values = array();

   $submit_value = $this->input->post('submit_value');   
   $values['title'] = 'Validate Product';  
   $values['cat_id'] = $this->input->post('cat_id');
   $values['product_name'] = $this->input->post('product_name');
   $values['intro_text'] = $this->input->post('intro_text');
   $values['description'] = $this->input->post('description');
   $values['depth']  = $this->input->post('depth'); 
   $product_name = $this->input->post('product_name');
   
   if($submit_value=='Update')
   {
    $values['page_title'] = 'Edit Product'; //this is page heading
   	
	$product_id = $this->input->post('product_id');
    $this->data['product_id'] = $product_id;
    
	$this->form_validation->set_rules('product_name', 'Please enter product name', 'trim|required|callback_is_unique_product['.$values['cat_id'].'~'.$product_name.'~'.$product_id.']');
   }
   if($submit_value=='Submit')
   {
    $values['page_title'] = 'Add Product'; //this is page heading
    $this->form_validation->set_rules('product_name', 'Please enter product name', 'trim|required|callback_is_unique_product['.$values['cat_id'].'~'.$product_name.']');
   }
   //$this->form_validation->set_rules('cat_id', 'Please select a category', 'trim|required');
   $this->form_validation->set_rules('intro_text', 'Please enter short description of product', 'trim|required');
   $this->form_validation->set_rules('description', 'Please enter description of product', 'trim|required');

   if($this->form_validation->run()==FALSE) 
   {
	$this->AddProductForm('','',$values);
   }
   else
   {
    $records1['product_name'] = $values['product_name'];
    $records1['intro_text'] = $values['intro_text'];	
    $records1['description'] = $values['description'];
	
    if($submit_value=='Update')
	{
	 $this->Product_model->UpdateProduct($records1, $product_id);
	 $redirect_url=admin.'/products/manage-products/'.$values['cat_id'].'/'.$values['depth'];
 	 $message='Product updated successfully';

	}
	else
	{
     //genereate category url
	 $url = strtolower(str_replace(' ','-',$this->commonfunctions->RemoveSpecialChars($records1['product_name'])));		
	 $records2['url'] = $this->Login_model->GenerateNewUrl($url);	 
	 $records2['cat_id'] = $values['cat_id'];
	 
	 $this->Product_model->InsertProduct($records1, $records2);
	 $redirect_url=admin.'/products/manage-products/'.$values['cat_id'].'/'.$values['depth'];
 	 $message='Product added successfully';
	}
    $this->RedirectPopupPage($redirect_url,$message);
   }
  }  

  public function is_unique_product($pname, $fields)
  {
   $fields_arr = explode('~', $fields);	 
   $product_id = ''; 	  
   if(count($fields_arr)==3) list($cat_id, $product_name, $product_id) = explode('~', $fields);	  
   else list($cat_id, $product_name) = explode('~', $fields);
   
   if(!$this->Product_model->IsUniqueProduct($cat_id, $product_name, $product_id))
   {
    $this->form_validation->set_message('is_unique_product',"This product already exists in selected category");		
    return false;
   }
   else return true;
  }
  
  public function manage_products($cat_id=0,$depth=0)
  {
   if($cat_id > 0)
   {
    $this->adminjavascript->include_admin_js = array('SuccessMessageJs','DragDropJs','ValidateProductFormJs');
   }
   else
   {
    $this->adminjavascript->include_admin_js = array('SuccessMessageJs','ValidateProductFormJs');
   }
   //$this->admincss->including_css_func=array('PrettyPhotoCss');   
   
   $this->data['navigation_attributes']=$this->Product_model->CategoryNavigationAttributes($cat_id,$depth);   
   
   $this->data['cat_id']=$cat_id;
   $this->data['depth']=$depth;
   
   
   $this->data['product_list'] = array();
   $this->data['product_list'] = $this->Product_model->GetProductList($this->data['cat_id']);

   if(count($this->data['product_list']) > 0)
   {
	$this->data['category_details']=$this->Product_model->GetCategoryDetails($this->data['cat_id']);  
//     Arguments for GetAtributesForDeletion function : 
//	 1. item list to be deleted, 
//	 2. which type of item to be deleted, 
//	 3. single delete permission-> value would be 'yes' or 'no' and 
//	 4. parent_id if you have(optional);
    	
    $this->data['attribute'] = $this->Login_model->GetAtributesForDeletion($this->data['product_list'],'product','yes', $this->data['cat_id']);
   }
   
   
   $this->data['category_navigation']=$this->Product_model->GetCategoryNavigationForProducts($this->data['cat_id'],$this->data['depth']);
   
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/products/manage-products',$this->data);
   $this->load->view(admin.'/templates/footer');
	  
	  
  }  
  public function add_image($product_id, $cat_id, $values=array())
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('products/manage-products');	  
   $this->data['active_submodule'] = "manage-products";
   $this->adminjavascript->include_admin_js = array('ValidateProductFormJs');
  
   $this->data['cat_id'] = $cat_id;
   if(count($values) > 0)
   {
    $this->data['title'] .= $values['title'];
	$this->data['page_title'] = $values['page_title'];
	$this->data['parent_id'] = $values['parent_id'];
	$this->data['submit_value'] = $values['submit_value']; 
	if(isset($values['edit_id']) and !empty($values['edit_id']))
	{
     $this->data['last_modified'] = $this->Login_model->LastModify(PRODUCT_IMAGES,$values['edit_id']);   
	}
	
    $this->data['image_quality']=$values['image_quality'];
   }
   else
   {
    $values['image_title'] = "";
    $values['current_image'] = "";
    $values['image_alt_title_text'] = "";	
	$this->data['page_title'] = "Add Product Images";
	$this->data['parent_id'] = $product_id;  
	$this->data['submit_value'] = "Submit"; 
    $this->data['image_quality']='';
   }
   if(!empty($this->data['parent_id']))
   {
	$parent_drop_down_list = $this->Product_model->GetProductListForDropDown($cat_id);
	// argument 1. values, 2.submit_type, 3. parent_drop_down_list
    $this->data['attributes'] = $this->Login_model->GetImageFormAttribute($values, $this->data['submit_value'], $parent_drop_down_list, 20);
   }
   
   // if you have any remarks then assign as $this->data['remarks']="Max size must be (1200 x 800) (Width x Height)"; other wise it takes default remarks
   $this->data['file_path'] = base_url().admin."/products/validate-product-image";
   
   // Image optimization attributes  
   $this->data['image_quality_options']=$this->Login_model->GetImageQualityOptions();
   
   $this->data['uploading_path'] = base_url()."images/product";
   $this->data['parent_drop_down_title'] = "Selected Product";
   $this->load->view(admin.'/products/add-image',$this->data);
  }  
  
  public function edit_image($image_id, $product_id, $cat_id)
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('products/manage-products');	  
   $this->data['active_submodule'] = "manage-images";
   $this->data['last_modified'] = $this->Login_model->LastModify(PRODUCT_IMAGES,$image_id);   
   $values = array();
   $values = $this->Login_model->GetImageBrochureDetails($image_id, PRODUCT_IMAGES);
   $values['current_image'] = $values['image_file'];
   $values['title'] = "Edit Product Image";
   $values['parent_id'] = $product_id;
   $values['page_title'] = "Edit Product Image";
   $values['submit_value'] = "Update"; 
   $values['edit_id'] = $image_id;
   $this->add_image($product_id, $cat_id, $values);
  }  
  
  public function validate_product_image()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('products/manage-products');
   $this->data['active_submodule']="manage-products";

   $this->form_validation->set_error_delimiters('<span>','</span>');

   $values=array();
   $values['title'] = "Validate Product Image";
   $values['image_title'] = $this->input->post('image_title');
   $values['current_image'] = $this->input->post('current_image');
   $values['cat_id'] = trim($this->input->post('cat_id')); 
   $values['parent_id'] = trim($this->input->post('parent_id'));
   $values['submit_value'] = $this->input->post('submit_value');
   $values['image_quality']=$this->input->post('image_quality');
   $values['image_alt_title_text']=$this->input->post('image_alt_title_text');


   if($values['submit_value']=="Submit") $values['page_title']="Add Product Image";
   else
   {
    $values['page_title']="Edit product Image";
    $values['edit_id']=$this->input->post('edit_id');
   }
 
   if(!empty($_FILES['image_file']['name']))
   {
	$path_to_upload = "./images/product/";
	/*
	list of argument for image validation array
    1.file_name,
	2.path_to_upload,
	3.image_index,
	4.max_width,
	5.max_height,
	6.fixed_width,
	7.fixed_height
	8.max_size
	*/
    $product_image_info = array("image_file",$path_to_upload,"product_image", '','', '', '', '');
	
    $product_image_info_string = implode("~",$product_image_info);
	
    $this->form_validation->set_rules('image_file', 'image', "callback_image_validation[{$product_image_info_string}]");
   }
   else if($values['submit_value']=="Submit")
   {
    $this->form_validation->set_rules('image_file', 'image', "required");
   }
   
   if(($values['submit_value']=="Submit" or ($values['submit_value'] == "Update" and !empty($_FILES['image_file']['name']))) and ($this->form_validation->run()==FALSE))
   { 
    // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_image_info['product_image']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_image_info['product_image']['file_name']);
	}
    $this->add_image($values['parent_id'],$values['cat_id'], $values);
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
	 $records['image_file'] = $this->uploading_image_info['product_image']['file_name'];
	 $this->ReduceImageWeight($records['image_file'],$path_to_upload, $values['image_quality']);
  	 $records['image_quality']=$values['image_quality'];
	}
	$records['image_alt_title_text']=$values['image_alt_title_text'];
	$records['image_title'] = $values['image_title'];
	$records['product_id'] = $values['parent_id'];
    $this->data['redirect_url'] = admin."/products/manage-images/".$values['parent_id']."/".$values['cat_id'];
	if($values['submit_value']=="Submit")
	{
	 $this->Product_model->InsertProductImage($records,PRODUCT_IMAGES,'product_id'); 
	 $message="Image added successfully";
	}
	elseif($values['submit_value'] == "Update")
	{
	 $this->Login_model->UpdateImage($records, $values['edit_id'],PRODUCT_IMAGES); 
	 $message="Image updated successfully";
    }
	$this->RedirectPopupPage($this->data['redirect_url'],$message);
   }
  }    
  
  public function manage_images($product_id, $cat_id)
  {
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs', 'ValidateProductFormJs','DragDropJs');
   
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('products/manage-products');	  
   $this->data['active_submodule'] = "manage-products";

   $this->data['title'] = "Manage Image";
   $this->data['page_title'] = "Manage Image";

   $this->data['cat_id'] = $cat_id;
   $this->data['product_id'] = $product_id;
   $this->data['drop_down_attributes'] = $this->Product_model->GetProductDropDownAttributes($cat_id);   
   $this->data['cat_details']=$this->Product_model->GetCategoryDetails($this->data['cat_id']);
   
   $this->data['image_list'] = $this->Login_model->GetImageList(PRODUCT_IMAGES,'product_id',$product_id);

   if(count($this->data['image_list']) > 0)
   {
	/*    
    Arguments for GetAtributesForDeletion function : 
	1. item list to be deleted, 
	2. which type of item to be deleted, 
	3. single delete permission-> value would be 'yes' or 'no' and 
	4. parent_id if you have(optional);
	*/
    $this->data['deletion_attribute'] = $this->Login_model->GetAtributesForDeletion($this->data['image_list'],'image','no',$product_id);
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/products/manage-images',$this->data);
   $this->load->view(admin.'/templates/footer');
  }    

  public function manage_brochures($product_id, $cat_id)
  {
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs', 'ValidateProductFormJs','DragDropJs');
   
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('products/manage-products');	  
   $this->data['active_submodule'] = "manage-products";

   $this->data['title'] = "Manage Downloads";
   $this->data['page_title'] = "Manage Downloads";

   $this->data['cat_id'] = $cat_id;
   $this->data['product_id'] = $product_id;
   $this->data['drop_down_attributes'] = $this->Product_model->GetProductDropDownAttributes($cat_id);   
   $this->data['cat_details']=$this->Product_model->GetCategoryDetails($this->data['cat_id']);
   
   if(!empty($product_id)) $this->data['brochure_list'] = $this->Login_model->GetBrochureList(PRODUCT_BROCHURES,'product_id', $product_id);
   else $this->data['brochure_list']=array();
   
   if(count($this->data['brochure_list']) > 0)
   {
    // Arguments for GetAtributesForDeletion function : 
    /*
    1. item list to be deleted, 
    2. which type of item to be deleted, 
    3. single delete permission-> value would be 'yes' or 'no' and 
    4. parent_id if you have(optional);
    */
    $this->data['deletion_attribute'] = $this->Login_model->GetAtributesForDeletion($this->data['brochure_list'],'brochure','no',$product_id);
   }
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/products/manage-brochures',$this->data);
   $this->load->view(admin.'/templates/footer');
  }     

  public function add_brochure($product_id, $cat_id='',$values=array())
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('products/manage-products');	  
   $this->data['active_submodule']="manage-products";
   $this->adminjavascript->include_admin_js=array('ValidateProductFormJs');
   
   $this->data['cat_id'] = $cat_id;
   
   if(count($values) > 0)
   {
    $this->data['title'] .= $values['title'];
	$this->data['page_title'] = $values['page_title'];
	$this->data['parent_id'] = $values['parent_id'];
	$this->data['submit_value'] = $values['submit_value']; 
	
	if(isset($values['edit_id']) and !empty($values['edit_id']))
	{
     $this->data['last_modified']=$this->Login_model->LastModify(PRODUCT_BROCHURES,$values['edit_id']);   
	}
   }
   else
   {
    $values['brochure_title'] = '';
    $values['current_brochure'] = '';
	$this->data['page_title'] = 'Add Product Brochure';
	$this->data['parent_id'] = $product_id;  
	$this->data['submit_value']= 'Submit'; 
   }
   if(!empty($this->data['parent_id']))
   {
	$parent_drop_down_list = $this->Product_model->GetProductListForDropDown($cat_id);
	//argument 1. values, 2.submit_type, 3. parent_drop_down_list
    $this->data['attributes']=$this->Login_model->GetBrochureFormAttribute($values, $this->data['submit_value'],$parent_drop_down_list,70);
   }
   
   //if you have any remarks then assign as $this->data['remarks']="Max size 33 KB"; other wise it takes default remarks
   $this->data['title_remarks'] = '*(Max 70 Chars)';
   $this->data['file_path'] = base_url().admin."/products/validate-product-brochure";
   $this->data['uploading_path'] = base_url().'brochures/product';
   $this->data['parent_drop_down_title'] = 'Selected Product';
   $this->load->view(admin.'/templates/add-brochure',$this->data);
  }
  
  public function validate_product_brochure()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('products/manage-products');
   $this->data['active_submodule'] = "manage-products";
   $values=array();
   
   $values['title'] = "Validate Product Brochure";
   $values['brochure_title'] = $this->input->post('brochure_title');
   $values['current_brochure'] = $this->input->post('current_brochure');
   $values['cat_id'] = trim($this->input->post('cat_id'));    
   $values['parent_id'] = trim($this->input->post('parent_id'));
   $values['submit_value'] = $this->input->post('submit_value');
   
   if($values['submit_value']=="Submit") $values['page_title']="Add Product Brochure";
   else
   {
    $values['page_title'] = "Edit Product Brochure";
    $values['edit_id'] = $this->input->post('edit_id');
   }
   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required', 'Please enter {field}');    

   $this->form_validation->set_rules('brochure_title', 'title', "required");

 
   if(!empty($_FILES['brochure_file']['name']))
   {
	$path_to_upload="./brochures/product/";
	// list of argument for brochure validation array // 1.file_name,2.path_to_upload, 3.brochure_index,4.max_size
    $product_brochure_info = array("brochure_file", $path_to_upload, "product_brochure",'');
    $product_brochure_info = implode("~",$product_brochure_info);
	
    $this->form_validation->set_rules('brochure_file', 'Brochure file', "callback_brochure_validation[{$product_brochure_info}]");
   }
   else if($values['submit_value']=="Submit")
   {
    $this->form_validation->set_rules('brochure_file', 'brochure', "required");
   }
   if(($values['submit_value'] == "Submit" or ($values['submit_value'] == "Update" and !empty($_FILES['brochure_file']['name']))) and ($this->form_validation->run() == FALSE))
   { 
    // if uploaded file has not error but other field through error then delete the recent uploaded file 
	if(!empty($this->uploading_brochure_info['product_brochure']['file_name']))
	{
	 unlink($path_to_upload.$this->uploading_brochure_info['product_brochure']['file_name']);
	}
   	$this->add_brochure($values['parent_id'], $values['cat_id'],$values);
   }
   else
   {
    $records=array();
    if(!empty($_FILES['brochure_file']['name']))
	{
	 // delete previous brochure
	 if(!empty($values['current_brochure']))
	 {
	  unlink($path_to_upload.$values['current_brochure']);
	 }
	 $records['brochure_file']=$this->uploading_brochure_info['product_brochure']['file_name'];
	}
	$records['brochure_title'] = $values['brochure_title'];
	$records['product_id'] = $values['parent_id'];
    $this->data['redirect_url'] = admin."/products/manage-brochures/".$values['parent_id'].'/'.$values['cat_id'];
	
	if($values['submit_value']=="Submit")
	{
	 $this->Login_model->InsertBrochure($records,PRODUCT_BROCHURES,'product_id'); 
	 $message="Brochure has been added successfully";
	}
	elseif($values['submit_value']=="Update")
	{
	 $this->Login_model->UpdateBrochure($records, $values['edit_id'], PRODUCT_BROCHURES); 
	 $message="Brochure has been updated successfully";
    }
	$this->RedirectPopupPage($this->data['redirect_url'],$message);
   }
  }
  public function edit_brochure($brochure_id, $product_id, $cat_id)
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('products/manage-products');	  
   $this->data['active_submodule'] = 'manage-products';
   $this->data['last_modified'] = $this->Login_model->LastModify(PRODUCT_BROCHURES, $brochure_id);   
   $values = array();
   $values = $this->Login_model->GetImageBrochureDetails($brochure_id, PRODUCT_BROCHURES);
   $values['current_brochure'] = $values['brochure_file'];
   $values['title'] = 'Edit Product Brochure';
   $values['parent_id'] = $product_id;
   $values['page_title'] = 'Edit Product Brochure';
   $values['submit_value'] = 'Update'; 
   $values['edit_id'] = $brochure_id;
   $this->add_brochure($product_id, $cat_id, $values);
  }
 
  
  public function copy_move_products($scid =0,$s_depth=0,$dcid=0,$d_depth=0,$values = array())
  {
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs','ValidateProductFormJs');
   $this->data['title'] = "Copy Move Products";
   $this->data['page_title'] = "Copy Move Products";
   
   
   $this->data['products'] = array();  
   if($this->session->userdata('session_data'))
   {
    $session_data = $this->session->userdata('session_data');	
    $scid = $session_data['scid'];  
    $dcid = $session_data['dcid'];  
    $s_depth = $session_data['s_depth'];  
    $d_depth = $session_data['d_depth'];  
	
    $action = $session_data['option'];  
    $this->data['products'] = $session_data['products'];
    $duplicate_products = $session_data['duplicate_products'];  
   }
   elseif($this->input->post('submit_value')=='Submit')
   {
    $scid = $this->input->post('scid');   
    $dcid = $this->input->post('dcid');
    $s_depth = $this->input->post('s_depth');   
    $d_depth = $this->input->post('d_depth');
	
    $action = $this->input->post('option');
    $checked_products = $this->input->post('products');
	
    $duplicate_products = $this->Product_model->CopyMoveCloneProducts($scid, $dcid, $checked_products, $action);
   }
   else
   {
	$action = '';   
	$duplicate_products = array();
   }

   $this->data['scid'] = $scid; 
   $this->data['dcid'] = $dcid;
   $this->data['s_depth'] = $s_depth; 
   $this->data['d_depth'] = $d_depth;
   $this->data['option'] = $action;
   $this->data['duplicate_products'] = $duplicate_products;
   

   $this->data['source_navigation_attributes']=$this->Product_model->CategoryNavigationAttributes($this->data['scid'],$this->data['s_depth']);   
   $this->data['source_category_navigation']=$this->Product_model->GetCategoryNavigationForProducts($this->data['scid'],$this->data['s_depth']);

   $this->data['destination_navigation_attributes']=$this->Product_model->CategoryNavigationAttributes($this->data['dcid'],$this->data['d_depth']);   
   $this->data['destination_category_navigation']=$this->Product_model->GetCategoryNavigationForProducts($this->data['dcid'],$this->data['d_depth']);


   
 
   if($this->data['scid'] > 0)
   {
  	$this->data['category_details']=$this->Product_model->GetCategoryDetails($this->data['scid']);  
    if(count($this->data['products']) == 0)
	{
	 $this->data['products'] = $this->Product_model->GetProductList($this->data['scid']);
	}
   }

   if($this->input->post('submit_value')=='Submit')
   {
	$session_data = array('scid'=>$this->data['scid'],'s_depth'=>$this->data['s_depth'], 'dcid'=>$this->data['dcid'],'d_depth'=>$this->data['d_depth'],'option'=>$this->data['option'], 'products'=> $this->data['products'],'duplicate_products'=>$this->data['duplicate_products']);  
	$this->session->set_userdata('session_data', $session_data); 
	if(count($this->data['duplicate_products']) == 0)
	{
     if($action=='copy') $message = "Selected products copied to destination category successfully";
	 else if($action=='move') $message = "Selected products moved to destination category successfully";
	 else if($action=='clone') $message = "Selected products cloned to destination category successfully";
	}
    $this->RedirectPage(admin.'/products/copy-move-products', $message);
   }
   else
   {
    $this->load->view(admin.'/templates/header',$this->data);
    $this->load->view(admin.'/products/copy-move-products',$this->data);
    $this->load->view(admin.'/templates/footer');
   }
  }  
  
  public function changestatus($record_id, $status, $section, $parent_id = '', $cat_id = '')
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('products/manage-categories');
  
   $section = str_replace("_","-",$section); 
   
   if($section=='manage-categories')
   {
    $this->Login_model->ChangeStatus(CATEGORIES,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of category changed successfully');
	if($parent_id > 0)
	{
     $category_details=$this->Product_model->GetCategoryDetails($parent_id);
  	 $depth=$category_details['depth']+1;
	}
   }
   elseif($section=='manage-products')
   {
    $this->Login_model->ChangeStatus(CATEGORY_TO_PRODUCTS, $record_id, $status);
    $this->session->set_flashdata('success_message','Status of product changed successfully');
    $category_details=$this->Product_model->GetCategoryDetails($parent_id);
	$depth=$category_details['depth'];
   }
   elseif($section=='manage-images')
   {
    $this->Login_model->ChangeStatus(PRODUCT_IMAGES, $record_id, $status);
    $this->session->set_flashdata('success_message','Status of product image changed successfully');
   }
   elseif($section=='manage-brochures')
   {
    $this->Login_model->ChangeStatus(PRODUCT_BROCHURES, $record_id, $status);
    $this->session->set_flashdata('success_message','Status of product image changed successfully');
   }

   if(!empty($parent_id)) $section .= '/'.$parent_id; 
   if(!empty($cat_id)) $section .= '/'.$cat_id;
   if(isset($depth)) $section .= '/'.$depth;

   header("location:".base_url().admin."/products/$section");
   exit;
  } 
  
  public function change_main_image($cat_id, $product_id, $image_id)
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('products/manage-images');
   	  
   $this->Product_model->ChangeMainImage($product_id, $image_id);
   
   $this->RedirectPage(admin.'/products/manage-images/'.$product_id.'/'.$cat_id,'Main image updated successfully');   
  }
  
  // mandatory Function for each module
  public function ConfirmDelete($checked_id, $item_name, $parent_id = '', $cat_id = '') 
  {
   $this->adminjavascript->include_admin_js = array('ConfirmDeleteJs');
   
   if($item_name=='product' || $item_name=='image' || $item_name=='brochure') 
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('products/manage-products');	  	  
   else if($item_name=='category') $this->data['sub_modules']=$this->CheckSubModuleAccessibility('products/manage-categories');	  	     
   
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
   if($item_name == "category_image_delete")
   {
	$this->data['message']="Are you sure want to delete this image.";
   }
   elseif($item_name == "remove_clone")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('products/manage-products');	  	  
	$this->data['message']="Are you sure want to unlink this product from selected category.";
   }
   else
   {
    $this->data['message'] = "Are you sure you want to delete selected ".$item_name;
   }
   $this->load->view(admin.'/templates/confirm-delete',$this->data);
  }
  
  //mandatory Function for each module
  public function ConfirmSuperadmin($checked_ids, $item_name, $parent_id='', $cat_id='') 
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('products/manage-products');	  	  
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
   if($item_name=='category') $this->data['message'] = "If you delete selected category, all related products and their images will be deleted. Are you sure you want to delete?";
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
	 $category_details=$this->Product_model->GetCategoryDetails($parent_id);	
	 $this->Product_model->DeleteCategories($all_ids, $parent_id);
	 if($parent_id > 0)
	 {
	  $this->RedirectPage(admin.'/products/manage-categories/'.$parent_id.'/'.($category_details['depth']+1), 'Selected category deleted successfully');
	 }
	 else
	 {
	  $this->RedirectPage(admin.'/products/manage-categories', 'Selected category deleted successfully');
	 }
	}
   } 
   else if($item_name=="product")
   {
    if(count($all_ids) > 0)
	{
	 $category_details=$this->Product_model->GetCategoryDetails($parent_id);	
	 $this->Product_model->DeleteProducts($all_ids, $parent_id);
	 $this->RedirectPage(admin.'/products/manage-products/'.$parent_id."/".($category_details['depth']), 'Selected product(s) deleted successfully');
	}
   } 
   else if($item_name=="image")
   {
    $values = array();
    $table_name = PRODUCT_IMAGES;
	$this->Login_model->DeleteImageBrochureRecord($all_ids, 'product_id', $parent_id, $table_name, 'image_file','./images/product/');
	
	if($cat_id=='') $this->RedirectPage(admin.'/products/manage-images/'.$parent_id,'Selected image(s) deleted successfully');
	else $this->RedirectPage(admin.'/products/manage-images/'.$parent_id.'/'.$cat_id,'Selected image(s) deleted successfully');
   }
   else if($item_name == "category_image_delete")
   {
    $values=array();
    $values=$this->Product_model->GetCategoryDetails($checked_ids);
	if(!empty($values['current_image']))
	{
	 unlink('./images/category/'.$values['current_image']);
	}
	$records['image_file']="";
	$records['image_quality']="";
	$this->Product_model->UpdateAfterDeletionImage($checked_ids,$records,CATEGORIES);
	$this->RedirectPage(admin.'/products/edit-category/'.$values['parent_id'].'/'.$values['depth'].'/'.$checked_ids,'Image has been deleted successfully');
   }
   else if($item_name=="brochure")
   {
    $values = array();
    $table_name = PRODUCT_BROCHURES;
	$this->Login_model->DeleteImageBrochureRecord($all_ids, 'product_id', $parent_id, $table_name, 'brochure_file','./brochures/product/');
	
	if($cat_id=='') $this->RedirectPage(admin.'/products/manage-brochures/'.$parent_id,'Selected brochure(s) deleted successfully');
	else $this->RedirectPage(admin.'/products/manage-brochures/'.$parent_id.'/'.$cat_id,'Selected brochure(s) deleted successfully');
   }
   elseif($item_name == "remove_clone")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('products/manage-products');	  	  
    $this->Product_model->RemoveClone($all_ids,$parent_id);
	$this->RedirectPage(admin.'/products/manage-products/'.$parent_id."/".$cat_id, 'Clone product has been removed from the category successfully');
   }
   
  }    
  
 }

