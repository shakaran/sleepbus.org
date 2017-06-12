<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Downloads_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }
  public function GetCategoryDetails($cat_id)
  {
   return $this->db_query->FetchSingleInformation(DOWNLOAD_CATEGORIES,"category_name","id='$cat_id'");
  }
  public function GetAllCategories()
  {
   $categories=array();
   $sql="SELECT * FROM ".DOWNLOAD_CATEGORIES." order by position";
   $query=$this->db->query($sql);
   if($query->num_rows() > 0)
   {
    $i=0;
    foreach($query->result() as $row)
    {
     $categories[$i]['id']=$row->id;
     $categories[$i]['category_name']=$row->category_name;
     $categories[$i]['status']=$row->status;
     $i++;
    }
   }
   return $categories;
  }
  public function GetCategoryAttributes($values,$cat_id)
  {
   $attribute['form']=array('onSubmit'=>'return ValidateCategoryForm();');
   $attribute['category_name']=array('name'=> 'category_name','id'=> 'category_name','value'=>$values['category_name'],'size'=>'70',"onKeyUp"=>"return CountCharacters('category_name','limit1','75')");      
   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['category_name']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');   
   if(!empty($cat_id))
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Update');
   }
   else
   {
    $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   }
   return $attribute;
  }
  public function UpdateCategory($records,$cat_id)
  {
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->where('id',$cat_id);
   $this->db->update(DOWNLOAD_CATEGORIES,$records);
  }
  public function InsertCategory($records)
  {
   $sql="update ".DOWNLOAD_CATEGORIES." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['dateadded']=date("Y-m-d");
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->insert(DOWNLOAD_CATEGORIES,$records);
  }
  public function DeleteRecordForCategories($all_ids)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $cat_id)
	{
	 $position=$this->db_query->FetchSingleInformation(DOWNLOAD_CATEGORIES,"position","id='$cat_id'");
	 $this->db_query->DeleteRecord(DOWNLOAD_CATEGORIES,"id='$cat_id'");
	 $this->Login_model->SetPositionAfterDeletion(DOWNLOAD_CATEGORIES,$position['position']);
	 
	 // Deleting Download Brochures
	 $brochures_ids=array();
	 $brochures_ids=$this->GetDownloadBrochureIds($cat_id);
	 if(count($brochures_ids) > 0)
	 {
	  $this->Login_model->DeleteImageBrochureRecord($brochures_ids,'cat_id',$cat_id,DOWNLOADS,'brochure_file','./brochures/downloads/');
	 }
	}
   }
  }
  public function GetDownloadBrochureIds($cat_id)
  {
   $sql="select id from ".DOWNLOADS." where cat_id='$cat_id'";
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

  public function GetCategoriesDropDownAttribute()
  {
   $attribute['form']=array('onSubmit'=>'return false;');
   $category_list['']="Select";
   if(count($this->GetCategoryListForDropDown()) > 0)
   {
    foreach($this->GetCategoryListForDropDown() as $key=>$category_title)
    {
     $category_list[$key]=$category_title;
    }
   }
   $attribute['cat_id']=$category_list;
   return $attribute;
  } 
  public function GetCategoryListForDropDown()
  {
   $sql="select id,category_name from ".DOWNLOAD_CATEGORIES." order by position";
   $query=$this->db->query($sql);
   $category_list=array();
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
	{
	 $category_list[$row->id]=$row->category_name;
	}
   }
   return $category_list;
  }
 } 
?> 