<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class News extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->library('CommonFunctions');
   $this->load->Model('News_model');
   $this->data['year_news']=$this->News_model->GetYearOfNews();
   $this->data['news_ppr']=10;
   $this->data['image_ppr']=6;
  }
  public function index()
  {
   $this->data['year']=$this->uri->segment(2);
   $this->data['month']=$this->uri->segment(3);
   $this->data['news_list']=array();
   if(!empty($this->data['year']) and !empty($this->data['month']))
   {
    $this->data['news_list']=$this->News_model->GetNewsMonthly($this->data['year'],$this->data['month']);
	$this->data['news_section']='monthly';	 
   }
   else if(!empty($this->data['year']))
   {
    $this->data['news_list']=$this->News_model->GetNewsYearly($this->data['year']);
    $this->data['news_section']='yearly';	 		 
   }
   else
   {
    $this->data['news_list']=$this->News_model->GetAllNews();
    $this->data['news_section']='recent';	
   }
   
   $this->data['total_records']=count($this->data['news_list']);  
     
   if($this->data['total_records'] == 0 and  (!empty($this->data['year']) or !empty($this->data['month'])))
   {
    $this->error();
   }
   else
   {
    $this->data['page_heading']=$this->Website_model->GetPageHeading(29);
    $this->data['banner']=$this->Website_model->GetBanner('news','0');
    $this->data['ppr']=$this->data['news_ppr'];
	
	// code for maintaining back with pagination
	$referer=$this->session->flashdata('news_referer');
	if(isset($referer) and !empty($referer))
	{
	 if($referer == $this->data['news_section'])
	 {
	  $cp=$this->session->flashdata('cp');
      if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}
	 }
	 else
	 {
	  $this->data['cp']=1;
	 }
	}
	else
	{
	 $this->data['cp']=1;
	}
    /* ************************* */
	
    $this->data['pagination']=$this->commonfunctions->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
    if(!empty($this->data['year']) and !empty($this->data['month']))
    {
     $this->data['meta']=$this->Metatags_model->GetMetaTags('NEWS_DATE','0',ucfirst($this->data['month'])." - ".$this->data['year']." - News");
     $this->data['all_news']=$this->News_model->GetNewsMonthly($this->data['year'],$this->data['month'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
     $this->data['all_months']=$this->News_model->GetMonthsOfNews($this->data['year']);    
    }
    else if(!empty($this->data['year']))
    {
     $this->data['meta']=$this->Metatags_model->GetMetaTags('NEWS_DATE','0',$this->data['year']." - News");
     $this->data['all_news']=$this->News_model->GetNewsYearly($this->data['year'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
     $this->data['all_months']=$this->News_model->GetMonthsOfNews($this->data['year']);    
    }
	else
	{
     $this->data['meta']=$this->Metatags_model->GetMetaTags('NEWS','0','News');
     $this->data['all_news']=$this->News_model->GetAllNews("limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
 	}
 
    $this->session->set_flashdata('news_section',$this->data['news_section']);
    $this->websitejavascript->include_js=array('NewsJs');
    $this->load->view('templates/header',$this->data);
    $this->load->view('news',$this->data);
    $this->load->view('templates/footer');
   }
  }
  public function DisplayNews()
  {
   $this->data['ppr']=$this->input->post('ppr');
   $this->data['cp']=$this->input->post('cp');
   $this->data['news_section']=$this->input->post('news_section');
   $this->data['year']=$this->input->post('year');
   $this->data['month']=$this->input->post('month');
   $this->data['news_list']=array();
   if($this->data['news_section'] == "recent")
   {
    $this->data['news_list']=$this->News_model->GetAllNews();
   }
   elseif($this->data['news_section'] == "yearly")
   {
    $this->data['news_list']=$this->News_model->GetNewsYearly($this->data['year']);
   }
   elseif($this->data['news_section'] == "monthly")
   {
    $this->data['news_list']=$this->News_model->GetNewsMonthly($this->data['year'],$this->data['month']);
   }
    
   $this->data['total_records']=count($this->data['news_list']); 
   $this->data['pagination']=$this->commonfunctions->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);


   if($this->data['news_section'] == "recent")
   {
    $this->data['all_news']=$this->News_model->GetAllNews("limit ".$this->data['pagination']['start_limit'].",".$this->data['pagination']['end_limit']);
   }
   elseif($this->data['news_section'] == "yearly")
   {
    $this->data['all_news']=$this->News_model->GetNewsYearly($this->data['year'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
   }
   elseif($this->data['news_section'] == "monthly")
   {
    $this->data['all_news']=$this->News_model->GetNewsMonthly($this->data['year'],$this->data['month'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
   }

   $this->session->set_flashdata('cp',$this->data['cp']);
   $this->session->set_flashdata('news_section',$this->data['news_section']);
   
   $this->load->view('display-news',$this->data);
  }
  public function news_details($news_url)
  {
   $this->data['news_details']=$this->News_model->GetNewsDetails(str_replace("_","-",$news_url));
   if(count($this->data['news_details']) == 0)
   {
    $this->error();
   }
   else
   {
    $this->data['year']=$this->data['news_details']['news_year'];
    $this->data['month']=$this->data['news_details']['news_month'];
    $this->data['all_months']=$this->News_model->GetMonthsOfNews($this->data['year']);    
    $this->data['section_id']=$this->data['news_details']['id'];
	
    $this->data['page_heading']=$this->Website_model->GetPageHeading(29);
    $this->data['banner']=$this->Website_model->GetBanner('news',$this->data['news_details']['id']);
    $this->data['meta']=$this->Metatags_model->GetMetaTags('NEWS',$this->data['news_details']['id'],$this->data['news_details']['news_title']);
	
    // News Brochures
    $this->data['brochures']=$this->Website_model->GetBrochures(NEWS_BROCHURES,'news_id',$this->data['section_id']);

    // Image gallery Settings
    $this->data['total_records']=count($this->Website_model->GetImageGallery(NEWS_IMAGES,'news_id',$this->data['section_id'])); 
	if($this->data['total_records'] > 0)
	{ 
     $this->data['ppr']=$this->data['image_ppr'];
     $this->data['cp']=1;
     $this->data['pagination']=$this->commonfunctions->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
     $this->data['image_gallery']=$this->Website_model->GetImageGallery(NEWS_IMAGES,'news_id',$this->data['section_id'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);

     $this->data['image_folder']="news";
     $this->data['section']="news";  	  
     $this->websitejavascript->include_js=array('ImageGalleryJs');
     $this->websitecss->including_css_func=array('ImageGalleryCss');
	}
    $this->data['news_section']=$this->session->flashdata('news_section');
    $cp=$this->session->flashdata('cp');
	$this->session->set_flashdata('cp',$cp);
	$this->session->set_flashdata('news_referer',$this->data['news_section']);
    $this->load->view('templates/header',$this->data);
    $this->load->view('news-details',$this->data);
    $this->load->view('templates/footer');
   }
  }
  public function DisplayImageGallery()
  {
   $this->data['section_id']=$this->input->post('section_id'); 
   $this->data['ppr']=$this->input->post('ppr');
   $this->data['cp']=$this->input->post('cp');
   $this->data['total_records']=count($this->Website_model->GetImageGallery(NEWS_IMAGES,'news_id',$this->data['section_id'])); 
   $this->data['pagination']=$this->commonfunctions->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
   $this->data['image_gallery']=$this->Website_model->GetImageGallery(NEWS_IMAGES,'news_id',$this->data['section_id'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
   $this->data['section']="news";
   $this->data['image_folder']="news";
   
   
   $this->load->view('display-image-gallery',$this->data);
  }
  public function PopUpImageGallery($section_id,$position)
  {
   $this->data['section_id']=$section_id;
   $this->data['image_info']=$this->Website_model->GetImageGallery(NEWS_IMAGES,'news_id',$this->data['section_id']);
   $this->data['image_folder']="news";
   $this->data['position']=$position;
   $this->data['total_image']=count($this->data['image_info']);
   $this->load->view('popup-image-gallery',$this->data);
  }
  public function Downloads($brochure_id)
  {
   $brochure_details=$this->Website_model->GetBrochureDetails(NEWS_BROCHURES,$brochure_id);	  
   $file_name=$brochure_details['brochure_file'];	  
   $this->load->helper('download');
   $data = file_get_contents(base_url()."images/news/$file_name");
   force_download($file_name,$data);
  }
 }
