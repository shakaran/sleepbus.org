<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Account_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }
  // **********************  Page Heading Section **********************/
  public function GetPageHeadingFormAttribute($values,$parent_ids,$page_id="")
  {
   $attribute['form']=array('onSubmit'=>'return ValidatePageHeadingForm();');
   $heading_list=array();

   $heading_list=$this->PageHeadingList($parent_ids);
   $attribute['heading_id']=$heading_list;
   
   $attribute['page_heading']=array('name'=> 'page_heading','id'=> 'page_heading','value'=>$values['page_heading'],'size'=>'45',"onKeyUp"=>"return CountCharacters('page_heading','limit1','45')");
   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['page_heading']),'readonly'=>'readonly','size'=>'1','tabindex'=>'-1'); 
   $attribute['page_heading_text']= $values['page_heading']; 
   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }
  public function PageHeadingList($parent_ids)
  {
   $id_list=implode(",",$parent_ids);	  
   $headings=array();
   $headings['']="Select page";   
   $sql="select id,page_name from ".PAGE_HEADING." where parent_id='0' and id in (".$id_list.") order by position asc";
   $query=$this->db->query($sql);
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
	{
	
     $sql2="select id,page_name from ".PAGE_HEADING." where  parent_id='".$row->id."' order by position";
     $query2=$this->db->query($sql2);
	 foreach($query2->result() as $sub_row)
	 {
	  $headings[ucwords($row->page_name)][$sub_row->id]=ucwords($sub_row->page_name);
	 }
	}
   }
   return $headings;
  }
  public function GetPageHeading($heading_id)
  {
   return $this->db_query->FetchSingleInformation(PAGE_HEADING,"page_heading~sub_heading","id='$heading_id'");
  }
  public function UpdatePageHeadings($page_id,$record)
  {
   $records=$this->db_query->TrimValues($record);
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->where('id',$page_id);
   $this->db->update(PAGE_HEADING,$records);
  }
  // **********************  Page Heading Section End**********************/
  
  public function GetAccountTypeFormAttribute($values,$faq_id='')
  {
   $attribute['form']=array('onSubmit'=>'return ValidateAccountTypeForm();');
   $attribute['type_name']=array('name'=> 'type_name','id'=> 'type_name','value'=>$values['type_name'],'size'=>'74');   

   
   if(!empty($faq_id))
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Update');
   }
   else
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   }
   return $attribute;
   
  } 
  public function InsertAccountType($record)
  {
   $records=$this->db_query->TrimValues($record);
   $sql="update ".ACCOUNT_TYPE." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['modified_by_user']=$this->session->userdata('username');
   $records['dateadded']=date("Y-m-d");
   $this->db->insert(ACCOUNT_TYPE,$records);
  }
  public function DeleteRecordForAccountType($all_ids)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $cat_id)
	{
	 $position=$this->db_query->FetchSingleInformation(ACCOUNT_TYPE,"position","id='$cat_id'");
	 $this->db_query->DeleteRecord(ACCOUNT_TYPE,"id='$cat_id'");
	 $this->Login_model->SetPositionAfterDeletion(ACCOUNT_TYPE,$position['position']);
	}
   }
  }
  public function GetAccountTypeDetails($id)
  {
   $values=array();
   $sql="select * from ".ACCOUNT_TYPE." where id='$id'";
   $query=$this->db->query($sql);
   foreach($query->result() as $row)
   {
    $values['type_name']=$row->type_name;
   }
   return $values;   
  }
  public function UpdateAccountType($record,$id)
  {
   $records=$this->db_query->TrimValues($record);
   $records['modified_by_user']=$this->session->userdata('username');   
   $this->db->where('id',$id);
   $this->db->update(ACCOUNT_TYPE,$records);
  }
  public function GetAllCategories()
  {
   return $this->db->select("*")->from(ACCOUNT_TYPE)->order_by('position','asc')->get()->result_array();
  }
  public function GetUserList()
  {
   $sql="select user.*,date_format(dateadded,'%a %d %b %Y') as signup_date from ".USERS." user order by dateadded desc";
   $res=$this->db->query($sql);
   $users=array();
   if($res->num_rows() > 0)
   {
	$u=0;   
    foreach($res->result() as $row)
	{
	 $users[$u]['full_name']=$row->full_name;
	 $users[$u]['email']=$row->email;
	 $users[$u]['signup_date']=$row->signup_date;
	 $users[$u]['is_campaign']=$this->GetUserCampaignInfo($row->id);
	 $users[$u]['id']=$row->id;
	 $users[$u]['status']=$row->status;
	 $u++;
	}
   }
   return $users;
  }
  public function GetUserCampaignInfo($user_id)
  {
   $sql="select id from ".USER_CAMPAIGNS." where user_id='".$user_id."'";
   $res=$this->db->query($sql);
   return $res->num_rows();   
  }
  public function GetUserDetails($user_id)
  {
   $sql="select user.*, date_format(user.dateadded,'%a %d %b %Y') as signup_date,at.type_name from ".USERS." user left join ".ACCOUNT_TYPE." at on at.id=user.account_type where user.id='".$user_id."'";
   $res=$this->db->query($sql);
   return $res->row_array();
  }
  public function GetUserCampaigns($user_id)
  {
   $sql="select uc.*,date_format(uc.dateadded,'%a %d %b %Y') as creation_date,date_format(uc.campaign_end_date,'%a %d %b %Y') as end_date,ct.type_name from ".USER_CAMPAIGNS." uc inner join ".CAMPAIGN_TYPE." ct on uc.campaign_type=ct.id where uc.user_id='".$user_id."' order by uc.dateadded desc";
   $res=$this->db->query($sql);
   $campaigns=array();
   if($res->num_rows() > 0)
   {
	$u=0;   
    foreach($res->result() as $row)
	{
	 $campaigns[$row->id][$u]['campaign_name']=$row->campaign_name;
	 $campaigns[$row->id][$u]['campaign_goal']=$row->campaign_goal;
	 $campaigns[$row->id][$u]['campaign_type']=$row->type_name;
	 $campaigns[$row->id][$u]['raised_amount']=$this->GetUserCampaignRaisedAmount($row->id);
	 $campaigns[$row->id][$u]['creation_date']=$row->creation_date;
	 $campaigns[$row->id][$u]['end_date']=$row->end_date;
	 $campaigns[$row->id][$u]['status']=$row->status;
	 $campaigns[$row->id][$u]['campaign_type_id']=$row->campaign_type;
	 $campaigns[$row->id][$u]['url']=$row->url;
	 
	 $u++;
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
  public function GetUserCampaignDonations($user_id)
  {
   $sql="select sum(d.paid_amount) as total_donation,d.*,date_format(d.payment_date,'%a %d %b %Y %H %i %s') as donation_date,uc.campaign_name,uc.url from ".DONATIONS." d inner join ".USER_CAMPAIGNS." uc on uc.id=d.campaign_id where d.donation_type='campaign' and registered_user_id='".$user_id."' group by d.campaign_id order by d.dateadded desc"; 
   $res=$this->db->query($sql);
   return $res->result_array();
  }
  public function GetUserOneTimeDonations($user_id)
  {
   $sql="select d.paid_amount as total_donation,d.*,date_format(d.payment_date,'%a %d %b %Y %H %i %s') as donation_date from ".DONATIONS." d where d.donation_type='one-time-donation' and registered_user_id='".$user_id."' order by d.dateadded desc"; 
   $res=$this->db->query($sql);
   return $res->result_array();
  }
  public function GetUserMonthlyDonations($user_id)
  {
   $sql="select d.paid_amount as total_donation,d.*,date_format(d.payment_date,'%a %d %b %Y %H %i %s') as donation_date from ".DONATIONS." d where d.donation_type='monthly' and registered_user_id='".$user_id."' order by d.dateadded desc"; 
   $res=$this->db->query($sql);
   return $res->result_array();
  }

 } 
?> 