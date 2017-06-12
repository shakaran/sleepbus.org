CalculateSafeSleep();

ValidateEditFundraiseForm = function()
{
 var error_count=0,error_value='',focus_field='';
 $("div #errorDiv").remove();
 $("div #error").remove();
 var campaign_name=trim($("#campaign_name").val());
 var campaign_goal=trim($("#campaign_goal").val());
 
 
 if(campaign_name == "") 
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
$("#campaign_goal").on('blur',function(){
 CalculateSafeSleep();
})
function CalculateSafeSleep()
{
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

}
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
	