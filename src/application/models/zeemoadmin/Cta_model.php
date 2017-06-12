<?php
 class Cta_model extends CI_Model
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
     $page_list[$j]['top']=$this->GetHeading('SINGLE_PAGE',$page['id']);
	  if(!empty($page_list[$j]['top']['cta']))
	 {
	  $cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$page_list[$j]['top']['cta'].") order by position");
	  $page_list[$j]['cta']=$cta;
	 }
	 else $page_list[$j]['cta']="";
	 $j++;
	}
   }
   return $page_list;
  } 
  public function GetHeading($page_type,$page_id)
  {
   $temp_array=array();
   $meta=array();
   $page_id=urldecode($page_id);
   $temp_array=$this->db_query->FetchSingleInformation(CTA,"","page_type='$page_type' and page_id='$page_id'");
   if(count($temp_array) > 0)
   {
   
    if(!empty($temp_array['cta']))
	{
     $meta['cta']=$temp_array['cta'];
	}
	else $meta['cta']="";
    
	$meta['cta_id']=$temp_array['id'];
   }
   else
   {
    $meta['cta']="";
	$meta['cta_id']='';
   }
   return $meta;
  }
  public function SetTopHeading($record,$meta_id)
  {
   $records=$this->db_query->TrimValues($record);
   $records['modified_by_user']=$this->session->userdata('username');   
   if(!empty($meta_id))
   { 
    $this->db->where('id',$meta_id);
    $this->db->update(CTA,$records);
    $message="Display of CTA has been updated successfully";
   }
   else
   {
    $records['dateadded']=date("Y-m-d h:i:s");
	$this->db->insert(CTA,$records);
    $message="Display of CTA has been added successfully";
   }
   return $message;
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
  public function GetCtaFormAttributes($values)
  {
	
   $attribute=array();
   $attribute['form']=array('onSubmit'=>'return ValidateMetatagsForm();');

   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   
   
   return $attribute; 
  }
  public function GetUrlValue($table_name,$id)
  {
   $values=array();
   $values=$this->db_query->FetchSingleInformation($table_name,"url","id='$id'");
   return $values['url'];
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
   $sql = "select id, category_name from ".CATEGORIES." where parent_id=0 order by position";
   $query = $this->db->query($sql);
   $category_list = array();
   $category_list['']='Please Select';
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
	{
		//$category_list[$row->id]=array("name"=>$row->category_name,"type"=>"main");
	   $sql1 = "select id, category_name from ".CATEGORIES." where parent_id=".$row->id." order by position";
	   $query1= $this->db->query($sql1);

	   if($query1->num_rows() > 0)
	   {
		foreach($query1->result() as $row1)
		{
		 $category_list[$row->category_name][$row1->id]=$row1->category_name;
		}
	   }
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
     $product_list[$j]['top']=$this->GetHeading('PRODUCTS',$page->relation_id,$page->product_name);
	 if(!empty($product_list[$j]['top']['cta']))
	 {
	  $cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$product_list[$j]['top']['cta'].")");
	  $product_list[$j]['cta']=$cta;
	 }
	 else $product_list[$j]['cta']="";

	 
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
  public function BlogSubmenu()
  {
   $submenu=array();
   $submenu[0]['name']="Blog Main Page";
   $submenu[0]['url']="blog-default-cta";
   $submenu[1]['name']="Category Pages";
   $submenu[1]['url']="blog-category";
   $submenu[2]['url']="blog-archive";
   $submenu[2]['name']="Archive Pages";
   $submenu[3]['name']="Blogs";
   $submenu[3]['url']="blogs";
   return $submenu;
  }
  public function ExpertiseSubmenu()
  {
   $submenu=array();
   $submenu[0]['name']="Expertise Main Page";
   $submenu[0]['url']="expertise-default-cta";
   $submenu[1]['name']="Category Pages";
   $submenu[1]['url']="expertise-category";
   $submenu[3]['name']="Expertises";
   $submenu[3]['url']="expertises";
   return $submenu;
  }
  public function ProjectSubmenu()
  {
   $submenu=array();
   $submenu[0]['name']="Project Main Page";
   $submenu[0]['url']="project-default-cta";
   $submenu[1]['name']="Category Pages";
   $submenu[1]['url']="project-category";
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
     $blog_list[$j]['top']=$this->GetHeading('BLOGS',$page->id);
	 if(!empty($blog_list[$j]['top']['cta']))
	 {
	  $cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$blog_list[$j]['top']['cta'].")");
	  $blog_list[$j]['cta']=$cta;
	 }
	 else $blog_list[$j]['cta']="";
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
     $category_list[$j]['top']=$this->GetHeading('BLOGS_CATEGORIES',$page->id);
	 if(!empty($category_list[$j]['top']['cta']))
	 {
	  $cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$category_list[$j]['top']['cta'].")");
	  $category_list[$j]['cta']=$cta;
	 }
	 else $category_list[$j]['cta']="";

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
     $blog[$i]['top']=$this->GetHeading('BLOGS_ARCHIVE',$row->mm." ".$row->yy);
	 if(!empty($blog[$i]['top']['cta']))
	 {
	  $cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$blog[$i]['top']['cta'].")");
	  $blog[$i]['cta']=$cta;
	 }
	 else $blog[$i]['cta']="";

  
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
  public function GetCta()
  {
   $icon_list=array();
   $icon_list=$this->db_query->FetchInformation(ICON_SETTINGS,"","1='1' order by position");	  
   return $icon_list;

   }
  public function GetDefaultBlogPage()
  {
   $blog_list=array();
   $j=0;
   $blog_list[$j]['id']='0';
   $blog_list[$j]['page_name']="Blogs";
   $blog_list[$j]['top']=$this->GetHeading('BLOGS',$blog_list[$j]['id']);
   if(!empty($blog_list[$j]['top']['cta']))
   {
	 $cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$blog_list[$j]['top']['cta'].")");
	 $blog_list[$j]['cta']=$cta;
	}
   else $blog_list[$j]['cta']="";
   return $blog_list;
  }
   public function GetDefaultProductPage()
  {
   $product_list=array();
   $j=0;
   $product_list[$j]['id']='0';
   $product_list[$j]['page_name']="Products";
   $product_list[$j]['top']=$this->GetHeading('PRODUCTS',$product_list[$j]['id']);
   if(!empty($product_list[$j]['top']['cta']))
   {
	 $cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$product_list[$j]['top']['cta'].")");
	 $product_list[$j]['cta']=$cta;
	}
   else $product_list[$j]['cta']="";
   
   
   
   
   return $product_list;
  }
  public function ProductSubmenu()
  {
   $submenu=array();
   $submenu[0]['name']="Product Main Page";
   $submenu[0]['url']="product-default-cta";
   $submenu[1]['name']="Category Pages";
   $submenu[1]['url']="category-cta";
   $submenu[2]['name']="Product Pages";
   $submenu[2]['url']="product-cta";
   return $submenu;
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
	 
	 $category_list[$j]['top']=$this->GetHeading('CATEGORIES',$page->id);
	 if(!empty($category_list[$j]['top']['cta']))
	 {
	  $cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$category_list[$j]['top']['cta'].")");
	  $category_list[$j]['cta']=$cta;
	 }
	 else $category_list[$j]['cta']="";
	 $j++;
	}
   }
   return $category_list;
  }
  public function GetIconList()
  {
   $icon_list=array();
   $icon_list=$this->db_query->FetchInformation(ICON_SETTINGS,"","1='1' order by position");	  
   return $icon_list;
  }
  public function GetIconDetails($icon_id)
  {
    $icon_details=array();
   $icon_details=$this->db_query->FetchSingleInformation(ICON_SETTINGS,"id~main_image as current_main_image~hover_image as current_hover_image~intro_text~section_icon_name~url","id='$icon_id'");
   return $icon_details;
  }
  public function GetIconSettingFormAttribute($values,$icon_id='')
  {
   $attribute['form']=array('onSubmit'=>'return ValidateIconSetting();');
   $attribute['section_icon_name']=array('name'=> 'section_icon_name','id'=> 'section_icon_name','value'=>$values['section_icon_name'],'size'=>'45');
   $attribute['intro_text']=array('name'=> 'intro_text','id'=> 'intro_text','value'=>$values['intro_text'],'rows'=>'4','cols'=>'40');
   $attribute['url']=array('name'=> 'url','id'=> 'url','value'=>$values['url'],'size'=>'45','onblur'=>"AutoFillHTTP('url')");

   if(!empty($icon_id)) $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Update');
   else $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   
   return $attribute;
  }
  public function UpdateIconSettingRecords($edit_id,$records)
  {
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->where('id',$edit_id);
   $this->db->update(ICON_SETTINGS,$records);
  }
  public function InsertIconSettingRecords($records)
  {
   $sql="update ".ICON_SETTINGS." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['modified_by_user']=$this->session->userdata('username');
   $records['date_entered']=date("Y-m-d"); 
   $this->db->insert(ICON_SETTINGS,$records);
  }


  public function GetDefaultNewsPage()
  {

   $items=array();
   $sql="SELECT id,news_title FROM ".NEWS."  order by position";
   $query=$this->db->query($sql);
  
   $j=0;
   $items[$j]['id']='0';
   $items[$j]['page_name']="News";
   $items[$j]['top']=$this->GetHeading('NEWS',$items[$j]['id']);
   if(!empty($items[$j]['top']['cta']))
	 {
	  $cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$items[$j]['top']['cta'].")");
	  $items[$j]['cta']=$cta;
	 }
	 else $items[$j]['cta']="";
   if($query->num_rows() > 0)
   {
	$j=1;
	foreach($query->result() as $page)
    {
     $items[$j]['id']=$page->id;
     $items[$j]['page_name']=$page->news_title;
     $items[$j]['top']=$this->GetHeading('NEWS',$page->id);
	 if(!empty($items[$j]['top']['cta']))
	 {
	  $cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$items[$j]['top']['cta'].")");
	  $items[$j]['cta']=$cta;
	 }
	 else $items[$j]['cta']="";
	 $j++;
    }
   }
   return $items;
  }
  public function GetDefaultProjectPage()
  {

   $items=array();
   $sql="SELECT id,project_title FROM ".PROJECTS."  order by position";
   $query=$this->db->query($sql);
  
   $j=0;
   $items[$j]['id']='0';
   $items[$j]['page_name']="Project";
   $items[$j]['top']=$this->GetHeading('PROJECTS',$items[$j]['id']);
   if(!empty($items[$j]['top']['cta']))
	 {
	  $cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$items[$j]['top']['cta'].")");
	  $items[$j]['cta']=$cta;
	 }
	 else $items[$j]['cta']="";
   if($query->num_rows() > 0)
   {
	$j=1;
	foreach($query->result() as $page)
    {
     $items[$j]['id']=$page->id;
     $items[$j]['page_name']=$page->project_title;
     $items[$j]['top']=$this->GetHeading('PROJECTS',$page->id);
	 if(!empty($items[$j]['top']['cta']))
	 {
	  $cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$items[$j]['top']['cta'].")");
	  $items[$j]['cta']=$cta;
	 }
	 else $items[$j]['cta']="";
	 $j++;
    }
   }
   return $items;
  }

  public function GetAllAboutPages()
  {
   $items=array();
   $sql="SELECT id, item_title FROM ".ABOUT_SECTION."  order by position";
   $query=$this->db->query($sql);
  
   $j=0;
   $items[$j]['id']='0';
   $items[$j]['page_name']="About Section";
   $items[$j]['top']=$this->GetHeading('ABOUT_SECTION',$items[$j]['id']);
   if(!empty($items[$j]['top']['cta']))
   {
	$cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$items[$j]['top']['cta'].")");
	$items[$j]['cta']=$cta;
   }
   else $items[$j]['cta']="";
   if($query->num_rows() > 0)
   {
	$j=1;
	foreach($query->result() as $page)
    {
     $items[$j]['id']=$page->id;
     $items[$j]['page_name']=$page->item_title;
     $items[$j]['top']=$this->GetHeading('ABOUT_SECTION',$page->id);
	 if(!empty($items[$j]['top']['cta']))
	 {
	  $cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$items[$j]['top']['cta'].")");
	  $items[$j]['cta']=$cta;
	 }
	 else $items[$j]['cta']="";
	 $j++;
    }
   }
   return $items;
  }

  public function GetAllLandingPages()
  {
   $items=array();
   $sql="SELECT id, title FROM ".LANDINGPAGE."  order by position";
   $query=$this->db->query($sql);
  
   $j=0;
   if($query->num_rows() > 0)
   {
	foreach($query->result() as $page)
    {
     $items[$j]['id']=$page->id;
     $items[$j]['page_name']=$page->title;
     $items[$j]['top']=$this->GetHeading('LANDING_PAGE',$page->id);
	 if(!empty($items[$j]['top']['cta']))
	 {
	  $cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$items[$j]['top']['cta'].")");
	  $items[$j]['cta']=$cta;
	 }
	 else $items[$j]['cta']="";
	 $j++;
    }
   }
   return $items;
  }

  public function GetDefaultExpertisePage()
  {
   $blog_list=array();
   $j=0;
   $blog_list[$j]['id']='0';
   $blog_list[$j]['page_name']="Expertise";
   $blog_list[$j]['top']=$this->GetHeading('EXPERTISE',$blog_list[$j]['id']);
   if(!empty($blog_list[$j]['top']['cta']))
	 {
	  $cta=$this->db_query->FetchInformation(ICON_SETTINGS,"section_icon_name","id in(".$blog_list[$j]['top']['cta'].")");
	  $blog_list[$j]['cta']=$cta;
	 }
	 else $blog_list[$j]['cta']="";
	 return $blog_list;
  }
  public function GetExpertiseCategoriesList()
  {
   $sql="select id,name from ".EXPERTISE_CATEGORIES." order by position";
   $query=$this->db->query($sql);
   $category_list=array();
   $j=0;
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $page)
	{
     $category_list[$j]['id']=$page->id;
     $category_list[$j]['page_name']=$page->name;
     $category_list[$j]['top']=$this->GetHeading('EXPERTISE_CATEGORIES',$page->id);
	 $j++;
	}
   }
   return $category_list;
  }
  public function GetProjectCategoriesList()
  {
   $sql="select id,category_name as name from ".PROJECT_CATEGORIES." order by position";
   $query=$this->db->query($sql);
   $category_list=array();
   $j=0;
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $page)
	{
     $category_list[$j]['id']=$page->id;
     $category_list[$j]['page_name']=$page->name;
     $category_list[$j]['top']=$this->GetHeading('PROJECT_CATEGORIES',$page->id);
	 $j++;
	}
   }
   return $category_list;
  }
  
  public function GetPageHeading($page_type,$page_id)
  {
   $records=array();
   switch($page_type)
   {
	case "BLOGS_CATEGORIES":
	$records= $this->db_query->FetchSingleInformation(BLOGS_CATEGORIES,"category_name as cta","id='$page_id'");
	break; 

	case "BLOGS_ARCHIVE":
	$records['cta']= $page_id;
	break;
	
	case "BLOGS":
	 if($page_id == '0') $records['cta']="Blogs";
	else  $records= $this->db_query->FetchSingleInformation(BLOGS,"blog_name as cta","id='$page_id'");
	break; 
	
	 case "CATEGORIES":
	 $category_info= $this->db_query->FetchSingleInformation(CATEGORIES,"depth","id='$page_id'");
     $category_navigation=$this->GetCategoryNavigation($page_id,$category_info['depth']);
     $category_list=array();
	 foreach($category_navigation as $navigation)
	 {
	  $category_list[]=$navigation['category_name']; 
	 }
	$records['cta']=implode(" - ",$category_list);
	break; 
	
    case "PRODUCTS":
	if($page_id == '0') $records['cta']="Product";
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
	 $records['cta']=implode(" - ",$product_navigation);
	}
	break;

	case "NEWS":
	if($page_id == '0') $records['cta']="News";
	else  $records= $this->db_query->FetchSingleInformation(News,"news_title as cta","id='$page_id'");
	break; 
	case "PROJECTS":
	if($page_id == '0') $records['cta']="Project";
	else  $records= $this->db_query->FetchSingleInformation(PROJECTS,"project_title as cta","id='$page_id'");
	break; 
	
	case "ABOUT_SECTION":
	if($page_id == '0') $records['cta']="About Section";
	else  $records= $this->db_query->FetchSingleInformation(ABOUT_SECTION,"item_title as cta","id='$page_id'");
	break;

	case "LANDING_PAGE":
	 $records = $this->db_query->FetchSingleInformation(LANDINGPAGE,"title as cta","id='$page_id'");
	 if(count($records)==0) $records['cta'] = "Landing Page";
	break;
	
    default :
    $records= $this->db_query->FetchSingleInformation(META_SINGLE_PAGES,"page_name as cta","id='$page_id'");
	break;
   }
   return $records['cta'];
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
  public function DeleteIcon($delete_all)
  {
   if(count($delete_all)>0)
   {
    foreach($delete_all as $id)
    { 
     $position=$this->db_query->FetchSingleInformation(ICON_SETTINGS,"position","id='$id'");
     $this->Login_model->SetPositionAfterDeletion(ICON_SETTINGS,$position['position']);
     //$this->DeleteImagesBrochure(ICON_SETTINGS, 'id', $id, 'main_image', './images/cta/');
     //$this->DeleteImagesBrochure(ICON_SETTINGS, 'id', $id, 'hover_image', './images/cta/');
     $this->db_query->DeleteRecord(ICON_SETTINGS,"id='$id'");
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
 }