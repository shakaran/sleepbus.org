<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Leads_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();
  }
  
  public function GetLeadsData($from,$to,$type='')
  {
   return $this->db_query->FetchInformation(LEADS,"id~name~last_name~email~message~contact_no~question~DATE_FORMAT(dateadded,'%d %b %y %h:%i %p') as date"," dateadded between '$from' and '$to 23:59:59' and report_type like '%$type%' order by dateadded desc"); 
  }
  
  public function GetLeadsDetails($id)
  {
   return $this->db_query->FetchSingleInformation(LEADS,"id~name~last_name~email~contact_no~question~message~DATE_FORMAT(dateadded,'%d %b %y %h:%i %p') as date"," id=$id order by dateadded desc"); 
  }

  public function GetLeadsSourceData($from,$to,$type='')
  {
	$sql=$this->db->query("Select distinct question, count(*) as cnt from leads where dateadded between '$from' and '$to 23:59:59' and report_type like '%$type%'  group by question");
	return $sql->result();
  }
  public function GetNewsletterSubscribers()
  {
   $sql = "select ns.email1 as email, ns.fname as name, ng.name as group_name from newsletters_subscribers ns 
   inner join newsletter_subscribers_groups nsg on ns.id=nsg.subscriber_id
   inner join newsletters_groups ng on ng.id=nsg.group_id";	  
   $result = $this->db->query($sql);
   $items = array();
   if($result->num_rows() > 0)
   {
	$i = 0;
	foreach($result->result() as $row)
	{
	 foreach($row as $key=>$data)	$items[$i][$key] = $data; 	
	 $i++;	
	}
   }
   return $items;
  }  
 }
?> 