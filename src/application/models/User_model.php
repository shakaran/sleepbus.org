<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class User_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetPageContents($id)
  {
   return $this->db->select("content")->from(TOP_TEXT)->where('id',$id)->get()->row_array();
  }
  public function GetProfileFormAttribute($values)
  {
   if(count($values) == 0)
   {
    $values=array('new_email'=>'','retype_email'=>'');
   }	  
    $attribute['form'] = array('onSubmit'=>'return ValidateProfileForm();' ,'name'=>'event_frm');
    // Contact information attributes
    $attribute['full_name'] = array('name'=>'full_name', 'id'=> 'full_name', 'value'=>$values['full_name'],"class"=>"form-control");

    $attribute['email'] = array('name'=>'email', 'id'=> 'email', 'value'=>$values['email'],'readonly'=>'readonly',"class"=>"form-control fiftypercent inputbg");
	
    $attribute['new_email'] = array('name'=>'new_email', 'id'=> 'new_email', 'value'=>$values['new_email'],"class"=>"form-control inputbg");
    $attribute['retype_email'] = array('name'=>'retype_email', 'id'=> 'retype_email', 'value'=>$values['retype_email'],"class"=>"form-control inputbg");
    $attribute['phone'] = array('name'=>'phone', 'id'=> 'phone', 'value'=>$values['phone'],"class"=>"form-control");
   
    $attribute['current_password'] = array('name'=>'current_password', 'id'=> 'current_password',"class"=>"form-control fiftypercent inputbg");
    $attribute['new_password'] = array('name'=>'new_password', 'id'=> 'new_password',"class"=>"form-control inputbg");
    $attribute['retype_password'] = array('name'=>'retype_password', 'id'=> 'retype_password',"class"=>"form-control inputbg");

	
    $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'UPDATE PROFILE',"class"=>"btn btn-primary");
 
	
	
   return $attribute;
  }
  public function SaveProfileInfo($records)
  {
   //$records=$this->db_query->TrimValues($record);
   $records['modified_by_user']='user';   
   $this->db->where('email',$this->session->userdata('site_username'));
   $this->db->update(USERS,$records);
  }
  public function GetUserDetails()
  {
   return $this->db->select('full_name,account_type,other_type,email,password,phone,id')->from(USERS)->where('email',$this->session->userdata('site_username'))->get()->row_array();
  }
  public function CheckUniqueEmail($email)
  {
   $sql="select id from ".USERS." where email='".$email."'";
   $res=$this->db->query($sql);
   if($res->num_rows() > 0) return true;
   else return false;
  }
  public function ChangePasswordFormAttributes()
  {
   $values=array('old_password'=>'','new_password'=>'','retype_password'=>'');  
   $attribute['form'] = array('onSubmit'=>'return ValidateChangePasswordForm();' ,'name'=>'change_password_frm');
   $attribute['old_password'] = array('name'=>'old_password', 'id'=> 'old_password', 'value'=>$values['old_password'],'placeholder'=>'Old Password');
   $attribute['new_password'] = array('name'=>'new_password', 'id'=> 'new_password', 'value'=>$values['new_password'],'placeholder'=>'New Password');

   $attribute['retype_password'] = array('name'=>'retype_password', 'id'=> 'retype_password', 'value'=>$values['retype_password'],'placeholder'=>'Retype Password');

   $attribute['submit'] = array('name' => 'submit_value','class'=>'PreviewListing','id' => 'submit_value','value' => 'SUBMIT');
   return $attribute;
  }
  public function InsertCampaignRecords($record)
  {
   $records = $this->db_query->TrimValues($record);
   $records['dateadded'] = date('Y-m-d H:i:s');   
   $this->db->insert(USER_CAMPAIGNS,$records);
  }
  public function InsertBirthdayPledge($record)
  {
   $records = $this->db_query->TrimValues($record);
   $records['dateadded'] = date('Y-m-d H:i:s');   
   $this->db->insert(BIRTHDAY_PLEDGE,$records);
  }
  public function InsertComment($record)
  {
   $records = $this->db_query->TrimValues($record);
   $this->db->insert(CAMPAIGN_COMMENTS,$records);
  }
  public function GetUserCampaigns($user_id)
  {
   $sql="select * from ".USER_CAMPAIGNS." where user_id='".$user_id."' order by dateadded desc";
   $res=$this->db->query($sql);
   $campaigns=array();
   if($res->num_rows() > 0)
   {
	$c=0;   
    foreach($res->result() as $row)
	{
	 $campaigns[$c]['campaign_name']=$row->campaign_name;
	 $campaigns[$c]['campaign_goal']=$row->campaign_goal;
	 $campaigns[$c]['campaign_type']=$row->campaign_type;	 
	 $campaigns[$c]['id']=$row->id;
	 $campaigns[$c]['amount']=$this->getRaisedAmountOfCampaign($row->id);
	 $campaigns[$c]['url']=$row->url;
	 $campaigns[$c]['status']=$row->status;
	 $c++;
	}
   }
   return $campaigns;  
  }  
  public function GetCampaignDetails($campaign_id)
  {
   $sql="select uc.*,sum(don.paid_amount) as total_raise, datediff(uc.campaign_end_date,curdate()) as days_left,ci.image_file,user.email as username,user.full_name,ct.mission_statement from ".USER_CAMPAIGNS." uc inner join ".USERS." user on uc.user_id=user.id inner join ".CAMPAIGN_TYPE." ct on uc.campaign_type=ct.id left join ".CAMPAIGN_IMAGES."  ci on uc.campaign_image=ci.id left join ".DONATIONS." don on don.campaign_id=uc.id where uc.id='".$campaign_id."'";	  
   $res=$this->db->query($sql);
   $campaign_details=array();
   if($res->num_rows() > 0)
   {
    $row=$res->row_array();
	$campaign_details['campaign_name']=$row['campaign_name'];
	$campaign_details['campaign_type']=$row['campaign_type'];	
	$campaign_details['campaign_goal']=$row['campaign_goal'];
	$campaign_details['user_full_name']=$row['full_name'];
	$campaign_details['campaign_type']=$row['campaign_type'];
	$campaign_details['username']=$row['username'];
	$campaign_details['url']=$row['url'];
	$campaign_details['mission_statement']=$row['statement'];
	$campaign_details['days_left']=$row['days_left'];
	$campaign_details['status']=$row['status'];
	$campaign_details['image_file']=$row['image_file'];
	$campaign_details['statement']=$row['statement'];
	$campaign_details['total_raise']=$row['total_raise'];
	$campaign_details['campaign_image']=$row['campaign_image'];	
   }  
   return $campaign_details;
  }
  public function getDefaultCampaignBanner()
  {
   return $this->db->select('common_banner,campaign_logo')->from(CAMPAIGN_SETTINGS)->get()->row_array();
  }
  public function getUserCommentFormAttributes($values)
  {
   $attribute=array();
   $attribute['form']=array('id'=>'comment_frm','name'=>'comment_frm','onSubmit'=>'return true;');
	  
   $attribute['comments']=array('name'=> 'comments','id'=> 'comments','value'=>$values['comments'],'placeholder'=>'Post an update about your campaign!',"class"=>"form-control","rows"=>'3');

    $attribute['email_to_donors'] = array('name'=>'email_to_donors', 'id'=> 'email_to_donors', 'value'=>'yes');

   $attribute['share_url']=$values['url'];
      
   $attribute['submit']=array('type' => 'submit', 'name' => 'form_submit','id'=>'form_submit','value'=>"post update","class"=>"btn btn-primary");
   return $attribute;
  }
  public function UpdateComment($records,$campaign_id)
  {
   $records = $this->db_query->TrimValues($records);
   $this->db->where('id',$campaign_id);
   $this->db->update(USER_CAMPAIGNS, $records);
  }
  public function getRaisedAmountOfCampaign($campign_id)
  {
   $sql="select sum(paid_amount) as raised_amount from ".DONATIONS." where donation_type='campaign' and campaign_id='".$campign_id."'";
   $res=$this->db->query($sql);
   return $res->row_array();
  }
  public function GetTotalRaisedAmount($user_id)
  {
   $sql="select sum(d.paid_amount) as amount from ".USER_CAMPAIGNS." uc inner join ".DONATIONS." d on uc.id=d.campaign_id where d.donation_type='campaign' and uc.user_id='".$user_id."'";
   $res=$this->db->query($sql);
   return $res->row_array();
  }
  public function GetUserDonation($user_id)
  {
    $sql="select sum(d.paid_amount) as amount from ".DONATIONS." d where d.registered_user_id='".$user_id."'";
    $res=$this->db->query($sql);

    $totalDonated = $res->row_array();

    if ($totalDonated['amount']) {
        return $totalDonated['amount'];
    }

    return 0;
  }

  public function HasMadeOneTimeDonation($user_id) {
    $sql="select email from ".USERS."  where id='".$user_id."'";
    $res=$this->db->query($sql);
    if ($res->row()) {
        $userEmail = $res->first_row()->email;

        $sql = "select * from donations WHERE payer_email ='".$userEmail."' and donation_type = 'one-time-donation'";

        $res = $this->db->query($sql);

        return $res->row();
    }

    return false;
  }

  public function HasMadeMonthlyDonation($user_id) {
    $sql="select email from ".USERS."  where id='".$user_id."'";
    $res=$this->db->query($sql);
    if ($res->row()) {
        $userEmail = $res->first_row()->email;

        $sql = "select * from donations WHERE payer_email ='".$userEmail."' and donation_type = 'monthly'";

        $res = $this->db->query($sql);

        return $res->row();
    }

    return false;
  }

  public function HasMadeBirthdayPledge($user_id) {
    $sql = "select * from birthday_pledge WHERE user_id ='".$user_id."'";

    $res = $this->db->query($sql);

    return $res->row();
  }

  public function HasCreatedCampaign($user_id) {
    $sql = "select * from ".USER_CAMPAIGNS." uc WHERE uc.user_id ='".$user_id."'";

    $res = $this->db->query($sql);

    return $res->row();
  }

  public function GetDonationHistory($user_id)
  {
   // get user's email address 
   $sql="select email from ".USERS."  where id='".$user_id."'";
   $res=$this->db->query($sql);

   $userEmail = $res->first_row()->email;

   $sql="select uc.url,uc.campaign_name,d.paid_amount,d.donation_type,DATE_FORMAT(d.`payment_date`, '%d.%m.%y') as payment_date,d.campaign_id from ".USER_CAMPAIGNS." uc inner join ".DONATIONS." d on uc.id=d.campaign_id where d.payer_email='".$userEmail."'";


   $res=$this->db->query($sql);

   $campaign_donations = $res->result_array();

   $sql="select d.donation_type,d.paid_amount,d.donation_type,DATE_FORMAT(d.`payment_date`, '%d.%m.%y') as payment_date,d.campaign_id from ".DONATIONS." d where d.payer_email='".$userEmail."' and d.campaign_id = 0";


   $res=$this->db->query($sql);

   $noncampaign_donations = $res->result_array();

   return array_merge($campaign_donations, $noncampaign_donations);
  }

  public function GetAllDonationOfCampaign($campaign_id,$limit='')
  {
   $sql="select * from ".DONATIONS." where donation_type='campaign' and campaign_id='".$campaign_id."' order by payment_date desc ".$limit;
   $res=$this->db->query($sql);
   $donations=array();
   if(empty($limit)) return $res->num_rows();
   else
   {
    if($res->num_rows() > 0)
	{
	 $d=0;	
     foreach($res->result() as $row)
	 {
      $donations[$d]['paid_amount']=$row->paid_amount;
      $donations[$d]['donor_name']=$row->donor_name;
      $donations[$d]['comment']=$row->comment;
      $donations[$d]['anonymous']=$row->anonymous;
	  $donations[$d]['time_ago']=$this->getTimeAgo($row->payment_date);
	  $d++;
	 }
	}
   }
   return $donations; 
 }
 public function getTimeAgo($time)
 {
  $time=strtotime($time);
  $time = time() - $time; // to get the time since that moment
  $time = ($time<1)? 1 : $time;
  $tokens = array (31536000 => 'year',2592000 => 'month',604800 => 'week',86400 => 'day',3600 => 'hour',       60 => 'minute',1 => 'second');

  foreach($tokens as $unit => $text)
  {
   if ($time < $unit) continue;
   $numberOfUnits = floor($time / $unit);
   return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
  }
 }  
 public function getCampaignName($campaign_id)
 {
  return $this->db->select('type_name')->from(CAMPAIGN_TYPE)->where('id',$campaign_id)->get()->row_array();
 }
 public function getCampaignDonorsEmails($campaign_id)
 {
  $sql="select distinct payer_email from ".DONATIONS." where payer_email !='' and campaign_id='".$campaign_id."' and donation_type='campaign'";
  $res=$this->db->query($sql);
  $donor_emails=array();
  if($res->num_rows() > 0)
  {
   foreach($res->result() as $row)
   {
    $donor_emails[]=$row->payer_email;
   }
  }
  return $donor_emails;
 }
 public function GetCampaignComments($campaign_id)
 {
  return $this->db->select('id,comments')->from(CAMPAIGN_COMMENTS)->where('campaign_id',$campaign_id)->order_by('dateadded','desc')->get()->result_array();
 }
 public function DeleteComment($comment_id)
 {
  $this->db->where('id', $comment_id);
  $this->db->delete(CAMPAIGN_COMMENTS);
 }
}
?>
