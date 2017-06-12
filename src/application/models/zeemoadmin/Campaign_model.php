<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Campaign_model extends CI_Model

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

  

  // **********************  Page Heading Section **********************/

  public function GetPageHeadingFormAttribute($values,$parent_ids,$page_id="")

  {

   $attribute['form']=array('onSubmit'=>'return ValidatePageHeadingForm();');

   $heading_list=array();



   $heading_list=$this->PageHeadingList($parent_ids);

   $attribute['heading_id']=$heading_list;

   

   $attribute['page_heading']=array('name'=> 'page_heading','id'=> 'page_heading','value'=>$values['page_heading'],'size'=>'45',"onKeyUp"=>"return CountCharacters('page_heading','limit1','45')");

   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['page_heading']),'readonly'=>'readonly','size'=>'1','tabindex'=>'-1'); 

   $attribute['page_heading_text']= $values['page_heading']; 

   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');

   return $attribute;

  }

  public function PageHeadingList($parent_ids)

  {

   $id_list=implode(",",$parent_ids);	  

   $headings=array();

   $headings['']="Select page";   

   $sql="select id,page_name from ".PAGE_HEADING." where parent_id='0' and id in (".$id_list.") order by position asc";

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

   return $this->db_query->FetchSingleInformation(PAGE_HEADING,"page_heading~sub_heading","id='$heading_id'");

  }

  public function UpdatePageHeadings($page_id,$record)

  {

   $records=$this->db_query->TrimValues($record);

   $records['modified_by_user']=$this->session->userdata('username');

   $this->db->where('id',$page_id);

   $this->db->update(PAGE_HEADING,$records);

  }

  // **********************  Page Heading Section End**********************/

  

  public function GetCampaignTypeFormAttribute($values,$faq_id='')

  {

   $attribute['form']=array('onSubmit'=>'return ValidateCampaignForm();');

   $attribute['type_name']=array('name'=> 'type_name','id'=> 'type_name','value'=>$values['type_name'],'size'=>'74');   



   $attribute['mission_statement'] = array('name'=>'mission_statement', 'id'=> 'mission_statement', 'value'=>$values['mission_statement'],"rows"=>'8','cols'=>'80');

   

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

  public function InsertCampaignType($record)

  {

   $records=$this->db_query->TrimValues($record);

   $sql="update ".CAMPAIGN_TYPE." set position=position + 1";

   $this->db->query($sql);

   $records['position']=1;

   $records['modified_by_user']=$this->session->userdata('username');

   $records['dateadded']=date("Y-m-d");

   $this->db->insert(CAMPAIGN_TYPE,$records);

  }

  public function DeleteRecordForCampaignType($all_ids)

  {

   if(count($all_ids) > 0)

   {

    foreach($all_ids as $cat_id)

	{

	 $position=$this->db_query->FetchSingleInformation(CAMPAIGN_TYPE,"position","id='$cat_id'");

	 $this->db_query->DeleteRecord(CAMPAIGN_TYPE,"id='$cat_id'");

	 $this->Login_model->SetPositionAfterDeletion(CAMPAIGN_TYPE,$position['position']);

     $this->DeleteImagesBrochure(CAMPAIGN_IMAGES, 'campaign_id', $cat_id, 'image_file', './images/campaign/');

	}

   }

  }

  public function DeleteUserCampaignImage($all_images)

  {

   if(count($all_images) > 0)

   {

	foreach($all_images as $image_id)

	{   

	 $records=array();   	  

     $records['campaign_image'] ='';

     $this->db->where('campaign_image',$image_id);

     $this->db->update(USER_CAMPAIGNS, $records);

	}

   }

  }

  public function DeleteImagesBrochure($table, $parent_field, $parent_value, $field_name, $file_path)

  {

   $sq = "SELECT ".$field_name." FROM ".$table." where ".$parent_field." = '".$parent_value."'";

   $query = $this->db->query($sq);

   if($query->num_rows() > 0)

   {

	foreach($query->result() as $row)

    {

	 $file_name = $row->$field_name;

	 if(!empty($file_name)) unlink($file_path.$file_name);

	}

   }

  }

  

  public function GetCampaignTypeDetails($id)

  {

   $values=array();

   $sql="select * from ".CAMPAIGN_TYPE." where id='$id'";

   $query=$this->db->query($sql);

   foreach($query->result() as $row)

   {

    $values['type_name']=$row->type_name;

    $values['mission_statement']=$row->mission_statement;

   }

   return $values;   

  }

  public function UpdateCampaignType($record,$id)

  {

   $records=$this->db_query->TrimValues($record);

   $records['modified_by_user']=$this->session->userdata('username');   

   $this->db->where('id',$id);

   $this->db->update(CAMPAIGN_TYPE,$records);

  }

  public function GetAllCategories()

  {

   return $this->db->select("*")->from(CAMPAIGN_TYPE)->order_by('position','asc')->get()->result_array();

  }

  public function GetCampaignDropDownAttribute()

  {

   $attribute['form']=array('onSubmit'=>'return false;');

   $news_list['']="Select";

   if(count($this->GetCampaignListForDropDown()) > 0)

   {

    foreach($this->GetCampaignListForDropDown() as $key=>$project_title)

    {

     $news_list[$key]=$project_title;

    }

   }

   $attribute['campaign_id']=$news_list;

   return $attribute;

  } 

  public function GetCampaignListForDropDown()

  {

   $sql="select id,type_name from ".CAMPAIGN_TYPE." order by position";

   $query=$this->db->query($sql);

   $news_list=array();

   if($query->num_rows() > 0)

   {

    foreach($query->result() as $row)

	{

	 $news_list[$row->id]=$row->type_name;

	}

   }

   return $news_list;

  }

  public function GetCommonSettingFormAttribute($values)

  {

   $attribute['form']=array('onSubmit'=>'return ValidateCommonSetting();');

   $attribute['campaign_logo']=array('name'=> 'campaign_logo','id'=> 'campaign_logo','value'=>'');

   if(isset($values['current_campaign_logo']) and !empty($values['current_campaign_logo']))

   {

    $attribute['current_campaign_logo']=$values['current_campaign_logo'];

   }

   $attribute['common_banner']=array('name'=> 'common_banner','id'=> 'common_banner','value'=>'');

   if(isset($values['current_common_banner']) and !empty($values['current_common_banner']))

   {

    $attribute['current_common_banner']=$values['current_common_banner'];

   }

   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');

   return $attribute;

   

  }

  public function UpdateSettingRecords($records)

  {

   $records['modified_by_user']=$this->session->userdata('username');

   $this->db->update(CAMPAIGN_SETTINGS,$records);

  }

  public function GetCampaignInformation()

  {

   $values=$this->db_query->FetchSingleInformation(CAMPAIGN_SETTINGS,"campaign_logo as current_campaign_logo~common_banner as current_common_banner","id='1'");

   return $values;

  }

  

 } 

?> 