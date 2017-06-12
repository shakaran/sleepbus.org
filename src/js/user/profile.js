function ValidateProfileForm()
{
 var error_count=0,error_value='',focus_field='';
 $("div #errorDiv").remove();
 $("div #error").remove();
 var full_name=trim($("#full_name").val());
 var new_email=trim($("#new_email").val());
 var retype_email=trim($("#retype_email").val());
 var phone=trim($("#phone").val());
 var current_password=trim($("#current_password").val());
 var new_password=trim($("#new_password").val());
 var retype_password=trim($("#retype_password").val());
 
 if(full_name == "") 
 {
  focus_field="full_name";
  error_value="Please enter your name";
 }
 else if((phone !="") && ((!ValidatePhone(phone))))
 {
  focus_field="phone";
  error_value="Invalid phone number";

 }
 else if((new_email !="") && ((ValidateEmail(new_email)==false)))
 {
  focus_field="new_email";
  error_value="Invalid email address";
 }
 else if((new_email !="") && (new_email != retype_email))
 {
  focus_field="retype_email";
  error_value="new email and confirm email id do not match";
 }

 if(error_value != "")
 {
  var header_height=$("div#header-band").height()+100;	 
  //var header_height=20;	 
  $('html, body').animate({scrollTop: $("#profilefrom").offset().top-header_height}, 600); 
  var errorDiv=$("<div />",{"class":"has-error","text":error_value,"id":"error"})	 
  $("div #profilefrom").prepend(errorDiv);
  $("#"+focus_field).focus();
  return false;
 }
 else return true; 
}
function ValidatePhone(phone)
{
 var len = phone.length;
 var phone_error=false;
 for(var i=0; i < len; i++) 
 {
  char = phone.charAt(i);
  if(isNaN(char) && (char != '(' ) && (char != ')' ) && (char != ' ' )&& (char != '+' )) 
  {
   return false
  }
 } 
 return true;
}