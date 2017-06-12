<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Recurring_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function InsertDonationDetails($record)
  {
   $records = $this->db_query->TrimValues($record);
   $records['dateadded'] = date('Y-m-d');   
   $this->db->insert(DONATIONS,$records);
  }
 }
?>