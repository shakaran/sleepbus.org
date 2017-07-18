<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign extends MY_Controller {
  function __construct() {
    parent :: __construct();

    $this->load->model('User_model');   
    $this->load->model('Campaign_model');
    $this->data['ppr']=10;
  }

  public function show($campaign_url) {
    $campaign_id = $this->Campaign_model->GetCampaignIDByURL($campaign_url);
    $this->campaign_details($campaign_id);
  }

  public function campaign_details($campaign_id) {
    $this->data['campaign_id']=$campaign_id;	  
    $this->data['campaign_details']=$this->User_model->GetCampaignDetails($this->data['campaign_id']);
    $this->data['campaign_comments']=$this->User_model->GetCampaignComments($this->data['campaign_id']);
    $this->UserSessionCheckOnIndividualPage();
    $this->data['loggedin_user']=$this->session->userdata('site_username');
    $this->data['campaign_settings']=$this->User_model->getDefaultCampaignBanner();

    if($this->data['loggedin_user'] == $this->data['campaign_details']['username']) {
      $values=array();
      $caller=$this->input->post('caller'); 

      if($caller == "Send") {
        $values['comments']=$this->input->post('comments');

        if($values['comments'] == 'Post an update about your campaign!') $values['comments']='';	

        $values['email_to_donors']=$this->input->post('email_to_donors');
        $records=array();
        $records['comments']=$values['comments'];
        $records['campaign_id']=$this->data['campaign_id'];

        $this->User_model->InsertComment($records);

        if(($values['email_to_donors'] == 'yes') and !empty($values['comments'])) {
          $donor_emails=$this->User_model->getCampaignDonorsEmails($this->data['campaign_id']);

          if(count($donor_emails) > 0) {
            $donor_email_ids=implode(",",$donor_emails);

            $records['campaign_details'] = $this->data['campaign_details'];
            $records['donor_email_ids'] = $donor_email_ids;

						$email = array(
              'layout' => 'email/layouts/transactional',
							'body' => $this->load->view('email/campaign_update_to_donors', $records, TRUE),
							'subject' => "A new update to the sleepbus campaign you're supporting!",
							'from' => getenv('EMAIL_SEND_FROM'),
							'to' => getenv('ADMIN_EMAIL'),
							'bcc' => $donor_email_ids
						);

						$this->SendEmail($email);
          }

          $success_message="Your comment has been updated and email has been sent to your donors for this update successfully";
        } else $success_message="Your comment has been updated successfully";

        $this->RedirectPage('campaign/' . $this->data['campaign_details']['url'], $success_message);

      } else $values['comments']='';

      $values['url']=$this->data['campaign_details']['url'];
      $this->data['attributes']=$this->User_model->getUserCommentFormAttributes($values); 
    } 

    $this->data['total_donations']=$this->User_model->GetAllDonationOfCampaign($this->data['campaign_id']);   

    if($this->data['total_donations'] > 0) {   
      $this->data['cp']=1;
      $this->data['pagination']=$this->commonfunctions->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_donations']);
      $this->data['donations']=$this->User_model->GetAllDonationOfCampaign($this->data['campaign_id'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
    }

    $this->websitejavascript->include_footer_js=array('CampaignJs','SuccessMessageJs');
    $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE','31',$this->data['campaign_details']['campaign_name']);
    $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE','31'); 
    $this->data['active_menu']="campaign";  
    $this->load->view('templates/header',$this->data);
    $this->load->view('campaign/campaign-details',$this->data);
    $this->load->view('templates/footer');
  }

  public function getMoreRecords() {
    $this->data['cp']=$this->input->post('cp');
    $this->data['campaign_id']=$this->input->post('campaign_id');
    $this->data['total_donations']=$this->User_model->GetAllDonationOfCampaign($this->data['campaign_id']);   

    if($this->data['total_donations'] > 0) {   
      $this->data['pagination']=$this->commonfunctions->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_donations']);
      $this->data['donations']=$this->User_model->GetAllDonationOfCampaign($this->data['campaign_id'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
      $this->load->view('campaign/getDonationRecords',$this->data);
    }
  }

  public function deletecomment($campaign_url,$comment_id) {
    $this->User_model->DeleteComment($comment_id);  
    $success_message="Your comment has been deleted successfully";   
    $campaign_url=str_replace("_","-",$campaign_url);
    $this->RedirectPage('campaign/' . $campaign_url, $success_message);
  }
}
