<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
  }
  public function index()
  {
/*	  echo "<pre>";
	  print_r($_SERVER);
	  echo "</pre>";
*/    $values_monthly=array();	
    $values=array();
    $caller2=$this->input->post('caller2');
    if($caller2 == 'Send')
    {
 	 $form_token = $this->session->userdata('form_token');
     if(!isset($form_token)) { $this->RedirectPage(); exit; }
	 else if(isset($form_token) && $form_token != 'donation') { $this->RedirectPage(); exit; }
	   
     if(!preg_match('/'.$_SERVER['HTTP_HOST'].'/',$_SERVER['HTTP_REFERER']))
     {
      $this->RedirectPage(); exit;
     }	   
	   
     $values_monthly['monthly_amount']=$this->input->post('monthly_amount');

     $this->load->library('form_validation'); 
     $this->form_validation->set_error_delimiters('<span>','</span>');
     $this->form_validation->set_message('required','{field}');
	 $this->form_validation->set_message('numeric','Please enter valid amount');
	
	 
     $this->form_validation->set_rules('monthly_amount','Please enter donation amount', 'trim|required|numeric');

     if($this->form_validation->run() == TRUE)
     { 
	  $donation=array();
	  $monthly_amount=$values_monthly['monthly_amount'];
	  
      $this->session->unset_userdata('monthly_amount');
	  $this->session->set_userdata('monthly_amount',$monthly_amount);

	  $this->session->unset_userdata('form_token');
	  $this->RedirectPage('recurring/expresscheckout');
	 }

    }
	else
	{
	 $this->session->set_userdata('form_token','donation');
	}




   $this->data['banners']=$this->Website_model->GetHomePageBanners();


   $this->data['page_heading']=$this->Website_model->GetPageHeading(1);
 


    $this->data['attribute_monthly']=$this->Website_model->GetMonthlyDonateFormAttributes($values_monthly,$this->data['common_settings']['unit_fund']);
    $this->data['attribute']=$this->Website_model->GetDonateFormForOneTimeAttributes($values,$this->data['common_settings']['unit_fund']);


   $this->data['section_id']=1;
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',$this->data['section_id'],'Home');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',$this->data['section_id']);
   
   $this->data['contents']=$this->Website_model->GetPageContent($this->data['section_id']);
   $this->data['top_message']=$this->data['contents']['intro_text'];
   $this->websitejavascript->include_footer_js=array('RecurringDonationJs');
   
$this->data['monthly_donation_form']=$this->load->view('home/monthly-donation-form',$this->data,true);
   $this->data['one_time_donation_form']=$this->load->view('home/one-time-donation-form',$this->data,true);
   $this->load->view('templates/header',$this->data);
   $this->load->view('home/home',$this->data);
   $this->load->view('templates/footer');
  }
 }
