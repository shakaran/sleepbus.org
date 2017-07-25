<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Account_model extends CI_Model

 {

  function __construct()

  {

   parent ::__construct();	

  }  

  public function GetSignUpFormAttributes($values=array())
  {
   if(count($values) == 0)
   {
    $values=array('full_name'=>'','other_type'=>'','email'=>'','password'=>'','account_type'=>'','newsletter_subscription'=>'');  

   }  

    $attribute['form'] = array('onSubmit'=>'return ValidateAccountSignupForm();' ,'name'=>'signup_frm');

    $attribute['full_name'] = array('name'=>'full_name', 'id'=> 'full_name', 'value'=>$values['full_name'],'placeholder'=>'Enter your full name','class'=>'form-control');

    $attribute['email'] = array('name'=>'email', 'id'=> 'email', 'value'=>$values['email'],'placeholder'=>'Enter your email','class'=>'form-control');

    $attribute['password'] = array('name'=>'password', 'id'=> 'password', 'value'=>$values['password'],'placeholder'=>'Enter a password','class'=>'form-control');

/*	if($values['agree'] == 'yes') $checked=true;else $checked=false;

    $attribute['agree'] = array('name'=>'agree', 'id'=> 'agree', 'value'=>'yes','checked'=>$checked);

*/

   $account_type['']="Please select";

   if(count($this->GetAccountType()) > 0)

   {

    foreach($this->GetAccountType() as $sources)

    {

     $account_type[$sources['id']]="&nbsp;&nbsp;".$sources['type_name'];

    }

   }

   $account_type['other']="&nbsp;&nbsp;Other";

   $attribute['account_type']=$account_type;

   $attribute['account_type_value']=$values['account_type'];



	

    $attribute['other_type'] = array('name'=>'other_type', 'id'=> 'other_type', 'value'=>$values['other_type'],'placeholder'=>'Other = Please specify','class'=>'form-control');

	

	if($values['newsletter_subscription'] == '1') $checked=true;else $checked=false;

    $attribute['newsletter_subscription'] = array('name'=>'newsletter_subscription', 'id'=> 'newsletter_subscription', 'value'=>'1','checked'=>$checked);

	

	

    $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Sign Up','class'=>'btn btn-primary');

   

   return $attribute;

  }

  public function GetAccountType()

  {

   return $this->db_query->FetchInformation(ACCOUNT_TYPE,"","status='1' order by position"); 

  }

  public function GetAccountTypeDetails($account_type_id)

  {

   return $this->db_query->FetchSingleInformation(ACCOUNT_TYPE,"","id='".$account_type_id."' order by position"); 

  } 

  public function GetSignInFormAttributes($values=array())

  {

   if(count($values) == 0)

   {

    $values=array('site_username'=>'','site_password'=>'');  

   }  

    $attribute['form'] = array('onSubmit'=>'return ValidateAccountSigninForm();' ,'name'=>'signin_frm');

    $attribute['site_username'] = array('name'=>'site_username', 'id'=> 'site_username', 'value'=>$values['site_username'],'placeholder'=>'Email',"class"=>'form-control');

    $attribute['site_password'] = array('name'=>'site_password', 'id'=> 'site_password', 'value'=>$values['site_password'],'placeholder'=>'Password',"class"=>'form-control');

    $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'SIGN IN','class'=>'btn btn-primary');

   return $attribute;

  }

  public function CheckUser($username,$password)
  {
   $user_info = $this->db_query->FetchSingleInformation(USERS, "", "binary email='$username' and status='1'");
   if (count($user_info) == 0) {
     return $user_info;
   }
   
   if (password_verify($password, $user_info['password'])) {
     return $user_info;	   
   }
   
   if (md5($password) == $user_info['password']) {
	 // Login from account without bcrypt still needs to be supported. Because we know this password is correct
	 // for this account, we can update it to the bcrypt version for a gradual shift in user password storage.
     $records = array();
     $records['password'] = password_hash($password, PASSWORD_DEFAULT);

     $this->db->where('email', $username);
     $this->db->update(USERS, $records);
     // Dont pass back the md5 version anymore.
	 return $this->db_query->FetchSingleInformation(USERS, "", "binary email='$username' and status='1'");
   }
   
   return $user_info;
  } 

  

  public function GetForgotPasswordFormAttributes($values=array())

  {

   if(count($values) == 0)

   {

    $values=array('email'=>'');  

   }  

   $attribute['form'] = array('onSubmit'=>'return ValidateForgotPasswordForm();' ,'name'=>'forgot_password_frm');

   $attribute['email'] = array('name'=>'email', 'id'=> 'email', 'value'=>$values['email'],'placeholder'=>'Enter your email','class'=>"form-control");

   $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Send Reset Link','class'=>'btn btn-primary');

   return $attribute;

  }

  

  public function InsertUserInformation($record)

  {

   $records=$this->db_query->TrimValues($record);

   $records['dateadded']=date("Y-m-d h:i:s");

   $this->db->insert(USERS,$records);

  }

  public function SubscribePackage($user_id,$package_id)

  {

   $packages=array(); 

   $packages['user_id']=$user_id;

   $sql="select p.id,p.time_period,p.price,p.store_allowed,p.intro_text,p.feature,c.promo_code,c.discount_type,c.discount_value from ".PACKAGES." p left join ".PROMO_CODES." c on p.promo_code_id=c.id where p.status='1' and p.id='".$package_id."'";

   $res=$this->db->query($sql);

   $i=0;

   if($res->num_rows > 0)

   {

    foreach($res->result() as  $row)

	{

     $packages['package_id']=$row->id;

	}

   }    

   $packages['status']='pending';

   $packages['dateadded']=date("Y-m-d h:i:s");

   

   $this->db->insert(USER_TO_PACKAGE_SUBSCRIPTION,$packages);

  }

  public function UpdateForgotPassword($record,$email)

  {

   $records=$this->db_query->TrimValues($record);

   $this->db->where('email',$email);

   $this->db->update(USERS,$records);

  }

  public function ResetUserPassword($record,$reset_link)

  {

   $records=$this->db_query->TrimValues($record);

   $this->db->where('reset_link',$reset_link);

   $this->db->update(USERS,$records);

  } 

  public function IsUserExist($email)

  {

   $sql="select id from ".USERS." where email='".$email."' and status='1'";

   $res=$this->db->query($sql); 

   if($res->num_rows() > 0)

   return true;

   else return false;

  }

  public function CheckResetLink($reset_link)

  {

   $sql="select id from ".USERS." where reset_link='".$reset_link."' and status='1'";

   $res=$this->db->query($sql); 

   if($res->num_rows() > 0)

   return true;

   else return false;

  }

  public function GetConfirmationInfo($confirmation_code)

  {

   return $this->db->select('status,id,type_id')->from(USERS)->where('confirmation_code',$confirmation_code)->get()->row_array();

  }

  public function UpdateSignUpStatus($user_id)

  {

   $sql="update ".USERS." set status='1',profile_stage='1' where id='".$user_id."'";

   $this->db->query($sql); 

  }

  public function UpdateSignUpUserStatus($user_id)

  {

   $sql="update ".USERS." set status='1',profile_stage='0' where id='".$user_id."'";

   $this->db->query($sql); 

  }

  

  

  public function VerifyPackage($package_id)

  {

   if(empty($package_id) or !ctype_digit(strval($package_id))) return false;

   else

   {

    $sql="select id  from ".PACKAGES." where status='1' and id='".$package_id."'";

	$res=$this->db->query($sql);

	if($res->num_rows > 0) return true;

	else return false;

   }

  }

  public function GetRenewalCheck($user_id)

  {

   return $this->db->select('renewal')->from(USER_TO_PACKAGE_SUBSCRIPTION)->where('user_id',$user_id)->get()->row_array();

  }

  public function GetResetPasswordFormAttributes($values=array())

  {

   if(count($values) == 0)

   {

    $values=array('retype_password'=>'','reset_password'=>'');  

   }  

    $attribute['form'] = array('onSubmit'=>'return ValidateResetPasswordForm();' ,'name'=>'reset_password_frm');

    $attribute['reset_password'] = array('name'=>'reset_password', 'id'=> 'reset_password', 'value'=>$values['reset_password'],'placeholder'=>'New Password',"class"=>'form-control');

    $attribute['retype_password'] = array('name'=>'retype_password', 'id'=> 'retype_password', 'value'=>$values['retype_password'],'placeholder'=>'Retype Password',"class"=>'form-control');

    $attribute['submit'] = array('name' => 'submit_value','id' => 'submit_value','value' => 'Reset','class'=>'btn btn-primary');

   return $attribute;

  }

 

 }

?>
