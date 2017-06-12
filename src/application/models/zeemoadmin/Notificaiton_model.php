<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Notificaiton_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetPageInformation($page_id)
  {
   $values=$this->db_query->FetchSingleInformation(AUTO_EMAIL_NOTIFICATION,"subject~message~sender_email","id='$page_id'");
   return $values;
  }
  public function GetPageFormAttribute($values)
  {
   $attribute['form']=array('onSubmit'=>'return ValidateEmailMessageForm();');
   
   if(isset($values['message']))
   {
    $attribute['message']=array('name'=> 'message','id'=> 'message','value'=>$values['message'],'rows'=> '5','cols'=> '105');
   }
   $attribute['subject']=array('name'=> 'subject','id'=> 'subject','value'=>$values['subject'],'size'=>'65');   
   $attribute['sender_email']=array('name'=> 'sender_email','id'=> 'sender_email','value'=>$values['sender_email'],'size'=>'65');   
   
   
   $page_list['']="Select";
   if(count($this->GetPageListForDropDown()) > 0)
   {
    foreach($this->GetPageListForDropDown() as $key=>$page_name)
    {
     $page_list[$key]=$page_name;
    }
   }
   $attribute['page_id']=$page_list;
   
   
   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }
  public function GetPageListForDropDown()
  {
   $sql="select id,remaining_days as page_name from ".AUTO_EMAIL_NOTIFICATION." order by id";
   $query=$this->db->query($sql);
   $query->num_rows();
   $page_list=array();
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
 	{
     $page_list[$row->id]=$row->page_name;
	}
   }
   return $page_list;
  }
  public function UpdateRecords($record,$page_id)
  {
   $record['modified_by_user']=$this->session->userdata('username');
   $records=$this->db_query->TrimValues($record);
   $this->db->where('id',$page_id);
   $this->db->update(AUTO_EMAIL_NOTIFICATION,$records);
  }
  
  public function GetEmailInformation($page_id)
  {
   $values=$this->db_query->FetchSingleInformation(EMAIL_MESSAGES,"","id='$page_id'");
   return $values;
  }
  public function GetEmailPageFormAttribute($page_id,$values=array())
  {
   $attribute=array();	  
   $attribute['form']=array('onSubmit'=>'return ValidateSetUpEmailMessageForm();');
   
   if(count($values) > 0)
   {
    $attribute['message']=array('name'=> 'message','id'=> 'message','value'=>$values['message'],'rows'=> '5','cols'=> '105');
    $attribute['subject']=array('name'=> 'subject','id'=> 'subject','value'=>$values['subject'],'size'=>'65');   
    $attribute['sender_email']=array('name'=> 'sender_email','id'=> 'sender_email','value'=>$values['sender_email'],'size'=>'65');
    $attribute['sender_name']=array('name'=> 'sender_name','id'=> 'sender_name','value'=>$values['sender_name'],'size'=>'65');

    $attribute['receiver_to_emails']=array('name'=> 'receiver_to_emails','id'=> 'receiver_to_emails','value'=>$values['receiver_to_emails'],'rows'=> '3','cols'=> '50');
    $attribute['receiver_cc_emails']=array('name'=> 'receiver_cc_emails','id'=> 'receiver_cc_emails','value'=>$values['receiver_cc_emails'],'rows'=> '3','cols'=> '50');

    $attribute['receiver_bcc_emails']=array('name'=> 'receiver_bcc_emails','id'=> 'receiver_bcc_emails','value'=>$values['receiver_bcc_emails'],'rows'=> '3','cols'=> '50');


    if($values['receiver'] == '1'){$checked_yes=true;$checked_no=false;}else{$checked_yes=false;$checked_no=true;}
	$attribute['receiver_yes']=array('name'=> 'receiver','id'=> 'receiver_yes','value'=>'1','checked'=>$checked_yes);
	$attribute['receiver_no']=array('name'=> 'receiver','id'=> 'receiver_no','value'=>'0','checked'=>$checked_no);

	
    $attribute['subject']=array('name'=> 'subject','id'=> 'subject','value'=>$values['subject'],'size'=>'65');   


    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   }

    $page_list['']="Select";
    if(count($this->GetEmailPageListForDropDown()) > 0)
    {
     foreach($this->GetEmailPageListForDropDown() as $key=>$page_name)
     {
      $page_list[$key]=$page_name;
     }
    }
    $attribute['page_id']=$page_list;
   
   return $attribute;
  }
  public function GetEmailPageListForDropDown()
  {
   $sql="select id,page_name from ".EMAIL_MESSAGES." order by page_name asc";
   $query=$this->db->query($sql);
   $query->num_rows();
   $page_list=array();
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
 	{
     $page_list[$row->id]=$row->page_name;
	}
   }
   return $page_list;
  }
  public function UpdateEmailRecords($record,$page_id)
  {
   $record['modified_by_user']=$this->session->userdata('username');
   $records=$this->db_query->TrimValues($record);
   $this->db->where('id',$page_id);
   $this->db->update(EMAIL_MESSAGES,$records);
  }
  
  public function GetThankYouPageInformation($page_id)
  {
   $values=$this->db_query->FetchSingleInformation(THANK_MESSAGES,"message","id='$page_id'");
   return $values;
  }
  public function GetThankYouPageFormAttribute($values)
  {
   $attribute['form']=array('onSubmit'=>'return ValidateThankYouMessageForm();');
   
   if(isset($values['message']))
   {
    $attribute['message']=array('name'=> 'message','id'=> 'message','value'=>$values['message'],'rows'=> '5','cols'=> '105');
   }
   
   $page_list['']="Select";
   if(count($this->GetThankYouPageListForDropDown()) > 0)
   {
    foreach($this->GetThankYouPageListForDropDown() as $key=>$page_name)
    {
     $page_list[$key]=$page_name;
    }
   }
   $attribute['page_id']=$page_list;
   
   
   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }
  public function GetThankYouPageListForDropDown()
  {
   $sql="select id,page_name from ".THANK_MESSAGES." order by id";
   $query=$this->db->query($sql);
   $query->num_rows();
   $page_list=array();
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
 	{
     $page_list[$row->id]=$row->page_name;
	}
   }
   return $page_list;
  }
  public function UpdateThankYouMessage($record,$page_id)
  {
   $record['modified_by_user']=$this->session->userdata('username');
   $records=$this->db_query->TrimValues($record);
   $this->db->where('id',$page_id);
   $this->db->update(THANK_MESSAGES,$records);
  }


  public function GetSenderInformation()
  {
   $values=$this->db_query->FetchSingleInformation(COMMON_SETTINGS,"sender_name~sender_email","1='1'");
   return $values;
  }
  public function GetSenderInformationFormAttribute($values)
  {
   $attribute['form']=array('onSubmit'=>'return ValidateSenderInformation();');
   
   $attribute['sender_email']=array('name'=> 'sender_email','id'=> 'sender_email','value'=>$values['sender_email'],'size'=>'65');
   $attribute['sender_name']=array('name'=> 'sender_name','id'=> 'sender_name','value'=>$values['sender_name'],'size'=>'65');
   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }
  public function UpdateSenderInformation($record,$page_id)
  {
   $record['modified_by_user']=$this->session->userdata('username');
   $records=$this->db_query->TrimValues($record);
   $this->db->update(COMMON_SETTINGS,$records);
  }


  
 }
?> 