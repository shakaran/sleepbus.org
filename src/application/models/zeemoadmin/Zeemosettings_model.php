<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Zeemosettings_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetResourceInformation()
  {
   return $this->db_query->FetchSingleInformation(ZEEMO_RESOURCE,"","id='1'");
  }
  public function GetResourceFormAttribute($values)
  {
   $attribute['form']=array('onSubmit'=>'return ValidateResourcePage();');

   $attribute['page_heading']=array('name'=> 'page_heading','id'=> 'page_heading','value'=>$values['page_heading'],'size'=> '70');  
   $attribute['breadcrumb']=array('name'=> 'breadcrumb','id'=> 'breadcrumb','value'=>$values['breadcrumb'],'size'=> '70');  


   $attribute['meta_title']=array('name'=> 'meta_title','id'=> 'meta_title','value'=>$values['meta_title'],'rows'=> '3','cols'=> '85',"onKeyUp"=>"return CountCharacters('meta_title','limit1','200')");  
   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['meta_title']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');

   $attribute['meta_keyword']=array('name'=> 'meta_keyword','id'=> 'meta_keyword','value'=>$values['meta_keyword'],'rows'=> '3','cols'=> '85',"onKeyUp"=>"return CountCharacters('meta_keyword','limit2','200')");
   $attribute['limit2']=array('name'=> 'limit2','id'=> 'limit2','value' => strlen($values['meta_keyword']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');

   $attribute['meta_description']=array('name'=> 'meta_description','id'=> 'meta_description','value'=>$values['meta_description'],'rows'=> '3','cols'=> '85',"onKeyUp"=>"return CountCharacters('meta_description','limit3','200')");
   $attribute['limit3']=array('name'=> 'limit3','id'=> 'limit3','value' => strlen($values['meta_description']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');

   $attribute['json_code']=array('name'=> 'json_code','id'=> 'json_code','value'=>$values['json_code'],'rows'=> '3','cols'=> '85');
   
   $attribute['content_id']=array('name'=> 'content','id'=> 'content_id','value'=>$values['content'],'rows'=> '5','cols'=> '105');
   
   
   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }
  public function UpdateRecords($record)
  {
   $record['modified_by_user']=$this->session->userdata('username');
   $records=$this->db_query->TrimValues($record);
   $this->db->where('id',1);
   $this->db->update(ZEEMO_RESOURCE,$records);
  }
  public function GetSettingInformation()
  {
   return $this->db_query->FetchSingleInformation(ZEEMO_SETTINGS,"","id='1'");
  }
  public function GetSettingFormAttribute($values)
  {
   $attribute['form']=array('onSubmit'=>'return true;');
   $attribute['google_analytics_code']=array('name'=> 'google_analytics_code','id'=> 'google_analytics_code','value'=>$values['google_analytics_code']);
   $attribute['canonical_link']=array('name'=> 'canonical_link','id'=> 'canonical_link','value'=>$values['canonical_link']);
   
   
   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }
  public function UpdateSettingsRecords($record)
  {
   $record['modified_by_user']=$this->session->userdata('username');
   $records=$this->db_query->TrimValues($record);
   $this->db->where('id',1);
   $this->db->update(ZEEMO_SETTINGS,$records);
  }
  
 }
?> 