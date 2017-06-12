<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Generalpages extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->library('CommonFunctions');
  }
  public function about_us()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',6,'About Us');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',6);
   $this->data['contents']=$this->Website_model->GetPageContent(2);
   $this->load->view('templates/header',$this->data);
   $this->load->view('general-pages/about-us',$this->data);
   $this->load->view('templates/footer');
  }
  public function why_sleep()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',15,'Why Sleep');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',15);
   $this->data['contents']=$this->Website_model->GetPageContent(3);
   $this->load->view('templates/header',$this->data);
   $this->load->view('general-pages/why-sleep',$this->data);
   $this->load->view('templates/footer');
  }
  public function meet_the_board()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',7,'Meet The Board');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',7);
   $this->data['contents']=$this->Website_model->GetPageContent(4);
   $this->load->view('templates/header',$this->data);
   $this->load->view('general-pages/general-pages',$this->data);
   $this->load->view('templates/footer');
  }
  public function simon_story()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',19,'Simon Story');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',19);
   $this->data['contents']=$this->Website_model->GetPageContent(10);
   $this->load->view('templates/header',$this->data);
   $this->load->view('general-pages/general-pages',$this->data);
   $this->load->view('templates/footer');
  }
  public function media()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',20,'In The Media');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',20);
   $this->data['top_text']=$this->Website_model->GetTopText(6);
   $this->data['bottom_text']=$this->Website_model->GetTopText(7);
   $this->data['media_items']=array();
   $this->data['media_items']=$this->Website_model->MediaItems();
   $this->data['total_item']=count($this->data['media_items']);
   $this->data['show_item']=10;
   $this->websitejavascript->include_footer_js=array('MediaFooterJs');
   $this->load->view('templates/header',$this->data);
   $this->load->view('general-pages/in-the-media',$this->data);
   $this->load->view('templates/footer');
  }
  public function toolbox()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',21,'Sleepbus Toolbox');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',21);
   $this->data['top_text']=$this->Website_model->GetTopText(8);
   $this->data['branding_content']=$this->Website_model->GetTopText(9);
   $this->data['video']=$this->Website_model->GetTopText(10);
   $this->data['facebook_timeline']=$this->Website_model->GetTopText(11);
   $this->data['twitter_background']=$this->Website_model->GetTopText(12);
   $this->load->view('templates/header',$this->data);
   $this->load->view('general-pages/toolbox',$this->data);
   $this->load->view('templates/footer');
  }
  
  public function sitemap()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',18,'Sitemap');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',18);
   $this->data['contents']=$this->Website_model->GetPageContent(8);
   $this->load->view('templates/header',$this->data);
   $this->load->view('general-pages/sitemap',$this->data);
   $this->load->view('templates/footer');
  }
  public function privacy_policy()
  {
   $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',18,'Privacy Policy');
   $this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',18);
   $this->data['contents']=$this->Website_model->GetPageContent(11);
   $this->load->view('templates/header',$this->data);
   $this->load->view('general-pages/privacy-policy',$this->data);
   $this->load->view('templates/footer');
  }
    public function faq()
    {
        $this->data['meta']=$this->Metatags_model->GetMetaTags('SINGLE_PAGE',18,'Frequently Asked Questions');
        //$this->data['cta']=$this->Website_model->GetCTAButtons('SINGLE_PAGE',18);
        //$this->data['contents']=$this->Website_model->GetPageContent(11);
        $this->load->view('templates/header',$this->data);
        $this->load->view('general-pages/faq',$this->data);
        $this->load->view('templates/footer');
    }
  
 }
