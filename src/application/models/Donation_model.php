<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Donation_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetDonateFormAttributes($values,$unit_fund)
  {
   if(count($values) == 0)
   {
    $values=array('donor_name'=>'','amount'=>number_format($unit_fund,2),'comment'=>'','email'=>'');
   }
   $attribute=array();
   $attribute['form']=array('id'=>'donation_frm','name'=>'donation_frm','onSubmit'=>'return ValidateDonationForm();');
   
   $attribute['donor_name']=array('name'=> 'donor_name','id'=> 'donor_name','value' => $values['donor_name'],'placeholder'=>'Name',"class"=>"form-control");
   $attribute['email']=array('name'=> 'email','id'=> 'email','value' => $values['email'],'placeholder'=>'Email',"class"=>"form-control");   
   $attribute['amount']=array('name'=> 'amount','id'=> 'amount','value' => $values['amount'],"class"=>"form-control","placeholder"=>number_format($unit_fund,2));
   
	  
   $attribute['comment']=array('name'=> 'comment','id'=> 'comment','value'=>$values['comment'],'placeholder'=>'Leave a comment',"class"=>"form-control","rows"=>'3');
    $attribute['anonymous'] = array('name'=>'anonymous', 'id'=> 'anonymous', 'value'=>'yes');

    $attribute['submit']=array('type' => 'submit', 'name' => 'form_submit','id'=>'form_submit','value'=>"Give by Paypal","class"=>"btn btn-success");
   return $attribute;
  }
  public function InsertDonationDetails($record)
  {
   $records = $this->db_query->TrimValues($record);
   $records['dateadded'] = date('Y-m-d');   
   $this->db->insert(DONATIONS,$records);
  }
  public function GetCampaignDetails($campaign_id)
  {
   $sql="select uc.*,user.email as username,user.full_name from ".USER_CAMPAIGNS." uc inner join ".USERS." user on uc.user_id=user.id where uc.id='".$campaign_id."'";	  
   $res=$this->db->query($sql);
   $campaign_details=array();
   if($res->num_rows() > 0)
   {
    $row=$res->row_array();
	$campaign_details['campaign_name']=$row['campaign_name'];
	$campaign_details['campaign_goal']=$row['campaign_goal'];
	$campaign_details['user_full_name']=$row['full_name'];
	$campaign_details['username']=$row['username'];
	$campaign_details['url']=$row['url'];	
   }  
   return $campaign_details;
  }
  public function GetDonateFormForOneTimeAttributes($values,$unit_fund,$days='1')
  {
   if(count($values) == 0)
   {
	//if(!empty($days))
	//{    
	 $values=array('amount'=>number_format(($unit_fund*$days),2));
	//}
	//else{ $values=array('amount'=>number_format($unit_fund,2)); $days=1;}
   }
 
   $attribute=array();
   $attribute['form']=array('id'=>'donation_one_time_frm','name'=>'donation_one_time_frm','onSubmit'=>'return ValidateDonationOneTimeForm();');

   $attribute['amount']=array('name'=> 'amount','id'=> 'amount','value' => $values['amount'],"class"=>"form-control","placeholder"=>number_format($unit_fund*$days,2));
   
	  

    $attribute['submit']=array('type' => 'submit', 'name' => 'form_submit','id'=>'form_submit','value'=>"Give by Paypal","class"=>"btn btn-success");
   return $attribute;
  }  
 }
?>