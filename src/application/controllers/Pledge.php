<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Pledge extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->model('Pledge_model');
  }
  public function index()
  {
   $status=$this->Pledge_model->VerifyBirthdayPledge();
   if(!$status)
   {
    $this->error();
   }
   else
   {
    $caller=$this->input->post('caller'); 
    $values=array();
    if($caller == "Send")
    {
 	 $form_token = $this->session->userdata('form_token');
     if(!isset($form_token)) { $this->RedirectPage(); exit; }
	 else if(isset($form_token) && $form_token != 'pledge') { $this->RedirectPage(); exit; }
	   
     if(!preg_match('/'.$_SERVER['HTTP_HOST'].'/',$_SERVER['HTTP_REFERER']))
     {
      $this->RedirectPage(); exit;
     }	   
	   
     $values['full_name']=$this->input->post('full_name');
     $values['email']=$this->input->post('email');
     $values['month']=$this->input->post('month');
     $values['year']=$this->input->post('year');
     $values['day']=$this->input->post('day');
     $values['newsletter_subscription']=$this->input->post('newsletter_subscription');

     $this->load->library('form_validation'); 
     $this->form_validation->set_error_delimiters('<span>','</span>');
     $this->form_validation->set_message('required','{field}');
     $this->form_validation->set_message('valid_email','Invalid email address');
	 $this->form_validation->set_message('integer','Invalid entry for {field}');
	
	 $this->form_validation->set_rules('month', 'Please enter month', 'required|integer'); 
	 $this->form_validation->set_rules('day', 'Please enter date', 'required|integer'); 
	 $this->form_validation->set_rules('year', 'Please enter year', 'required|integer'); 
	 
	 if((!empty($values['year'])) && (!empty($values['month'])) && (!empty($values['day'])))
	 {
 	  $this->form_validation->set_rules('month', 'Please enter valid date of birth', 'callback__validateBirthDate['.$values['year'].'~'.$values['day'].']'); 
	 }
     $this->form_validation->set_rules('full_name','Please enter your name', 'trim|callback__value_required[full_name]');
     $this->form_validation->set_rules('email', 'Please enter email', 'trim|required|valid_email');

	
     if($this->form_validation->run() == TRUE)
     { 
	 
	  //$this->Pledge_model->InsertUserInformation($records);
	 


      $this->session->unset_userdata('birthday_pledge');

	  $birthday_pledge['full_name']=$values['full_name'];
	  $birthday_pledge['email']=$values['email'];
	  $birthday_pledge['date_of_birth']=$values['day']."-".$values['month']."-".$values['year'];
	  $birthday_pledge['dob_real_format']=$values['day']."/".$values['month']."/".$values['year'];
	  $birthday_pledge['newsletter_subscription']=$values['newsletter_subscription'];
	  
/*	  $birthday_pledge['month']=$values['month'];
	  $birthday_pledge['year']=$values['year'];
	  $birthday_pledge['day']=$values['day'];
*/	  
      $this->session->set_userdata('birthday_pledge',$birthday_pledge);
  
   
    // $this->SendMessage($records);
     $this->data['thanks']=$this->Website_model->GetThankMessages(6);
	
	 $this->RedirectPage('fundraise',$this->data['thanks']['message']);
    }
   }else $this->session->set_userdata('form_token','pledge');



   	  
    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',29,'Birthday Pledge');
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',29);
    $this->data['top_text']=$this->Website_model->GetTopText(13);
    $this->data['page_heading']=$this->Website_model->GetPageHeading(11);
    $this->websitejavascript->include_footer_js=array('PledgeJs');
    $this->data['attributes']=$this->Pledge_model->GetPledgeFormAttributes($values);
    $this->load->view('templates/header',$this->data);
    $this->load->view('pledge/birthday-pledge',$this->data);
    $this->load->view('templates/footer');
   }
  }
  public function _validateBirthDate($month,$year_day)
  {
   $cur_year=date("Y");
   $cur_month=date("m");
   $cur_date=date("d");
   $result=false;
   list($year,$day)=explode("~",$year_day);
   if($year == $cur_year)
   {
    if(($month == $cur_month))
	{
	 if($day <= $cur_date) $result=true;
	}
	else if($month < $cur_month)
	{
	 $result=$this->ValidateDate($year,$month,$day);
	}
   }
   elseif($year < $cur_year)
   {
    $result=$this->ValidateDate($year,$month,$day);
   } 
   if(!$result)
   {
    $this->form_validation->set_message('_validateBirthDate', 'Please enter valid date of birth in DD|MM|YYYY format');
    return false;

   } else return true; 
  }
  public function GetLeapYear($year)
  {
   if((($year%4 == 0) && ($year%100 !=0)) or ($year%400 == 0)) return true;
   else return false;
   
  } 
  public function ValidateDate($year,$month,$day)
  {
   if(($this->GetLeapYear($year))) $feb=29;
   else $feb=28; 
   $result=false; 
   $month_days=array('1'=>'31','2'=>$feb,'3'=>'31','4'=>'30','5'=>'31','6'=>'30','7'=>'31','8'=>'31','9'=>'30','10'=>'31','11'=>'30','12'=>'31');
   foreach($month_days as $month_key=>$day_value)
   {
    if($month_key == $month){if($day <= $day_value) $result=true;}
   }
   return $result;
  }
  
  public function _value_required($field_value,$field)
  {
   switch($field)
   {
    case "full_name" :
	if($field_value == "Full name" or $field_value == "")
	{
	 $this->form_validation->set_message('_value_required', 'Please enter name');
	 return false;
	}
	else return true;
	break;

	default:
	return true;
	break;
   }
  }
  
  
 }
