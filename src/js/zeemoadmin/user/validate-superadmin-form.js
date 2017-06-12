var ValidateSuperadminForm=function() 
{
 var errors=new Array("error1","error2","error3");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 var old_password=$("#old_password").val();
 var password=$("#new_password").val();
 var confirm_password=$("#confirm_password").val();

 if(old_password == "") 
 {
  errorFields[e]=new Array("error1","Please enter old password.","old_password");
  e++;
 }else RemoveError("old_password");
 if(password == "") 
 {
  errorFields[e]=new Array("error2","Please enter new password.","new_password");
  e++;
 }
 else if(password !="" && password.length < 10)
 {
  errorFields[e]=new Array("error2","Password should not be less than of 10 characters","new_password");
  e++;
 }else RemoveError("new_password");
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
 return ShowErrorOnField(errorFields);
} 


function AskForNewPassword()
{
 $.prettyPhoto.open("ConfirmForNewSuperadminPassword&iframe=true&width=294&height=136"); 
}

$(document).ready(function() { 	 
 $("#option1").click(function() 
 {
  parent.location="GenerateSuperadminPassword";
  parent.$.prettyPhoto.close();
 });
	
});
