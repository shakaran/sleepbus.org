<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Website_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetCommonSettingValues()
  {
   return $this->db_query->FetchSingleInformation(COMMON_SETTINGS,"","1='1'");
  }
  public function GetPageContent($page_id)
  {
   return $this->db_query->FetchSingleInformation(PAGES,"","id='$page_id'");
  }
  public function GetContactPageContent()
  {
   return $this->db_query->FetchSingleInformation(CONTACT,"","id='1'");
  }
  public function GetBannerInterval()
  {
   return $this->db_query->FetchSingleInformation(BANNER_INTERVALS,"","id='1'");
  }
  public function GetResourceContent()
  {
   return $this->db_query->FetchSingleInformation(ZEEMO_RESOURCE,"","id='1'");
  }
  public function GetResourceMeta($content)
  {
   $meta=array();  
   if(!empty($content['meta_title'])) $meta['page_title']=$content['meta_title'];
   else $meta['page_title']=$meta['page_title']="Resource".DEFAULT_SUFFIX; 
   $meta['meta_keyword']=$content['meta_keyword'];
   $meta['meta_description']=$content['meta_description'];
   $meta['json_code']=$content['json_code'];
   return $meta;   
  }
  public function GetZeemoSettingsContent()
  {
   return $this->db_query->FetchSingleInformation(ZEEMO_SETTINGS,"","id='1'");
  }
  
  public function GetHomePageBanners()
  {
   return $this->db_query->FetchInformation(HOMEPAGE_BANNERS,"","status='1' order by position");
  }
  public function GetPageHeading($parent_id)
  {
   return $this->db_query->FetchInformation(PAGE_HEADING,"page_name~page_heading","parent_id='$parent_id' order by position");
  }
  public function GetLeadSources()
  {
   return $this->db_query->FetchInformation(LEAD_SOURCES,"","status='1' order by position"); 
  }
  
  public function ContactFormAttribute($values=array())
  {
   if(count($values) == 0)
   {
    $values=array('name'=>'','email'=>'','phone'=>'','message'=>'','hear_about_us'=>'','company'=>'');
   }
   $attribute=array();
   $attribute['form']=array('id'=>'connect_frm','name'=>'connect_frm','onSubmit'=>'return ValidateConnectForm();');
 
   $attribute['name']=array('name'=> 'name','id'=> 'name','value' => $values['name'],'placeholder'=>'Name',"class"=>"form-control");
   $attribute['email']=array('name'=> 'email','id'=> 'email','value' => $values['email'],'placeholder'=>'Email',"class"=>"form-control");
   $attribute['phone']=array('name'=> 'phone','id'=> 'phone','value' => $values['phone'],'placeholder'=>'Phone',"class"=>"form-control");
   $questions['']="How did you find out about us?";
   if(count($this->GetLeadSources()) > 0)
   {
    foreach($this->GetLeadSources() as $sources)
    {
     $questions[$sources['name']]="&nbsp;&nbsp;".$sources['name'];
    }
   }
   $attribute['hear_about_us']=$questions;
   $attribute['hear_about_us_value']=$values['hear_about_us'];
   
   
   	
   $attribute['message']=array('name'=> 'message','id'=> 'message','value'=>$values['message'],'placeholder'=>'Message',"class"=>"form-control");
   
   $attribute['submit']=array('type' => 'submit', 'name' => 'form_submit','id'=>'form_submit','value'=>"Send Message","class"=>"btn btn-primary");
   
  

  
   return $attribute;
  }
  public function SpeakerRequestFormAttribute($values=array())
  {
   if(count($values) == 0)
   {
    $values=array('name'=>'','email'=>'','phone'=>'','message'=>'','hear_about_us'=>'','company'=>'');
   }
   $attribute=array();
   $attribute['form']=array('id'=>'connect_frm','name'=>'connect_frm','onSubmit'=>'return ValidateSpeakerRequestForm();');
 
   $attribute['name']=array('name'=> 'name','id'=> 'name','value' => $values['name'],'placeholder'=>'Name',"class"=>"form-control");
   $attribute['email']=array('name'=> 'email','id'=> 'email','value' => $values['email'],'placeholder'=>'Email',"class"=>"form-control");
   $attribute['phone']=array('name'=> 'phone','id'=> 'phone','value' => $values['phone'],'placeholder'=>'Phone',"class"=>"form-control");
   $questions['']="How did you find out about us?";
   if(count($this->GetLeadSources()) > 0)
   {
    foreach($this->GetLeadSources() as $sources)
    {
     $questions[$sources['name']]="&nbsp;&nbsp;".$sources['name'];
    }
   }
   $attribute['hear_about_us']=$questions;
   $attribute['hear_about_us_value']=$values['hear_about_us'];
   
   
   	
   $attribute['message']=array('name'=> 'message','id'=> 'message','value'=>$values['message'],'placeholder'=>'Message',"class"=>"form-control");
   
   $attribute['submit']=array('type' => 'submit', 'name' => 'form_submit','id'=>'form_submit','value'=>"Send Message","class"=>"btn btn-primary");
   
  

  
   return $attribute;
  }
  
  public function GetMessageSettings()
  {
   return $this->db_query->FetchSingleInformation(MESSAGE_SETTINGS,"","1='1'");
  }
  public function GetEmailSettings()
  {
   return $this->db_query->FetchSingleInformation(EMAIL_SETTINGS,"","1='1'");
  }
  public function GetBanner($page_type,$page_id)
  {
   $banner=array();
   $banner=$this->GetBannerValues($page_type,$page_id);
   if(count($banner) == 0 and $page_type == "products" and $page_id !='0')
   {
    $category=$this->db_query->FetchSingleInformation(CATEGORY_TO_PRODUCTS,"cat_id","id='$page_id'");
    $banner=$this->GetBanner('categories',$category['cat_id']);
   }
   if(count($banner) == 0 and $page_type == "categories")
   {
    $page_type="products";
   }
   if((count($banner) == 0))
   {
    $banner=$this->GetBannerValues($page_type,'0');
   }
   if(count($banner) == 0)
   {
    $banner=$this->GetBannerValues('default','0');
   }
   return $banner;
  }
  public function GetBannerValues($page_type,$page_id)
  {
   $banner=$this->db_query->FetchSingleInformation(BANNERS,"","page_type='$page_type' and page_id='$page_id' and status='1' and image_file !=''");
   return $banner;
  }
  public function GetImageGallery($table_name,$parent_field,$parent_id,$limit='')
  {
   return $this->db_query->FetchInformation($table_name,"","$parent_field='$parent_id' and status='1' order by position $limit"); 
  }
  public function GetEmailMessages($page_id)
  {
   return $this->db->select('subject,message,receiver,receiver_to_emails,receiver_cc_emails,receiver_bcc_emails,sender_email,sender_name')->from(EMAIL_MESSAGES)->where('id',$page_id)->get()->row_array();
  }  
  public function GetThankMessages($id)
  {
   return $this->db_query->FetchSingleInformation(THANK_MESSAGES,"message","id=$id");
  }
  
  public function GetBrochures($table_name,$parent_field,$parent_id)
  {
   return $this->db_query->FetchInformation($table_name,"","$parent_field='$parent_id' and status='1' order by position"); 
  }
  public function GetBrochureDetails($table_name,$brochure_id)
  {
   return $this->db_query->FetchSingleInformation($table_name,"","id='$brochure_id' and status='1' order by position"); 
  }
  
  public function GetMapAttributes($address)
  {
   $map=array();
   $map['address']=str_replace("\r\n"," ",$address);
   $geocode= file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.urlencode($map['address']).'&sensor=false');
   $output= json_decode($geocode);
   $map['latitude'] = $output->results[0]->geometry->location->lat;
   $map['longitude'] = $output->results[0]->geometry->location->lng;
   return $map;
  }

  public function GetCTAButtons($page_type,$page_id)
  {
   $cta_buttons=array();
   $cta_ids=$this->db->select('cta')->from(CTA)->where('page_type',$page_type)->where('page_id',$page_id)->get()->row_array();
   if(!empty($cta_ids['cta']))
   {
    $cta_buttons=$this->db->select('section_icon_name,url,main_image,intro_text')->from(ICON_SETTINGS)->where_in('id',explode(",",$cta_ids['cta']))->where('status','1')->order_by('position','asc')->get()->result_array();
   }
    return $cta_buttons;
  }
  
  /* All the above functions are common to all websites so if you want to delete any of them please keep caution */
  
  
  public function SearchFormAttributes()
  {
   $attribute['form']=array('id'=>'search_frm','name'=>'search_frm','onSubmit'=>'return ValidateSearchForm();');
   $attribute['search_text']=array('name'=> 'search_text','id'=> 'search_text','value'=>'');
   $attribute['search_submit']=array('name'=> 'search_submit','id'=> 'search_submit','value'=>'','class'=>"submit");
   return $attribute;
  }
  public function GetDownloadBrochures()
  {
   $all_downloads=array();
   $sql="SELECT dc.category_name, d.*,date_format(d.dateadded,'%d.%m.%Y') as download_date FROM ".DOWNLOADS." d INNER JOIN ".DOWNLOAD_CATEGORIES." dc ON d.cat_id = dc.id WHERE dc.status =  '1' AND d.status =  '1' ORDER BY dc.position, d.position";  
   $result=$this->db->query($sql);
   if($result->num_rows() > 0)
   {
	$j=0;
    foreach($result->result() as $row)
	{
	 $all_downloads[$row->category_name][$j]['id']=$row->id;
	 $all_downloads[$row->category_name][$j]['download_date']=$row->download_date;
	 $all_downloads[$row->category_name][$j]['brochure_file']=$row->brochure_file;
	 $all_downloads[$row->category_name][$j]['brochure_title']=$row->brochure_title;
	 $j++;
	}
   }
   return $all_downloads;
  }
  public function GetTopText($id)
  {
   return $this->db_query->FetchSingleInformation(TOP_TEXT,"","id='$id'");
  }
  public function GetHomePageContent()
  {
   return $this->db_query->FetchInformation(WHAT_WE_DO,"","status='1' order by position");
  }
  public function GetHomePageContentDetails($url)
  {
   return $this->db_query->FetchSingleInformation(WHAT_WE_DO,"","status='1' AND url='$url'");
  }
  public function GetSocial()
  {
   return $this->db_query->FetchInformation(SOCIAL_MEDIA_ICONS,"","status='1' order by position");
  }
  public function GetContact()
  {
   return $this->db_query->FetchInformation(CONTACT_SETTINGS,"","");
  }
  public function SaveConnect($data) {
		return $this->db->insert('leads', $data); 
  }
  public function NewsLetterFormAttribute($values)
  {
   if(count($values) == 0)
   {
    $values=array('name'=>'','email'=>'');
   }
	  
   $attribute['form']=array('id'=>'newsletter_frm','name'=>'newsletter_frm','onSubmit'=>'return ValidateNewsLetterForm();');
   $attribute['name']=array('name'=> 'newsletter_name','id'=> 'newsletter_name','value' => $values['name'],'placeholder'=>'Name','class'=>"form-control");
 
   $attribute['email']=array('name'=> 'newsletter_email','id'=> 'newsletter_email','value' => $values['email'],'placeholder'=>'Email','class'=>"form-control");

   
   $attribute['submit']=array('type' => 'submit', 'name' => 'form_submit','id'=>'form_submit','value'=>'Join',"class"=>"btn btn-primary");
   return $attribute;
  }
  public function InsertSubscribe($data)
  {
   $this->db->insert('newsletters_subscribers',$data);
   return $lastid=$this->db->insert_id();
  }
  public function InsertSubscribeGroup($data1)
  {
   $this->db->insert('newsletter_subscribers_groups',$data1);
   return $lastid=$this->db->insert_id();
  }
  
  public function getIsSubscribed($email)
  {
   $sql="select * from newsletters_subscribers where email1 like '$email' or email2 like '$email'";
   $query=$this->db->query($sql);
   $clientimage=array();
   if($query->num_rows()>0)
   {
	return true;
   }
   else
   {
	return false;
   }
  }
  public function MediaItems()
  {
   $sql="select media_title,url,publication,date_format(date_display,'%d %b %Y') as item_date from ".MEDIA_ITEMS." where status='1' order by position";
   $res=$this->db->query($sql);
   return $res->result_array();
  } 
  public function GetDonateFormAttributes($values,$unit_fund)
  {
   if(count($values) == 0)
   {
    $values=array('donor_name'=>'','amount'=>number_format($unit_fund,2),'comment'=>'','email'=>'');
   }
   $attribute=array();
   $attribute['form']=array('id'=>'donation_frm','name'=>'donation_frm','onSubmit'=>'return ValidateDonationForm();');
   
   $attribute['donor_name']=array('name'=> 'donor_name','id'=> 'donor_name','value' => $values['donor_name'],'placeholder'=>'Name',"class"=>"form-control");
   $attribute['email']=array('name'=> 'email','id'=> 'email','value' => $values['email'],'placeholder'=>'Email',"class"=>"form-control");   
   $attribute['amount']=array('name'=> 'amount','id'=> 'amount','value' => $values['amount'],"class"=>"form-control","placeholder"=>number_format($unit_fund,2));
   
	  
   $attribute['comment']=array('name'=> 'comment','id'=> 'comment','value'=>$values['comment'],'placeholder'=>'Leave a comment',"class"=>"form-control","rows"=>'3');
    $attribute['anonymous'] = array('name'=>'anonymous', 'id'=> 'anonymous', 'value'=>'yes');

    $attribute['submit']=array('type' => 'submit', 'name' => 'form_submit','id'=>'form_submit','value'=>"Give by Paypal","class"=>"btn btn-success");
   return $attribute;
  }
  public function GetDonateFormForOneTimeAttributes($values,$unit_fund,$days='1')
  {
   if(count($values) == 0)
   {
	//if(!empty($days))
	//{    
	 $values=array('amount'=>number_format(($unit_fund*$days),2));
	//}
	//else{ $values=array('amount'=>number_format($unit_fund,2)); $days=1;}
   }
 
   $attribute=array();
   $attribute['form']=array('id'=>'donation_one_time_frm','name'=>'donation_one_time_frm','onSubmit'=>'return ValidateDonationOneTimeForm();');

   $attribute['amount']=array('name'=> 'amount','id'=> 'amount','value' => $values['amount'],"class"=>"form-control","placeholder"=>number_format($unit_fund*$days,2));
   
	  

    $attribute['submit']=array('type' => 'submit', 'name' => 'form_submit','id'=>'form_submit','value'=>"Give by Paypal","class"=>"btn btn-success");
   return $attribute;
  }  
  public function GetMonthlyDonateFormAttributes($values,$unit_fund)
  {
   if(count($values) == 0)
   {
    $values=array('monthly_amount'=>number_format($unit_fund,2));
   }
   $attribute=array();
   $attribute['form']=array('id'=>'monthly_donation_frm','name'=>'monthly_donation_frm','onSubmit'=>'return ValidateMonthlyDonationForm();');

   $attribute['monthly_amount']=array('name'=> 'monthly_amount','id'=> 'monthly_amount','value' => $values['monthly_amount'],"class"=>"form-control","placeholder"=>number_format($unit_fund,2));
   
	  

    $attribute['monthly_submit']=array('type' => 'submit', 'name' => 'form_submit','id'=>'form_submit','value'=>"Give by Paypal","class"=>"btn btn-success");
   return $attribute;
  }   }
?>