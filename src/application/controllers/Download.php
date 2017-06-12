<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Download extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->library('CommonFunctions');	
  }
  public function index()
  {
   $values=array(); 
   $this->data['page_heading']=$this->Website_model->GetPageHeading(10);
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','6','Download');
   $this->data['banner']=$this->Website_model->GetBanner('downloads','0');
   $this->data['brochures']=$this->Website_model->GetDownloadBrochures();
   $this->load->view('templates/header',$this->data);
   $this->load->view('download',$this->data);
   $this->load->view('templates/footer');
  }
  public function Downloads($brochure_id)
  {
   $brochure_details=$this->Website_model->GetBrochureDetails(DOWNLOADS,$brochure_id);	  
   $file_name=$brochure_details['brochure_file'];	  
   $this->load->helper('download');
   $data = file_get_contents(base_url()."images/downloads/$file_name");
   force_download($file_name,$data);
  }
  
 }
