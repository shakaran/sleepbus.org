<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Support_model extends CI_Model
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
  public function InsertSupport($record)
  {
   $records = $this->db_query->TrimValues($record);
   $sql = "update ".SUPPORTS." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['modified_by_user'] = $this->session->userdata('username');
   $records['dateadded'] = date('Y-m-d H:i:s');   
   $this->db->insert(SUPPORTS,$records);
  }
  public function GetSupportDetails($support_id)
  {
   $values=array();
   $sql = "select * from ".SUPPORTS." where id='$support_id'";
   $query = $this->db->query($sql);
   foreach($query->result() as $row)
   {
    $values['support_title'] = $row->support_title;
	$values['intro_text'] = $row->intro_text;
   }
   return $values;   
  }
  public function UpdateSupport($record, $support_id)
  {
   $check_position=$this->db_query->FetchSingleInformation(SUPPORTS,"position","id='$support_id'");
   $sql="update ".SUPPORTS." set position=(position + 1)";
   $this->db->query($sql);
   $record['position']=1;  
   $records = $this->db_query->TrimValues($record);
   $records['modified_by_user'] = $this->session->userdata('username');   
   $this->db->where('id',$support_id);
   $this->db->update(SUPPORTS,$records);
  }
  public function GetSupportList()
  {
   return $this->db_query->FetchInformation(SUPPORTS,"","1='1' order by position asc"); 
  }
  public function DeleteSupports($all_ids)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $cat_id)
	{
 	 $this->Login_model->DeleteMetaTags('SUPPORTS',$cat_id);
     $this->Login_model->DeleteCtaRecords('SUPPORTS',$cat_id);
	 $cat_info = $this->db_query->FetchSingleInformation(SUPPORTS, "position", "id='$cat_id'");
     $this->Login_model->SetPositionAfterDeletion(SUPPORTS, $cat_info['position']);	   		   
     $this->db_query->DeleteRecord(SUPPORTS,"id='$cat_id'");
	}
   }
  } 

 } 
?> 
