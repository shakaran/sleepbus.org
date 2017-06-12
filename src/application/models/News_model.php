<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class News_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetAllNews($limit='')
  {
   $sql="SELECT *,date_format(date_display,'%d %M %Y') as news_date,year(date_display) as news_year,monthname(date_display) as news_month FROM ".NEWS." where status='1' order by position $limit";
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
  
  public function GetYearOfNews()
  {
   return $this->db_query->FetchInformation(NEWS,"distinct(year(date_display)) as year","status='1' order by year desc");
  }
  public function GetMonthsOfNews($year)
  {
   return $this->db_query->FetchInformation(NEWS,"distinct(DATE_FORMAT(date_display,'%Y')) as year~MONTHNAME(date_display) as month~DATE_FORMAT(date_display,'%b') as short_month_name","status='1' and year(date_display)='$year' order by position");
  }
  public function GetNewsDetails($news_url)
  {
   return $this->db_query->FetchSingleInformation(NEWS,"date_format(date_display,'%d %M %Y') as news_date~year(date_display) as news_year~lower(monthname(date_display)) as news_month~news_title~description~id","status='1' and url='".$news_url."'");
  }
 }
?>