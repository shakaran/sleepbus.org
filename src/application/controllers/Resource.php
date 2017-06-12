<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Resource extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
  }
  public function index()
  {
   $this->data['page_content']=$this->Website_model->GetResourceContent();
   $this->data['meta']=$this->Website_model->GetResourceMeta($this->data['page_content']);
   $this->load->view('templates/header',$this->data);
   $this->load->view('resource/resource',$this->data);
   $this->load->view('templates/footer');
  }
 }
