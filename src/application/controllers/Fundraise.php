<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fundraise extends MY_Controller {
  function __construct() {
    parent :: __construct();

    $this->load->model('Fundraise_model');
  }

  public function index() {
    $values=array();
    $caller=$this->input->post('caller');

    if($caller == 'Send') {
      $form_token = $this->session->userdata('form_token');

      if(!isset($form_token)) { $this->RedirectPage(); exit; }
      else if(isset($form_token) && $form_token != 'fundraise') { $this->RedirectPage(); exit; }

      if(!preg_match('/'.$_SERVER['HTTP_HOST'].'/',$_SERVER['HTTP_REFERER'])) {
        $this->RedirectPage(); exit;
      }	   

      $values['campaign_name']=$this->input->post('campaign_name');
      $values['campaign_goal']=$this->input->post('campaign_goal');
      $values['month']=$this->input->post('month');
      $values['year']=$this->input->post('year');
      $values['day']=$this->input->post('day');
      $values['campaign_type']=$this->input->post('campaign_type');
      $values['campaign_image']=$this->input->post('campaign_image');
      $values['statement']=$this->input->post('statement');
      $this->load->library('form_validation'); 
      $this->form_validation->set_error_delimiters('<span>','</span>');
      $this->form_validation->set_message('required','{field}');
      $this->form_validation->set_message('numeric','Invalid entry for campaign goal');
      $this->form_validation->set_rules('campaign_name','Please enter campaign name', 'trim|callback__value_required[campaign_name]');
      $this->form_validation->set_rules('campaign_goal','Please enter campaign goal', 'trim|required|numeric');
      $this->form_validation->set_rules('month', 'Please enter month', 'required|integer'); 
      $this->form_validation->set_rules('day', 'Please enter date', 'required|integer'); 
      $this->form_validation->set_rules('year', 'Please enter year', 'required|integer'); 


      if((!empty($values['year'])) && (!empty($values['month'])) && (!empty($values['day']))) {
        $this->form_validation->set_rules('month', 'Please enter valid date of birth', 'callback__ValidateEndDate['.$values['year'].'~'.$values['day'].']'); 
      }

      $this->form_validation->set_rules('campaign_type','Please enter choose campaign type', 'trim|required');

      if($this->form_validation->run() == TRUE) { 
        $campaign_records=array();

        if($values['campaign_type'] != '1') {
          $this->session->unset_userdata('birthday_pledge');
        }

        $this->session->unset_userdata('campaign_records');
        $campaign_url = strtolower(str_replace(' ','-',$this->commonfunctions->RemoveSpecialChars($values['campaign_name'])));		
        $values['url'] = $this->Fundraise_model->GenerateNewUrl($campaign_url);	 
        $campaign_records['campaign_name']=str_replace("?"," ",$values['campaign_name']);
        $campaign_records['campaign_goal']=$values['campaign_goal'];
        $campaign_records['campaign_end_date']=$values['day']."/".$values['month']."/".$values['year'];
        $campaign_records['campaign_type']=$values['campaign_type'];
        $campaign_records['campaign_image']=$values['campaign_image'];
        $campaign_records['statement']=$values['statement'];
        $campaign_records['url']=$values['url'];
        $this->session->set_userdata('campaign_records',$campaign_records);
        $this->RedirectPage('user/save');
      }

    } $this->session->set_userdata('form_token','fundraise');

    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',30,'Fundraise');
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',30);
    $this->data['page_heading']=$this->Website_model->GetPageHeading(9);
    $birthday_records=$this->session->userdata('birthday_pledge');

    if(count($birthday_records)> 0) $this->data['campign_type']=1;else  $this->data['campign_type']='';

    $this->data['attributes']=$this->Fundraise_model->GetFundraiseFormAttributes($values,$this->data['common_settings']['unit_fund'],$this->data['campign_type']);

    $this->websitejavascript->include_footer_js=array('FundraiseJs','SuccessMessageJs');
    $this->load->view('templates/header',$this->data);
    $this->load->view('fundraise/fundraise',$this->data);
    $this->load->view('templates/footer');
  }

  public function edit($campaign_id) {
    $this->load->model('User_model');	  
    $this->data['campaign_id']=$campaign_id;	  
    $this->data['campaign_details']=$this->User_model->GetCampaignDetails($this->data['campaign_id']);
    $this->UserSessionCheckOnIndividualPage();
    $this->data['loggedin_user']=$this->session->userdata('site_username');

    if($this->data['loggedin_user'] != $this->data['campaign_details']['username']) {
      $this->RedirectPage($this->data['campaign_details']['url']);
    } else {	  
      $values=array();
      $caller=$this->input->post('caller');

      if($caller == 'Send') {
        $form_token = $this->session->userdata('form_token');

        if(!isset($form_token)) { $this->RedirectPage(); exit; }
        else if(isset($form_token) && $form_token != 'fundraise') { $this->RedirectPage(); exit; }

        if(!preg_match('/'.$_SERVER['HTTP_HOST'].'/',$_SERVER['HTTP_REFERER'])) {
          $this->RedirectPage(); exit;
        }	   

        $values['campaign_name']=$this->input->post('campaign_name');
        $values['campaign_goal']=$this->input->post('campaign_goal');
        $values['campaign_image']=$this->input->post('campaign_image');
        $values['statement']=$this->input->post('statement');
        $this->load->library('form_validation'); 
        $this->form_validation->set_error_delimiters('<span>','</span>');
        $this->form_validation->set_message('required','{field}');
        $this->form_validation->set_message('numeric','Invalid entry for campaign goal');
        $this->form_validation->set_rules('campaign_name','Please enter campaign name', 'trim|callback__value_required[campaign_name]');
        $this->form_validation->set_rules('campaign_goal','Please enter campaign goal', 'trim|required|numeric');

        if($this->form_validation->run() == TRUE) { 
          $campaign_records=array();
          $campaign_records['campaign_name']=$this->commonfunctions->ReplaceSpecialChars(str_replace("?"," ",$values['campaign_name']));
          $campaign_records['campaign_goal']=$values['campaign_goal'];
          $campaign_records['statement']=$values['statement'];
          $campaign_records['campaign_image']=$values['campaign_image'];
          $this->session->unset_userdata('form_token');
          $this->Fundraise_model->UpdateCampaign($campaign_records,$this->data['campaign_id']);

          $donor_emails = $this->User_model->getCampaignDonorsEmails($this->data['campaign_id']);

          if(count($donor_emails) > 0) {
            $donor_email_ids=implode(",",$donor_emails);

            $campaign_records['campaign_details'] = $this->data['campaign_details'];
            $campaign_records['donor_email_ids'] = $donor_email_ids;
            $campaign_records['comments'] = 'Campaign details have been updated';

						$email = array(
							'message' => $this->load->view('email/campaign_update_to_donors', $campaign_records, TRUE),
							'subject' => "A new update to the sleepbus campaign you're supporting!",
							'from' => getenv('EMAIL_SEND_FROM'),
							'to' => getenv('ADMIN_EMAIL'),
							'bcc' => $donor_email_ids
						);

						$this->SendEmail($email);
          }

          $this->RedirectPage('campaign/' . $this->data['campaign_details']['url'],'Your campaign has been updated successfully');
        }

      } else {
        $this->session->set_userdata('form_token','fundraise');
        $values['campaign_name']=$this->data['campaign_details']['campaign_name'];
        $values['campaign_goal']=$this->data['campaign_details']['campaign_goal'];
        $values['statement']=$this->data['campaign_details']['statement'];
      }

      $values['campaign_id']=$this->data['campaign_id'];
      $values['campaign_type']=$this->data['campaign_details']['campaign_type'];
      $values['campaign_image']=$this->data['campaign_details']['campaign_image'];
      $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',30,'Fundraise');
      $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',30);
      $this->data['page_heading']=$this->Website_model->GetPageHeading(9);
      $this->data['attributes']=$this->Fundraise_model->GetEditFundraiseFormAttributes($values,$this->data['common_settings']['unit_fund']);
      $this->websitejavascript->include_footer_js=array('UpdateFundraiseJs');
      $this->load->view('templates/header',$this->data);
      $this->load->view('fundraise/edit-fundraise',$this->data);
      $this->load->view('templates/footer');
    }
  }

  public function getCampaignTypeInfo() {
    $this->data['campign_type']=$this->input->post('campaign_type');
    $this->data['attributes']=$this->Fundraise_model->GetCampaignInfoFormAttributes($this->data['campign_type']);
    $this->load->view('fundraise/campaing-type-info',$this->data);
  }

  public function validateDateFormat($date) {
    return 1 === preg_match(
        '~^(((0[1-9]|[12]\\d|3[01])\\/(0[13578]|1[02])\\/((19|[2-9]\\d)\\d{2}))|((0[1-9]|[12]\\d|30)\\/(0[13456789]|1[012])\\/((19|[2-9]\\d)\\d{2}))|((0[1-9]|1\\d|2[0-8])\\/02\\/((19|[2-9]\\d)\\d{2}))|(29\\/02\\/((1[6-9]|[2-9]\\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$~',
        $date
        );
  }

  public function _ValidateEndDate($month,$year_day) {
    list($year,$day)=explode("~",$year_day);  
    $cur_year=date("Y");
    $cur_month=date("m");
    $cur_date=date("d");
    $result=false;

    if($year == $cur_year) {
      if(($month == $cur_month)) {
        if($day > $cur_date) $result=true; 
      } else if($month > $cur_month) {
        $result=$this->ValidateDate($year,$month,$day);
      }
    } elseif($year > $cur_year) {
      $result=$this->ValidateDate($year,$month,$day);
    } 

    if(!$result) {
      $this->form_validation->set_message('_ValidateEndDate', 'Please enter valid end date');
      return false;

    }

    return true; 
  }

  public function GetLeapYear($year) {
    if((($year%4 == 0) && ($year%100 !=0)) or ($year%400 == 0)) return true;

    return false;
  } 

  public function ValidateDate($year,$month,$day) {
    if(($this->GetLeapYear($year))) $feb=29;
    else $feb=28; 

    $result=false; 
    $month_days=array('1'=>'31','2'=>$feb,'3'=>'31','4'=>'30','5'=>'31','6'=>'30','7'=>'31','8'=>'31','9'=>'30','10'=>'31','11'=>'30','12'=>'31');

    foreach($month_days as $month_key=>$day_value) {
      if($month_key == $month){if($day <= $day_value) $result=true;}
    }
    return $result;
  }

  public function _value_required($field_value,$field) {
    switch($field) {
      case "campaign_name" :
        if($field_value == "Give your campaign a name" or $field_value == "") {
          $this->form_validation->set_message('_value_required', 'Please give your campaign a name');
          return false;
        }
        
        return true;
        break;

      default:
        return true;
        break;
    }
  }
}
