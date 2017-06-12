<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Projects extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->library('CommonFunctions');
   $this->load->model('Project_model');
  }
  public function index()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('PROJECTS',0,'Completed Projects');
   $this->data['cta']=$this->Website_model->GetCTAButtons('PROJECTS',0);
   $this->data['top_text']=$this->Website_model->GetTopText(2);
   $this->data['all_projects']=$this->Project_model->GetAllProjects();
   $this->load->view('templates/header',$this->data);
   $this->load->view('projects/completed-project',$this->data);
   $this->load->view('templates/footer');
  }
  public function details($project_id)
  {
   $this->data['project_id']=$project_id;
   $this->data['project_details']=$this->Project_model->GetProjectDetails($this->data['project_id']);  
   $this->data['meta']=$this->Metatags_model->GetMetaTags('PROJECTS',$this->data['project_id'],$this->data['project_details']['project_title']);
   $this->data['cta']=$this->Website_model->GetCTAButtons('PROJECTS',$this->data['project_id']);
   
   $this->data['project_images']=$this->Project_model->GetProjectImages($this->data['project_id']);  
   
   $this->load->view('templates/header',$this->data);
   $this->load->view('projects/project-details',$this->data);
   $this->load->view('templates/footer');
  }
  
 }
