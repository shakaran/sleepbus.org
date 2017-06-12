ValidateMonthlyDonationForm = function()
{
 var error_count=0,error_value='',focus_field='';
 $("div #errorDiv2").remove();
 $("div #error2").remove();
 var amount=trim($("#monthly_amount").val());
 
 
 if(amount == "")
 {
  focus_field="monthly_amount";
  error_value="Please enter amount";
 }
 else
 {
  amount=amount.replace(",","");	 
  if(!Number(amount))
  {
   focus_field="monthly_amount";
   error_value="Please enter valid amount";
  }
 }

 if(error_value != "")
 {
  var header_height=$("div#header-band").height()+150;	 
  //var header_height=20;	 
  $('html, body').animate({scrollTop: $("#donatemonthlyfrom").offset().top-header_height}, 600); 
  var errorDiv=$("<div />",{"class":"has-error","text":error_value,"id":"error2"})	 
  $("div #donatemonthlyfrom").prepend(errorDiv);
  $("#"+focus_field).focus();
  return false;
 }
 else return true; 
}