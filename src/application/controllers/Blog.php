<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Blog extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->library('CommonFunctions');
   $this->load->Model('Blog_model');
   $this->data['blog_ppr']=4;
   $this->data['item']='blog';
   $this->data['menu_item']='blog';
   $this->data['left_category']=$this->Blog_model->BlogLeftCategories();
   $this->data['archives']=$this->Blog_model->BlogLeftArchives();
   $this->data['blog_categories']=$this->Blog_model->BlogLeftCategories();
  }

  public function blog_list($cp=1)
  {
   $this->websitejavascript->include_js=array('HomepageJs');
   $this->data['cp']=$cp;
   $this->data['blog_list']=array();
   $this->data['blog_list']=$this->Blog_model->GetAllBlog();
   
   $this->data['total_records']=count($this->data['blog_list']);  
     
   if($this->data['total_records'] == 0)
   {
    $this->error();
   }
   else
   {
    $this->data['page_heading']=$this->Website_model->GetPageHeading(53);
   
    $this->data['ppr']=$this->data['blog_ppr'];
	//$this->data['ppr']=$this->data['total_records'];
	$cp=$this->data['cp'];
    if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}

    $this->data['pagination']=$this->commonfunctions->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
    $this->data['meta']=$this->Metatags_model->GetMetaTags('BLOGS','0','Blog');
	$this->data['cta']=$this->Website_model->GetCTAButtons('BLOGS','0');
    $this->data['all_blogs']=$this->Blog_model->GetAllBlog("limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
	 
    $this->data['top_text']=$this->Website_model->GetTopText(5);
	 
  
    $this->load->view('templates/header',$this->data);
    $this->load->view('blog/blog-list',$this->data);
    $this->load->view('templates/footer');
   }
  }
  
  public function BlogCategory($cat_url,$cp=1)
  {
   $this->websitejavascript->include_js=array('HomepageJs');
   $this->data['cp']=$cp;
   $this->data['cat_url']=str_replace("_","-",$cat_url);
   $this->data['blog_list']=array();
   $this->data['cat_id']=$this->Blog_model->GetCatId($this->data['cat_url']);
   if(count($this->data['cat_id'])==0)
   {
	    $this->error();
 
   }
   else
   {
	$this->data['blog_list']=$this->Blog_model->GetCategoryBlog($this->data['cat_id']['id']);
    $this->data['category_details']=$this->Blog_model->GetCategoryDetails($this->data['cat_id']['id']);
    $this->data['total_records']=count($this->data['blog_list']);  
     
    $this->data['page_heading']=$this->Website_model->GetPageHeading(53);
   
    $this->data['ppr']=$this->data['blog_ppr'];
	$cp=$this->data['cp'];
    if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}

    $this->data['pagination']=$this->commonfunctions->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
    $this->data['meta']=$this->Metatags_model->GetMetaTags('BLOGS_CATEGORIES',$this->data['cat_id']['id'],$this->data['category_details']['category_name']);
	$this->data['cta']=$this->Website_model->GetCTAButtons('BLOGS_CATEGORIES',$this->data['cat_id']['id']);
	
	
    $this->data['all_blogs']=$this->Blog_model->GetCategoryBlog($this->data['cat_id']['id'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
	 
    $this->data['top_text']=$this->Website_model->GetTopText(5);
  
  
    $this->load->view('templates/header',$this->data);
    $this->load->view('blog/blog-list',$this->data);
    $this->load->view('templates/footer');
   }
  }
  
  public function BlogArchive($month,$year,$cp=1)
  {
   $this->websitejavascript->include_js=array('HomepageJs');
   $this->data['cp']=$cp;
   $this->data['archive_url']=$this->uri->segment(2);
   $date_list=explode("-",$this->data['archive_url']);
   $this->data['month']=$date_list[0];

   $this->data['year']=$date_list[1];
   $this->data['blog_list']=array();
 
   
   $this->data['blog_list']=$this->Blog_model->GetArchiveBlog($this->data['month'],$this->data['year']);
   
   $this->data['total_records']=count($this->data['blog_list']);  
     
   if($this->data['total_records'] == 0)
   {
    $this->error();
   }
   else
   {
    $this->data['page_heading']=$this->Website_model->GetPageHeading(53);
   
    $this->data['ppr']=$this->data['blog_ppr'];
	$cp=$this->data['cp'];
    if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}

    $this->data['pagination']=$this->commonfunctions->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
    $this->data['meta']=$this->Metatags_model->GetMetaTags('BLOGS_ARCHIVE',$month." ".$year,$month." ".$year);
    $this->data['blog_list']=$this->Blog_model->GetArchiveBlog($this->data['month'],$this->data['year'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
	 
  
  
    $this->load->view('templates/header',$this->data);
    $this->load->view('blog-archive',$this->data);
    $this->load->view('templates/footer');
   }
  }
  public function BlogDetails($cat_url,$blog_url)
  {
   $this->load->helper('text');	  
   $this->data['cat_url']=$cat_url;
   $this->data['blog_url']=$blog_url;
   
   $this->data['blog_details']=$this->Blog_model->GetBlogDetails(str_replace("_","-",$cat_url),str_replace("_","-",$blog_url));
   if((count($this->data['blog_details']) == 0))
   {
    $this->error();
   }
   else
   {
    $this->data['page_heading']=$this->Website_model->GetPageHeading(53);
	$this->data['meta']=$this->Metatags_model->GetMetaTags('BLOGS',$this->data['blog_details']['id'],$this->data['blog_details']['blog_title']);
	$this->data['cta']=$this->Website_model->GetCTAButtons('BLOGS',$this->data['blog_details']['id']);
	
    $this->data['right_blogs']=$this->Blog_model->GetCategoryBlog($this->data['blog_details']['cat_id'],"limit 0,5");

    $this->load->view('templates/header',$this->data);
    $this->load->view('blog/blog-details',$this->data);
    $this->load->view('templates/footer');
   }
  }
 }
