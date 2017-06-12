<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Products extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->library('CommonFunctions');
   $this->data['active_menu']="products"; 
  }
  public function index()
  {
   $this->data['page_heading']=$this->Website_model->GetPageHeading(33);
   $this->data['meta']=$this->Metatags_model->GetMetaTags('PRODUCTS','0','Products');
   $this->data['banner']=$this->Website_model->GetBanner('products','0');
   $this->data['top_text']=$this->Website_model->GetTopText(2);
   $this->load->view('templates/header',$this->data);
   $this->load->view('categories',$this->data);
   $this->load->view('templates/footer');
  }
  public function categories($cat_url)
  {
   $this->data['ppr']=9;
   $referer=$this->session->flashdata('cat_referer');
   if(isset($referer) and !empty($referer))
   {
    $cp=$this->session->flashdata('cp');
    if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;} 
   }
   else
   {
    $this->data['cp']=1;
   }
   $this->data['category_url']=str_replace("_","-",$cat_url);
   $this->data['category_details']=$this->Products_model->GetCategoryDetails($this->data['category_url']);
   $this->data['all_products']=$this->Products_model->GetProducts($this->data['category_url']);  
   $this->data['total_records']=count($this->data['all_products']);  
   $this->data['page_heading']=$this->Website_model->GetPageHeading(33);
   $this->data['banner']=$this->Website_model->GetBanner('categories',$this->data['category_details']['id']);
   $this->data['meta']=$this->Metatags_model->GetMetaTags('CATEGORIES',$this->data['category_details']['id'],$this->data['category_details']['category_name']);

   $this->data['pagination']=$this->commonfunctions->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
   $this->data['products']=$this->Products_model->GetProducts($this->data['category_url'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);

   $this->websitejavascript->include_js=array('ProductJs');

   $this->session->set_flashdata('cp',$this->data['cp']);

   $this->load->view('templates/header',$this->data);
   $this->load->view('category-details',$this->data);
   $this->load->view('templates/footer');
  }
  public function DisplayCategories()
  {
   $this->data['ppr']=$this->input->post('ppr');
   $this->data['cp']=$this->input->post('cp');
   $this->data['category_url']=$this->input->post('category_url');
   $this->data['all_products']=$this->Products_model->GetProducts($this->data['category_url']);  
   $this->data['total_records']=count($this->data['all_products']);  

   $this->data['pagination']=$this->commonfunctions->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
  
   $this->data['products']=$this->Products_model->GetProducts($this->data['category_url'],"limit ".$this->data['pagination']['start_limit'].",". $this->data['pagination']['end_limit']);
   

   $this->session->set_flashdata('cp',$this->data['cp']);
   $this->load->view('display-products',$this->data);
  }
  public function ProductDetails($product_url)
  {
   $this->data['product_url']=str_replace("_","-",$product_url);
   $this->data['product_details']=$this->Products_model->GetProductDetails($this->data['product_url']);
   $this->data['category_url']=$this->data['product_details']['category_url'];
   $this->data['all_products']=$this->Products_model->GetProducts($this->data['category_url']); 
   $this->data['brochures']=$this->Website_model->GetBrochures(PRODUCT_BROCHURES,'product_id',$this->data['product_details']['product_id']);
    
   $this->data['variants']=$this->Products_model->GetProductVariants($this->data['product_details']['product_id']);
   $this->data['related_projects']=$this->Products_model->GetRelatedProjects($this->data['product_details']['product_id']);

   $this->data['page_heading']=$this->Website_model->GetPageHeading(33);
   $this->data['banner']=$this->Website_model->GetBanner('products',$this->data['product_details']['cat_prod_id']);
   $this->data['meta']=$this->Metatags_model->GetMetaTags('PRODUCTS',$this->data['product_details']['cat_prod_id'],$this->data['product_details']['product_name']." - ".$this->data['product_details']['category_name']);
   
   $this->load->view('templates/header',$this->data);
   $this->load->view('product-details',$this->data);
   $this->load->view('templates/footer');
  }
  public function Downloads($brochure_id)
  {
   $brochure_details=$this->Website_model->GetBrochureDetails(PRODUCT_BROCHURES,$brochure_id);	  
   $file_name=$brochure_details['brochure_file'];	  
   $this->load->helper('download');
   $data = file_get_contents(base_url()."pdfs/product/$file_name");
   force_download($file_name,$data);
  }
 }
