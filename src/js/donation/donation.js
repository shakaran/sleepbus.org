ValidateDonationForm = function()
{
 var error_count=0,error_value='',focus_field='';
 $("div #errorDiv").remove();
 $("div #error").remove();
 var donor_name=trim($("#donor_name").val());
 var amount=trim($("#amount").val());
 var email=trim($("#email").val());
 
 
 if(amount == "" )
 {
  focus_field="amount";
  error_value="Please enter donation amount";
 }
 else if(!Number(amount))
 {
  focus_field="amount";
  error_value="Please enter valid amount";
 } 
 else if((donor_name == "" ) || (donor_name == "Name")) 
 {
  focus_field="donor_name";
  error_value="Please enter name";
 } 
 else if((email == "" ) || (email == "Email")) 
 {
  focus_field="email";
  error_value="Please enter email";
 } 
 else if((email !="") && ((ValidateEmail(email)==false)))
 {
  focus_field="email";
  error_value="Invalid email address";
 }
 

 if(error_value != "")
 {
  var header_height=$("div#header-band").height()+100;	 
  //var header_height=20;	 
  $('html, body').animate({scrollTop: $("#donatefrom").offset().top-header_height}, 600); 
  var errorDiv=$("<div />",{"class":"has-error","text":error_value,"id":"error"})	 
  $("div #donatefrom").prepend(errorDiv);
  $("#"+focus_field).focus();
  return false;
 }
 else return true; 
}

ValidateDonationOneTimeForm = function()
{
 var error_count=0,error_value='',focus_field='';
 $("div #errorDiv").remove();
 $("div #error").remove();
 var amount=trim($("#amount").val());
 
 
 if(amount == "")
 {
  focus_field="amount";
  error_value="Please enter donation amount";
 }
 else
 {
  amount=amount.replace(",","");	 
  if(!Number(amount))
  {
   focus_field="amount";
   error_value="Please enter valid amount";
  }
 }

 if(error_value != "")
 {
  var header_height=$("div#header-band").height()+150;	 
  //var header_height=20;	 
  $('html, body').animate({scrollTop: $("#donatefrom").offset().top-header_height}, 600); 
  var errorDiv=$("<div />",{"class":"has-error","text":error_value,"id":"error"})	 
  $("div #donatefrom").prepend(errorDiv);
  $("#"+focus_field).focus();
  return false;
 }
 else return true; 
}

