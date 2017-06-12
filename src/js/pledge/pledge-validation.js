ValidatePledgeForm = function()
{
 var error_count=0,error_value='',focus_field='';
 $("div #errorDiv").remove();
 $("div #error").remove();
 var full_name=trim($("#full_name").val());
 var email=trim($("#email").val());
 var year=trim($("#year").val());
 var month=trim($("#month").val());
 var day=trim($("#day").val());
 

 if(day == "")
 {
  focus_field="day";
  error_value="Please enter valid date of birth with number only";
 } 
 else if(!validateInteger(day,2))
 {
  focus_field="day";
  error_value="Please enter valid date of birth with number only";
 }
 else if(month == "")
 {
  focus_field="month";
  error_value="Please enter date of birth";
 } 
 else if(!validateInteger(month,2))
 {
  focus_field="month";
  error_value="Please enter valid date of birth with number only";
 }
 else if(year == "")
 {
  focus_field="year";
  error_value="Please enter valid date of birth with number only";
 } 
 else if(!validateInteger(year,4))
 {
  focus_field="year";
  error_value="Please enter valid date of birth with number only";
 }
 else if(!validateDateOfBirth(year,month,day))
 {
  focus_field="month";
  error_value="Please enter valid date of birth in DD|MM|YYYY format";
 }
 else if((full_name == "") || (full_name == "Full name")) 
 {
  focus_field="full_name";
  error_value="Please enter your name";
 }
 else if(email == "") 
 {
  focus_field="email";
  error_value="Please enter email address";
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
  $('html, body').animate({scrollTop: $("#pledgefrom").offset().top-header_height}, 600); 
  var errorDiv=$("<div />",{"class":"has-error","text":error_value,"id":"error"})	 
  $("div #pledgefrom").prepend(errorDiv);
  $("#"+focus_field).focus();
  return false;
 }
 else return true; 
}
function validateInteger(input,length)
{
 if(Number(input) > 0)
 {	
  var pattern=/^([0-9]+)$/;
  if(!pattern.test(input))
  {
   return false;
  }
  else return true;
 }
 else{return false;}
}
function validateDateOfBirth(year,month,day)
{
 var today=new Date();
 var cur_year=today.getFullYear();
 var cur_month=today.getMonth()+1;
 var cur_day=today.getDate();
 if((year == cur_year))
 {
  if((month == cur_month))
  {
   if(day <= cur_day)
   {
    return true;
   }
   else return false;
  }
  else if(month < cur_month) return ValidateDate(year,month,day);
  else
  {
   return false;
  }
 }
 else if(year < cur_year) return ValidateDate(year,month,day);
 else
 {
  return false;
 }
 return false;
}
 function ValidateDate(year,month,day)
 {
  var month_days=new Array(),result=false;
  month_days[0]=new Array(1,31);
  if(GetLeapYear(year)) month_days[1]=new Array(2,29);
  else month_days[1]=new Array(2,28);
  month_days[2]=new Array(3,31);
  month_days[3]=new Array(4,30);
  month_days[4]=new Array(5,31);
  month_days[5]=new Array(6,30);
  month_days[6]=new Array(7,31);
  month_days[7]=new Array(8,31);
  month_days[8]=new Array(9,30);
  month_days[9]=new Array(10,31);
  month_days[10]=new Array(11,30);
  month_days[11]=new Array(12,31);
  
  $.each(month_days,function(key,value){
	  
  if((value[0] == Number(month)))
  {
   if(Number(day) <= value[1])
   {
	result=true;
   }
  }
  })
  return result;
 }
 function GetLeapYear(year)
 {
  if(((year%4 == 0) && (year%100 !=0)) || (year%400 == 0))
  {
   return true;
  }
  else return false;
 }
 
 $("#scroll-down").click(function(){
  var header_height=$("div#header-band").height()+80;	 
  $('html, body').animate({scrollTop: $("#page-content").offset().top-header_height}, 800); 
	 })