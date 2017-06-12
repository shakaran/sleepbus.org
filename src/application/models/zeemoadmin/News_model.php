<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class News_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }
  public function GetNewsFormAttribute($values,$news_id='')
  {
   $attribute['form']=array('onSubmit'=>'return ValidateNewsForm();');
   $attribute['news_title']=array('name'=> 'news_title','id'=> 'news_title','value'=>$values['news_title'],'size'=>'84',"onKeyUp"=>"return CountCharacters('news_title','limit1','110')");   
   $attribute['intro_text']=array('name'=> 'intro_text','id'=> 'intro_text','value'=>$values['intro_text'],'rows'=> '5','cols'=> '85',"onKeyUp"=>"return CountCharacters('intro_text','limit2','500')");
   $attribute['limit2']=array('name'=> 'limit2','id'=> 'limit2','value' => strlen($values['intro_text']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');
   
   $attribute['date_display']=array('name'=> 'date_display','id'=> 'date_display','value'=>$values['date_display'],'size'=>'25','readonly'=>'readonly');      


   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['news_title']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');
   $attribute['description'] = array('name'=>'description', 'id'=> 'description', 'value'=>$values['description'], 'rows'=>'4', 'cols'=>'85');      
   
   if(!empty($news_id))
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Update');
   }
   else
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   }
   return $attribute;
   
  } 
  public function InsertNews($record)
  {
   $records=$this->db_query->TrimValues($record);
   $sql="update ".NEWS." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['modified_by_user']=$this->session->userdata('username');
   $date_selected=$records['date_display'];
   $temp = explode("-",$date_selected);
   $date = $temp[2]."-".$temp[1]."-".$temp[0];
   $time = date("h:i:s");
   $records['date_display'] = $date. " ".$time;
   $records['date_entered']=date("Y-m-d");
   $this->db->insert(NEWS,$records);
  }
  public function GetNewsList()
  {
   return $this->db_query->FetchInformation(NEWS,"","1='1' order by position asc"); 
  }
  public function GetNewsDropDownAttribute()
  {
   $attribute['form']=array('onSubmit'=>'return false;');
   $news_list['']="Select";
   if(count($this->GetNewsListForDropDown()) > 0)
   {
    foreach($this->GetNewsListForDropDown() as $key=>$news_title)
    {
     $news_list[$key]=$news_title;
    }
   }
   $attribute['news_id']=$news_list;
   return $attribute;
  } 
  public function GetNewsListForDropDown()
  {
   $sql="select id,news_title from ".NEWS." order by position";
   $query=$this->db->query($sql);
   $news_list=array();
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
	{
	 $news_list[$row->id]=$row->news_title;
	}
   }
   return $news_list;
  }
  public function DeleteRecordForNews($all_ids)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $news_id)
	{
	 $position=$this->db_query->FetchSingleInformation(NEWS,"position","id='$news_id'");
	 $this->db_query->DeleteRecord(NEWS,"id='$news_id'");
	 $this->Login_model->SetPositionAfterDeletion(NEWS,$position['position']);
	 
	 // Deleting news images
	 $image_ids=array();
	 $image_ids=$this->GetNewsImagesBrochureIds(NEWS_IMAGES,$news_id);
	 if(count($image_ids) > 0)
	 {
	  $this->Login_model->DeleteImageBrochureRecord($image_ids,'news_id',$news_id,NEWS_IMAGES,'image_file','./images/news/');
	 }
	 // Deleting news Brochures
	 $brochures_ids=array();
	 $brochures_ids=$this->GetNewsImagesBrochureIds(NEWS_BROCHURES,$news_id);
	 if(count($brochures_ids) > 0)
	 {
	  $this->Login_model->DeleteImageBrochureRecord($brochures_ids,'news_id',$news_id,NEWS_BROCHURES,'brochure_file','./brochures/news/');
	 }
	 $this->Login_model->DeleteBanner('news',$news_id);
	 $this->Login_model->DeleteMetaTags('NEWS',$news_id);
   	 $this->Login_model->DeleteCtaRecords('NEWS',$news_id);
	}
   }
  }
  public function GetNewsImagesBrochureIds($table_name,$news_id)
  {
   $sql="select id from ".$table_name." where news_id='$news_id'";
   $query=$this->db->query($sql);
   $all_ids=array();
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
    {
     $all_ids[]=$row->id;
	}
   }
   return $all_ids;
  }
  public function GetNewsDetails($news_id)
  {
   $values=array();
   $sql="select * from ".NEWS." where id='$news_id'";
   $query=$this->db->query($sql);
   foreach($query->result() as $row)
   {
    $values['news_title']=$row->news_title;
    $values['description']=$row->description;
    $values['url']=$row->url;
    $values['intro_text']=$row->intro_text;
    $values['date_entered']=$row->date_entered;
    $values['date_display']=$row->date_display;
	$temp=explode(" ",$values['date_display']);
	$temp1=$temp[0];
	$date=explode("-",$temp1);
	$values['date_display']= $date[2]."-".$date[1]."-".$date[0];
   }
   return $values;   
  }
  public function UpdateNews($record,$news_id)
  {
   $records=$this->db_query->TrimValues($record);
   $date_selected=$records['date_display'];
   $temp = explode("-",$date_selected);
   $date = $temp[2]."-".$temp[1]."-".$temp[0];
   $time = date("h:i:s");
   $records['date_display'] = $date. " ".$time;
   
   $records['modified_by_user']=$this->session->userdata('username');   
   $this->db->where('id',$news_id);
   $this->db->update(NEWS,$records);
  }
  public function UpdateRecordAfterDeletion($news_id,$records)
  {
   $records['modified_by_user']=$this->session->userdata('username');   
   $this->db->where('id',$news_id);
   $this->db->update(NEWS,$records);
  }
 } 
?> 