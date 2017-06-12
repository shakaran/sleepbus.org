<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Blog_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetAllBlog($limit='')
  {
   $sql="select blogs.*,date_format(blogs.date_display,'%d %M %Y') as blog_date, blogger.blogger_name as blogger, blogs_categories.category_name as category,
		 blogs_categories.url as cat_url from blogs 
		 inner join blogger on blogger.id=blogs.blogger_id 
		 inner join blogs_categories on blogs_categories.id=blogs.cat_id 
		 where blogs.`status`=1 and blogs_categories.status='1' and blogs_categories.`status`=1 and blogger.`status`=1 order by blogs.position $limit";
   $query=$this->db->query($sql);
   $blog=array();
   if($query->num_rows()>0)
   {
	$i=0;
    foreach($query->result() as $row)
	{
     $blog[$i]['id']=$row->id;
     $blog[$i]['blog_title']=$row->blog_name;
	 $blog[$i]['category']=$row->category;
	 $blog[$i]['blogger']=$row->blogger;
	 $blog[$i]['cat_url']=$row->cat_url;
     $blog[$i]['description']=$row->description;
     $blog[$i]['intro_text']=$row->intro_text;	 
	 $blog[$i]['blog_date']=$row->blog_date;
	 $blog[$i]['url']=$row->url;
	
  
     $i++;
	}
   }
   return $blog;
  }
  public function GetCategoryBlog($cat_id,$limit="")
  {
   $sql="select blogs.*,DATE_FORMAT(blogs.date_display,'%d %M %Y') as blog_date, blogger.blogger_name as blogger, blogs_categories.category_name as category,blogs_categories.url as cat_url from blogs inner join blogger on blogger.id=blogs.blogger_id inner join blogs_categories on blogs_categories.id=blogs.cat_id where blogs.`status`=1 and blogs_categories.id='".$cat_id."' and blogs_categories.status='1' and blogger.status='1' order by blogs.position  $limit";
   $query=$this->db->query($sql);
   $blog=array();
   if($query->num_rows()>0)
   {
	$i=0;
    foreach($query->result() as $row)
	{
     $blog[$i]['id']=$row->id;
     $blog[$i]['blog_title']=$row->blog_name;
	 $blog[$i]['category']=$row->category;
	 $blog[$i]['blogger']=$row->blogger;
	 $blog[$i]['cat_url']=$row->cat_url;
     $blog[$i]['description']=$row->description;
     $blog[$i]['intro_text']=$row->intro_text;	 
	 $blog[$i]['blog_date']=$row->blog_date;
	 $blog[$i]['url']=$row->url;
	
  
     $i++;
	}
   }
   return $blog;
  }
  
  public function GetCategoryDetails($cat_id)
  {
   $this->db->select('category_name');
   $this->db->where('id',$cat_id);
   $this->db->from('blogs_categories');
   $res=$this->db->get();
   $row=$res->row_array();
   return $row;
  }
 public function BlogLeftCategories()
 {
  $categories=array();
  $sqlCategory="SELECT * , (SELECT count( * ) FROM blogs, blogger WHERE cat_id = blogs_categories.id AND blogger_id = blogger.id AND blogger.status = '1' AND blogs.status = '1') AS cnt FROM `blogs_categories` WHERE `status` ='1' ORDER BY position";

  $resCategory=$this->db->query($sqlCategory);
 // $totalCategories = mysql_num_rows($resCategory);
  if($resCategory->num_rows()>0)
  {
   $bc=0;
   foreach($resCategory->result() as $row)
   {
    if($row->cnt > 0)
	{
     $bc++;
	 $categories[$bc]['url']=$row->url;
	 $categories[$bc]['category_name']=stripslashes($row->category_name);
    }
   }
  }
  return $categories;
 }
  
 public function BlogLeftArchives()
 {
  $archives=array();
  $sqlArchives="SELECT distinct DATE_FORMAT(date_display,'%M-%Y') as month,DATE_FORMAT(date_display,'%b') as mm, DATE_FORMAT(date_display,'%M') as month_name,DATE_FORMAT(date_display,'%Y') as year_name,DATE_FORMAT(date_display,'%Y') as yy FROM `blogs`, blogger, blogs_categories where cat_id = blogs_categories.id AND blogger_id = blogger.id and blogs.status='1' and blogger.status='1' and blogs_categories.status='1' order by date_display desc"; 
 
  $resArchives=$this->db->query($sqlArchives);
  $totalArchive = $resArchives->result();
  if($totalArchive > 0)
  {
   $ba=0;
   foreach($resArchives->result() as $row)
   {
    $ba++;
	$archives[$ba]['month']=$row->month;
	$archives[$ba]['mm']=$row->mm;
	$archives[$ba]['month_name']=$row->month_name;
	$archives[$ba]['year_name']=$row->year_name;
	$archives[$ba]['yy']=$row->month;
   }
  }
  return $archives;  
 }
  
  public function GetNewsYearly($year,$limit='')
  {
   $sql="SELECT *,date_format(date_display,'%d %M %Y') as news_date,year(date_display) as news_year,monthname(date_display) as news_month FROM ".NEWS." where year(date_display) = '$year' and status='1' order by position $limit";
   $query=$this->db->query($sql);
   $news=array();
   if($query->num_rows()>0)
   {
	$i=0;
    foreach($query->result() as $row)
	{
     $news[$i]['id']=$row->id;
     $news[$i]['news_title']=$row->news_title;
     $news[$i]['description']=$row->description;
     $news[$i]['intro_text']=$row->intro_text;	 
	 $news[$i]['news_date']=$row->news_date;
	 $news[$i]['url']=$row->url;
	 $news[$i]['news_year']=$row->news_year;
	 $news[$i]['news_month']=strtolower($row->news_month);
  
     $i++;
	}
   }
   return $news;
  }
  public function GetCatId($cat_url)
  {
	return $this->db_query->FetchSingleInformation(BLOGS_CATEGORIES,"id","url='$cat_url' and status='1'");
  }
  public function GetNewsMonthly($year,$month,$limit='')
  {
   $sql="SELECT *,date_format(date_display,'%d %M %Y') as news_date,year(date_display) as news_year,monthname(date_display) as news_month FROM ".NEWS." where year(date_display) = '$year' and Lower(MONTHNAME(date_display))='$month' and status='1' order by position $limit";
   $query=$this->db->query($sql);
   $news=array();
   if($query->num_rows()>0)
   {
	$i=0;
    foreach($query->result() as $row)
	{
     $news[$i]['id']=$row->id;
     $news[$i]['news_title']=$row->news_title;
     $news[$i]['description']=$row->description;
     $news[$i]['intro_text']=$row->intro_text;	 
	 $news[$i]['news_date']=$row->news_date;
	 $news[$i]['url']=$row->url;
	 $news[$i]['news_year']=$row->news_year;
	 $news[$i]['news_month']=strtolower($row->news_month);
  
     $i++;
	}
   }
   return $news;
  }
 public function GetBlogDetails($cat_url,$blog_url)
 {

  $sql_cate="select id from blogs_categories where url='".$cat_url."' and status='1'";
  $res_cate=$this->db->query($sql_cate);
  $numCats=$res_cate->num_rows();
  
  $sqlBlogs="select blogs.*,blogs.blog_name as blog_title,DATE_FORMAT(blogs.date_display,'%d %M %Y') as real_date, blogger.blogger_name as blogger, blogs_categories.category_name as category,blogs_categories.url as category_url from blogs inner join blogger on blogger.id=blogs.blogger_id inner join blogs_categories on blogs_categories.id=blogs.cat_id where blogs.url = '".$blog_url."' and blogs_categories.url='".$cat_url."' and blogs.`status`=1 order by blogs.id desc";
  $resBlogs=$this->db->query($sqlBlogs);
  $blog =array(); 
  $numBlogs=$resBlogs->num_rows();
  if($numBlogs == 0 or $numCats == 0)
  {
   return $blog;
  }
  else
  {
   if($resBlogs->num_rows()>0)
   {
	$i=0;
    foreach($resBlogs->result() as $row)
	{
     $blog['id']=$row->id;
     $blog['blog_title']=$row->blog_title;
	 $blog['category']=$row->category;
	 $blog['blogger']=$row->blogger;
     $blog['description']=$row->description;
     $blog['banner_image_text']=$row->banner_image_text;
     $blog['intro_text']=$row->intro_text;	 
	 $blog['real_date']=$row->real_date;
	 $blog['url']=$row->url;
	 $blog['cat_id']=$row->cat_id;	 
     $i++;
	}
   }
   return $blog;
  }
 }
 
 public function GetArchiveBlog($month,$year,$limit='')
 {
  $sqlblogs="select blogs.*,DATE_FORMAT(blogs.date_display,'%d %M %Y') as real_date, blogger.blogger_name as blogger, blogs_categories.category_name as category,blogs_categories.url as category_url from blogs inner join blogger on blogger.id=blogs.blogger_id inner join blogs_categories on blogs_categories.id=blogs.cat_id where DATE_FORMAT(date_display,'%M')='".ucfirst($month)."' and DATE_FORMAT(date_display,'%Y')='".$year."' and blogs.`status`='1' and blogs_categories.status='1'and blogger.status='1' order by blogs.position $limit ";

  $query=$this->db->query($sqlblogs);
   $blog=array();
   if($query->num_rows()>0)
   {
	$i=0;
    foreach($query->result() as $row)
	{
     $blog[$i]['id']=$row->id;
     $blog[$i]['blog_title']=$row->blog_name;
     $blog[$i]['description']=$row->description;
     $blog[$i]['intro_text']=$row->intro_text;	 
	 $blog[$i]['blog_date']=$row->real_date;
	 $blog[$i]['url']=$row->url;
	 $blog[$i]['cat_url']=$row->category_url;
	 $blog[$i]['blogger']=$row->blogger;
	 $blog[$i]['category']=$row->category;
  
     $i++;
	}
   }
   return $blog; 
 
}
public function DisplayBlogOnFoter()
{
 $sql="select blogs.*,date_format(blogs.date_display,'%d %M %Y') as blog_date, blogger.blogger_name as blogger, blogs_categories.category_name as category,
		 blogs_categories.url as cat_url from blogs 
		 inner join blogger on blogger.id=blogs.blogger_id 
		 inner join blogs_categories on blogs_categories.id=blogs.cat_id 
		 where blogs.`status`=1 and blogs_categories.status='1' and blogs.display_on_home='1' and blogs_categories.`status`=1 and blogger.`status`=1 order by blogs.date_display desc ";
   $query=$this->db->query($sql);
   $blog=$query->result();
  //print_r($blog);
   return $blog;
}
 }
?>