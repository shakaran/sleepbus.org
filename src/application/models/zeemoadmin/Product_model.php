<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Product_model extends CI_Model
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
  public function GetCategoryFormAttribute($values,$parent_id,$cat_id='')
  {
   $attribute['form'] = array('onSubmit'=>'return ValidateCategoryForm();');
   $attribute['category_name'] = array('name'=>'category_name', 'id'=> 'category_name', 'value'=>$values['category_name'], 'size'=>'41',"onKeyUp"=>"return CountCharacters('category_name','limit1','40')");
   $attribute['limit1'] = array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['category_name']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');
   $attribute['description'] = array('name'=>'description', 'id'=> 'description', 'value'=>$values['description'], 'rows'=>'4', 'cols'=>'32', "onKeyUp"=>"return CountCharacters('description','limit2','55')");
   $attribute['limit2'] = array('name'=> 'limit2','id'=> 'limit2','value' => strlen($values['description']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');

   $attribute['image_alt_title_text']=array('name'=> 'image_alt_title_text','id'=> 'image_alt_title_text','value'=>$values['image_alt_title_text'],'size'=>'35');  
  
   $attribute['image_file']=array('name'=> 'image_file','id'=> 'image_file','value'=>'');
   if(!empty($cat_id))
   {
	$attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Update');
    if(isset($values['current_image']) && !empty($values['current_image']))
    {
     $attribute['current_image'] = $values['current_image'];
    }	
   }
   else $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Submit');

   return $attribute;
  } 
  public function ParentCategoryDropDownAttributes($cat_id)
  {
   if($cat_id > 0)
   {
    $sql="select id,category_name from ".CATEGORIES." where parent_id=(select parent_id from ".CATEGORIES." where id='$cat_id')";
   }
   else
   {
    $sql="select id,category_name from ".CATEGORIES." where parent_id='0'";
   }
   $res=$this->db->query($sql);
   //$res=mysql_query($sql);
   $categories=array();
   if($res->num_rows() > 0)
   {
    //while($row=mysql_fetch_object($res))
	foreach($res->result() as $row)
	{
	 $categories[$row->id]=$row->category_name;
	} 
   }	  
   return $categories;
  }
  public function CategoryNavigationAttributes($cat_id,$depth)
  {
   $categories=array();
   $categories=$this->ParentCategoryDropDownAttributes($cat_id);
   if($depth == 0)
   {
	$categories = array('0'=>'Select') + $categories;	   
    //$categories[0]="Select";
   }
   //ksort($categories);
   $attributes['categories']=$categories;

   $subcategories=array();
   if($cat_id > 0)
   {   
    $sql="select id,category_name,depth from ".CATEGORIES." where parent_id='$cat_id' order by position asc";
    $res=$this->db->query($sql);
    if($res->num_rows() > 0)
    {
     $subcategories[0]="Select";
	 foreach($res->result() as $row)
	 {
      $subcategories[$row->id]=$row->category_name;
	  $attributes['subcategory_depth']=$row->depth;
	 }
    }
   }
   $attributes['subcategories']=$subcategories;
   return $attributes;
  }
  
  public function GetCategoryNavigation($parent_id,$depth)
  {
   $categories=array();	  
   if($depth != 0)
   {
    for($i=$depth;$i>=1;$i--)
	{
	 $categories[$i-1]=$this->GetParentCategegoryInformation($parent_id);
	 $parent_id=$categories[$i-1]['parent_id'];
	}  
   }
   return $categories;
  }
  public function GetCategoryNavigationForProducts($parent_id,$depth)
  {
   $categories=array();	  
   if($depth != 0)
   {
    for($i=$depth;$i>=0;$i--)
	{
	 $categories[$i-1]=$this->GetParentCategegoryInformation($parent_id);
	 $parent_id=$categories[$i-1]['parent_id'];
	}  
   }
   return $categories;
  }
  public function GetParentCategegoryInformation($parent_id)
  {
   return $this->db_query->FetchSingleInformation(CATEGORIES,"id~parent_id~category_name~depth","id='$parent_id'");
  }
  public function GetProductFormAttribute($values,$product_id='')
  {
   $attribute['form'] = array('onSubmit'=>'return ValidateProductForm();');
   
   $attribute['product_name'] = array('name'=>'product_name', 'id'=> 'product_name', 'value'=>$values['product_name'], 'size'=>'35',
   "onKeyUp"=>"return CountCharacters('product_name','limit1','35')");   
   $attribute['limit1'] = array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['product_name']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');

   $attribute['intro_text'] = array('name'=>'intro_text', 'id'=> 'intro_text', 'value'=>$values['intro_text'], 'rows'=>'3', 'cols'=>'65', "onKeyUp"=>"return CountCharacters('intro_text','limit2','300')");      
   $attribute['limit2'] = array('name'=> 'limit2','id'=> 'limit2','value' => strlen($values['intro_text']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');

   $attribute['description'] = array('name'=>'description', 'id'=> 'description', 'value'=>$values['description'], 'rows'=>'5', 'cols'=>'365');      
 
   if(!empty($product_id))
   {
	$attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Update');
   }
   else $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Submit');

   return $attribute;
  }   
  
  public function GetProductImageFormAttribute($values, $submit_value, $parent_drop_down_values)
  {
   $attribute['form']=array('onSubmit'=>'return ValidateImageForm();');
   
   $attribute['image_title']=array('name'=> 'image_title','id'=> 'image_title','value'=>$values['image_title'],'size'=>'34',"onKeyUp"=>"return CountCharacters('image_title','limit1',40)");   
   
   $attribute['limit1'] = array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['image_title']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');
   
   $attribute['image_file'] = array('name'=> 'image_file','id'=> 'image_file','value'=>'');
   
   if(isset($values['current_image']) and !empty($values['current_image']))
   {
    $attribute['current_image'] = $values['current_image'];
   }
   
   if(isset($values['edit_id']) and !empty($values['edit_id']))
   {
    $attribute['edit_id'] = $values['edit_id'];
   }
   else
   {
    $attribute['edit_id'] = "";
   }
   
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
   $attribute['parent_id'] = $drop_down_list;
   $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => $submit_value);
   return $attribute;
  }  
  
  public function GetCategoryForDropDown()
  {
   $sql = "select id, category_name from ".CATEGORIES." order by position";
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
  
  public function InsertCategory($record)
  {
   $records = $this->db_query->TrimValues($record);
   $sql = "update ".CATEGORIES." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['modified_by_user'] = $this->session->userdata('username');
   $records['date_added'] = date('Y-m-d H:i:s');   
   $this->db->insert(CATEGORIES,$records);
   
   return $this->db->insert_id();
  }
  
  public function GetCategoryList($parent_id)
  {
   return $this->db_query->FetchInformation(CATEGORIES,"","parent_id='$parent_id' order by position asc"); 
  }
  public function GetCategoryListWithoutSubcateories($category_list)
  {
   $categories=array();	  
   if(count($category_list) > 0)
   {
    foreach($category_list as $category)
	{
	 $subcategory=array();
	 $subcategory=$this->db_query->FetchInformation(CATEGORIES,'id',"parent_id='".$category['id']."'");
	 if(count($subcategory) > 0) $categories[$category['id']] ="yes";
	 else $categories[$category['id']] ="no";
	 $products=array();
	 $products=$this->db_query->FetchInformation(CATEGORY_TO_PRODUCTS,'id',"cat_id='".$category['id']."'");
	 if(count($products) > 0) $categories["product_".$category['id']] ="yes";
	 else $categories["product_".$category['id']] ="no";
	 
	}
   }
   return $categories;
  }
  public function GetProductList($cat_id)
  { 
   $sql = "select p.product_name, p.id as id, cp.id as cpid, cp.cat_id, cp.status, cp.position from products p 
   left join category_to_products cp on p.id=cp.product_id where cp.cat_id=".$cat_id." order by cp.position asc";	  
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
	 if($this->IsClone($row->id)) $product_list[$i]['clone'] = 'true';
	 else $product_list[$i]['clone'] = 'false';
	 
	 $i++;
	}
   }
   return $product_list;
  }
  public function IsClone($id)  
  {
   $sql = "select * from category_to_products where product_id='$id'";
   $query = $this->db->query($sql);
   if($query->num_rows() > 1) return true;
   else return false;
  }
  
  public function DeleteProducts($all_ids, $parent_id)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $product_id)
	{
     $this->DeleteImagesBrochure(PRODUCT_IMAGES, 'product_id', $product_id, 'image_file', './images/product/');
	 $this->DeleteImagesBrochure(PRODUCT_BROCHURES, 'product_id', $product_id, 'brochure_file', './brochures/product/');
	 
	 
	 $position = $this->db_query->FetchSingleInformation(CATEGORY_TO_PRODUCTS, "position", "product_id='$product_id' and cat_id='$parent_id'");
	 $this->db_query->DeleteRecord(PRODUCTS, "id='$product_id'");
	 $this->db_query->DeleteRecord(PRODUCT_IMAGES,"product_id='$product_id'");	 
	 $this->db_query->DeleteRecord(PRODUCT_BROCHURES,"product_id='$product_id'");	 
	 //$this->db_query->DeleteRecord(CATEGORY_TO_PRODUCTS ,"product_id='$product_id' and cat_id='$parent_id'");	 
	 $this->db_query->DeleteRecord(CATEGORY_TO_PRODUCTS ,"product_id='$product_id'");	 
	 $this->Login_model->SetPositionAfterDeletion(CATEGORY_TO_PRODUCTS, $position['position'],"cat_id='$parent_id'");
	 $this->Login_model->DeleteBanner('products',$product_id);
	 $this->Login_model->DeleteMetaTags('PRODUCTS',$product_id);
	 $this->Login_model->DeleteCtaRecords('PRODUCTS',$product_id);
	}
   }
  }
  public function RemoveClone($all_ids,$cat_id)
  {
   foreach($all_ids as $cat_prod_id)
   {	  
    $position = $this->db_query->FetchSingleInformation(CATEGORY_TO_PRODUCTS, "position", "id='$cat_prod_id'");
    $this->db_query->DeleteRecord(CATEGORY_TO_PRODUCTS,"id='$cat_prod_id'");	 
    $this->Login_model->SetPositionAfterDeletion(CATEGORY_TO_PRODUCTS, $position['position'],"cat_id='$cat_id'");
   }
  }
  
  public function DeleteCategories($all_ids, $parent_id)
  {
   $max=$this->db_query->FetchSingleInformation(CATEGORIES,"max(depth) as depth","1='1'");
   if(count($all_ids) > 0)
   {
    $categories=array();
	foreach($all_ids as $cat_id)
	{   	  
	 $parent_ids=$cat_id;
	 $categories[]=$cat_id;
     for($i=1;$i<=$max['depth'];$i++)	  
     {
      $sql="select id from ".CATEGORIES." where parent_id in ($parent_ids)";
	  $res=$this->db->query($sql);
	  if($res->num_rows() > 0)
	  {
	   $temp=array();	  
	   foreach($res->result() as $row)
	   {
	    $categories[]=$row->id;
	    $temp[]=$row->id;
	   }
	   $parent_ids=implode(",",$temp);
	  }
	  else break;
     }
	}
	
	if(count($categories) > 0)
	{
	 foreach($categories as $category)
	 {
	  $products=array();
	  $products=$this->db_query->FetchInformation(CATEGORY_TO_PRODUCTS,'product_id as id',"cat_id='$category'");
	  if(count($products) > 0)
	  {
	   foreach($products as $product)
	   {	
	    $all_products=$this->db_query->FetchInformation(CATEGORY_TO_PRODUCTS,'product_id',"product_id='".$product['id']."'");
		if(count($all_products) == 1)
		{  
         $this->DeleteImagesBrochure(PRODUCT_IMAGES, 'product_id', $product['id'], 'image_file', './images/product/');
	     $this->DeleteImagesBrochure(PRODUCT_BROCHURES, 'product_id', $product['id'], 'brochure_file', './brochures/product/');
		 $this->db_query->DeleteRecord(PRODUCT_IMAGES, "product_id='".$product['id']."'");
		 $this->db_query->DeleteRecord(PRODUCT_BROCHURES, "product_id='".$product['id']."'");
		 $this->db_query->DeleteRecord(PRODUCTS, "id='".$product['id']."'");
		 // if product banner exists
	     $this->Login_model->DeleteBanner('products',$product['id']);

		 // if product metatag exists
	     $this->Login_model->DeleteMetaTags('PRODUCTS',$product['id']);
     	 $this->Login_model->DeleteCtaRecords('PRODUCTS',$product['id']);
		}
	   }
	  }
	  
	  $this->db_query->DeleteRecord(CATEGORY_TO_PRODUCTS ,"cat_id='$category'");	 
	  $cat_info = $this->db_query->FetchSingleInformation(CATEGORIES, "position~image_file", "id='$category'");
	  $cat_image = $cat_info['image_file'];
	  if(!empty($cat_image)) unlink("./images/category/".$cat_image);
	  $this->db_query->DeleteRecord(CATEGORIES, "id='$category'");
      $this->Login_model->SetPositionAfterDeletion(CATEGORIES, $cat_info['position']);	   		   
	  $this->Login_model->DeleteBanner('categories',$category);
	  $this->Login_model->DeleteMetaTags('CATEGORIES',$category);
   	  $this->Login_model->DeleteCtaRecords('CATEGORIES',$category);
	 }
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
  
  
  public function IsUniqueProduct($cat_id, $pname, $product_id = '')
  {
   $condition = '';	  
   if($product_id != '') $condition = "and p.id != ".$product_id;	  
   
   $query = "select product_name from ".PRODUCTS." p left join ".CATEGORY_TO_PRODUCTS." cp on p.id=cp.product_id 
   where cp.cat_id = ".$cat_id." and p.product_name='".$this->db->escape_str(trim($pname))."' ".$condition;	
   $result = $this->db->query($query);  
   if($result->num_rows() > 0) return FALSE;
   else return TRUE;
  }
  
  public function InsertProduct($record1, $record2)
  {
   $record1 = $this->db_query->TrimValues($record1);
   $record1['modified_by_user'] = $this->session->userdata('username');
   $record1['date_added'] = date('Y-m-d H:i:s');   
   $this->db->insert(PRODUCTS, $record1);
   
   $record2['product_id'] = $this->db->insert_id();   
   $record2['date_added'] = date('Y-m-d H:i:s');   
	  
   $sql = "update ".CATEGORY_TO_PRODUCTS." set position = position + 1 where cat_id=".$record2['cat_id'];
   $this->db->query($sql);
   $record2['position'] = 1;
   
   $sql2 = "INSERT INTO ".CATEGORY_TO_PRODUCTS." (`url`, `cat_id`, `product_id`, `date_added`, `position`, modified_by_user) VALUES 
   ('".$record2['url']."', '".$record2['cat_id']."', '".$record2['product_id']."', '".$record2['date_added']."', ".$record2['position'].",
   '".$record1['modified_by_user']."')";
   $this->db->query($sql2);
  }
  
  public function UpdateProduct($records, $product_id)
  {
   $records = $this->db_query->TrimValues($records);
   $records['modified_by_user'] = $this->session->userdata('username');   
   $this->db->where('id',$product_id);
   $this->db->update(PRODUCTS, $records);
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
   $sql = "select * from ".CATEGORIES." where id='$cat_id'";
   $query = $this->db->query($sql);
   foreach($query->result() as $row)
   {
    $values['category_name'] = $row->category_name;
    $values['description'] = $row->description;
	$values['current_image'] = $row->image_file;

	$values['image_alt_title_text'] = $row->image_alt_title_text;
	$values['image_quality'] = $row->image_quality;

	$values['depth'] = $row->depth;
	$values['parent_id'] = $row->parent_id;
   }
   return $values;   
  }
  public function UpdateCategory($record, $cat_id)
  {
   $check_position=$this->db_query->FetchSingleInformation(CATEGORIES,"parent_id as old_parent_id~position","id='$cat_id'");
   if($check_position['old_parent_id'] != $record['parent_id'])
   {
    // it means parent category has been changed
	$sql="update ".CATEGORIES." set position=(position - 1) where position > ".$check_position['position']." and parent_id='".$check_position['old_parent_id']."'";
	$this->db->query($sql);
	
	$sql="update ".CATEGORIES." set position=(position + 1) where parent_id='".$record['parent_id']."'";
	$this->db->query($sql);
	$record['position']=1;  
   }  
	  
   $records = $this->db_query->TrimValues($record);
   $records['modified_by_user'] = $this->session->userdata('username');   
   $this->db->where('id',$cat_id);
   $this->db->update(CATEGORIES,$records);
  }
  
  public function InsertProductImage($record, $table_name, $parent_field_name)
  {
   $records = $this->db_query->TrimValues($record);
   $sql = "update ".$table_name." set position=position + 1 where $parent_field_name='".$records["$parent_field_name"]."'";
   $this->db->query($sql);
   $records['position'] = 1;
   $records['modified_by_user'] = $this->session->userdata('username');
   $records['dateadded'] = date("Y-m-d  h:i:s");
   $records['main_image'] = '0';
   
   $sql = "select * from ".$table_name." where $parent_field_name='".$records["$parent_field_name"]."'";
   $query_result = $this->db->query($sql);
   if($query_result->num_rows()==0) $records['main_image'] = '1';

   $this->db->insert($table_name,$records); 
  }

  public function ChangeMainImage($product_id, $image_id)
  {
   $sql = "update ".PRODUCT_IMAGES." set main_image='0' where product_id='$product_id'";
   $this->db->query($sql);

   $sql2 = "update ".PRODUCT_IMAGES." set main_image='1' where id = $image_id";
   $this->db->query($sql2);
  }
 
  public function GetProductDetails($product_id)
  {
   $values=array();
   $sql = "select * from ".PRODUCTS." where id='".$product_id."'";
   $query = $this->db->query($sql);
   $row = $query->result_array();
   
   $values['product_name'] = $row[0]['product_name'];
   $values['intro_text'] = $row[0]['intro_text'];
   $values['description'] = $row[0]['description'];
 
   return $values;   
  }
 



  public function CopyMoveCloneProducts($scid, $dcid, $products, $action)
  {
   $duplicate_products = array();	  
   foreach($products as $product_id)
   {
    //source product details	  
    $sql_product = "select * from ".PRODUCTS." where id='".$product_id."'";
    $query = $this->db->query($sql_product);
    $product_row = $query->result_array();
    
	$pname = $product_row[0]['product_name'];
	$intro_text = $product_row[0]['intro_text'];
	$description = $product_row[0]['description'];
	$modified_by_user = $product_row[0]['modified_by_user'];		

    //source category product relationship details
    $sql_source_cat = "select * from ".CATEGORY_TO_PRODUCTS." where product_id='".$product_id."' and cat_id='".$scid."'";
    $res_source_cat = $this->db->query($sql_source_cat);
    $source_cat_row = $res_source_cat->row();
    $current_url = $source_cat_row->url;
 
    //generate new url in destination category
	 $new_url = $this->Login_model->GenerateNewUrl($current_url);	 
   
    //check selected product with same name exists in destination category
    $sql = "select id from ".PRODUCTS." where product_name='".$pname."'";
    $res = $this->db->query($sql);
    $product_found = false;
   
    if($res->num_rows() > 0)
    {
	 foreach($res->result() as $row)
	 {   
      $sql_duplicate = "select id from ".CATEGORY_TO_PRODUCTS." where product_id='".$row->id."' and cat_id='".$dcid."'";
      $res_duplicate = $this->db->query($sql_duplicate);
	  if($res_duplicate->num_rows() > 0)
	  {
	   $product_found = true;
	   break;
	  }
	 }
    }

    if($product_found == false)
    {
	 //get modified user
	 $modified_by = $this->session->userdata('username');	
		
	 //get max postion of products in destination subcategory
	 $sql_max_pos = "select max(position) as max_pos from ".CATEGORY_TO_PRODUCTS." where cat_id='".$dcid."'";
	 $res_max_pos = $this->db->query($sql_max_pos);
	 $row_max_pos = $res_max_pos->row();
	 $max_pos = $row_max_pos->max_pos;
	 $new_pos = $max_pos+1;
	   
     //get status of selected product in source category
	 $sql_cp = "select status from ".CATEGORY_TO_PRODUCTS." where cat_id='".$scid."' and product_id='".$product_id."'";
	 $cp_result = $this->db->query($sql_cp);
	 $cp_row = $cp_result->row();
	   
     if($action=='move')
	 {
  	  $sql_pos_update = "update ".CATEGORY_TO_PRODUCTS." set position=position-1, modified_by_user='$modified_by' 
	  where position > '".$source_cat_row->position."' and cat_id='".$scid."'";
	  $this->db->query($sql_pos_update);
	  
	 // $sql_mv = "update ".CATEGORY_TO_PRODUCTS." set cat_id='".$dcid."', position='".$new_pos."', url='$new_url', modified_by_user='$modified_by' where id=".$source_cat_row->id;
	 
	  $sql_mv = "update ".CATEGORY_TO_PRODUCTS." set cat_id='".$dcid."', position='".$new_pos."', modified_by_user='$modified_by' where id=".$source_cat_row->id;
	 
	  $this->db->query($sql_mv);
	 }
	 if($action=='copy')
	 {
	  $records=array();
	  $records['product_name']=$pname;
	  $records['intro_text']=$intro_text;
	  $records['description']=$description;
	  $records['date_added']=date("Y-m-d h:i:s");
	  $records['modified_by_user']=$modified_by;
	  $this->db->insert(PRODUCTS,$records); 
      $new_pid = $this->db->insert_id();

	  $sql = "insert into ".CATEGORY_TO_PRODUCTS." (cat_id, product_id, position, status, date_added, url, modified_by_user)  
	  values('$dcid', '$new_pid', $new_pos, '$cp_row->status', now(), '".$new_url."','$modified_by')";
	  $this->db->query($sql);

      //query for product images
      $sql_images = "select * from ".PRODUCT_IMAGES." where product_id='".$product_id."'";
	  $res_images = $this->db->query($sql_images);
	  if($res_images->num_rows() > 0)
	  {
	   $image_pos = 0;	 
	   foreach($res_images->result() as $image)
	   {
	    $prd_image = $image->image_file;
	    $img_part = explode(".",$prd_image);
	    $extension = end($img_part);
	    $image_name = basename($prd_image, ".".$extension)."-".rand(1000,9999);
	    $image_name = str_replace(" ","-",$this->commonfunctions->RemoveSpecialChars($image_name));
	    $new_product_image = $image_name.".".$extension;
	    copy("./images/product/".$image->image_file, "./images/product/".$new_product_image);
		  
	    //insert images  
	    $image_pos++;	  
	    $insert_image = "insert into ".PRODUCT_IMAGES." (product_id, image_title, image_file, position, status, dateadded, date_modified, 
		main_image, modified_by_user) values ('".$new_pid."', '".$image->image_title 	."', '".$new_product_image."', '".$image_pos."', 
		'".$image->status."', now(), now(), '".$image->main_image."','$modified_by')";	  
        $this->db->query($insert_image);
	   }
	  }

      //query for product brochures
      $sql_brochure = "select * from ".PRODUCT_BROCHURES." where product_id='".$product_id."'";
	  $res_brochure = $this->db->query($sql_brochure);
	  if($res_brochure->num_rows() > 0)
	  {
	   $brochure_pos = 0;	 
	   foreach($res_brochure->result() as $brochure)
	   {
	    $filename = $brochure->brochure_file;
	    $file_part = explode(".",$filename);
	    $extension = end($file_part);
	    $brochure_name = basename($filename, ".".$extension)."-".rand(1000,9999);
	    $brochure_name = str_replace(" ","-",$this->commonfunctions->RemoveSpecialChars($brochure_name));
	    $new_file_name = $brochure_name.".".$extension;
	    copy("./pdfs/product/".$brochure->brochure_file, "./pdfs/product/".$new_file_name);
		  
	    //insert brochures
	    $brochure_pos++;	  
	    $insert_brochure = "insert into ".PRODUCT_BROCHURES." (product_id, brochure_title, brochure_file, position, status, dateadded,
		date_modified, modified_by_user) values ('".$new_pid."', '".$brochure->brochure_title."', '".$new_file_name."', '".$brochure_pos."', 
		'".$brochure->status."', now(), now(), '$modified_by')";	  
        $this->db->query($insert_brochure);
	   }
	  }
  
	 }
	 if($action=='clone')
	 {
	  $sql = "insert into ".CATEGORY_TO_PRODUCTS." (cat_id, product_id, position, status, date_added, url, modified_by_user)  
	  values('$dcid', '$product_id', $new_pos, '$cp_row->status', now(),'$new_url','$modified_by')";
	  $this->db->query($sql);
	 }
    }
    else
    {
	 $duplicate_products[] = $product_id;  	   
    }
   }
   return $duplicate_products;
  }
  public function UpdateAfterDeletionImage($updating_id,$records,$table_name)
  {
   $records['modified_by_user']=$this->session->userdata('username');   
   $this->db->where('id',$updating_id);
   $this->db->update($table_name,$records);
  }

 } 
?> 
