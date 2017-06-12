<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Testimonials_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }
  public function GetTestimonialsFormAttribute($values,$testimonials_id='')
  {
   $attribute['form']=array('onSubmit'=>'return ValidateTestimonialsForm();');
   $attribute['testimonials_title']=array('name'=> 'testimonials_title','id'=> 'testimonials_title','value'=>$values['testimonials_title'],'size'=>'63',"onKeyUp"=>"return CountCharacters('testimonials_title','limit1','85')");   
   $attribute['description']=array('name'=> 'description','id'=> 'description','value'=>$values['description'],'rows'=> '5','cols'=> '105');   

   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['testimonials_title']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');
   $attribute['image_file']=array('name'=> 'image_file','id'=> 'image_file','value'=>'');
   if(isset($values['current_image']) and !empty($values['current_image']))
   {
    $attribute['current_image']=$values['current_image'];
   }
   
   
   if(!empty($testimonials_id))
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Update');
   }
   else
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   }
   return $attribute;
   
  }
  public function GetVideoAttributes($values,$video_id)
  {
   $attribute['form']=array('onSubmit'=>'return ValidateVideoForm();');
   $attribute['video_title']=array('name'=> 'video_title','id'=> 'video_title','value'=>$values['video_title'],'size'=>'70',"onKeyUp"=>"return CountCharacters('video_title','limit1','75')");      
   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['video_title']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');  $attribute['video_code']=array('name'=> 'video_code','id'=> 'video_code','value'=>$values['video_code'],'rows'=> '5','cols'=> '55');
   	
   if(!empty($video_id))
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Update');
   }
   else
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   }
   return $attribute;
  }
  public function UpdateVideoPosition($current_position,$id,$table_name)
  {
    $sql="update ".$table_name." set position=(position-1) where position > $current_position ";
    $this->db->query($sql);
  }

  public function GetVideoDetails($video_id)
  {
   return $this->db_query->FetchSingleInformation(VIDEO_TESTIMONIALS,"video_title~video_code~position","id='$video_id'");
  }
  public function UpdateVideo($records,$cat_id)
  {
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->where('id',$cat_id);
   $this->db->update(VIDEO_TESTIMONIALS,$records);
  }
  public function InsertVideo($records)
  {
   $sql="update ".VIDEO_TESTIMONIALS." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['dateadded']=date("Y-m-d");
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->insert(VIDEO_TESTIMONIALS,$records);
  }
  public function DeleteVideoRecord($delete_ids,$table_name)
  {
	
     foreach($delete_ids as $id)
     {
	  $values=array();
	  $values=$this->GetVideoDetails($id);
      $this->db->delete($table_name,array('id' => $id));
	  $this->UpdateVideoPosition($values['position'],$id,$table_name);
     }
	 
    }
  public function GetAllVideos()
  {
   $categories=array();
   $sql="SELECT * FROM ".VIDEO_TESTIMONIALS." order by position";
   $query=$this->db->query($sql);
   if($query->num_rows() > 0)
   {
    $i=0;
    foreach($query->result() as $row)
    {
     $categories[$i]['id']=$row->id;
     $categories[$i]['video_title']=$row->video_title;
     $categories[$i]['video_code']=$row->video_code;
     $categories[$i]['status']=$row->status;
     $i++;
    }
   }
   return $categories;
  }
 
  public function InsertTestimonials($record)
  {
   $records=$this->db_query->TrimValues($record);
   $sql="update ".TESTIMONIALS." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->insert(TESTIMONIALS,$records);
  }
  public function GetTestimonialsList()
  {
   return $this->db_query->FetchInformation(TESTIMONIALS,"","1='1' order by position asc"); 
  }
  public function DeleteRecordForTestimonials($all_ids)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $testimonials_id)
	{
	 $position=$this->db_query->FetchSingleInformation(TESTIMONIALS,"position","id='$testimonials_id'");
	 $this->db_query->DeleteRecord(TESTIMONIALS,"id='$testimonials_id'");
	 $this->Login_model->SetPositionAfterDeletion(TESTIMONIALS,$position['position']);
	}
   }
  }
  public function DeleteRecordForVideos($all_ids)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $testimonials_id)
	{
	 $position=$this->db_query->FetchSingleInformation(VIDEO_TESTIMONIALS,"position","id='$testimonials_id'");
	 $this->db_query->DeleteRecord(VIDEO_TESTIMONIALS,"id='$testimonials_id'");
	 $this->Login_model->SetPositionAfterDeletion(VIDEO_TESTIMONIALS,$position['position']);
	}
   }
  }
  public function GetTestimonialsDetails($testimonials_id)
  {
   $values=array();
   $sql="select * from ".TESTIMONIALS." where id='$testimonials_id'";
   $query=$this->db->query($sql);
   foreach($query->result() as $row)
   {
    $values['testimonials_title']=$row->testimonials_title;
    $values['description']=$row->description;
//    $values['current_image']=$row->image_file;
   }
   return $values;   
  }
  public function UpdateTestimonials($record,$testimonials_id)
  {
   $records=$this->db_query->TrimValues($record);
   $records['modified_by_user']=$this->session->userdata('username');   
   $this->db->where('id',$testimonials_id);
   $this->db->update(TESTIMONIALS,$records);
  }
  public function UpdateRecordAfterDeletion($testimonials_id,$records)
  {
   $records['modified_by_user']=$this->session->userdata('username');   
   $this->db->where('id',$testimonials_id);
   $this->db->update(TESTIMONIALS,$records);
  }
  public function GetTestimonialsDropDownAttribute()
  {
   $attribute['form']=array('onSubmit'=>'return false;');
   $testimonials_list['']="Select";
   if(count($this->GetTestimonialsListForDropDown()) > 0)
   {
    foreach($this->GetTestimonialsListForDropDown() as $key=>$testimonials_title)
    {
     $testimonials_list[$key]=$testimonials_title;
    }
   }
   $attribute['testimonials_id']=$testimonials_list;
   return $attribute;
  } 
  public function GetTestimonialsListForDropDown()
  {
   $sql="select id,testimonials_title from ".TESTIMONIALS." order by position";
   $query=$this->db->query($sql);
   $testimonials_list=array();
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
	{
	 $testimonials_list[$row->id]=$row->testimonials_title;
	}
   }
   return $testimonials_list;
  }
  
 }
?> 