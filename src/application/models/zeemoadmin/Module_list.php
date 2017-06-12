<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Module_List extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetModuleList($condition='')
  {
   $modules=array();
   if(empty($condition))
   {
    $modules=$this->db_query->FetchInformation(ADMIN_MODULES,"module_name~url~id~position~status~left_menu_icon","parent_id='0'  order by position");
   }
   else
   {
    $modules=$this->db_query->FetchInformation(ADMIN_MODULES,"module_name~url~id~position~status","url !='$condition' and parent_id='0'  order by position");
   }
   return $modules;
  }
  public function GetSubmoduleList($module_id)
  {
   $submodules=array();
   $submodules=$this->db_query->FetchInformation(ADMIN_MODULES,"module_name~url~id~position~status","parent_id='$module_id'  order by position");
   return $submodules;
  }
  public function GetModuleListForDropDown()
  {
   $modules=array();
   $sql="select id,module_name from ".ADMIN_MODULES." where parent_id='0' order by position";
   $query=$this->db->query($sql);
   foreach($query->result() as $row)
   {
    $modules[$row->id]=stripslashes($row->module_name);
   }
   return $modules;
  }
  public function GetSubmoduleFormAttributes()
  {
   $attribute['form']=array('onSubmit'=>'return ValidateLoginForm();');
   $module_list[]="Select";
   foreach($this->GetModuleListForDropDown() as $key=>$module_name)
   {
    $module_list[$key]=stripslashes($module_name);
   }
   $attribute['module_id']=$module_list;
   return $attribute;
  }
  public function GetUpdateModuleFormAttributes($values)
  {
   $attribute['form']=array('id'=>'frm','name'=>'frm','onSubmit'=>'return false');
   $attribute['module_name']=array('name'=> 'module_name','id'=> 'module_name','value' => $values['module_name'],'size'=>'40');
   $attribute['parent_id']=$data = array('parent_id' => $values['parent_id']);
   $attribute['module_id']=$data = array('module_id' => $values['id']);
   $attribute['path']=$data = array('path' => base_url());
   $attribute['option2']=$data = array('name' => 'option2','id' => 'option2','value' => 'true','type' => 'button','content' => 'Cancel');
   $attribute['option1']=$data = array('name' => 'option1','id' => 'option1','value'=>'Update');
   return $attribute;
  } 
  public function AddModuleFormAttribute($values,$edit_id='')
  {
   $attribute['form']=array('onSubmit'=>'return ValidateModuleForm()');
   $attribute['module_name']=array('name'=> 'module_name','id'=> 'module_name','value' => $values['module_name'],'size'=>'40');
   $attribute['url']=array('name'=> 'url','id'=> 'url','value' => $values['url'],'size'=>'40');
   $attribute['header_icon']=array('name'=> 'header_icon','id'=> 'header_icon','value'=>'');
   if(isset($values['current_header_icon']) and !empty($values['current_header_icon']))
   {
    $attribute['current_header_icon']=$values['current_header_icon'];
   }
   
   $attribute['home_page_icon']=array('name'=> 'home_page_icon','id'=> 'home_page_icon','value'=>'');
   if(isset($values['current_home_page_icon']) and !empty($values['current_home_page_icon']))
   {
    $attribute['current_home_page_icon']=$values['current_home_page_icon'];
   }   
   $attribute['left_menu_icon']=array('name'=> 'left_menu_icon','id'=> 'left_menu_icon','value'=>'');
   if(isset($values['current_left_menu_icon']) and !empty($values['current_left_menu_icon']))
   {
    $attribute['current_left_menu_icon']=$values['current_left_menu_icon'];
   }   

   if(!empty($edit_id))
   {
	$attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Update');
   }
   else $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Submit');
   return $attribute;
   
  }
  
  public function AddSubModuleFormAttribute($values,$edit_id='')
  {
   $attribute['form']=array('onSubmit'=>'return ValidateSubModuleForm()');
   $attribute['module_name']=array('name'=> 'module_name','id'=> 'module_name','value' => $values['module_name'],'size'=>'40');
   $attribute['url']=array('name'=> 'url','id'=> 'url','value' => $values['url'],'size'=>'40');

   if(!empty($edit_id))
   {
	$attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Update');
   }
   else $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Submit');
   return $attribute;
   
  }
  
  public function GetModuleDetails($module_id)
  {
   return $this->db_query->FetchSingleInformation(ADMIN_MODULES,"","id='$module_id' order by position");
  } 
  public function ValidateModuleName($module_name,$module_id,$parent_id)
  {
   $sql="select id from ".ADMIN_MODULES." where module_name='".addslashes($module_name)."' and parent_id='$parent_id' and id!='$module_id'";
   $query = $this->db->query($sql);
   if($query->num_rows() > 0)
   {
    return 'duplicate';
   }
   else
   {
    $this->db->where('id', $module_id);
    $records['module_name']=trim($module_name);
    $this->db->update(ADMIN_MODULES, $records); 
    return 'unique';
   }
  }
  public function DeleteRecordForModules($all_ids)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $module_id)
	{
	 $submodule_list=array();
	 $sql="select id from ".ADMIN_MODULES." where parent_id='$module_id'";
	 $query=$this->db->query($sql);
	 if($query->num_rows() > 0)
	 {
	  foreach($query->result() as $row)
	  {
	   $submodule_list[]=$row->id;
	  }
	  $this->db_query->DeleteRecord(ADMIN_MODULES,"parent_id='$module_id'");
	 }
	 $submodule_list[]=$module_id;	 
	 $all_module_list=implode(",",$submodule_list);
	 $this->db_query->DeleteRecord(LEVEL_TO_MODULES,"module_id in (".$all_module_list.")");
	 $module_info=$this->db_query->FetchSingleInformation(ADMIN_MODULES,"position~home_page_icon~header_icon~left_menu_icon","id='$module_id'");
	 if(!empty($module_info['home_page_icon']))
	 {
	  unlink('./images/admin/cms-settings/home/'.$module_info['home_page_icon']);
	 }
	 if(!empty($module_info['header_icon']))
	 {
	  unlink('./images/admin/cms-settings/top/'.$module_info['header_icon']);
	 }
	 if(!empty($module_info['left_menu_icon']))
	 {
	  unlink('./images/admin/cms-settings/left/'.$module_info['left_menu_icon']);
	 }
	 
	 $this->db_query->DeleteRecord(ADMIN_MODULES,"id='$module_id'");
	 $this->Login_model->SetPositionAfterDeletion(ADMIN_MODULES,$module_info['position']);
	}
   }
  }
  public function GetModuleId($submodule_id)
  {
   $module=array();
   $module=$this->db_query->FetchSingleInformation(ADMIN_MODULES,"parent_id","id='".$submodule_id."'");
   return $module['parent_id'];
  }
  public function DeleteRecordForSubmodules($checked_ids)
  {
   if(count($checked_ids) > 0)
   {
	foreach($checked_ids as $checked_id)
	{
     $position=$this->db_query->FetchSingleInformation(ADMIN_MODULES,"position","id='$checked_id'");
     $this->db_query->DeleteRecord(ADMIN_MODULES,"id='$checked_id'");
     $this->Login_model->SetPositionAfterDeletion(ADMIN_MODULES,$position['position']);
	}
    $all_module_list=implode(",",$checked_ids);
	$this->db_query->DeleteRecord(LEVEL_TO_MODULES,"module_id in (".$all_module_list.")");
   }
  }
  public function GetHelpTextFormAttribute($values)
  {
   $attribute['form']=array('onSubmit'=>'return true;');

   
   $attribute['help_text']=array('name'=> 'help_text','id'=> 'help_text','value'=>$values['help_text'],'rows'=> '5','cols'=> '105');   
   
   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   $attribute['option2']=$data = array('name' => 'option2','id' => 'option2','value' => 'true','type' => 'button','content' => 'Cancel');
   return $attribute;
  }
  public function UpdateHelpText($values,$submodule_id)
  {
   $records['help_text']=$values['help_text'];
   $this->db->where('id',$submodule_id);
   $this->db->update(ADMIN_MODULES,$records);
  }
  public function InsertModule($record,$parent_id=0)
  {
   $records = $this->db_query->TrimValues($record);
   $sql = "update ".ADMIN_MODULES." set position=position + 1 where parent_id='$parent_id'";
   $this->db->query($sql);
   $records['position']=1;
   $records['modified_by_user'] = $this->session->userdata('username');
   $records['dateadded'] = date('Y-m-d H:i:s');   
   $this->db->insert(ADMIN_MODULES,$records);
  }
  public function UpdateModule($records,$module_id)
  {
   $records = $this->db_query->TrimValues($records);
   $records['modified_by_user'] = $this->session->userdata('username');   
   $this->db->where('id',$module_id);
   $this->db->update(ADMIN_MODULES, $records);
  }
 }
?>