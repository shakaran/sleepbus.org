<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Commonsettings_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetCommonSettingsInformation()
  {
   $values=$this->db_query->FetchSingleInformation(COMMON_SETTINGS,"website_logo as current_website_logo~member_icon1 as current_member_icon1~member_icon2 as current_member_icon2~icon_url1~icon_url2~website_svg_logo as current_website_svg_logo~unit_fund","1='1'");
   return $values;
  }
  public function GetCommonSettingFormAttribute($values)
  {
   $attribute['form']=array('onSubmit'=>'return ValidateCommonSetting();');
   $attribute['website_logo']=array('name'=> 'website_logo','id'=> 'website_logo','value'=>'');
   if(isset($values['current_website_logo']) and !empty($values['current_website_logo']))
   {
    $attribute['current_website_logo']=$values['current_website_logo'];
   }
   $attribute['website_svg_logo']=array('name'=> 'website_svg_logo','id'=> 'website_svg_logo','value'=>'');
   if(isset($values['current_website_svg_logo']) and !empty($values['current_website_svg_logo']))
   {
    $attribute['current_website_svg_logo']=$values['current_website_svg_logo'];
   }
   $attribute['unit_fund']=array('name'=> 'unit_fund','id'=> 'unit_fund','value'=>$values['unit_fund'],'size'=>'8','style'=>'text-align:right');
   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   
   return $attribute;
   
  }
  public function UpdateSettingRecords($records)
  {
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->update(COMMON_SETTINGS,$records);
  }
  public function GetIconsFormAttribute($values,$icon_id='')
  {
   $attribute['form']=array('onSubmit'=>'return ValidateIconsForm();');
   $attribute['icon_title']=array('name'=> 'icon_title','id'=> 'icon_title','value'=>$values['icon_title'],'size'=>'63',"onKeyUp"=>"return CountCharacters('icon_title','limit1','20')");   
   $attribute['url']=array('name'=> 'url','id'=> 'url','value'=>$values['url'],'size'=>'63' ,'onblur'=>"AutoFillHTTP('url')");   

   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['icon_title']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');
   $attribute['image_file']=array('name'=> 'image_file','id'=> 'image_file','value'=>'');
   if(isset($values['current_image']) and !empty($values['current_image']))
   {
    $attribute['current_image']=$values['current_image'];
   }
   $attribute['hover_image']=array('name'=> 'hover_image','id'=> 'hover_image','value'=>'');
   if(isset($values['current_hover_image']) and !empty($values['current_hover_image']))
   {
    $attribute['current_hover_image']=$values['current_hover_image'];
   }
    
   	 $attribute['image_alt_title_text']=array('name'=> 'image_alt_title_text','id'=> 'image_alt_title_text','value'=>$values['image_alt_title_text'],'size'=>'35');   
	 
   	 $attribute['hover_image_alt_title_text']=array('name'=> 'hover_image_alt_title_text','id'=> 'hover_image_alt_title_text','value'=>$values['hover_image_alt_title_text'],'size'=>'35');   
	 
   
   if(!empty($icon_id))
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Update');
   }
   else
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   }
   return $attribute;
   
  } 
  public function InsertIcon($record)
  {
   $records=$this->db_query->TrimValues($record);
   $sql="update ".SOCIAL_MEDIA_ICONS." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['dateadded'] = date('Y-m-d H:i:s');   
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->insert(SOCIAL_MEDIA_ICONS,$records);
  }
  public function DeleteSocialMediaIcons($icon_ids)
  {
   if(count($icon_ids) > 0)
   {
	$path_to_delete="./images/common-settings/";   
    foreach($icon_ids as $id)
	{
	 $icon_details=array();
	 $icon_details=$this->db_query->FetchSingleInformation(SOCIAL_MEDIA_ICONS,"image_file~hover_image~position","id='$id'");
	 if(!empty($icon_details['image_file']))
	 {
	  unlink($path_to_delete.$icon_details['image_file']);
	 }
	 if(!empty($icon_details['hover_image']))
	 {
	  unlink($path_to_delete.$icon_details['hover_image']);
	 }
	 $this->db_query->DeleteRecord(SOCIAL_MEDIA_ICONS,"id='$id'");
	 $this->Login_model->SetPositionAfterDeletion(SOCIAL_MEDIA_ICONS,$icon_details['position']);
	}
   }
  }
  
  public function GetIconList()
  {
   return $this->db_query->FetchInformation(SOCIAL_MEDIA_ICONS,"","1='1' order by position asc"); 
  }
  public function GetIconDetails($icon_id)
  {
   $values=array();
   $sql="select * from ".SOCIAL_MEDIA_ICONS." where id='$icon_id'";
   $query=$this->db->query($sql);
   foreach($query->result() as $row)
   {
    $values['icon_title']=$row->icon_title;
    $values['url']=$row->url;
    $values['current_image']=$row->image_file;
    $values['current_hover_image']=$row->hover_image;
    $values['image_alt_title_text']=$row->image_alt_title_text;
    $values['hover_image_alt_title_text']=$row->hover_image_alt_title_text;
	$values['position']=$row->position;
   }
   return $values;   
  }
  public function UpdateIcon($record,$icon_id)
  {
   $records=$this->db_query->TrimValues($record);
   $records['modified_by_user']=$this->session->userdata('username');   
   $this->db->where('id',$icon_id);
   $this->db->update(SOCIAL_MEDIA_ICONS,$records);
  }
  
  public function GetPageHeadingFormAttribute($values,$page_id="")
  {
   $attribute['form']=array('onSubmit'=>'return ValidatePageHeadingForm();');
   $heading_list=array();

   $heading_list=$this->PageHeadingList();
   $attribute['heading_id']=$heading_list;
   $attribute['page_heading']=array('name'=> 'page_heading','id'=> 'page_heading','value'=>$values['page_heading'],'size'=>'45',"onKeyUp"=>"return CountCharacters('page_heading','limit1','45')");
   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['page_heading']),'readonly'=>'readonly','size'=>'1','tabindex'=>'-1');   
   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }
  public function PageHeadingList()
  {
   $headings=array();
   $headings['']="Select your page";   
   $sql="select id,page_name from ".PAGE_HEADING." where parent_id='0' order by position asc";
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
   return $this->db_query->FetchSingleInformation(PAGE_HEADING,"page_heading","id='$heading_id'");
  }
  public function UpdatePageHeadings($page_id,$record)
  {
   $records=$this->db_query->TrimValues($record);
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->where('id',$page_id);
   $this->db->update(PAGE_HEADING,$records);
  }
  public function GetTopTextFormAttribute($values)
  {
   $attribute['form'] = array('onSubmit'=>'return true;');
   $attribute['content']=array('name'=> 'content','id'=> 'content_id','value'=>$values['content']);
   $attribute['submit'] = array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }
  
  public function GetLeadDetails($type_id)
  {
   return $this->db_query->FetchSingleInformation(LEAD_SOURCES,"name","id='$type_id'");
  }
  public function GetAllLeads()
  {
   $leads=array();
   $sql="SELECT * from ".LEAD_SOURCES." order by position";
   $query=$this->db->query($sql);
   if($query->num_rows() > 0)
   {
    $i=0;
    foreach($query->result() as $row)
    {
     $leads[$i]['id']=$row->id;
     $leads[$i]['name']=$row->name;
     $leads[$i]['status']=$row->status;
     $i++;
    }
   }
   return $leads;
  }
  public function GetLeadTypeAttributes($values,$type_id)
  {
   $attribute['form']=array('onSubmit'=>'return ValidateLeadForm();');
   $attribute['name']=array('name'=> 'name','id'=> 'name','value'=>$values['name'],'size'=>'35',"onKeyUp"=>"return CountCharacters('name','limit1','25')");      
   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['name']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');   
   if(!empty($type_id))
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Update');
   }
   else
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   }
   return $attribute;
  }
  public function UpdateLeadType($records,$type_id)
  {
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->where('id',$type_id);
   $this->db->update(LEAD_SOURCES,$records);
  }
  public function InsertLeadType($records)
  {
   $sql="update ".LEAD_SOURCES." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['date_added']=date("Y-m-d");
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->insert(LEAD_SOURCES,$records);
  }
  public function DeleteLeads($all_ids)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $id)
	{
	 $position=$this->db_query->FetchSingleInformation(LEAD_SOURCES,"position","id='$id'");
	 $this->db_query->DeleteRecord(LEAD_SOURCES,"id='$id'");
	 $this->Login_model->SetPositionAfterDeletion(LEAD_SOURCES,$position['position']);
	}
   }
  }
  
 }
?> 