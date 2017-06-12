<?php
 class Metatags_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  } 
  public function GetAllSinglePagesList()
  {
   $all_pages=array();
   $all_pages= $this->db_query->FetchInformation(META_SINGLE_PAGES,"","1='1' order by position");
   if(count($all_pages) > 0)
   {
	$j=0;
    foreach($all_pages as $page)
	{
     $page_list[$j]['id']=$page['id'];
     $page_list[$j]['page_name']=$page['page_name'];
     $page_list[$j]['meta']=$this->GetMetaTags('SINGLE_PAGE',$page['id'],$page['page_name']);
	 $j++;
	}
   }
   return $page_list;
  } 
  public function GetMetaTags($page_type,$page_id,$default_title='')
  {
   $temp_array=array();
   $meta=array();
   $page_id=urldecode($page_id);
   $temp_array=$this->db_query->FetchSingleInformation(META_TAGS,"","page_type='$page_type' and page_id='$page_id'");
   

   
   if($page_type == "CATEGORIES" or $page_type == "PRODUCTS")
   {
    $default_title=$this->GetMetaPageHeading($page_type,$page_id);
   }
   if(count($temp_array) > 0)
   {
    if(!empty($temp_array['page_title']))
	{
     $meta['page_title']=$temp_array['page_title'];
	}
 	else
	{
		
     $meta['page_title']=$default_title.DEFAULT_SUFFIX;
	}
    if(!empty($temp_array['meta_keyword']))
	{
     $meta['meta_keyword']=$temp_array['meta_keyword'];
	}
	else $meta['meta_keyword']="";
    if(!empty($temp_array['meta_description']))
	{
     $meta['meta_description']=$temp_array['meta_description'];
	}
	else $meta['meta_description']="";
    if(!empty($temp_array['json_code']))
	{
     $meta['json_code']=$temp_array['json_code'];
	}
	else $meta['json_code']="";
	$meta['meta_id']=$temp_array['id'];
   }
   else
   {
    $meta['page_title']=$default_title.DEFAULT_SUFFIX;
    $meta['meta_keyword']="";
    $meta['meta_description']="";
    $meta['json_code']="";
	$meta['meta_id']='';
   }
   return $meta;
  }
  public function GetServiceList()
  {
   $sql="select id,service_title from ".SERVICES." order by position";
   $query=$this->db->query($sql);
   $service_list=array();
   $j=0;
   $service_list[$j]['id']='0';
   $service_list[$j]['page_name']="Services";
   $service_list[$j]['meta']=$this->GetMetaTags('SERVICES',$service_list[$j]['id'],$service_list[$j]['page_name']);
   $j++;
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $page)
	{
     $service_list[$j]['id']=$page->id;
     $service_list[$j]['page_name']=$page->service_title;
     $service_list[$j]['meta']=$this->GetMetaTags('SERVICES',$page->id,$page->service_title);
	 $j++;
	}
   }
   return $service_list;
  }
  public function GetDefaultProductPage()
  {
   $product_list=array();
   $j=0;
   $product_list[$j]['id']='0';
   $product_list[$j]['page_name']="Products";
   $product_list[$j]['meta']=$this->GetMetaTags('PRODUCTS',$product_list[$j]['id'],$product_list[$j]['page_name']);
   return $product_list;
  }
  public function GetNewsList()
  {
   $sql="select id,news_title from ".NEWS." order by position";
   $query=$this->db->query($sql);
   $news_list=array();
   $j=0;
   $news_list[$j]['id']='0';
   $news_list[$j]['page_name']="News";
   $news_list[$j]['meta']=$this->GetMetaTags('NEWS',$news_list[$j]['id'],$news_list[$j]['page_name']);
   $j++;
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $page)
	{
     $news_list[$j]['id']=$page->id;
     $news_list[$j]['page_name']=$page->news_title;
     $news_list[$j]['meta']=$this->GetMetaTags('NEWS',$page->id,$page->news_title);
	 $j++;
	}
   }
   return $news_list;
  }
  public function GetProjectList()
  {
   $sql="select id,project_title from ".PROJECTS." order by position";
   $query=$this->db->query($sql);
   $news_list=array();
   $j=0;
   $news_list[$j]['id']='0';
   $news_list[$j]['page_name']="Project";
   $news_list[$j]['meta']=$this->GetMetaTags('PROJECTS',$news_list[$j]['id'],$news_list[$j]['page_name']);
   $j++;
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $page)
	{
     $news_list[$j]['id']=$page->id;
     $news_list[$j]['page_name']=$page->project_title;
     $news_list[$j]['meta']=$this->GetMetaTags('PROJECTS',$page->id,$page->project_title);
	 $j++;
	}
   }
   return $news_list;
  }
  
  public function GetAllAboutPages()
  {
   $sql="select id,item_title from ".ABOUT_SECTION." order by position";
   $query=$this->db->query($sql);
   $item_list=array();
   $j=0;
   $item_list[$j]['id']='0';
   $item_list[$j]['page_name']="About Section";
   $item_list[$j]['meta']=$this->GetMetaTags('ABOUT_SECTION',$item_list[$j]['id'],$item_list[$j]['page_name']);
   $j++;
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $page)
	{
     $item_list[$j]['id']=$page->id;
     $item_list[$j]['page_name']=$page->item_title;
     $item_list[$j]['meta']=$this->GetMetaTags('ABOUT_SECTION',$page->id,$page->item_title);
	 $j++;
	}
   }
   return $item_list;
  }    
  
  public function GetCategoriesList($parent_id)
  {
   $sql="select id,category_name,depth from ".CATEGORIES." where parent_id='$parent_id' order by position";
   $query=$this->db->query($sql);
   $category_list=array();
   $j=0;
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $page)
	{
     $category_list[$j]['id']=$page->id;
     $category_list[$j]['page_name']=$page->category_name;
     $category_list[$j]['depth']=$page->depth;	 
     $category_list[$j]['meta']=$this->GetMetaTags('CATEGORIES',$page->id,$page->category_name);
	 $j++;
	}
   }
   return $category_list;
  }
  
  public function SetMetaTags($record,$meta_id)
  {
   $records=$this->db_query->TrimValues($record);
   $records['modified_by_user']=$this->session->userdata('username');   
   if(!empty($meta_id))
   { 
    $this->db->where('id',$meta_id);
    $this->db->update(META_TAGS,$records);
    $message="Meta / title tags has been updated successfully";
   }
   else
   {
    $records['dateadded']=date("Y-m-d h:i:s");
	$this->db->insert(META_TAGS,$records);
    $message="Meta / title tags  has been added successfully";
   }
   return $message;
  }
  public function GetMetaTagsFormAttributes($values)
  {
   $attribute=array();
   $attribute['form']=array('onSubmit'=>'return ValidateMetatagsForm();');
   $attribute['page_title']=array('name'=> 'page_title','id'=> 'page_title','value'=>$values['page_title'],'rows'=> '3','cols'=> '85',"onKeyUp"=>"return CountCharacters('page_title','limit1','200')");  
   $attribute['limit1']=array('name'=> 'limit1','id'=> 'limit1','value' => strlen($values['page_title']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');

   $attribute['meta_keyword']=array('name'=> 'meta_keyword','id'=> 'meta_keyword','value'=>$values['meta_keyword'],'rows'=> '3','cols'=> '85',"onKeyUp"=>"return CountCharacters('meta_keyword','limit2','200')");
   $attribute['limit2']=array('name'=> 'limit2','id'=> 'limit2','value' => strlen($values['meta_keyword']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');

   $attribute['meta_description']=array('name'=> 'meta_description','id'=> 'meta_description','value'=>$values['meta_description'],'rows'=> '3','cols'=> '85',"onKeyUp"=>"return CountCharacters('meta_description','limit3','200')");
   $attribute['limit3']=array('name'=> 'limit3','id'=> 'limit3','value' => strlen($values['meta_description']),'readonly'=>'readonly','size'=>'2','tabindex'=>'-1');

   $attribute['json_code']=array('name'=> 'json_code','id'=> 'json_code','value'=>$values['json_code'],'rows'=> '3','cols'=> '85',"onKeyUp"=>"return CountCharacters('json_code','limit3','200')");


   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   
   
   return $attribute; 
  }
  public function GetMetaTagsUrlFormAttributes($values)
  {
   $attributes=array();
   $attributes=$this->GetMetaTagsFormAttributes($values);
   $attributes['form']=array('onSubmit'=>'return ValidateMetatagsUrlForm();');
   $attributes['url']=array('name'=> 'url','id'=> 'url','value'=>$values['url'],'size'=>'84');   
   return $attributes;
  }
  public function GetUrlValue($table_name,$id)
  {
   $values=array();
   $values=$this->db_query->FetchSingleInformation($table_name,"url","id='$id'");
   return $values['url'];
  }
  public function ProductSubmenu()
  {
   $submenu=array();
   $submenu[0]['name']="Product Main Page";
   $submenu[0]['url']="product-default-metas";
   $submenu[1]['name']="Category Pages";
   $submenu[1]['url']="category-metas";
   $submenu[2]['name']="Product Pages";
   $submenu[2]['url']="product-metas";
   return $submenu;
  }
  public function GetCategoryDropDownAttribute()
  {
   $attribute['form']=array('onSubmit'=>'return false;');
   $category_list['']="Select";
   if(count($this->GetCategoryListForDropDown()) > 0)
   {
    foreach($this->GetCategoryListForDropDown() as $key=>$category_name)
    {
     $category_list[$key]=$category_name;
    }
   }
   $attribute['category_id']=$category_list;
   return $attribute;
  } 
  public function GetCategoryListForDropDown()
  {
   $sql="select id,category_name from ".CATEGORIES." order by position";
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
  public function GetProductList($category_id)
  {
   $sql="select prod.*,cat2prod.id as relation_id from ".CATEGORY_TO_PRODUCTS." cat2prod inner join ".PRODUCTS." prod on cat2prod.product_id = prod.id where cat2prod.cat_id='$category_id' order by cat2prod.position";
   $query=$this->db->query($sql);
   $product_list=array();
   if($query->num_rows() > 0)
   {
	$j=0;   
    foreach($query->result() as $page)
	{
     $product_list[$j]['id']=$page->relation_id;
     $product_list[$j]['page_name']=$page->product_name;
     $product_list[$j]['meta']=$this->GetMetaTags('PRODUCTS',$page->relation_id,$page->product_name);
	 $j++;
	}
   }
   return $product_list;
  }
  public function GetCategoryDetails($category_id)
  {
   return $this->db_query->FetchSingleInformation(CATEGORIES,"category_name~depth","id='$category_id'");
  }
  public function GetCategoryId($relation_id)
  {
   $records=array();
   $records=$this->db_query->FetchSingleInformation(CATEGORY_TO_PRODUCTS,"cat_id","id='$relation_id'");
   return $records['cat_id'];
  }
  public function GetBlogEmailFormAttribute($values)
  {
   $attribute['form']=array('onSubmit'=>'return ValidateEmailForm();');
   $attribute['blog_to_emailid']=array('name'=> 'blog_to_emailid','id'=> 'blog_to_emailid','value'=>$values['blog_to_emailid'],'size'=> '50');
   $attribute['blog_cc_emailid']=array('name'=> 'blog_cc_emailid','id'=> 'blog_cc_emailid','value'=>$values['blog_cc_emailid'],'size'=> '50');
   $attribute['blog_bcc_emailid']=array('name'=> 'blog_bcc_emailid','id'=> 'blog_bcc_emailid','value'=>$values['blog_bcc_emailid'],'size'=> '50');
   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }
  public function UpdateBlogEmailSettings($record)
  {
   $record['modified_by_user']=$this->session->userdata('username');
   $records=$this->db_query->TrimValues($record);
   $this->db->update(BLOG_NOTIFICATIONS,$records);
  }
  public function BlogSubmenu()
  {
   $submenu=array();
   $submenu[0]['name']="Blog Main Page";
   $submenu[0]['url']="blog-default-metas";
   $submenu[1]['name']="Category Pages";
   $submenu[1]['url']="blog-category-metas";
   $submenu[2]['name']="Blog Archive";
   $submenu[2]['url']="blog-archive-metas";
   $submenu[3]['name']="Blog Pages";
   $submenu[3]['url']="blog-metas";
   $submenu[4]['name']="Blog Notifications";
   $submenu[4]['url']="blog-notifications";
   return $submenu;
  }

  public function GetBlogList()
  {
   $sql="select blogs.*, blogs_categories.category_name from blogs left join blogs_categories on blogs_categories.id=blogs.cat_id where blogs.status='1' and blogs_categories.status='1' order by blogs_categories.category_name asc";
   $query=$this->db->query($sql);
   $blog_list=array();
   if($query->num_rows() > 0)
   {
	$j=0;   
    foreach($query->result() as $page)
	{
     $blog_list[$j]['id']=$page->id;
     $blog_list[$j]['page_name']=$page->blog_name;
     $blog_list[$j]['meta']=$this->GetMetaTags('BLOGS',$page->id,$page->blog_name);
	 $j++;
	}
   }
   return $blog_list;
  }

  public function GetBlogCategoriesList()
  {
   $sql="select id,category_name from ".BLOGS_CATEGORIES." order by position";
   $query=$this->db->query($sql);
   $category_list=array();
   $j=0;
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $page)
	{
     $category_list[$j]['id']=$page->id;
     $category_list[$j]['page_name']=$page->category_name;
     $category_list[$j]['meta']=$this->GetMetaTags('BLOGS_CATEGORIES',$page->id,$page->category_name);
	 $j++;
	}
   }
   return $category_list;
  }
   public function GetBlogArchiveList()
 {
  $sqlblogs="SELECT distinct DATE_FORMAT(date_display,'%M %Y') as month,DATE_FORMAT(date_display,'%M') as mm,DATE_FORMAT(date_display,'%Y') as yy FROM `blogs`  where `status`=1 order by position";

  $query=$this->db->query($sqlblogs);
   $blog=array();
   if($query->num_rows()>0)
   {
	$i=0;
    foreach($query->result() as $row)
	{
     $blog[$i]['id']=$row->mm." ".$row->yy;
     $blog[$i]['page_name']=$row->mm." ".$row->yy;
     $blog[$i]['meta']=$this->GetMetaTags('BLOGS_ARCHIVE',$row->mm." ".$row->yy,$row->mm." ".$row->yy);

  
     $i++;
	}
   }
   return $blog; 
 
 }
  public function GetBlogEmailInformation()
  {
   $values=$this->db_query->FetchSingleInformation(BLOG_NOTIFICATIONS,"blog_to_emailid~blog_cc_emailid~blog_bcc_emailid","1='1'");
   return $values;   
  }  
  
  public function GetDefaultBlogPage()
  {
   $blog_list=array();
   $j=0;
   $blog_list[$j]['id']='0';
   $blog_list[$j]['page_name']="Blogs";
   $blog_list[$j]['meta']=$this->GetMetaTags('BLOGS',$blog_list[$j]['id'],$blog_list[$j]['page_name']);
   return $blog_list;
  }
  
  public function GetMetaPageHeading($page_type,$page_id)
  {
   $records=array();
   switch($page_type)
   {
    case "SERVICES":
	if($page_id == '0') $records['heading']="Services";
	else $records= $this->db_query->FetchSingleInformation(SERVICES,"service_title as heading","id='$page_id'");
	break; 
   
    case "NEWS":
	if($page_id == '0') $records['heading']="News";
    else $records= $this->db_query->FetchSingleInformation(NEWS,"news_title as heading","id='$page_id'");
	break; 
    case "PROJECTS":
	if($page_id == '0') $records['heading']="Project";
    else $records= $this->db_query->FetchSingleInformation(PROJECTS,"project_title as heading","id='$page_id'");
	break; 
  
    case "CATEGORIES":
	 $category_info= $this->db_query->FetchSingleInformation(CATEGORIES,"depth","id='$page_id'");
     $category_navigation=$this->GetCategoryNavigation($page_id,$category_info['depth']);
     $category_list=array();
	 foreach($category_navigation as $navigation)
	 {
	  $category_list[]=$navigation['category_name']; 
	 }
	 $records['heading']=implode(" - ",$category_list);
	break; 
   
    case "PRODUCTS":
	if($page_id == '0') $records['heading']="Product";
	else
	{ 
	 $sql="select prod.product_name,cat.category_name,cat.id as cat_id,cat.depth from ".CATEGORY_TO_PRODUCTS." cat2prod inner join ".PRODUCTS." prod on cat2prod.product_id = prod.id inner join ".CATEGORIES." cat on cat2prod.cat_id=cat.id where cat2prod.id='$page_id'";
     $query=$this->db->query($sql);
	 $product_info=array();
	 foreach($query->result() as $page)
	 {
	  $product_navigation[]=$page->product_name;
	  $cat_id=$page->cat_id;
	  $depth=$page->depth;
	 }
     $category_navigation=$this->GetCategoryNavigation($cat_id,$depth);
     $category_list=array();
	 foreach($category_navigation as $navigation)
	 {
	  $product_navigation[]=$navigation['category_name']; 
	 }
	 $records['heading']=implode(" - ",$product_navigation);
	}
	break;

	case "BLOGS_CATEGORIES":
	$records= $this->db_query->FetchSingleInformation(BLOGS_CATEGORIES,"category_name as heading","id='$page_id'");
	break; 

	case "BLOGS_ARCHIVE":
	$records['heading']= $page_id;
	break;

	case "BLOGS":
	 if($page_id == '0') $records['heading']="Blogs";
	else  $records= $this->db_query->FetchSingleInformation(BLOGS,"blog_name as heading","id='$page_id'");
	break; 

    case "ABOUT_SECTION":
	 if($page_id == '0') $records['heading']="About Section";
     else $records= $this->db_query->FetchSingleInformation(ABOUT_SECTION,"item_title as heading","id='$page_id'");
	break; 
	
    default :
    $records= $this->db_query->FetchSingleInformation(META_SINGLE_PAGES,"page_name as heading","id='$page_id'");
	break;
   }
   return $records['heading'];
  }
  public function GetCategoryNavigation($parent_id,$depth)
  {
   $categories=array();	  
   for($i=$depth;$i>=0;$i--)
   {
	$categories[$i]=$this->GetCategegoryInformation($parent_id);
	$parent_id=$categories[$i]['parent_id'];
   }  
   return $categories;
  }
  public function GetCategegoryInformation($cid_id)
  {
   return $this->db_query->FetchSingleInformation(CATEGORIES,"id~parent_id~category_name~depth","id='$cid_id'");
  }
  
  public function UpdateURL($table_name,$url,$id)
  {
   $records=array();
   $records['url']=$url;
   $this->db->where('id',$id);
   $this->db->update($table_name,$records);
  }
 }