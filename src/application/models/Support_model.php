<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Support_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetAllSupports()
  {
   return $this->db_query->FetchInformation(SUPPORTS,"","status='1' order by position");
  }
 }
?>