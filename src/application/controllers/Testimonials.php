<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Testimonials extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->data['testi_ppr']=2;
   $this->load->library('CommonFunctions');
   $this->data['item']="testimonials";
   $this->data['menu_item']='muscleroom';
  }
  public function index()
  {
   $this->data['page_heading']=$this->Website_model->GetPageHeading(13);
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','5','Testimonials');
   $this->data['banner']=$this->Website_model->GetBanner('testimonials','0');
   $this->data['all_testimonials']=$this->Website_model->GetTestimonials();
   $this->data['all_video_testimonials']=$this->Website_model->GetVideoTestimonials();
   $this->data['total_video_records']=count($this->data['all_video_testimonials']);

   $this->data['total_records']=count($this->data['all_testimonials']);
   
   $this->data['ppr']=$this->data['testi_ppr']; 
   $cp=$this->session->flashdata('cp');
   
   if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}
   
   $this->data['pagination']=$this->commonfunctions->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
   
   
   $this->data['all_testimonials']=$this->Website_model->GetTestimonials("limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
    $this->data['pagination_video']=$this->commonfunctions->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_video_records']);
  
   $this->data['all_video_testimonials']=$this->Website_model->GetVideoTestimonials("limit ".$this->data['pagination_video']['start_limit'].",".   $this->data['pagination_video']['end_limit']);

   $this->websitejavascript->include_js=array('TestimonialsJs');
   $this->load->view('templates/header',$this->data);
   $this->load->view('testimonials',$this->data);
   $this->load->view('templates/footer');
  }
  public function DisplayTestimonials()
  {
   $this->data['ppr']=$this->input->post('ppr');
   $this->data['cp']=$this->input->post('cp');
   $this->data['all_testimonials']=array();
   $this->data['all_testimonials']=$this->Website_model->GetTestimonials();
    
   $this->data['total_records']=count($this->data['all_testimonials']); 
   $this->data['pagination']=$this->commonfunctions->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
   $this->data['all_testimonials']=$this->Website_model->GetTestimonials("limit ".$this->data['pagination']['start_limit'].",".$this->data['pagination']['end_limit']);

   $this->session->set_flashdata('cp',$this->data['cp']);
   
   $this->load->view('display-testimonials',$this->data);
  }
  
  public function DisplayVideoTestimonials()
  {
   $this->data['ppr']=$this->input->post('ppr');
   $this->data['cp']=$this->input->post('cp');
   $this->data['all_video_testimonials']=array();
   $this->data['all_video_testimonials']=$this->Website_model->GetVideoTestimonials();
    
   $this->data['total_video_records']=count($this->data['all_video_testimonials']); 
   $this->data['pagination_video']=$this->commonfunctions->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_video_records']);
   $this->data['all_video_testimonials']=$this->Website_model->GetVideoTestimonials("limit ".$this->data['pagination_video']['start_limit'].",".$this->data['pagination_video']['end_limit']);

   $this->session->set_flashdata('cp',$this->data['cp']);
   
   $this->load->view('display-video-testimonials',$this->data);
  }

 }
