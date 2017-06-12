<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Leads extends MY_Controller
 {
  public $uploading_image_info;
  public $uploading_brochure_info;
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Leads_model');
   $this->load->helper('form');
   $this->load->library('CommonFunctions');	
  }

  public function download_excel() {
	   $from=$this->commonfunctions->ChangeDateFormat($this->uri->segment(4));
	    $to=$this->commonfunctions->ChangeDateFormat($this->uri->segment(5));
		$type=urldecode($this->uri->segment(6));
   		$list_records=$this->Leads_model->GetLeadsData($from,$to,$type);
		$XML = "Name \t Email \t Phone \t Source \t Message \t Date \t   \n";
			foreach($list_records as $lr) {
				
   			$message=str_replace("\r"," ",$lr['message']);
   			$message=str_replace("\n"," ",$message);

				
			$XML.= $lr['name']. "\t";
			$XML.= $lr['email']. "\t";
			$XML.= $lr['contact_no']. "\t";
			$XML.= $lr['question']. "\t";
			$XML.= $message. "\t";
			$XML.= $lr['date']. "\t \n";
			}
			 $file='Leads-report.xls';
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$file);
		echo $XML;
  }

  public function leads_report() 
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('leads/leads-report');
   $this->data['active_submodule']="leads-report";


   if($this->input->server('REQUEST_METHOD')==='POST')
   {
 	$this->data['f_rangeStart']=$this->input->post('f_rangeStart');
	$this->data['to_rangeStart']=$this->input->post('to_rangeStart');
	$this->data['reports_type']=$this->input->post('reports_type');
   }
   else
   {
 	$this->data['f_rangeStart']="01-".date("m-Y",@mktime());
	$this->data['to_rangeStart']=date("d-m-Y",@mktime());
    $this->data['reports_type']="Contact-Enquiry";
   }
   $from_date=$this->commonfunctions->ChangeDateFormat($this->data['f_rangeStart']);
   $to_date=$this->commonfunctions->ChangeDateFormat($this->data['to_rangeStart']);

   $this->data['list_records']=$this->Leads_model->GetLeadsData($from_date,$to_date,$this->data['reports_type']);

   $this->adminjavascript->include_admin_js=array('CalendarJs');
   $this->admincss->including_css_func=array('CalendarCss');   
   
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/leads/leads-report',$this->data);
   $this->load->view(admin.'/templates/footer');
  }

  public function view_lead_details() 
  {
   $id=$this->uri->segment(4);
   $this->data['records_data']=$this->Leads_model->GetLeadsDetails($id);
   $this->load->view(admin.'/leads/view-lead-details',$this->data);
  }
  
  public function leads_source() 
  {
   //$this->data['sub_modules']=$this->CheckSubModuleAccessibility('leads/leads_report');
   $this->data['active_submodule']="leads-source";
   $this->adminjavascript->include_admin_js=array('CalendarJs');
   $this->admincss->including_css_func=array('CalendarCss');   

   if($this->input->server('REQUEST_METHOD') === 'POST')
   {
 	$this->data['f_rangeStart']=$this->input->post('f_rangeStart');
	$this->data['to_rangeStart']=$this->input->post('to_rangeStart');
	$this->data['reports_type']=$this->input->post('reports_type');
   }
   else
   {
 	$this->data['f_rangeStart']="01-".date("m-Y",@mktime());
	$this->data['to_rangeStart']=date("d-m-Y",@mktime());
    $this->data['reports_type']="Contact-Enquiry";
   }
   $from_date=$this->commonfunctions->ChangeDateFormat($this->data['f_rangeStart']);
   $to_date=$this->commonfunctions->ChangeDateFormat($this->data['to_rangeStart']);
   
   $this->data['list_records']=$this->Leads_model->GetLeadsSourceData($from_date,$to_date,$this->data['reports_type']);

   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/leads/leads-source',$this->data);
   $this->load->view(admin.'/templates/footer');
   
  }
   public function newsletter_subscribers()
  {
   $this->data['sub_modules']=$this->CheckSubModuleAccessibility('leads/newsletter-subscribers');
   $this->data['active_submodule']="newsletter-subscribers";
   
   $this->data['subscribers'] = $this->Leads_model->GetNewsletterSubscribers();

   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/leads/newsletter-subscribers',$this->data);
   $this->load->view(admin.'/templates/footer');	  
  }  

 
 }
