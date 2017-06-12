<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Login_model extends CI_Model
 {
  public $global_access_table_list;	 
  public $local_access_table_list;	 
    function __construct()
    {
     parent ::__construct();	
     $this->global_access_table_list=array();
     $this->local_access_table_list=array();
    }  
     public function FormCaptions()
     {
      $captions['username']="Username";
      $captions['password']="Password";
	  $captions['remember']="Remember username and password";
	  return $captions;
     } 
     public function FieldAttributes($values=array())
     {
	  if(count($values) == 0)
	  {
	   if(get_cookie('username') and get_cookie('password') and get_cookie('remember'))
	   {
	    $values['username']=$this->input->cookie('username');
		$values['password']=$this->input->cookie('password');
		//$values['remember']=$this->input->cookie('remember');
		$checked=true;
	   }
	   else
	   {
	    $values=array('username'=>"",'password'=>'');  
		$checked=false;
	   }
	  }
	  else
	  {
       $checked=false;
	  }
	  $attribute['form']=array('onSubmit'=>'return ValidateLoginForm();');
	  $attribute['username']=array('name'=> 'username','id'=> 'username','value' => $values['username'],'maxlength'=> '300','size'=>'30');
	  $attribute['password']=array('name'=> 'password','id'=> 'password','value' => $values['password'],'maxlength'=> '300','size'=>'30');
	  $attribute['remember']=array('name'=>'remember',"value"=>true,'id'=>'remember','checked'=>$checked);
	  return $attribute;
	 }
	 public function CheckUser($username,$password)
	 {
	  $user_info=$this->db_query->FetchSingleInformation(ADMINISTRATORS,"","binary user='$username' and binary password='".md5($password)."' and status='1'");
	  if($username != "admin" and count($user_info) > 0)
	  {
	   $level_id=$user_info['level_id'];
	   $level_info=$this->db_query->FetchSingleInformation(ADMIN_LEVELS,"status","id='$level_id'");
	   if($level_info['status'] == 0)
	   {
	    $user_info=array();
	   }
	  }
	  return $user_info;
	 } 
	 public function ModuleListToAccess()
	 {
	  $all_modules=array();
	  $level_id=$this->session->userdata('level_id');
	  
	  
	  $sql="select * from ".ADMIN_MODULES." where status='1' and parent_id='0' order by position";
	  $query = $this->db->query($sql);
	  
	  $i=0;
	  foreach($query->result() as $row)
      {
	   $sub_sql="select * from ".ADMIN_MODULES." where status='1' and parent_id='".$row->id."' order by position";
	   $sub_query=$this->db->query($sub_sql);
       if($sub_query->num_rows() > 0)
	   {
	    $all_modules[$i]['id']=$row->id;
        $all_modules[$i]['module_name']=stripslashes($row->module_name);
	    $all_modules[$i]['module_url']=$row->url;
        $all_modules[$i]['home_page_icon']=$row->home_page_icon;
        $all_modules[$i]['header_icon']=$row->header_icon;
        $all_modules[$i]['left_menu_icon']=$row->left_menu_icon;
	    $j=0;
	    foreach($sub_query->result() as $sub_row)
	    {
	 	 $all_modules[$i]['sub_module'][$j]['name']=stripslashes($sub_row->module_name);  
		 $all_modules[$i]['sub_module'][$j]['url']=$sub_row->url;  
		 $all_modules[$i]['sub_module'][$j]['id']=$sub_row->id;  
		 if($j == 0)
		 {
		  $first_sub_module_url=$sub_row->url;
		 }
		 $j++;
	    }
	    if(isset($first_sub_module_url))
	    {
         $all_modules[$i]['url']=$first_sub_module_url;
	    }
	    else
	    {
         $all_modules[$i]['url']=$row->url;
	    }
	    $i++;
	   }
	  }
	  
	  
	  if($level_id != 1)
	  {
	   $modules=array();
	   $sql="select module_id from ".LEVEL_TO_MODULES." where level_id='$level_id'";
	   $query=$this->db->query($sql);
	   $module_ids=array();
	   foreach($query->result() as $row)
	   {
	    $module_ids[]=$row->module_id;
	   }
	   if(count($module_ids) > 0 and count($all_modules) > 0)
	   {
		$i=0;
	    foreach($all_modules as $module)
		{
	     if(in_array($module['id'],$module_ids))
		 {
          $modules[$i]['id']=$module['id'];
       	  $modules[$i]['module_name']=$module['module_name'];
	      $modules[$i]['module_url']=$module['module_url'];
          $modules[$i]['home_page_icon']=$module['home_page_icon'];
          $modules[$i]['header_icon']=$module['header_icon'];
          $modules[$i]['left_menu_icon']=$module['left_menu_icon'];
		  if(isset($module['sub_module']) and count($module['sub_module']) > 0)
		  {
		   $j=0;
		   foreach($module['sub_module'] as $sub_module)
		   {
			if(in_array($sub_module['id'],$module_ids))
		    {
			 $modules[$i]['sub_module'][$j]['name']=$sub_module['name'];  
		     $modules[$i]['sub_module'][$j]['url']=$sub_module['url'];   
			 if($j == 0)
			 {
			  $modules[$i]['url']=$sub_module['url'];
			 }  
		     $j++;
			}
		   }
		  }
		  $i++;
		 }
		}
	   }
	   return $modules;
	  }
	  else
	  {
	   return $all_modules;
	  }
	 }
	 public function GetModuleId($module_name)
	 {
	  $sql="select id from ".ADMIN_MODULES." where url='$module_name'";
	  $query = $this->db->query($sql);
	  $row=$query->row_array();
	  return $row['id'];
	 }
	 public function CheckModuleAccessibilty($module_id)
	 {
	  $sql="select id from ".ADMIN_MODULES." where status='1' and id='$module_id'";
	  $query = $this->db->query($sql);
	  if($query->num_rows() > 0)
	  {
	   $level_id=$this->session->userdata('level_id');
	   $sql="select id from ".LEVEL_TO_MODULES." where module_id='$module_id' and level_id='$level_id'";
	   $query = $this->db->query($sql);
	   if($query->num_rows() > 0)
	   {
	    return true;
	   }
	   else
	   {
	    return false;
	   }
	  }
	  else
	  {
	   return false;
	  }
	 }
	 public function GetSubmoduleUrls($module_id)
	 {
	  $urls=array();
	  $sql="select url from ".ADMIN_MODULES." where parent_id='$module_id'";
	  //$res=mysql_query($sql);
	  $query = $this->db->query($sql);
	  if($query->num_rows() > 0)
	  {
	   foreach($query->result() as $row)
	   {
	    $urls[]=$row->url;
	   }
	  }
	  return $urls;
	 }
	 public function GetSubmoduleList($module_id)
	 {
	  $level_id=$this->session->userdata('level_id');
      $sub_modules=array();
      $sub_modules=$this->db_query->FetchInformation(ADMIN_MODULES,"module_name~url~id","parent_id='$module_id' and status='1' order by position");
	  if($level_id != 1)
	  {
	   $sub_module_access=array();
	   if(count($sub_modules) > 0)
	   {
		$i=0;
	    foreach($sub_modules as $module)
	    {
	     if($this->Login_model->CheckModuleAccessibilty($module['id']))
	 	 {
		  $sub_module_access[$i]['module_name']=$module['module_name'];
		  $sub_module_access[$i]['url']=$module['url'];
		  $i++;
		 }
	    }
	   }
	   return $sub_module_access;
	  }
	  else
	  {
	   return $sub_modules;
	  }
	 }
	 public function GetModuleDetails($module_url='')
	 {
	  if(!empty($module_url)) $module=$module_url;
	  else $module=$this->uri->segment(2);
	  $module_details=array();
	  $module_details=$this->db_query->FetchSingleInformation(ADMIN_MODULES,"","url='$module' and status='1' order by position");
	  return $module_details;
	 }
     public function UpdatePosition($table_name,$id_list,$parent_id,$parent_field_name='')
     {
      if(count($id_list) > 0)
      {
	   $position=1;
       foreach($id_list as $id)
	   {
        $where['id']=$id;
	    if($parent_id != 0)
	    {
	     $where[$parent_field_name]=$parent_id;
	    } 
	    $record['position']=$position;
	    $this->db_query->UpdateTable($table_name,$record,$where);
	    $position++;
	  }
     }
    }
	public function ChangeStatus($table_name,$record_id,$status,$no_user='')
	{
     $this->db->where('id', $record_id);
	 $records['status'] = $status;
	 if($no_user == '')
	 {
      $records['modified_by_user'] = $this->session->userdata('username');
	 }
	 $this->db->update($table_name, $records); 
	}
	
    public function GetAtributesForDeletion($values, $item_name, $single_delete_permission, $parent_id='')
    {
     $attribute=array();
     
	 $attribute['form']=array('id'=>'frm','name'=>'frm','onSubmit'=>'return false');
     
	 if(count($values) > 0)
     {
	  $v = 0;
	  foreach($values as $value)
	  {
	   $check_box = true;	  
	   if(isset($value['main_image']) && $value['main_image']=='1') $check_box=false;
	   if($check_box==true)
	   {
  	    $v++;
	    $attribute['data'.$v] = array('name'=> 'checked_ids[]','id'=> 'data'.$v,'value'=>$value['id'],'onClick'=>"AdjustDeleteButton()");	 
	   }
	  } 
     
	  $attribute['remove_all'] = array('id'=>'remove_all', 'name'=>'remove_all', 'onClick'=>"CheckUncheckAll('remove_all','total_data','data'); AdjustDeleteButton();");
     
	  $attribute['delete_all'] = array('id'=>'delete_all','name'=>'delete_all','onclick'=>"ConfirmDelete('".$item_name."','".$single_delete_permission."','".$parent_id."')",'value'=>'Delete All','title'=>"Delete All");
     
	  $attribute['delete'] = array('id'=>'delete','name'=>'delete','onclick'=>"ConfirmDelete('".$item_name."','".$single_delete_permission."','".$parent_id."')", 'value'=>'Delete','title'=>'Delete');
     
	  $attribute['total_data'] = count($values);
	  
	  $attribute['deletion_path'] = base_url().admin."/".$this->uri->segment(2)."/";
     }
     return $attribute;
    }
	
	public function GetDeletionPopUpAttributes($checked_ids, $item_name, $parent_id = '')
	{
     $attribute['form'] = array('id'=>'frm','name'=>'frm','onSubmit'=>'return false');
     $attribute['superadmin'] = array('name'=> 'superadmin','id'=> 'superadmin','value' => '','size'=>'35');
     $attribute['hidden']['path'] = base_url();
     $attribute['hidden']['checked_ids'] = $checked_ids;
     $attribute['hidden']['location'] = $this->uri->segment(2)."/"; 
     $attribute['hidden']['item_name'] = $item_name;
     $attribute['hidden']['parent_id'] = $parent_id;
     $attribute['option2'] = $data = array('name' => 'option2','id' => 'option2', 'value' => 'true','type' => 'button','content' => 'Cancel');
     $attribute['option1'] = $data = array('name' => 'option1','id' => 'option1', 'value' => 'Ok');
	 return $attribute;
	}
	
	public function CheckSuperadminPassword($password)
	{
     $session_user=$this->session->userdata('username');
     if($session_user == "zeemoadmin") $sup_id=2; else $sup_id=1;
	 $sql="select * from ".SUPERADMIN_PASSWORD." where password='".md5($password)."' and id='".$sup_id."'";
	 $query = $this->db->query($sql);
	 if($query->num_rows() > 0)
	 {
	  return true;	
	 }
	 else return false;
	}
	
	public function SetPositionAfterDeletion($table_name, $deleting_position, $other_condition='')
	{
	 $condition="position > $deleting_position";
	 if(!empty($other_condition))
	 {
	  $condition .=" and ".$other_condition;
	 }
	 echo $sql="update ".$table_name." set position=position-1 where $condition";
	 $this->db->query($sql);
	}
    public function GetAdminDetails($username='')
    {
     if(empty($username)) $username='admin';
     return $this->db_query->FetchSingleInformation(ADMINISTRATORS,"","user='$username'");
    }
	public function VerifyUserForActivation($user_id,$password)
	{
	 $status=array();
	 $values=array();
	 $values=$this->db_query->FetchSingleInformation(ADMINISTRATORS,"status","id='$user_id' and password='$password'");
     if(count($values) > 0)
	 {
	  if($values['status'] == 1)
	  {
	   $status="already active";
	  }
	  else
	  {
	   $status="activated";
	   $this->db->where('id',$user_id);
	   $record['status']='1';
       $this->db->update(ADMINISTRATORS, $record);	   
	  }
	 }
	 else
	 {
	  $status="not existed";
	 }
	 return $status;
	}
	public function GetTitleOfPage()
	{
	 $title=array();
	 $module_url=$this->uri->segment(2);
	 $submodule_url=$this->uri->segment(3);
	 $module=$this->db_query->FetchSingleInformation(ADMIN_MODULES,"module_name","url='$module_url'");
	 $title['module']=$module['module_name'];
	 $submodule=$this->db_query->FetchSingleInformation(ADMIN_MODULES,"module_name","url='".$module_url."/".$submodule_url."'");
	 if(isset($submodule['module_name']) and !empty($submodule['module_name']))
	 {
	  $title['submodule']=$submodule['module_name'];
	 }
	 else
	 {
	  $title['submodule']="";
	 }
	 return $title;
	}
    public function LastModify($table_name,$id='')
    {
	 if(empty($id)) $where="1='1'";
	 else $where="id='$id'";
     $sql="select DATE_FORMAT(date_modified,'%b %d %Y %h:%i %p') as last_modified, modified_by_user as username from ".$table_name." where $where";
     $query=$this->db->query($sql);
     foreach($query->result() as $row)
     {
      $last_modified['time']=$row->last_modified;
	  $last_modified['username']=$row->username;
     }
     return $last_modified;
    }
	public function GetCurrentPosition($table_name,$condition='')
	{
	 if(!empty($condition)) $where=$condition;
	 else $where="1='1'";
	 $sql="select position from ".$table_name." where ".$where." order by position desc limit 0,1";
	 $query=$this->db->query($sql);
     if($query->num_rows() == 0)
	 {
	  return 1;
	 }
	 else
	 {
	  foreach($query->result() as $row)
	  {
	   $position=$row->position;
	  }
	  return $position+1;
	 }
	}

/*	public function GenerateNewUrl($original_url)
	{
     $count = 0;
	 $url = $original_url;
	 $tables=$this->all_table_list;	
	 foreach($tables as $table)
	 {
	  for(;;)
	  {
	   if($count > 0) $url = $original_url.'-'.$count;	  
	   if($this->SearchUrl($table, 'url', $url)===FALSE) break;   
	   else $count++;
	  }
	 }
	 return $url;
	}
*/
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
	 $tables=$this->global_access_table_list;
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
	
	public function IsDuplicateUrl($same_table,$url_field,$url,$id_value='',$parent_field='',$parent_value='')
	{
	 if(in_array($same_table,$this->global_access_table_list))
	 {	
	  $tables=$this->global_access_table_list;	
	  foreach($tables as $table)
	  {
	   if($table != $same_table)
	   {	 
	    if($this->SearchUrl($table, $url_field, $url)==TRUE) return TRUE;   
	   }
	  }
	  //if(!empty($same_table) and !empty($id_value))
	  //{
	   if($this->IsDuplicateUrlInSameTable($same_table,$url_field,$url,$id_value,$parent_field,$parent_value)) return TRUE;
	  //}
	  return FALSE;
	 }
	 else
	 {
	  return $this->IsDuplicateUrlInSameTable($same_table,$url_field,$url,$id_value,$parent_field,$parent_value);
	 }
	}
	
    public function IsDuplicateUrlInSameTable($table,$url_field,$url,$id_value='',$parent_field='',$parent_value='')
    {
     $condition = "";
     if($parent_field != "") $condition .= " and ".$parent_field."='".$parent_value."'";
	 if($id_value!='') $condition .= " and id != '".$id_value."'";
     $sql = "select * from ".$table." where ".$url_field."='".$this->db->escape_str(trim($url))."'".$condition;
     $query=$this->db->query($sql);
     if($query->num_rows() > 0)
     return true;
     else return false;
    }

	public  function GenerateURL($table, $url_field, $url_value, $count=0, $parent_field='', $parent_value='')
    {
     echo "count: ".$count;		
     $new_url = $url_value;
     if($count > 0) $new_url = $url_value."-".$count;
  
     if($this->SearchUrl($table,$url_field,$new_url,$parent_field, $parent_value)==true) 
     {
      $count++;
      $new_url = $this->GenerateURL($table, $url_field, $url_value, $count, $parent_field, $parent_value);
     }
     else return $new_url;
     return $new_url;
    }
    public function SearchUrl($table, $url_field, $url_value, $parent_field='', $parent_value='')
    {
     $condition = "";	 
     if($parent_field != "") $condition = " and ".$parent_field." = '".$parent_value."'";
    
	 $sql = "select * from ".$table." where ".$url_field."='".$url_value."'".$condition;
     $res = $this->db->query($sql);
    
	 if($res->num_rows() > 0) return TRUE;
     else return FALSE;
    }
	
	public function IsKeyword($string)
	{
	 echo $sql = "select * from  static_page_urls where url='".$string."'";
	 $q_result = $this->db->query($sql);
	 if($q_result->num_rows() > 0) return TRUE;
	 else return FALSE;
	}

	public function CheckUniqueOnUpdate($table_name, $field, $field_value, $id)
	{
	 $sql="select * from ".$table_name." where $field='".$this->db->escape_str(trim($field_value))."' and id !='$id'";
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
	public function GetTopText($top_text_id)
	{
	 return $this->db_query->FetchSingleInformation(TOP_TEXT,'content',"id='$top_text_id'");
	}
	public function GetHelpTextForUpdation($id)
	{
	 return $this->db_query->FetchSingleInformation(ADMIN_MODULES,'help_text',"id='$id'");
	}
	public function GetHelpText($url)
	{
	 $help=$this->db_query->FetchSingleInformation(ADMIN_MODULES,'help_text',"url='$url'");
	 if(!empty($help['help_text'])) return $help['help_text'];
	 else "";
	}
	public function HelpTextExist($url)
	{
	 $help=$this->db_query->FetchSingleInformation(ADMIN_MODULES,'help_text',"url='$url'");
	 if(!empty($help['help_text'])) return true;
	 else false;
	}
	public function UpdateTopText($records,$id)
	{
     $records['modified_by_user']=$this->session->userdata('username'); 
	 $this->db->where('id',$id);
	 $this->db->update(TOP_TEXT,$records);
	}
	
    public function CheckUniqueWithCondition($table_name,$field,$field_value,$additional_condition)
	{
	 $sql="select * from ".$table_name." where $field='".$this->db->escape_str(trim($field_value))."' and ". $additional_condition;
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
	function GetModuleName($module_id)
	{
     $sql="select module_name from ".ADMIN_MODULES." where id='$module_id'";
	 $query=$this->db->query($sql);
     foreach($query->result() as $row)
	 {
	  $module_name=$row->module_name;
	 }
	 return $module_name;
	}
	function GetModuleNameByUrl($url)
	{
     $sql="select module_name from ".ADMIN_MODULES." where url='$url'";
	 $query=$this->db->query($sql);
     foreach($query->result() as $row)
	 {
	  $module_name=$row->module_name;
	 }
	 return $module_name;
	}	
	public function ForgotPasswordAttributes()
	{
     $attribute['form']=array('onSubmit'=>'return ValidateForgotPasswordForm();');
     $attribute['email']=array('name'=> 'email','id'=> 'email','value'=>'');      
     //$attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
     return $attribute;
	}
	public function CheckEmailId($email)
	{
	 $sql="select id from ".ADMINISTRATORS." where email='$email'";
	 $query=$this->db->query($sql);
	 if($query->num_rows() > 0)
	 {
	  return true;
	 }
	 else
	 {
	  return false;
	 }
	}
	public function GetAdminDetailsByEmail($email)
	{
	 return $this->db_query->FetchSingleInformation(ADMINISTRATORS,"","email='$email'");
	}	
	public function UpdatePasswordRecovery($email,$time)
	{
     $records['password_recovery']=$time;
	 $this->db->where('email',$email);
	 $this->db->update(ADMINISTRATORS,$records);
	 return true;
	}
	public function PasswordRecoveryAttributes() 
	{
     $attribute['form']=array('id'=>'add_user_frm','name'=>'add_user_frm','onSubmit'=>'return ValidatePasswordRecoveryForm();');    
	 $attribute['password']=array('name'=> 'password','id'=> 'password','value' => '','size'=>'40');
     $attribute['confirm_password']=array('name'=> 'confirm_password','id'=> 'confirm_password','value' => '','size'=>'40');
	 return $attribute;
	}
	public function ConfirmPasswordRecoveryCode($password_recovery)
	{
	 $sql="select * from ".ADMINISTRATORS." where password_recovery='$password_recovery'";
	 $query=$this->db->query($sql);
	 if($query->num_rows() > 0)
	 {
	  return true;
	 }
	 else
	 {
	  return false;
	 }
	}
	public function SetUpdatePassword($records,$password_recovery)
	{
	 $this->db->where('password_recovery',$password_recovery);
	 $this->db->update(ADMINISTRATORS,$records);
	}
    public function GetImageFormAttribute($values, $submit_value, $parent_drop_down_values, $title_char_count = '')
    {
	 if(empty($title_char_count)) $title_char_count=45;	
	 
     $attribute['form'] = array('onSubmit'=>'return ValidateImageForm();','id'=>'upload');
     $attribute['image_title']=array('name'=> 'image_title','id'=> 'image_title','value'=>$values['image_title'],'size'=>'34',"onKeyUp"=>"return CountCharacters('image_title','limit1',".$title_char_count.")");   
     $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['image_title']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');
     $attribute['image_file']=array('name'=> 'image_file','id'=> 'image_file','value'=>'');
     if(isset($values['current_image']) and !empty($values['current_image']))
     {
      $attribute['current_image']=$values['current_image'];
     }
     if(isset($values['edit_id']) and !empty($values['edit_id']))
     {
      $attribute['edit_id']=$values['edit_id'];
     }
     else
     {
      $attribute['edit_id']="";
     }
	 
	 
   	 $attribute['image_alt_title_text']=array('name'=> 'image_alt_title_text','id'=> 'image_alt_title_text','value'=>$values['image_alt_title_text'],'size'=>'35');   
	 
	 
	 
	 if(isset($values['description']))
	 {
      $attribute['description']=array('name'=> 'description','id'=> 'description','value'=>$values['description'],'rows'=> '5','cols'=> '55',"onKeyUp"=>"return CountCharacters('description','limit2','200')");
   	  $attribute['limit2']=array('name'=> 'limit2','id'=> 'limit2','value' => strlen($values['description']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');
	 }
	 $drop_down_list=array();
     if(count($parent_drop_down_values) > 0)
     {
      foreach($parent_drop_down_values as $key=>$parent_title)
      {
       $drop_down_list[$key]=$parent_title;
      }
     }
     $attribute['parents'] = $drop_down_list;
     $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => $submit_value);
     return $attribute;
    }

    public function GetImageUploaderFormAttribute($parent_drop_down_values)
    {
     $attribute['form'] = array('onSubmit'=>'return ValidateImageForm();','id'=>'upload');
	 $drop_down_list=array();
     if(count($parent_drop_down_values) > 0)
     {
      foreach($parent_drop_down_values as $key=>$parent_title)
      {
       $drop_down_list[$key]=$parent_title;
      }
     }
     $attribute['parents'] = $drop_down_list;
     return $attribute;
    }
    public function GetBrochureUploaderFormAttribute($parent_drop_down_values)
    {
     $attribute['form']=array('onSubmit'=>'return ValidateBrochureForm();','id'=>'upload');
 	 $drop_down_list=array();
     if(count($parent_drop_down_values) > 0)
     {
      foreach($parent_drop_down_values as $key=>$parent_title)
      {
       $drop_down_list[$key]=$parent_title;
      }
     }
     $attribute['parents']=$drop_down_list;
     return $attribute;
    }
	
    public function GetBrochureFormAttribute($values,$submit_value,$parent_drop_down_values,$title_char_count='')
    {
	 if(empty($title_char_count)) $title_char_count=45;	
     $attribute['form']=array('onSubmit'=>'return ValidateBrochureForm();');
     $attribute['brochure_title']=array('name'=> 'brochure_title','id'=> 'brochure_title','value'=>$values['brochure_title'],'size'=>'34',"onKeyUp"=>"return CountCharacters('brochure_title','limit1',".$title_char_count.")");   

     $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['brochure_title']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');
     $attribute['brochure_file']=array('name'=> 'brochure_file','id'=> 'brochure_file','value'=>'');
     if(isset($values['current_brochure']) and !empty($values['current_brochure']))
     {
      $attribute['current_brochure']=$values['current_brochure'];
     }
     if(isset($values['edit_id']) and !empty($values['edit_id']))
     {
      $attribute['edit_id']=$values['edit_id'];
     }
     else
     {
      $attribute['edit_id']="";
     }
	 $drop_down_list=array();
     if(count($parent_drop_down_values) > 0)
     {
      foreach($parent_drop_down_values as $key=>$parent_title)
      {
       $drop_down_list[$key]=$parent_title;
      }
     }
     $attribute['parents']=$drop_down_list;
     $attribute['submit']=array('name' => 'submit_value','id' => 'submit_value','value' => $submit_value);
     return $attribute;
    }
    public function InsertImage($record,$table_name,$parent_field_name)
    {
     $records=$this->db_query->TrimValues($record);
     $sql="update ".$table_name." set position=position + 1 where $parent_field_name='".$records["$parent_field_name"]."'";
     $this->db->query($sql);
     $records['position']=1;
     $records['modified_by_user']=$this->session->userdata('username');
     $records['dateadded']=date("Y-m-d  h:i:s");
     $this->db->insert($table_name,$records);
	 return $this->db->insert_id();
    }
    public function InsertBrochure($record,$table_name,$parent_field_name)
    {
     $records=$this->db_query->TrimValues($record);
     $sql="update ".$table_name." set position=position + 1 where $parent_field_name='".$records["$parent_field_name"]."'";
     $this->db->query($sql);
     $records['position']=1;
     $records['modified_by_user']=$this->session->userdata('username');
     $records['dateadded']=date("Y-m-d  h:i:s");
     $this->db->insert($table_name,$records);
	 return $this->db->insert_id();
    }
    public function UpdateImage($record,$image_id,$table_name)
    {
     $records=$this->db_query->TrimValues($record);
     $records['modified_by_user']=$this->session->userdata('username');   
     $this->db->where('id',$image_id);
     $this->db->update($table_name,$records);
    }
    public function UpdateBrochure($record,$brochure_id,$table_name)
    {
     $records=$this->db_query->TrimValues($record);
     $records['modified_by_user']=$this->session->userdata('username');   
     $this->db->where('id',$brochure_id);
     $this->db->update($table_name,$records);
    }
    public function GetImageBrochureDetails($id,$table_name)
    {
     return $this->db_query->FetchSingleInformation($table_name,"","id='$id'");
    }
    public function DeleteImageBrochureRecord($delete_ids,$parent_field_name,$parent_id,$table_name,$field_name,$deletion_path)
    {
     foreach($delete_ids as $id)
     {
  	  $values=array();
      $values=$this->GetImageBrochureDetails($id,$table_name);
	  unlink($deletion_path.$values[$field_name]);
      $this->db->delete($table_name,array('id' => $id)); 
	  $this->UpdateImageBrochurePosition($values['position'],$id,$parent_field_name,$parent_id,$table_name);
     }
    }
    public function UpdateImageBrochurePosition($current_position,$id,$parent_field_name,$parent_id,$table_name)
    {
     $sql="update ".$table_name." set position=(position-1) where position > $current_position and $parent_field_name='$parent_id'";
     $this->db->query($sql);
    }
    public function GetImageList($table_name, $parent_field_name, $parent_id)
    {
     return $this->db_query->FetchInformation($table_name,"","$parent_field_name='$parent_id' order by position asc"); 
    }
    public function GetBrochureList($table_name,$parent_field_name,$parent_id)
    {
     return $this->db_query->FetchInformation($table_name,"","$parent_field_name='$parent_id' order by position asc"); 
    }
	public function DeleteMetaTags($page_type,$page_id)
	{
	 $this->db_query->DeleteRecord(META_TAGS,"page_type='$page_type' and page_id='$page_id'");
	}
    public function DeleteCtaRecords($page_type,$page_id)
	{
	 $this->db_query->DeleteRecord(CTA,"page_type='$page_type' and page_id='$page_id'");
	}
	public function DeleteBanner($page_type,$page_id)
	{
	 $banners=$this->db_query->FetchSingleInformation(BANNERS,"image_file~id","page_id='$page_id' and page_type='$page_type'");
	 if(count($banners) > 0)
	 {
	  unlink("./images/banners/".$banners['image_file']);
	  $this->db_query->DeleteRecord(BANNERS,"id='".$banners['id']."'");
	 }
	}
	public function GetImageQualityOptions()
	{
	 $options = array();
	 for($i=90; $i>=50; $i=$i-10) $options[$i] = $i; 	 
     $options[''] = "None";	 
	 return $options;
	}
	
   }
?>