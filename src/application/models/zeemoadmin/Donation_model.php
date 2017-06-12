<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Donation_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }
  public function GetTopTextFormAttribute($values)
  {
   $attribute['form'] = array('onSubmit'=>'return true;');
   $attribute['content']=array('name'=> 'content','id'=> 'content_id','value'=>$values['content']);
   $attribute['submit'] = array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }
  public function GetOneYearSafeSleepFormAttribute($values1,$values2)
  {
   $attribute['form'] = array('onSubmit'=>'return true;');
   $attribute['content1']=array('name'=> 'content1','id'=> 'content1','value'=>$values1['content']);
   $attribute['content2']=array('name'=> 'content2','id'=> 'content2','value'=>$values2['content']);

   $attribute['submit'] = array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }
  
  public function GetSupportFormAttribute($values,$edit_id='')
  {
   $attribute['form'] = array('onSubmit'=>'return ValidateSupportForm();');
   $attribute['support_title'] = array('name'=>'support_title', 'id'=> 'support_title', 'value'=>$values['support_title'], 'size'=>'41');
   $attribute['intro_text'] = array('name'=>'intro_text', 'id'=> 'intro_text', 'value'=>$values['intro_text'], 'rows'=>'4', 'cols'=>'32');

   if(!empty($edit_id))
   {
	$attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Update');
   }
   else $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Submit');

   return $attribute;
  } 
  public function GetDonationReport($from_date,$to_date,$donation_type='')
  {
   return $this->db_query->FetchInformation(DONATIONS,"id~donor_name~payer_email~paid_amount as donation~donation_type~DATE_FORMAT(payment_date,'%d %b %y %h:%i %p') as donation_date"," dateadded between '$from_date' and '$to_date 23:59:59' and donation_type like '%$donation_type%' order by dateadded desc,payment_date desc"); 
  }
  public function GetTotalDonation($from_date,$to_date,$donation_type='')
  {
   $sql="select sum(don.paid_amount) as total_amount,don.donation_type from ".DONATIONS." don where dateadded between '$from_date' and '$to_date 23:59:59' and donation_type like '%$donation_type%' group by donation_type order by donation_type";
   $res=$this->db->query($sql);
   return $res->result_array();
  }
  public function GetDonationDetails($donation_id)
  {
   $sql="select DATE_FORMAT(don.payment_date,'%d %b %y %h:%i %p') as donation_date,don.* from ".DONATIONS."  don where don.id='".$donation_id."'";
   $res=$this->db->query($sql);
   $donation_details=array();
   if($res->num_rows() > 0)
   {
	 $row=$res->row_array();  
   // foreach($res->row_array() as $row)
	//{
	 $donation_details['donation_type'] =$row['donation_type'];
	 $donation_details['donation_date'] =$row['donation_date'];
	 $donation_details['transaction_no'] =$row['transaction_no'];
	 $donation_details['paid_amount'] =$row['paid_amount'];
	 $donation_details['donor_name'] =$row['donor_name'];
	 $donation_details['payer_email'] =$row['payer_email'];
	 $donation_details['status'] =$row['status'];
	 $donation_details['comment'] =$row['comment'];
	 $donation_details['anonymous'] =$row['anonymous'];
	 $donation_details['comment'] =$row['comment'];
	 $donation_details['profile_id'] =$row['profile_id'];
	 $donation_details['profile_status'] =$row['profile_status'];
	 $donation_details['correlation_id'] =$row['correlation_id'];
	 $donation_details['version'] =$row['version'];
	 $donation_details['build'] =$row['build'];
	 $donation_details['campaign_id'] =$row['campaign_id'];
	 $donation_details['registered_user_id'] =$row['registered_user_id'];
	 
	 if((!empty($row['campaign_id'])) and ($row['campaign_id'] > 0))
	 {
	  $donation_details['campaign_details']=$this->GetCampaignDetails($row['campaign_id']);
	 }
	 if((!empty($row['registered_user_id'])) and ($row['registered_user_id'] > 0))
	 {
	  $donation_details['registered_user_details']=$this->GetUserDetails($row['registered_user_id']);
	 }
	 
	//}
   }   
   return $donation_details;
  }
  public function GetCampaignDetails($campaign_id)
  {
   $sql="select uc.*,date_format(uc.dateadded,'%a %d %b %Y') as start_date,date_format(uc.campaign_end_date,'%a %d %b %Y') as end_date,ct.type_name from ".USER_CAMPAIGNS." uc inner join ".CAMPAIGN_TYPE." ct on uc.campaign_type=ct.id where uc.id='".$campaign_id."'";
   $res=$this->db->query($sql);
   $campaigns=array();
   if($res->num_rows() > 0)
   {
    foreach($res->result() as $row)
	{
	 $campaigns['campaign_name']=$row->campaign_name;
	 $campaigns['campaign_goal']=$row->campaign_goal;
	 $campaigns['campaign_type']=$row->type_name;
	 $campaigns['raised_amount']=$this->GetUserCampaignRaisedAmount($row->id);
	 $campaigns['start_date']=$row->start_date;
	 $campaigns['end_date']=$row->end_date;
	 $campaigns['status']=$row->status;
	 $campaigns['campaign_type_id']=$row->campaign_type;
	 $campaigns['url']=$row->url;
	}
   }
   return $campaigns;
  }
  public function GetUserCampaignRaisedAmount($campign_id)
  {
   $sql="select sum(don.paid_amount) as total_amount from ".DONATIONS." don where donation_type='campaign' and campaign_id= '".$campign_id."'";
   $res=$this->db->query($sql);
   if($res->num_rows() > 0)
   {
    $row=$res->row_array();
	return $row['total_amount'];
   }
   return '0';
  }
  public function GetUserDetails($user_id)
  {
   $sql="select full_name,status,email,phone from ".USERS." where id='".$user_id."'";
   $res=$this->db->query($sql);
   return $res->row_array(); 
  }
 } 
?>