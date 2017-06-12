<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Project_model extends CI_Model
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
  public function GetProjectFormAttribute($values,$edit_id='')
  {
   $attribute['form'] = array('onSubmit'=>'return ValidateProjectForm();');
   $attribute['project_title'] = array('name'=>'project_title', 'id'=> 'project_title', 'value'=>$values['project_title'], 'size'=>'41');
   $attribute['description'] = array('name'=>'description', 'id'=> 'description', 'value'=>$values['description'], 'rows'=>'4', 'cols'=>'32');
   $attribute['intro_text'] = array('name'=>'intro_text', 'id'=> 'intro_text', 'value'=>$values['intro_text'], 'rows'=>'4', 'cols'=>'32');

   if(!empty($edit_id))
   {
	$attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Update');
   }
   else $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Submit');

   return $attribute;
  } 
  public function InsertProject($record)
  {
   $records = $this->db_query->TrimValues($record);
   $sql = "update ".PROJECTS." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['modified_by_user'] = $this->session->userdata('username');
   $records['dateadded'] = date('Y-m-d H:i:s');   
   $this->db->insert(PROJECTS,$records);
  }
  public function GetProjectDetails($project_id)
  {
   $values=array();
   $sql = "select * from ".PROJECTS." where id='$project_id'";
   $query = $this->db->query($sql);
   foreach($query->result() as $row)
   {
    $values['project_title'] = $row->project_title;
    $values['description'] = $row->description;
	$values['intro_text'] = $row->intro_text;
   }
   return $values;   
  }
  public function UpdateProject($record, $project_id)
  {
   $records = $this->db_query->TrimValues($record);
   $records['modified_by_user'] = $this->session->userdata('username');   
   $this->db->where('id',$project_id);
   $this->db->update(PROJECTS,$records);
  }
  public function GetProjectList()
  {
   return $this->db_query->FetchInformation(PROJECTS,"","1='1' order by position asc"); 
  }
  public function DeleteProjects($all_ids)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $cat_id)
	{
 	 $this->Login_model->DeleteMetaTags('PROJECTS',$cat_id);
     $this->Login_model->DeleteCtaRecords('PROJECTS',$cat_id);
	 $cat_info = $this->db_query->FetchSingleInformation(PROJECTS, "position", "id='$cat_id'");
     $this->Login_model->SetPositionAfterDeletion(PROJECTS, $cat_info['position']);	   		   
     $this->db_query->DeleteRecord(PROJECTS,"id='$cat_id'");
     $this->DeleteImagesBrochure(PROJECT_IMAGES, 'project_id', $cat_id, 'image_file', './images/projects/');
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
  public function GetProjectDropDownAttribute()
  {
   $attribute['form']=array('onSubmit'=>'return false;');
   $news_list['']="Select";
   if(count($this->GetProjectListForDropDown()) > 0)
   {
    foreach($this->GetProjectListForDropDown() as $key=>$project_title)
    {
     $news_list[$key]=$project_title;
    }
   }
   $attribute['project_id']=$news_list;
   return $attribute;
  } 
  public function GetProjectListForDropDown()
  {
   $sql="select id,project_title from ".PROJECTS." order by position";
   $query=$this->db->query($sql);
   $news_list=array();
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
	{
	 $news_list[$row->id]=$row->project_title;
	}
   }
   return $news_list;
  }
   
 } 
?> 
