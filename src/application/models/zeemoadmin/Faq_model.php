<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Faq_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }
  public function GetTopTextFormAttribute($values)
  {
   $attribute['form'] = array('onSubmit'=>'return true;');
  // $attribute['fckeditorConfig'] = array('instanceName'=>'content', 'BasePath' => base_url().'application/third_party/fckeditor/','id'=>'content','ToolbarSet' => 'Default','Width' => '100%','Height'=>'400','Value'=>$values['content']);
   
   $attribute['content'] = $values['content'];
   
   $attribute['submit'] = array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }
  
  public function GetFaqFormAttribute($values,$faq_id='')
  {
   $attribute['form']=array('onSubmit'=>'return ValidateFaqForm();');
   $attribute['question']=array('name'=> 'question','id'=> 'question','value'=>$values['question'],'size'=>'74');   

   $attribute['answer'] = $values['answer'];
   
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
  public function InsertFaq($record)
  {
   $records=$this->db_query->TrimValues($record);
   $sql="update ".FAQ." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['modified_by_user']=$this->session->userdata('username');
   $records['date_entered']=date("Y-m-d");
   $this->db->insert(FAQ,$records);
  }
  public function GetFaqList()
  {
   return $this->db_query->FetchInformation(FAQ,"","1='1' order by position asc"); 
  }
  public function DeleteRecordForFaq($all_ids)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $faq_id)
	{
	 $position=$this->db_query->FetchSingleInformation(FAQ,"position","id='$faq_id'");
	 $this->db_query->DeleteRecord(FAQ,"id='$faq_id'");
	 $this->Login_model->SetPositionAfterDeletion(FAQ,$position['position']);
	 
	 $this->Login_model->DeleteBanner('faq',$faq_id);
	 $this->Login_model->DeleteMetaTags('FAQ',$faq_id);
	}
   }
  }
  public function GetFaqDetails($faq_id)
  {
   $values=array();
   $sql="select * from ".FAQ." where id='$faq_id'";
   $query=$this->db->query($sql);
   foreach($query->result() as $row)
   {
    $values['question']=$row->question;
    $values['answer']=$row->answer;
   }
   return $values;   
  }
  public function UpdateFaq($record,$faq_id)
  {
   $records=$this->db_query->TrimValues($record);
   $records['modified_by_user']=$this->session->userdata('username');   
   $this->db->where('id',$faq_id);
   $this->db->update(FAQ,$records);
  }
  public function UpdateRecordAfterDeletion($faq_id,$records)
  {
   $records['modified_by_user']=$this->session->userdata('username');   
   $this->db->where('id',$faq_id);
   $this->db->update(FAQ,$records);
  }
 } 
?> 