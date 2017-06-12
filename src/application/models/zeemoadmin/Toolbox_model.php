<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Toolbox_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();	
  }
  public function GetTopTextFormAttribute($values)
  {
   $attribute['form'] = array('onSubmit'=>'return true;');
   $attribute['content']=array('name'=> 'content','id'=> 'content_id','value'=>$values['content']);
   $attribute['submit'] = array('name' => 'submit_form','id' => 'submit_form','value' => 'Submit');
   return $attribute;
  }

 } 
?> 
