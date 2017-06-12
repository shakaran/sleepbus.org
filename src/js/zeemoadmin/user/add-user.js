// JavaScript Document
var ValidateUserForm=function() 
{
 var errors=new Array("error1","error2","error3","error4","error5");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 var password=$("#pword").val();
 var confirm_password=$("#confirm_password").val();
 var email=trim($("#email").val());
 var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;

 if($("#action").val() == "Submit")
 {
  if(trim($("#level_id").val())== "") 
  {
   errorFields[e]=new Array("error5","Please select the desired level","level_id");
   e++;
  }else RemoveError("level_id");
  if(trim($("#uname").val())== "") 
  {
   errorFields[e]=new Array("error1","Please enter username","uname");
   e++;
  }else RemoveError("uname");
  if(password == "") 
  {
   errorFields[e]=new Array("error2","Please enter password","pword");
   e++;
  }
  else if(password !="" && password.length < 10)
  {
   errorFields[e]=new Array("error2","Password should not be less than of 10 characters","pword");
   e++;
  }else RemoveError("pword");
  if(confirm_password=="") 
  {
   errorFields[e]=new Array("error3","Please enter re-enter password","confirm_password");
   e++;
  }else RemoveError("confirm_password");
  if(errorFields.length == 0)
  {
   if((password !="" && confirm_password != "") && (password != confirm_password))
   {
    errorFields[e]=new Array("error2","Password and confirm password did not match","confirm_password");
    e++;
   }else RemoveError("confirm_password");
  }
 
 }
 if($("#action").val() == "Update")
 {  
  if($("#user_id").val() !=1 || $("#called_by").val() != "validateaccountinfo")
  {
   if(trim($("#level_id").val())== "") 
   {
    errorFields[e]=new Array("error5","Please select the desired level","level_id");
    e++;
   }else RemoveError("level_id");
  }
  if(password !="" ||  confirm_password != "")
  {
   if(password == "") 
   {
    errorFields[e]=new Array("error2","Please enter password","pword");
    e++;
   }
   else if(password !="" && password.length < 10)
   {
    errorFields[e]=new Array("error2","Password should not be less than of 10 characters","pword");
    e++;
   }else RemoveError("pword");
   if(confirm_password=="") 
   {
    errorFields[e]=new Array("error3","Please enter re-enter password","confirm_password");
    e++;
   }else RemoveError("confirm_password");
   if((password !="" && confirm_password != "") && (password != confirm_password))
   {
    errorFields[e]=new Array("error2","Password and confirm password did not match","confirm_password");
    e++;
   }else RemoveError("confirm_password");
  }
  else{RemoveError("pword");RemoveError("confirm_password");}  
 }
 
 if(email == "") 
 {
  errorFields[e]=new Array("error4","Please enter email address","email");
  e++;
 }
 else if(!pattern.test(email))
 {
  errorFields[e]=new Array("error4","Please enter a valid email address","email");
  e++;
 } else RemoveError("email");

 return ShowErrorOnField(errorFields);
}
