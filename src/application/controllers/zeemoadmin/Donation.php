<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
 class Donation extends MY_Controller
 {
  function __construct()
  {
   parent :: __construct();
   $this->load->Model(admin.'/Donation_model');
   $this->load->helper('form');
   $this->load->library('form_validation');
   $this->load->library('CommonFunctions');
  }
  public function donate()
  {
   $this->session->unset_userdata('form_data');	  
   $submit_value=$this->input->post('submit_form');
   $values=array();
   if(!empty($submit_value))
   {
	$records['content']=$this->input->post('content');
    $this->Login_model->UpdateTopText($records,14);
	$this->RedirectPage(admin.'/donation/donate','Content of donate page has been updated successfully');
    exit;
   }
   else
   {
    $values=$this->Login_model->GetTopText(14);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,14);
   $this->data['attributes']=$this->Donation_model->GetTopTextFormAttribute($values);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/donation/donate',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function one_year_safe_sleep()
  {
   $this->session->unset_userdata('form_data');
   $submit_value=$this->input->post('submit_form');
   $values1=array();
   $values2=array();   
   if(!empty($submit_value))
   {
	$records['content']=$this->input->post('content1');
    $this->Login_model->UpdateTopText($records,15);
	
	$records['content']=$this->input->post('content2');
    $this->Login_model->UpdateTopText($records,16);
	
	$this->RedirectPage(admin.'/donation/one-year-safe-sleep','One year safe sleep content has been updated successfully');
    exit;
   }
   else
   {
    $values1=$this->Login_model->GetTopText(15); 
    $values2=$this->Login_model->GetTopText(16);    
   }
   $this->SetUpCkeditor(); 
   $this->data['last_modified']=$this->Login_model->LastModify(TOP_TEXT,15);
   $this->data['attributes']=$this->Donation_model->GetOneYearSafeSleepFormAttribute($values1,$values2);
   $this->adminjavascript->include_admin_js=array('SuccessMessageJs');
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/donation/one-year-safe-sleep',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function add_item($values=array())
  {
   $this->session->unset_userdata('form_data');
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs','ValidateDonationFormJs');
   // $this->admincss->including_css_func = array('CalendarCss'); 
   if(count($values) > 0)
   {
    $this->data['title'] .= $values['title']; //this is meta title
	$this->data['page_title'] = $values['page_title']; //this is page heading
   }
   else
   {
    $values['donation_title'] = '';
   $values['intro_text']="";	
	
	$this->data['page_title'] = 'Add an Item';
	$this->data['file_error'] = '';
   }
   if(!empty($this->data['edit_id'])) $this->data['attributes'] = $this->Donation_model->GetDonationFormAttribute($values,$this->data['edit_id']);
   else $this->data['attributes'] = $this->Donation_model->GetDonationFormAttribute($values);
   $this->SetUpCkeditor(); 
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/donation/add-donation',$this->data);
   $this->load->view(admin.'/templates/footer');
  }  
  
  public function validate_donation()
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('donation/add-item');
   $this->data['active_submodule'] = 'add-item';

   $this->form_validation->set_error_delimiters('<span>','</span>');
   $this->form_validation->set_message('required','{field}');
   $this->form_validation->set_message('is_unique','Item title already exists');

   $values = array();
   $file_uploaded = FALSE;

   $submit_value = $this->input->post('submit_value');   
   $values['title'] = 'Validate Item';   
   $values['donation_title'] = $this->input->post('donation_title');
   $values['intro_text'] = $this->input->post('intro_text');

   if($submit_value=='Update')
   {
    $values['page_title'] = 'Edit Item'; //this is page heading
	$edit_id = $this->input->post('edit_id');
    $this->data['edit_id'] = $edit_id;
    
	$this->form_validation->set_rules('donation_title', 'Please enter title', 
	'trim|required|callback_is_unique_with_condition['.SUPPORTS.'~donation_title~id !='.$edit_id.'~donation]');
   }
   if($submit_value=='Submit')
   {
    $values['page_title'] = 'Add an Item'; //this is page heading
    //$this->form_validation->set_rules('donation_title', '', 'trim|required|is_unique['.SUPPORTS.'.donation_title]');

	$this->form_validation->set_rules('donation_title', 'Please enter title', 
	'trim|required|is_unique['.SUPPORTS.'.donation_title]');
    
   }
   $this->form_validation->set_rules('intro_text', 'Please enter introduction text', 'trim|required');

 
   if($this->form_validation->run()==FALSE) 
   {
	$this->add_item($values);
   }
   else
   {
    $records['donation_title'] = $values['donation_title'];
    $records['intro_text'] = $values['intro_text'];

    if($submit_value=='Update')
	{
	 $this->Donation_model->UpdateDonation($records,$edit_id);
	 $this->RedirectPage(admin.'/donation/manage-items/','Item updated successfully');
	}
	else
	{
     //genereate donation url

	 $edit_id=$this->Donation_model->InsertDonation($records);
	 $this->RedirectPage(admin.'/donation/manage-items','Item added successfully');
	}
   }
  }
  public function edit_donation($edit_id)
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('donation/add-item');	  
   $this->data['active_submodule'] = "add-item";
   $this->data['last_modified'] = $this->Login_model->LastModify(SUPPORTS,$edit_id);   

   $values = array();
   $values = $this->Donation_model->GetDonationDetails($edit_id);
   $values['page_title'] = 'Edit Item';
   $values['title'] = 'Edit Item';
   $values['submit_value'] = 'Update';
   $this->data['edit_id'] = $edit_id;
   $this->add_item($values);
  }
  public function manage_items()
  {
   $this->adminjavascript->include_admin_js = array('SuccessMessageJs','DragDropJs');
   
   $this->data['donation_list'] = array();
   $this->data['donation_list'] = $this->Donation_model->GetDonationList();

   if(count($this->data['donation_list']) > 0)
   {
    // Arguments for GetAtributesForDeletion function : 
    // 1. item list to be deleted, 
    // 2. which type of item to be deleted, 
    // 3. single delete permission-> value would be 'yes' or 'no' and 
    // 4. parent_id if you have(optional);
    	
    $this->data['attribute'] = $this->Login_model->GetAtributesForDeletion($this->data['donation_list'],'item','no');
   }
   
   
  
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/donation/manage-donations',$this->data);
   $this->load->view(admin.'/templates/footer');
  }  
  
  public function reporting()
  {
   $this->data['active_submodule']="reporting";
   $this->data['reports_type']="";
   $this->adminjavascript->include_admin_js=array('CalendarJs');
   $this->admincss->including_css_func=array('CalendarCss');   
   $form_data=array();
   $form_data=$this->session->userdata('form_data');
   if($this->input->server('REQUEST_METHOD') === 'POST')
   {
 	$this->data['f_rangeStart']=$this->input->post('f_rangeStart');
	$this->data['to_rangeStart']=$this->input->post('to_rangeStart');
	$this->data['reports_type']=$this->input->post('reports_type');
	$form_data['f_rangeStart']=$this->data['f_rangeStart'];
	$form_data['to_rangeStart']=$this->data['to_rangeStart'];
	$form_data['reports_type']=$this->data['reports_type'];
	$this->session->set_userdata('form_data',$form_data);
   }
   elseif(count($form_data) > 0)
   {
 	$this->data['f_rangeStart']=$form_data['f_rangeStart'];
	$this->data['to_rangeStart']=$form_data['to_rangeStart'];
	$this->data['reports_type']=$form_data['reports_type'];
   }
   else
   {
 	$this->data['f_rangeStart']="01-".date("m-Y",@mktime());
	$this->data['to_rangeStart']=date("d-m-Y",@mktime());
    $this->data['reports_type']="";
   }
   $from_date=$this->commonfunctions->ChangeDateFormat($this->data['f_rangeStart']);
   $to_date=$this->commonfunctions->ChangeDateFormat($this->data['to_rangeStart']);
   
    $this->data['list_records']=$this->Donation_model->GetDonationReport($from_date,$to_date,$this->data['reports_type']);
   
    $this->data['total_donations']=array();
	$this->data['total_donations']=$this->Donation_model->GetTotalDonation($from_date,$to_date,$this->data['reports_type']); 
   
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/donation/donation-report',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function donation_details($donation_id)
  {
   $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('donation/reporting');
   $this->data['active_submodule'] = "reporting";
   $this->data['donation_id']=$donation_id;
   $this->data['donation_details']=$this->Donation_model->GetDonationDetails($this->data['donation_id']);
   $this->load->view(admin.'/templates/header',$this->data);
   $this->load->view(admin.'/donation/donation-details',$this->data);
   $this->load->view(admin.'/templates/footer');
  }
  public function download_excel() {
	   $from=$this->commonfunctions->ChangeDateFormat($this->uri->segment(4));
	    $to=$this->commonfunctions->ChangeDateFormat($this->uri->segment(5));
		$type=urldecode($this->uri->segment(6));
   		$list_records=$this->Donation_model->GetDonationReport($from,$to,$type);
		$XML = "Type \t Payer Email \t Donation Amount \t Date(MM/DD/YYYY Hour: Minute)\t  \n";
			foreach($list_records as $lr) {
			$XML.= $lr['donation_type']. "\t";
			$XML.= $lr['payer_email']. "\t";
			$XML.= "$".$lr['donation']. "\t";
			$XML.= $lr['donation_date']. "\t \n";
		 }
		$file='donation-report-'.$from.'-to-'.$to.'.xls';
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$file);
		echo $XML;
  }
  
  public function changestatus($record_id, $status, $section, $parent_id = '', $edit_id = '')
  {
   $section = str_replace("_","-",$section); 
   
   if($section=='manage-items')
   {
    $this->data['sub_modules'] = $this->CheckSubModuleAccessibility('donation/manage-items');
    $this->Login_model->ChangeStatus(SUPPORTS,$record_id,$status);
    $this->session->set_flashdata('success_message','Status of donation changed successfully');
   }

   if(!empty($parent_id)) $section .= '/'.$parent_id; 
   if(!empty($edit_id)) $section .= '/'.$edit_id;

   header("location:".base_url().admin."/donation/$section");
   exit;
  } 
  
  
  // mandatory Function for each module
  public function ConfirmDelete($checked_id, $item_name, $parent_id = '', $edit_id = '') 
  {
   $this->adminjavascript->include_admin_js = array('ConfirmDeleteJs');
   
   if($item_name=='item') 
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('donation/manage-items');	  	  
   
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_id, $item_name, $parent_id);
   if($edit_id != '')
   {
    $attributes2 = array('edit_id' => $edit_id);
    $this->data['attributes']['hidden'] = array_merge($this->data['attributes']['hidden'],$attributes2);
   }
   /*
   If you have any additional attribute item wise then you can merge it as follows  : 
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   If you have any custom message other than common message item wise then assign message to data variable as follows
   Default message
   */
   if($item_name == "donation_image_delete")
   {
	$this->data['message']="Are you sure want to delete this image.";
   }
   elseif($item_name == "remove_clone")
   {
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('donation/manage-donation');	  	  
	$this->data['message']="Are you sure want to unlink this donation from selected donation.";
   }
   else
   {
    $this->data['message'] = "Are you sure you want to delete selected items";
   }
   $this->load->view(admin.'/templates/confirm-delete',$this->data);
  }
  
  //mandatory Function for each module
  public function ConfirmSuperadmin($checked_ids, $item_name, $parent_id='', $edit_id='') 
  {
   if($item_name=='item') 
    $this->data['sub_modules']=$this->CheckSubModuleAccessibility('donation/manage-items');	  	  
   else if($item_name=='image') $this->data['sub_modules']=$this->CheckSubModuleAccessibility('donation/manage-images');	  	     
   
   $this->data['attributes']=$this->Login_model->GetDeletionPopUpAttributes($checked_ids, $item_name, $parent_id);
   
   if($edit_id != '')
   {
    $attributes2 = array('edit_id'=>$edit_id);
    $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   }
   /*
   If you have any additional attribute item wise then you can merge it as follows  : 
   $attributes2=array('field1'=>'value1','field2'=>'value2');
   $this->data['attributes']['hidden']=array_merge($this->data['attributes']['hidden'],$attributes2);
   If you have any custom message other than common message item wise then assign message to data variable as follows
   Default message
   */
   if($item_name=='item') $this->data['message'] = "Are you sure you want to delete all selected item(s)";
   else $this->data['message'] = "Are you sure you want to delete all selected item(s)";
      
   $this->adminjavascript->include_admin_js = array('SuperAdminValidationJs');
   $this->admincss->including_css_func = array('PrettyPhotoCss');  
   $this->load->view(admin.'/templates/superadmin-delete',$this->data);
  }
  
  //mandatory Function for each module
  public function DeleteRecord($checked_ids, $item_name, $parent_id = '', $edit_id = '') 
  {
   $item_name = urldecode($item_name);
   $all_ids = explode("~",$checked_ids);
   
   // Delete Record item wise and redirect the page to repective module with success message
   if($item_name=="item")
   {
    if(count($all_ids) > 0)
	{
	 $this->Donation_model->DeleteDonations($all_ids, $parent_id);
	 $this->RedirectPage(admin.'/donation/manage-items', 'Selected donation item(s) deleted successfully');
	}
   } 
  }    
  
 }

