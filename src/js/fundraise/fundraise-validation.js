ValidateFundraiseForm = function()
{
 var error_count=0,error_value='',focus_field='';
 $("div #errorDiv").remove();
 $("div #error").remove();
 var campaign_name=trim($("#campaign_name").val());
 var campaign_goal=trim($("#campaign_goal").val());
 var year=trim($("#year").val());
 var month=trim($("#month").val());
 var day=trim($("#day").val());
 var campaign_type=trim($("#campaign_type").val());
 
 
 if((campaign_name == "") || (campaign_name == "Give your campaign a name")) 
 {
  focus_field="campaign_name";
  error_value="Please enter campaign name";
 } 
 else if(campaign_goal == "")
 {
  focus_field="campaign_goal";
  error_value="Please enter campaign goal";
 }
 else if(!Number(campaign_goal))
 {
  focus_field="campaign_goal";
  error_value="Please enter valid price";
 }
 else  if(day == "")
 {
  focus_field="day";
  error_value="Please enter valid campaign end date with number only";
 } 
 else if(!validateInteger(day,2))
 {
  focus_field="day";
  error_value="Please enter valid campaign end date with number only";
 }
 else if(month == "")
 {
  focus_field="month";
  error_value="Please enter campaign end date";
 } 
 else if(!validateInteger(month,2))
 {
  focus_field="month";
  error_value="Please enter valid campaign end date with number only";
 }
 else if(year == "")
 {
  focus_field="year";
  error_value="Please enter valid campaign end date with number only";
 } 
 else if(!validateInteger(year,4))
 {
  focus_field="year";
  error_value="Please enter valid campaign end date with number only";
 }
 else if(!validatePossibleEndDate(year,month,day))
 {
  focus_field="month";
  error_value="Please enter valid campaign end date in DD|MM|YYYY format";
 }
 else if(campaign_type == "")
 {
  focus_field="campaign_type";
  error_value="Please choose campaign type";
 }

 if(error_value != "")
 {
  var header_height=$("div#header-band").height()+100;	 
  //var header_height=20;	 
  $('html, body').animate({scrollTop: $("#campaignfrom").offset().top-header_height}, 600); 
  var errorDiv=$("<div />",{"class":"has-error","text":error_value,"id":"error"})	 
  $("div #campaignfrom").prepend(errorDiv);
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
function validatePossibleEndDate(year,month,day)
{
 var today=new Date();
 var cur_year=today.getFullYear();
 var cur_month=today.getMonth()+1;
 var cur_day=today.getDate();
 if((year == cur_year))
 {
  if((month == cur_month))
  {
   if(day > cur_day)
   {
    return true;
   }
   else return false;
  }
  else if(month > cur_month) return ValidateDate(year,month,day);
  else
  {
   return false;
  }
 }
 else if(year > cur_year) return ValidateDate(year,month,day);
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

function ValidateEndDate(end_date)
{
 var pattern =/^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[\/]\d{4}$/;
 if(!pattern.test(end_date))
 {
  return false;
 }
 else
 {
  var date=new Array();
  date=end_date.split('/');	
  var day=date[0],month=date[1],year=date[2]; 
  if(!validatePossibleEndDate(year,month,day))
  {
   return false;
  }
  else return true;
  
 }

}










function GetContentTypeInfo()
{
 var campaign_type=$("#campaign_type").val();

  var path=document.getElementById('path').value;
  var param = {'campaign_type':campaign_type}; // you can send multiple argument as {cp:cp,name:name}
	
	$.ajax({
  	url: path+'fundraise/getCampaignTypeInfo',
	type:'POST', // You may use GET method also
   	data: param, 

  	success: function(result) {
    $("#campaign_info").html(result);		
   } 
  });	
}
$("#campaign_goal").on('blur',function(){
	var campaign_goal=Number($("#campaign_goal").val());
    var unit_fund=Number(trim($("#unit_fund").val()));
	
	if(campaign_goal == "")
	{
	 $("#people-no").text('10');
	}
	else if(Number(campaign_goal))
	{
	 var people=Math.floor(Number(campaign_goal)/unit_fund);	
	 $("#people-no").text(people);
	}
	else $("#people-no").text(0);
	
	})

function CountCharacters(input_id, limitbox_id, maxlength)
{
 var length = document.getElementById(input_id).value.length;
 if(length > maxlength)
 {
  var string = document.getElementById(input_id).value.substr(0,maxlength);
  document.getElementById(input_id).value = string;
  alert("You have reached maximum limit");
 }
 document.getElementById(limitbox_id).value = document.getElementById(input_id).value.length;
}