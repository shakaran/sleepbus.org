<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Products_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetCategoriesOfProduct()
  {
   $sql="SELECT cat.category_name,cat.url,cat.description,cat.image_file,ctp.cat_id FROM  ".CATEGORIES." cat INNER JOIN  ".CATEGORY_TO_PRODUCTS."  ctp ON cat.id = ctp.cat_id where cat.status='1' and ctp.status='1' GROUP BY cat.url order by cat.position";
   $result=$this->db->query($sql);
   $categories=array();
   if($result->num_rows() > 0)
   {
	$j=0;
    foreach($result->result() as $row)
	{
	 $categories[$j]['category_name']=$row->category_name;
	 $categories[$j]['url']=$row->url;
	 $categories[$j]['image_file']=$row->image_file;
	 $categories[$j]['description']=nl2br($row->description);
	 $categories[$j]['id']=$row->cat_id;
	 $j++;
	}
   }
   return $categories;
  }
  public function GetCategoryDetails($cat_url)
  {
   return $this->db_query->FetchSingleInformation(CATEGORIES,"","status='1' and url='$cat_url'");
  }
  public function GetProducts($cat_url,$limit='')
  {
   $products=array();	  
   $sql="SELECT prod.product_name as name,prod.intro_text,c2p.url as url,prod.id as product_id FROM  ".CATEGORY_TO_PRODUCTS." c2p INNER JOIN ".CATEGORIES." cat ON c2p.cat_id = cat.id INNER JOIN ".PRODUCTS." prod ON c2p.product_id = prod.id WHERE cat.url =  '$cat_url' AND cat.status =  '1' AND c2p.status =  '1' ORDER BY c2p.position $limit";
   $result=$this->db->query($sql);
   if($result->num_rows() > 0)
   {
	$j=0;   
    foreach($result->result() as $rows)
	{
	 $product_images=array();
	 $product_images=$this->db_query->FetchSingleInformation(PRODUCT_IMAGES,"image_file","status='1' and product_id='".$rows->product_id."' and main_image='1'");
     if(count($product_images) > 0) $products[$j]['image_file']=$product_images['image_file'];
	 else $products[$j]['image_file']='';
	 $products[$j]['name']=$rows->name;
	 $products[$j]['url']=$rows->url;
	 $products[$j]['intro_text']=nl2br($rows->intro_text);
	 $j++;
	}
   }
   return $products;
  }
  public function GetProductDetails($product_url)
  {
   $product_details=array();
   $sql="select prod.id as product_id,prod.description,prod.product_name,cat.url as category_url,cat.category_name,c2p.id as cat_prod_id from ".CATEGORY_TO_PRODUCTS." c2p inner join ".PRODUCTS." prod on c2p.product_id=prod.id inner join ".CATEGORIES." cat on c2p.cat_id=cat.id where c2p.url='$product_url' and c2p.status='1' and cat.status='1'";
   $res=$this->db->query($sql);
   if($res->num_rows() > 0)
   {
    foreach($res->result() as $row)
	{
     $product_details['product_name']=$row->product_name;
     $product_details['product_id']=$row->product_id;
     $product_details['description']=$row->description;
     $product_details['category_url']=$row->category_url;
     $product_details['category_name']=$row->category_name;
     $product_details['cat_prod_id']=$row->cat_prod_id;
	}
   }   
   return $product_details;
  }
  public function GetProductVariants($product_id)
  {
   return $this->db_query->FetchInformation(PRODUCT_IMAGES,"","product_id='$product_id' and main_image ='0' and status='1' order by position");
  }
  public function GetRelatedProjects($product_id)
  {
   $sql="select proj.project_title,proj.url,proj.image_file,proj.id as project_id from ".PROJECTS." proj inner join ".PRODUCT_TO_PROJECTS." p2p on proj.id=p2p.project_id where p2p.product_id='$product_id' and proj.status='1'";
   $result=$this->db->query($sql);
   $projects=array(); 
   if($result->num_rows() > 0)
   {
	$j=0;   
    foreach($result->result() as $row)
	{
	 $projects[$j]['project_title']=$row->project_title;
	 $projects[$j]['url']=$row->url;
	 $ref_images=$this->db_query->FetchSingleInformation(PROJECT_IMAGES,"image_file","status='1' and project_id='".$row->project_id."' and main_image='1'");
     if(count($ref_images) > 0) $projects[$j]['image_file']=$ref_images['image_file'];
	 else $projects[$j]['image_file']='';
	 $j++;
	}
   }
   return $projects;
  }
 }
?>