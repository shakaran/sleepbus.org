<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Landingpages_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }
  public function GetLandingpagesFormAttribute($values,$item_id='')
  {
   $attribute['form']=array('onSubmit'=>'return ValidateLandingpagesForm();');
   $attribute['title']=array('name'=> 'title','id'=> 'title','value'=>$values['title'],'size'=>'63',"onKeyUp"=>"return CountCharacters('title','limit1','85')");   
   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['title']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');
   
   $attribute['url']=array('name'=> 'url','id'=> 'url','value'=>$values['url'],'size'=>'63');   
   $attribute['description']=array('name'=> 'description','id'=> 'description','value'=>$values['description'],'rows'=> '5','cols'=> '85');   
   
   $attribute['meta_title']=array('name'=> 'meta_title','id'=> 'meta_title','value'=>$values['meta_title'],'size'=> '112');      
   $attribute['meta_keyword']=array('name'=> 'meta_keyword','id'=> 'meta_keyword','value'=>$values['meta_keyword'],'rows'=> '5','cols'=> '85');         
   $attribute['meta_description']=array('name'=> 'meta_description','id'=> 'meta_description','value'=>$values['meta_description'],'rows'=> '5','cols'=> '85');
   $attribute['page_heading']=array('name'=> 'page_heading','id'=> 'page_heading','value'=>$values['page_heading'],'size'=>'65');         
     
   if(!empty($item_id)) {
	$attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Update');
   }
   else {
	$attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   }
   return $attribute;
   
  }
  public function InsertLandingpage($record)
  {
   $records=$this->db_query->TrimValues($record);
   $sql="update ".LANDINGPAGE." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['modified_by_user']=$this->session->userdata('username');
   $records['dateadded'] = date("Y-m-d  h:i:s");   
   $this->db->insert(LANDINGPAGE,$records);
  }
  public function GetLandingpagesList()
  {
   return $this->db_query->FetchInformation(LANDINGPAGE,"","1='1' order by position asc"); 
  }
  public function DeleteRecordForLandingpages($all_ids)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $item_id)
	{
	 $position=$this->db_query->FetchSingleInformation(LANDINGPAGE,"position","id='$item_id'");
	 $this->db_query->DeleteRecord(LANDINGPAGE,"id='$item_id'");
	 $this->Login_model->SetPositionAfterDeletion(LANDINGPAGE,$position['position']);
	}
   }
  }
  public function GetLandingpagesDetails($item_id)
  {
   $values=array();
   $sql="select * from ".LANDINGPAGE." where id='$item_id'";
   $query=$this->db->query($sql);
   foreach($query->result() as $row)
   {
    $values['title']=$row->title;
    $values['url']=$row->url;
    $values['description']=$row->description;
    $values['page_heading']=$row->page_heading;	
    $values['meta_title']=$row->meta_title;
    $values['meta_keyword']=$row->meta_keyword;
    $values['meta_description']=$row->meta_description;		
   }
   return $values;   
  }
  public function UpdateLandingpage($record,$item_id)
  {
   $records=$this->db_query->TrimValues($record);
   $records['modified_by_user']=$this->session->userdata('username');   
   $this->db->where('id',$item_id);
   $this->db->update(LANDINGPAGE,$records);
  }
  public function UpdateRecordAfterDeletion($item_id,$records)
  {
   $records['modified_by_user']=$this->session->userdata('username');   
   $this->db->where('id',$item_id);
   $this->db->update(LANDINGPAGE,$records);
  }
 }
?> 