<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class User_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetLevelFormAttributes($values=array())
  {
   if(isset($values['checked_modules']) and count($values['checked_modules']) > 0)
   {
    $checked_box=count($values['checked_modules']);
   }
   else
   {
    $checked_box=0;
   }
   $attribute['form']=array('id'=>'user_level_frm','name'=>'user_level_frm','onSubmit'=>'return ValidateLevelForm();');
   $attribute['level_name']=array('name'=> 'level_name','id'=> 'level_name','value' => $values['level_name'],'size'=>'40');
   $attribute['submit']=array('name'=> 'level_submit','id'=> 'level_submit','value'=>$values['submit_value'],'size'=>'40');
   $all_modules=$this->db_query->FetchInformation(ADMIN_MODULES,"","status='1' and parent_id='0' and id NOT IN ('12','90','35') order by position");
   $total_checkbox=0;
   if(count($all_modules) > 0)
   {
	$i=0;
    foreach($all_modules as $module)
	{
     $submodules=$this->db_query->FetchInformation(ADMIN_MODULES,"","status='1' and parent_id='".$module['id']."' order by position");
	 if(count($submodules) > 0)
	 {
   	  $j=0;
	  $total_checkbox++;
	  $attribute['modules'][$i]=$module;
	  if(isset($values['checked_modules']) and in_array($module['id'],$values['checked_modules'])) $checked=true;
	  else $checked=false;
	  $attribute['module_checkbox_'.$module['id']]=array('name'=>'module_checkbox[]',"value"=>$module['id'],'id'=>'module_checkbox_'.$module['id'],'onClick'=>"CheckUncheckSubmodule(".$module['id'].");UncheckAll(this.id)",'class'=>'level_check_box','checked'=>$checked);
	  $attribute['total_submodule_'.$module['id']]=count($submodules);
	  foreach($submodules as $submodule)
	  {
	   $total_checkbox++;
	   if(isset($values['checked_modules']) and in_array($submodule['id'],$values['checked_modules'])) $checked=true;
	  else $checked=false;
	   $attribute['modules'][$i]['submodules'][$j]=$submodule;
	   $attribute['submodule_checkbox_'.$submodule['id']]=array('name'=>'submodule_checkbox_'.$module['id'].'[]',"value"=>$submodule['id'],'id'=>'submodule_checkbox_'.$module['id']."_".$j,'onClick'=>"UncheckAll(this.id);CheckUncheckModule(".$module['id'].",".$submodule['id'].",this.id)",'class'=>'level_check_box','checked'=>$checked);
	   $j++;
	  }
	 }	 
	 $i++;
	}
   }
   $attribute['total_checkbox']=$total_checkbox;
   $attribute['checked_box']=$checked_box;
   if($total_checkbox == $checked_box)
   {
    $attribute['check_all']=array('name'=> 'check_all','id'=> 'check_all','value' => 'all','checked'=>true);
   }
   else
   {
    $attribute['check_all']=array('name'=> 'check_all','id'=> 'check_all','value' => 'all','checked'=>false);
   }
   return $attribute;
  }
  public function GetLevelList()
  {
   return $this->db_query->FetchInformation(ADMIN_LEVELS,"","id!=1");
  }
  public function InsertLevel($values)
  {
   $insert_values['name']=$values['level_name'];
   $insert_values['modified_by_user']=$this->session->userdata('username');
   $insert_values['date_added'] = date('Y-m-d H:i:s');   
   $this->db->insert(ADMIN_LEVELS,$insert_values);
   $insert_id=$this->db->insert_id();
   if(count($values['checked_modules']) > 0)
   {
    foreach($values['checked_modules'] as $module_id)
	{
	 $records=array();
     $records['level_id']=$insert_id;
     $records['module_id']=$module_id;
	 $this->db->insert(LEVEL_TO_MODULES,$records);
	}
   }
  }
  public function DeleteRecordForLevels($checked_ids)
  {
   $checked_ids_list=implode(",",$checked_ids);
   $this->db_query->DeleteRecord(ADMINISTRATORS,"level_id in ($checked_ids_list)");
   $this->db_query->DeleteRecord(LEVEL_TO_MODULES,"level_id in ($checked_ids_list)");
   $this->db_query->DeleteRecord(ADMIN_LEVELS,"id in ($checked_ids_list)");
  }
  public function DeleteRecordForUsers($checked_ids)
  {
   $checked_ids_list=implode(",",$checked_ids);
   $this->db_query->DeleteRecord(ADMINISTRATORS,"id in ($checked_ids_list)");
  }
  public function GetLevelFormDetails($level_id)
  {
   $values=array();
   $sql="select name from ".ADMIN_LEVELS." where id='$level_id'";
   $query=$this->db->query($sql);
   $result=$query->row();
   $values['level_name']=$result->name;
   $sql="select module_id from ".LEVEL_TO_MODULES." where level_id='$level_id'";
   $query=$this->db->query($sql);
   foreach($query->result() as $row)
   {
    $values['checked_modules'][]=$row->module_id;
   }
   return $values;
  }
  public function CheckUniqueLevelName($level_id,$level_name)
  {
   $sql="select name from ".ADMIN_LEVELS." where name='".$this->db->escape_str(trim($level_name))."' and id !='$level_id'";
   $query=$this->db->query($sql);
   if($query->num_rows() > 0)
   {
    return false;
   }
   else
   {
    return true;
   }
  }
  public function UpdateLevelRecord($level_id,$values)
  {
   $this->db->where('id', $level_id);
   $records['name']=trim($values['level_name']);
   $record['modified_by_user']=$this->session->userdata('username');
   $this->db->update(ADMIN_LEVELS, $records); 
   $this->db_query->DeleteRecord(LEVEL_TO_MODULES,"level_id='$level_id'");
   if(count($values['checked_modules']) > 0)
   {
    foreach($values['checked_modules'] as $module_id)
	{
	 $records=array();
     $records['level_id']=$level_id;
     $records['module_id']=$module_id;
	 $this->db->insert(LEVEL_TO_MODULES,$records);
	}
   }
  }
  public function GetUserFormAttributes($values,$level_id,$call_by='')
  {
   if(count($values) == 0)
   {
    $values=array('user'=>'','name'=>'','fname'=>'','lname'=>'','email'=>'','level_id'=>$level_id,'submit_value'=>'Submit');
   }
   $attribute=array();
   $attribute['form']=array('id'=>'add_user_frm','name'=>'add_user_frm','onSubmit'=>'return ValidateUserForm();');//ValidateUserForm()
   $attribute['username']=array('name'=> 'uname','id'=> 'uname','value' => $values['user'],'size'=>'32',"onKeyUp"=>"return CountCharacters('uname','limit1','15')");
   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['user']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');
   $attribute['password']=array('name'=> 'pword','id'=> 'pword','value' => '','size'=>'40');
   $attribute['confirm_password']=array('name'=> 'confirm_password','id'=> 'confirm_password','value' => '','size'=>'40');
   
   $attribute['submit']=array('name'=> 'action','id'=> 'action','value'=>$values['submit_value']);
   $attribute['fname']=array('name'=> 'fname','id'=> 'fname','value' => $values['fname'],'size'=>'40');
   $attribute['lname']=array('name'=> 'lname','id'=> 'lname','value' => $values['lname'],'size'=>'40');
   $attribute['email']=array('name'=> 'email','id'=> 'email','value' => $values['email'],'size'=>'40');
   if(!empty($call_by))
   {
    $attribute['called_by']=$call_by; 
   }
   else
   {
    $attribute['called_by']="validateuser"; 
   }


   $level_list['']="Select";
   if(count($this->GetLevelListForDropDown()) > 0)
   {
    foreach($this->GetLevelListForDropDown() as $key=>$level_name)
    {
     $level_list[$key]=$level_name;
    }
   }
   $attribute['level_id']=$level_list;
   $attribute['selected_level_id'] =$values['level_id'];
   return $attribute;
  }
  
  public function GetLevelListForDropDown()
  {
   $sql="select id,name from ".ADMIN_LEVELS." where status='1' and id !='1'";
   $query=$this->db->query($sql);
   $level_list=array();
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
	{
	 $level_list[$row->id]=$row->name;
	}
   }
   return $level_list;
  }
  public function GetManageUserFormAttributes()
  {
   $level_list['']="All";
   foreach($this->GetLevelListForDropDown() as $key=>$level_name)
   {
    $level_list[$key]=stripslashes($level_name);
   }
   $attribute['level_id']=$level_list;
   return $attribute;
  }
  
  public function InsertUser($values)
  {
   $records=array();
   $records['user']=trim($values['user']);
   $records['password']=md5($values['password']);
   $records['email']=trim($values['email']);
   $records['fname']=trim($values['fname']);
   $records['lname']=trim($values['lname']);
   $records['level_id']=$values['level_id'];
   $records['modified_by_user']=$this->session->userdata('username');
   $records['password_recovery']=$time=md5(time());
   $records['status']='0';
   $records['date_added'] = date('Y-m-d H:i:s');
   
   $this->db->insert(ADMINISTRATORS,$records);
   return $this->db->insert_id();
  }
  public function GetUserList($level_id='')
  {
   if(!empty($level_id)) $condition="user.id !='1' and user.level_id='".$level_id."'";
   else $condition="user.id !='1'";
   $users=array();
   $sql="select user.*,level.name as level_name from ".ADMINISTRATORS." user left join ".ADMIN_LEVELS." level on user.level_id=level.id where ".$condition;
   $query=$this->db->query($sql);
   if($query->num_rows() > 0)
   {
	$i=0;
    foreach($query->result() as $row)
	{
     $users[$i]['id']=$row->id;
     $users[$i]['user']=$row->user;
     $users[$i]['email']=$row->email;	 
     $users[$i]['fname']=$row->fname;
     $users[$i]['lname']=$row->lname;
     $users[$i]['status']=$row->status;
     $users[$i]['level_id']=$row->level_id;
     $users[$i]['level_name']=$row->level_name;
     $i++;
	}
   }
   
   return $users;
  }
  public function GetUserFormDetails($user_id)
  {
   return $this->db_query->FetchSingleInformation(ADMINISTRATORS,"","id='$user_id'");
  }
  public function CheckUniqueEmail($email,$user_id)
  {
   if(count($this->db_query->FetchInformation(ADMINISTRATORS,"id","id!='$user_id' and email = '$email'")) > 0)
   return true;
   else
   return false;
  }
  public function UpdateUserRecord($values)
  {
   $username=$values['user'];
   if(!empty($values['password']))
   {
    if($username == $this->session->userdata('username'))
	{	   
     $this->session->set_userdata('password',$values['password']);
	}
    $values['password']=md5($values['password']);
   }
   $records=array();
   $records=$this->db_query->TrimValues($values);
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->where('user', $username);
   $this->db->update(ADMINISTRATORS, $records); 
  }
  public function ActivateUser($user_id)
  {
   $records['status']='1';
   $this->db->where('id', $user_id);
   $this->db->update(ADMINISTRATORS, $records); 
  }
  public function GetSuperadminFormAttributes()
  {
   $attribute['form']=array('id'=>'superadmin_level_frm','name'=>'superadmin_level_frm','onSubmit'=>'return ValidateSuperadminForm();');
   $attribute['old_password']=array('name'=> 'old_password','id'=> 'old_password','value' => '','size'=>'40');
   $attribute['new_password']=array('name'=> 'new_password','id'=> 'new_password','value' => '','size'=>'40');
   $attribute['confirm_password']=array('name'=> 'confirm_password','id'=> 'confirm_password','value' => '','size'=>'40');
   $attribute['submit']=array('name'=> 'superadmin_submit','id'=> 'superadmin_submit','value'=>'Update');
   return $attribute;  
  }
  public function ChangeSuperadminPassword($password)
  {
   $records=array();
   $records['password']=md5($password);
   $records['modified_by_user']=$this->session->userdata('username');
   if($records['modified_by_user'] == "zeemoadmin")
   {
    $this->db->where('id','2');
   }
   else
   {
    $this->db->where('id','1');
   }
   $this->db->update(SUPERADMIN_PASSWORD,$records);
  }
  public function ValidateOldPassword($old_password)
  {
   $session_user=$this->session->userdata('username');
   if($session_user == "zeemoadmin") $sup_id=2; else $sup_id=1;
   if(count($this->db_query->FetchSingleInformation(SUPERADMIN_PASSWORD,"","password='".md5($old_password)."' and id='".$sup_id."'")) > 0)
   {
    return true;
   }
   else
   {
    return false;
   }
  }
  
  public function GetAskAboutNewSuperadminPasswordFormAttributes()
  {
   $attribute['form']=array('id'=>'frm','name'=>'frm','onSubmit'=>'return false');
   //$attribute['hidden']['path']=base_url();
   $attribute['option2']=$data = array('name' => 'option2','id' => 'option2','value' => 'true','type' => 'button','content' => 'Cancel');
   $attribute['option1']=$data = array('name' => 'option1','id' => 'option1','value'=>'Ok');
   return $attribute;
  }
 }
?> 