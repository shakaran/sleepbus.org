ValidateAccountSigninForm = function()
{
 var field_values= new Array(),error_count=0,error_value,focus_field;
 $("div #errorDiv").remove();
 $("div #error").remove();
 field_values[0]=new Array($.trim($("#site_username").val()),'site_username','Please enter email address','Email');

 field_values[1]=new Array($.trim($("#site_password").val()),'site_password','Please enter your password','Password');
 

 $.each(field_values,function(key,value){


 if((value[0] == "" || value[0] == value[3]))
  {
   $("#"+value[1]).addClass('field_error');
   if(error_count == 0){ error_value=value[2]; focus_field=value[1];}
   error_count++;
  }
  else if(value[1] == "email" && (ValidateEmail(value[0])==false))
  {
   if(error_count == 0) {error_value="Please enter valid email address"; focus_field=value[1];}
   error_count++;
  }
  else
  {
   $("#"+value[1]).removeClass('field_error');
  }
 })
 
 if(error_count > 0)
 {
  var header_height=$("div#header-band").height()+100;	 
  //var header_height=20;	 
  $('html, body').animate({scrollTop: $("#signinfrom").offset().top-header_height}, 600); 
  var errorDiv=$("<div />",{"class":"has-error","text":error_value,"id":"error"})	 
  $("div #signinfrom").prepend(errorDiv);
  $("#"+focus_field).focus();
  return false;
 }
 else return true;
}
$("#toggle-view").click(function(){
	 if($(this).text() == "Show")
	 {
	  document.getElementById("site_password").type='text';
	  $(this).text('Hide');
	 }
	 else
	 {
	  document.getElementById("site_password").type='password';
	  $(this).text('Show');
	 }
	 
	})
$("#account_type").change(function(){
	if($(this).val() == 'other')
	{
	 $("#other_access").show();
	}
	else
	{
	 $("#other_access").hide();
	}
	})
	
ValidateForgotPasswordForm = function()
{
 var field_values= new Array(),error_count=0,error_value,focus_field;
 $("div #errorDiv").remove();
 $("div #error").remove();
 field_values[0]=new Array($.trim($("#email").val()),'email','Please enter email address','Enter your email');


 $.each(field_values,function(key,value){


 if((value[0] == "" || value[0] == value[3]))
  {
   $("#"+value[1]).addClass('field_error');
   if(error_count == 0){ error_value=value[2]; focus_field=value[1];}
   error_count++;
  }
  else if(value[1] == "email" && (ValidateEmail(value[0])==false))
  {
   if(error_count == 0) {error_value="Please enter valid email address"; focus_field=value[1];}
   error_count++;
  }
  else
  {
   $("#"+value[1]).removeClass('field_error');
  }
 })
 
 if(error_count > 0)
 {
  var header_height=$("div#header-band").height()+100;	 
  //var header_height=20;	 
  $('html, body').animate({scrollTop: $("#forgotfrom").offset().top-header_height}, 600); 
  var errorDiv=$("<div />",{"class":"has-error","text":error_value,"id":"error"})	 
  $("div #forgotfrom").prepend(errorDiv);
  $("#"+focus_field).focus();
  return false;
 }
 else return true;
}

ValidateResetPasswordForm = function()
{
 var field_values= new Array(),error_count=0,error_value,focus_field;
 $("div #errorDiv").remove();
 $("div #error").remove();
 field_values[0]=new Array($.trim($("#reset_password").val()),'reset_password','Please enter new password','New password');

 field_values[1]=new Array($.trim($("#retype_password").val()),'retype_password','Please retype password','Retype password');
 
 var reset_password=$.trim($("#reset_password").val());
 var retype_password=$.trim($("#retype_password").val()); 

 $.each(field_values,function(key,value){


 if((value[0] == "" || value[0] == value[3]))
  {
   $("#"+value[1]).addClass('field_error');
   if(error_count == 0){ error_value=value[2]; focus_field=value[1];}
   error_count++;
  }
  else if(value[1] == "reset_password" && (value[0].length < 6))
  {
   if(error_count == 0) {error_value="Length of password must be of 6 or more characters"; focus_field=value[1];}
   error_count++;
  }
  
  else
  {
   $("#"+value[1]).removeClass('field_error');
  }
 })
 if((reset_password !='') && (retype_password != "") && (reset_password !=retype_password)) 
 {
  if(error_count == 0){ error_value="Please new password and retype password don't match"; focus_field='retype_password';}
  error_count++;
 }
 else
 {
  $("#retype_password").removeClass('field_error');
 }
 
 if(error_count > 0)
 {
  var header_height=$("div#header-band").height()+100;	 
  //var header_height=20;	 
  $('html, body').animate({scrollTop: $("#signinfrom").offset().top-header_height}, 600); 
  var errorDiv=$("<div />",{"class":"has-error","text":error_value,"id":"error"})	 
  $("div #signinfrom").prepend(errorDiv);
  $("#"+focus_field).focus();
  return false;
 }
 else return true;
}
