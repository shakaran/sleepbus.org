<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Blog_model extends CI_Model
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
  
  public function GetCategoryFormAttribute($values,$cat_id='')
  {
   $attribute['form'] = array('onSubmit'=>'return ValidateCategoryForm();');
   
   $attribute['category_name'] = array('name'=>'category_name', 'id'=> 'category_name', 'value'=>$values['category_name'], 'size'=>'35',
   "onKeyUp"=>"return CountCharacters('category_name','limit1','35')");   
   $attribute['limit1'] = array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['category_name']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');


   if(!empty($cat_id))
   {
	$attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Update');
    
   }
   else $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Submit');

   return $attribute;
  } 
  public function GetBlogNotificationEmailId()
  {
   return $this->db_query->FetchInformation(BLOG_NOTIFICATIONS,"","1='1'"); 
  }  
  public function GetBloggerFormAttribute($values,$blogger_id='')
  {
   $attribute['form'] = array('onSubmit'=>'return ValidateBloggerForm();');
   
   $attribute['blogger_name'] = array('name'=>'blogger_name', 'id'=> 'blogger_name', 'value'=>$values['blogger_name'], 'size'=>'30',
   "onKeyUp"=>"return CountCharacters('blogger_name','limit1','25')");   
   $attribute['limit1'] = array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['blogger_name']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');


   if(!empty($blogger_id))
   {
	$attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Update');
    
   }
   else $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Submit');

   return $attribute;
  } 
  public function SetBlogOnHomePage($blog_id)
  {
  
   $records=array();	
   $records['display_on_home']='0';  
   $this->db->update(BLOGS,$records);
   $this->db->where('id',$blog_id);
   $records=array();
   $records['display_on_home']='1';
   $this->db->update(BLOGS,$records);
  }
  
  public function GetBlogFormAttribute($values, $category_list,$blogger_list, $blog_id='')
  {
   $attribute['form'] = array('onSubmit'=>'return ValidateBlogForm();');
   
   $attribute['blog_name'] = array('name'=>'blog_name', 'id'=> 'blog_name', 'value'=>$values['blog_name'], 'size'=>'65',
   "onKeyUp"=>"return CountCharacters('blog_name','limit1','100')");   
   $attribute['limit1'] = array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['blog_name']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');
   $attribute['date_display']=array('name'=> 'date_display','id'=> 'date_display','value'=>$values['date_display'],'size'=>'25','readonly'=>'readonly');      

   $attribute['intro_text'] = array('name'=>'intro_text', 'id'=> 'intro_text', 'value'=>$values['intro_text'], 'rows'=>'3', 'cols'=>'65', "onKeyUp"=>"return CountCharacters('intro_text','limit2','300')");      
   $attribute['limit2'] = array('name'=> 'limit2','id'=> 'limit2','value' => strlen($values['intro_text']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');

   $attribute['description'] = array('name'=>'description', 'id'=> 'description', 'value'=>$values['description'], 'rows'=>'4', 'cols'=>'85');      
   $attribute['banner_image_text'] = array('name'=>'banner_image_text', 'id'=> 'banner_image_text', 'value'=>$values['banner_image_text'], 'rows'=>'4', 'cols'=>'85');      

 
 
   $drop_down_list_cat = array();
   if(count($category_list) > 0)
   {
    $drop_down_list_cat[''] = "Select a category";
    foreach($category_list as $key => $cat_name)
    {
     $drop_down_list_cat[$key] = $cat_name;
    }
   }
   $attribute['cat_id'] = $drop_down_list_cat;
   $attribute['selected_item_category'] = $values['selected_cat_id'];
   
   $drop_down_list_blogger=array();
   if(count($blogger_list) > 0)
   {
    $drop_down_list_blogger[''] = "Select a blogger";
    foreach($blogger_list as $key => $blogger_name)
    {
     $drop_down_list_blogger[$key] = $blogger_name;
    }
   }
   $attribute['blogger_id'] = $drop_down_list_blogger;
   $attribute['selected_item_blogger'] = $values['selected_blogger_id'];
 
   if(!empty($blog_id))
   {
	$attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Update');
   }
   else $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Submit');

   return $attribute;
  }   
  
  
  
  public function GetCategoryForDropDown()
  {
   $sql = "select id, category_name from ".BLOGS_CATEGORIES." order by position";
   $query = $this->db->query($sql);
   $category_list = array();
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
	{
	 $category_list[$row->id]=$row->category_name;
	}
   }
   return $category_list;
  }
 public function GetBloggerForDropDown()
  {
   $sql = "select id, blogger_name from ".BLOGGER." order by position";
   $query = $this->db->query($sql);
   $blogger_list = array();
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
	{
	 $blogger_list[$row->id]=$row->blogger_name;
	}
   }
   return $blogger_list;
  }
  public function InsertCategory($record)
  {
   $records = $this->db_query->TrimValues($record);
   $sql = "update ".BLOGS_CATEGORIES." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['modified_by_user'] = $this->session->userdata('username');
   $records['date_added'] = date('Y-m-d H:i:s');   
   $this->db->insert(BLOGS_CATEGORIES,$records);
   $this->db->insert_id();
  }
  public function InsertBlogger($record)
  {
   $records = $this->db_query->TrimValues($record);
   $sql = "update ".BLOGGER." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['modified_by_user'] = $this->session->userdata('username');
   $records['date_added'] = date('Y-m-d H:i:s');   
   $this->db->insert(BLOGGER,$records);
   $this->db->insert_id();
  }
  public function GetCategoryList()
  {
   return $this->db_query->FetchInformation(BLOGS_CATEGORIES,"","1='1' order by position asc"); 
  }
  public function DisplayBlogOnHome()
  {
  $cat_id= $this->db_query->FetchSingleInformation(BLOGS,"cat_id~blogger_id","display_on_home='1'") ;
  return $cat_id;
   
  }
  public function GetBloggerList()
  {
   return $this->db_query->FetchInformation(BLOGGER,"","1='1' order by position asc"); 
  }
  
  public function GetBlogList()
  { 
   $sql = "select blogs.*,blogs_categories.category_name as category,blogs_categories.status as cat_status,blogger.status as blogger_status, blogger.blogger_name as blogger from blogs inner join blogs_categories on blogs_categories.id=blogs.cat_id inner join blogger on blogger.id=blogs.blogger_id  order by blogs.position asc";	  
   $query = $this->db->query($sql);
   
   $product_list = array();
   if($query->num_rows() > 0)
   {
	$i=0;   
    foreach($query->result() as $row)
	{
	 foreach($row as $key => $value)
	 {
      $product_list[$i][$key] = $value;
	 }
	 $i++;
	}
   }
   return $product_list;
  }
  
  public function DeleteCategories($all_ids, $parent_id)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $cat_id)
	{
     $blog_info=array();		
	 $blog_info = $this->db_query->FetchInformation(BLOGS, "id", "cat_id='$cat_id'");
	 if(count($blog_info) > 0)
	 {
	  foreach($blog_info as  $blog)
	  {
       $this->Login_model->DeleteMetaTags('BLOGS',$blog['id']);
       $this->Login_model->DeleteCtaRecords('BLOGS',$blog['id']);
	  }
	 }
	 $this->db_query->DeleteRecord(BLOGS,"cat_id='$cat_id'");
 	 $this->Login_model->DeleteMetaTags('BLOGS_CATEGORIES',$cat_id);
     $this->Login_model->DeleteCtaRecords('BLOGS_CATEGORIES',$cat_id);
	 $cat_info = $this->db_query->FetchSingleInformation(BLOGS_CATEGORIES, "position", "id='$cat_id'");
     $this->Login_model->SetPositionAfterDeletion(BLOGS_CATEGORIES, $cat_info['position']);	   		   
     $this->db_query->DeleteRecord(BLOGS_CATEGORIES,"id='$cat_id'");
	}
   }
  }  
  public function DeleteBlogger($all_ids, $parent_id)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $blogger_id)
	{
     $blog_info=array();		
	 $blog_info = $this->db_query->FetchInformation(BLOGS, "id", "blogger_id='$blogger_id'");
	 if(count($blog_info) > 0)
	 {
	  foreach($blog_info as  $blog)
	  {
       $this->Login_model->DeleteMetaTags('BLOGS',$blog['id']);
       $this->Login_model->DeleteCtaRecords('BLOGS',$blog['id']);
	  }
	 }
		
	 $this->db_query->DeleteRecord(BLOGS,"blogger_id='$blogger_id'");
 	 $blogger_info = $this->db_query->FetchSingleInformation(BLOGGER, "position", "id='$blogger_id'");
     $this->Login_model->SetPositionAfterDeletion(BLOGGER, $blogger_info['position']);	   		   
     $this->db_query->DeleteRecord(BLOGGER,"id='$blogger_id'");
	}
   }
  }
  public function DeleteBlogs($all_ids)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $blog_id)
	{
	 $this->Login_model->DeleteMetaTags('BLOGS',$blog_id);
   	 $this->Login_model->DeleteCtaRecords('BLOGS',$blog_id);
	 $blog_info = $this->db_query->FetchSingleInformation(BLOGS, "position","id='$blog_id'");
	 $this->Login_model->SetPositionAfterDeletion(BLOGS, $blog_info['position']);	
	 $this->db_query->DeleteRecord(BLOGS, "id='$blog_id'");
	 
	 /*$blog_home=array();$blog_home=$this->db_query->FetchInformation(BLOGS,"display_on_home","id='$blog_id' and display_on_home='1'");
	 if(count($blog_home) == 0)
	 {
	  $this->db->where('position','1');
	 // $change_records['display_on_home']='1';
	  $this->db->update(BLOGS,$change_records);
	 }*/
	}
   }
   
  }
  
 
  public function GetBlogDetails($blog_id)
  {
   $values=array();
   $sql="select * from ".BLOGS." where id='$blog_id'";
   $query=$this->db->query($sql);
   foreach($query->result() as $row)
   {
    $values['blog_name']=$row->blog_name;
    $values['description']=$row->description;
    $values['banner_image_text']=$row->banner_image_text;
    $values['url']=$row->url;
    $values['intro_text']=$row->intro_text;
    $values['date_added']=$row->date_added;
    $values['date_display']=$row->date_display;
	$temp=explode(" ",$values['date_display']);
	$temp1=$temp[0];
	$date=explode("-",$temp1);
	$values['date_display']= $date[2]."-".$date[1]."-".$date[0];
   }
   return $values;   
  }
  public function InsertBlog($record1)
  {
	
   $record1 = $this->db_query->TrimValues($record1);
   $record1['modified_by_user'] = $this->session->userdata('username');
   $record1['date_added']=date("Y-m-d");
   $sql = "update ".BLOGS." set position=position + 1";
   $this->db->query($sql);
   $record1['position']=1;
   
   $date_selected=$record1['date_display'];
   $temp = explode("-",$date_selected);
   $date = $temp[2]."-".$temp[1]."-".$temp[0];
   $time = date("h:i:s");
   $record1['date_display'] = $date. " ".$time;
   
   
   $this->db->insert(BLOGS, $record1);
  }
  
  public function UpdateBlog($records, $blog_id)
  {
	
   $records = $this->db_query->TrimValues($records);
   $date_selected=$records['date_display'];
   $temp = explode("-",$date_selected);
   $date = $temp[2]."-".$temp[1]."-".$temp[0];
   $time = date("h:i:s");
   $records['date_display'] = $date. " ".$time;
   
   $records['modified_by_user']=$this->session->userdata('username'); 
   
   $this->db->where('id',$blog_id);
   $this->db->update(BLOGS, $records);
  }  
  
  public function GetProductDropDownAttributes($cat_id)
  {
   $attribute['form']=array('onSubmit'=>'return false;');
   if(count($this->GetProductListForDropDown($cat_id)) > 0)
   {
    foreach($this->GetProductListForDropDown($cat_id) as $key => $product_title)
    {
     $product_list[$key] = $product_title;
    }
   }
   $attribute['product_id'] = $product_list;
   return $attribute;
  } 
  
  public function GetProductListForDropDown($cat_id)
  {
   $sql = "select p.product_name, p.id as id from products p left join category_to_products cp on p.id=cp.product_id 
   where cp.cat_id=".$cat_id." order by cp.position asc";	  
   $query = $this->db->query($sql);
   $product_list = array();
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
	{
	 $product_list[$row->id] = $row->product_name;
	}
   }
   return $product_list;
  }
  
  public function GetCategoryDetails($cat_id)
  {
   $values=array();
   $sql = "select * from ".BLOGS_CATEGORIES." where id='$cat_id'";
   $query = $this->db->query($sql);
   foreach($query->result() as $row)
   {
    $values['category_name'] = $row->category_name;
   }
   return $values;   
  }
  public function GetBloggerDetails($blogger_id)
  {
   $values=array();
   $sql = "select * from ".BLOGGER." where id='$blogger_id'";
   $query = $this->db->query($sql);
   foreach($query->result() as $row)
   {
    $values['blogger_name'] = $row->blogger_name;
   }
   return $values;   
  }
  public function IsUniqueBlog($cat_id, $pname, $blog_id = '')
  {
   $condition = '';	  
   if($blog_id != '') $condition = "and id != ".$blog_id;	  
   
   $query = "select blog_name from ".BLOGS."  where cat_id = ".$cat_id." and  blog_name='".$this->db->escape_str(trim($pname))."' ".$condition;	
   $result = $this->db->query($query);  
   if($result->num_rows() > 0) return FALSE;
   else return TRUE;
  }
  public function UpdateCategory($record, $cat_id)
  {
   $records = $this->db_query->TrimValues($record);
   $records['modified_by_user'] = $this->session->userdata('username');   
   $this->db->where('id',$cat_id);
   $this->db->update(BLOGS_CATEGORIES,$records);
  }
  public function UpdateBlogger($record, $blogger_id)
  {
   $records = $this->db_query->TrimValues($record);
   $records['modified_by_user'] = $this->session->userdata('username');   
   $this->db->where('id',$blogger_id);
   $this->db->update(BLOGGER,$records)or die();
  }
  public function UpdateAfterDeletion($project_id,$records)
  {
   $records['modified_by_user']=$this->session->userdata('username');   
   $this->db->where('id',$project_id);
   $this->db->update(PROJECTS,$records);
  }

 } 
?>