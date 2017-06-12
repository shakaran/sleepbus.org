<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Generalpages_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetPageInformation($page_id)
  {
   $values=$this->db_query->FetchSingleInformation(PAGES,"","id='$page_id'");
   return $values;
  }

  public function GetPageFormAttribute($values)
  {
   $attribute['form']=array('onSubmit'=>'return true;');

   $attribute['content_id']=array('name'=> 'content','id'=> 'content_id','value'=>$values['content'],'rows'=> '5','cols'=> '105');
   $attribute['page_heading']=array('name'=> 'page_heading','id'=> 'page_heading','value'=>$values['page_heading'],'size'=> '58');   
   
   $page_list['']="Select";
   if(count($this->GetPageListForDropDown('text_only')) > 0)
   {
    foreach($this->GetPageListForDropDown('text_only') as $key=>$page_name)
    {
     $page_list[$key]=$page_name;
    }
   }
   $attribute['page_id']=$page_list;
   
   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }

  public function GetPageDropDownAttribute($field)
  {
   $attribute['form']=array('onSubmit'=>'return false;');
   $page_list['']="Select";
   if(count($this->GetPageListForDropDown($field)) > 0)
   {
    foreach($this->GetPageListForDropDown($field) as $key=>$page_name)
    {
	 if(is_array($page_name) and count($page_name) > 0)
	 {
	  foreach($page_name as $page_key=>$page_value)
	  {
	   $page_list[$key][$page_key]=$page_value;
	  }
	 }
	 else
	 {
      $page_list[$key]=$page_name;
	 }
	}
   }
   $attribute['page_id']=$page_list;
   return $attribute;
  } 
  public function GetPageListForDropDown($field)
  {
   $sql="select id,page_name from ".PAGES." where $field='1' and parent_id='0' and id!='1' order by position";
   $query=$this->db->query($sql);
   $page_list=array();
   $query->num_rows();
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
	{
     $sql1="select id,page_name from ".PAGES." where $field='1' and parent_id='".$row->id."' order by position";
     $query1=$this->db->query($sql1);
     $query1->num_rows();
	 
     if($query1->num_rows() > 0)
     {
      foreach($query1->result() as $subrow)
 	  {
	   $subrow->page_name;	  
       $page_list[$row->page_name][$subrow->id]=$subrow->page_name;
	  }
	 }
	 else
	 {
      $page_list[$row->id]=$row->page_name;
	 }
	}
   }
   return $page_list;
  }
  public function GetHomePageInformation()
  {
   $values=$this->db_query->FetchSingleInformation(PAGES,"content~intro_text~banner_content","id='1'");
   return $values;
  }
  public function GetHomePageFormAttribute($values)
  {
   $attribute['form']=array('onSubmit'=>'return ValidateHomePageForm()');
   
   
   if(isset($values['content']))
   {
    $attribute['content_id']=array('name'=> 'content','id'=> 'content_id','value'=>$values['content'],'rows'=> '5','cols'=> '105');
   }
   
    $attribute['intro_text']=array('name'=> 'intro_text','id'=> 'intro_text','value'=>$values['intro_text'],'rows'=> '5','cols'=> '105');
    $attribute['banner_content']=array('name'=> 'banner_content','id'=> 'banner_content','value'=>$values['banner_content'],'rows'=> '5','cols'=> '105');
   
   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
   
  }
  public function UpdateHomePageRecords($records)
  {
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->where("id",'1');
   $this->db->update(PAGES,$records);
  }
  // footer icons on home page
  
  public function GetFooterIconList()
  {
   return $this->db_query->FetchInformation(CLIENTS,"","1='1' order by position asc"); 
  }
  public function GetFooterIconDetails($clients_id)
  {
   $values=array();
   $sql="select * from ".CLIENTS." where id='$clients_id'";
   $query=$this->db->query($sql);
   foreach($query->result() as $row)
   {
    $values['clients_title']=$row->clients_title;
    $values['url']=$row->url;
    $values['current_image']=$row->image_file;
    $values['image_alt_title_text']=$row->image_alt_title_text;
    $values['image_quality']=$row->image_quality;
    $values['position']=$row->position;
    $values['image_file']=$row->image_file;
   }
   return $values;   
  }
  public function AddFooterIcon($record)
  {
   $records=$this->db_query->TrimValues($record);
   $records['modified_by_user']=$this->session->userdata('username');   
   $records['dateadded']=date("Y-m-d h:i:s"); 
   $this->db->insert(CLIENTS,$records);
  }
  
  public function UpdateFooterIcon($record,$clients_id)
  {
   $records=$this->db_query->TrimValues($record);
   $records['modified_by_user']=$this->session->userdata('username');   
   $this->db->where('id',$clients_id);
   $this->db->update(CLIENTS,$records);
  }
  
  public function GetFooterIconFormAttributes($values,$clients_id='')
  {
   $attribute['form']=array('onSubmit'=>'return ValidateClientsForm();');
   $attribute['clients_title']=array('name'=> 'clients_title','id'=> 'clients_title','value'=>$values['clients_title'],'size'=>'35',"onKeyUp"=>"return CountCharacters('clients_title','limit1','35')");   
   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['clients_title']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');
  
   $attribute['url']=array('name'=> 'url','id'=> 'url','value'=>$values['url'],'size'=>'35','onblur'=>"AutoFillHTTP('url')");   

  
   $attribute['image_alt_title_text']=array('name'=> 'image_alt_title_text','id'=> 'image_alt_title_text','value'=>$values['image_alt_title_text'],'size'=>'35');  
  
   $attribute['image_file']=array('name'=> 'image_file','id'=> 'image_file','value'=>'');
   if(isset($values['current_image']) and !empty($values['current_image']))
   {
    $attribute['current_image']=$values['current_image'];
   }
   
   
   if(!empty($clients_id))
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Update');
   }
   else
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   }
   return $attribute;
   
  } 
  public function DeleteFooterIcon($delete_ids)
  {
   foreach($delete_ids as $id)
    {
  	 $values=array();
     $values=$this->GetFooterIconDetails($id);
	 if(!empty($values['image_file']))
	 {
	  unlink("./images/generalpages/".$values['image_file']);
	 }
	 $this->db->delete(CLIENTS,array('id' => $id)); 
	 $this->Login_model->SetPositionAfterDeletion(CLIENTS,$values['position']);
    }
  }
  
  public function UpdateRecords($record,$id)
  {
   $record['modified_by_user']=$this->session->userdata('username');
   $records=$this->db_query->TrimValues($record);
   $this->db->where('id',$id);
   $this->db->update(PAGES,$records);
  }
  public function UpdateContactRecords($record)
  {
   $record['modified_by_user']=$this->session->userdata('username');
   $records=$this->db_query->TrimValues($record);
   $this->db->update(CONTACT,$records);
  }
  
  public function GetContactFormAttribute($values)
  {
   $attribute['form']=array('onSubmit'=>'return ValidateContactForm();');
   $attribute['address']=array('name'=> 'address','id'=> 'address','value'=>$values['address'],'rows'=> '7','cols'=> '35');
   $attribute['other_details']=array('name'=> 'other_details','id'=> 'other_details','value'=>$values['other_details'],'rows'=> '8','cols'=> '35');
   $attribute['form_heading']=array('name'=> 'form_heading','id'=> 'form_heading','value'=>$values['content'],'rows'=> '4','cols'=> '35');
   $attribute['phone']=array('name'=> 'phone','id'=> 'phone','value' => $values['phone'],'size'=>'45');
   $attribute['phone2']=array('name'=> 'phone2','id'=> 'phone2','value' => $values['phone2'],'size'=>'45');
   $attribute['email']=array('name'=> 'email','id'=> 'email','value' => $values['email'],'size'=>'45');
   $attribute['fax']=array('name'=> 'fax','id'=> 'fax','value' => $values['fax'],'size'=>'45');
   
   
   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }
  public function GetContactInformation()
  {
   $values=$this->db_query->FetchSingleInformation(CONTACT,"address~content~phone~email~other_details~fax~phone2","1='1'");
   return $values;  
  }
  public function GetMoreInfoSectionAttribute($values=array())
  {
   $attribute['form'] = array('onSubmit'=>'return ValidateMoreInfoSectionForm();');
   $attribute['info_title']=array('name'=> 'info_title','id'=> 'info_title','value'=>$values['info_title'],'size'=>'45',"onKeyUp"=>"return CountCharacters('info_title','limit1',80)");   
   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['info_title']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');
   $attribute['image_file']=array('name'=> 'image_file','id'=> 'image_file','value'=>'');
   if(isset($values['current_image']) and !empty($values['current_image']))
   {
    $attribute['current_image']=$values['current_image'];
   }
   if(isset($values['edit_id']) and !empty($values['edit_id']))
   {
    $attribute['edit_id']=$values['edit_id'];
	$submit_value="Update";
   }
   else
   {
    $attribute['edit_id']="";
	$submit_value="Submit";   
   }
   $attribute['description']=array('name'=> 'description','id'=> 'description','value'=>$values['description']);
   $attribute['image_alt_title_text']=array('name'=> 'image_alt_title_text','id'=> 'image_alt_title_text','value'=>$values['image_alt_title_text'],'size'=>'35');  
    $attribute['url']=array('name'=> 'url','id'=> 'url','value'=>$values['url'],'size'=>'40','onblur'=>"AutoFillHTTP('url')");
   $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => $submit_value);
   return $attribute;
  }
  public function GetMoreInfoSectionList()
  {
   $why_us_items=array();
   $why_us_items=$this->db_query->FetchInformation(MORE_INFO_SECTION,"","1='1' order by position"); 
   return $why_us_items;
  }
   
  public function GetMoreInfoDetails($item_id)
  {
   $why_us_items=array();
   $why_us_items=$this->db_query->FetchSingleInformation(MORE_INFO_SECTION,"","id='$item_id'"); 
   return $why_us_items;
  }

   public function InsertMoreInfoItem($record)
  {
   $records=$this->db_query->TrimValues($record);
   $sql="update ".MORE_INFO_SECTION." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['dateadded'] = date('Y-m-d H:i:s');   
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->insert(MORE_INFO_SECTION,$records);
  }

  public function UpdatetMoreInfoItem($record,$item_id)
  {
   $records=$this->db_query->TrimValues($record);
   $records['modified_by_user']=$this->session->userdata('username');   
   $this->db->where('id',$item_id);
   $this->db->update(MORE_INFO_SECTION,$records);
  }
  
   public function DeleteMoreInfoRecord($delete_ids)
   {
    foreach($delete_ids as $id)
    {
  	 $values=array();
     $values=$this->GetMoreInfoDetails($id);
	 if(!empty($values['image_file']))
	 {
	  unlink("./images/generalpages/".$values['image_file']);
	 }
	 $this->db->delete(MORE_INFO_SECTION,array('id' => $id)); 
	 $this->Login_model->SetPositionAfterDeletion(MORE_INFO_SECTION,$values['position']);
    }
   }
   
   
  public function DeleteMoreInfoImage($id,$field)
  {
   $image_details=$this->db_query->FetchSingleInformation(MORE_INFO_SECTION,$field,"id='$id'");
   if(!empty($image_details[$field]))
   {
    unlink('./images/generalpages/'.$image_details[$field]);
   }
   $this->db->where('id',$id);
   $records[$field]="";
    
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->update(MORE_INFO_SECTION,$records);
  }
 } 
?>