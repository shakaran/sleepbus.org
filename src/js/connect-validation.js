ValidateConnectForm = function()
{
 var field_values= new Array(),error_count=0,error_value,focus_field;
 $("div #errorDiv").remove();
 $("div #error").remove();
 field_values[0]=new Array($.trim($("#name").val()),'name','Please enter your name','Name');
 field_values[1]=new Array($.trim($("#email").val()),'email','Please enter email address','Email');

 field_values[2]=new Array($.trim($("#phone").val()),'phone','Please enter phone number','Phone');
 
 
 field_values[3]=new Array($.trim($("#hear_about_us").val()),'hear_about_us',"Please select 'How did you find out about us?'");


 $.each(field_values,function(key,value){


 if((value[0] == "" || value[0] == value[3]) && (value[1] !="message"))
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
  else if(value[1] == "phone" && (!ValidatePhone($("#phone").val())))
  {
   if(error_count == 0){ error_value="Please enter valid phone number"; focus_field=value[1];}
   error_count++;
  }
  
/*  else if((value[1] == "message") && ((value[0] != "") && (value[0] != value[3])) && (ValidateMessageText(value[0])==false))
  {
   if(error_count == 0) {error_value=value[2]; focus_field=value[1];}
   error_count++;
  }
*/else
  {
   $("#"+value[1]).removeClass('field_error');
  }
 })
 if(error_count > 0)
 {
  var header_height=$("div#header-band").height()+100;	 
  //var header_height=20;	 
  $('html, body').animate({scrollTop: $("#enquiriesfrom").offset().top-header_height}, 600); 
  var errorDiv=$("<div />",{"class":"has-error","text":error_value,"id":"error"})	 
  $("div #enquiriesfrom").prepend(errorDiv);
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