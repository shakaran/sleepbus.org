<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Banner_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetBannerDetails($page_id,$page_type)
  {
   $values=array();
   if($page_type == "homepage")
   {
    $values=$this->db_query->FetchSingleInformation(HOMEPAGE_BANNERS,"image_file as current_image~details~id as banner_id~url~status~image_quality~image_alt_title_text","id='$page_id'");
   }
   else
   {
    $values=$this->db_query->FetchSingleInformation(BANNERS,"image_file as current_image~details~id as banner_id~url~status~image_quality~image_alt_title_text","page_id='$page_id' and page_type='$page_type'");
   }
   if(count($values) > 0)
   {
    return $values;
   }
   else
   {
    $values['details']="";
    $values['current_image']="";
	$values['banner_id']="";
	$values['url']="";
	$values['status']="";
   }
  }
  public function GetAllHomePageBanners()
  {
   return $this->db_query->FetchInformation(HOMEPAGE_BANNERS,"","1='1' order by position");
  }
  public function InsertHomePageBanners($records)
  {
   $sql="update ".HOMEPAGE_BANNERS." set position=position + 1";
   $this->db->query($sql);
   $records['position']=1;
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->insert(HOMEPAGE_BANNERS,$records);
  }
  public function UpdateHomePageBanners($records,$banner_id)
  {
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->where('id',$banner_id);
   $this->db->update(HOMEPAGE_BANNERS,$records);
  }
  public function DeleteBannerForHomePage($all_ids)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $banner_id)
	{
	 $position=$this->db_query->FetchSingleInformation(HOMEPAGE_BANNERS,"position~image","id='$banner_id'");
	 $this->db_query->DeleteRecord(HOMEPAGE_BANNERS,"id='$banner_id'");
	 unlink("./images/banners/".$position['image']);
	 $this->Login_model->SetPositionAfterDeletion(HOMEPAGE_BANNERS,$position['position']);
	}
   }
  }
  public function GetShownBannerCount()
  {
   return $this->db_query->FetchInformation(HOMEPAGE_BANNERS,"id","status='1' order by position");
  }
  
  public function GetServiceDropDownAttribute()
  {
   $attribute['form']=array('onSubmit'=>'return false;');
   $service_list['']="Select";
   $service_list['0']="Service Default Banner";
   if(count($this->GetServiceListForDropDown()) > 0)
   {
    foreach($this->GetServiceListForDropDown() as $key=>$service_title)
    {
     $service_list[$key]=$service_title;
    }
   }
   $attribute['service_id']=$service_list;
   return $attribute;
  } 
  public function GetServiceListForDropDown()
  {
   $sql="select id,service_title from ".SERVICES." order by position";
   $query=$this->db->query($sql);
   $service_list=array();
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
	{
	 $service_list[$row->id]=$row->service_title;
	}
   }
   return $service_list;
  }
  public function GetServiceName($service_id)
  {
   if($service_id == '0')
   {
    return 'Service Default Banner';
   }
   else
   {
    $service=$this->db_query->FetchSingleInformation(SERVICES,"service_title","id='$service_id'");
    return $service['service_title'];
   }
  }
  public function GetNewsDropDownAttribute()
  {
   $attribute['form']=array('onSubmit'=>'return false;');
   $news_list['']="Select";
   $news_list['0']="News Default Banner";
   if(count($this->GetNewsListForDropDown()) > 0)
   {
    foreach($this->GetNewsListForDropDown() as $key=>$news_title)
    {
     $news_list[$key]=$news_title;
    }
   }
   $attribute['news_id']=$news_list;
   return $attribute;
  } 
  public function GetNewsListForDropDown()
  {
   $sql="select id,news_title from ".NEWS." order by position";
   $query=$this->db->query($sql);
   $news_list=array();
   if($query->num_rows() > 0)
   {
    foreach($query->result() as $row)
	{
	 $news_list[$row->id]=$row->news_title;
	}
   }
   return $news_list;
  }
  public function GetNewsName($news_id)
  {
   if($news_id == '0')
   {
    return 'News Default Banner';
   }
   else
   {
    $news=$this->db_query->FetchSingleInformation(NEWS,"news_title","id='$news_id'");
    return $news['news_title'];
   }
  }
  
  public function GetAllBannersInAGlance()
  {
   return $this->db_query->FetchInformation(BANNERS,"","page_name !='' order by id");
  }
  public function GetBannerFormAttributes($values)
  {
   $attribute['form']=array('onSubmit'=>'return ValidateBannerForm();','id'=>'banner_form');
   $attribute['image_file']=array('name'=> 'image_file','id'=> 'image_file','value'=>'');
   $attribute['current_image']=$values['current_image'];
   $attribute['url']=array('name'=> 'url','id'=> 'url','value' => $values['url'],'size'=>'45','onblur'=>"AutoFillHTTP('url')");
   $attribute['details'] = array('name'=>'details', 'id'=> 'details', 'value'=>$values['details'], 'rows'=>'4', 'cols'=>'85');      
  
   $attribute['image_alt_title_text']=array('name'=> 'image_alt_title_text','id'=> 'image_alt_title_text','value'=>$values['image_alt_title_text'],'size'=>'35');  
   
    
   
   $attribute['submit']=array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }
  public function UpdateBanner($records,$banner_id)
  {
   $records=$this->db_query->TrimValues($records);
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->where('id',$banner_id);
   $this->db->update(BANNERS,$records);
  }
  public function InsertBanner($records)
  {
   $records=$this->db_query->TrimValues($records);
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->insert(BANNERS,$records);
  }
  public function DeleteStaticPageBanner($all_ids)
  {
   if(count($all_ids) > 0)
   {
    foreach($all_ids as $banner_id)
	{
     $records['image_file']="";
	 $records['details']="";
	 $records['image_quality']="";
	 $records['image_alt_title_text']="";
	 $records['url']="";
     $records['status']="0";
     $records['modified_by_user']=$this->session->userdata('username');
     $this->db->where('id',$banner_id);
     $this->db->update(BANNERS,$records);
	 $banners=$this->db_query->FetchSingleInformation(BANNERS,"image_file","id='$banner_id'");
	 unlink("./images/banners/".$banners['image_file']);
	}
   }
  }
  public function DeleteBanner($all_ids)
  {
   foreach($all_ids as $banner_id)
   {
	$banners=$this->db_query->FetchSingleInformation(BANNERS,"image_file","id='$banner_id'");
	unlink("./images/banners/".$banners['image_file']);
	$this->db_query->DeleteRecord(BANNERS,"id='$banner_id'");
   }
  }
  public function DeleteHomePageBanner($all_ids)
  {
   foreach($all_ids as $banner_id)
   {
	$banners=$this->db_query->FetchSingleInformation(HOMEPAGE_BANNERS,"image_file~position","id='$banner_id'");
	unlink("./images/banners/".$banners['image_file']);
	$this->db_query->DeleteRecord(HOMEPAGE_BANNERS,"id='$banner_id'");
    $this->Login_model->SetPositionAfterDeletion(HOMEPAGE_BANNERS,$banners['position']);
   }
  }
  public function ProductSubmenu()
  {
   $submenu=array();
   $submenu[0]['name']="Product Default Banner";
   $submenu[0]['url']="products-default-banner";
   $submenu[1]['name']="Category Banners";
   $submenu[1]['url']="category-banners";
   $submenu[2]['name']="Product Banners";
   $submenu[2]['url']="product-banners";
   return $submenu;
  }
  public function GetCategoryId($relation_id)
  {
   $records=array();
   $records=$this->db_query->FetchSingleInformation(CATEGORY_TO_PRODUCTS,"cat_id","id='$relation_id'");
   return $records['cat_id'];
  }
  public function GetCategoryBanners($parent_id)
  {
   $all_categories=array();
   $all_categories=$this->db_query->FetchInformation(CATEGORIES,"id~category_name~depth","parent_id='$parent_id'");
   $category_banners=array();
   if(count($all_categories) > 0)
   {
	$j=0;
    foreach($all_categories as $category)
	{
     $banners=array();
	 $banners=$this->db_query->FetchSingleInformation(BANNERS,"id~image_file~status","page_type='categories' and page_id='".$category['id']."'");
	 if(count($banners) > 0)
	 {
 	  $category_banners[$j]['id']=$banners['id'];
 	  $category_banners[$j]['banner_id']=$banners['id'];
	  $category_banners[$j]['image_file']=$banners['image_file'];
	  $category_banners[$j]['status']=$banners['status'];	  
	 }
	 else
	 {
 	  $category_banners[$j]['id']='';
  	  $category_banners[$j]['banner_id']='';
	  $category_banners[$j]['image_file']='';
	  $category_banners[$j]['status']='';	  
	 }
	 $category_banners[$j]['page_id']=$category['id'];
	 $category_banners[$j]['page_name']=$category['category_name'];
	 $category_banners[$j]['depth']=$category['depth'];
	 $j++;
	}
   }	  
   return $category_banners;
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
  public function GetProductBanners($category_id)
  {
   $sql="select prod.*,cat2prod.id as relation_id,cat.category_name from ".CATEGORY_TO_PRODUCTS." cat2prod inner join ".PRODUCTS." prod on cat2prod.product_id = prod.id inner join ".CATEGORIES." cat on cat2prod.cat_id=cat.id where cat2prod.cat_id='$category_id'";
   $query=$this->db->query($sql);
   $product_banners=array();
   if($query->num_rows() > 0)
   {
	$j=0;   
    foreach($query->result() as $page)
	{
     $banners=array();
	 $banners=$this->db_query->FetchSingleInformation(BANNERS,"id~image_file~status","page_type='products' and page_id='".$page->relation_id."'");
	 if(count($banners) > 0)
	 {
 	  $product_banners[$j]['id']=$banners['id'];
 	  $product_banners[$j]['banner_id']=$banners['id'];
	  $product_banners[$j]['image_file']=$banners['image_file'];
	  $product_banners[$j]['status']=$banners['status'];	  
	 }
	 else
	 {
 	  $product_banners[$j]['id']='';
  	  $product_banners[$j]['banner_id']='';
	  $product_banners[$j]['image_file']='';
	  $product_banners[$j]['status']='';	  
	 }
		
     $product_banners[$j]['page_id']=$page->relation_id;
     $product_banners[$j]['page_name']=$page->product_name;
     $product_banners[$j]['category_name']=$page->category_name;
	 $j++;
	}
   }
   return $product_banners;
  }  
  public function GetPageHeading($page_type,$page_id)
  {
   $records=array();
   switch($page_type)
   {
    case "services":
	if($page_id == '0') $records['heading']="Services Default Banner";
	else $records= $this->db_query->FetchSingleInformation(SERVICES,"service_title as heading","id='$page_id'");
	break; 
    case "news":
	if($page_id == '0') $records['heading']="News Default Banner";
    else $records= $this->db_query->FetchSingleInformation(NEWS,"news_title as heading","id='$page_id'");
	break; 
    case "categories":
	$records= $this->db_query->FetchSingleInformation(CATEGORIES,"category_name as heading","id='$page_id'");
	break; 
    case "products":
	if($page_id == '0') $records['heading']="Products Default Banner";
	else
	{ 
	 $sql="select prod.product_name,cat.category_name from ".CATEGORY_TO_PRODUCTS." cat2prod inner join ".PRODUCTS." prod on cat2prod.product_id = prod.id inner join ".CATEGORIES." cat on cat2prod.cat_id=cat.id where cat2prod.id='$page_id'";
     $query=$this->db->query($sql);
	 foreach($query->result() as $page)
	 {
	  $records['heading']=$page->category_name." >> ".ucfirst($page->product_name);
	 }
	}
	break; 
    default :
    $records['heading']= $page_type;
	break;
   }
   return $records['heading'];
  }
  public function GetHomeBannerInterval()
  {
   return $this->db_query->FetchSingleInformation(BANNER_INTERVALS,"time_interval","id='1'");
  }
  public function GetBannerIntervalAttributes($values)
  {
   $attribute['form']=array('id'=>'interval_frm','name'=>'interval_frm','onSubmit'=>'return false');
   $attribute['time_interval']=array('name'=> 'time_interval','id'=> 'time_interval','value' => $values['time_interval'],'size'=>'2');
   $attribute['option2']=$data = array('name' => 'option2','id' => 'option2','value' => 'true','type' => 'button','content' => 'Cancel');
   $attribute['time_option1']=$data = array('name' => 'time_option1','id' => 'time_option1','value'=>'Ok');
   return $attribute;
  }
  public function UpdateTimeInterval($records,$id)
  {
   $records['modified_by_user']=$this->session->userdata('username');
   $this->db->where('id',$id);
   $this->db->update(BANNER_INTERVALS,$records);
  }
  
 }
?> 