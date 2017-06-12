<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Campaign_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }

    public function GetCampaignIDByURL($campaign_url) {
        /*
            CodeIgniter automatically converts hyphens to underscores in its
            routing, but we use hyphens to replace spaces in urls derived
            from campaign names with hyphens, so need to convert them back
            to hyphenated form here
         */
        $campaign_url = str_replace('_', '-', $campaign_url);

	    $sql = "SELECT id from user_campaigns where url = ? and status='1'";
        $campaign_id = $this->db->query($sql, array($campaign_url))->row()->id;
 
        return $campaign_id;
    }
  
  public function GetFundraiseFormAttributes($values,$campaign_type='')
  {
   if(count($values) == 0)
   {
    $values=array('campaign_name'=>'','campaign_goal'=>'','campaign_end_date'=>'','campaign_image'=>'');  
   }  
    $attribute['form'] = array('onSubmit'=>'return ValidateFundraiseForm();' ,'name'=>'pledge_frm');
    $attribute['campaign_name'] = array('name'=>'campaign_name', 'id'=> 'campaign_name', 'value'=>$values['campaign_name'],'class'=>'form-control','placeholder'=>'Give your campaign a name',);
    $attribute['campaign_goal'] = array('name'=>'campaign_goal', 'id'=> 'campaign_goal', 'value'=>$values['campaign_goal'],'placeholder'=>'275.00','class'=>'form-control');

    $attribute['campaign_end_date'] = array('name'=>'campaign_end_date', 'id'=> 'campaign_end_date', 'value'=>$values['campaign_end_date'],'placeholder'=>'DD/MM/YYYY','class'=>'form-control');

   $questions['']="Please choose";
   if(count($this->GetCampaignTypes()) > 0)
   {
    foreach($this->GetCampaignTypes() as $sources)
    {
     $questions[$sources['id']]="&nbsp;&nbsp;".$sources['type_name'];
    }
   }
   $attribute['campaign_type']=$questions;
   $attribute['campaign_type_value']=$campaign_type;
   
   if(!empty($campaign_type))
   {
    $attribute['campaign_images']=$this->GetCampaignImages($campaign_type);
	if(count($attribute['campaign_images']) > 0)
	{
     foreach($attribute['campaign_images'] as $image)
	 {
	  if($values['campaign_image'] == $image['id']) $checked=true; else $checked=false;
	  $attribute['campaign_image_'.$image['id']]=array('name'=>'campaign_image', 'id'=> 'campaign_image_'.$image['id'], 'value'=>$image['id'],'checked'=>$checked);
	 }
	}
    $attribute['campaign_details']=$this->GetCampaignDetails($campaign_type);
   }	
	
    $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Create Campaign','class'=>'btn btn-primary');
   
   return $attribute;
  }
  public function GetCampaignTypes()
  {
   return $this->db_query->FetchInformation(CAMPAIGN_TYPE,"","status='1' order by position"); 
  }
  public function GetCampaignImages($campaign_id)
  {
   return $this->db_query->FetchInformation(CAMPAIGN_IMAGES,"","status='1' and campaign_id='".$campaign_id."' order by position"); 
  }
  public function GetCampaignDetails($campaign_id)
  {
   return $this->db_query->FetchSingleInformation(CAMPAIGN_TYPE,"","status='1' and id='".$campaign_id."' order by position"); 
  }
  public function GetCampaignInfoFormAttributes($campaign_type)
  {
   $values=array('campaign_image'=>''); 
   $attribute=array(); 
   if(!empty($campaign_type))
   {
    $attribute['campaign_images']=$this->GetCampaignImages($campaign_type);
	if(count($attribute['campaign_images']) > 0)
	{
     foreach($attribute['campaign_images'] as $image)
	 {
	  if($values['campaign_image'] == $image['id']) $checked=true; else $checked=false;
	  $attribute['campaign_image_'.$image['id']]=array('name'=>'campaign_image', 'id'=> 'campaign_image_'.$image['id'], 'value'=>$image['id'],'checked'=>$checked);
	 }
	}
    $attribute['campaign_details']=$this->GetCampaignDetails($campaign_type);
   }	
   return $attribute;
    
  }
  
	public function GenerateNewUrl($original_url)
	{
     $count = 1;
	 $url = $original_url;
	 $unique_url=false;
	 while($unique_url != true)
	 {
	  $unique_url=$this->GetUniqueURL($url);
	  if($unique_url == false)
	  {
	   $url = $original_url.'-'.$count;	
	   $count++;  
	  }
	 }
	 return $url;
	}
	
	public function GetUniqueURL($search_url)
	{
	 $urls=array();
	 $tables=array(USER_CAMPAIGNS);
	 $return=true;
	 if(count($tables) > 0)
	 {
	  foreach($tables as $table)	
	  {
	   $sql="select url from ".$table." where url='$search_url'";
	   $res=$this->db->query($sql);
	   if($res->num_rows() > 0){ $return = false;break;}
	  }
	 }

	 return $return;
	}
  
 }
?>
