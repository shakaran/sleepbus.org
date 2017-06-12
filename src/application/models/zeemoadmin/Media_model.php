<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Media_model extends CI_Model
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
  public function GetMediaFormAttribute($values,$edit_id='')
  {
   $attribute['form'] = array('onSubmit'=>'return ValidateMediaForm();');
   $attribute['media_title'] = array('name'=>'media_title', 'id'=> 'media_title', 'value'=>$values['media_title'], 'size'=>'61');

   $attribute['publication'] = array('name'=>'publication', 'id'=> 'publication', 'value'=>$values['publication'], 'size'=>'61');

   $attribute['url'] = array('name'=>'url', 'id'=> 'url', 'value'=>$values['url'],'size'=>'61','onblur'=>"AutoFillHTTP('url')");
   $attribute['date_display']=array('name'=> 'date_display','id'=> 'date_display','value'=>$values['date_display'],'size'=>'25','readonly'=>'readonly');  
   if(!empty($edit_id))
   {
	$attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Update');
   }
   else $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Submit');

   return $attribute;
  } 
  public function InsertMedia($record)
  {
   $records = $this->db_query->TrimValues($record);
   $sql = "update ".MEDIA_ITEMS." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['modified_by_user'] = $this->session->userdata('username');
   $records['dateadded'] = date('Y-m-d H:i:s');   
   $this->db->insert(MEDIA_ITEMS,$records);
  }
  public function GetMediaDetails($support_id)
  {
   $values=array();
   $sql = "select * from ".MEDIA_ITEMS." where id='$support_id'";
   $query = $this->db->query($sql);
   foreach($query->result() as $row)
   {
    $values['media_title'] = $row->media_title;
	$values['date_display'] = $row->date_display;
	$values['url'] = $row->url;
	$values['publication'] = $row->publication;
   }
   return $values;   
  }
  public function UpdateMedia($record, $support_id)
  {
   $records = $this->db_query->TrimValues($record);
   $records['modified_by_user'] = $this->session->userdata('username');   
   $this->db->where('id',$support_id);
   $this->db->update(MEDIA_ITEMS,$records);
  }
  public function GetMediaList()
  {
   return $this->db_query->FetchInformation(MEDIA_ITEMS,"","1='1' order by position asc"); 
  }
  public function DeleteMedias($all_ids)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $cat_id)
	{
	 $cat_info = $this->db_query->FetchSingleInformation(MEDIA_ITEMS, "position", "id='$cat_id'");
     $this->Login_model->SetPositionAfterDeletion(MEDIA_ITEMS, $cat_info['position']);	   		   
     $this->db_query->DeleteRecord(MEDIA_ITEMS,"id='$cat_id'");
	}
   }
  } 

 } 
?> 
