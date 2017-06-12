<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Project_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetAllProjects()
  {
   return $this->db_query->FetchInformation(PROJECTS,"","status='1' order by position");
  }
  public function GetProjectDetails($project_id)
  {
   return $this->db_query->FetchSingleInformation(PROJECTS,"","id='".$project_id."' and status='1' order by position");
  }
  public function GetProjectImages($project_id)
  {
   return $this->db_query->FetchInformation(PROJECT_IMAGES,"","project_id='".$project_id."' and status='1' order by position");
  }
  
 }
?>