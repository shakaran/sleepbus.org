<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Pledge_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }  
  public function GetPledgeFormAttributes($values=array())
  {
   if(count($values) == 0)
   {
    $values=array('full_name'=>'','month'=>'','day'=>'','year'=>'','email'=>'','newsletter_subscription'=>'0');  
   }  
    $attribute['form'] = array('onSubmit'=>'return ValidatePledgeForm();' ,'name'=>'pledge_frm');
    $attribute['full_name'] = array('name'=>'full_name', 'id'=> 'full_name', 'value'=>$values['full_name'],'placeholder'=>'Full name','class'=>'form-control');
    $attribute['email'] = array('name'=>'email', 'id'=> 'email', 'value'=>$values['email'],'placeholder'=>'Email','class'=>'form-control');
    $attribute['month'] = array('name'=>'month', 'id'=> 'month', 'value'=>$values['month'],'placeholder'=>'MM','class'=>'form-control','maxlength'=>'2');
    $attribute['year'] = array('name'=>'year', 'id'=> 'year', 'value'=>$values['year'],'placeholder'=>'YYYY','class'=>'form-control','maxlength'=>'4');
    $attribute['day'] = array('name'=>'day', 'id'=> 'day', 'value'=>$values['day'],'placeholder'=>'DD','class'=>'form-control','maxlength'=>'2');


	
	if($values['newsletter_subscription'] == '1') $checked=true;else $checked=false;
    $attribute['newsletter_subscription'] = array('name'=>'newsletter_subscription', 'id'=> 'newsletter_subscription', 'value'=>'1','checked'=>$checked);
	
	
    $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Pledge Now','class'=>'btn btn-primary');
   
   return $attribute;
  }
  public function VerifyBirthdayPledge()
  {
   $sql="select id from ".CAMPAIGN_TYPE." where id='1' and status='1'";
   $res=$this->db->query($sql);
   if($res->num_rows() > 0) return true; else return false;
  }
 }
?>