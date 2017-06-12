<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class About_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
 
  public function GetAboutSectionAttribute($values=array())
  {
   $attribute['form'] = array('onSubmit'=>'return ValidateAboutSectionForm();');
   $attribute['item_title']=array('name'=> 'item_title','id'=> 'item_title','value'=>$values['item_title'],'size'=>'50',"onKeyUp"=>"return CountCharacters('item_title','limit1',40)");   
   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['item_title']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');
   $attribute['page_heading']=array('name'=> 'page_heading','id'=> 'page_heading','value'=>$values['page_heading'],'size'=>'59');   
      
   $attribute['intro_text']=array('name'=> 'intro_text','id'=> 'intro_text','value'=>$values['intro_text'],'rows'=> '5','cols'=>'55');
   $attribute['description']=array('name'=> 'description','id'=> 'description','value'=>$values['description'],'rows'=> '5','cols'=>'45');   
   $attribute['url']=array('name'=> 'url','id'=> 'url','value'=>$values['url'],'size'=>'60');
   $attribute['page_type'] = $values['page_type'];
   $attribute['image_alt_title_text']=array('name'=> 'image_alt_title_text','id'=> 'image_alt_title_text','value'=>$values['image_alt_title_text'],'size'=>'30');     
   $attribute['image_file']=array('name'=> 'image_file','id'=> 'image_file','value'=>'');    
  
   if(isset($values['edit_id']) and !empty($values['edit_id']))
   {
    $attribute['edit_id']=$values['edit_id'];
	$submit_value="Update";
    if(isset($values['current_image']) && !empty($values['current_image']))
    {
     $attribute['current_image'] = $values['current_image'];
    }		
   }
   else
   {
    $attribute['edit_id']="";
	$submit_value="Submit";   
   }
   $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => $submit_value);
   return $attribute;
  }
  
  public function GetAboutSectionList()
  {
   $why_us_items=array();
   $why_us_items=$this->db_query->FetchInformation(ABOUT_SECTION,"","1='1' order by position"); 
   return $why_us_items;
  }
   
  public function GetAboutDetails($item_id)
  {
   $items=array();
   $items=$this->db_query->FetchSingleInformation(ABOUT_SECTION,"","id='$item_id'"); 
   return $items;
  }

  public function InsertAboutItem($record)
  {
   $records=$this->db_query->TrimValues($record);
   $sql="update ".ABOUT_SECTION." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['dateadded'] = date('Y-m-d H:i:s');   
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->insert(ABOUT_SECTION,$records);
  }

  public function UpdatetAboutItem($record,$item_id)
  {
   $records=$this->db_query->TrimValues($record);
   $records['modified_by_user']=$this->session->userdata('username');   
   $this->db->where('id',$item_id);
   $this->db->update(ABOUT_SECTION,$records);
  }
  
   public function DeleteAboutRecord($delete_ids)
   {
    foreach($delete_ids as $id)
    {
  	 $values=array();
     $values=$this->GetAboutDetails($id);
	 if(!empty($values['image_file']))
	 {
	  unlink("./images/generalpages/".$values['image_file']);
	 }
	 $this->db->delete(ABOUT_SECTION,array('id' => $id)); 
	 $this->Login_model->SetPositionAfterDeletion(ABOUT_SECTION,$values['position']);
    }
   }
   
   public function DeletePageImage($id)
  {
   $sql = "select image_file from ".ABOUT_SECTION." where id=$id";
   $result = $this->db->query($sql);
   $row = $result->row();
   if(file_exists('./images/generalpages/'.$row->image_file)) unlink('./images/generalpages/'.$row->image_file);

   $records = array('image_file'=>'','image_alt_title_text'=>'','image_quality'=>'');
   $this->db->where('id',$id);
   $this->db->update(ABOUT_SECTION,$records);
  } 
  
 } 
?> 
